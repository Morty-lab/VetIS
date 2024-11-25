@php use App\Models\Clients; @endphp
@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<div id="successAlert" class="alert alert-primary alert-icon position-fixed bottom-0 end-0 m-3" role="alert"
    style="display: none; z-index: 100;">
    <div class="alert-icon-aside">
        <i class="fa-regular fa-circle-check"></i>
    </div>
    <div class="alert-icon-content">
        <h6 class="alert-heading">Success</h6>
        Doctor Registered Successfully!
    </div>
</div>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('pet.index') }}">Manage Pets</a></li>
                    <li class="breadcrumb-item active">Pet Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-4">
    <nav class="nav nav-borders">
        <a class="nav-link nav-tab ms-0{{ request()->is('pet-profile') ? 'active' : '' }}" href="#pet-profile">Pet Profile</a>
        <a class="nav-link nav-tab{{ request()->is('schedules') ? 'active' : '' }}" href="#schedules">Schedules</a>
        <a class="nav-link nav-tab{{ request()->is('history') ? 'active' : '' }}" href="#history">History</a>
        <a class="nav-link nav-tab{{ request()->is('records') ? 'active' : '' }}" href="#records">Records</a>
    </nav>
    <hr class="mt-0 mb-4" />
    <div class="row" id="petProfileCard" style="display:none;">
        <div class="col-md-12">
            <!-- Account details card-->
            <div class="card mb-4 shadow-none">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Pet Profile</span>
                    <div class="dropdown">
                        <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="{{ route('pets.edit', $pet->id) }}">Update Pet Info</a></li>
                            <li><a class="dropdown-item" href="">Print</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gx-5 px-3">
                        <div class="col d-flex justify-content-center align-items-center card shadow-none">
                            <img class="img-account-profile rounded-circle mb-2 p-1"
                                src="https://img.freepik.com/premium-vector/white-cat-portrait-hand-drawn-illustrations-vector_376684-65.jpg"
                                alt="" />
                        </div>
                        <div class="col-md-9">
                            <div class="row gx-3">
                                <div class="col-md-12">
                                    <h6 class="mb-2 text-primary">Pet Information</h6>
                                    <hr class="mt-1 mb-3">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPetName">Pet Name</label>
                                    <p>{{$pet->pet_name}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPetName">PetID</label>
                                    <div>
                                        <p class="badge bg-primary-soft text-primary rounded-pill">PETID-{{ str_pad($pet->id, 5, '0', STR_PAD_LEFT) }}</p>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="selectPetType">Pet Type</label>
                                    <p>{{$pet->pet_type}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBreed">Breed</label>
                                    <p>{{$pet->pet_breed}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputColor">Color</label>
                                    <p>{{$pet->pet_color}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputWeight">Weight</label>
                                    <p>{{$pet->pet_weight}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthdate">Birthdate</label>
                                    <p>{{$pet->pet_birthdate}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="selectGender">Gender</label>
                                    <p>{{$pet->pet_gender}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-5">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <h6 class="mb-2 text-primary">Other Information</h6>
                                    <hr class="mt-1 mb-3">
                                </div>
                                <div class="row gx-3">
                                    <div class="col-md-3">
                                        <label class="small mb-1">Vacciantion Record</label>
                                        <p>
                                            @if($pet->vaccinated == 1)
                                            Complete as of {{ \Carbon\Carbon::parse($pet->anti_rabies_vaccination_date)->format('F j, Y') }}
                                            @elseif($pet->vaccinated == 0)
                                            Incomplete as of {{ \Carbon\Carbon::parse($pet->anti_rabies_vaccination_date)->format('F j, Y') }}
                                            @else
                                            No Vaccination record
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small mb-1">Spayed/Neutered</label>
                                        <p>
                                            {{$pet->neutered == 1 ? 'Yes' : 'No'}}
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small mb-1">Vaccinated with Anti-Rabies?</label>
                                        <p>
                                            {{$pet->vaccinated_anti_rabies == 1 ? 'Yes' : 'No'}}
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small mb-1">Date of Anti-Rabies Vaccination</label>
                                        <p>{{ \Carbon\Carbon::parse($pet->anti_rabies_vaccination_date)->format('F j, Y') }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small mb-1">Okay to use photos online?</label>
                                        <p>
                                            {{$pet->okay_to_use_photos_online == 1 ? 'Yes' : 'No'}}
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small mb-1">Date of Last Groom</label>
                                        <p>{{ \Carbon\Carbon::parse($pet->last_groom_date)->format('F j, Y') }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small mb-1">Okay to give treats?</label>
                                        <p> {{$pet->okay_to_give_treats == 1 ? 'Yes' : 'No'}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Food</label>
                                        <p class="form-control">{{$pet->pet_food != null ? $pet->pet_food : "No Specific Food Identified"}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">History of Aggression</label>
                                        <p class="form-control">
                                            {{$pet->history_of_aggression != null ? $pet->history_of_aggression : 'No History of Aggression Identified'}}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Food Allergies</label>
                                        <p class="form-control">{{$pet->food_allergies !=  null ? $pet->food_allergies : "No Allergies Recorded"}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Pet Condition</label>
                                        <p class="form-control">{{$pet->pet_condition != null ? $pet->pet_condition : "No Conditions Recorded"}}</p>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-12 mt-3">--}}
                            {{-- <label class="small mb-1" for="inputPetDescription">Pet Description</label>--}}
                            {{-- <p>{{$pet->pet_description}}</p>--}}
                            {{-- </div>--}}
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <h6 class="mb-2 text-primary">Owner Information</h6>
                                    <hr class="mt-1 mb-3">
                                    <div class="row gx-3">
                                        @php
                                        Clients::setEmailAttribute($pet->client, $pet->client->user_id);
                                        @endphp
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputOwnerName">Owner Name</label>
                                            <p>{{$pet->client->client_name}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputOwnerAddress">Owner Address</label>
                                            <p>{{$pet->client->client_address}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="ownerContact">Contact Number</label>
                                            <p>{{$pet->client->client_no}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputOwnerEmail">Email Address</label>
                                            <p>{{$pet->client->client_email}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card mb-4 shadow-none" id="schedulesCard" style="display:none;">
                <div class="card-header">
                    Schedules
                </div>
                <div class="card-body">
                    <!-- <div class="no-records text-center p-2">
                                <i class="fa-solid fa-hippo"></i>
                                No Records Yet
                            </div> -->
                    <table id="petSchedTable">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Appointment ID</th>
                                <th>Purpose</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $appointments as $appointment)
                            @if($appointment->pet_ID == $pet->id && $appointment->status != 1)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }}
                                    |
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                </td>
                                <td>AppointentID</td>

                                <td>{{$appointment->purpose}}</td>

                                <td>
                                    @if(is_null($appointment->status) == true)
                                    Pending
                                    @elseif($appointment->status == 0)
                                    <div class="badge bg-secondary-soft text-secondary rounded-pill">Scheduled</div>
                                    @elseif($appointment->status == 2)
                                    Cancelled
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('appointments.view',['id'=>$appointment->id])}}"
                                        class="btn btn-datatable btn-primary px-5 py-3">Open</a>
                                </td>
                            </tr>

                            @else
                            @continue
                            @endif

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 shadow-none" id="historyCard" style="display:none;">
                    <div class="card-header">
                        History
                    </div>
                    <div class="card-body">
                        <!-- <div class="no-records text-center p-2">
                                <i class="fa-solid fa-hippo"></i>
                                No Records Yet
                            </div> -->
                        <table id="petHistoryTable">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Appointment ID</th>
                                    <th>Purpose</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                @if($appointment->pet_ID == $pet->id && $appointment->status == 1)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }}
                                        |
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                    </td>
                                    <td>Appointment ID</td>
                                    <td>{{$appointment->purpose}}</td>
                                    <td>
                                        <div class="badge bg-success-soft text-success rounded-pill">Finished</div>
                                    </td>
                                    <td><a href="{{route('appointments.view',['id'=>$appointment->id])}}"
                                            class="btn btn-datatable btn-primary px-5 py-3">Open</a></td>
                                </tr>
                                @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-4 shadow-none" id="recordsCard" style="display:none;">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Records</span>
                            <a class="btn btn-primary" type="button"
                                href="{{route('soap.create', ['id' =>$pet->id])}}">New</a>
                        </div>
                        <div class="card-body">
                            <!-- only shows if there is no record -->
                            <!-- <div class="no-records text-center p-2">
                                <i class="fa-solid fa-hippo"></i>
                                No Records Yet
                            </div> -->
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Date Created</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Subjective</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $consultation_type = [
                                    1=> "Walk-In" ,
                                    2=> "Consultation" ,
                                    3=> "Vaccination",
                                    4=> "Surgery"
                                    ];
                                    @endphp
                                    @foreach($pet_records as $record)
                                    <tr>
                                        <td>{{$record->record_date}}</td>
                                        <td>{{sprintf('VETIS-%05d', $record->id)}}</td>
                                        <td>{{$consultation_type[$record->consultation_type] }}</td>
                                        <td>{{$record->complaint}}</td>
                                        <td>{{($record->status == 1) ? "Filled" : "Ongoing"}}</td>
                                        <td>
                                            <a class="btn btn-datatable btn-primary px-5 py-3" href="{{route('soap.view', ['id' => $pet->id, 'recordID' => $record->id])}}">Open</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('scripts')
        <script>
            var pet = @json($pet);
            console.log(pet);

            document.addEventListener('DOMContentLoaded', function() {
                const tabs = document.querySelectorAll('.nav-tab');
                const cards = {
                    'pet-profile': document.getElementById('petProfileCard'),
                    'schedules': document.getElementById('schedulesCard'),
                    'history': document.getElementById('historyCard'),
                    'records': document.getElementById('recordsCard')
                };

                // Ensure Pet Profile is active initially
                document.querySelector('.nav-link[href="#pet-profile"]').classList.add('active');
                cards['pet-profile'].style.display = 'block'; // Show Pet Profile Card by default

                tabs.forEach(tab => {
                    tab.addEventListener('click', function(e) {
                        e.preventDefault();
                        // Remove active class from all tabs
                        tabs.forEach(t => t.classList.remove('active'));
                        tab.classList.add('active');

                        // Hide all cards
                        Object.values(cards).forEach(card => card.style.display = 'none');

                        // Show the clicked tab's corresponding card
                        const targetCard = tab.getAttribute('href').substring(1);
                        if (cards[targetCard]) {
                            cards[targetCard].style.display = 'block';
                        }
                    });
                });

                // Trigger the click on the Pet Profile tab to show it initially
                document.querySelector('.nav-tab.active').click();
            });
        </script>

        @endsection