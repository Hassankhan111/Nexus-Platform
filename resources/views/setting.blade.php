@extends('layout.main')
<style>
  .settings-nav .btn.active {
    background-color: #e9f5ff;
    color: #0d6efd;
  }

  .avatar-lg {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
  }
</style>
</head>

<body>
  @section('main-content')
    <div class="container py-5">
      <h1 class="mb-2 fw-semibold" style="font-size:30px;">Settings</h1>
      <p class="text-muted mb-4">Manage your account preferences and settings</p>

      <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-lg-3 mb-4">
          <div class="list-group settings-nav">
            <button class="list-group-item list-group-item-action active">
              <i class="fa fa-user me-2"></i> Profile
            </button>
            <button class="list-group-item list-group-item-action">
              <i class="fa fa-lock me-2"></i> Security
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
            <button class="list-group-item list-group-item-action">
              <i class="fa fa-credit-card me-2"></i> Billing
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
                    class="rounded-circle border shadow avatar-lg me-3"
                    style="width:80px; height:80px; object-fit:cover;">

                  <div>
                    <!-- Change Photo button linked to file input -->
                    <label for="profileImageInput" class="btn btn-outline-primary btn-sm mb-0">
                      <i class="bi bi-upload"></i> Change Photo
                    </label>
                    <input type="file" id="profileImageInput" name="image" accept="image/*" class="d-none">

                    <p class="text-muted small mt-2">JPG, GIF or PNG. Max size of 800K</p>
                  </div>
                </div>

              </div>


              <form id="profileForm">
                <div class="row mb-3">
                  <div class="col-md-6">

                    <!--<input type="file" class="img form-control" id="fullName" value="John Doe">-->

                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" value="John Doe">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" value="john@example.com">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" value="Investor" disabled>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Location</label>
                    <input type="text" class="Location form-control" id="location" value="San Francisco, CA">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Bio</label>
                  <textarea class="form-control" rows="4" id="bio">Short description about yourself...</textarea>
                </div>

                <div class="text-end">
                  <button type="reset" class="btn btn-outline-secondary">Cancel</button>
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
                <div class="mb-3">
                  <label class="form-label">Confirm New Password</label>
                  <input type="password" class="form-control" id="confirmPassword">
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
    @push('scripts')

      <script>
        // -----------------change photo event---------------------------------------------------------- 
        document.getElementById('profileImageInput').addEventListener('change', function (event) {
          const file = event.target.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
              document.getElementById('profileimage').src = e.target.result;
            }
            reader.readAsDataURL(file);
          }
        });

        //-----------------------get user id--------------------------------------------------------
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
              //console.log(response.data);
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
              //------------------show user data ----------------------------------------------
              document.querySelector("#fullName").value = profiles.name;
              document.querySelector("#email").value = profiles.email;
              document.querySelector("#location").value = profiles.location;
              document.querySelector("#bio").value = profiles.bio;
            }
          } catch (error) {
            console.error('setting error', error);
          }


          //--------------------------update user data--------------------------------
          document.getElementById('profileForm').addEventListener("submit", async function (e) {
            e.preventDefault();

            const token = localStorage.getItem("api_token");

            const name = document.querySelector('#fullName').value;
            const email = document.querySelector('#email').value;
            const location = document.querySelector('#location').value;
            const bio = document.querySelector('#bio').value;
               const role = document.querySelector('#role').value;

            //console.log(name + email+role+location+bio+role);

            formdata = new FormData();

            formdata.append('name', name);
            formdata.append('email', email);
            formdata.append('location', location);
            formdata.append('bio', bio);
             formdata.append('role', role);

             if(document.querySelector('#profileImageInput').files.length > 0){
              const img = document.querySelector('#profileImageInput').files[0];
                formdata.append('image', img);
            }
          
            try {
              const response = await fetch(`/api/update/${id}`, {
                method: 'POST',
                headers: {
                  'Authorization': `Bearer ${token}`,
                  //'X-HTTP-Method-Override' : 'PUT',
                  'Accept': 'application/json',
                },
                body: formdata
              });
              const res = await response.json();
               console.log(res);
              if (res.status) {
                alert("Profile updated successfully!");

                // Update profile image immediately
                if (res.profile.image) {
                  document.getElementById("profileimage").src = "/storage/" + res.profile.image;
                }
              } else {
                alert("Update failed: " + res.message);
              }
            } catch (error) {
              console.error('Profile update error', error);
            }
          });




        });



      </script>
    @endpush

  @endsection