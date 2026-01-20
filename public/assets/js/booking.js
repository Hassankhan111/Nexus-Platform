/* add appointment booking by investors*/
document.addEventListener("DOMContentLoaded", async function () {

    const token = localStorage.getItem("api_token");
    if (!token) {
        window.location.href = "/";
        return;
    }
    let id = null;
    let role = null;

    try {

        //-------------------------------
        // 1. GET AUTH USER
        //-------------------------------
        const res = await fetch("/api/user", {
            method: "GET",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json",
            }
        })
        const response = await res.json();

        if (response.success && response.data) {

            id = response.data.id;
            role = response.data.role.toLowerCase();
        }
        const form = document.getElementById('meetingform');

        if (form) {
            form.onsubmit = function (e) {
                e.preventDefault();

                const schedule = document.getElementById('schedule').value;
                //get entreprenure id in url
                const start_id = new URLSearchParams(window.location.search);
                const startup_id = start_id.get("startupId");

                //console.log(startup_id,schedule,id);

                fetch("/api/createappointment", {
                    method: "POST",
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        scheduled_at: schedule,
                        investor_id: id,
                        startup_id: startup_id,
                    }),
                }).then(result => result.json())
                    .then(response => {
                        //console.log(response);

                        if (response.status === true) {
                            var success_box = document.getElementById('successBox');
                            var msg = document.getElementById('successMsg');

                            setTimeout(() => {
                                msg.innerHTML = response.message;
                                success_box.classList.remove('d-none');
                                location.reload();
                            }, 2000);

                        } else {
                            var errorMsg = document.getElementById("errorMsg");
                            var errorBox = document.getElementById("errorBox");

                            setTimeout(() => {
                                // Convert Laravel validation errors to readable text
                                let allErrors = "";
                                for (let field in response.errors) {
                                    allErrors += response.errors[field].join(", ") + "\n";
                                }

                                errorMsg.innerText = allErrors;
                                errorBox.classList.remove("d-none");
                                form.reset();

                                alert(allErrors); // No crash now
                            }, 500);
                        }
                    });
            }
        }

        // get meeting details to investor-----------------------------------------------------------
        fetch(`/api/appointment/${id}`, {
            method: "GET",
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json",
            },
        })
            .then(res => res.json())
            .then(meeting => {

                const datad = document.getElementById("table_data");
                datad.style.display = "none";
                // Start building HTML table
                let html = `
                <div class="card-header">
                <h5 class="mb-0">Your Appointments</h5>
                </div>
                <div class="card-body">
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Meeting ID</th>
                        <th>Scheduled At</th>
                        <th>Status</th>
                        <th>Meeting Link</th>
                    </tr>
                </thead>
                <tbody>
                `;
                // Loop through all appointments
                meeting.data.forEach(item => {
                    html += `
                <tr>
                <td>000${item.meeting_id}</td>
                <td>${item.scheduled_at}</td>
                <td>${item.status}</td>
               <td style="white-space: nowrap;">
                ${item.meeting_link
                            ? `<a href="${item.meeting_link}" target="_blank" class="btn btn-sm btn-primary">Open</a>`
                            : `<span class="text-muted">No Link</span>`
                        }
               </td>
                </tr> `;
                });
                 // Close the table
                html += `
                </tbody>
            </table>
        </div>`;
                // Insert into the DOM
                datad.innerHTML = html;
                datad.style.display = "block";
            });

    } catch (err) {
        console.error("user error:", err);
    }
});

//show upcoming meetings to entreprenure-----------------------------------------------------------------------------------
