<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Business Nexus - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="d-flex vh-100 justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 400px;">

      <!-- Logo / Heading -->
      <div class="text-center mb-4">
        <img src="{{ asset('assets/img/logo.svg') }}" style="width:40px;">
        <h4 class="fw-bold mt-2">Sign in to Business Nexus</h4>
        <p class="text-muted small">Connect with investors and entrepreneurs</p>
      </div>

 <!-- Error Alert -->
            <div id="errorBox" class="alert alert-danger d-none">
              <i class="fas fa-exclamation-circle me-2"></i>
              <span id="errorMsg"> </span>
            </div>

            <div id="successBox" class="alert alert-danger d-none">
              <i class="fas fa-exclamation-circle me-2"></i>
              <span id="successMsg"> </span>
            </div>

      <!-- Login Form -->
      <form class="loginform">

        <div class="mb-3">
          <label class="form-label fw-semibold">I am a</label>
          <div class="btn-group w-100" role="group">
            <button type="button" id="entrepreneurBtn" class="btn btn-outline-primary role-btn w-50 active">
              <i class="fas fa-building me-2"></i> Entrepreneur
            </button>
            <button type="button" id="investorBtn" class="btn btn-outline-primary role-btn w-50">
              <i class="fas fa-dollar-sign me-2"></i> Investor
            </button>
          </div>
          <!-- hidden input that will be updated with JS -->
          <input type="hidden" id="role" name="role" value="entrepreneur">
        </div>
        
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" id="loginemail" name="email" class="form-control" placeholder="Enter email">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" id="loginpassword" name="password" class="form-control" placeholder="Password">
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
          <a href="#" class="small">Forgot your password?</a>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">
          <i class="bi bi-box-arrow-in-right"></i> Sign in
        </button>
      </form>

      <!-- Demo Accounts -->
      <div class="text-center mb-3">
        <small class="text-muted">Demo Accounts</small>
        <div class="d-flex gap-2 mt-2">
          <button class="btn btn-outline-secondary w-50">Entrepreneur Demo</button>
          <button class="btn btn-outline-secondary w-50">Investor Demo</button>
        </div>
      </div>

      <!-- Signup -->
      <div class="text-center">
        <small>
          Don’t have an account? <a href="{{ url('register') }}">Sign up</a>
        </small>
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
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/jquery.main.js') }}"> </script>
  <script src="{{ asset('assets/js/Auth.js') }}"> </script>


</body>

</html>