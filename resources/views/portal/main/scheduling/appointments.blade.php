@php use App\Models\Clients;use Illuminate\Support\Facades\Auth; @endphp
@extends('portal.layouts.app')
@section('outerContent')
<!-- Modals -->
<div class="modal fade" id="appointmentRequestModal" tabindex="-1" role="dialog"
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
                        <div class="col-md-6">
                            <!-- View Veterinarian Schedule -->
                            <div class="form-group d-flex">
                                <label>&nbsp;</label> <!-- For spacing alignment -->
                                <br>
                                <a href="#" class="text-decoration-underline">View Veterinarian Schedule</a>
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

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.querySelector('form[action="{{route('portal.appointments.add')}}"]');
        const submitButton = document.getElementById('submitAppointment');

        form.addEventListener('submit', () => {
            submitButton.disabled = true; // Disable the button
            submitButton.textContent = 'Submitting...'; // Optionally, update the text
        });
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
        $today = \App\Models\Appointments::where('status', 0)->where('appointment_date', \Carbon\Carbon::today())->get()->count();
        $scheduled = \App\Models\Appointments::where('status', 0)->get()->count();
        $requests = \App\Models\Appointments::where('status', null)->get()->count();
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
{{--                        @if(\Carbon\Carbon::parse($a->appointment_date)->lt(\Carbon\Carbon::today()) )--}}
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
{{--                        @endif--}}
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
