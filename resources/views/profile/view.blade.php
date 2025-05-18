@extends('layouts.app')

@section('content')
    <!-- Modals -->
    <div class="modal fade" id="updateInfo" tabindex="-1" role="dialog" aria-labelledby="updateInfoTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('profile.update') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="updateInfoTitle">Update Account</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="editFirstName">First Name</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                    name="firstname" id="editFirstName"
                                    value="{{ old('firstname', $userInfo->firstname) }}" required>
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editMiddleName">Middle Name</label>
                                <input type="text" class="form-control @error('middlename') is-invalid @enderror"
                                    name="middlename" id="editMiddleName"
                                    value="{{ old('middlename', $userInfo->middlename) }}" >
                                @error('middlename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editLastName">Last Name</label>
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                    name="lastname" id="editLastName"
                                    value="{{ old('lastname', $userInfo->lastname) }}" required>
                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editExtensionName">Extension Name</label>
                                <input type="text" class="form-control @error('extensionname') is-invalid @enderror"
                                    name="extensionname" id="editExtensionName"
                                    value="{{ old('extensionname', $userInfo->extensionname) }}" >
                                @error('extensionname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editAddress">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" id="editAddress"
                                    value="{{ old('address', $userInfo->address) }}" required>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editPhone">Phone number</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                    name="phone_number" id="editPhone"
                                    value="{{ old('phone_number', $userInfo->phone_number) }}" required>
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1 @error('birthday') is-invalid border-danger @enderror" for="editBirthday">Birthdate</label>
                                <div class="input-group input-group-joined">
                                    <input type="date" class="form-control @error('birthday') is-invalid @enderror"
                                    name="birthday" id="inputBirthdate"
                                    value="{{ old('birthday', $userInfo->birthday) }}" required>
                                    <div class="input-group-text">
                                        <i data-feather="calendar"></i>
                                    </div>
                                </div>
                                @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-primary-soft text-primary" type="button"
                            data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary"
                            type="submit">Update</button></div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal fade" id="updatePhotoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <form id="updateProfilePhotoForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary">Update Profile Picture</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-0">
                        <div class="row justify-content-center align-items-center" style="height: 100%;">
                            <div class="col-md-6 d-flex flex-column align-items-center text-center border-end p-3 pe-3">
                                <img id="currentProfilePhoto" class="img-account-profile img-fluid rounded-circle mb-2"
                                    src="{{ asset('assets/img/illustrations/profiles/profile-1.png') }}"
                                    alt="Profile Picture" />
                            </div>
                            <div class="col-md-6 d-flex flex-column align-items-center text-center p-3">
                                <label for="fileInput" class="btn btn-outline-primary mb-2">Select Photo</label>
                                <input type="file" name="photo" id="fileInput" class="d-none" accept="image/*"
                                    onchange="previewImage(event)" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <header class="mt-n10 pt-10 bg-white border-bottom">
        <div class="container-xl px-4">
            <div class="page-header-content py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="text-primary mb-0">Profile</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-md-12" id="ProfileCard">
                <div class="card shadow-none">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Profile Information</span>
                        <form id="petPhotoForm" action="{{ route('uploadPhoto', $userInfo->user_id) }}"
                            method="POST">
                            @csrf

                            <input type="file" id="petPhotoInput" name="photo"
                                accept="image/jpeg,image/png" style="display: none;" onchange="uploadPetPhoto()">
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#updateInfo">Update Account</a></li>
                                        <hr class="my-2">
                                <li>
                                    <a href="#" class="dropdown-item" onclick="document.getElementById('petPhotoInput').click(); return false;">Update Photo</a>
                                </li>
                                <!-- You can add more items here -->
                            </ul>
                        </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3">
                                <!-- Profile picture card-->
                                <div class="card shadow-none mb-4 mb-xl-0">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <span></span>
                                    </div>
                                    <div class="card-body text-center">
                                        <!-- Profile picture image-->
                                        <img id="petPhotoPreview" class="img-account-profile rounded-circle mb-2"
                                            src="{{ $userInfo->client_profile_picture ? asset('storage/' . $userInfo->client_profile_picture) : ($userInfo->profile_picture ? asset('storage/' . $userInfo->profile_picture) : asset('assets/img/illustrations/profiles/profile-1.png')) }}"
                                            alt="" />
                                    </div>
                                    <div class="card-footer text-center">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9">
                                <!-- Account details card-->
                                <div class="card shadow-none mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <span></span>
                                        <!-- Three-dot (kebab) menu button -->
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <label class="small mb-1">Name</label>
                                                <p>
                                                    {{ $userInfo->firstname ?? '' }}
                                                    {{ $userInfo->middlename ?? '' }}
                                                    {{ $userInfo->lastname ?? '' }}
                                                    {{ $userInfo->extensionname ?? '' }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1">Role</label>
                                                <div class="">
                                                    <p class="badge bg-primary-soft text-primary rounded-pill">
                                                        {{ Str::title($user->role) }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputBirthday">Birthdate</label>
                                                <p>{{ \Carbon\Carbon::parse($userInfo->birthday)->format('F d, Y') }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                                <p>{{ $user->email }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                                <p>{{ $userInfo->phone_number }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputAddress">Address</label>
                                                <p>{{ $userInfo->address }}</p>
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
                        alert('Failed to upload pet photo. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while uploading the pet photo.');
                });
        }
    </script>
@endsection
