

//show payments-----------------------------------------------------------------------
$(document).ready(function () {


    const token = localStorage.getItem("api_token");
    let id = null;

    if (!token) {
        return;
    }
    $.ajax({
        url: "/api/user",
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        },
        success: function (res) {

            if (res.success && res.data) {
                id = res.data.id;
                console.log(id);
            }

            $.ajax({
                url: `/api/showpayments/${id}`,
                method: "GET",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                },
                success: function (result) {

                    if (result.status && result.payments) {
                        const payment = result.payments;

                        $('#showbillings').on("click", function () {
                            window.location.href = `showpayments/{id}`;
                        });
                        payment.forEach((data) => {
                            $("#load-data").append(
                                "<tr>" + 
                                "<td>" + data.amount + "</td>" +
                                "<td>" + data.description + "</td>" +
                                "<td>" + data.currency + "</td>" +
                                 "<td>" + data.status + "</td>" +
                                "</tr>"
                            );
                        });

                    }
                }
            });
            
        }

     

    });


});

