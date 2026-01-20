document.addEventListener("DOMContentLoaded", async function () {
    const token = localStorage.getItem("api_token");

    if (!token) {
        window.location.href = "/";
        return;
    }

     let receiverId  = window.location.pathname.split('/').pop();
     let senderId = null;
     let role = null;

    try {
        // 1️⃣ Get logged-in user
        const res = await fetch("/api/user", {
            method: "GET",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        });

        const response = await res.json();

        if (response.success && response.data) {
            senderId = response.data.id;
            role = response.data.role;
        }
        //send notification button
        const sendNotificationBtn = document.getElementById("sendnotification");
        if (sendNotificationBtn) {
            sendNotificationBtn.addEventListener("click", async function () {
                //console.log("Sender ID:", senderId);
                //console.log("Receiver ID:", receiverId);
                try {
                    const notificationResponse = await fetch('/api/message', {
                        method: "POST",
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            sender_id: senderId,
                            message: "Hello! I am interested in connecting with you.",
                            receiver_id: receiverId,
                        })
                     });
                     const notificationData =  await notificationResponse.json();
                         //console.log("Notification Response:", notificationData);
                        if (notificationData.status === true) {
                            alert("Notification sent successfully!");
                            sendNotificationBtn.disabled = true; 
                        } else {
                            alert("Failed to send notification.");
                        }
                    
                } catch (error) {
                    console.error("Error sending notification:", error);
                }
            });
        }

        //function to fetch notification
         async function usernotification() {
              const mynotification = await fetch('api/newnotification', {
                method: "GET",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            });

            const data = await mynotification.json();
            let frontend = document.getElementById("new-notification");
            frontend.innerHTML = ''; // clear existing notifications

            if (data.status === true && data.notification) {

                data.notification.forEach((value, index) => {
                     senderId = value.data.sender_id;
                     receiverId = value.notifiable_id;
                     //console.log("Sender ID:", senderId);
                     //console.log("receiver ID:", receiverId);
                    // Build notification HTML
                    let notification_data = `
                <div class="card-body d-flex">
                 <div class="d-flex align-items-start mb-3">
                 <img src="/storage/${value.data.image}" alt="user"
                    class="rounded-circle me-3"
                    width="55" height="55" style="object-fit:cover;">

                  <div class="flex-grow-1">
                    <div class="d-flex align-items-center gap-2">
                        <strong class="text-dark">${value.data.sender_name}</strong>
                        <span class="badge bg-primary">New</span>
                    </div>

                    <p class="text-muted mt-1 mb-1">${value.data.message}</p>

                    <small class="text-secondary">
                        💬 5 minutes ago
                     </small>
                    </div>
                  </div>
                  </div>
                  `;
                    // Append inside the loop
                    frontend.innerHTML += notification_data;
                });
            }
        }

        //mark as read function
        function markasread(){
            //mrk as read button
              const markasred = document.getElementById("markasred");
              if (markasred) {
                markasred.addEventListener("click", async function () {
                    try {
                        const markResponse = await fetch(`/api/changemark/${senderId}`, {
                            method: "POST",
                            headers: {
                                'Authorization': 'Bearer ' + token,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        });
                        const markData = await markResponse.json();
                        //console.log("Mark as Read Response:", markData);
                        if (markData.status === true) {
                            alert("All notifications marked as read!");
                            await usernotification(); // Refresh notifications
                        } else {
                            alert("Failed to mark notifications as read.");
                        }
                    } catch (error) {
                        console.error("Error marking notifications as read:", error);
                    }
                });
            }
        }

        // 2️⃣ If role is entrepreneur
         if (role === "entrepreneur") {
              await usernotification();
              markasread();
         }
        // 3️⃣ If role is investor
        else if (role === "investor") {
            await usernotification();
            markasread();
        }
          
    } catch (error) {
        console.error("Error fetching user data:", error);
    }
});
