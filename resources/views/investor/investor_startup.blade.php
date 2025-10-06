@extends('layout.main')

@section('main-content')

  <body class="bg-light">

    <div class="container-fluid py-4">
      <div class="row">

        <!-- Sidebar Filters -->
        <div class="col-lg-3 mb-4">
          <div class="card shadow-sm">
            <div class="card-header bg-white">
              <h5 class="mb-0">Filters</h5>
            </div>
            <div class="card-body">

              <h6 class="fw-bold">Investment Stage</h6>
              <div class="d-flex flex-column gap-2 mb-3">
                <button class="btn btn-outline-secondary btn-sm">Seed</button>
                <button class="btn btn-outline-secondary btn-sm">Series A</button>
                <button class="btn btn-outline-secondary btn-sm">Series B</button>
              </div>

              <h6 class="fw-bold">Investment Interests</h6>
              <div class="d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark border">FinTech</span>
                <span class="badge bg-light text-dark border">SaaS</span>
                <span class="badge bg-light text-dark border">AI/ML</span>
                <span class="badge bg-light text-dark border">CleanTech</span>
                <span class="badge bg-light text-dark border">AgTech</span>
                <span class="badge bg-light text-dark border">HealthTech</span>
                <span class="badge bg-light text-dark border">Sustainability</span>
              </div>

              <h6 class="fw-bold">Location</h6>
              <div>
                <button class="btn btn-light w-100 mb-2 text-start"><i class="bi bi-geo-alt"></i> San Francisco,
                  CA</button>
                <button class="btn btn-light w-100 mb-2 text-start"><i class="bi bi-geo-alt"></i> New York, NY</button>
                <button class="btn btn-light w-100 text-start"><i class="bi bi-geo-alt"></i> Boston, MA</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <input type="text" id="investor_search" class="form-control me-3"
              placeholder="Search investors by name, interests, or keywords...">
             <span id="investor_data" class="text-muted">3 results</span>
          </div>
          <div id="investor_startup" class="row g-3">

            <!-- Investor Card 1 -->
            <div class="col-md-6">
              <div class="card shadow-sm h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Investor" class="rounded-circle me-3"
                      width="55" height="55">
                    <div>
                      <h5 class="mb-0">Michael Rodriguez</h5>
                      <small class="text-muted">Investor • 12 investments</small>
                    </div>
                  </div>

                  <div class="mb-2">
                    <span class="badge bg-success-subtle text-success border">Seed</span>
                    <span class="badge bg-success-subtle text-success border">Series A</span>
                  </div>

                  <p class="fw-bold mb-1 small">Investment Interests</p>
                  <div class="d-flex flex-wrap gap-2 mb-2">
                    <span class="badge bg-light text-dark border">FinTech</span>
                    <span class="badge bg-light text-dark border">SaaS</span>
                    <span class="badge bg-light text-dark border">AI/ML</span>
                  </div>

                  <p class="small text-muted mb-2">
                    Early-stage investor with focus on B2B SaaS and fintech. Previously founded and exited two startups.
                  </p>
                  <p class="fw-bold small mb-3">Investment Range: <span class="text-muted">$250K - $1.5M</span></p>

                  <div class="d-flex justify-content-between">
                    <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-chat-left-text"></i> Message</button>
                    <a href="#" class="btn btn-primary btn-sm">View Profile <i class="bi bi-box-arrow-up-right"></i></a>
                  </div>
                </div>
              </div>
            </div>

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

            const userprofile = await fetch(`/api/investor/${id}`, {
              method: "GET",
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

              const investor_startup = document.getElementById('investor_startup');
              investor_startup.innerHTML = "";

              // Check if startup data exists
              if (user && user.length > 0) {
                let html = "";

                user.forEach(function (data) {
                  html += ` <div class="col-md-6">
              <div class="card shadow-sm h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Investor" class="rounded-circle me-3" width="55" height="55">
                    <div>
                      <h5 class="mb-0">${data.inv_name || 'N/A'}</h5>
                      <small class="text-muted">Investor • ${data.inv_teamsize} investments</small>
                    </div>
                  </div>

                  <div class="mb-2">
                    <span class="badge bg-success-subtle text-success border">Seed</span>
                    <span class="badge bg-success-subtle text-success border">Series A</span>
                  </div>

                  <p class="fw-bold mb-1 small">Investment Interests</p>
                  <div class="d-flex flex-wrap gap-2 mb-2">
                    <span class="badge bg-light text-dark border">FinTech</span>
                    <span class="badge bg-light text-dark border">SaaS</span>
                    <span class="badge bg-light text-dark border">AI/ML</span>
                  </div>

                  <p class="small text-muted mb-2">
                   ${data.pitch_summ}
                  </p>
                  <p class="fw-bold small mb-3">Investment Range: <span class="text-muted">$${data.funding_ned || '—'}}5M</span></p>

                  <div class="d-flex justify-content-between">
                    <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-chat-left-text"></i> Message</button>
                    <a href="#" class="btn btn-primary btn-sm">View Profile <i class="bi bi-box-arrow-up-right"></i></a>
                  </div>
                </div>
              </div>
            </div>`;
                });
                investor_startup.innerHTML = html;
              } else {
                investor_startup.innerHTML = `<p class="text-muted">No startup data available.</p>`;
              }
            }
          }
          catch (error) {
            console.error('setting error', error);
          }



// serch investor---------------------------------------------------------------------------------------------------
//search
           document.querySelector('#investor_search').addEventListener('keyup', function () {
            const token = localStorage.getItem("api_token");
          if (!token) {
            window.location.href = "/";
            return;
          }

            const searchValue = this.value; 
            console.log(searchValue);

              fetch(`/api/investor_search?search=${encodeURIComponent(searchValue)}`, {
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
               const investor_data = document.getElementById('investor_data');
              investor_data.innerHTML = "";

              // Check if startup data exists
              if (startups && startups.length > 0) {
                let html = "";

                startups.forEach(function (serch) {
                  html += ` <div class="col-md-6">
              <div class="card shadow-sm h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Investor" class="rounded-circle me-3" width="55" height="55">
                    <div>
                      <h5 class="mb-0">${serch.inv_name || 'N/A'}</h5>
                      <small class="text-muted">Investor • ${serch.inv_teamsize} investments</small>
                    </div>
                  </div>

                  <div class="mb-2">
                    <span class="badge bg-success-subtle text-success border">Seed</span>
                    <span class="badge bg-success-subtle text-success border">Series A</span>
                  </div>

                  <p class="fw-bold mb-1 small">Investment Interests</p>
                  <div class="d-flex flex-wrap gap-2 mb-2">
                    <span class="badge bg-light text-dark border">FinTech</span>
                    <span class="badge bg-light text-dark border">SaaS</span>
                    <span class="badge bg-light text-dark border">AI/ML</span>
                  </div>

                  <p class="small text-muted mb-2">
                   ${serch.pitch_summ}
                  </p>
                  <p class="fw-bold small mb-3">Investment Range: <span class="text-muted">$${serch.funding_ned || '—'}}5M</span></p>

                  <div class="d-flex justify-content-between">
                    <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-chat-left-text"></i> Message</button>
                    <a href="#" class="btn btn-primary btn-sm">View Profile <i class="bi bi-box-arrow-up-right"></i></a>
                  </div>
                </div>
              </div>
            </div>`;
                });
                investor_data.innerHTML = html;
              } else {
                investor_data.innerHTML = `<p class="text-muted">No startup data Found.</p>`;
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