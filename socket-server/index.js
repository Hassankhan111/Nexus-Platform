const express = require("express");
const cors = require('cors');
const http = require("http");
const { Server } = require("socket.io");
const { text } = require("stream/consumers");

const app = express();
app.use(cors());

const server = http.createServer(app);

const io = new Server(server, {
    cors: {
        origin: ["http://127.0.0.1:8000"], // Allow both variations
        methods: ["GET", "POST"],
        credentials: true
    }
});


io.on('connection', (socket) => {
    console.log('Users connected: ' + socket.id);


    // STEP 1: Identification
    socket.on('register_user', (user) => {
        console.log('Registering user: ' + user.name);
        
        socket.userId = user.Id;
        socket.userName = user.name;

        socket.join(`user_${user.Id}`); 

        socket.broadcast.emit('onlineusers', {
            id: user.Id,
            name: user.name,
            text: 'online'
        });
        
    });

    // STEP 2: Private Routing
    socket.on('send_private_msg', (data) => {
        const targetRoom = `user_${data.receiver_id}`;
        console.log(`Routing message to room: ${targetRoom} `);
        
        // Send ONLY to the receiver's room
        io.to(targetRoom).emit('new_notification', {
            name: data.sender_name,
            id: data.sender_id,
            text: data.message
        });
    });

    socket.on('disconnect', () => {
        console.log('User disconnected');
    });

     /* ---------- WEBRTC SIGNALING ---------- */

    socket.on("video-offer", data => {
        io.to(`user_${data.to}`).emit("video-offer", {
            sdp: data.sdp,
            from: socket.userId
        });
    });

    socket.on("video-answer", data => {
        io.to(`user_${data.to}`).emit("video-answer", {
            sdp: data.sdp
        });
    });

    socket.on("ice-candidate", data => {
        io.to(`user_${data.to}`).emit("ice-candidate", {
            candidate: data.candidate
        });
    });

    socket.on("disconnect", () => {
        if (socket.userId) {
            delete users[socket.userId];
            socket.broadcast.emit("offlineuser", {
                id: socket.userId
            });
        }
    });
});

server.listen(3000, () => {
    console.log('Socket.io server running on port 3000');
});

app.get('/', (req, res) => {
    res.send("Socket.io Server is active!");
});