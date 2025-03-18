@php use App\Models\Clients; @endphp
@extends('layouts.app')

@section('styles')
@endsection

@section('content')

<div class="modal fade" id="editAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{route('appointments.update',['appid'=>$appointment->id])}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Appointment</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Row-->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputEmailAddress">Appointment Date</label>
{{--                            <input class="form-control" id="inputEmailAddress" type="date" name="appointment_date" value="{{$appointment->appointment_date}}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />--}}
                            <div class="input-group input-group-joined">
                                <input type="text" class="form-control" id="select-schedule" name="appointment_date" placeholder="YYYY-MM-DD" value="{{$appointment->appointment_date}}">
                                <span class="input-group-text">
                                    <i data-feather="calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputEmailAddress">Appointment Time</label>
                                <select class="select-appointment-time-edit form-control" id="selectAppointmentTime" name="appointment_time" data-placeholder="Select Time" required>
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
                        <div class="col-md-12">
                            <label class="small mb-1" for="inputEmailAddress">Veterinarian</label>
                            <select class="select-attending-vet-edit form-control" id="vetSelect" name="doctor_ID">
                                @foreach ($vets as $vet)
                                <option class="form-control"
                                    value={{ $vet->id }} {{$appointment->doctor_ID === $vet->id ?? 'selected' }}>Dr. {{ $vet->firstname.' '.$vet->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <!-- <h6 class="mb-2 mt-3 text-primary">Owner Information</h6>
                            <hr class="mt-1 mb-2"> -->
                            <label class="small mb-1" for="inputPetName">Pet Owner</label>
                            <select class="form-control" id="inputOwnerName" type="select" placeholder="Name"
                                onchange="handleClientSelect()" value="" name="owner_ID" disabled>
                                <option value="">Select Owner</option>
                                <option value="1" selected>{{Clients::where('id',$appointment->owner_ID)->first()->client_name}}</option>

                            </select>
                            <!-- <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Address</label>
                                <input class="form-control" id="inputOwnerAddress" type="text" placeholder="Address"
                                    value="" readonly />
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPetName">Contact Number</label>
                                    <input class="form-control" id="ownerContact" type="text"
                                        placeholder="Contact Number" value="" readonly />
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPetName">Email</label>
                                    <input class="form-control" id="inputOwnerEmail" type="text" placeholder="Email"
                                        value="" readonly />
                                </div>
                            </div> -->
                        </div>
                        <div class="col-md-6">
                            <!-- <h6 class="mb-2 mt-3 text-primary">Pet Information</h6>
                            <hr class="mt-1 mb-2"> -->
                            <label class="small mb-1" for="inputPetName">Pet Name</label>
                            <select class="form-control" id="inputPetName" type="select" placeholder="Name"
                                value="" name="pet_ID" onchange="handlePetSelect()" disabled>
                                <option value="" selected>{{\App\Models\Pets::where('id',$appointment->pet_ID)->first()->pet_name}}</option>

                                <option value="" class="pets"
                                    style="display:none">Pet info</option>

                            </select>
                            <!-- <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Pet Type</label>
                                <input class="form-control" id="inputPetype" type="text" placeholder="Pet Type"
                                    value="" />
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Breed</label>
                                <input class="form-control" id="inputPetBreed" type="text" placeholder="Breed"
                                    value="" />
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Age</label>
                                <input class="form-control" id="inputPetAge" type="text" placeholder="Address"
                                    value="" />
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPetName">Service</label>
                                <select class="form-control" name="purpose" id="">
                                    <option value="vaccination">Vaccination</option>
                                    <option value="surgery">Surgery</option>
                                </select>
                            </div> -->
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="inputPurpose">Reason of Visit</label>
                            <textarea class="form-control" name="inputPurpose" id="inputPurpose" cols="20" rows="10">{{$appointment->purpose}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Save</button>
                    <button class="btn btn-light text-primary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
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
{{--                    <div class="card-icon mb-4 border border-1 rounded">--}}
{{--                        <div class="row g-0">--}}
{{--                            <div class="col-sm-2 card-icon-aside bg-info p-4 rounded"><i--}}
{{--                                    class="text-white-50 fa-regular fa-calendar-check"></i></div>--}}
{{--                            <div class="col-sm-10">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col">--}}
{{--                                        <div class="card-body py-4">--}}
{{--                                            <h5 class="card-title">Appointment ID</h5>--}}
{{--                                            <p class="card-text">--}}
{{--                                                {{ sprintf("VETIS-%05d", $appointment->id) }}--}}
{{--                                            </p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col">--}}
{{--                                        <div class="card-body py-4">--}}
{{--                                            <h5 class="mb-1 text-dark-90">Appointment Status</h5>--}}
{{--                                            @if (is_null($appointment->status) == true)--}}
{{--                                            <div class="badge bg-warning-soft text-warning text-sm rounded-pill">--}}
{{--                                                Pending--}}
{{--                                            </div>--}}
{{--                                            @elseif ($appointment->status == 0)--}}
{{--                                            <div class="badge bg-secondary-soft text-secondary text-sm rounded-pill">--}}
{{--                                                Scheduled--}}
{{--                                            </div>--}}
{{--                                            @elseif ($appointment->status == 2)--}}
{{--                                            <div class="badge bg-danger-soft text-danger text-sm rounded-pill">--}}
{{--                                                Canceled--}}
{{--                                            </div>--}}
{{--                                            @elseif ($appointment->status == 1)--}}
{{--                                            <div class="badge bg-success-soft text-success text-sm rounded-pill">--}}
{{--                                                Finished--}}
{{--                                            </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="row gx-3 mb-2">
                        <div class="col-md-12">
{{--                            <h6 class="mb-2 text-primary">Appointment Schedule</h6>--}}
{{--                            <hr class="mt-1 mb-3">--}}
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
                                    <p>{{ sprintf("VETIS-%05d", $appointment->id) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Appointment Date</label>
                                    <p class="text-primary">{{\Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y')}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Appointment Time</label>
                                    <p class="text-primary">{{\Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A')}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Veterinarian</label>
                                    @php
                                        $vet = \App\Models\Doctor::where('id',$appointment->doctor_ID)->first()
                                    @endphp
                                    <p class="text-primary fw-bold">Dr. {{$vet->firstname. " " . $vet->lastname}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Pet Owner</label><br>
                                    <p class="text-primary fw-bold">{{$appointment->client->client_name}}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="small mb-1">Pet/s</label><br>
                                    <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                       {{$appointment->pet->pet_name}}
                                    </span>
                                </div>
                                <div class="col-md-12 mt-3">
{{--                                    <label class="small mb-1" for="appointmentPurpose">Purpose</label>--}}
{{--                                    <p>{{$appointment->purpose}}</p>--}}
                                       <div class="border py-3 px-3 border-top-lg border-top-primary rounded">
                                           <label class="mb-1 text-primary fw-bold b">Reason of Visit</label>
                                           <p class="mb-0">
                                               {{$appointment->purpose}}
                                           </p>
                                       </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-none mb-4">
                <div class="card-header">
                    Pet Owner Details
                </div>
                <div class="card-body">
                        @php
                            Clients::setEmailAttribute($appointment->client, $appointment->client->user_id);
                        @endphp
                        <div class="row">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPetName">Name</label>
                                <p class="text-primary">{{$appointment->client->client_name}}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPetName">Address</label>
                                <p>{{$appointment->client->client_address}}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPetName">Contact Number</label>
                                <br>
                                <a href="tel:{{$appointment->client->client_no}}">{{$appointment->client->client_no}}</a>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPetName">Email</label>
                                <br>
                                <a href="mailto:{{$appointment->client->client_email}}">{{$appointment->client->client_email}}</a>
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
                                    <tr data-index="0">
                                        <td>{{$appointment->pet->pet_name}}</td>
                                        <td>{{$appointment->pet->pet_type}}</td>
                                        <td>{{$appointment->pet->pet_breed}}</td>
                                        <td>{{$appointment->pet->age}} year/s old</td>
                                        <td><a class="btn btn-datatable btn-primary px-5 py-3" href="">View</a></td>
                                    </tr>
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
                                <h1 class="fw-700 mb-0 text-xl">#-----</h1>
                            </div>
                            <p class="text-center mt-2 mb-0 text-gray-500 font-italic">A priority number will be generated once scheduled.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card shadow-none mb-4 mb-xl-4">
                        <div class="card-header">
                            Actions
                        </div>
                        <div class="card-body">
                            @if($appointment->status != 1 && $appointment->status != 2)
                                <div class="dropdown w-100 mb-2">
                                    <button class="btn btn-primary dropdown-toggle w-100" id="dropdownFadeIn" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Update Appointment
                                        Status</button>
                                    <div class="dropdown-menu animated--fade-in w-100" aria-labelledby="dropdownFadeIn">
                                        @if( is_null($appointment->status))
                                            <a class="dropdown-item" href="{{route('appointments.schedule', ['id' => $appointment->id])}}"><i class="fas fa-calendar-check text-secondary me-2"></i>Schedule Request</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{route('appointments.cancel', ['id' => $appointment->id])}}"><i class="fas fa-times text-danger me-2"></i>Cancel Request</a>
                                        @endif

                                            @if ($appointment->status === 0)
                                                <a class="dropdown-item" href="{{ route('appointments.done', ['id' => $appointment->id]) }}"><i class="fas fa-check text-success me-2"></i>Done Appointment</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{route('appointments.cancel', ['id' => $appointment->id])}}"><i class="fas fa-times text-danger me-2"></i>Cancel Appointment</a>
                                            @endif
                                    </div>
                                </div>
                                <button class="btn btn-secondary w-100" type="button" data-bs-toggle="modal"
                                        data-bs-target="#editAppointmentModal">Edit Appointment
                                </button>
                                <hr>
                            @endif
                            <a href="{{route('pets.show', $appointment->pet_ID)}}" class="btn btn-outline-primary mb-2 w-100">View Pet</a>
                            <a href="{{route('owners.show',  $appointment->owner_ID)}}" class="btn btn-outline-primary mb-2 w-100">View Pet Owner</a>
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
