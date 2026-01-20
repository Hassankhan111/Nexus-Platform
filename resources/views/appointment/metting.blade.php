@extends('layout.main')
@section('title', 'Appointment');

@section('main-content')

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10">
                <!-- appointments -->
                <div class="card m-3">
                    <div class="card-header">
                        <h5 class="mb-0">Upcoming Meeting</h5>
                    </div>

                    <!-- list of appointment-->
                    <div class="card m-3" id="table_data">
                        <!--show table in frontend javascript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", async function () {

            const token = localStorage.getItem("api_token");
            if (!token) {
                window.location.href = "/";
                return;
            }
            let id = null;
            let investorId = null;
            try {
                const res = await fetch("/api/user", {
                    method: "GET",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                })
                const response = await res.json();
                if (response.success && response.data) {
                    console.log(response.data);
                    id = response.data.id;
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
    </script>

@endsection