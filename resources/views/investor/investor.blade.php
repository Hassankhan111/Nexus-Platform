@extends('layout.main')

@section('title','Invester Profile')

@section('main-content')
<style>
  .avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
  }
  .badge-sm {
    font-size: 0.8rem;
    padding: 0.25em 0.5em;
  }
</style>

<div class="container py-5">
  <!-- Profile Header -->
  <div class="card mb-4">
    <div class="card-body d-flex justify-content-between align-items-start flex-wrap">
      <div class="d-flex align-items-center">
        <img id="profileimage" src="https://via.placeholder.com/100" alt="Investor" class="avatar me-3">
        <div>
          <h2 class="h4 fw-bold mb-1" id="user_name">John Doe</h2>
          <p class="text-muted mb-2">
            <i class="bi bi-building"></i>
            Investor • <span id="totalInvestments">12</span> investments
          </p>
          <div id="badges">
            <span  id="location" class="badge bg-primary"><i class="bi bi-geo-alt"></i> San Francisco, CA</span>
            <span class="badge bg-secondary badge-sm">Seed</span>
            <span class="badge bg-secondary badge-sm">Series A</span>
          </div>
        </div>
      </div>
      <div class="mt-3 mt-sm-0">
        <button id="setting" class="btn btn-outline-primary me-2" id="messageBtn">
           <i class="bi bi-person-circle"></i> Edit Profile
        </button>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <!-- Left Column -->
    <div class="col-lg-8">
      <!-- About -->
      <div class="card mb-4">
        <div class="card-header fw-bold">About</div>
        <div class="card-body">
          <p id="bio">Experienced investor with a focus on technology startups.</p>
        </div>
      </div>

      <!-- Investment Interests -->
      <div class="card mb-4">
        <div class="card-header fw-bold">Investment Interests</div>
        <div class="card-body">
          <h6>Industries</h6>
          <div id="industries" class="mb-3">
            <span class="badge bg-primary">FinTech</span>
            <span class="badge bg-primary">HealthTech</span>
          </div>
          <h6>Investment Stages</h6>
          <div id="stages" class="mb-3">
            <span class="badge bg-secondary">Seed</span>
            <span class="badge bg-secondary">Series A</span>
          </div>
          <h6>Investment Criteria</h6>
          <ul class="text-muted" id="criteria">
            <li>Strong founding team with domain expertise</li>
            <li>Clear market opportunity</li>
            <li>Scalable business model</li>
            <li>Potential for significant growth</li>
          </ul>
        </div>
      </div>

      <!-- Portfolio Companies -->
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
          <span class="fw-bold">Portfolio Companies</span>
          <span class="text-muted" id="portfolioCount">3 companies</span>
        </div>
        <div class="card-body row g-3" id="portfolioCompanies">
          <div class="col-md-6">
            <div class="d-flex align-items-center border p-2 rounded">
              <div class="bg-light p-2 rounded me-2"><i class="bi bi-briefcase"></i></div>
              <div>
                <h6 class="mb-0">TechCorp</h6>
                <small class="text-muted">Invested in 2022</small>
              </div>
            </div>
          </div>
          <!-- More companies can be added here -->
        </div>
      </div>
    </div>

    <!-- Right Column -->
    <div class="col-lg-4">
      <!-- Investment Details -->
      <div class="card mb-4">
        <div class="card-header fw-bold">Investment Details</div>
        <div class="card-body">
          <p><small class="text-muted">Investment Range</small><br>
            <span class="fw-bold" id="investmentRange">$100K - $1M</span>
          </p>
          <p><small class="text-muted">Total Investments</small><br>
            <span id="investmentTotal">12 companies</span>
          </p>
          <p><small class="text-muted" id="year">Typical Investment Timeline</small><br>3-5 years</p>

          <!-- Investment Focus -->
          <hr>
          <h6>Investment Focus</h6>
          <div id="focus">
            <span class="badge bg-info text-dark">SaaS & B2B</span>
            <span class="badge bg-info text-dark">FinTech</span>
            <span class="badge bg-info text-dark">HealthTech</span>
          </div>
        </div>
      </div>

      <!-- Investment Stats -->
      <div class="card">
        <div class="card-header fw-bold">Investment Stats</div>
        <div class="card-body">
          <div class="border p-2 rounded mb-2 bg-light">
            <h6>Successful Exits</h6>
            <p class="fw-bold text-primary">4</p>
          </div>
          <div class="border p-2 rounded mb-2 bg-light">
            <h6>Avg. ROI</h6>
            <p class="fw-bold text-primary">3.2x</p>
          </div>
          <div class="border p-2 rounded bg-light">
            <h6>Active Investments</h6>
            <p class="fw-bold text-primary">8</p>
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
              console.log(response.data);
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
            console.log(result);
            if (result.status && result.profile) {
              const profiles = result.profile;
              //console.log(profiles);
              //------------------insert data to form feild ----------------------------------------------
              document.querySelector("#bio").innerText = profiles.bio;
              document.querySelector("#investmentTotal").innerText = profiles.investment_history;
              document.querySelector("#role").value = profiles.role;
              document.querySelector("#location").value = profiles.location;
              document.querySelector("#bio").value = profiles.bio;
              document.querySelector("#year").value = user.year;
            }

          }
          catch (error) {
            console.error('setting error', error);
          }
        });


      </script>
    @endpush

@endsection
