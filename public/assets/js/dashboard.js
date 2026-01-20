//entreprenure cart
$(document).ready(function () {
    const token = localStorage.getItem("api_token");
    if (!token) return;

    $.ajax({
        url: "/api/Dashboardentreprenure",
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        },

        success: function (result) {

            if (result.status && result.entrepreure) {
                console.log(result.entrepreure);
                const card_row = $('#card-row');
                card_row.empty();

                result.entrepreure.forEach((user) => {

                    if (user.role !== "entrepreneur" || !user.startup) return;

                    user.startup.forEach((data) => {

                        let cardHtml = `
                        <div class="col-md-6">
                            <div class="investor-card">

                                <div class="d-flex align-items-center mb-2">
                                    <img src="/storage/${data.image}" class="profile-img">
                                    <div class="ms-3">
                                        <h6 class="mb-0 fw-bold">${user.name}</h6>
                                        <small class="text-muted">${data.company_name}</small>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <span class="badge bg-primary">${data.industry_name}</span>
                                    <span class="badge bg-light text-dark">${data.location}</span>
                                    <span class="badge bg-warning text-dark">Founded ${data.founded_year}</span>
                                </div>

                                <p class="fw-bold mb-1 small">Investment Interests:</p>
                                <div class="d-flex flex-wrap gap-1 mb-2">
                                    <span class="badge-soft">FinTech</span>
                                    <span class="badge-soft">${data.team_size}</span>
                                    <span class="badge-soft">${data.industry_name}</span>
                                </div>

                                <p class="text-muted small">${data.pitch_summary ?? ''}.</p>

                                <p class="fw-bold small mb-3">Investment Needed: ${data.funding_need}</p>

                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning w-50 messages">Message</button>
                                    <button class="btn btn-primary w-50 profile-btn" data-id="${data.user_id}">
                                        View Profile
                                    </button>
                                    <button class="btn btn-danger w-50 appointment-btn" data-id="${data.startup_id}">
                                        book Appointment
                                    </button>
                                </div>
                            </div>
                        </div>`;

                        card_row.append(cardHtml);
                    });
                });
            }
        },

        error: function (xhr, status, error) {
            console.error("Error:", error);
            console.error("Response:", xhr.responseText);
        }
    });

    // Works for all dynamically loaded buttons
    $(document).on("click", ".profile-btn", function () {
        const id = $(this).data("id");
        window.location.href = `/startup/profile/${id}`;
    });
    // Works for all booking
    $(document).on("click", ".appointment-btn", function () {
        const id = $(this).data("id");
        //const Id = btoa(id);
        window.location.href = `/Appointment?startupId=${id}`;
    });

    // Works for all message
    $(document).on("click", ".messages", function () {
        const id = $(this).data("id");
        window.location.href = "/messages";
    });

});


//entreprenure search
$(document).ready(function () {
    const token = localStorage.getItem("api_token");
    if (!token) return;

    $("#startup_search").on("keyup", function () {
        const startup = $(this).val();
        $.ajax({
            url: "/api/startup_search",
            method: "GET",
            data: { search: startup },
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            },

            success: function (result) {
                if (result.status && result.startup) {
                    // console.log(result.startup);
                    const cardrow = $('#cardrow');
                    const card_row = $('#card-row');
                    cardrow.empty();

                    result.startup.forEach((data) => {
                        let cardHtml = `
                    <div class="col-md-6">
                    <div class="investor-card">
                        <div class="d-flex align-items-center mb-2">
                            <img src="/storage/${data.image}" class="profile-img">
                            <div class="ms-3">
                                <h6 class="mb-0 fw-bold">${data.startup_name}</h6>
                                <small class="text-muted">${data.company_name}</small>
                            </div>
                        </div>

                        <div class="mb-2">
                         <span class="badge bg-primary">${data.industry_name}</span>
                         <span class="badge bg-light text-dark">${data.location}</span>
                        <span class="badge bg-warning text-dark">Founded ${data.founded_year}</span>
                        </div>

                        <p class="fw-bold mb-1 small">Investment Interests:</p>
                        <div class="d-flex flex-wrap gap-1 mb-2">
                            <span class="badge-soft">FinTech</span>
                            <span class="badge-soft">${data.team_size}</span>
                            <span class="badge-soft">${data.industry_name}</span>
                        </div>

                        <p class="text-muted small">${data.pitch_summary}.</p>

                        <p class="fw-bold small mb-3">Investment Range: ${data.funding_need}</p>

                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary w-50">Message</button>
                            <button class="btn btn-primary w-50" id="profile">View Profile</button>
                             <button class="btn btn-danger w-50 appointment-btn" data-id="${data.startup_id}">
                                        book Appointment
                             </button>
                        </div>
                     </div>
                     </div> `;
                        cardrow.append(cardHtml);
                        card_row.empty();

                        $('#profile').on("click", function () {
                            window.location.href = `/profile/investor_portfolio/${data.startup_id}`;
                        });
                        // Works for all booking
                        $(document).on("click", ".appointment-btn", function () {
                            const id = $(this).data("id");
                            //const Id = btoa(id);
                            window.location.href = `/Appointment?startupId=${id}`;
                        });
                    });
                } else {
                    $('#cardrow').empty().append(`<div class="text-center text-muted p-4">  ${result.message} </div>`);
                }
            },

            error: function (xhr, status, error) {
                console.log("Error:", error);
                console.log("Response:", xhr.responseText);
            }
        });
    });
});

