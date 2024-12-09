@extends('layouts.app')

@section('content')
<!-- Modals -->
<div class="modal fade" id="updateInfo" tabindex="-1" role="dialog" aria-labelledby="updateInfoTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="updateInfoTitle">Update Account</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class=" col-md-12">
                            <label class="small mb-1" for="editFirstName">Name</label>
                            <input type="text" class="form-control" name="client_name" id="" value="">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editBirthday">Birthday</label>
                            <input type="date" class="form-control" name="client_birthday" id="editBirthday" value="">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editAddress">Address</label>
                            <input type="text" class="form-control" name="client_address" id="" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editEmailAddress">Email address</label>
                            <input type="text" class="form-control" name="client_email" id="" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editPhone">Phone number</label>
                            <input type="text" class="form-control" name="client_no" id="" value="">
                        </div>
                        {{-- <div class="col-md-12 mt-4">--}}
                        {{-- <h6 class="text-primary">Change Password</h6>--}}
                        {{-- <hr class="mt-1 mb-0">--}}
                        {{-- </div>--}}
                        {{-- <div class="col-md-12">--}}
                        {{-- <label class="small mb-1" for="editOldPassword">Old Password</label>--}}
                        {{-- <input type="text" class="form-control" name="username" id="editOldPassword" placeholder="Enter old password" value="">--}}
                        {{-- </div>--}}
                        {{-- <div class="col-md-6">--}}
                        {{-- <label class="small mb-1" for="updateNewPassword">New Password</label>--}}
                        {{-- <input type="text" class="form-control" name="username" id="updateNewPassword" placeholder="Enter new password" value="">--}}
                        {{-- </div>--}}
                        {{-- <div class="col-md-6">--}}
                        {{-- <label class="small mb-1" for="updateConfirmNewPassword">Confirm New Password</label>--}}
                        {{-- <input type="text" class="form-control" name="username" id="updatConfirmeNewPassword" placeholder="Confirm password" value="">--}}
                        {{-- </div>--}}
                        <!-- Form Group (birthday)-->
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary" type="submit">Update</button></div>
            </form>

        </div>
    </div>
</div>


<div class="modal fade" id="updatePhotoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            <img id="currentProfilePhoto" class="img-account-profile img-fluid rounded-circle mb-2" src="{{ asset('assets/img/illustrations/profiles/profile-1.png') }}" alt="Profile Picture" />
                        </div>
                        <div class="col-md-6 d-flex flex-column align-items-center text-center p-3">
                            <label for="fileInput" class="btn btn-outline-primary mb-2">Select Photo</label>
                            <input type="file" name="photo" id="fileInput" class="d-none" accept="image/*" onchange="previewImage(event)" />
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
            <div class="row">

                <div class="col-xl-3">
                    <!-- Profile picture card-->
                    <div class="card shadow-none mb-4 mb-xl-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Profile Picture</span>
                            <!-- Three-dot (kebab) menu button -->
                            <div class="dropdown">
                                <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updatePhotoModal">Update Photo</a></li>
                                    <!-- You can add more items here -->
                                </ul>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img
                                class="img-account-profile img-fluid rounded-circle mb-2"
                                src="{{ asset('assets/img/illustrations/profiles/profile-1.png') }}"
                                alt="Profile Picture" />
                        </div>
                        <div class="card-footer text-center">
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <!-- Account details card-->
                    <div class="card shadow-none mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Information</span>
                            <!-- Three-dot (kebab) menu button -->
                            <div class="dropdown">
                                <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateInfo">Update Account</a></li>
                                    <!-- You can add more items here -->
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="small mb-1">Name</label>
                                    <p>{{$user->name}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">ID</label>
                                    <div>
                                        <p class="badge bg-primary-soft text-primary rounded-pill">{{ sprintf("VetIS-%05d", $user->id)}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Birthday</label>
                                    <p>{{\Carbon\Carbon::parse($userInfo->birthday)->format('F d, Y')}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Role</label>
                                    <div class="">
                                        <p class="badge bg-primary-soft text-primary rounded-pill">{{$user->role}}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="small mb-1" for="inputAddress">Address</label>
                                    <p>{{$userInfo->address}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                    <p>{{$user->email}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <p>{{$userInfo->phone_number}}</p>
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
