@php use App\Models\Clients; @endphp
@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="modal fade" id="editAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('appointments.update', ['appid' => $appointment->id]) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reschedule Appointment</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Row-->
                        <div class="row g-3 mb-3">
                            <div class="col-md-12">
                                <div class="border py-3 px-3 rounded">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="mb-1">Pet Owner</label>
                                            <p class="mb-0 text-primary">{{ Clients::where('id', $appointment->owner_ID)->first()->client_name }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-1">Pet/s</label><br>
                                            @php
                                                $petIDs = explode(',', $appointment->pet_ID);
                                                $pets = [];
                                                foreach ($petIDs as $petID) {
                                                    $pet = \App\Models\Pets::find($petID);
                                                    if ($pet) {
                                                        $pets[] = $pet->pet_name . ' | ' . $pet->pet_type;
                                                    }
                                                }
                                            @endphp
                                            @foreach ($pets as $pet)
                                                <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                                {{ $pet }}
                                            </span>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                                <div class="col-md-6 mt-3">
                                    <div class="border py-3 px-3 rounded">
                                        <label class="mb-1">Reason of Visit</label>
                                        <table class="table table-bordered mt-2 mb-0">
                                            <tr>
                                                <td>Grooming</td>
                                                <td>500.00</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="border py-3 px-3 rounded">
                                        <label class="mb-1">Other Notes</label>
                                        <p class="mb-0 mt-2">
                                            {{ $appointment->purpose }}
                                        </p>
                                    </div>
                                </div>
                            <hr class="mb-0">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputEmailAddress">Appointment Date</label>
                                {{--                            <input class="form-control" id="inputEmailAddress" type="date" name="appointment_date" value="{{$appointment->appointment_date}}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" /> --}}
                                <div class="input-group input-group-joined">
                                    <input type="text" class="form-control" id="select-schedule" name="appointment_date"
                                           placeholder="YYYY-MM-DD" value="{{ $appointment->appointment_date }}">
                                    <span class="input-group-text">
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputEmailAddress">Appointment Time</label>
                                <select class="select-appointment-time-edit form-control" id="selectAppointmentTime"
                                        name="appointment_time" data-placeholder="Select Time" required>
                                    <option value=""></option>
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
                                    </optgroup>
                                </select>
                                <div class="invalid-feedback">
                                    Please select an appointment time.
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputEmailAddress">Veterinarian</label>
                                <select class="select-attending-vet-edit form-control" id="vetSelect" name="doctor_ID">
                                    @foreach ($vets as $vet)
                                        <option class="form-control" value={{ $vet->id }}
                                            {{ $appointment->doctor_ID === $vet->id ?? 'selected' }}>Dr.
                                            {{ $vet->firstname . ' ' . $vet->lastname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light text-primary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Reschedule</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

{{--    Confirmation Modal  --}}
    <!-- Done Appointment Modal -->
    <div class="modal fade" id="doneAppointmentModal" tabindex="-1" aria-labelledby="doneAppointmentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content py-3">
                <div class="modal-header border-0 text-center d-block">
                    <i class="fa-solid fa-check-circle text-success display-4"></i>
                    <h5 class="modal-title mt-2" id="doneAppointmentLabel">Confirm Completion</h5>
                </div>
                <div class="modal-body text-center">
                    Are you sure you want to mark this appointment as <strong>Completed</strong>?
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-light text-primary" data-bs-dismiss="modal">Cancel</button>
                    <a href="{{ route('appointments.done', ['id' => $appointment->id]) }}" class="btn btn-success">Confirm</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Appointment Modal -->
    <div class="modal fade" id="cancelAppointmentModal" tabindex="-1" aria-labelledby="cancelAppointmentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content py-3">
                <div class="modal-header border-0 text-center d-block">
                    <i class="fa-solid fa-xmark-circle text-danger display-4"></i>
                    <h5 class="modal-title mt-2" id="cancelAppointmentLabel">Confirm Cancellation</h5>
                </div>
                <div class="modal-body text-center">
                    Are you sure you want to <strong>Cancel</strong> this appointment?
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-light text-primary" data-bs-dismiss="modal">No</button>
                    <a href="{{ route('appointments.cancel', ['id' => $appointment->id]) }}" class="btn btn-danger">Yes, Cancel</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Appointment Modal -->
    <div class="modal fade" id="scheduleAppointmentModal" tabindex="-1" aria-labelledby="scheduleAppointmentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content py-3">
                <div class="modal-header border-0 text-center d-block">
                    <i class="fa-solid fa-calendar-check text-primary display-4"></i>
                    <h5 class="modal-title mt-2" id="scheduleAppointmentLabel">Confirm Scheduling</h5>
                </div>
                <div class="modal-body text-center">
                    Are you sure you want to <strong>Schedule</strong> this appointment?
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-light text-primary" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('appointments.schedule', ['id' => $appointment->id]) }}">Confirm Schedule</a>
                </div>
            </div>
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
                <div class="card shadow-none mb-4">
                    <div class="card-header">Appointment Details</div>
                    <div class="card-body">


                        <div class="row gx-3 mb-2">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputEmailAddress">Appointment Status</label><br>
                                        @if (is_null($appointment->status) == true)
                                            <div class="badge bg-warning-soft text-warning text-sm rounded-pill">
                                                Pending
                                            </div>
                                        @elseif ($appointment->status == 0)
                                            <div class="badge bg-secondary-soft text-secondary text-sm rounded-pill">
                                                Scheduled
                                            </div>
                                        @elseif ($appointment->status == 2)
                                            <div class="badge bg-danger-soft text-danger text-sm rounded-pill">
                                                Canceled
                                            </div>
                                        @elseif ($appointment->status == 1)
                                            <div class="badge bg-success-soft text-success text-sm rounded-pill">
                                                Finished
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputEmailAddress">Appointment ID</label>
                                        <p>{{ sprintf('VETIS-%05d', $appointment->id) }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputEmailAddress">Appointment Date</label>
                                        <p class="text-primary">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputEmailAddress">Appointment Time</label>
                                        <p class="text-primary">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputEmailAddress">Veterinarian</label>
                                        @php
                                            $vet = \App\Models\Doctor::where('id', $appointment->doctor_ID)->first();
                                        @endphp
                                        <p class="text-primary fw-bold">Dr. {{ $vet->firstname . ' ' . $vet->lastname }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Pet Owner</label><br>
                                        <p class="text-primary fw-bold">{{ $appointment->client->client_name }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="small mb-1">Pet/s</label><br>
                                        @php
                                            $petIDs = explode(',', $appointment->pet_ID);
                                            $pets = [];
                                            foreach ($petIDs as $petID) {
                                                $pet = \App\Models\Pets::find($petID);
                                                if ($pet) {
                                                    $pets[] = $pet->pet_name . ' | ' . $pet->pet_type;
                                                }
                                            }
                                        @endphp
                                        @foreach ($pets as $pet)
                                            <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                                {{ $pet }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mt-3">
                                            <div class="border py-3 px-3 border-top-lg border-top-primary rounded">
                                                <label class="mb-1 text-primary fw-bold b">Reason of Visit</label>
                                                <table class="table table-bordered mt-2 mb-0">
                                                    <tr>
                                                        <td>Grooming</td>
                                                        <td>500.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Grooming</td>
                                                        <td>500.00</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="border py-3 px-3 border-top-lg border-top-dark rounded">
                                                <label class="mb-1 text-gray-700 fw-bold b">Other Notes</label>
                                                <p class="mb-0 mt-2">
                                                    {{ $appointment->purpose }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-none mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="">Pet Owner Details</div>
                        <a class="btn btn-datatable btn-primary px-5 py-3 m-0" href="{{ route('owners.show', $appointment->owner_ID) }}"><i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="card-body">
                        @php
                            Clients::setEmailAttribute($appointment->client, $appointment->client->user_id);
                        @endphp
                        <div class="row">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPetName">Name</label>
                                <p class="text-primary">{{ $appointment->client->client_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPetName">Address</label>
                                <p>{{ $appointment->client->client_address }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPetName">Contact Number</label>
                                <br>
                                <a
                                    href="tel:{{ $appointment->client->client_no }}">{{ $appointment->client->client_no }}</a>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPetName">Email</label>
                                <br>
                                <a
                                    href="mailto:{{ $appointment->client->client_email }}">{{ $appointment->client->client_email }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-none mb-4">
                    <div class="card-header">
                        Pet/s Details
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="petInfoTable">
                                        <thead>
                                            <tr>
                                                <th>Pet Name</th>
                                                <th>Pet Type</th>
                                                <th>Pet Breed</th>
                                                <th>Age</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $petIDs = explode(',', $appointment->pet_ID);
                                                $pets = [];
                                                foreach ($petIDs as $petID) {
                                                    $pet = \App\Models\Pets::find($petID);
                                                    if ($pet) {
                                                        $pets[] = ['name' => $pet->pet_name, 'type' => $pet->pet_type, 'breed' => $pet->pet_breed, 'age' => $pet->age];
                                                    }
                                                }
                                            @endphp
                                            @foreach ($pets as $pet)
                                                <tr data-index="0">
                                                    <td>{{ $pet['name'] }}</td>
                                                    <td>{{ $pet['type'] }}</td>
                                                    <td>{{ $pet['breed'] }}</td>
                                                    <td>{{ $pet['age'] }} year/s old</td>
                                                    <td><a class="btn btn-datatable btn-primary px-5 py-3"
                                                            href="">View</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-none border mb-4">
                            <div class="card-header">
                                <span>Priority Number</span>
                            </div>
                            <div class="card-body">
                                <div class="col-12 border p-2 text-center rounded bg-light">
                                    <h1 class="fw-700 mb-0 text-xl">{{ $appointment->priority_number }}</h1>
                                </div>
                                <p class="text-center mt-2 mb-0 text-gray-500 font-italic">A priority number will be
                                    generated once scheduled.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card shadow-none mb-4 mb-xl-4">
                            <div class="card-header">
                                Actions
                            </div>
                            <div class="card-body">
                                    <div class="row gy-2">
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="dropdown w-100">--}}
{{--                                                <button class="btn btn-primary dropdown-toggle w-100" id="dropdownFadeIn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Update Status</button>--}}
{{--                                                <div class="dropdown-menu animated--fade-in w-100"--}}
{{--                                                     aria-labelledby="dropdownFadeIn">--}}
{{--                                                    @if (is_null($appointment->status))--}}
{{--                                                        <a class="dropdown-item" href=""><i class="fas fa-calendar-check text-secondary me-2"></i>Schedule Request</a>--}}
{{--                                                        <div class="dropdown-divider"></div>--}}
{{--                                                        <a class="dropdown-item" href="{{ route('appointments.cancel', ['id' => $appointment->id]) }}"><i class="fas fa-times text-danger me-2"></i>Cancel Request</a>--}}
{{--                                                        <div class="dropdown-divider"></div>--}}
{{--                                                        <a class="dropdown-item" href="{{ route('appointments.cancel', ['id' => $appointment->id]) }}"><i class="fas fa-times text-danger me-2"></i>Reschedule</a>--}}
{{--                                                    @endif--}}

{{--                                                    @if ($appointment->status === 0)--}}
{{--                                                        <a class="dropdown-item" href="{{ route('appointments.done', ['id' => $appointment->id]) }}"><i class="fas fa-check text-success me-2"></i>Done Appointment</a>--}}
{{--                                                        <div class="dropdown-divider"></div>--}}
{{--                                                        <a class="dropdown-item" href="{{ route('appointments.cancel', ['id' => $appointment->id]) }}"><i class="fas fa-times text-danger me-2"></i>Cancel Appointment</a>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        @if (is_null($appointment->status))
                                            <div class="col-md-12">
                                                <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#scheduleAppointmentModal" href="">
                                                    <i class="fa-solid fa-calendar-check me-2"></i> Schedule Appointment
                                                </button>
                                            </div>
                                        @endif
                                        @if (!is_null($appointment->status) && ($appointment->status == 0))
                                            <div class="col-md-12">
                                                <button class="btn btn-outline-green w-100" type="button" data-bs-toggle="modal" data-bs-target="#doneAppointmentModal">
                                                    <i class="fa-solid fa-check me-2"></i> Done Appointment
                                                </button>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-outline-danger w-100" type="button" data-bs-toggle="modal" data-bs-target="#cancelAppointmentModal">
                                                    <i class="fa-solid fa-x me-2"></i> Cancel Appointment
                                                </button>
                                            </div>
                                        @endif
                                        @if(is_null($appointment->status) || in_array($appointment->status, [0, 2]))
                                            <div class="col-md-12">
                                                <button class="btn btn-outline-secondary w-100" type="button" data-bs-toggle="modal" data-bs-target="#editAppointmentModal">
                                                    <i class="fa-solid fa-calendar-days me-2"></i> Reschedule Appointment
                                                </button>
                                            </div>
                                        @endif
                                        @if (in_array($appointment->status, [1]))
                                            <div class="col-md-12">
                                                <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#editAppointmentModal">
                                                    <i class="fa-solid fa-file-invoice me-2"></i> Proceed to Billing
                                                </button>
                                            </div>
                                        @endif
                                    </div>
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
