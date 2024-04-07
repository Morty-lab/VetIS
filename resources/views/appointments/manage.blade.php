@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<div class="modal fade" id="exampleModalXl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Appointment</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <h6 class="mb-2 text-primary">Appointment Schedule</h6>
                        <hr class="mt-1 mb-2">
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputEmailAddress">Appointment Date</label>
                            <input class="form-control" id="inputEmailAddress" type="date" />
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputEmailAddress">Appointment Time</label>
                            <input class="form-control" id="inputEmailAddress" type="time" />
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <h6 class="mb-2 mt-3 text-primary">Owner Information</h6>
                            <hr class="mt-1 mb-2">
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Name</label>
                                <input class="form-control" id="inputPetName" type="text" placeholder="Name" value="" />
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Contact Number</label>
                                <input class="form-control" id="inputPetName" type="text" placeholder="Contact Number" value="" />
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Email</label>
                                <input class="form-control" id="inputPetName" type="text" placeholder="Email" value="" />
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Address</label>
                                <input class="form-control" id="inputPetName" type="text" placeholder="Address" value="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-2 mt-3 text-primary">Pet Information</h6>
                            <hr class="mt-1 mb-2">
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Pet Name</label>
                                <input class="form-control" id="inputPetName" type="text" placeholder="Name" value="" />
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Pet Type</label>
                                <input class="form-control" id="inputPetName" type="text" placeholder="Pet Type" value="" />
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Breed</label>
                                <input class="form-control" id="inputPetName" type="text" placeholder="Breed" value="" />
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Age</label>
                                <input class="form-control" id="inputPetName" type="text" placeholder="Address" value="" />
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Service</label>
                                <input class="form-control" id="inputPetName" type="text" placeholder="Address" value="" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Save</button>
                <button class="btn btn-light text-primary" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon">
                            <i class="fa-regular fa-calendar-plus p-1"></i>
                        </div>
                        Manage Appointments
                    </h1>
                    <div class="page-header-subtitle">
                        Add and Edit Appointments
                    </div>
                </div>
                <div class="col-auto mt-4">
                    <button class="btn btn-white text-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalXl">Add Appointment</button>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class=" container-xl px-4 mt-n10">
    <div class="row">
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Today's Appointments</div>
                            <div class="text-lg fw-bold">25</div>
                        </div>
                        <i class="fa-regular fa-calendar text-white-50 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href="/todayappointments">View Today's Appointments</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Finished Appointments</div>
                            <div class="text-lg fw-bold">15</div>
                        </div>
                        <i class="fa-regular fa-calendar-check text-white-50 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href="/finishedappointments">View Finished Appointments</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Appointment Requests</div>
                            <div class="text-lg fw-bold">17</div>
                        </div>
                        <i class="fa-solid fa-xmark text-white-50 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href="/pendingappointments">View Requests</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Cancelled Appointments</div>
                            <div class="text-lg fw-bold">17</div>
                        </div>
                        <i class="feather-xl text-white-50" data-feather="message-circle"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href="/cancelledappointments">View Cancelled Appointments</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Appointments List</span>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Appointment ID</th>
                        <th>Owner</th>
                        <th>Pet Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>April 7, 2024 | 12:00PM</td>
                        <td>VETIS-00001</td>
                        <td>Kent Invento</td>
                        <td>Dog</td>
                        <td>
                            <div class="badge bg-primary text-white rounded-pill">Scheduled</div>
                        </td>
                        <td>
                            <a class="btn btn-outline-primary" href="/viewappointments">Open</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection