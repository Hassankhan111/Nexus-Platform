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
        <img id="profile_image" src="https://via.placeholder.com/100" alt="Investor" class="profile rounded-circle me-2"
                width="80" height="80">
        <div>
          <h2 class="h4 fw-bold mb-1" id="user_name">John Doe</h2>
          <p class="text-muted mb-2">
            <i class="bi bi-building"></i>
            <span id="industry_name">entrepreneur •</span> <span id="totalInvestments">12</span> investments
          </p>
          <div id="badges">
            <span class="badge bg-primary"  id="location"><i class="bi bi-geo-alt"></i> San Francisco, CA</span>
            <span class="badge bg-secondary badge-sm">Seed</span>
            <span class="badge bg-secondary badge-sm">Series A</span>
          </div>
        </div>
      </div>
      <div class="mt-3 mt-sm-0">
        <button id="add-profile" class="btn btn-outline-primary me-2">
           <i class="bi bi-person-circle"></i> Add profile
        </button>
        <button id="update-profile" class="btn btn-outline-primary me-2">
           <i class="bi bi-person-circle"></i> update Profile
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
        <div class="card-body" id="fetchsummery">
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
@endsection


@push('scripts')
  <!-- Main page logic for entreprenure portfolio add, uppdate, and show  -->
 <script src="{{ asset('assets/js/entreprenure.js') }}"></script>
@endpush