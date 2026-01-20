@extends('layout.main')

@section('main-content')
  <style>
    .settings-nav .btn.active {
      background-color: #e9f5ff;
      color: #0d6efd;
    }

    .avatar-lg {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
    }

    .card {
      border-radius: 15px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .form-section {
      margin-bottom: 2rem;
    }

    .section-title {
      font-weight: 600;
      font-size: 18px;
      color: #0d6efd;
      margin-bottom: 15px;
    }
  </style>

  <div class="container py-5">
    <h1 class="mb-2 fw-semibold" style="font-size:30px;">Add Portfolio</h1>
    <p class="text-muted mb-4">Manage your account preferences and settings</p>
    <div class="row">
      <div class="col-lg-12">
        <!-- 1️⃣ USER INFORMATION -->
        <div class="card mb-4">
          <div class="card-header bg-light">
            <h5 class="mb-0 fw-semibold">User Information</h5>
          </div>
          <div class="card-body">
            <div class="d-flex align-items-center mb-4">
              <!-- Profile image -->
              <div class="d-flex align-items-center mb-4">
                <!-- Profile image -->
                <img id="addimage" src="https://via.placeholder.com/80" alt="Avatar"
                  class="rounded-circle border shadow avatar-lg me-3" style="width:80px; height:80px; object-fit:cover;">

                <div>
                  <!-- Change Photo button linked to file input -->
                  <label for="profileImageInput" class="btn btn-outline-primary btn-sm mb-0">
                    <i class="bi bi-upload"></i> Add Photo
                  </label>
                  <input type="file" id="profileImageInput" name="image" accept="image/*" class="d-none">

                  <p class="text-muted small mt-2">JPG, GIF or PNG. Max size of 800K</p>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" placeholder="Enter your full name" disabled>
              </div>
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" disabled>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-12">
                <label class="form-label">Role</label>
                <input type="text" class="form-control" id="role" value="enter role" disabled>
              </div>
            </div>
          </div>
        </div>
        <!-- 3️⃣ STARTUP INFORMATION -->
        <div class="card mb-4">
          <div class="card-header bg-light">
            <h5 class="mb-0 fw-semibold">Startup Information</h5>
          </div>
          <div class="card-body">
            <form id="startup">
              <div class="row mb-3">
                <div class="mb-3">
                  <label class="form-label">Startup Name</label>
                  <input type="text" class="form-control" id="startup_name" rows="4"
                    placeholder="Enter your startup name">
                </div>

                <div class="col-md-6">
                  <label class="form-label">Funding Need</label>
                  <input type="number" class="form-control" id="funding_need"
                    placeholder="Enter your funding need e,g 4000 name">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Company Name</label>
                  <input type="text" class="form-control" id="company_name" placeholder="e.g., FinTech, E-commerce">
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label">Loation</label>
                  <input type="text" class="form-control" id="location" placeholder="e.g. islmbad ">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Investment Company</label>
                  <input type="text" class="form-control" id="investment_company" placeholder="Company or partner name">
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label">Founded Years ($)</label>
                  <input type="number" class="form-control" id="funding_year" placeholder="e.g. 2012">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Time Size</label>
                  <input type="number" class="form-control" id="time_size" placeholder="Time Size e.g. 1,2,3">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Startup Summary</label>
                <textarea class="form-control" id="summary" rows="4"
                  placeholder="Describe your startup idea, mission, and vision..."></textarea>
              </div>

              <div class="text-end">
                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <!-- Main page logic -->
  <script src="{{ asset('assets/js/entreprenure.js') }}"></script>
@endpush