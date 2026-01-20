//investor------------------------------------------------------------------------------------
$(document).ready(function () {

    let id = window.location.pathname.split("/").pop();

    const token = localStorage.getItem("api_token");
    if (!token) return;

    $.ajax({
        url:  `/api/investor_portfolio/${id}`,
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        },

        success: function (result) {
            // console.log(result);

            if (result.status && result.user) {
                 data = result.user;
                 $('#inv_name').text(data.name);
                 if(data.inv_startup && data.inv_startup.length > 0){
                    const investor = data.inv_startup[0];
                       
                 $('#inv_image').attr('src',`/storage/${investor.inv_image}`);
                 $('#total_inv').text(investor.inv_teamsize);
                 $('#fetch').text(investor.pitch_summ);
                 $('#inv_location').text(investor.inv_location);
                 $('#inv_bio').text(investor.inv_name);
                 $('#inv_industry').text(investor.inv_industry);
                 $('#team').text(investor.inv_teamsize);
                  $('#inv_company').text(investor.company);
                }
                
            }
        },

        error: function (xhr, status, error) {
            console.log("Error:", error);
            console.log("Response:", xhr.responseText);
        }
    });
});

//entreprenure profiless-----------------------------------------------------------------------------------------------------
$(document).ready(function () {

    let id = window.location.pathname.split("/").pop();

    const token = localStorage.getItem("api_token");
    if (!token) return;

    $.ajax({
        url:  `/api/enterprenure/${id}`,
        method: "POST",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        },

        success: function (result) {
            // console.log(result);

            if (result.status && result.startup) {
                 data = result.startup;
                 $('#user').text(data.name);
                 if(data && data.startup.length > 0){
                    const startup = data.startup[0];
                       
                 $('#startup_image').attr('src',`/storage/${startup.image}`);
                 $('#funding_need').text(startup.funding_need);
                 $('#fetch-summery').text(startup.pitch_summary);
                 $('#location_starup').text(startup.location);
                 $('#b').text(startup.startup_name);
                 $('#industry_name').text(startup.industry_name);
                 $('#team-count').text(startup.team_size);
                  $('#inv_company').text(startup.company_name);
                }
                
            }
        },

        error: function (xhr, status, error) {
            console.log("Error:", error);
            console.log("Response:", xhr.responseText);
        }
    });
});
