@php use App\Models\Doctor; @endphp
@extends('layouts.app')

@section('styles')
@endsection

@section('content')

<!-- Modals -->
<!-- Edit Veterinarian Modal -->
<div class="modal fade" id="updateVetInfo" tabindex="-1" role="dialog" aria-labelledby="updateVetInfo" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="updateVetInfoTitle">Update Veterinarian Information</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('doctor.update', $doctor->id) }}" method="POST" id="updateVetForm">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="editFirstName">First Name</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                   name="firstname" id="editFirstName"
                                   placeholder="Enter first name" value="{{ old('firstname', $doctor->firstname) }}">
                            @error('firstname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editMiddleName">Middle Name</label>
                            <input type="text" class="form-control @error('middlename') is-invalid @enderror"
                                   name="middlename" id="editMiddleName"
                                   placeholder="Enter middle name" value="{{ old('middlename', $doctor->middlename) }}">
                            @error('middlename')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editLastName">Last Name</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                   name="lastname" id="editLastName"
                                   placeholder="Enter last name" value="{{ old('lastname', $doctor->lastname) }}">
                            @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editExtensionName">Extension Name</label>
                            <input type="text" class="form-control @error('extension') is-invalid @enderror"
                                   name="extension" id="editExtensionName"
                                   placeholder="Enter Extension Name"
                                   value="{{ old('extension', $doctor->extensionname) }}">
                            @error('extension')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editAddress">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                   name="address" id="editAddress"
                                   placeholder="Enter Address" value="{{ old('address', $doctor->address) }}">
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editPhone">Phone number</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                   name="phone_number" id="editPhone"
                                   placeholder="Enter Phone Number"
                                   value="{{ old('phone_number', $doctor->phone_number) }}">
                            @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editDOB">Birthdate</label>
                            <div class="input-group input-group-joined @error('birthday') is-invalid @enderror">
                                <input type="date" class="form-control @error('birthday') is-invalid @enderror"
                                       name="birthday" id="inputBirthdate"
                                       placeholder="MM/DD/YYYY" value="{{ old('birthday', $doctor->birthday) }}"
                                       max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                <span class="input-group-text">
                    <i data-feather="calendar"></i>
                </span>
                            </div>
                            @error('birthday')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editPosition">Veterinarian Position</label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror"
                                   name="position" id="editPosition"
                                   placeholder="Enter Position" value="{{ old('position', $doctor->position) }}">
                            @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editLicenseNumber">License Number</label>
                            <input type="text" class="form-control @error('license_number') is-invalid @enderror"
                                   name="license_number" id="editLicenseNumber"
                                   placeholder="Enter License Number"
                                   value="{{ old('license_number', $doctor->license_number) }}">
                            @error('license_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editPtrNumber">PTR Number</label>
                            <input type="text" class="form-control @error('ptr_number') is-invalid @enderror"
                                   name="ptr_number" id="editPtrNumber"
                                   placeholder="Enter PTR Number" value="{{ old('ptr_number', $doctor->ptr_number) }}">
                            @error('ptr_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                <!-- Move the submit button inside the form -->
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Update Photo Modal -->
<div class="modal fade" id="updatePhotoModal" tabindex="-1" role="dialog" aria-labelledby="updatePhotoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Update Profile Picture</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('doctor.upload.photo', $doctor->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
                @method('PUT')
                <div class="modal-body p-0">
                    <div class="row justify-content-center align-items-center" style="height: 100%;">
                        <div class="col-md-12 d-flex flex-column align-items-center text-center py-2 pt-4">
                            <img class="img-account-profile rounded-circle mb-2" id="profileImagePreview" src="{{$doctor->profile_picture != null ? asset('storage/' . $doctor->profile_picture) : asset('assets/img/illustrations/profiles/profile-1.png')}}" alt="Profile Picture"  style="width: 200px; height: 200px; object-fit: cover;"/>
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        </div>
                        <div class="col-md-12 px-5 pb-3">
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
                           }" value="{{ old('profile_picture') }}"/>
                            @error('profile_picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- UM Modals -->
{{-- Edit Email Address--}}
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="umUpdateEmailModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('doctor.update.email', $doctor->id) }}" method="POST" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Update Email Address</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email"
                         class="form-control" name="email" placeholder="{{ \App\Models\User::find($doctor->user_id)->email ?? 'Enter email' }}" value="{{old('email')}}" autocomplete="off" required>
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-soft text-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Veterinarian Modal -->
<div class="modal fade" id="updateVetAccount" tabindex="-1" role="dialog" aria-labelledby="updateVetAccount" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="updateVetInfoTitle">Edit Veterinarian Account</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('doctor.update', $doctor->id) }}" method="POST" id="updateVetForm">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="editFirstName">First Name</label>
                            <input type="text" class="form-control" name="firstname" id="editFirstName"
                                   placeholder="Enter first name" value="{{ $doctor->firstname }}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editMiddleName">Middle Name</label>
                            <input type="text" class="form-control" name="middlename" id="editMiddleName"
                                   placeholder="Enter middle name" value="{{ $doctor->middlename }}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editLastName">Last Name</label>
                            <input type="text" class="form-control" name="lastname" id="editLastName"
                                   placeholder="Enter last name" value="{{ $doctor->lastname }}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editExtensionName">Extension Name</label>
                            <input type="text" class="form-control" name="extensionname" id="editExtensionName"
                                   placeholder="Enter extension name" value="{{ $doctor->extensionname }}">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editAddress">Address</label>
                            <input type="text" class="form-control" name="address" id="editAddress" placeholder="Enter address" value="{{ $doctor->address }}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editPhone">Phone number</label>
                            <input type="text" class="form-control" name="phone_number" id="editPhone" placeholder="Enter phone number" value="{{ $doctor->phone_number }}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editDOB">Birthdate</label>
                            <input type="date" class="form-control" name="birthday" id="editBirthdate" placeholder="MM/DD/YYYY" value="{{ $doctor->birthday }}" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editPosition">Veterinarian Position</label>
                            <input type="text" class="form-control" name="position" id="editPosition" placeholder="Enter position" value="{{ $doctor->position }}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editLicenseNumber">License No.</label>
                            <input type="text" class="form-control" name="license_number" id="editLicenseNumber" placeholder="Enter license number" value="{{$doctor->license_number}}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editPtrNumber">PTR Number</label>
                            <input type="text" class="form-control" name="ptr_number" id="editPtrNumber"
                                   placeholder="Enter PTR Number" value="{{ $doctor->ptr_number }}">
                        </div>
{{--                        <div class="col-md-12">--}}
{{--                            <label class="small mb-1" for="editEmailAddress">Email address</label>--}}
{{--                            <input type="text" class="form-control" name="email" id="editEmailAddress" placeholder="Enter email address" value="{{ \App\Models\User::find($doctor->user_id)->email }}">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-12 mt-4">--}}
{{--                            <h6 class="text-primary">Change Password</h6>--}}
{{--                            <hr class="mt-1 mb-0">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-12">--}}
{{--                            <label class="small mb-1" for="editOldPassword">Old Password</label>--}}
{{--                            <input type="text" class="form-control" name="username" id="editOldPassword" placeholder="Enter old password" value="">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <label class="small mb-1" for="updateNewPassword">New Password</label>--}}
{{--                            <input type="text" class="form-control" name="username" id="updateNewPassword" placeholder="Enter new password" value="">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <label class="small mb-1" for="updateConfirmNewPassword">Confirm New Password</label>--}}
{{--                            <input type="text" class="form-control" name="username" id="updatConfirmeNewPassword" placeholder="Confirm password" value="">--}}
{{--                        </div>--}}
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                <!-- Move the submit button inside the form -->
                <button class="btn btn-primary" type="submit">Update Account</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Reset Password -->
<div class="modal fade" id="umResetPasswordModal" tabindex="-1" role="dialog"
     aria-labelledby="umResetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="umResetPasswordModalLabel">Reset Password</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('doctor.resetpassword', $doctor->id) }}">
                <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control @error('newPassword') is-invalid @enderror"
                                   name="newPassword" id="newPassword" placeholder="Enter new password" required>
                            @error('newPassword')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror"
                                   name="confirmPassword" id="confirmPassword" placeholder="Confirm new password" required>
                            @error('confirmPassword')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Disable Account Modal -->
<div class="modal fade" id="disableAccountModal" tabindex="-1" role="dialog" aria-labelledby="disableAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('doctor.disable', $doctor->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="disableAccountModalLabel">Disable Account</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to disable this account?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Disable Account</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Enable Account Modal -->
<div class="modal fade" id="enableAccountModal" tabindex="-1" role="dialog" aria-labelledby="enableAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('doctor.enable', $doctor->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enableAccountModalLabel">Enable Account</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to enable this account?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Enable Account</button>
                </div>
            </div>
        </form>
    </div>
</div>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="/managedoctor">Manage Veterinarians</a></li>
                    <li class="breadcrumb-item active">Veterinarian Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
@php
Doctor::setEmailAttribute($doctor,$doctor->user_id);
@endphp

<!-- Main page content-->
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link nav-tab ms-0{{ request()->is('vet-profile') ? 'active' : '' }}" href="#vet-profile">Profile</a>
        <a class="nav-link nav-tab{{ request()->is('schedules') ? 'active' : '' }}" href="#schedules">Schedules</a>
        <a class="nav-link nav-tab{{ request()->is('records') ? 'active' : '' }}" href="#records">Medical Records</a>
        <a class="nav-link nav-tab{{ request()->is('um') ? 'active' : '' }}" href="#um">Account Settings</a>
    </nav>
    <hr class="mt-0 mb-4" />
    <div class="row">
        <div class="col-md-12" id="vetProfileCard" style="display:none;">
            <div class="card shadow-none">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Profile</span>
                    <div class="dropdown">
                        <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateVetInfo">Edit Information</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card shadow-none mb-4">
                                <div class="card-header py-2">
                                </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label class="small mb-1">Veterinarian Name</label>
                                            <p class="text-primary fw-bold">Dr. {{ $doctor->fullname() }}  @if($doctor->status == 0)
                                                    <span class="badge bg-light text-body ms-2">Account Disabled</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="small mb-1">License Number</label>
                                            <div>
                                                <span
                                                    class="badge bg-primary-soft text-primary rounded-pill">{{$doctor->license_number}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="small mb-1">PTR Number</label>
                                            <div>
                                                <span
                                                    class="badge bg-secondary-soft text-secondary rounded-pill">{{$doctor->ptr_number}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1">Position</label>
                                            <p>{{ $doctor->position }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1">Birthday</label>
                                            <p>{{ \Carbon\Carbon::parse($doctor->birthday)->format('F d, Y') }}</p>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="small mb-1">Address</label>
                                            <p>{{ $doctor->address }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1">Email Address</label>
                                            <div class="text-primary">
                                                <a href="mailto:{{ $doctor->doctor_email }}">
                                                    {{ $doctor->doctor_email }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1">Phone Number</label>
                                            <div class="text-primary">
                                                <a href="tel:{{ $doctor->phone_number }}">
                                                    {{ $doctor->phone_number }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <!-- Profile picture card-->
                            <div class="card shadow-none mb-4 mb-xl-0">
                                <div class="card-header d-flex justify-content-between align-items-center py-2">
                                    <span></span>
                                    <!-- Three-dot (kebab) menu button -->
                                    {{--                            <div class="dropdown">--}}
                                    {{--                                <button class="btn btn-link text-muted p-0" type="button" id="updatePhotoBtn" data-bs-toggle="dropdown" aria-expanded="false">--}}
                                    {{--                                    <i class="fa fa-ellipsis-vertical"></i>--}}
                                    {{--                                </button>--}}
                                    {{--                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="updatePhotoBtn">--}}
                                    {{--                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updatePhotoModal">Update Photo</a></li>--}}
                                    {{--                                    <!-- You can add more items here -->--}}
                                    {{--                                </ul>--}}
                                    {{--                            </div>--}}
                                </div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <img id="petPhotoPreview" class="img-account-profile rounded-circle mb-2" style="width: 200px; height: 200px; object-fit: cover;" src="{{$doctor->profile_picture != null ? asset('storage/' . $doctor->profile_picture) : asset('assets/img/illustrations/profiles/profile-1.png')}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script>
            function uploadPetPhoto() {
                const form = document.getElementById('petPhotoForm');
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('petPhotoPreview').src = data.photo_url;
                            alert('Photo updated successfully!');
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while uploading the pet photo.');
                    });
            }
        </script>
        <!-- Schedules -->
        <div class="col-md-12" id="schedulesCard" style="display:none;">
            <div class="card shadow-none">
                <div class="card-header">
                    Schedules
                </div>
                <div class="card-body">
                    <table id="petSchedTable">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
{{--                                <th>Appointment ID</th>--}}
                                <th>Pet Owner</th>
                                <th>Pet</th>
{{--                                <th>Pet Type</th>--}}
                                <th>Reason of Visit</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $schedules = Doctor::getSchedules($doctor->id)
                            @endphp
                            @foreach($schedules as $schedule)
                            <tr>
                                <td>
                                    {{ \Carbon\Carbon::parse($schedule->appointment_date)->format('j F, Y') }} {{ \Carbon\Carbon::parse($schedule->appointment_time)->format('g:i A') }}
                                </td>
{{--                                <td>{{ sprintf("VetIS-%05d", $schedule->id)}}</td>--}}
                                <td>
                                    {{ $clients->firstWhere('id', $schedule->owner_ID)->client_name ?? 'N/A' }}
                                </td>
                                <td>
                                    @php
                                        $pet_ids = explode(',', $schedule->pet_ID);
                                        $pets = \App\Models\Pets::whereIn('id', $pet_ids)->get();
                                    @endphp
                                    @foreach ($pets as $pet)
                                        <span class="badge bg-primary-soft text-primary text-xs rounded-pill">
                                        {{ $pet->pet_name }} <span
                                                class="badge bg-white text-primary text-xs rounded-pill ms-1">{{ $pet->pet_type }}</span></span>
                                    @endforeach
                                </td>
{{--                                <td>--}}
{{--                                    {{ $pets->firstWhere('id', $schedule->pet_ID)->pet_type ?? 'N/A' }}--}}
{{--                                </td>--}}
                                <td>
                                    @php
                                        $service_ids = explode(',', $schedule->purpose);
                                        $services = \App\Models\Services::whereIn('id', $service_ids)->pluck('service_name')->toArray();
                                        $service_list = implode(', ', $services);
                                    @endphp
                                    {{ \Illuminate\Support\Str::limit($service_list, 35) }}
                                </td>
                                <td>
                                    <div class="badge badge-sm bg-secondary-soft text-secondary rounded-pill">Scheduled</div>
                                </td>
                                <td>
                                    <a class="btn btn-datatable btn-primary px-5 py-3" href="{{route('appointments.view',['id'=>$schedule->id])}}">View</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Records -->
        <div class="col-md-12" id="recordsCard" style="display:none;">
            <div class="card shadow-none">
                <div class="card-header">
                    Medical Records
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>Subject</th>
                                <th>Pet</th>
                                <th>Pet Owner</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $consultation_type = [
                            1=> "Walk-In" ,
                            2=> "Consultation" ,
                            3=> "Vaccination",
                            4=> "Surgery"
                            ];
                            @endphp
                            @foreach($records as $record)

                            <tr>
                                <td>{{ \Carbon\Carbon::parse($record->record_date)->format('j F, Y g:i A') }}</td>
                                <td>{{ $record->subject}}</td>@php
                                    $pet = \App\Models\Pets::find($record->petID);
                                @endphp
                                <td>
                                    @if ($pet)
                                        <span class="badge bg-primary-soft text-primary text-xs rounded-pill">
                                            {{ $pet->pet_name }} <span
                                                class="badge bg-white text-primary text-xs rounded-pill ms-1">{{ $pet->pet_type }}</span>
                                        </span>
                                    @else
                                        <span class="text-danger">Pet not found</span>
                                    @endif
                                </td>

                                <td>{{ \App\Models\Clients::where('id',$record->ownerID)->first()->client_name }}</td>

                                <td>{!! $record->status == 1
    ? '<span class="badge rounded-pill bg-success-soft text-success text-sm">Completed</span>'
    : '<span class="badge rounded-pill bg-warning-soft text-warning text-sm">Ongoing</span>' !!}</td>
                                <td>
                                    <a class="btn btn-datatable btn-primary px-5 py-3" href="{{route('soap.view', ['id' => $record->petID, 'recordID' => $record->id])}}">View</a>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- UM -->
        <div class="col-md-12" id="umCard" style="display:none;">
            <!-- UM Settings -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none">
                        <div class="card-header">Account Settings</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card shadow-none">
                                        <div class="card-header py-2">
                                        </div>
                                        <form action="{{ route('doctor.update', $doctor->id) }}" method="POST"
                                              id="updateVetForm">
                                            @csrf
                                            @method('PUT')
                                        <div class="card-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="editFirstName">First Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                               class="form-control @error('firstname') is-invalid @enderror"
                                                               name="firstname" id="editFirstName"
                                                               placeholder="Enter first name"
                                                               value="{{ old('firstname', $doctor->firstname) }}" autocomplete="off">
                                                        @error('firstname')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="editMiddleName">Middle
                                                            Name</label>
                                                        <input type="text"
                                                               class="form-control @error('middlename') is-invalid @enderror"
                                                               name="middlename" id="editMiddleName"
                                                               placeholder="Enter middle name"
                                                               value="{{ old('middlename', $doctor->middlename) }}" autocomplete="off">
                                                        @error('middlename')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="editLastName">Last Name<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                               class="form-control @error('lastname') is-invalid @enderror"
                                                               name="lastname" id="editLastName"
                                                               placeholder="Enter last name"
                                                               value="{{ old('lastname', $doctor->lastname) }}" autocomplete="off">
                                                        @error('lastname')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="editExtensionName">Extension
                                                            Name</label>
                                                        <input type="text"
                                                               class="form-control @error('extensionname') is-invalid @enderror"
                                                               name="extensionname" id="editExtensionName"
                                                               placeholder="Enter extension name"
                                                               value="{{ old('extensionname', $doctor->extensionname) }}" autocomplete="off">
                                                        @error('extensionname')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="small mb-1" for="editAddress">Address <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                               class="form-control @error('address') is-invalid @enderror"
                                                               name="address" id="editAddress"
                                                               placeholder="Enter address"
                                                               value="{{ old('address', $doctor->address) }}" autocomplete="off">
                                                        @error('address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="editPhone">Phone number <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                               class="form-control @error('phone_number') is-invalid @enderror"
                                                               name="phone_number" id="editPhone"
                                                               placeholder="Enter phone number"
                                                               value="{{ old('phone_number', $doctor->phone_number) }}" autocomplete="off">
                                                        @error('phone_number')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="editDOB">Birthdate <span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group input-group-joined @error('birthday') has-validation @enderror">
                                                            <input type="date"
                                                                   class="form-control @error('birthday') is-invalid @enderror"
                                                                   name="birthday" id="UMInputBirthdate"
                                                                   placeholder="mm/dd/yyyy"
                                                                   value="{{ old('birthday', $doctor->birthday) }}"
                                                                   max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" autocomplete="off">
                                                            <span class="input-group-text">
                                                                <i data-feather="calendar"></i>
                                                            </span>
                                                        </div>
                                                        @error('birthday')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="small mb-1" for="editPosition">Veterinarian
                                                            Position <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                               class="form-control @error('position') is-invalid @enderror"
                                                               name="position" id="editPosition"
                                                               placeholder="Enter position"
                                                               value="{{ old('position', $doctor->position) }}" autocomplete="off">
                                                        @error('position')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="editLicenseNumber">License
                                                            No.</label>
                                                        <input type="text"
                                                               class="form-control @error('license_number') is-invalid @enderror"
                                                               name="license_number" id="editLicenseNumber"
                                                               placeholder="Enter license number"
                                                               value="{{ old('license_number', $doctor->license_number) }}" autocomplete="off">
                                                        @error('license_number')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="editPtrNumber">PTR Number</label>
                                                        <input type="text"
                                                               class="form-control @error('ptr_number') is-invalid @enderror"
                                                               name="ptr_number" id="editPtrNumber"
                                                               placeholder="Enter PTR Number"
                                                               value="{{ old('ptr_number', $doctor->ptr_number) }}" autocomplete="off">
                                                        @error('ptr_number')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-primary" type="submit">Update Account</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- Profile picture card-->
                                    <div class="card shadow-none mb-4 mb-xl-0">
                                        <div class="card-header d-flex justify-content-between align-items-center py-2">
                                            <span></span>
                                            <!-- Three-dot (kebab) menu button -->
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-link text-muted p-0" type="button" id="updatePhotoBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="fa fa-ellipsis-vertical"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="updatePhotoBtn">
                                                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updatePhotoModal">Update Photo</a></li>
                                                                                <!-- You can add more items here -->
                                                                            </ul>
                                                                        </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <!-- Profile picture image-->
                                            <img id="petPhotoPreview" class="img-account-profile rounded-circle mb-2" style="width: 200px; height: 200px; object-fit: cover;" src="{{$doctor->profile_picture != null ? asset('storage/' . $doctor->profile_picture) : asset('assets/img/illustrations/profiles/profile-1.png')}}" alt="" />
                                        </div>
                                    </div>

                                    <div class="card shadow-none mt-5">
                                        <div class="card-header">Account</div>
                                        <div class="card-body">
                                            <div class="row g-2">
                                                <div class="col-md-12">
                                                    <button class="btn btn-outline-primary w-100" type="button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#umUpdateEmailModal" >Update Email
                                                    </button>
                                                </div>
                                                <div class="col-md-12">
                                                    <button class="btn btn-outline-primary w-100" type="button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#umResetPasswordModal">Reset Password
                                                    </button>
                                                </div>
                                                <div class="col-md-12">
                                                    @if ($doctor->status == 1)
                                                        <button class="btn btn-outline-danger w-100" type="button"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#disableAccountModal">Disable Account
                                                        </button>
                                                    @endif
                                                        @if ($doctor->status == 0)
                                                            <button class="btn btn-outline-primary w-100" type="button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#enableAccountModal">Enable Account
                                                            </button>
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.nav-tab');
        const cards = {
            'vet-profile': document.getElementById('vetProfileCard'),
            'schedules': document.getElementById('schedulesCard'),
            'records': document.getElementById('recordsCard'),
            'um': document.getElementById('umCard')
        };

        @if (session('updateEmailModal') && $errors->any())
            // Show the modal if there are any errors
            const emailModal = new bootstrap.Modal(document.getElementById('umUpdateEmailModal'));
            emailModal.show();
        @endif

        @if (session('resetPasswordModal') && $errors->any())
        // Show the modal if there are any errors
        const resetPasswordModal = new bootstrap.Modal(document.getElementById('umResetPasswordModal'));
        resetPasswordModal.show();
        @endif


        @if (session('from_doctors_update') && $errors->any())
            document.querySelector('.nav-link[href="#um"]').classList.add('active');
            document.getElementById('umCard').style.display = 'block';
        @elseif (session('updateEmailModal') && $errors->any())
            document.querySelector('.nav-link[href="#um"]').classList.add('active');
            document.getElementById('umCard').style.display = 'block';
        @elseif (session('resetPasswordModal') && $errors->any())
        document.querySelector('.nav-link[href="#um"]').classList.add('active');
        document.getElementById('umCard').style.display = 'block';
        @elseif (session('updateEmailModalSuccess'))
        document.querySelector('.nav-link[href="#um"]').classList.add('active');
        document.getElementById('umCard').style.display = 'block';
        @elseif (session('resetPasswordModalSuccess'))
        document.querySelector('.nav-link[href="#um"]').classList.add('active');
        document.getElementById('umCard').style.display = 'block';
        @elseif (session('from_doctors_update_success'))
            document.querySelector('.nav-link[href="#um"]').classList.add('active');
            document.getElementById('umCard').style.display = 'block';
        @else
            document.querySelector('.nav-link[href="#vet-profile"]').classList.add('active');
            cards['vet-profile'].style.display = 'block'; // Show Pet Profile Card by default
        @endif


        //        // Ensure Pet Profile is active initially
//        document.querySelector('.nav-link[href="#vet-profile"]').classList.add('active');
//        cards['vet-profile'].style.display = 'block'; // Show Pet Profile Card by default

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                // Hide all cards
                Object.values(cards).forEach(card => card.style.display = 'none');

                // Show the clicked tab's corresponding card
                const targetCard = tab.getAttribute('href').substring(1);
                if (cards[targetCard]) {
                    cards[targetCard].style.display = 'block';
                }
            });
        });
        // Trigger the click on the Pet Profile tab to show it initially
        document.querySelector('.nav-tab.active').click();
    });
</script>
@endsection
