@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content wrapper -->
 



          <div class="content-wrapper">
                  @if(session('success'))
                   <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 99999;">
                    <div id="liveToast" class="toast align-items-center text-bg-success border-0 bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                      <div class="d-flex">
                        <div class="toast-body">
                          {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                    </div>
                  </div>
                  @endif
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> My Profile</h4>

              <div class="row">
                <div class="col-md-12">
                 
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                <form method="POST" action="{{ route('store.profile') }}" enctype="multipart/form-data">
                  @csrf
                  <!-- @method('patch') -->

                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="{{ (!empty($adminData->profile_image)? url('upload/admin_images/'.$adminData->profile_image) : url('upload/no_image.jpg')) }}"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="showImage"
                        />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              name="profile_image"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label>
                          <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                          </button>

                          <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                     

                        <div class="row">

                          <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="name"
                              name="name"
                              value="{{ old('Name', $adminData->name ?? '') }}"
                              autofocus
                            />
                          </div>

                          <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control" type="text" id="username" name="username"  value="{{ old('Username', $adminData->username ?? '' )}}" />
                          </div>

                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="{{ old("Email", $adminData->email ?? '') }}"
                              placeholder="john.doe@example.com"
                            />
                          </div>

                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                </form>
                    </div>
                    <!-- /Account -->
                  </div>

                  <div class="card mb-4">
                    <h5 class="card-header">Profile Password</h5>
                    <!-- Password -->
                    
                    
                    <div class="card-body">
                      <form method="POST" action="">
                        @csrf
                        @method('patch')

                        <div class="row">

                          <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Old Password </label>
                            <input
                              class="form-control"
                              type="password"
                              id="name"
                              name="name"
                              autofocus
                            />
                          </div>

                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">New Password </label>
                            <input class="form-control" type="text" name="lastName" id="lastName"  />
                          </div>


                        
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div> 
                  
                  <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                      <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                          <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                          <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                      </div>
                      <form id="formAccountDeactivation" onsubmit="return false">
                        <div class="form-check mb-3">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            name="accountActivation"
                            id="accountActivation"
                          />
                          <label class="form-check-label" for="accountActivation"
                            >I confirm my account deactivation</label
                          >
                        </div>
                        <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->

          <script type="text/javascript">

            $(document).ready(function () {
              $('#upload').on('change', function (e) {
                let reader = new FileReader();
                reader.onload = function (event) {
                  $('#showImage').attr('src', event.target.result);
                }
              
                if (e.target.files.length > 0) {
                reader.readAsDataURL(e.target.files[0]);
                }
              });
            });

            document.addEventListener("DOMContentLoaded", function () {
              var toastEl = document.getElementById('liveToast');
              if (toastEl) {
                {var toast = new bootstrap.Toast(toastEl);
                toast.show();}
              }
            });

          </script>

@endsection