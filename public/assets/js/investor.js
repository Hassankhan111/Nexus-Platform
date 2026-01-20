

//show entreprenure startup data in portfolio page
document.addEventListener("DOMContentLoaded", async function () {

    const token = localStorage.getItem("api_token");
    if (!token) {
        window.location.href = "/";
        return;
    }
    let id = null;
    let investor_profile;
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
            document.getElementById("name").innerText = response.data.name;
            
        }

        const investor_data = await fetch(`/api/investor_portfolio/${id}`, {
            method: "GET",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        })
        const data = await investor_data.json();
        const investordata = data.user.inv_startup;
        investordata.forEach((value) => {
            investor_profile = value.investors_id;
            //investor frofile page 
            document.getElementById("inv_startup").innerText = value.inv_name;
            document.getElementById('criteria').innerText = value.pitch_summ;
            document.getElementById("indus").innerText = value.inv_industry;
            document.getElementById("loc").innerText = value.inv_location;
            document.getElementById("Invest").innerText = value.inv_teamsize;
            document.getElementById("inv_image").src = "/storage/" + value.inv_image;
        });
        //console.log(investordata.inv_name);


    } catch (error) {
        console.error('error in id', error);
    }

    //open profile add btn            
    var addbtninvestor = document.querySelector("#addinvestor_btn");
    //open profile update btn            
    var updatebtninvestor = document.querySelector("#updateinvestor_btn");

    const hasProfile = typeof investor_profile !== null && investor_profile !== undefined;
    if (hasProfile) {
        addbtninvestor.style.display = "none";
        updatebtninvestor.style.display = "block";

    } else {

        addbtninvestor.style.display = 'block';
        updatebtninvestor.style.display = 'none';
    }

    if (addbtninvestor) {
        addbtninvestor.addEventListener("click", function () {
            window.location.href = `/addInvestor/${id}`;
        });
    }

    if (updatebtninvestor) {
        updatebtninvestor.addEventListener("click", function () {
            window.location.href = `/updateInvestor/${id}`;
        });
    }
});
//-----------------------add investor data----------------------------------------------
document.addEventListener("DOMContentLoaded", function () {
    const token = localStorage.getItem("api_token");
    const id = window.location.pathname.split("/").pop(); // assuming user id in URL

    //chnage photo action for add and update investors
    document.getElementById('ImageInput').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('updateimage').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
    const form = document.getElementById('addinvestor');
    const imageInput = document.getElementById('ImageInput');

    if (form) {
        form.addEventListener("submit", async function (e) {
            e.preventDefault();

            const investor_name = document.getElementById('investor_name').value;
            const investor_company = document.getElementById('investor_company').value;
            const investor_location = document.getElementById('investor_location').value;
            const investor_industry = document.getElementById('investor_investmentcompany').value;
            const investor_year = document.getElementById('investor_fundingyear').value;
            const investor_teamsize = document.getElementById('investor_timesize').value;
            const investor_fundingneed = document.getElementById('funding_need').value;
            const investor_pitchsummary = document.getElementById('investor_pitchsummary').value;

            const formData = new FormData();
            formData.append('inv_name', investor_name);
            formData.append('company', investor_company);
            formData.append('inv_location', investor_location);
            formData.append('inv_industry', investor_industry);
            formData.append('year', investor_year);
            formData.append('inv_teamsize', investor_teamsize);
            formData.append('funding_ned', investor_fundingneed);
            formData.append('pitch_summ', investor_pitchsummary);

            if (imageInput.files.length > 0) {
                formData.append('inv_image', ImageInput.files[0]);
            }

            try {
                const res = await fetch(`/api/addinvestor/${id}`, {
                    method: "POST",
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Accept": "application/json",
                    },
                    body: formData
                });

                const data = await res.json();
                console.log(data);

                if (data.status) {
                    alert("Record Added Successfully!");
                    window.location.href = `/investor_portfolio/${id}`;
                } else {
                    alert(data.errors.join("\n"));
                }
            } catch (err) {
                console.error("Investor form error:", err);
            }

        });
    }
});

//------------------------show user startup data show in update page ---------------------------------------------------------
$(document).ready(function () {

    const token = localStorage.getItem("api_token");
    const id = window.location.pathname.split("/").pop();

    $.ajax({
        url: `/api/investor_portfolio/${id}`,
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        },
        success: function (response) {
            if (response.status && response.user.inv_startup) {
                const startup = response.user.inv_startup;
                //show in update startup page
                startup.forEach((data) => {
                    document.getElementById("name").value = data.inv_name;
                    document.getElementById('summ').value = data.pitch_summ;
                    document.getElementById("indistry").value = data.inv_industry;
                    document.getElementById("loc").value = data.inv_location;
                    document.getElementById("timesize").value = data.inv_teamsize;

                    document.getElementById("year").value = data.year;
                    document.getElementById("fneed").value = data.funding_ned;
                    document.getElementById("company").value = data.company;
                    document.getElementById("updateimage").src = "/storage/" + data.inv_image;
                });
            }

        }

    });
});


//------------------------add investor profile data--------------------------------------------------