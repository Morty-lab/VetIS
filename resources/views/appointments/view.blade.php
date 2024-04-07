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
                    <li class="breadcrumb-item"><a href="/manageappointments">Manage Appointments</a></li>
                    <li class="breadcrumb-item active">View Appointments</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Appointment Details</div>
                <div class="card-body">
                    <div class="card-icon mb-4 border border-1 rounded">
                        <div class="row g-0">
                            <div class="col-sm-2 card-icon-aside bg-info p-4 rounded"><i class="text-white-50 fa-regular fa-calendar-check"></i></div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col">
                                        <div class="card-body py-4">
                                            <h5 class="card-title">Appointment ID</h5>
                                            <p class="card-text">
                                                VETIS-00001
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card-body py-4">
                                            <h5 class="mb-1 text-dark-90">Appointment Status</h5>
                                            <div class="badge bg-success text-white rounded-pill">Scheduled</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <h6 class="mb-2 text-primary">Appointment Schedule</h6>
                        <hr class="mt-1 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputEmailAddress">Appointment Date</label>
                            <p>April 7, 2024</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputEmailAddress">Appointment Time</label>
                            <p>12:00PM</p>
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <h6 class="mb-2 mt-3 text-primary">Owner Information</h6>
                            <hr class="mt-1 mb-2">
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Name</label>
                                <p>Kent Invento</p>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Contact Number</label>
                                <p>09942194953</p>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Email</label>
                                <p>princeinventorevltn89@gmail.com</p>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Address</label>
                                <p>Purok - 3, Batangan, Valencia City, Bukidnon</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-2 mt-3 text-primary">Pet Information</h6>
                            <hr class="mt-1 mb-2">
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Pet Name</label>
                                <p>Lexie</p>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Pet Type</label>
                                <p>Dog</p>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Breed</label>
                                <p>Japanese Spitz</p>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Age</label>
                                9 Months
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Service</label>
                                <p>Pet Vaccination</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Actions</div>
                <div class="card-body">
                    <div class="row gx-2">
                        <div class="col">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" id="dropdownFadeIn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Update Status</button>
                                <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownFadeIn">
                                    <a class="dropdown-item" href="#!">Done Appointment</a>
                                    <a class="dropdown-item" href="#!">Cancel Appointment</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <a href="" class="btn btn-secondary">Edit Appointment</a>
                        </div>
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