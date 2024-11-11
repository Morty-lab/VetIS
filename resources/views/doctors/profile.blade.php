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
                    <li class="breadcrumb-item"><a href="/managedoctor">Manage Veterinarians</a></li>
                    <li class="breadcrumb-item active">Veterinarian Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-4">


    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link ms-0 active" href="{{ route('doctor.profile', $doctor->id) }}">Profile</a>
        <a class="nav-link" href="{{ route('doctor.admin', $doctor->id) }}">UM Settings</a>
    </nav>
    <hr class="mt-0 mb-4" />
    <div class="row">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Registration</div>
                <div class="card-body">
                    <form action="{{ route('doctor.update', $doctor->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <input class="form-control" id="inputFirstName" type="text" name="firstname"
                                    placeholder="First Name" value="{{ $doctor->doctor->firstname }}" />
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class="form-control" id="inputLastName" type="text" name="lastname"
                                    placeholder="Last Name" value="{{ $doctor->doctor->lastname }}" />
                            </div>

                        </div>
                        <!-- Form Group (last name)-->

                        <div class="mb-3">
                            <label class="small mb-1" for="inputAddress">Address (Street, Barangay, City/Municipality,
                                Province)</label>
                            <input class="form-control" id="inputAddress" type="text" name="address"
                                placeholder="Address" value="{{ $doctor->doctor->address }}" />
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" type="tel" name="phone_number"
                                    placeholder="Phone Number" value="{{ $doctor->doctor->phone_number }}" />
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control" id="inputBirthday" type="date" name="birthday"
                                    placeholder="MM/DD/YYYY" value="{{ $doctor->doctor->birthday }}" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPosition">Position</label>
                            <input class="form-control" id="inputPosition" type="text" name="position"
                                placeholder="Position" value="{{ $doctor->doctor->position }}" />
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username</label>
                            <input class="form-control" id="inputUsername" type="text" name="name"
                                placeholder="Username" value="{{ $doctor->name }}" />
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" id="regbtn" type="submit">Save
                            Changes</button>
                    </form>


                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/illustrations/profiles/profile-1.png') }}" alt="" />
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" type="button">Upload new image</button>
                </div>
            </div>
        </div>
    </div>
</div>

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