//investor------------------------------------------------------------------------------------
$(document).ready(function () {
    const token = localStorage.getItem("api_token");
    if (!token) return;
    let id = null;
    $.ajax({
        url: "/api/Dashboardinvestor",
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        },

        success: function (result) {
            // console.log(result);

            if (result.status && result.investor) {

                const card_row = $('#card_row');
                card_row.empty();

                result.investor.forEach((user) => {

                    // only investors
                    if (user.role !== "investor") return;
                    // inv_startup is an ARRAY → take first
                    user.inv_startup.forEach((data) => {
                        if (!data) return;

                        let cardHtml = `
                    <div class="col-md-6">
                     <div class="investor-card">
                        <div class="d-flex align-items-center mb-2">
                            <img src="/storage/${data.inv_image}" class="profile-img">
                            <div class="ms-3">
                                <h6 class="mb-0 fw-bold">${user.name}</h6>
                                <small class="text-muted">investor ${data.company}</small>
                            </div>
                        </div>

                        <div class="mb-2">
                         <span class="badge bg-primary">${data.inv_industry}</span>
                         <span class="badge bg-light text-dark">${data.inv_location}</span>
                        <span class="badge bg-warning text-dark">Founded ${data.founded_year}</span>
                        </div>

                        <p class="fw-bold mb-1 small">Investment Interests:</p>
                        <div class="d-flex flex-wrap gap-1 mb-2">
                            <span class="badge-soft">FinTech</span>
                            <span class="badge-soft">${data.inv_teamsize}</span>
                            <span class="badge-soft">${data.inv_industry}</span>
                        </div>

                        <p class="text-muted small">${data.pitch_summ}.</p>

                        <p class="fw-bold small mb-3">Investment Range: ${data.funding_ned}</p>

                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary w-50">Message</button>
                            <button class="btn btn-primary w-50" id="profile" data-id="${data.user_id}">View Profile</button>
                        </div>
                    </div> 
                    </div>`;

                        card_row.append(cardHtml);
                    });
                });
            }
        },
        error: function (xhr, status, error) {
            console.log("Error:", error);
            console.log("Response:", xhr.responseText);
        }
    });
    $(document).on('click', '#profile', function () {
        const id = $(this).data('id');
        window.location.href = `/investor/profile/${id}`;
    })
});

//investor search------------------------------------------------------------------------------------
$(document).ready(function () {
    const token = localStorage.getItem("api_token");
    if (!token) return;

    $("#investor_search").on("keyup", function () {
        const investor = $(this).val();
        $.ajax({
            url: "/api/investor_search",
            method: "GET",
            data: { search: investor },
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            },

            success: function (result) {
                if (result.status && result.investors) {
                    //console.log(result.investors);
                    const card_row = $('#card_row');
                    card_row.empty();

                    result.investors.forEach((user) => {
                        // inv_startup is an ARRAY → take first
                        //var images = user.inv_image ? `/storage/${user.inv_image}` : `{{ asset('assets/img/logo.png') }}`;

                        let cardHtml = `
                     <div class="col-md-6">
                      <div class="investor-card">
                         <div class="d-flex align-items-center mb-2">
                             <img src="/storage/${user.inv_image}" class="profile-img">
                             <div class="ms-3">
                                 <h6 class="mb-0 fw-bold">${user.inv_name}</h6>
                                 <small class="text-muted">investor ${user.company}</small>
                             </div>
                         </div>
 
                         <div class="mb-2">
                          <span class="badge bg-primary">${user.inv_industry}</span>
                          <span class="badge bg-light text-dark">${user.inv_location}</span>
                         <span class="badge bg-warning text-dark">Founded ${user.year}</span>
                         </div>
 
                         <p class="fw-bold mb-1 small">Investment Interests:</p>
                         <div class="d-flex flex-wrap gap-1 mb-2">
                             <span class="badge-soft">FinTech</span>
                             <span class="badge-soft">${user.inv_teamsize}</span>
                             <span class="badge-soft">${user.inv_industry}</span>
                         </div>
 
                         <p class="text-muted small">${user.pitch_summ}.</p>
 
                         <p class="fw-bold small mb-3">Investment Range: ${user.funding_ned}</p>
 
                         <div class="d-flex gap-2">
                             <button class="btn btn-outline-secondary w-50">Message</button>
                             <button class="btn btn-primary w-50" id="profile">View Profile</button>
                         </div>
                     </div> 
                     </div>`;

                        card_row.append(cardHtml);

                        $('#profile').on("click", function () {
                            window.location.href = `/profile/investor/${user.investor_id}`;
                        });
                    });
                } else {
                    $('#card_row').empty().append(`<div class="text-center text-muted p-4">  ${result.message} </div>`);
                }
            },

            error: function (xhr, status, error) {
                console.log("Error:", error);
                console.log("Response:", xhr.responseText);
            }
        });
    });
});


