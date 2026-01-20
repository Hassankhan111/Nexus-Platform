//show entreprenure startup data in portfolio page
document.addEventListener("DOMContentLoaded", async function () {
    const token = localStorage.getItem("api_token");
    if (!token) {
        window.location.href = "/";
        return;
    }
    let id = null;
    let startup_id = null;
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
            //console.log(response.data);
            id = response.data.id;
        }
        //show entreprenure profile data
        const startup_data = await fetch(`/api/enterprenure/${id}`, {
            method: "POST",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        })
        const entreprenre_startup = await startup_data.json();
        let startup = entreprenre_startup.startup;
        //console.log(startup.role);
        const data = startup.startup;
        //console.log(data);
        data.forEach(element => {
        startup_id = element.startup_id;
        //fetch startup data and show in startup page 
        document.getElementById("user_name").innerText = element.startup_name;
        document.getElementById("bio").innerText = element.company_name;
        document.getElementById('fetchsummery').innerText = element.pitch_summary;
        document.getElementById("industry_name").innerText = element.industry_name;
        document.getElementById("location").innerText = element.location;
        document.getElementById("profile_image").src = "/storage/" + element.image;
        });

    } catch (error) {
        console.error('setting error', error);
    }

    //OPEN ADD and update PROFILE PAGE btn
    const addBtn = document.getElementById("add-profile");
    const updateBtn = document.getElementById("update-profile");

    const hasProfile = startup_id != null && startup_id !== undefined;

    if (hasProfile) {
        addBtn.style.display = "none";
        updateBtn.style.display = "block";
    } else {
        addBtn.style.display = "block";
        updateBtn.style.display = "none";
    }

    if (addBtn) {
        addBtn.addEventListener('click', function () {
            window.location.href = `/add-profile/${id}`;
        });
    }
    if (updateBtn) {
        updateBtn.addEventListener('click', function () {
            window.location.href = `/update-profile/${id}`;
        });
    }
});
//------------------------show user startup data and show in update and add page ---------------------------------------------------------
$(document).ready(function () {

    const token = localStorage.getItem("api_token");
    const id = window.location.pathname.split("/").pop();

    $.ajax({
        url: "/api/user",
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        },
        success: function (res) {

            if (res.success && res.data) {

                if (document.getElementById("fullName")) {
                    document.getElementById("fullName").value = res.data.name;
                }

                if (document.getElementById("email")) {
                    document.getElementById("email").value = res.data.email;
                }

                if (document.getElementById("role")) {
                    document.getElementById("role").value = res.data.role;
                }
            }

            //get user startup data
            $.ajax({
                url: `/api/enterprenure/${id}`,
                method: "POST",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                },
                success: function (response) {
                    if (response.status && response.startup) {
                        const startup = response.startup.startup;
                        startup.forEach((value) =>{

                        //show in update startup page
                        document.getElementById("addimage").src = "/storage/" + value.image;
                        document.getElementById('name').value = value.startup_name;
                        document.getElementById('fneed').value = value.funding_need;
                        document.getElementById('company').value = value.company_name;
                        document.getElementById('loc').value = value.location;
                        document.getElementById('indistry').value = value.industry_name;
                        document.getElementById('timesize').value = value.team_size;
                        document.getElementById('year').value =value.founded_year;
                        document.getElementById('summ').value = value.pitch_summary;
                        });
                    }

                }

            });
        }
    });

});

//----------------------add startup data------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', async function () {

    const token = localStorage.getItem("api_token");

    if (!token) {
        window.location.href = "/";
        return;
    }

    let id = null;

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
            //console.log(response.data);
            id = response.data.id;
        }

    } catch (error) {
        console.error('user data error', error);
    }
     //chnage photo action for add and update startup
      document.getElementById('profileImageInput').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('addimage').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
     });
     
   
    //submit the add startup form
    const startup_form = document.getElementById('startup');
    startup_form.addEventListener("submit", async function (e) {
        e.preventDefault();

        const startup_name = document.querySelector('#startup_name').value;
        const company_name = document.querySelector('#company_name').value;
        const location = document.querySelector('#location').value;
        const industry_name = document.querySelector('#investment_company').value;
        const founded_year = document.querySelector('#funding_year').value;
        const team_size = document.querySelector('#time_size').value;
        const funding_need = document.querySelector('#funding_need').value;
        const pitch_summary = document.querySelector('#summary').value;
        //const role = document.querySelector('#startup_image').value;

        formdata = new FormData();

        formdata.append('startup_name', startup_name);
        formdata.append('company_name', company_name);
        formdata.append('location', location);
        formdata.append('industry_name', industry_name);
        formdata.append('founded_year', founded_year);
        formdata.append('team_size', team_size);
        formdata.append('funding_need', funding_need);
        formdata.append('pitch_summary', pitch_summary);

        if (document.querySelector('#profileImageInput').files.length > 0) {
            const img = document.querySelector('#profileImageInput').files[0];
            formdata.append('image', img);
        }

        try {
            const data = await fetch(`/api/addstartup/${id}`, {
                method: "POST",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json",
                },

                body: formdata
            })

            const startups_data = await data.json();
            console.log(startups_data);
            if (startups_data.status && startups_data.startups) {
                const ent_startups = startups_data.startups;
                //console.log(ent_startups);
                alert(' Record Added Successfully');
                window.location.href = `/profile/entreprenure/${id}`;
                form.reset();
            } else {
                alert(startups_data.errors);
            }
        } catch (error) {
            console.error('entreprenure error', error);
        }

    });

 //update entreprenure startup form-----------------------------------------------------------------
    //submit the update form
    const updatestartup = document.getElementById('updatestartup');
    updatestartup.addEventListener("submit", async function (e) {
        e.preventDefault();
        const name = document.querySelector('.startup_name').value;
        const company = document.querySelector('.company_name').value;
        const loc = document.querySelector('.location').value;
        const industry = document.querySelector('.investment_company').value;
        const year = document.querySelector('.funding_year').value;
        const team_totil = document.querySelector('.time_size').value;
        const funding = document.querySelector('.funding_need').value;
        const pit_summary = document.querySelector('.summary').value;
        //const role = document.querySelector('#startup_image').value;

        formdata = new FormData();

        formdata.append('startup_name', name);
        formdata.append('company_name', company);
        formdata.append('location', loc);
        formdata.append('industry_name', industry);
        formdata.append('founded_year', year);
        formdata.append('team_size', team_totil);
        formdata.append('funding_need', funding);
        formdata.append('pitch_summary', pit_summary);

        if (document.querySelector('#profileImageInput').files.length > 0) {
            const img = document.querySelector('#profileImageInput').files[0];
            formdata.append('image', img);
        }

        try {
            const update_form = await fetch(`/api/update-profile/${id}`, {
                method: "PUT",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json",
                },

                body: formdata
            })

            const update_data = await update_form .json();
            console.log(update_data);
            if (update_data.status && update_data.startups) {
                const updated_data = startups_data.startups;
                console.log(updated_data);
                alert(' Record updated Successfully');
                window.location.href = `/profile/entreprenure/${id}`;
                form.reset();
            }
        } catch (error) {
            console.error('entreprenure error', errors.message);
        }

    });

});



