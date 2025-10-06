@extends('layout.main')

@section('main-content')
<!-- Welcome -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 m-4">
    <div class="mb-3 mb-md-0">
        <h2 class="fw-bold">Welcome, Michael Rodriguez</h2>
        <p class="text-muted mb-0">Here's what's happening with your startup today</p>
    </div>
    <a href="#" class="btn btn-primary">
        <i class="fas fa-plus-circle me-2"></i> Find Investors
    </a>
</div>

 <!-- Stats Cards -->
    <div class="row g-3 mb-4">
      <div class="col-md-3">
        <div class="card border-primary">
          <div class="card-body d-flex align-items-center">
            <div class="p-3 bg-primary bg-opacity-25 rounded-circle me-3">
                 <i class="fas fa-bell text-primary fa-2x"></i>
            </div>
            <div>
              <p class="fw-semibold text-primary mt-2 mb-1">Pending Requests</p>
              <h5 class="mb-0 fw-bold">4</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card border-success">
          <div class="card-body d-flex align-items-center">
            <div class="p-3 bg-success bg-opacity-25 rounded-circle me-3">
                <i class="fas fa-users text-success fa-2x"></i>
            </div>
            <div>
               <p class="fw-semibold text-success mt-2 mb-1">Total Connections</p>
              <h5 class="mb-0 fw-bold">4</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card border-warning">
          <div class="card-body d-flex align-items-center">
            <div class="p-3 bg-warning bg-opacity-25 rounded-circle me-3">
                  <i class="fas fa-calendar-alt text-warning fa-2x"></i>
            </div>
            <div>
                <p class="fw-semibold text-warning mt-2 mb-1">Upcoming Meetings</p>
              <h5 class="mb-0 fw-bold">0</h5>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card border-warning">
          <div class="card-body d-flex align-items-center">
            <div class="p-3 bg-warning bg-opacity-25 rounded-circle me-3">
                    <i class="fas fa-eye text-info fa-2x"></i>
            </div>
            <div>
                  <p class="fw-semibold text-info mt-2 mb-1">Profile Views</p>
              <h5 class="mb-0 fw-bold">0</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
<div class="row g-4">
    <!-- Collaboration Requests -->
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <h6 class="mb-0">Collaboration Requests</h6>
                <span class="badge bg-primary">0 pending</span>
            </div>
            <div class="card-body text-center text-muted">
                <div class="mb-3">
                    <i class="fas fa-info-circle fs-2"></i>
                </div>
                <p class="mb-1">No collaboration requests yet</p>
                <small>When investors are interested in your startup, their requests will appear here</small>
            </div>
        </div>
    </div>

    <!-- Recommended Investors -->
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <h6 class="mb-0">Recommended Investors</h6>
                <a href="#" class="small">View all</a>
            </div>
            <div class="card-body">

                <!-- Investor Card (Repeatable) -->
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <!-- Profile Section -->
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3"
                                alt="Investor Photo">
                            <div>
                                <h5 class="mb-0">Michael Rodriguez</h5>
                                <small class="text-muted">Investor • 12 investments</small>
                            </div>
                        </div>

                        <!-- Tags (Rounds) -->
                        <div class="mb-3">
                            <span class="badge bg-success me-1">Seed</span>
                            <span class="badge bg-info text-dark">Series A</span>
                        </div>

                        <!-- Interests -->
                        <p class="fw-bold mb-1">Investment Interests</p>
                        <div class="mb-3">
                            <span class="badge bg-primary me-1">FinTech</span>
                            <span class="badge bg-secondary me-1">SaaS</span>
                            <span class="badge bg-warning text-dark">AI/ML</span>
                        </div>

                        <!-- Description -->
                        <p class="text-muted small">
                            Early-stage investor with focus on B2B SaaS and fintech. Previously founded and exited
                            two startups.
                        </p>

                        <!-- Investment Range -->
                        <p class="fw-bold mb-0">Investment Range</p>
                        <p class="text-muted">$250K – $1.5M</p>
                    </div>
                </div>
                <!-- End Investor Card -->

            </div>
        </div>
    </div>
</div>
@endsection