@extends('layouts.app')

@section('styles')
@endsection

@section('content')
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
                    <li class="breadcrumb-item"><a href="/um/admin">Manage Administrator</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-4">


    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link ms-0 active" href="{{route('admin.profile', ['id'=> $admin->id])}}">Profile</a>
        <a class="nav-link" href="{{route('admin.profile.options', ['id' => $admin->id])}}">Options</a>
    </nav>
    <hr class="mt-0 mb-4" />
    <div class="row">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card shadow-none mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Account Information</span>
                    <!-- Three-dot (kebab) menu button -->
                    <div class="dropdown">
                        <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="{{route('admins.update')}}">Edit Account</a></li>
                            <!-- You can add more items here -->
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    <form action="" method="POST">
                        <!-- Form Row-->
                        <div class="row gx-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <p class="small mb-1">First name</p>
                                <p>{{$admin->firstname}}</p>
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <p class="small mb-1">Last name</p>
                                <p>{{$admin->lastname}}</p>
                            </div>
                        </div>
                        <div>
                            <p class="small mb-1">Address (Street, Barangay, City/Municipality, Province)</p>
                            <p>{{$admin->address}}</p>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <p class="small mb-1">Phone number</p>
                                <p>{{$admin->phone_number}}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="small mb-1">Email Address</p>
                                <p>{{$admin->getEmailAttribute($admin->id)}}</p>
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <p class="small mb-1">Birthday</p>
                                <p>{{$admin->birthday}}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="small mb-1">Position</p>
                                <p>Administrator</p>
                            </div>
                        </div>

                        {{-- <div class="mb-3">--}}
                        {{-- <p class="small mb-1">Username</p>--}}
                        {{-- <p>KentTheAdministrator</p>--}}
                        {{-- </div>--}}
                    </form>
                </div>
            </div>


            <!-- Edit Account Card #ONLY SHOWS WHEN EDIT IS CLICKED -->
            <!-- <div class="card mb-4">
                <div class="card-header">Account Information</div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <input class="form-control" id="inputFirstName" type="text" name="firstname" placeholder="First Name" value="Kent" />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class="form-control" id="inputLastName" type="text" name="lastname" placeholder="Last Name" value="Invento" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputAddress">Address (Street, Barangay, City/Municipality,
                                Province)</label>
                            <input class="form-control" id="inputAddress" type="text" name="address" placeholder="Address" value="Purok - 3, Batangan, Valencia City, Bukidnon" />
                        </div>
                        <div class="row gx-3 gy-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" type="tel" name="phone_number" placeholder="Phone Number" value="09942194953" />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputEmail">Email Address</label>
                                <input class="form-control" id="inputEmail" type="email" name="email_address" placeholder="Email Address" value="kentinvento@gmail.com" />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control" id="inputBirthday" type="date" name="birthday" placeholder="MM/DD/YYYY" value="08/11/2002" />
                            </div>
                        </div>
                        <button class="btn btn-primary" id="regbtn" type="submit">Save
                            Changes</button>
                    </form>
                </div>
            </div> -->
        </div>
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card shadow-none mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" id="petPhotoPreview" src="{{$admin->profile_picture != null ? asset('storage/' . $admin->profile_picture) : asset('assets/img/illustrations/profiles/profile-1.png')}}" alt="" />
                </div>
                <div class="card-footer text-center">
                    <form id="petPhotoForm" action="{{ route('uploadPhoto', $admin->user_id) }}" method="POST" >
                        @csrf

                        <input type="file" id="petPhotoInput" name="photo" accept="image/jpeg,image/png" style="display: none;" onchange="uploadPetPhoto()">
                        <button class="btn btn-primary" type="button" onclick="document.getElementById('petPhotoInput').click();">Select Photo</button>
                    </form>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the register button
        var registerButton = document.getElementById('regbtn');

        // Add event listener to the register button
        registerButton.addEventListener('click', function() {
            // Show the success alert
            var successAlert = document.getElementById('successAlert');
            successAlert.style.display = 'flex';

            setTimeout(function() {
                window.location.href = '/managedoctor';
            }, 4000);

            // Optionally, hide the alert after a certain period (e.g., 3 seconds)
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 3000);
        });
    });
</script>
@endsection

@section('scripts')
@endsection
