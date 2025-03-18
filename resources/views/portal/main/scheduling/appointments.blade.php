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
        /* Disable green border and icons for valid fields */
        .was-validated .form-control:valid,
        .form-control.is-valid {
            border-color: #ced4da !important; /* Default border */
            padding-right: 0.75rem !important; /* No extra padding */
            background-image: none !important; /* No check icon */
            background-repeat: no-repeat;
            background-position: center right 0.375rem;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
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

{{-- Pending Appointment Request Success --}}
    <div class="modal fade" id="appointmentRequestSuccess" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content position-relative">
                <!-- Close Button Floating -->
                <button type="button" class="btn-close position-absolute end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 1051;"></button>

                <div class="modal-body d-flex flex-column justify-content-center align-items-center py-4 px-3">
                    <i class="fa-solid fa-circle-check fa-5x text-success mb-3"></i>
                    <h3 class="text-primary text-center mb-3">Appointment Request Sent Successfully</h3>
                    <p class="text-sm text-center mb-4">
                        Your appointment request has been submitted. You will receive confirmation once approved.
                    </p>

                    <div class="row border w-100 bg-white rounded py-3 px-2 m-0">
                        <div class="col-md-12 mb-3">
                            <p class="fw-bold mb-1">Pet Owner</p>
                            <p class="mb-0">Jane Doe</p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <p class="fw-bold mb-1">Pet/s</p>
                            <span class="badge bg-primary-soft text-primary text-sm rounded-pill">Lexie</span>
                            <span class="badge bg-primary-soft text-primary text-sm rounded-pill">Lexie</span>
                            <span class="badge bg-primary-soft text-primary text-sm rounded-pill">Lexie</span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <p class="fw-bold mb-1">Reason for Appointment</p>
                            <p class="mb-0">Reason Here</p>
                        </div>

                        <hr>

                        <div class="col-md-12 mb-3">
                            <p class="fw-bold mb-1">Attending Veterinarian</p>
                            <p class="mb-0">Dr. John Doe</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <p class="fw-bold mb-1">Appointment Date</p>
                            <p class="mb-0">March 17, 2025</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <p class="fw-bold mb-1">Appointment Time</p>
                            <p class="mb-0">2:30PM</p>
                        </div>

                        <div class="col-md-6">
                            <p class="fw-bold mb-1">Appointment Status</p>
                            <p class="text-warning mb-0">Pending...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="appointmentRequestModal" tabindex="-1" aria-labelledby="currentModalLabel" aria-hidden="true"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('portal.appointments.add')}}" method="post" class="needs-validation" id="appointmentRequestForm" novalidate>
                @csrf
                @php
                $client = Clients::getClientByUserID(Auth::user()->id)
                @endphp
                <input type="hidden" value="{{$client->id}}" name="owner_ID">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentRequestTitle">Request Appointment</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row gy-3 gx-4 pt-2 pb-3">
                                <div class="col-md-12">
                                    <!-- Select Pet -->
                                    <div class="form-group">
                                        <label for="select-pet" class="mb-1">Select Pet</label>
                                        <select class="select-pet form-control" id="select-pet" name="pet_ID" multiple="multiple" data-placeholder="Select a Pet" required autocomplete="off" >
                                            @foreach($pets as $pet)
                                                <option value={{$pet->id}}>{{$pet->pet_name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select at least one pet.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="concern-complain" class="mb-1">Reason of Visit</label>
                                        <textarea class="form-control" id="concern-complain" name="purpose" rows="3" required minlength="5"
                                                  placeholder="Enter the reason of your appointment" autocomplete="off" ></textarea>
                                        <div class="invalid-feedback">
                                            Please provide a valid reason (at least 5 characters).
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-0">
                                <div class="col-md-12">
                                    <!-- Select Veterinarian -->
                                    <div class="form-group">
                                        <label for="select-veterinarian" class="mb-1">Select Veterinarian</label>
                                        <select class="select-veterinarian form-control" id="select-veterinarian" name="doctor_ID" data-placeholder="Select a Veterinarian" required>
                                            <option value=""></option>
                                            @foreach($vets as $vet)
                                                <option
                                                    value={{$vet->id}}>Dr. {{$vet->firstname. " " . $vet->lastname}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a veterinarian.
                                        </div>
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
{{--                                        <input type="text" class="form-control" id="select-schedule" name="appointment_date" placeholder="YYYY-MM-DD" required min="{{ date('Y-m-d') }}">--}}
                                        <div class="input-group input-group-joined">
                                            <input class="form-control" id="select-schedule" type="text" value="" name="appointment_date" min="{{ date('Y-m-d') }}" placeholder="Select a Date"/>
                                            <span class="input-group-text">
                                                <i data-feather="calendar"></i>
                                            </span>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please select a valid date.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Select Schedule -->
                                    {{--                            <div class="form-group">--}}
                                    {{--                                <label for="select-schedule" class="mb-1">Select Time</label>--}}
                                    {{--                                <input type="text" class="form-control" id="timePicker"--}}
                                    {{--                                       name="appointment_time">--}}
                                    {{--                            </div>--}}

                                    <div class="form-group">
                                        <label for="select-schedule" class="mb-1">Select Time</label>
                                        <select class="select-appointment-time form-control" id="selectAppointmentTime" name="appointment_time" data-placeholder="Select Time" required>
                                            <option value=""></option>
                                            <optgroup label="--- Select a Time ---"></optgroup>
                                            <optgroup label="AM">
                                                <option value="8:00 AM">8:00 AM</option>
                                                <option value="8:30 AM">8:30 AM</option>
                                                <option value="9:00 AM">9:00 AM</option>
                                                <option value="9:30 AM">9:30 AM</option>
                                                <option value="10:00 AM">10:00 AM</option>
                                                <option value="10:30 AM">10:30 AM</option>
                                                <option value="11:00 AM">11:00 AM</option>
                                                <option value="11:30 AM">11:30 AM</option>
                                            </optgroup>
                                            <optgroup label="PM">
                                                <option value="1:00 PM">1:00 PM</option>
                                                <option value="1:30 PM">1:30 PM</option>
                                                <option value="2:00 PM">2:00 PM</option>
                                                <option value="2:30 PM">2:30 PM</option>
                                                <option value="3:00 PM">3:00 PM</option>
                                                <option value="3:30 PM">3:30 PM</option>
                                                <option value="4:00 PM">4:00 PM</option>
                                                <option value="4:30 PM">4:30 PM</option>
                                                <option value="5:00 PM">5:00 PM</option>
                                            </optgroup>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select an appointment time.
                                        </div>
                                    </div>
                                </div>
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
                Today's Appointments <span class="badge bg-primary-soft text-primary ms-auto">{{$today}}</span>
            </a>
            <a class="nav-link nav-tab{{ request()->is('scheduled') ? 'active' : '' }}" href="#scheduled">
                Scheduled Appointments <span class="badge bg-secondary-soft text-secondary ms-auto">{{$scheduled}}</span>
            </a>
            <a class="nav-link nav-tab{{ request()->is('requests') ? 'active' : '' }}" href="#requests">
                Appointment Requests <span class="badge bg-warning-soft text-warning ms-auto">{{$requests}}</span>
            </a>
            <a class="nav-link nav-tab{{ request()->is('history') ? 'active' : '' }}" href="#history">
                Appointment History
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
                            <th>Pet/s</th>
                            <th>Veterinarian</th>
                            <th>Reason of Visit</th>
                            <th>Status</th>
                            <th>Priority Number</th>
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
                            <td>
                                <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                    {{$pet->pet_name}}
                                </span>
                            </td>
                            <td>Dr. {{$vet->firstname. ' ' . $vet->lastname}}</td>
                            <td>{{$s->purpose}}</td>
                            <td>
                                <span class="badge bg-success-soft text-success text-sm rounded-pill">
                                    Scheduled
                                </span>
                            </td>
                            <td>

                            </td>
                            <td>
                                <a class="btn btn-outline-primary" href="{{route('portal.appointments.view',['appid'=>$s->id, 'petid'=>$s->pet_ID])}}">Open</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        <tr>
                            <td>3/18/2025 |
                                12:30 PM
                            </td>
                            <td>
                                 <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                    Lexie
                                </span>
                                <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                    Lexie
                                </span>
                                <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                    Lexie
                                </span>
                            </td>
                            <td>Kent Invento</td>
                            <td>Checkup</td>
                            <td>
                                <span class="badge bg-success-soft text-success text-sm rounded-pill">
                                    Scheduled
                                </span>
                            </td>
                            <td>

                            </td>
                            <td>
                                <a class="btn btn-outline-primary" href="">View</a>
                            </td>
                        </tr>
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
                            <th>Pet/s</th>
                            <th>Veterinarian</th>
                            <th>Reason of Visit</th>
                            <th>Status</th>
                            <th>Priority Number</th>
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
                            <td>
                                <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                    {{$pet->pet_name}}
                                </span>
                            </td>
                            <td>Dr. {{$vet->firstname. ' ' . $vet->lastname}}</td>
                            <td>{{$s->purpose}}</td>
                            <td>
                                <span class="badge bg-success-soft text-success text-sm rounded-pill">
                                    Scheduled
                                </span>
                            </td>
                            <td></td>
                            <td>
                                <a class="btn btn-outline-primary" href="{{route('portal.appointments.view',['appid'=>$s->id, 'petid'=>$s->pet_ID])}}">View</a>
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
                            <th>Pet/s</th>
                            <th>Veterinarian</th>
                            <th>Reason of Visit</th>
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
                            <td>
                                 <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                    {{$pet->pet_name}}
                                </span>
                            </td>
                            <td>Dr. {{$vet->firstname. ' ' . $vet->lastname}}</td>
                            <td>{{$a->purpose}}</td>
                            <td>
                                <span class="badge bg-warning-soft text-warning text-sm rounded-pill">Pending</span>
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
                            <th>Pet/s</th>
                            <th>Veterinarian</th>
                            <th>Reason of Visit</th>
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
                            <td>
                                <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                    {{$pet->pet_name}}
                                </span>
                            </td>
                            <td>{{$vet->firstname. ' ' . $vet->lastname}}</td>
                            <td>{{$a->purpose}}</td>
                            <td>
                                {{-- <span class="badge bg-success-soft text-success text-sm rounded-pill">Success</span>--}}
                                {{-- <span class="badge bg-primary-soft text-primary text-sm rounded-pill">Completed</span>--}}
                                {{-- <span class="badge bg-warning-soft text-warning text-sm rounded-pill">Pending</span>--}}
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
    (() => {
        'use strict';

        const forms = document.querySelectorAll('.needs-validation');

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });
    })();


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
