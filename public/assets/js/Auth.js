// user login as investor and entreprenure 
$(document).ready(function () {

    $('.loginform').submit(function (e) {
        e.preventDefault();

        formdata = new FormData(this);
        $.ajax({
            url: '/api/login',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                localStorage.setItem('api_token', response.token);

                if (response.status === true) {
                    //console.log(response.message);
                    var successMsg = document.getElementById("successMsg");
                    var successBox = document.getElementById("successBox");
                    setTimeout(() => {
                        successMsg.innerHTML = response.message;
                        successBox.classList.remove("d-none");
                        // Redirect based on role
                        if (response.role === 'investor') {
                            window.location.href = '/Dashboard/Investor';
                        } else {
                            window.location.href = '/Dashboard/entrepreneure';
                        }
                    }, 1000);
                } else {
                    // Error alert
                    var errorMsg = document.getElementById("errorMsg");
                    var errorBox = document.getElementById("errorBox");

                    errorMsg.innerHTML = response.errors || JSON.stringify(response.errors);
                    errorBox.classList.remove("d-none");
                }
            },
            error: function (xhr, status, error) {
                var errorMsg = document.getElementById("errorMsg");
                var errorBox = document.getElementById("errorBox");

                errorMsg.innerHTML = "Something went wrong. Please try again.";
                errorBox.classList.remove("d-none");

            }

        });

    })


})

//user logout
document.querySelector('#logout').addEventListener('click', function () {
    const token = localStorage.getItem('api_token');
    if (!token) {
        alert('No token found, please login first.');
        return;
    }
    fetch('/api/logout', {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
    }).then(res => res.json())
        .then(response => {
            localStorage.removeItem('api_token');
            console.log(response);
            window.location.href = "/";
        })

});
// End of user login as investor and entreprenure

//show profile and update profile for seeting page-----------------------------------------------------------------------------------------
document.addEventListener("DOMContentLoaded", async function () {
    const token = localStorage.getItem("api_token");
    if (!token) {
        window.location.href = "/";
        return;
    }

    let id = null;
    let role;
    let ent_startup = null;
    let investor_startup = null;
    try {
        const res = await fetch("/api/user", {
            method: "GET",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        })
        const response = await res.json();
        //console.log(response.data);
        if (response.success && response.data) {
            //console.log(response.data);
            id = response.data.id;
            role = response.data.role;
            document.querySelector("#role").value = response.data.role;
            document.querySelector("#fullName").value = response.data.name;
            document.querySelector("#email").value = response.data.email;
        }
        if (role === "entrepreneur") {
            const startup_data = await fetch(`/api/enterprenure/${id}`, {
                method: "POST",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            })
            const startup = await startup_data.json();
            
            if (startup.status && startup.startup) {
                //console.log(startup.startup.startup);
                const profiles = startup.startup.startup; 
                profiles.forEach((data) => {
                ent_startup = data.startup_id;
                document.querySelector("#location").value = data.location;
                document.querySelector("#bio").value = data.startup_name;
                const profileimage = document.getElementById('profileimage');
                if (profileimage) {
                    profileimage.src = "/storage/" + data.image;
                }
            });
            }
            //get seeting_profile btn
            const addseeting = document.getElementById('addseeting_profile');
            const updateseeting = document.getElementById('updateseeting_profile');

            const has_Profile = ent_startup != null && ent_startup !== ""  && ent_startup  !== null;

            if (has_Profile) {
                addseeting.style.display = "none";
                updateseeting.style.display = "block";
            } else {
                addseeting.style.display = "block";
                updateseeting.style.display = "none";
            }

            if (addseeting) {
                addseeting.addEventListener('click', function () {
                    window.location.href = `/add-profile/${id}`;
                });
            }
            if (updateseeting) {
                updateseeting.addEventListener('click', function () {
                    window.location.href = `/update-profile/${id}`;
                });
            }
        }

        if (role === "investor") {

            const inv_startup = await fetch(`/api/investor_portfolio/${id}`, {
                method: "GET",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            });

            const investor_data = await inv_startup.json();

            const investors = investor_data.user.inv_startup;
           // console.log(investors);

            if (Array.isArray(investors) && investors.length > 0) {

                investors.forEach(value => {
                    investor_startup = value.investors_id;
                    //console.log(investor_startup);
                    document.querySelector("#location").value = value.inv_location;
                    document.querySelector("#bio").value = value.inv_name;
                    const profileimage = document.getElementById('profileimage');
                    if (profileimage) {
                        profileimage.src = "/storage/" + value.inv_image;
                    }
                });

            }

            //get seeting_profile btn
           const addseeting = document.getElementById('addseeting_profile');
            const updateseeting = document.getElementById('updateseeting_profile');

            const Profile_has = investor_startup != null &&  investor_startup !== ""  && investor_startup !== null;

            if (Profile_has) {
                addseeting.style.display = "none";
                updateseeting.style.display = "block";
            } else {
                addseeting.style.display = "block";
                updateseeting.style.display = "none";
            }

            if (addseeting) {
                addseeting.addEventListener('click', function () {
                    window.location.href = `/add-profile/${id}`;
                });
            }
            if (updateseeting) {
                updateseeting.addEventListener('click', function () {
                    window.location.href = `/updateInvestor/${id}`;
                });
            }

        }

    } catch (error) {
        console.error('setting error', error);
    }
    //end if show profile data in setings

    // Update profile in settigs------------------------------------------------------------------------------------------
    document.getElementById('profileForm').addEventListener("submit", async function (e) {
        e.preventDefault();
        //alert(id);
        const token = localStorage.getItem("api_token");

        if (!token) {
            window.location.href = "/";
            return;
        }

        const name = document.querySelector('#fullName').value;
        const email = document.querySelector('#email').value;

        //console.log(name + email+role+location+bio+role);

        formdata = new FormData();

        formdata.append('name', name);
        formdata.append('email', email);

        try {
            const response = await fetch(`/api/update/${id}`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    //'X-HTTP-Method-Override' : 'PUT',
                    'Accept': 'application/json',
                },
                body: formdata
            });
            const res = await response.json();
            //console.log(res);
            if (res.status) {
                alert("user updated successfully!");
            } else {
                alert("Update failed: username and email already exist");
            }
        } catch (error) {
            console.error('Profile update error', error);
        }
    });
    //---------------------change password-----------------------------------------------------------------------
    document.getElementById('passwordForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const token = localStorage.getItem("api_token");

        const oldpass = document.querySelector('#currentPassword').value;
        const newpass = document.querySelector('#newPassword').value;

        formdata = new FormData();

        formdata.append('oldpass', oldpass);
        formdata.append('newpass', newpass);

        try {
            const user_pass = await fetch(`/api/changepassword/${id}`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    //'X-HTTP-Method-Override' : 'PUT',
                    'Accept': 'application/json',
                },
                body: formdata
            });
            const res = await user_pass.json();
            console.log(res);
            if (res.status) {
                alert("Password updated successfully!");
                document.getElementById('passwordForm').reset();
            } else {
                alert("Update failed: " + res.message);
            }
        } catch (error) {
            console.error('password update error', error);
        }

    })

});
//end of update profile