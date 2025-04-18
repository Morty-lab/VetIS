@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<!-- Modals -->
<!-- Add Profile Modal -->
<div class="modal fade" id="profilePictureModal" tabindex="-1" role="dialog" aria-labelledby="profilePictureModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Upload Profile Picture</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row justify-content-center align-items-center" style="height: 100%;">
                    <div class="col-md-6 d-flex flex-column align-items-center text-center border-end p-3 pe-3">
                        <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/illustrations/profiles/profile-1.png') }}" alt="Profile Picture" />
                    </div>
                    <div class="col-md-6 d-flex flex-column align-items-center text-center p-3">
                        <label for="fileInput" class="btn btn-outline-primary mb-2">Select Photo</label>
                        <input type="file" id="fileInput" class="d-none" accept="image/*" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>

<div id="successAlert" class="alert alert-primary alert-icon position-fixed bottom-0 end-0 m-3" role="alert" style="display: none; z-index: 100;">
    <div class="alert-icon-aside">
        <i class="fa-regular fa-circle-check"></i>
    </div>
    <div class="alert-icon-content">
        <h6 class="alert-heading">Success</h6>
        Doctor Registered Successfully!
    </div>
</div>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="/managedoctor">Manage Veterinarians</a></li>
                    <li class="breadcrumb-item active">Add Veterinarian</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <form method="POST" action="{{route('doctor.add')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card shadow-none mb-4">
                    <div class="card-header">Veterinarian Account Registration</div>
                    <div class="card-body">
                            <!-- Form Row-->
                        <div class="row gx-3 gy-2 mb-4">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name <span
                                        class="text-danger">*</span></label><input
                                    class="form-control @error('firstname') is-invalid @enderror" id="inputFirstName"
                                    name="firstname" type="text" placeholder="First Name"
                                    value="{{ old('firstname') }}" autocomplete="off"/>
                                @error('firstname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputmiddleName">Middle name</label>
                                <input class="form-control @error('middlename') is-invalid @enderror" id="inputmiddleName"
                                       name="middlename" type="text" placeholder="Middle Name"
                                       value="{{ old('middlename') }}" autocomplete="off"/>
                                @error('middlename')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('lastname') is-invalid @enderror" id="inputLastName"
                                       name="lastname" type="text" placeholder="Last Name"
                                       value="{{ old('lastname') }}" autocomplete="off"/>
                                @error('lastname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Extension name</label>
                                <input class="form-control @error('extensionname') is-invalid @enderror" id="inputExtensionName"
                                       name="extensionname" type="text" placeholder="Extension Name"
                                       value="{{ old('extensionname') }}" autocomplete="off"/>
                                @error('extensionname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputAddress">Address <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('address') is-invalid @enderror" id="inputAddress"
                                       name="address" type="text" placeholder="Address" value="{{ old('address') }}" autocomplete="off"/>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('phone_number') is-invalid @enderror" id="inputPhone"
                                       name="phone_number" type="tel" placeholder="Phone Number"
                                       value="{{ old('phone_number') }}" autocomplete="off"/>
                                @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday <span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-joined @error('birthday') is-invalid @enderror">
                                    <input class="form-control" id="inputBirthdate"
                                           name="birthday" type="date" placeholder="mm/dd/yyyy"
                                           value="{{ old('birthday') }}"
                                           max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" autocomplete="off"/>
                                    <span class="input-group-text">
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('birthday')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputPosition">Veterinarian Position</label>
                                <input class="form-control @error('position') is-invalid @enderror" id="inputPosition"
                                       name="position" type="text" placeholder="Position" value="{{ old('position') }}"
                                       autocomplete="off"/>
                                @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLicenseNumber">License No.</label>
                                <input class="form-control" id="inputLicenseNumber" name="license_number" type="number"
                                       placeholder="License No." value="{{ old('license_number') }}"
                                       autocomplete="off"/>
                                @error('license_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPTRNumber">PTR No.</label>
                                <input class="form-control" id="inputPTRNumber" name="ptr_number" type="number"
                                       placeholder="PTR No." value="{{ old('ptr_number') }}" autocomplete="off"/>
                                @error('ptr_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-5">
                                <label class="small mb-1" for="inputEmailAddress">Email address <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('email') is-invalid @enderror" id="inputEmailAddress"
                                       name="email" type="email" placeholder="Email Address" value="{{ old('email') }}" autocomplete="off"/>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPassword">Password <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('password') is-invalid @enderror" id="inputPassword"
                                       name="password" type="password" placeholder="Password" value=""
                                       oninput="validatePasswords()" autocomplete="off"/>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Form Group (confirm password)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="confirmPassword">Confirm Password <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                       id="confirmPassword" name="password_confirmation" type="password"
                                       placeholder="Confirm Password" value="" oninput="validatePasswords()" autocomplete="off"/>
                                @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback d-none" id="passwordMismatchError">Passwords do not match.
                                </div>
                            </div>

                            <script>
                                function validatePasswords() {
                                    const password = document.getElementById('inputPassword').value;
                                    const confirmPassword = document.getElementById('confirmPassword').value;
                                    const mismatchError = document.getElementById('passwordMismatchError');

                                    if (password !== confirmPassword && confirmPassword !== "") {
                                        mismatchError.classList.remove('d-none');
                                    } else {
                                        mismatchError.classList.add('d-none');
                                    }
                                }
                            </script>
                        </div>
                    <!-- Save changes button-->
                    <button class="btn btn-primary" id="regbtn" type="submit">Register</button>
                </div>
            </div>
        </div>
        <div class="col-xl-4"><!-- Profile picture card-->
            <div class="card shadow-none mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image -->
                    <img id="profileImagePreview" class="img-account-profile rounded-circle mb-2"
                         src="{{ old('profile_picture') ? asset('storage/' . old('profile_picture')) : asset('assets/img/illustrations/profiles/profile-1.png') }}"
                         alt="Profile Picture" style="width: 150px; height: 150px; object-fit: cover;"/>
                    <!-- Profile picture help block -->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button -->
                    <input class="form-control @error('profile_picture') is-invalid @enderror" type="file"
                           name="profile_picture"
                           accept="image/png, image/jpg, image/jpeg" style="cursor: pointer;"
                           onchange="if(this.files[0].size > 5242880) {
                       alert('File size must be less than 5MB');
                       this.value = '';
                       document.getElementById('profileImagePreview').src = '{{ asset('assets/img/illustrations/profiles/profile-1.png') }}';
                   } else {
                       const reader = new FileReader();
                       reader.onload = function(e) {
                           document.getElementById('profileImagePreview').src = e.target.result;
                       };
                       reader.readAsDataURL(this.files[0]);
                   }"
                           value="{{ old('profile_picture') }}"/>
                    @error('profile_picture')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </form>
</div>

{{--<script>--}}
{{--    document.addEventListener("DOMContentLoaded", function() {--}}
{{--        // Get the register button--}}
{{--        var registerButton = document.getElementById('regbtn');--}}

{{--        // Add event listener to the register button--}}
{{--        registerButton.addEventListener('click', function() {--}}
{{--            // Show the success alert--}}
{{--            var successAlert = document.getElementById('successAlert');--}}
{{--            successAlert.style.display = 'flex';--}}

{{--            setTimeout(function() {--}}
{{--                window.location.href = '/managedoctor';--}}
{{--            }, 4000);--}}

{{--            // Optionally, hide the alert after a certain period (e.g., 3 seconds)--}}
{{--            setTimeout(function() {--}}
{{--                successAlert.style.display = 'none';--}}
{{--            }, 3000);--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
@endsection

@section('scripts')

@endsection
