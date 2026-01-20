@extends('layout.main')
 @section('title','seetings')
  @section('main-content')
    <div class="container py-5">
      <h1 class="mb-2 fw-semibold" style="font-size:30px;">Settings</h1>
      <p class="text-muted mb-4">Manage your account preferences and settings</p>
      <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-lg-3 mb-4">
          <div class="list-group settings-nav">
            <button  class="list-group-item list-group-item-action active">
              <i class="bi bi-person-circle"></i> Profile
            </button>
            <button id="addseeting_profile" class="list-group-item list-group-item-action">
              <i class="bi bi-person-circle"></i> Add Profile
            </button>
            <button id="updateseeting_profile" class="list-group-item list-group-item-action">
            <i class="bi bi-person-circle"></i> Update Profile
            </button>
            <button class="list-group-item list-group-item-action">
              <i class="fa fa-bell me-2"></i> Notifications
            </button>
            <button class="list-group-item list-group-item-action">
              <i class="fa fa-globe me-2"></i> Language
            </button>
            <button class="list-group-item list-group-item-action">
              <i class="fa fa-palette me-2"></i> Appearance
            </button>
            <button id="billings" class="list-group-item list-group-item-action">
              <i class="fa fa-credit-card me-2"></i> Billing
            </button>
            
            <button id="showbillings" class="list-group-item list-group-item-action">
              <i class="fa fa-credit-card me-2"></i> Show Billing
            </button>
          </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
          <!-- Profile Settings -->
          <div class="card mb-4">
            <div class="card-header">
              <h5 class="mb-0">Profile Settings</h5>
            </div>
            <div class="card-body">
              <div class="d-flex align-items-center mb-4">
                <!-- Profile image -->
                <div class="d-flex align-items-center mb-4">
                  <!-- Profile image -->
                  <img id="profileimage" src="https://via.placeholder.com/80" alt="Avatar"
                    class="rounded float-left"
                    style="width:120px; height:120px; object-fit:cover;">
                </div>
              </div>
              <form id="profileForm" class="add-form">
                <div class="row mb-3">
                  <div class="col-md-6">
                      <!--<input type="file" class="img form-control" id="fullName" value="John Doe">-->
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" value="">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" value="">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" value="" disabled>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Location</label>
                    <input type="text" class="Location form-control" id="location" value="" disabled>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Bio</label>
                  <textarea class="Bio form-control" rows="4" id="bio" value=""disabled>Short description about yourself...</textarea>
                </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
          <!-- Security Settings -->
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">Security Settings</h5>
            </div>
            <div class="card-body">
              <h6>Two-Factor Authentication</h6>
              <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                  <p class="text-muted mb-1">Add an extra layer of security to your account</p>
                  <span class="badge bg-danger">Not Enabled</span>
                </div>
                <button class="btn btn-outline-primary btn-sm">Enable</button>
              </div>

              <hr>

              <h6>Change Password</h6>
              <form id="passwordForm">
                <div class="mb-3">
                  <label class="form-label">Current Password</label>
                  <input type="password" class="form-control" id="currentPassword">
                </div>
                <div class="mb-3">
                  <label class="form-label">New Password</label>
                  <input type="password" class="form-control" id="newPassword">
                </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  @endsection