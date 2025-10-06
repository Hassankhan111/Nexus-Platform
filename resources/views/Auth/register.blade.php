<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Business Nexus</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f9fafb;
    }

    .role-btn.active {
      border-color: #0d6efd !important;
      background-color: #e7f1ff !important;
      color: #0d6efd !important;
    }
  </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="text-center mb-4">
          <div class="d-inline-flex bg-primary text-white rounded p-3 mb-3">
            <i class="fas fa-briefcase fa-lg"></i>
          </div>
          <h2 class="fw-bold">Create your account</h2>
          <p class="text-muted">Join Business Nexus to connect with partners</p>
        </div>

        <div class="card shadow-sm">
          <div class="card-body p-4">

            <!-- Error Alert -->
            <div id="errorBox" class="alert alert-danger d-none">
              <i class="fas fa-exclamation-circle me-2"></i>
              <span id="errorMsg"> </span>
            </div>

            <div id="successBox" class="alert alert-danger d-none">
              <i class="fas fa-exclamation-circle me-2"></i>
              <span id="successMsg"> </span>
            </div>

            <form id="registerForm">
              <!-- Role Selection -->
              <div class="mb-3">
                <label class="form-label">I am registering as a</label>
                <div class="d-flex gap-2">
                  <button type="button" id="entrepreneurBtn" class="btn btn-outline-secondary role-btn w-50 active">
                    <i class="fas fa-building me-2"></i> Entrepreneur
                  </button>
                  <button type="button" id="investorBtn" class="btn btn-outline-secondary role-btn w-50">
                    <i class="fas fa-dollar-sign me-2"></i> Investor
                  </button>
                </div>
                <!-- hidden input that will be updated with JS -->
                <input type="hidden" id="role" name="role" value="entrepreneur">
              </div>

              <!-- Full Name -->
              <div class="mb-3">
                <label class="form-label">Full Name</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                  <input type="text" id="name" name="name" class="form-control" required>
                </div>
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label class="form-label">Email address</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  <input type="email" id="email" name="email" class="form-control" required>
                </div>
              </div>

              <!-- Password -->
              <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                  <input type="password" id="password" name="password" class="form-control" required>
                </div>
              </div>

              <!-- Terms -->
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="terms" required>
                <label class="form-check-label" for="terms">
                  I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                </label>
              </div>

              <!-- Submit -->
              <button type="submit" class="btn btn-primary w-100">Create account</button>
            </form>

            <div class="text-center mt-3">
              <small class="text-muted">Already have an account? <a href="{{ url('/') }}">Sign in</a></small>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const entrepreneurBtn = document.getElementById("entrepreneurBtn");
    const investorBtn = document.getElementById("investorBtn");
    const roleInput = document.getElementById("role");

    entrepreneurBtn.addEventListener("click", () => {
      entrepreneurBtn.classList.add("active");
      investorBtn.classList.remove("active");
      roleInput.value = "entrepreneur";
    });

    investorBtn.addEventListener("click", () => {
      investorBtn.classList.add("active");
      entrepreneurBtn.classList.remove("active");
      roleInput.value = "investor";
    });

    var registerform = document.querySelector('#registerForm');
registerform.onsubmit = function (e) {
    e.preventDefault();

    var role = document.querySelector('#role').value;
    var name = document.querySelector('#name').value;
    var email = document.querySelector('#email').value;
    var password = document.querySelector('#password').value;

    fetch('/api/signup', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            role: role,
            name: name,
            email: email,
            password: password,
        })

    })
        .then(res => res.json())
        .then(response => {
            console.log(response);

            if (response.status === true) {
                // Success alert
                var successMsg = document.getElementById("successMsg");
                var successBox = document.getElementById("successBox");
                setTimeout(() => {
                    successMsg.innerText = response.message;
                    successBox.classList.remove("d-none");
                    window.location.href = '/';
                }, 2000);
            } else {
                // Error alert
                var errorMsg = document.getElementById("errorMsg");
                var errorBox = document.getElementById("errorBox");

                errorMsg.innerText = 'UserName and Password Incorrect' || JSON.stringify(response.errors);
                errorBox.classList.remove("d-none");
            }
        })
        .catch(error => {
            console.error("Error:", error);

            var errorMsg = document.getElementById("errorMsg");
            var errorBox = document.getElementById("errorBox");

            errorMsg.innerText = "Something went wrong. Please try again.";
            errorBox.classList.remove("d-none");
        });
}

  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/jquery.main.js') }}"> </script>
  <script src="{{ asset('assets/js/Auth.js') }}"> </script>
</body>

</html>