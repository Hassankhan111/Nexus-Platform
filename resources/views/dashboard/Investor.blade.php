@extends('layout.main')

@section('main-content')
  <div class="container py-4">

    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
      <div>
        <h1 class="h3 fw-bold">Discover Startups</h1>
        <p class="text-muted">Find and connect with promising entrepreneurs</p>
      </div>
      <a href="#" class="btn btn-primary">
        <i class="fas fa-plus-circle me-2"></i> View All Startups
      </a>
    </div>

    <!-- Search & Filters -->
    <div class="row g-3 mb-4">
      <div class="col-md-8">
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-search"></i></span>
          <input type="text" class="form-control" placeholder="Search startups, industries, or keywords...">
        </div>
      </div>
      <div class="col-md-4">
        <div class="d-flex align-items-center">
          <i class="fas fa-filter text-secondary me-2"></i>
          <span class="me-2 small fw-semibold text-secondary">Filter by:</span>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-primary">FinTech</span>
            <span class="badge bg-secondary">CleanTech</span>
            <span class="badge bg-success">HealthTech</span>
            <span class="badge bg-warning text-dark">AgTech</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <div class="card border-primary">
          <div class="card-body d-flex align-items-center">
            <div class="p-3 bg-primary bg-opacity-25 rounded-circle me-3">
              <i class="fas fa-users text-primary"></i>
            </div>
            <div>
              <p class="mb-1 small fw-semibold text-primary">Total Startups</p>
              <h5 class="mb-0 fw-bold">4</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-success">
          <div class="card-body d-flex align-items-center">
            <div class="p-3 bg-success bg-opacity-25 rounded-circle me-3">
              <i class="fas fa-chart-pie text-success"></i>
            </div>
            <div>
              <p class="mb-1 small fw-semibold text-success">Industries</p>
              <h5 class="mb-0 fw-bold">4</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-warning">
          <div class="card-body d-flex align-items-center">
            <div class="p-3 bg-warning bg-opacity-25 rounded-circle me-3">
              <i class="fas fa-handshake text-warning"></i>
            </div>
            <div>
              <p class="mb-1 small fw-semibold text-warning">Your Connections</p>
              <h5 class="mb-0 fw-bold">0</h5>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Featured Startups -->
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0">Featured Startups</h5>
      </div>
      <div class="card-body">
        <div class="row g-4">

          <!-- Startup Card -->
          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="profile">
                  <div>
                    <h6 class="mb-0">Sarah Johnson</h6>
                    <small class="text-muted">TechWave AI</small>
                  </div>
                </div>
                <div class="mb-2">
                  <span class="badge bg-primary">FinTech</span>
                  <span class="badge bg-light text-dark">San Francisco, CA</span>
                  <span class="badge bg-warning text-dark">Founded 2021</span>
                </div>
                <p class="small text-muted">AI-powered financial analytics platform helping SMBs make data-driven
                  decisions.</p>
                <p class="mb-1"><strong>Funding Need:</strong> $1.5M</p>
                <p class="mb-1"><strong>Team Size:</strong> 12 people</p>
              </div>
              <div class="card-footer bg-white d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-outline-primary">Message</a>
                <a href="#" class="btn btn-sm btn-primary">View Profile</a>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <img id="profileimage" src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="profile">
                  <div>
                    <h6 class="mb-0">Sarah Johnson</h6>
                    <small class="text-muted">TechWave AI</small>
                  </div>
                </div>
                <div class="mb-2">
                  <span class="badge bg-primary">FinTech</span>
                  <span class="badge bg-light text-dark">San Francisco, CA</span>
                  <span class="badge bg-warning text-dark">Founded 2021</span>
                </div>
                <p class="small text-muted">AI-powered financial analytics platform helping SMBs make data-driven
                  decisions.</p>
                <p class="mb-1"><strong>Funding Need:</strong> $1.5M</p>
                <p class="mb-1"><strong>Team Size:</strong> 12 people</p>
              </div>
              <div class="card-footer bg-white d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-outline-primary">Message</a>
                <a href="#" class="btn btn-sm btn-primary">View Profile</a>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="profile">
                  <div>
                    <h6 class="mb-0">Sarah Johnson</h6>
                    <small class="text-muted">TechWave AI</small>
                  </div>
                </div>
                <div class="mb-2">
                  <span class="badge bg-primary">FinTech</span>
                  <span class="badge bg-light text-dark">San Francisco, CA</span>
                  <span class="badge bg-warning text-dark">Founded 2021</span>
                </div>
                <p class="small text-muted">AI-powered financial analytics platform helping SMBs make data-driven
                  decisions.</p>
                <p class="mb-1"><strong>Funding Need:</strong> $1.5M</p>
                <p class="mb-1"><strong>Team Size:</strong> 12 people</p>
              </div>
              <div class="card-footer bg-white d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-outline-primary">Message</a>
                <a href="#" class="btn btn-sm btn-primary">View Profile</a>
              </div>
            </div>
          </div>


          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="profile">
                  <div>
                    <h6 class="mb-0">Sarah Johnson</h6>
                    <small class="text-muted">TechWave AI</small>
                  </div>
                </div>
                <div class="mb-2">
                  <span class="badge bg-primary">FinTech</span>
                  <span class="badge bg-light text-dark">San Francisco, CA</span>
                  <span class="badge bg-warning text-dark">Founded 2021</span>
                </div>
                <p class="small text-muted">AI-powered financial analytics platform helping SMBs make data-driven
                  decisions.</p>
                <p class="mb-1"><strong>Funding Need:</strong> $1.5M</p>
                <p class="mb-1"><strong>Team Size:</strong> 12 people</p>
              </div>
              <div class="card-footer bg-white d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-outline-primary">Message</a>
                <a href="#" class="btn btn-sm btn-primary">View Profile</a>
              </div>
            </div>
          </div>

          <!-- end startups -->

        </div>
      </div>
    </div>
   </div>

    @push('scripts')

      <script>
       document.addEventListener("DOMContentLoaded", async function () {
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
             // console.log(response.data);
              id = response.data.id;
              //console.log(id);
            }

            const userprofile = await fetch(`/api/enterprenure/${id}`, {
              method: "POST",
              headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
              }
            })
            const result = await userprofile.json();
            //console.log(result);
            if (result.status && result.user) {
              const user = result.user;
              console.log(user);
            
             }
             
            }
            catch (error) {
            console.error('setting error', error);
          }

        });


       
      </script>
    @endpush
@endsection
</body>
</html>