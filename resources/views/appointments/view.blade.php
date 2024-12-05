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
                            <input class="form-control" id="inputEmailAddress" type="date" name="appointment_date" value="{{$appointment->appointment_date}}"/>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputEmailAddress">Appointment Time</label>
                            <input class="form-control" id="inputEmailAddress" type="time" name="appointment_time" value="{{$appointment->appointment_time}}"/>
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="inputEmailAddress">Attending Veterinarian</label>
                            <select class="form-control" id="vetSelect" name="doctor_ID">
                                @foreach ($vets as $vet)
                                    <option class="form-control"
                                            value={{ $vet->id }} {{$appointment->doctor_ID === $vet->id ?? 'selected' }}>{{ $vet->firstname.' '.$vet->lastname }}</option>
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
                            <label class="small mb-1" for="inputPurpose">Purpose</label>
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
    <nav class="nav nav-borders">
        <a class="nav-link ms-0" href="{{route('appointments.index')}}"><span class="px-2"><i class="fa-solid fa-arrow-left"></i></span> Back</a>
    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card shadow-none mb-4">
                <div class="card-header">Appointment Details</div>
                <div class="card-body">
                    <div class="card-icon mb-4 border border-1 rounded">
                        <div class="row g-0">
                            <div class="col-sm-2 card-icon-aside bg-info p-4 rounded"><i
                                    class="text-white-50 fa-regular fa-calendar-check"></i></div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col">
                                        <div class="card-body py-4">
                                            <h5 class="card-title">Appointment ID</h5>
                                            <p class="card-text">
                                                {{ sprintf("VETIS-%05d", $appointment->id) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card-body py-4">
                                            <h5 class="mb-1 text-dark-90">Appointment Status</h5>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gx-3 mb-2">
                        <div class="col-md-12">
                            <h6 class="mb-2 text-primary">Appointment Schedule</h6>
                            <hr class="mt-1 mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Appointment Date</label>
                                    <p>{{\Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y')}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Appointment Time</label>
                                    <p>{{\Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A')}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="appointmentPurpose">Purpose</label>
                                    <p>{{$appointment->purpose}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Attending Veterinarian</label>
                                    @php
                                        $vet = \App\Models\Doctor::where('id',$appointment->doctor_ID)->first()
                                    @endphp
                                    <p>{{$vet->firstname. " " . $vet->lastname}}</p>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 mt-2">
                            <h6 class="mb-2 text-primary">Owner Information</h6>
                            <hr class="mt-1 mb-2">
                            @php
                            Clients::setEmailAttribute($appointment->client, $appointment->client->user_id);
                            @endphp
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="small mb-1" for="inputPetName">Name</label>
                                    <p>{{$appointment->client->client_name}}</p>
                                </div>
                                <div class="col-md-12">
                                    <label class="small mb-1" for="inputPetName">Address</label>
                                    <p>{{$appointment->client->client_address}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPetName">Contact Number</label>
                                    <p>{{$appointment->client->client_no}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPetName">Email</label>
                                    <p>{{$appointment->client->client_email}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h6 class="mb-2 mt-3 text-primary">Pet Information</h6>
                            <hr class="mt-1 mb-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="PetName">Pet Name</label>
                                    <p>{{$appointment->pet->pet_name}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="petType" class="small mb-1">Pet Type</label>
                                    <p>{{$appointment->pet->pet_type}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="petBreed" class="small mb-1">Breed</label>
                                    <p>{{$appointment->pet->pet_breed}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="petBreed" class="small mb-1">Age</label>
                                    <p>{{$appointment->pet->age}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card shadow-none mb-4 mb-xl-4">
                <div class="card-header">
                    Actions
                </div>
                <div class="card-body">
                    @if($appointment->status != 1 && $appointment->status != 2)
                    <div class="dropdown w-100 mb-2">
                        <button class="btn btn-primary dropdown-toggle w-100" id="dropdownFadeIn" type="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Update
                            Status</button>
                        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownFadeIn">
                            <a class="dropdown-item" href="{{route('appointments.done', ['id' => $appointment->id])}}">Done Appointment</a>
                            <a class="dropdown-item" href="{{route('appointments.cancel', ['id' => $appointment->id])}}">Cancel Appointment</a>
                            @if( is_null($appointment->status))
                            <a class="dropdown-item" href="{{route('appointments.schedule', ['id' => $appointment->id])}}">Schedule Appointment</a>
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
