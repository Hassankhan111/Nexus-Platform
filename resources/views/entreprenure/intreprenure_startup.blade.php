@extends('layout.main')
@section('main-content')

  <style>
    body {
      background-color: #f8f9fa;
    }

    .filter-section h6 {
      font-weight: 600;
      margin-top: 20px;
    }

    .card-startup {
      border-radius: 12px;
      border: 1px solid #e0e0e0;
    }

    .tag {
      font-size: 0.75rem;
      margin-right: 6px;
    }

    .btn-view {
      background-color: #0d6efd;
      color: white;
    }

    .btn-view:hover {
      background-color: #084298;
    }
  </style>
  </head>


  <body>
    <div class="container-fluid py-4">
      <!-- Header -->
      <div class="mb-4">
        <h1 class="h3 fw-bold">Find Entreprenure</h1>
        <p class="text-muted">Connect with entreprenure who match your startup's needs</p>
      </div>
      <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
          <div class="card shadow-sm p-3">
            <h5 class="mb-3">Filters</h5>
            <div class="filter-section">
              <h6>Industry</h6>
              <ul class="list-unstyled">
                <li><a href="#" class="filter-link">FinTech</a></li>
                <li><a href="#" class="filter-link">CleanTech</a></li>
                <li><a href="#" class="filter-link">HealthTech</a></li>
                <li><a href="#" class="filter-link">AgTech</a></li>
              </ul>
            </div>
            <div class="filter-section">
              <h6>Funding Range</h6>
              <ul class="list-unstyled">
                <li><a href="#" class="filter-link">&lt; $500K</a></li>
                <li><a href="#" class="filter-link">$500K - $1M</a></li>
                <li><a href="#" class="filter-link">$1M - $5M</a></li>
                <li><a href="#" class="filter-link">&gt; $5M</a></li>
              </ul>
            </div>
            <div class="filter-section">
              <h6>Location</h6>
              <ul class="list-unstyled">
                <li><a href="#" class="filter-link">San Francisco, CA</a></li>
                <li><a href="#" class="filter-link">New York, NY</a></li>
                <li><a href="#" class="filter-link">Boston, MA</a></li>
                <li><a href="#" class="filter-link">Chicago, IL</a></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
          <div class="d-flex align-items-center mb-3">
            <input type="text" id="entreprnure_search" class="form-control me-3" placeholder="Search startups by name, industry, or keywords...">
            <span class="entreprenure_data text-muted">4 results</span>
          </div>

          <div id="startup_profile" class="row g-3">
            <!-- Startup Card -->
           
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
              //get startup data 

              const startup_profile = document.getElementById('startup_profile');
              startup_profile.innerHTML = "";

              // Check if startup data exists
              if (user && user.length > 0) {
                let html = "";

                user.forEach(function (data) {
                  html += `
                        <div class="col-md-6">
                          <div class="card card-startup p-3 shadow-sm">
                            <div class="d-flex align-items-center mb-2">
                              <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Founder">
                              <div>
                                <h6 class="mb-0 fw-bold">${data.startup_name}</h6>
                                <small class="text-muted">${data.company_name}</small>
                              </div>
                            </div>
                            <div class="mb-2">
                              <span class="badge bg-primary">${data.industry_name || 'N/A'}</span>
                              <span class="badge bg-light text-dark"><i class="bi bi-geo-alt"></i> ${data.location || 'Unknown'}</span>
                              <span class="badge bg-warning text-dark">Founded ${data.founded_year || '—'}</span>
                            </div>
                            <p class="small">${data.pitch_summary || ''}</p>
                            <div class="d-flex justify-content-between">
                              <small><strong>Funding Need:</strong> ${data.funding_need || '—'}</small>
                              <small><strong>Team Size:</strong> ${data.team_size || '—'}</small>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                              <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-chat"></i> Message</button>
                              <button class="btn btn-view btn-sm"><i class="bi bi-box-arrow-up-right"></i> View Profile</button>
                            </div>
                          </div>
                        </div>`;
                });
                 startup_profile.innerHTML = html;
              } else {
                 startup_profile.innerHTML = `<p class="text-muted">No startup data available.</p>`;
                }
              }
              
            }
             catch (error) {
              console.error('setting error', error);
            }



            // serch investor---------------------------------------------------------------------------------------------------
//search
           document.querySelector('#entreprnure_search').addEventListener('keyup', function () {
            const token = localStorage.getItem("api_token");
          if (!token) {
            window.location.href = "/";
            return;
          }

            const searchValue = this.value; 
            console.log(searchValue);

              fetch(`/api/entreprenure_search?search=${encodeURIComponent(searchValue)}`, {
              method: "GET",
              headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
              }
            })
            .then(response => response.json())
            .then(data => {
            console.log(data);
            if (data.status && data.user) {
              const startups = data.user;
              //console.log(startups);
               const entreprenure_data = document.querySelector('.entreprenure_data');
              entreprenure_data.innerHTML = "";

              // Check if startup data exists
              if (startups && startups.length > 0) {
                let html = "";

                startups.forEach(function (serch) {
                  html += `<div class="col-md-6">
                          <div class="card card-startup p-3 shadow-sm">
                            <div class="d-flex align-items-center mb-2">
                              <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Founder">
                              <div>
                                <h6 class="mb-0 fw-bold">${data.startup_name}</h6>
                                <small class="text-muted">${data.company_name}</small>
                              </div>
                            </div>
                            <div class="mb-2">
                              <span class="badge bg-primary">${data.industry_name || 'N/A'}</span>
                              <span class="badge bg-light text-dark"><i class="bi bi-geo-alt"></i> ${data.location || 'Unknown'}</span>
                              <span class="badge bg-warning text-dark">Founded ${data.founded_year || '—'}</span>
                            </div>
                            <p class="small">${data.pitch_summary || ''}</p>
                            <div class="d-flex justify-content-between">
                              <small><strong>Funding Need:</strong> ${data.funding_need || '—'}</small>
                              <small><strong>Team Size:</strong> ${data.team_size || '—'}</small>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                              <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-chat"></i> Message</button>
                              <button class="btn btn-view btn-sm"><i class="bi bi-box-arrow-up-right"></i> View Profile</button>
                            </div>
                          </div>
                        </div>`;
                  
                });
                entreprenure_data.innerHTML = html;
              } else {
                entreprenure_data.innerHTML = `<p class="text-muted">No startup data Found.</p>`;
            }
          }
           });

          });


          });



      </script>
    @endpush
@endsection
</body>

</html>