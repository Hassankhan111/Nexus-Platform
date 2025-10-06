//login
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
                            window.location.href = '/Investor';
                        } else {
                            window.location.href = '/entrepreneure';
                        }
                    }, 2000);
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
document.querySelector('#logout').addEventListener('click',function(){
  const token = localStorage.getItem('api_token');
  if(!token){
     alert('No token found, please login first.');
        return;
  }
    fetch('/api/logout',{
        method:'POST',
        headers:{
             'Authorization': `Bearer ${token}`,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
    }).then(res => res.json())
      .then(response =>{
        localStorage.removeItem('api_token');
        console.log(response);
        window.location.href ="/";
      })
  
});


//registr user 



