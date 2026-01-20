@extends('layout.main')
@section('title','update')
@section('main-content')


  <div class="container py-5">
    <h1 class="mb-2 fw-semibold" style="font-size:30px;">Update Portfolio</h1>
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
                <img id="updateimage" src="https://via.placeholder.com/80" alt="Avatar"
                  class="rounded-circle border shadow avatar-lg me-3" style="width:80px; height:80px; object-fit:cover;">

                <div>
                  <!-- Change Photo button linked to file input -->
                  <label for="ImageInput" class="btn btn-outline-primary btn-sm mb-0">
                    <i class="bi bi-upload"></i> Change Photo
                  </label>
                  <input type="file" id="ImageInput" name="image" accept="image/*" class="d-none">

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
              <form id="updatestartup">
                <div class="row mb-3">
                  <div class="mb-3">
                    <label class="form-label">Startup Name</label>
                    <input type="text" class="startup_name form-control" id="name" rows="4"
                     value="">
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Funding Need</label>
                    <input type="number" class="funding_need form-control" id="fneed"
                      value="">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Company Name</label>
                    <input type="text" class="company_name form-control" id="company" value="">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-6">
                    <label class="form-label">Loation</label>
                    <input type="text" class="location form-control" id="loc" value="">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Investment Industry</label>
                    <input type="text" class="investment_indistry form-control" id="indistry" value="">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-6">
                    <label class="form-label">Founded Years ($)</label>
                    <input type="number" class="funding_year form-control" id="year" value="">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Time Size</label>
                    <input type="number" class="time_size form-control" id="timesize" value="">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Startup Summary</label>
                  <textarea class="summary form-control" id="summ" rows="4"
                    value=""></textarea>
                </div>

                <div class="text-end">
                  <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
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