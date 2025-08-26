@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

   <div class="content-wrapper">
                @if(session('success'))
                <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 99999; color:white;">
                <div id="liveToast" class="toast align-items-center text-bg-success border-0 bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" style="color:white;" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                </div>
                @endif

                @if(session('error'))
                <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 99999; color:white;">
                <div id="liveToast" class="toast align-items-center text-bg-danger border-0 bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" style="color:white;" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                </div>
                @endif

            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">About Setup /</span> About</h4>

                

              <div class="row">
                <div class="col-md-12">
                 
                  <div class="card mb-4">
                    <h5 class="card-header">Edit About section</h5>
                    <!-- Account -->
                <form method="POST" action="{{ route('update.about') }}" enctype="multipart/form-data">
                  @csrf
                  <!-- @method('patch') -->

                  <input type="hidden" name="id" value="{{ $aboutPage->id }}">

                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="{{ (!empty($aboutPage->about_image)) ? url($aboutPage->about_image) : url('upload/no_image.jpg') }}"
                          alt="about_image"
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
                              name="about_image"
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

                        

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title"  value="{{ old('Title', $aboutPage->title ?? '' )}}" >
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Short Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="short_title"  value="{{ old('Short Title', $aboutPage->short_title ?? '' )}}" id="basic-default-name" >
                                </div>
                            </div>

                            <!-- <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Short description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-name" name="short_description"  value="{{ old('Short description', $aboutPage->short_description ?? '' )}}"">
                                </div>
                            </div> -->

                            <div class="row mb-3">
                               <div>
                                    <label for="exampleFormControlTextarea1" class="form-label">Short Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="short_description" rows="3" placeholder="{{ old('Short Descripton', $aboutPage->short_description ?? '' )}}"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                               <div>
                                    <label for="exampleFormControlTextarea1" class="form-label">Long Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="long_description" rows="3" placeholder="{{ old('Long Descripton', $aboutPage->long_description ?? '' )}}"></textarea>
                                </div>
                            </div>

                            <!-- <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Long description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-name" name="long_description"  value="{{ old('Long description', $aboutPage->long_description ?? '' )}}"">
                                </div>
                            </div> -->
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" value="Update about" class="btn btn-primary me-2">Update About</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                </form>
                    </div>
                    <!-- /Account -->
                  </div>


                  
                </div>
              </div>
            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>


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