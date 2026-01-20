
$(document).ready(function () {
    const socket = io("http://127.0.0.1:3000", {
        transports: ["websocket", "polling"]
    });

    let token = localStorage.getItem('api_token');
    let userId;
    let userName;
    let activeReceiverId = null; // Dynamically set this when you click a user

    if (!token) return;



    //get all users from api 
    $.ajax({
        url: '/api/userlist',
        method: 'GET',
        headers: { Authorization: 'Bearer ' + token, Accept: 'application/json' },
        success: function (response) {
            response.data.forEach(function (users) {
                $("#allusers").append(`
                          <div class="user-link text-decoration-none">
                           <div class="user-row d-flex align-items-center p-2 border-bottom" data-id="${users.id}">
                           <img src="/storage/default.png" class="rounded-circle me-2" width="40">
                           <div>
                            <strong class="user-name">${users.name}</strong><br>
                              <small class="user-status text-primary"></small>
                            </div>
                           </div>
                         `);

                socket.on('onlineusers', function (user) {
                    if (user.id === users.id) {
                        $(`div.user-row[data-id='${user.id}']`).find('small').text(user.text);
                        $(".text-online").text(user.text);
                    }
                });
                socket.on('new_notification', function (data) {
                    if (data.id === users.id) {
                        $(`div.user-row[data-id='${data.id}']`).find('small').text('New message received');
                    }
                });
            });
        }

    });

    // --- 1. RECEIVING LOGIC ---
    socket.on('new_notification', function (data) {
        $('.chat-messages').append(`
         <div class="distance-user mb-2">
         <div class="bg-light p-2 rounded d-inline-block">
         <h5>${data.text}</h5>
         </div>
        </div>`);
    });

    $(document).on('click', '.user-row', function () {
        activeReceiverId = $(this).data('id');
    });

    // --- 2. IDENTITY & SETUP ---
    $.ajax({
        url: '/api/user',
        method: 'GET',
        headers: { Authorization: 'Bearer ' + token, Accept: 'application/json' },
        success: function (response) {
            userId = response.data.id;
            userName = response.data.name;
            $('.user').text(userName);


            // Register yourself in your own private room
            socket.emit('register_user', {
                Id: userId,
                name: userName
            });

            // --- 3. SENDING LOGIC ---
            $('#sendbtn').click(function () {
                let message = $('#message').val().trim();
                // For learning: Ensure you set activeReceiverId when clicking a user in your UI
                activeReceiverId = activeReceiverId; // Replace with dynamic ID from your "selected user" logic
                if (message === '' || !activeReceiverId) return;
                $.ajax({
                    url: '/api/sendmessage',
                    method: 'POST',
                    headers: { Authorization: 'Bearer ' + token, Accept: 'application/json' },
                    data: {
                        receiver_id: activeReceiverId,
                        sender_id: userId,
                        message_content: message
                    },
                    success: function () {
                        // Emit to Socket server so the receiver gets it instantly
                        socket.emit('send_private_msg', {
                            receiver_id: activeReceiverId,
                            sender_name: userName,
                            sender_id: userId,
                            message: message
                        });

                        // Append to your own screen
                        $('.chat-messages').append(`
                            <div class="current-user text-end mb-2">
                                <div class="bg-primary text-white p-2 rounded d-inline-block">
                                    <h5>${message}</h5>
                                </div>
                            </div>`);
                        $('#message').val('');
                    }
                });
            });
        }
    });

    
    /* ================== WEBRTC ================== */

    let pc, localStream;
    const config = {
        iceServers: [{ urls: "stun:stun.l.google.com:19302" }]
    };

    async function startCall(type) {
        if (!activeReceiverId) return alert("Select a user");

        localStream = await navigator.mediaDevices.getUserMedia({
            video: type === "video",
            audio: true
        });

        localVideo.srcObject = localStream;
        pc = new RTCPeerConnection(config);

        localStream.getTracks().forEach(t => pc.addTrack(t, localStream));

        pc.ontrack = e => remoteVideo.srcObject = e.streams[0];

        pc.onicecandidate = e => {
            if (e.candidate) {
                socket.emit("ice-candidate", {
                    to: activeReceiverId,
                    candidate: e.candidate
                });
            }
        };

        const offer = await pc.createOffer();
        await pc.setLocalDescription(offer);

        socket.emit("video-offer", {
            to: activeReceiverId,
            sdp: offer
        });
    }

    socket.on("video-offer", async data => {
        pc = new RTCPeerConnection(config);

        pc.ontrack = e => remoteVideo.srcObject = e.streams[0];

        pc.onicecandidate = e => {
            if (e.candidate) {
                socket.emit("ice-candidate", {
                    to: data.from,
                    candidate: e.candidate
                });
            }
        };

        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        localVideo.srcObject = localStream;
        localStream.getTracks().forEach(t => pc.addTrack(t, localStream));

        await pc.setRemoteDescription(data.sdp);
        const answer = await pc.createAnswer();
        await pc.setLocalDescription(answer);

        socket.emit("video-answer", {
            to: data.from,
            sdp: answer
        });
    });

    socket.on("video-answer", async data => {
        await pc.setRemoteDescription(data.sdp);
    });

    socket.on("ice-candidate", async data => {
        await pc.addIceCandidate(data.candidate);
    });

});






















