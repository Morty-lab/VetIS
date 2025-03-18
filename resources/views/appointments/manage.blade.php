@php use App\Models\Clients;use App\Models\Pets; @endphp
@extends('layouts.app')

@section('styles')
@endsection

@section('content')
@include('appointments.components.header', ['title' => 'Appointments'], ['icon' => '<i class="fa-regular fa-calendar-plus"></i>'])

<div class="modal fade" id="appointmentSchedModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('appointments.add') }}" method="POST">
            @csrf
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Appointment</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Row-->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputAppointmentDate">Appointment Date</label>
                            <div class="input-group input-group-joined">
                                <input class="form-control" id="select-schedule" type="text" name="appointment_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="Select a Date"/>
                                <span class="input-group-text">
                                    <i data-feather="calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputAppointmentTime">Appointment Time</label>
{{--                            <input class="form-control" id="inputEmailAddress" type="time" name="appointment_time" />--}}
                            <select class="select-appointment-time-admin form-control" id="selectAppointmentTime" name="appointment_time" data-placeholder="Select Time" required>
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
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputEmailAddress">Attending Veterinarian</label>
                            <select class="select-attending-vet form-control" id="vetSelect" name="doctor_ID">
                                @foreach ($vets as $vet)
                                <option class="form-control"
                                    value={{ $vet->id }}>{{ $vet->firstname.' '.$vet->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <!-- <h6 class="mb-2 mt-3 text-primary">Owner Information</h6>
                            <hr class="mt-1 mb-2"> -->
                            <label class="small mb-1" for="inputOwnerName">Pet Owner</label>
                            <select class="select-owner-name form-control" id="inputOwnerName" type="select" placeholder="Name"
                                onchange="handleClientSelect()" value="" name="owner_ID">
                                <option value="">Select Owner</option>
                                @foreach ($clients as $client)
                                @php
                                Clients::setEmailAttribute($client, $client->user_id);
                                @endphp
                                <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                @endforeach
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
                        <div class="col-md-12">
                            <!-- <h6 class="mb-2 mt-3 text-primary">Pet Information</h6>
                            <hr class="mt-1 mb-2"> -->
                            <label class="small mb-1" for="inputPetName">Pet Name</label>
                            <select class="select-pet-name form-control" id="inputPetName" type="select" placeholder="Name"
                                value="" name="pet_ID" onchange="handlePetSelect()" multiple="multiple" data-placeholder="Select a Pet" required autocomplete="off">
                                @foreach ($pets as $pet)
                                <option value="{{ $pet->id }}" id="{{ $pet->owner_ID }}" class="pets"
                                    style="display:none">{{ $pet->pet_name }}</option>
                                @endforeach
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
                            <textarea class="form-control" name="purpose" id="inputPurpose" cols="20" rows="10"></textarea>
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
<!-- Main page content-->
<div class=" container-xl px-4 mt-4">
    <div class="row">
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-white border-start-lg border-start-primary shadow-none text-dark h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-primary">Today's Appointments</div>
                            @php
                            $todayCount = \App\Models\Appointments::where('status', 0)->where('appointment_date', \Carbon\Carbon::today())->count();
                            @endphp
                            <div class="text-lg fw-bold">{{ $todayCount }}</div>
                        </div>
                        <i class="fa-regular fa-calendar text-gray-400 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-primary stretched-link" href="/todayappointments">View Today's Appointments</a>
                    <div class=""><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-white border-start-lg border-start-success shadow-none text-dark h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            @php
                            $finishedCount = \App\Models\Appointments::where('status', 1)->where('appointment_date', \Carbon\Carbon::today())->count();
                            @endphp
                            <div class="text-success">Finished Appointments</div>
                            <div class="text-lg fw-bold">{{ $finishedCount }}</div>
                        </div>
                        <i class="fa-regular fa-calendar-check text-gray-400 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-success stretched-link" href="/finishedappointments">View Finished Appointments</a>
                    <div class=""><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-white border-start-lg border-start-warning shadow-none text-dark h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            @php
                            $requestCount = \App\Models\Appointments::where('status', null)->count();
                            @endphp
                            <div class="text-warning">Appointment Requests</div>
                            <div class="text-lg fw-bold">{{ $requestCount }}</div>
                        </div>
                        <i class="feather-xl text-gray-400" data-feather="message-circle"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-warning stretched-link" href="/pendingappointments">View Requests</a>
                    <div class=""><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-white border-start-lg border-start-danger shadow-none text-dark h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            @php
                            $cancelledCount = \App\Models\Appointments::where('status',2)->count();
                            @endphp
                            <div class="text-danger">Cancelled Appointments</div>
                            <div class="text-lg fw-bold">{{ $cancelledCount }}</div>
                        </div>
                        <i class="fa-solid fa-xmark text-gray-400 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-danger stretched-link" href="/cancelledappointments">View Cancelled
                        Appointments</a>
                    <div class=""><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-none">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Scheduled Appointments</span></div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Priority Number</th>
                        <th>Pet Owner</th>
                        <th>Pet/s</th>
                        <th>Veterinarian</th>
                        <th>Reason of Visit</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                    @if($appointment->status === 0)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }} |
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                        </td>
                        <td>#00001</td>
                        <td>{{ $appointment->client->client_name }}</td>
                        <td>
                            <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                {{ $appointment->pet->pet_name }} | {{ $appointment->pet->pet_type }}
                            </span>
                        </td>
                        <td>Dr. {{ $vets->firstWhere('id', $appointment->doctor_ID)->lastname ?? 'No Vet Found' }}</td>
                        <td>{{ $appointment->purpose }}</td>
                        <td>
                            @if (is_null($appointment->status) == true)
                            <div class="badge bg-warning-soft text-warning rounded-pill">
                                Pending
                            </div>
                            @elseif ($appointment->status == 0)
                            <div class="badge bg-secondary-soft text-secondary rounded-pill">
                                Scheduled
                            </div>
                            @elseif ($appointment->status == 2)
                            <div class="badge bg-danger-soft text-danger rounded-pill">
                                Canceled
                            </div>
                            @elseif ($appointment->status == 1)
                            <div class="badge bg-success-soft text-success rounded-pill">
                                Finished
                            </div>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-outline-primary"
                                href="{{route('appointments.view',['id'=>$appointment->id])}}">Open</a>
                        </td>

                    </tr>
                    {{-- @else--}}
                    {{-- @continue--}}

                    @endif

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var clients = @json($clients);
    var pets = @json($pets);


    function handleClientSelect() {


        var selectedClientId = document.getElementById('inputOwnerName').value;
        var petOptions = document.querySelectorAll('#inputPetName option');
        var selectedClient = clients.find(client => client.id == selectedClientId);

        // Clear the pet selection
        document.getElementById('inputPetName').value = '';


        petOptions.forEach(function(option) {
            option.style.display = 'none';
        });

        petOptions.forEach(function(option) {
            if (option.id === selectedClientId) {
                option.style.display = 'block';
            }
        });

        if (selectedClient) {

            document.getElementById('inputPetName').value = '';
            document.getElementById('inputOwnerAddress').value = selectedClient.client_address;
            document.getElementById('ownerContact').value = selectedClient.client_no;
            document.getElementById('inputOwnerEmail').value = selectedClient.client_email;

            // document.getElementById(selectedClientId).style.display = 'block';

        }


        console.log(selectedClientId);


    }

    function handlePetSelect() {
        var selectedPetId = document.getElementById('inputPetName').value;
        var selectedPet = pets.find(pet => pet.id == selectedPetId);
        console.log(selectedPet)


        if (selectedPetId) {
            document.getElementById("inputPetype").value = selectedPet.pet_type;
            document.getElementById("inputPetBreed").value = selectedPet.pet_breed;
            @foreach($pets as $pet)
            if (selectedPetId == '{{$pet->id}}') {
                document.getElementById("inputPetAge").value = '{{ $pet->age }}'; // Using the getAgeAttribute function

            }
            @endforeach


        }

    }

    window.addEventListener("load", function() {
        handleClientSelect();
    });
</script>
@endsection

@section('scripts')
@endsection
