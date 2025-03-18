@extends('portal.layouts.app')
@section('outerContent')
<div class="modal fade" id="editAppointmentRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('portal.appointments.update', ['appointmentID' => $appointment->id])}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentRequestTitle">Edit Request Appointment</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-3 gx-4">
                        <div class="col-md-6">
                            <!-- Select Schedule -->
                            <div class="form-group">
                                <label for="select-schedule" class="mb-1">Select Date</label>
                                <input type="text" class="form-control" id="select-schedule" name="appointment_date" placeholder="YYYY-MM-DD" value="{{$appointment->appointment_date}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Select Schedule -->
                            <div class="form-group">
                                <label class="small mb-1">Appointment Time</label>
                                <select class="select-appointment-time-edit-portal form-control" id="selectAppointmentTime" name="appointment_time" data-placeholder="Select Time" required>
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
                        <div class="col-md-6">
                            <!-- Select Pet -->
                            <div class="form-group">
                                <label for="select-pet" class="mb-1">Select Pet</label>
                                <select class="form-control" id="select-pet" name="pet_ID">
                                    <option value="" disabled selected>Select a Pet</option>
                                    @foreach($pets as $p)
                                    <option value="{{$p->id}}" @if($p->id == $pet->id) selected @endif>{{$p->pet_name}}</option>
                                    @endforeach

                                    <!-- Add more options as needed -->
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
                                    <option value="{{$vet->id}}" @if($vet->id == $appointment->doctor_ID) selected @endif>Dr. {{$vet->firstname . " " . $vet->lastname}}</option>
                                    @endforeach
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                        </div>
{{--                        <div class="col-md-6">--}}
{{--                            <!-- View Veterinarian Schedule -->--}}
{{--                            <div class="form-group d-flex">--}}
{{--                                <label>&nbsp;</label> <!-- For spacing alignment -->--}}
{{--                                <br>--}}
{{--                                <a href="#" class="text-decoration-underline">View Veterinarian Schedule</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-md-12">
                            <!-- Concern/Complain -->
                            <div class="form-group">
                                <label for="concern-complain" class="mb-1">Purpose</label>
                                <textarea class="form-control" id="concern-complain" name="purpose" rows="5" placeholder="Enter the purpose of your appointment"> {{$appointment->purpose}}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Edit Appointment Request</button>
                </div>
            </form>

        </div>
    </div>
</div>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{route('portal.appointments')}}">Appointments</a></li>
                    <li class="breadcrumb-item active">Appointment Details</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 order-2 order-md-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-none border mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Appointment Details</span>
                            <div class="dropdown">
                                <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg class="svg-inline--fa fa-ellipsis-vertical" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-vertical" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M64 360C94.93 360 120 385.1 120 416C120 446.9 94.93 472 64 472C33.07 472 8 446.9 8 416C8 385.1 33.07 360 64 360zM64 200C94.93 200 120 225.1 120 256C120 286.9 94.93 312 64 312C33.07 312 8 286.9 8 256C8 225.1 33.07 200 64 200zM64 152C33.07 152 8 126.9 8 96C8 65.07 33.07 40 64 40C94.93 40 120 65.07 120 96C120 126.9 94.93 152 64 152z"></path>
                                    </svg><!-- <i class="fa fa-ellipsis-v"></i> Font Awesome fontawesome.com -->
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    @if($appointment->status === null)
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editAppointmentRequestModal">Edit Request</a></li>
                                        <li>
                                            <form action="{{ route('portal.appointments.cancel', ['appid' => $appointment->id]) }}" method="POST" class="dropdown-item" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-link text-decoration-none p-0 m-0" style="color: inherit; background: none; border: none; cursor: pointer;">
                                                    Cancel Request
                                                </button>
                                            </form>
                                        </li>
                                    @endif

                                    <li><a class=" dropdown-item" href="">Print</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Appointment Status</label><br>
                                    <span class="mb-3 badge
                                    @if(is_null($appointment->status)) bg-warning-soft text-warning
                                    @elseif($appointment->status === 0) bg-info-soft text-info
                                    @elseif($appointment->status === 1) bg-success-soft text-success
                                    @elseif($appointment->status === 2) bg-danger-soft text-danger
                                    @endif
                                    text-sm rounded-pill">
                                    @if(is_null($appointment->status))
                                            Pending
                                        @elseif($appointment->status === 0)
                                            Scheduled
                                        @elseif($appointment->status === 1)
                                            Completed
                                        @elseif($appointment->status === 2)
                                            Cancelled
                                        @endif
                                </span>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Appointment ID</label>
                                    <p>{{ sprintf("VetIS-%05d", $appointment->id)}}</p>
                                </div>
                                {{--                        <div class="col-md-12">--}}
                                {{--                            <div class="card border-start-lg border-start-danger shadow-none bg-light rounded mb-3">--}}
                                {{--                                <div class="card-body py-2">--}}
                                {{--                                    <label class="small mb-1 fw-bold text-danger">Cancellation Reason</label><br>--}}
                                {{--                                    <p class="mb-0">this is the cancellation reason</p>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                                <div class="col-md-6">
                                    <label class="small mb-1">Appointment Date</label>
                                    <p class="text-primary">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y')}}</p>
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1">Appointment Time</label>
                                    <p class="text-primary">{{\Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A')}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Attending Veterinarian</label>
                                    <p class="text-primary fw-bold">
                                        @php
                                            $vet = $vets->firstWhere('id', $appointment->doctor_ID);
                                            $vetName = $vet ? $vet->firstname . ' ' . $vet->lastname : 'N/A';
                                        @endphp
                                        Dr. {{ $vetName }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Pet Owner</label><br>
                                    <p class="text-primary fw-bold">{{$appointment->client->client_name}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Pet/s</label><br>
                                    <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                       {{$pet->pet_name}}
                                    </span>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="border py-3 px-3 border-top-lg border-top-primary rounded">
                                        <label class="mb-1 text-primary fw-bold b">Reason of Visit</label>
                                        <p class="mb-0">
                                            {{$appointment->purpose}}
                                        </p>
                                    </div>

                                </div>
                                {{--                    <div class="card-icon mb-4 border border-1 rounded">--}}
                                {{--                        <div class="row g-0">--}}
                                {{--                            <div class="col-sm-2 card-icon-aside bg-info p-4 rounded"><svg class="svg-inline--fa fa-calendar-check text-white-50" aria-hidden="true" focusable="false" data-prefix="far" data-icon="calendar-check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">--}}
                                {{--                                    <path fill="currentColor" d="M216.1 408.1C207.6 418.3 192.4 418.3 183 408.1L119 344.1C109.7 335.6 109.7 320.4 119 311C128.4 301.7 143.6 301.7 152.1 311L200 358.1L295 263C304.4 253.7 319.6 253.7 328.1 263C338.3 272.4 338.3 287.6 328.1 296.1L216.1 408.1zM128 0C141.3 0 152 10.75 152 24V64H296V24C296 10.75 306.7 0 320 0C333.3 0 344 10.75 344 24V64H384C419.3 64 448 92.65 448 128V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V128C0 92.65 28.65 64 64 64H104V24C104 10.75 114.7 0 128 0zM400 192H48V448C48 456.8 55.16 464 64 464H384C392.8 464 400 456.8 400 448V192z"></path>--}}
                                {{--                                </svg><!-- <i class="text-white-50 fa-regular fa-calendar-check"></i> Font Awesome fontawesome.com --></div>--}}
                                {{--                            <div class="col-sm-10">--}}
                                {{--                                <div class="row">--}}
                                {{--                                    <div class="col">--}}
                                {{--                                        <div class="card-body py-4">--}}
                                {{--                                            <h5 class="card-title">Appointment ID</h5>--}}
                                {{--                                            <p class="card-text">--}}
                                {{--                                                {{ sprintf("VetIS-%05d", $appointment->id)}}--}}
                                {{--                                            </p>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="col">--}}
                                {{--                                        <div class="card-body py-4">--}}
                                {{--                                            <h5 class="mb-1 text-dark-90">Appointment Status</h5>--}}
                                {{--                                            <span class="badge--}}
                                {{--                                    @if(is_null($appointment->status)) bg-warning-soft text-warning--}}
                                {{--                                    @elseif($appointment->status === 0) bg-info-soft text-info--}}
                                {{--                                    @elseif($appointment->status === 1) bg-success-soft text-success--}}
                                {{--                                    @elseif($appointment->status === 2) bg-danger-soft text-danger--}}
                                {{--                                    @endif--}}
                                {{--                                    text-sm rounded-pill">--}}
                                {{--                                    @if(is_null($appointment->status))--}}
                                {{--                                                    Pending--}}
                                {{--                                                @elseif($appointment->status === 0)--}}
                                {{--                                                    Scheduled--}}
                                {{--                                                @elseif($appointment->status === 1)--}}
                                {{--                                                    Completed--}}
                                {{--                                                @elseif($appointment->status === 2)--}}
                                {{--                                                    Cancelled--}}
                                {{--                                                @endif--}}
                                {{--                                </span>--}}

                                {{--                                        </div>--}}

                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                                {{--                    </div>--}}
                                {{--                    <div class="row gy-2 mb-3">--}}
                                {{--                        <div class="col-md-12">--}}
                                {{--                            <div class="card shadow-none">--}}
                                {{--                                <div class="card-body">--}}
                                {{--                                    <h6 class="mb-2 text-primary">Appointment Schedule</h6>--}}
                                {{--                                    <hr class="mt-1 mb-3">--}}
                                {{--                                    <div class="row g-3">--}}
                                {{--                                        <div class="col-md-12">--}}
                                {{--                                            <label class="small mb-1" for="inputEmailAddress">Attending Veterinarian</label>--}}
                                {{--                                            <div class="">--}}
                                {{--                                    <span class="text-primary fw-bold">--}}
                                {{--                                         @php--}}
                                {{--                                             $vet = $vets->firstWhere('id', $appointment->doctor_ID);--}}
                                {{--                                             $vetName = $vet ? $vet->firstname . ' ' . $vet->lastname : 'N/A';--}}
                                {{--                                         @endphp--}}
                                {{--                                        {{ $vetName }}--}}
                                {{--                                    </span>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="col-md-6">--}}
                                {{--                                            <label class="small mb-1" for="inputEmailAddress">Appointment Date</label>--}}
                                {{--                                            <p class="text-primary">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y')}}</p>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="col-md-6">--}}
                                {{--                                            <label class="small mb-1" for="inputEmailAddress">Appointment Time</label>--}}
                                {{--                                            <p class="text-primary">{{\Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A')}}</p>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}

                                {{--                        <div class="col-md-6">--}}
                                {{--                            <div class="card shadow-none">--}}
                                {{--                                <div class="card-body">--}}
                                {{--                                    <h6 class="mb-2 text-primary">Pet Information</h6>--}}
                                {{--                                    <hr class="mt-1 mb-2">--}}
                                {{--                                    <div class="row">--}}
                                {{--                                        <div class="col-md-6">--}}
                                {{--                                            <label class="small mb-1" for="inputPetName">Pet Name</label>--}}
                                {{--                                            <p class="text-primary fw-bold">{{$pet->pet_name}}</p>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="col-md-6">--}}
                                {{--                                            <label class="small mb-1" for="inputPetName">Pet Type</label>--}}
                                {{--                                            <p>{{$pet->pet_type}}</p>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="col-md-6">--}}
                                {{--                                            <label class="small mb-1" for="inputPetName">Breed</label>--}}
                                {{--                                            <p>{{$pet->pet_breed}}</p>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="col-md-6">--}}
                                {{--                                            <label class="small mb-1" for="inputPetName">Age</label>--}}
                                {{--                                            <p>{{$pet->getAgeAttribute()}}</p>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                                {{--                        <div class="col-md-12">--}}
                                {{--                            <div class="card shadow-none mt-4 mb-4">--}}
                                {{--                                <div class="card-body">--}}
                                {{--                                    <h6 class="mb-2 text-primary">Concern/Complaint</h6>--}}
                                {{--                                    <hr class="mt-1 mb-3">--}}
                                {{--                                    <div class="col-md-12">--}}
                                {{--                                        <p>{{$appointment->purpose}}</p>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card shadow-none">
                        <div class="card-header">
                            Pet/s Details
                        </div>
                        <div class="card-body py-0">
                            <table id="petInfoTable">
                                <thead>
                                <tr>
                                    <th>Pet Name</th>
                                    <th>Pet Type</th>
                                    <th>Pet Breed</th>
                                    <th>Age</th>
                                </tr>
                                </thead>
                                <tbody>
                                        <tr data-index="0">
                                            <td>Shiela</td>
                                            <td>Dog</td>
                                            <td>Shitzu</td>
                                            <td>1 Year Old</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 order-1 order-md-2">
            <div class="col-md-12">
                <div class="card shadow-none border mb-4">
                    <div class="card-header">
                        <span>Priority Number</span>
                    </div>
                    <div class="card-body">
                        <div class="col-12 border p-2 text-center rounded bg-light">
                            <h1 class="fw-700 mb-0 text-xl">#-----</h1>
                        </div>
{{--                        <p class="text-center mt-2 mb-0 text-gray-500 font-italic">You will be given a priority number once your appointment request has been scheduled</p>--}}
                        <p class="text-center mt-2 mb-0 text-gray-500 font-italic">A priority number will be generated once scheduled.</p>
{{--                        <p class="text-center mt-2 mb-0 text-gray-500 font-italic">Please present your priority number upon arrival.</p>--}}
                    </div>
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
</script>
@endsection
