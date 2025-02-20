@php use App\Models\Clients;use Illuminate\Support\Facades\Auth; @endphp
@extends('portal.layouts.app')
@section('outerContent')
    <style>
        .custom-scroll {
            overflow-y: auto; /* Enable vertical scrolling */
            height: 300px;
            scrollbar-width: thin; /* For Firefox */
            scrollbar-color: #afafaf #f1f1f1; /* Thumb and track colors */
            padding-right: 10px;
        }

        /* For WebKit-based browsers (Chrome, Edge, Safari) */
        .custom-scroll::-webkit-scrollbar {
            width: 5px; /* Thin scrollbar */
        }
    </style>
<!-- Modals -->

<!-- Modal for Veterinarian Schedule -->
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel">Veterinarian Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Veterinarian</th>
                            <th>Scheduled Time <span class="text-sm fw-200">*vets are scheduled by this time</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table data will go here -->
                        <tr>
                            <td>Dr. John Doe</td>
                            <td><span class="badge bg-orange-soft text-orange ms-auto text-sm">December 2, 2024 | 5:00PM</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="appointmentRequestModal" tabindex="-1" aria-labelledby="currentModalLabel" aria-hidden="true"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('portal.appointments.add')}}" method="post">
                @csrf
                @php
                $client = Clients::getClientByUserID(Auth::user()->id)
                @endphp
                <input type="hidden" value="{{$client->id}}" name="owner_ID">
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
                                <select class="form-control" id="select-pet" name="pet_ID">
                                    <option value="" disabled selected>Select a Pet</option>
                                    @foreach($pets as $pet)
                                    <option value={{$pet->id}}>{{$pet->pet_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Select Veterinarian -->
                            <div class="form-group">
                                <label for="select-veterinarian" class="mb-1">Select Veterinarian</label>
                                <select class="form-control" id="select-veterinarian" name="doctor_ID">
                                    <option value="" disabled selected>Select a Veterinarian</option>
                                    @foreach($vets as $vet)
                                    <option
                                        value={{$vet->id}}>{{$vet->firstname. " " . $vet->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
{{--                        <div class="col-md-12">--}}
{{--                            <!-- View Veterinarian Schedule -->--}}
{{--                            <div class="form-group d-flex">--}}
{{--                                <label>&nbsp;</label> <!-- For spacing alignment -->--}}
{{--                                <br>--}}
{{--                                <a href="#" class="text-decoration-underline" data-bs-toggle="modal" data-bs-target="#scheduleModal" data-bs-dismiss="">View Veterinarian Schedule</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-md-6">
                            <!-- Select Schedule -->
                            <div class="form-group">
                                <label for="select-schedule" class="mb-1">Select Date</label>
                                <input type="text" class="form-control" id="select-schedule" name="appointment_date" placeholder="YYYY-MM-DD">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Select Schedule -->
                            <div class="form-group">
                                <label for="select-schedule" class="mb-1">Select Time</label>
                                <input type="text" class="form-control" id="timePicker"
                                       name="appointment_time">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- Concern/Complain -->
                            <div class="form-group">
                                <label for="concern-complain" class="mb-1">Purpose</label>
                                <textarea class="form-control" id="concern-complain" name="purpose" rows="5"
                                    placeholder="Enter the purpose of your appointment"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="submitAppointment" type="submit">Request Appointment</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--<div class="modal fade" id="appointmentRequestModal" tabindex="-1" aria-labelledby="currentModalLabel" aria-hidden="true"--}}
{{--     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <form action="{{route('portal.appointments.add')}}" method="post">--}}
{{--                @csrf--}}
{{--                @php--}}
{{--                    $client = Clients::getClientByUserID(Auth::user()->id)--}}
{{--                @endphp--}}
{{--                <input type="hidden" value="{{$client->id}}" name="owner_ID">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="appointmentRequestTitle">Request Appointment</h5>--}}
{{--                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <h4 class="text-center text-primary mb-3">Select a Veterinarian</h4>--}}

{{--                    <div class="row gx-4 d-flex justify-content-center mt-3">--}}
{{--                        <div class="col-md-5 mb-4">--}}
{{--                            <div class="card border-top-lg border-top-primary shadow-none border">--}}
{{--                                <div class="card-body p-0">--}}
{{--                                    <div class="d-flex justify-content-center pt-2 px-2">--}}
{{--                                        <img class="img-account-profile mb-2 rounded-circle border w-50 h-50" src="http://127.0.0.1:8000/assets/img/illustrations/profiles/profile-1.png" alt="Profile Picture">--}}
{{--                                    </div>--}}
{{--                                    <div class="pet-info mt-2 py-1 px-3 border-top bg-white">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-10">--}}
{{--                                                <p class="mb-0 fw-bold">John Doe</p>--}}
{{--                                                <p class="mb-0">Veterinarian I</p></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="card-footer mt-0 px-3 py-1 d-flex justify-content-end">--}}
{{--                                    <a href="" class="btn btn-primary w-100">Select</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-5 mb-4">--}}
{{--                            <div class="card border-top-lg border-top-primary shadow-none border">--}}
{{--                                <div class="card-body p-0">--}}
{{--                                    <div class="d-flex justify-content-center pt-2 px-2">--}}
{{--                                        <img class="img-account-profile mb-2 rounded-circle border w-50 h-50" src="http://127.0.0.1:8000/assets/img/illustrations/profiles/profile-1.png" alt="Profile Picture">--}}
{{--                                    </div>--}}
{{--                                    <div class="pet-info mt-2 py-1 px-3 border-top bg-white">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-10">--}}
{{--                                                <p class="mb-0 fw-bold">John Doe</p>--}}
{{--                                                <p class="mb-0">Veterinarian I</p></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="card-footer mt-0 px-3 py-1 d-flex justify-content-end">--}}
{{--                                    <a href="" class="btn btn-primary w-100">Select</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <h4 class="text-center text-primary mb-3">Select a Pet</h4>--}}

{{--                    <div class="row gx-4 d-flex">--}}
{{--                        <div class="d-flex flex-wrap gap-3">--}}
{{--                            <div>--}}
{{--                                <input type="checkbox" class="btn-check" id="option1" autocomplete="off">--}}
{{--                                <label class="btn btn-outline-primary" for="option1">Lexie</label>--}}
{{--                            </div>--}}

{{--                            <div>--}}
{{--                                <input type="checkbox" class="btn-check" id="option2" autocomplete="off">--}}
{{--                                <label class="btn btn-outline-primary" for="option2">Arram</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="modal fade" id="appointmentRequestModal" tabindex="-1" aria-labelledby="currentModalLabel" aria-hidden="true"--}}
{{--     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <form action="{{route('portal.appointments.add')}}" method="post">--}}
{{--                @csrf--}}
{{--                @php--}}
{{--                    $client = Clients::getClientByUserID(Auth::user()->id)--}}
{{--                @endphp--}}
{{--                <input type="hidden" value="{{$client->id}}" name="owner_ID">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="appointmentRequestTitle">Request Appointment</h5>--}}
{{--                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body p-0">--}}
{{--                    <div class="row m-0">--}}
{{--                        <div class="col-md-4 px-3 py-1 border-end">--}}
{{--                            <p class="text-primary mb-0 mt-2 fw-bold">Select a Veterinarian</p>--}}
{{--                            <hr class="mt-2">--}}
{{--                            <div class="vets custom-scroll">--}}
{{--                                <div class="w-100 mb-2">--}}
{{--                                    <input type="checkbox" class="btn-check" id="option1" autocomplete="off">--}}
{{--                                    <label class="btn btn-outline-primary w-100" for="option1">Option 1</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-8">--}}
{{--                            <p class="text-primary mb-3 mt-2 fw-bold">Select a Pet</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer"></div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--    <div class="modal fade" id="appointmentRequestModal" tabindex="-1" aria-labelledby="currentModalLabel" aria-hidden="true"--}}
{{--         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <form action="{{route('portal.appointments.add')}}" method="post">--}}
{{--                    @csrf--}}
{{--                    @php--}}
{{--                        $client = Clients::getClientByUserID(Auth::user()->id)--}}
{{--                    @endphp--}}
{{--                    <input type="hidden" value="{{$client->id}}" name="owner_ID">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title" id="appointmentRequestTitle">Request Appointment</h5>--}}
{{--                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body p-0">--}}
{{--                        <div class="row m-0">--}}
{{--                            <div class="col-md-4 px-3 py-1 border-end">--}}
{{--                                <p class="text-primary mb-0 mt-2 fw-bold">Select a Veterinarian</p>--}}
{{--                                <hr class="mt-2">--}}
{{--                                <div class="vets custom-scroll">--}}
{{--                                    <div class="w-100 mb-2">--}}
{{--                                        <input type="checkbox" class="btn-check" id="option1" autocomplete="off">--}}
{{--                                        <label class="btn btn-outline-primary w-100" for="option1">Option 1</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-8">--}}
{{--                                <p class="text-primary mb-3 mt-2 fw-bold">Select a Pet</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer"></div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Use Blade to output the route URL and assign it to a JavaScript variable
        const formAction = "{{ route('portal.appointments.add') }}"; // Blade handles this
        const form = document.querySelector(`form[action="${formAction}"]`);
        const submitButton = document.getElementById('submitAppointment');

        if (form && submitButton) {
            form.addEventListener('submit', () => {
                submitButton.disabled = true; // Disable the button
                submitButton.textContent = 'Submitting...'; // Optionally, update the text
            });
        }
    });
</script>

<header class="mt-n10 pt-10 bg-white border-bottom">
    <div class="container-xl px-4">
        <div class="page-header-content py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="text-primary mb-0">Appointments</h1>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                    data-bs-target="#appointmentRequestModal">Request Appointment
                </button>
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        @php
        $client = Clients::getClientByUserID(Auth::user()->id);
        $today = \App\Models\Appointments::where('status', 0)->where('owner_ID',$client->id )->where('appointment_date', \Carbon\Carbon::today())->get()->count();
        $scheduled = \App\Models\Appointments::where('status', 0)->where('owner_ID',$client->id )->get()->count();
        $requests = \App\Models\Appointments::where('status', null)->where('owner_ID',$client->id )->get()->count();
        @endphp
        <nav class="nav nav-borders">
            <a class="nav-link ms-0 nav-tab{{ request()->is('today') ? 'active' : '' }}" href="#today">
                Today's <span class="badge bg-primary-soft text-primary ms-auto">{{$today}}</span>
            </a>
            <a class="nav-link nav-tab{{ request()->is('scheduled') ? 'active' : '' }}" href="#scheduled">
                Scheduled <span class="badge bg-secondary-soft text-secondary ms-auto">{{$scheduled}}</span>
            </a>
            <a class="nav-link nav-tab{{ request()->is('requests') ? 'active' : '' }}" href="#requests">
                My Requests <span class="badge bg-warning-soft text-warning ms-auto">{{$requests}}</span>
            </a>
            <a class="nav-link nav-tab{{ request()->is('history') ? 'active' : '' }}" href="#history">
                My History
            </a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="card shadow-none border mb-5" id="todaysCard" style="display:none;">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Today's Appointments</span>
            </div>
            <div class="card-body">
                <table id="todaysAppointmentsTable">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Appointment ID</th>
                            <th>Pet</th>
                            <th>Veterinarian</th>
                            <th>Purpose</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $s)
                        @if( ($s->status === 0) && (\Carbon\Carbon::parse($s->appointment_date)->isToday() ))
                        @php
                        $pet = \App\Models\Pets::getPetById($s->pet_ID);
                        $owner = Clients::getClientById($s->owner_ID);
                        @endphp
                        <tr data-index="0">
                            <td>{{$s->appointment_date}} |
                                {{$s->appointment_time}}
                            </td>
                            <td>{{sprintf("VetIS-%05d", $s->id)}}</td>
                            <td>{{$pet->pet_name}}</td>
                            <td>{{$owner->client_name}}</td>
                            <td>{{$s->purpose}}</td>
                            <td>
                                <span class="badge bg-success-soft text-success text-sm rounded-pill">
                                    Scheduled
                                </span>
                            </td>
                            <td>
                                <a class="btn btn-outline-primary" href="{{route('portal.appointments.view',['appid'=>$s->id, 'petid'=>$s->pet_ID])}}">Open</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow-none border mb-5" id="scheduledCard" style="display:none;">
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
                            <th>Purpose</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $s)
                        @if( ($s->status === 0) && (\Carbon\Carbon::parse($s->appointment_date)->isToday() || \Carbon\Carbon::parse($s->appointment_date)->isFuture()))
                        @php
                        $pet = \App\Models\Pets::getPetById($s->pet_ID);
                        $vet = \App\Models\Doctor::getDoctorById($s->doctor_ID);

                        @endphp
                        <tr data-index="0">
                            <td>{{$s->appointment_date}} |
                                {{$s->appointment_time}}
                            </td>
                            <td>{{sprintf("VetIS-%05d", $s->id)}}</td>
                            <td>{{$pet->pet_name}}</td>
                            <td>{{$vet->firstname. ' ' . $vet->lastname}}</td>
                            <td>{{$s->purpose}}</td>
                            <td>
                                <span class="badge bg-success-soft text-success text-sm rounded-pill">
                                    Scheduled
                                </span>
                            </td>
                            <td>
                                <a class="btn btn-outline-primary" href="{{route('portal.appointments.view',['appid'=>$s->id, 'petid'=>$s->pet_ID])}}">Open</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-5 mt-0" id="requestsCard" style="display:none;">
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
                        @foreach($appointments as $a)
                        @if(($a->status === null) && (\Carbon\Carbon::parse($a->appointment_date)->isToday() || \Carbon\Carbon::parse($a->appointment_date)->isFuture()))
                        @php
                        $pet = \App\Models\Pets::getPetById($a->pet_ID);
                        $vet = \App\Models\Doctor::getDoctorById($a->doctor_ID);

                        @endphp
                        <tr data-index="0">
                            <td>{{$a->appointment_date}} |
                                {{$a->appointment_time}}
                            </td>
                            <td>{{sprintf("VetIS-%05d", $a->id)}}</td>
                            <td>{{$pet->pet_name}}</td>
                            <td>{{$vet->firstname. ' ' . $vet->lastname}}</td>

                            <td>{{$a->purpose}}</td>
                            <td>
                                {{-- <span class="badge bg-success-soft text-success text-sm rounded-pill">--}}
                                {{-- Scheduled--}}
                                {{-- </span>--}}
                                <span class="badge bg-warning-soft text-warning text-sm rounded-pill">Pending</span>
                                {{-- <span class="badge bg-danger-soft text-danger text-sm rounded-pill">Cancelled</span>--}}
                            </td>
                            <td>
                                <a class="btn btn-outline-primary" href="{{route('portal.appointments.view',['appid'=>$a->id, 'petid'=>$a->pet_ID])}}">Open</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-4" id="historyCard" style="display:none;">
        <div class="card shadow-none border">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Appointment History</span>
            </div>
            <div class="card-body">
                <table id="appointmentsHistoryTable">
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
                        @foreach($appointments as $a)
                        {{-- @if(\Carbon\Carbon::parse($a->appointment_date)->lt(\Carbon\Carbon::today()) )--}}
                        @php
                        $pet = \App\Models\Pets::getPetById($a->pet_ID);
                        $vet = \App\Models\Doctor::getDoctorById($a->doctor_ID);
                        @endphp
                        <tr data-index="0">
                            <td>{{$a->appointment_date}} |
                                {{$a->appointment_time}}
                            </td>
                            <td>{{sprintf("VetIS-%05d", $a->id)}}</td>
                            <td>{{$pet->pet_name}}</td>
                            <td>{{$vet->firstname. ' ' . $vet->lastname}}</td>
                            <td>{{$a->purpose}}</td>
                            <td>
                                {{-- <span class="badge bg-success-soft text-success text-sm rounded-pill">--}}
                                {{-- Scheduled--}}
                                {{-- </span>--}}
                                <span class="badge bg-warning-soft text-warning text-sm rounded-pill">Pending</span>
                                {{-- <span class="badge bg-danger-soft text-danger text-sm rounded-pill">Cancelled</span>--}}
                            </td>
                            <td>
                                <a class="btn btn-outline-primary" href="{{route('portal.appointments.view',['appid'=>$a->id, 'petid'=>$a->pet_ID])}}">Open</a>
                            </td>
                        </tr>
                        {{-- @endif--}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Check if the 'openModal' parameter is present in the URL
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('openModal') && urlParams.get('openModal') === 'true') {
            // Open the modal after the page is loaded
            var modal = new bootstrap.Modal(document.getElementById('appointmentRequestModal'));
            modal.show();
        }
    };
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#select-schedule", {
            dateFormat: "Y-m-d", // Format for the selected date (equivalent to Litepicker's 'YYYY-MM-DD')
            minDate: "today", // Disallow past dates
            maxDate: new Date().fp_incr(60), // Limit to 2 months ahead (60 days)
        });
    });
    flatpickr("#timePicker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i", // Time format with seconds
        minTime: "08:00",
        maxTime: "17:00",
        minuteIncrement: 5, // Optional: set minute increment
    });

    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.nav-tab');
        const cards = {
            'today': document.getElementById('todaysCard'),
            'scheduled': document.getElementById('scheduledCard'),
            'requests': document.getElementById('requestsCard'),
            'history': document.getElementById('historyCard'),
        };

        // Ensure the default tab and card are visible
        document.querySelector('.nav-tab[href="#today"]').classList.add('active');
        cards['today'].style.display = 'block'; // Show Scheduled Card by default

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                // Hide all cards
                Object.values(cards).forEach(card => card.style.display = 'none');

                // Show the clicked tab's corresponding card
                const target = tab.getAttribute('href').substring(1); // Extract target ID (e.g., 'scheduled')
                if (cards[target]) {
                    cards[target].style.display = 'block';
                }
            });
        });

        // Trigger the click on the Scheduled tab to show it initially
        document.querySelector('.nav-tab[href="#today"]').click();
    });
</script>



@endsection
