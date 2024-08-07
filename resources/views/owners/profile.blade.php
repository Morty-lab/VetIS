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
        Owner Registered Successfully!
    </div>
</div>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="/managedoctor">Manage Pet Owner</a></li>
                    <li class="breadcrumb-item active">Owner Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <div class="row">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Pet Owner Information</div>
                <div class="card-body">
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <div class="mb-3">
                            <label class="small mb-1"">Owner ID</label>
                            <p>OWN0001</p>
                        </div>
                        <!-- Form Group (first name)-->
                        <div class=" col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <p>Kent</p>
                        </div>
                        <!-- Form Group (last name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputLastName">Last name</label>
                            <p>Invento</p>
                        </div>
                    </div>
                    <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                        <p>princeinventorevltn89@gmail.com</p>
                    </div>
                    <!-- Add similar error handling for other fields -->
                    <!-- Form Group (address)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputAddress">Address</label>
                        <p>Purok - 3, Batangan, Valencia City, Bukidnon</p>
                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (phone number)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputPhone">Phone number</label>
                            <p>09942194953</p>
                        </div>
                        <!-- Form Group (birthday)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBirthday">Birthday</label>
                            <p>August 11, 2002</p>
                        </div>
                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (password)-->
                        <div class="col-md-6">
                            <label class="small mb-1">Pets Owned</label>
                            <p>1</p>
                        </div>
                        <!-- Form Group (confirm password)-->
                        <div class="col-md-6">
                            <label class="small mb-1">Username</label>
                            <p>revltn</p>
                        </div>
                    </div>
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
                </div>
            </div>
            <div class="card mb-4 mt-4 mb-xl-0">
                <div class="card-header">Actions</div>
                <div class="card-body">
                    <!-- Profile picture image-->
                    <button class="btn btn-primary m-1" type="button">Update Account</button>
                    <button class="btn btn-primary m-1" type="button">Reset Password</button>
                    <button class="btn btn-primary m-1" type="button">Disable Account</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Pets List</span>
            <a class="btn btn-primary justify-end" href="/addpet">Add Pet</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>PetID</th>
                        <th>Pet Name</th>
                        <th>Type</th>
                        <th>Breed</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Owner</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>00001</td>
                        <td>Lexie</td>
                        <td>Dog</td>
                        <td>Japanese Spitz</td>
                        <td>7 Months</td>
                        <td>Female</td>
                        <td>Kent Invento</td>
                        <td>
                            <div class="badge bg-primary text-white rounded-pill">Vaccinated</div>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="/profilepet">Open</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mb-2">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Billing History</span>
        </div>
        <div class="card-body">
            <table id="billingTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Billing #</th>
                        <th>Payable</th>
                        <th>Remaining</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>04/19/2024</td>
                        <td>PH20324232</td>
                        <td>Php. 2000</td>
                        <td>Php. 0.00</td>
                        <td>
                            <a class="btn btn-primary" href="/profilepet">Open</a>
                        </td>
                    </tr>
                </tbody>
            </table>
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