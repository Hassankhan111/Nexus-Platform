@extends('layout.main')

@section('title', 'Profile')

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

  <div class="container py-5">
    <!-- Profile Header -->
    <div class="card mb-4">
      <div class="card-body d-flex justify-content-between align-items-start flex-wrap">
        <div class="d-flex align-items-center">
          <img id="inv_image" src="https://via.placeholder.com/100" alt="Investor" class="profile-img avatar me-3">
          <div>
            <h2 class="h4 fw-bold mb-1" id="name">John Doe</h2>
            <p class="text-muted mb-2">
              <i class="bi bi-building"></i>
              Investor • <span id="Invest">12</span> investments
            </p>
            <div id="badges">
              <span id="loc" class="badge bg-primary"><i class="bi bi-geo-alt"></i> San Francisco, CA</span>
              <span class="badge bg-secondary badge-sm">Seed</span>
              <span class="badge bg-secondary badge-sm">Series A</span>
            </div>
          </div>
        </div>
        <div class="mt-3 mt-sm-0">
          <button id="addinvestor_btn" class="btn btn-outline-primary me-2">
            <i class="bi bi-person-circle"></i> Add Profile
          </button>
          <button id="updateinvestor_btn" class="btn btn-outline-primary me-2">
            <i class="bi bi-person-circle"></i> update Profile
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
            <p id="inv_startup">Experienced investor with a focus on technology startups.</p>
          </div>
        </div>

        <!-- Investment Interests -->
        <div class="card mb-4">
          <div class="card-header fw-bold">Investment Interests</div>
          <div class="card-body">
            <h6>Industries</h6>
            <div id="indus" class="mb-3">
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
@endsection
@push('scripts')
    <!-- Main page logic for investor-->
   <script src="{{ asset('assets/js/investor.js') }}"></script>
@endpush