@extends('portal.layouts.app')

@section('outerContent')
<!-- Modals -->
<div class="modal fade" id="updateOwnerInfo" tabindex="-1" role="dialog" aria-labelledby="updateOwnerInfoTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('portal.profile.update', ['id' => $owner->id])}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="updateOwnerInfoTitle">Update Account</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class=" col-md-12">
                            <label class="small mb-1" for="editFirstName">Owner Name</label>
                            <input type="text" class="form-control" name="client_name" id="" value="{{$owner->client_name}}">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editBirthday">Birthday</label>
                            <input type="date" class="form-control" name="client_birthday" id="editBirthday" value="{{$owner->client_birthday}}">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editAddress">Address</label>
                            <input type="text" class="form-control" name="client_address" id="" value="{{$owner->client_address}}">
                        </div>
                        <div class="col-md-6">
                            @php
                                $owner_email = \App\Models\Clients::setEmailAttribute($owner,$owner->user_id)
                            @endphp
                            <label class="small mb-1" for="editEmailAddress">Email address</label>
                            <input type="text" class="form-control" name="client_email" id="" value="{{$owner->client_email}}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editPhone">Phone number</label>
                            <input type="text" class="form-control" name="client_no" id="" value="{{$owner->client_no}}">
                        </div>
                        {{--                    <div class="col-md-12 mt-4">--}}
                        {{--                        <h6 class="text-primary">Change Password</h6>--}}
                        {{--                        <hr class="mt-1 mb-0">--}}
                        {{--                    </div>--}}
                        {{--                    <div class="col-md-12">--}}
                        {{--                        <label class="small mb-1" for="editOldPassword">Old Password</label>--}}
                        {{--                        <input type="text" class="form-control" name="username" id="editOldPassword" placeholder="Enter old password" value="">--}}
                        {{--                    </div>--}}
                        {{--                    <div class="col-md-6">--}}
                        {{--                        <label class="small mb-1" for="updateNewPassword">New Password</label>--}}
                        {{--                        <input type="text" class="form-control" name="username" id="updateNewPassword" placeholder="Enter new password" value="">--}}
                        {{--                    </div>--}}
                        {{--                    <div class="col-md-6">--}}
                        {{--                        <label class="small mb-1" for="updateConfirmNewPassword">Confirm New Password</label>--}}
                        {{--                        <input type="text" class="form-control" name="username" id="updatConfirmeNewPassword" placeholder="Confirm password" value="">--}}
                        {{--                    </div>--}}
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
            <form id="updateProfilePhotoForm" action="{{ route('portal.profile.upload', ['id' => $owner->id]) }}" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Update Profile Picture</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">

                    @csrf
                    <div class="row justify-content-center align-items-center" style="height: 100%;">
                        <div class="col-md-6 d-flex flex-column align-items-center text-center border-end p-3 pe-3">
                            <img id="currentProfilePhoto" class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/illustrations/profiles/profile-1.png') }}" alt="Profile Picture" />
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

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('currentProfilePhoto');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>



<header class="mt-n10 pt-10 bg-white border-bottom">
    <div class="container-xl px-4">
        <div class="page-header-content py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="text-primary mb-0">Profile</h1>
            </div>
        </div>
    </div>
</header>

@endsection

@section('content')
<div class="row">
    <div class="col-md-12" id="ownerProfileCard">
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
                            class="img-account-profile rounded-circle mb-2"
                            src="{{ $owner->client_profile_picture ? asset('storage/' . $owner->client_profile_picture) : asset('assets/img/illustrations/profiles/profile-1.png') }}"
                            alt="Profile Picture"
                        />
                    </div>
                    <div class="card-footer text-center">
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <!-- Account details card-->
                <div class="card shadow-none mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Owner Information</span>
                        <!-- Three-dot (kebab) menu button -->
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateOwnerInfo">Update Account</a></li>
                                <!-- You can add more items here -->
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="small mb-1">Owner Name</label>
                                <p>{{$owner->client_name}}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Owner ID</label>
                                <div>
                                    <p class="badge bg-primary-soft text-primary rounded-pill">{{ sprintf("OWN-%05d", $owner->id)}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <p>{{\Carbon\Carbon::parse($owner->client_birthday)->format('F j, Y')}}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Pets Owned</label>
                                <p>{{$owner_email::petsOwned($owner->id)->count()}}</p>
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputAddress">Address</label>
                                <p>{{$owner->client_address}}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <p>{{$owner->client_email}}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <p>{{$owner->client_no}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
