@extends('portal.layouts.app')
@section('outerContent')
<!-- Modals -->
<div class="modal fade" id="appointmentRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentRequestTitle">Request Appointment</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gy-3 gx-4">
                    <div class="col-md-6">
                        <!-- Select Pet -->
                        <div class="form-group">
                            <label for="select-pet" class="mb-1">Select Pet</label>
                            <select class="form-control" id="select-pet" name="pet">
                                <option value="" disabled selected>Select a Pet</option>
                                <option value="dog">Dog</option>
                                <option value="cat">Cat</option>
                                <option value="bird">Bird</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Select Schedule -->
                        <div class="form-group">
                            <label for="select-schedule" class="mb-1">Select Schedule</label>
                            <input type="date" class="form-control" id="select-schedule" name="schedule">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Select Veterinarian -->
                        <div class="form-group">
                            <label for="select-veterinarian" class="mb-1">Select Veterinarian</label>
                            <select class="form-control" id="select-veterinarian" name="veterinarian">
                                <option value="" disabled selected>Select a Veterinarian</option>
                                <option value="vet1">Dr. Smith</option>
                                <option value="vet2">Dr. Johnson</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- View Veterinarian Schedule -->
                        <div class="form-group">
                            <label>&nbsp;</label> <!-- For spacing alignment -->
                            <br>
                            <a href="#" class="text-decoration-underline">View Veterinarian Schedule</a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <!-- Concern/Complain -->
                        <div class="form-group">
                            <label for="concern-complain" class="mb-1">Concern/Complain</label>
                            <textarea class="form-control" id="concern-complain" name="concern_complain" rows="5" placeholder="Enter your concern or complaint"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button">Request Appointment</button>
            </div>
        </div>
    </div>
</div>



<header class="mt-n10 pt-10 bg-white border-bottom">
    <div class="container-xl px-4">
        <div class="page-header-content py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="text-primary">Appointments</h1>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#appointmentRequestModal">Request Appointment</button>
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 mb-5">
        <div class="card shadow-none border">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Scheduled Appointments</span>
            </div>
            <div class="card-body">
                <table id="scheduledAppointmentsTable">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Appointment ID</th>
                            <th>Pet</th>
                            <th>Veterinarian</th>
                            <th>Complaint/Concern</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-index="0">
                            <td>2 May, 2024 |
                                07:25</td>
                            <td>VETIS-00004</td>
                            <td>Lexie</td>
                            <td>Kent Invento</td>
                            <td>This is the Complaint/Concern</td>
                            <td>
                                <span class="badge bg-success-soft text-success text-sm rounded-pill">
                                    Scheduled
                                </span>
                            </td>
                            <td>
                                <a class="btn btn-outline-primary" href="{{route('portal.appointments.view')}}">Open</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card shadow-none border">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Appointment Requests</span>
            </div>
            <div class="card-body">
                <table id="appointmentsRequestsTable">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Appointment ID</th>
                            <th>Pet</th>
                            <th>Veterinarian</th>
                            <th>Complaint/Concern</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-index="0">
                            <td>2 May, 2024 |
                                07:25</td>
                            <td>VETIS-00004</td>
                            <td>Lexie</td>
                            <td>Kent Invento</td>
                            <td>This is a complaint/concern</td>
                            <td>
                                <span class="badge bg-success-soft text-success text-sm rounded-pill">
                                    Scheduled
                                </span>
                                <span class="badge bg-warning-soft text-warning text-sm rounded-pill">Pending</span>
                                <span class="badge bg-danger-soft text-danger text-sm rounded-pill">Cancelled</span>
                            </td>
                            <td>
                                <a class="btn btn-outline-primary" href="">Open</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection