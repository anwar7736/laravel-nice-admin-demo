@extends('layouts.master')
@section('title', 'My Profile')
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Profile</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        @if(Auth::user()->photo && file_exists('storage/'.Auth::user()->photo))
          <img src="{{asset('storage/'.Auth::user()->photo)}}" class="rounded-circle">
        @else
          <img src="{{asset('assets/img/profile-img.jpg')}}" class="rounded-circle">
        @endif
          <h2>{{Auth::user()->name}}</h2>
          <h3>{{Auth::user()->designation}}</h3>
          <div class="social-links mt-2">
            <a target="_blank" href="{{Auth::user()->twitter_link}}" class="twitter"><i class="bi bi-twitter"></i></a>
            <a target="_blank" href="{{Auth::user()->facebook_link}}" class="facebook"><i class="bi bi-facebook"></i></a>
            <a target="_blank" href="{{Auth::user()->instagram_link}}" class="instagram"><i class="bi bi-instagram"></i></a>
            <a target="_blank" href="{{Auth::user()->linkedin_link}}" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>

    </div>

    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
            </li>

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title">About</h5>
              <p class="small fst-italic">{{Auth::user()->short_description}}</p>

              <h5 class="card-title">Profile Details</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                <div class="col-lg-9 col-md-8">{{Auth::user()->name}}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Company</div>
                <div class="col-lg-9 col-md-8">{{Auth::user()->company}}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Job</div>
                <div class="col-lg-9 col-md-8">{{Auth::user()->designation}}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Country</div>
                <div class="col-lg-9 col-md-8">{{Auth::user()->country}}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Address</div>
                <div class="col-lg-9 col-md-8">{{Auth::user()->address}}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Phone</div>
                <div class="col-lg-9 col-md-8">{{Auth::user()->phone}}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8">{{Auth::user()->email}}</div>
              </div>

            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

              <!-- Profile Edit Form -->
              <form method="POST" id="profileForm" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">
                    @if(Auth::user()->photo && file_exists('storage/'.Auth::user()->photo))
                        <img src="{{asset('storage/'.Auth::user()->photo)}}"  class="rounded-circle">
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i><input class="upload_file d-none" type="file" accept="image/*" name="photo"></a>
                          <a href="#" class="btn btn-danger btn-sm removeBtn" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                      </div>
                    @else
                        <img src="{{asset('assets/img/profile-img.jpg')}}"  class="rounded-circle">
                        <div class="pt-2">
                        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i><input class="upload_file d-none" type="file" accept="image/*" name="photo"></a>
                        </div>
                    @endif
                    <input type="hidden" name="hiddenID" id="hiddenID" ><br>
                    <div id="result">
                      
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="text" class="form-control" name="name" id="fullName" value="{{Auth::user()->name}}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="short_description" class="form-control" id="about" style="height: 100px">{{Auth::user()->short_description}}</textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="company" type="text" class="form-control" value="{{Auth::user()->company}}" id="company">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="designation" type="text" class="form-control" id="Job" value="{{Auth::user()->designation}}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="country" type="text" class="form-control" id="Country" value="{{Auth::user()->country}}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="address" type="text" class="form-control" id="Address" value="{{Auth::user()->address}}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="phone" type="text" class="form-control" id="Phone" value="{{Auth::user()->phone}}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control" id="Email" value="{{Auth::user()->email}}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="twitter_link" type="text" class="form-control" id="Twitter" value="{{Auth::user()->twitter_link}}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="facebook_link" type="text" class="form-control" id="Facebook" value="{{Auth::user()->facebook_link}}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="instagram_link" type="text" class="form-control" id="Instagram" value="{{Auth::user()->instagram_link}}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="linkedin_link" type="text" class="form-control" id="Linkedin" value="{{Auth::user()->linkedin_link}}">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form><!-- End Profile Edit Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-settings">

              <!-- Settings Form -->
              <form>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="changesMade" checked>
                      <label class="form-check-label" for="changesMade">
                        Changes made to your account
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="newProducts" checked>
                      <label class="form-check-label" for="newProducts">
                        Information on new products and services
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="proOffers">
                      <label class="form-check-label" for="proOffers">
                        Marketing and promo offers
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                      <label class="form-check-label" for="securityNotify">
                        Security alerts
                      </label>
                    </div>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form><!-- End settings Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-change-password">
              <!-- Change Password Form -->
              <div id="message">

              </div>
              <form method="POST" id="ChangePasswordForm">
                  @csrf
                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="password" type="password" class="form-control" id="currentPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
              </form><!-- End Change Password Form -->

            </div>

          </div><!-- End Bordered Tabs -->

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->

@endsection

@push('scripts')
  <script>
      $(document).ready(function(){
        $('.bi-upload').on('click', function(){
            $('.upload_file').click();
         });

         $('.bi-trash').on('click', function(){
            $(".rounded-circle").attr("src", "{{asset('assets/img/profile-img.jpg')}}");
            $(this).hide();
            $(".removeBtn").hide();
            $("#hiddenID").val("1");
         });
         $("#profileForm").on("submit", function(e){
            e.preventDefault();
            $.ajax({
              url : "{{route('update.profile')}}",
              method : "POST",
              dataType : "JSON",
              data : new FormData(this),
              cache:false,
              contentType: false,
              processData: false,
              success : function(data)
              {
                let result = "";
                if(data.errors)
                {
                  let length = data.errors.length;
                  result = "<div class='alert alert-danger'>";
                  for(let i = 0; i < length; i++)
                  {
                     result += `<p>${data.errors[i]}</p>`;
                  }
                  result +="</div>";
                }
                else if(data.success)
                {
                  $("#hiddenID").val("");
                  result = `<div class='alert alert-success'>
                              <p>${data.success}</p>
                            </div>`;
                }
                
                $("#result").html(result);
              }
            });
         });
         $("#ChangePasswordForm").on("submit", function(e){
            e.preventDefault();
            $.ajax({
              url : "{{route('password.change')}}",
              method : "POST",
              dataType : "JSON",
              data : new FormData(this),
              cache:false,
              contentType: false,
              processData: false,
              success : function(data)
              {
                let result = "";
                if(data.errors)
                {
                  let length = data.errors.length;
                  result = "<div class='alert alert-danger'>";
                  for(let i = 0; i < length; i++)
                  {
                     result += `<p>${data.errors[i]}</p>`;
                  }
                  result +="</div>";
                  
                } 
                if(data.error)
                {
                  result = `<div class='alert alert-danger'>
                              <p>${data.error}</p>
                            </div>`;
                }
                if(data.success)
                {
                  result = `<div class='alert alert-success'>
                              <p>${data.success}</p>
                            </div>`;

                          $("#currentPassword").val("");
                          $("#newPassword").val("");
                          $("#renewPassword").val("");
                          setTimeout(()=>{
                            window.location.href = "/login";
                          },1000);
                  }
                
                $("#message").html(result);
              }
            });
         });
      });
  </script>
@endpush