@php
    use App\Models\Clients;
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('portal.layouts.app')
@section('outerContent')
    <style>
        .custom-scroll {
            overflow-y: auto;
            /* Enable vertical scrolling */
            height: 300px;
            scrollbar-width: thin;
            /* For Firefox */
            scrollbar-color: #afafaf #f1f1f1;
            /* Thumb and track colors */
            padding-right: 10px;
        }

        /* For WebKit-based browsers (Chrome, Edge, Safari) */
        .custom-scroll::-webkit-scrollbar {
            width: 5px;
            /* Thin scrollbar */
        }

        /* Disable green border and icons for valid fields */
        .was-validated .form-control:valid,
        .form-control.is-valid {
            border-color: #ced4da !important;
            /* Default border */
            padding-right: 0.75rem !important;
            /* No extra padding */
            background-image: none !important;
            /* No check icon */
            background-repeat: no-repeat;
            background-position: center right 0.375rem;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
    </style>
    <!-- Modals -->

    {{-- Pending Appointment Request Success --}}
    <div class="modal fade" id="appointmentRequestSuccess" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content position-relative">
                <!-- Close Button Floating -->
                <button type="button" class="btn-close position-absolute end-0 m-3" data-bs-dismiss="modal" aria-label="Close"
                    style="z-index: 1051;"></button>

                @if (session('appointment_success'))
                    <div class="modal-body d-flex flex-column justify-content-center align-items-center py-4 px-3">
                        <i class="fa-solid fa-circle-check fa-5x text-success mb-3"></i>
                        <h3 class="text-primary text-center mb-3">Appointment Request Sent Successfully</h3>
                        <p class="text-sm text-center mb-4">
                            Your appointment request has been submitted. You will receive confirmation once approved.
                        </p>

                        <div class="row border w-100 bg-white rounded py-3 px-2 m-0">
                            <div class="col-md-12 mb-3">
                                <p class="fw-bold mb-1">Pet Owner</p>
                                <p class="mb-0">{{ session('pending_modal_data.owner_name') }}</p>
                            </div>

                            <div class="col-md-12 mb-3">
                                <p class="fw-bold mb-1">Pet/s</p>
                                @foreach (session('pending_modal_data.pet_ids') as $pet_id)
                                    <span
                                        class="badge bg-primary-soft text-primary text-sm rounded-pill">{{ \App\Models\Pets::find($pet_id)->pet_name }}</span>
                                @endforeach
                            </div>

                            <div class="col-md-12 mb-3">
                                <p class="fw-bold mb-1">Reason for Appointment</p>
                                @php
                                    $reasons = explode(',', session('pending_modal_data.reason'));
                                    $servicesModal = \App\Models\Services::whereIn('id', $reasons)->get();
                                @endphp
                                @foreach ($servicesModal as $service)
                                    <span class="badge border text-body text-sm rounded-pill">{{ $service->service_name }}</span>
                                @endforeach
                            </div>

                            <div class="col-md-12 mb-3">
                                <p class="fw-bold mb-1">Other Notes</p>
                                <p class="mb-0">{{ session('pending_modal_data.remarks') }}</p>
                            </div>


                            <hr>

                            <div class="col-md-12 mb-3">
                                <p class="fw-bold mb-1">Attending Veterinarian</p>
                                <p class="mb-0">Dr. {{ session('pending_modal_data.veterinarian') }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <p class="fw-bold mb-1">Appointment Date</p>
                                <p class="mb-0">
                                    {{ \Carbon\Carbon::parse(session('pending_modal_data.appointment_date'))->format('F j, Y') }}
                                </p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <p class="fw-bold mb-1">Appointment Time</p>
                                <p class="mb-0">{{ session('pending_modal_data.appointment_time') }}</p>
                            </div>

                            <div class="col-md-6">
                                <p class="fw-bold mb-1">Appointment Status</p>
                                <p class="text-warning mb-0">Pending...</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>



    <div class="modal fade" id="appointmentRequestModal" tabindex="-1" aria-labelledby="currentModalLabel"
        aria-hidden="true" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('portal.appointments.add') }}" method="post" class="needs-validation"
                    id="appointmentRequestForm" novalidate>
                    @csrf
                    @php
                        $client = Clients::getClientByUserID(Auth::user()->id);
                    @endphp
                    <input type="hidden" value="{{ $client->id }}" name="owner_ID">
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
                                            <select class="select-pet-portal form-control" id="select-pet" name="pet_ID[]"
                                                multiple="multiple" data-placeholder="Select a Pet" required
                                                autocomplete="off">
                                                @foreach ($pets as $pet)
                                                    <option value={{ $pet->id }}>{{ $pet->pet_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select at least one pet.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="select-reason-of-visit-portal" class="mb-1">Reason of
                                                Visit</label>
                                            <select class="select-reason-of-visit-portal form-control"
                                                id="select-appointment-reason" name="reasonOfVisit[]"
                                                data-placeholder="Select Reason of Visit" multiple="multiple" required
                                                autocomplete="off">

                                                <option value=""></option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">
                                                        {{ $service->service_name }} | ₱{{ number_format($service->service_price, 2) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select at least one reason.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="concern-complain" class="mb-1">Other Notes</label>
                                            <textarea class="form-control" id="concern-complain" name="remarks" rows="3"
                                                placeholder="Enter other notes of your appointment" autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                    <hr class="mb-0">
                                    <div class="col-md-12">
                                        <!-- Select Veterinarian -->
                                        <div class="form-group">
                                            <label for="select-veterinarian" class="mb-1">Select Veterinarian</label>
                                            <select class="select-veterinarian form-control" id="select-veterinarian"
                                                name="doctor_ID" data-placeholder="Select a Veterinarian" required onchange="selectVet(this.value)">
                                                <option value=""></option>
                                                @foreach ($vets as $vet)
                                                    <option value={{ $vet->id }}>Dr.
                                                        {{ $vet->firstname . ' ' . $vet->lastname }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a veterinarian.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Select Schedule -->
                                        <div class="form-group">
                                            <label for="select-schedule" class="mb-1">Select Date</label>

                                            <div class="input-group input-group-joined">
                                                <input class="form-control" id="select-schedule" type="text"
                                                    value="" name="appointment_date" min="{{ date('Y-m-d') }}"
                                                    placeholder="Select a Date" />
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


                                        <div class="form-group">
                                            <label for="select-schedule" class="mb-1">Select Time</label>
                                            <select class="select-appointment-time form-control"
                                                id="selectAppointmentTime" name="appointment_time"
                                                data-placeholder="Select Time" required>
                                                <option value=""></option>
                                                <optgroup label="--- Select a Time ---"></optgroup>

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
                        <button class="btn btn-primary" id="submitAppointment" type="submit">Request
                            Appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Use Blade to output the route URL and assign it to a JavaScript variable
            const formAction = "{{ route('portal.appointments.add') }}"; // Blade handles this
            const form = document.querySelector(`form[action="${formAction}"]`);
            const submitButton = document.getElementById('submitAppointment');

            if (form && submitButton) {
                form.addEventListener('submit', (event) => {
                    if (form.checkValidity()) {
                        submitButton.disabled = true; // Disable the button
                        submitButton.textContent = 'Submitting...'; // Optionally, update the text
                    } else {
                        event.preventDefault(); // Prevent the default form submission
                    }
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
                $today = \App\Models\Appointments::where('status', 0)
                    ->where('owner_ID', $client->id)
                    ->where('appointment_date', \Carbon\Carbon::today())
                    ->get()
                    ->count();
                $scheduled = \App\Models\Appointments::where('status', 0)
                    ->where('owner_ID', $client->id)
                    ->get()
                    ->count();
                $requests = \App\Models\Appointments::where('status', null)
                    ->where('owner_ID', $client->id)
                    ->get()
                    ->count();
            @endphp
            <nav class="nav nav-borders">
                <a class="nav-link ms-0 nav-tab{{ request()->is('today') ? 'active' : '' }}" href="#today">
                    Today's Appointments <span
                        class="badge bg-primary-soft text-primary ms-auto">{{ $today }}</span>
                </a>
                <a class="nav-link nav-tab{{ request()->is('scheduled') ? 'active' : '' }}" href="#scheduled">
                    Scheduled Appointments <span
                        class="badge bg-secondary-soft text-secondary ms-auto">{{ $scheduled }}</span>
                </a>
                <a class="nav-link nav-tab{{ request()->is('requests') ? 'active' : '' }}" href="#requests">
                    Appointment Requests <span
                        class="badge bg-warning-soft text-warning ms-auto">{{ $requests }}</span>
                </a>
                <a class="nav-link nav-tab{{ request()->is('history') ? 'active' : '' }}" href="#history">
                    Appointment History
                </a>
            </nav>
            <hr class="mt-0 mb-4">
            <div class="card shadow-none border mb-5" id="todaysCard" style="display:none;">
                <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Today's
                        Appointments</span>
                </div>
                <div class="card-body">
                    <table id="todaysAppointmentsTable">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Pet/s</th>
                                <th>Veterinarian</th>
                                <th>Reason of Visit</th>
                                <th>Priority Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments->sortByDesc(function($s) {
                                return $s->appointment_date . ' ' . $s->appointment_time;
                            }) as $s)
                                @if ($s->status === 0 && \Carbon\Carbon::parse($s->appointment_date)->isToday())
                                    @php
                                        $petIDs = explode(',', $s->pet_ID);
                                        $pets = \App\Models\Pets::whereIn('id', $petIDs)->get();
                                        $owner = Clients::getClientById($s->owner_ID);
                                    @endphp
                                    <tr data-index="0">
                                        <td>{{ \Carbon\Carbon::parse($s->appointment_date)->format('j F, Y') }} |
                                            {{ \Carbon\Carbon::parse($s->appointment_time)->format('g:i A') }}
                                        </td>
                                        <td>
                                            @foreach ($pets as $pet)
                                                <span class="badge bg-primary-soft text-primary text-sm rounded-pill">

                                                    {{ $pet->pet_name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>Dr. {{ $vet->firstname . ' ' . $vet->lastname }}</td>
                                        <td>
                                            @php
                                                $service_ids = explode(',', $s->purpose);
                                                $services = \App\Models\Services::whereIn('id', $service_ids)->get();
                                            @endphp
                                            @foreach ($services as $service)
                                                <span
                                                    class="badge badge-sm bg-secondary-soft text-secondary rounded-pill me-1">
                                                    {{ $service->service_name }}
                                                </span>
                                            @endforeach
                                        </td>

                                        <td>
                                            {{ $s->priority_number }}

                                        </td>
                                        <td>
                                            <a class="btn btn-outline-primary"
                                                href="{{ route('portal.appointments.view', ['appid' => $s->id, 'petid' => $s->pet_ID]) }}">Open</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow-none border mb-5" id="scheduledCard" style="display:none;">
                <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Scheduled
                        Appointments</span>
                </div>
                <div class="card-body">
                    <table id="scheduledAppointmentsTable">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Pet/s</th>
                                <th>Veterinarian</th>
                                <th>Reason of Visit</th>
                                <th>Priority Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments->sortByDesc(function($appointment) {
                                return $appointment->appointment_date . ' ' . $appointment->appointment_time;
                            }) as $s)
                                @if (
                                    $s->status === 0 )
                                    @php
                                        $petIDs = explode(',', $s->pet_ID);
                                        $pets = \App\Models\Pets::whereIn('id', $petIDs)->get();
                                        $vet = \App\Models\Doctor::where('id', $s->doctor_ID)->first();

                                    @endphp
                                    <tr data-index="0">
                                        <td>{{ \Carbon\Carbon::parse($s->appointment_date)->format('j F, Y') }} |
                                            {{ \Carbon\Carbon::parse($s->appointment_time)->format('g:i A') }}
                                        </td>
                                        <td>
                                            @foreach ($pets as $pet)
                                                <span class="badge bg-primary-soft text-primary text-sm rounded-pill">

                                                    {{ $pet->pet_name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>Dr. {{ $vet->firstname . ' ' . $vet->lastname }}</td>
                                        <td>
                                            @php
                                                $service_ids = explode(',', $s->purpose);
                                                $services = \App\Models\Services::whereIn('id', $service_ids)->get();
                                            @endphp
                                            @foreach ($services as $service)
                                                <span
                                                    class="badge badge-sm bg-secondary-soft text-secondary rounded-pill me-1">
                                                    {{ $service->service_name }}
                                                </span>
                                            @endforeach
                                        </td>

                                        <td>{{ $s->priority_number }}</td>
                                        <td>
                                            <a class="btn btn-outline-primary"
                                                href="{{ route('portal.appointments.view', ['appid' => $s->id, 'petid' => $s->pet_ID]) }}">View</a>
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
                <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Appointment
                        Requests</span>
                </div>
                <div class="card-body">
                    <table id="appointmentsRequestsTable">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Pet/s</th>
                                <th>Veterinarian</th>
                                <th>Reason of Visit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments->sortByDesc(function($a) {
                                return $a->appointment_date . ' ' . $a->appointment_time;
                            }) as $a)
                                @if (
                                    $a->status === null &&
                                        (\Carbon\Carbon::parse($a->appointment_date)->isToday() ||
                                            \Carbon\Carbon::parse($a->appointment_date)->isFuture()))
                                    @php
                                        $petIDs = explode(',', $a->pet_ID);
                                        $pets = \App\Models\Pets::whereIn('id', $petIDs)->get();
                                        $vet = \App\Models\Doctor::where('id', $a->doctor_ID)->first();

                                    @endphp
                                    <tr data-index="0">
                                        <td>{{ \Carbon\Carbon::parse($a->appointment_date)->format('j F, Y') }} |
                                            {{ \Carbon\Carbon::parse($a->appointment_time)->format('g:i A') }}
                                        </td>
                                        <td>
                                            @foreach ($pets as $pet)
                                                <span class="badge bg-primary-soft text-primary text-sm rounded-pill">

                                                    {{ $pet->pet_name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>Dr. {{ $vet->firstname . ' ' . $vet->lastname }}</td>
                                        <td>
                                            @php
                                                $service_ids = explode(',', $a->purpose);
                                                $services = \App\Models\Services::whereIn('id', $service_ids)->get();
                                            @endphp
                                            @foreach ($services as $service)
                                                <span class="badge badge-sm bg-secondary-soft text-secondary rounded-pill me-1">
                                                    {{ $service->service_name }}
                                                </span>
                                            @endforeach
                                        </td>

                                        <td>
                                            <a class="btn btn-outline-primary"
                                                href="{{ route('portal.appointments.view', ['appid' => $a->id, 'petid' => $a->pet_ID]) }}">Open</a>
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
                <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Appointment
                        History</span>
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
                            @foreach ($appointments->sortByDesc(function($appointment_history) {
                                return $appointment_history->appointment_date . ' ' . $appointment_history->appointment_time;
                            }) as $appointment_history)
                                {{-- @if (\Carbon\Carbon::parse($a->appointment_date)->lt(\Carbon\Carbon::today())) --}}
                                @php
                                    $petIDs = explode(',', $s->pet_ID);
                                    $pets = \App\Models\Pets::whereIn('id', $petIDs)->get();
                                    $vet = \App\Models\Doctor::where('id', $appointment_history->doctor_ID)->first();
                                @endphp
                                <tr data-index="0">
                                    <td>{{ \Carbon\Carbon::parse($appointment_history->appointment_date)->format('j F, Y') }} |
                                        {{ \Carbon\Carbon::parse($appointment_history->appointment_time)->format('g:i A') }}
                                    </td>
                                    <td>
                                        @foreach ($pets as $pet)
                                            <span class="badge bg-primary-soft text-primary text-sm rounded-pill">

                                                {{ $pet->pet_name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>Dr. {{ $vet->firstname . ' ' . $vet->lastname }}</td>
                                    <td>
                                        @php
                                            $service_ids = explode(',', $appointment_history->purpose);
                                            $services = \App\Models\Services::whereIn('id', $service_ids)->get();
                                        @endphp
                                        @foreach ($services as $service)
                                            <span
                                                class="badge badge-sm bg-secondary-soft text-secondary rounded-pill me-1">
                                                {{ $service->service_name }}
                                            </span>
                                        @endforeach

                                    </td>
                                    <td>
                                        @if ($appointment_history->status === null)
                                            <span
                                                class="badge bg-warning-soft text-warning text-sm rounded-pill">Pending</span>
                                        @elseif ($appointment_history->status === 0)
                                            <span
                                                class="badge bg-primary-soft text-primary text-sm rounded-pill">Scheduled</span>
                                        @elseif ($appointment_history->status === 1)
                                            <span
                                                class="badge bg-success-soft text-success text-sm rounded-pill">Completed</span>
                                        @elseif ($appointment_history->status === 2)
                                            <span
                                                class="badge bg-danger-soft text-danger text-sm rounded-pill">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-primary"
                                            href="{{ route('portal.appointments.view', ['appid' => $appointment_history->id, 'petid' => $appointment_history->pet_ID]) }}">Open</a>
                                    </td>
                                </tr>
                                {{-- @endif --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
                    const target = tab.getAttribute('href').substring(
                        1); // Extract target ID (e.g., 'scheduled')
                    if (cards[target]) {
                        cards[target].style.display = 'block';
                    }
                });
            });

            // Trigger the click on the Scheduled tab to show it initially
            document.querySelector('.nav-tab[href="#today"]').click();
        });
    </script>
    <script>
        let selectedVet = 0;
        let selectedDate = 0;

        function selectVet(vet) {
            selectedVet = vet
            console.log(selectedVet)
        }

        function selectDate(date) {
            selectedDate = date;
            console.log(selectedDate)
        }

        function sendRequest(selectedDate, selectedVet) {
            $.ajax({
                url: '{{ route('appointments.available-times') }}',
                type: 'GET',
                data: {
                    date: selectedDate,
                    vet: selectedVet
                },
                success: function(response) {
                    console.log(response);
                    let timeSelect = $('#selectAppointmentTime');
                    timeSelect.empty();
                    timeSelect.append('<option value="">--- Select a Time ---</option>');

                    if (response.length > 0) {
                        let amGroup = $('<optgroup label="AM"></optgroup>');
                        let pmGroup = $('<optgroup label="PM"></optgroup>');

                        response.forEach(function(time) {
                            // Convert 24-hour format to 12-hour display format
                            let displayTime = convertTo12HourDisplay(time);
                            let option = `<option value="${time}">${displayTime}</option>`;

                            let hour = parseInt(time.split(':')[0]);
                            if (hour < 12) {
                                amGroup.append(option);
                            } else {
                                pmGroup.append(option);
                            }
                        });

                        timeSelect.append(amGroup);
                        timeSelect.append(pmGroup);
                    } else {
                        timeSelect.append('<option value="">No available times</option>');
                    }
                },
                error: function(error) {
                    console.log("Error fetching available times:", error);
                }
            });
        }

        function convertTo12HourDisplay(time24) {
            const [hours, minutes] = time24.split(':');
            const hour = parseInt(hours);
            const period = hour < 12 ? 'AM' : 'PM';
            const displayHour = hour % 12 || 12;
            return `${displayHour}:${minutes} ${period}`;
        }

        $(document).ready(function() {
            $('#vetSelect').on('change', function() {
                selectVet(this.value);
                console.log(selectedVet);
                if (selectVet) {
                    sendRequest(selectedDate, selectedVet);
                }
            });

            $('#select-schedule').on('change', function() {
                selectDate(this.value);

                if (selectedDate) {
                    sendRequest(selectedDate, selectedVet);
                }
            });

            // Helper function to convert 24-hour time to 12-hour display format

        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('appointment_success'))
                var appointmentModal = new bootstrap.Modal(document.getElementById('appointmentRequestSuccess'));
                appointmentModal.show();
            @endif
        });
    </script>

@endsection
