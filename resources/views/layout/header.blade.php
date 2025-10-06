<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') | NexusDashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  
</head>
<body>
 
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container-fluid">

      <!-- Sidebar toggle button (mobile) -->
      <button class="btn btn-outline-primary d-md-none me-2" type="button" id="sidebarToggle">
        <i class="bi bi-list"></i>
      </button>

      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center" href="#">
        <div class="bg-primary text-white d-flex align-items-center justify-content-center rounded me-2"
          style="width: 32px; height: 32px;">
          <i class="bi bi-building"></i>
        </div>
        <span class="fw-bold">Business Nexus</span>
      </a>

      <!-- Hamburger button for collapsing nav -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-semibold">
          <li class="nav-item">
            <a id="link_dashbord" class="nav-link" href=""><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
          </li>
          <li class="nav-item">
            <a id="messagess" class="nav-link" href="#"><i class="bi bi-chat-left-text me-1"></i> Messages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-bell me-1"></i> Notifications</a>
          </li>
          <li class="nav-item"><a id="profilee" class="nav-link" href=""><i class="bi bi-person me-2"></i> Profile</a>

          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="#" id="logout"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
          </li>
          <li class="nav-item ms-lg-3">
            <a class="nav-link d-flex align-items-center" href="#" id="profileDropdown" role="button">
              <img id="userImage" src="https://via.placeholder.com/32" alt="User" class="profile rounded-circle me-2"
                width="45" height="45">
              <span id="userdeteils">Sarah Johnson</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

 <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/jquery.main.js') }}"></script>
  <script src="{{ asset('assets/js/Auth.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

  

  <!-- this the stack script code extended in every page --->
  @stack('scripts')

</body>

</html>
</body>
</html>
