@extends('layout.main')

@section('main-content')

  <style>
    body {
      background: #f8f9fa;
    }
    .profile-card {
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
    }
    .badge-custom {
      font-size: 0.8rem;
      margin-right: 5px;
    }
  </style>
</head>
<body>
<div class="container py-4">

  <!-- Profile Header -->
  <div class="card mb-4">
    <div class="card-body d-flex justify-content-between align-items-start flex-wrap">
      <div class="d-flex align-items-center">
        <img id="profileimage" src="https://via.placeholder.com/100" alt="Investor" class="avatar me-3">
        <div>
          <h2 class="h4 fw-bold mb-1" id="user_name">John Doe</h2>
          <p class="text-muted mb-2">
            <i class="bi bi-building"></i>
            entrepreneur • <span id="totalInvestments">12</span> investments
          </p>
          <div id="badges">
            <span class="badge bg-primary"  id="location"><i class="bi bi-geo-alt"></i> San Francisco, CA</span>
            <span class="badge bg-secondary badge-sm">Seed</span>
            <span class="badge bg-secondary badge-sm">Series A</span>
          </div>
        </div>
      </div>
      <div class="mt-3 mt-sm-0">
        <button id="setting" class="btn btn-outline-primary me-2">
           <i class="bi bi-person-circle"></i> Edit Profile
        </button>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Left Column -->
    <div class="col-lg-8">
      <!-- About -->
      <div class="card mb-3">
        <div class="card-header">About</div>
        <div class="card-body">
          <p id="bio">Entrepreneur passionate about solving fintech problems with AI/ML innovations.</p>
        </div>
      </div>

      <!-- Startup Overview -->
      <div class="card mb-3">
        <div class="card-header">Startup Overview</div>
        <div class="card-body">
          <h6>Problem Statement</h6>
          <p>FinTech businesses face issues with secure transactions.</p>

          <h6>Solution</h6>
          <p>We provide AI-driven fraud detection for real-time payments.</p>

          <h6>Market Opportunity</h6>
          <p>The FinTech market is growing at a CAGR of 14.5%.</p>

          <h6>Competitive Advantage</h6>
          <p>Unique approach combining AI + domain expertise.</p>
        </div>
      </div>

      <!-- Team -->
      <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
          <span>Team</span>
          <span class="text-muted" id="team-count">5 members</span>
        </div>
        <div class="card-body row g-3">
          <div class="col-md-6 d-flex align-items-center border rounded p-2">
            <img src="https://via.placeholder.com/40" class="rounded-circle me-2">
            <div>
              <strong>John Doe</strong><br>
              <small class="text-muted">Founder & CEO</small>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-center border rounded p-2">
            <img src="https://via.placeholder.com/40" class="rounded-circle me-2">
            <div>
              <strong>Alex Johnson</strong><br>
              <small class="text-muted">CTO</small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Column -->
    <div class="col-lg-4">
      <!-- Funding -->
      <div class="card mb-3">
        <div class="card-header">Funding</div>
        <div class="card-body">
          <p><strong>Current Round:</strong> $1.2M</p>
          <p><strong>Valuation:</strong> $8M - $12M</p>
          <p><strong>Previous Funding:</strong> $750K Seed (2022)</p>
          <hr>
          <p><strong>Funding Timeline</strong></p>
          <ul>
            <li>Pre-seed ✅ Completed</li>
            <li>Seed ✅ Completed</li>
            <li>Series A ⏳ In Progress</li>
          </ul>
        </div>
      </div>

      <!-- Documents -->
      <div class="card mb-3">
        <div class="card-header">Documents</div>
        <div class="card-body">
          <div class="d-flex justify-content-between border rounded p-2 mb-2">
            <span>Pitch Deck</span>
            <button class="btn btn-sm btn-outline-primary">View</button>
          </div>
          <div class="d-flex justify-content-between border rounded p-2 mb-2">
            <span>Business Plan</span>
            <button class="btn btn-sm btn-outline-primary">View</button>
          </div>
          <div class="d-flex justify-content-between border rounded p-2">
            <span>Financial Projections</span>
            <button class="btn btn-sm btn-outline-primary">View</button>
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

            const userprofile = await fetch(`/api/profile/${id}`, {
              method: "POST",
              headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
              }
            })
            const result = await userprofile.json();
            //console.log(result);
            if (result.status && result.profile) {
              const profiles = result.profile;
              //console.log(profiles);
              //------------------insert data to form feild ----------------------------------------------
              document.querySelector("#bio").value = profiles.name;
              document.querySelector("#email").value = profiles.email;
              document.querySelector("#role").value = profiles.role;
              document.querySelector("#location").value = profiles.location;
              document.querySelector("#bio").value = profiles.bio;
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
