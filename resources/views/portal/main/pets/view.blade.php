@extends('portal.layouts.app')
@section('outerContent')
<header class="page-header page-header-compact page-header-light border-bottom bg-white">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{route('portal.mypets')}}">My Pets</a></li>
                    <li class="breadcrumb-item active">Pet Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
@endsection
@section('content')
<div class="row gx-4">
    <div class="col-md-12">
        <!-- Account details card-->
        <div class="card mb-4 shadow-none">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Pet Profile</span>
                <div class="dropdown">
                    <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg class="svg-inline--fa fa-ellipsis-vertical" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-vertical" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M64 360C94.93 360 120 385.1 120 416C120 446.9 94.93 472 64 472C33.07 472 8 446.9 8 416C8 385.1 33.07 360 64 360zM64 200C94.93 200 120 225.1 120 256C120 286.9 94.93 312 64 312C33.07 312 8 286.9 8 256C8 225.1 33.07 200 64 200zM64 152C33.07 152 8 126.9 8 96C8 65.07 33.07 40 64 40C94.93 40 120 65.07 120 96C120 126.9 94.93 152 64 152z"></path>
                        </svg><!-- <i class="fa fa-ellipsis-v"></i> Font Awesome fontawesome.com -->
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ route('portal.mypets.edit',['petid' => $pet->id])}}">Edit Pet</a></li>
                        <li><a class="dropdown-item" href="">Print</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="row gx-5 px-3">
                    <div class="col d-flex justify-content-center align-items-center card shadow-none">
                        <img class="img-account-profile custom-img-2 rounded" src="{{$pet->pet_picture != null ? asset('storage/' . $pet->pet_picture) :'https://img.freepik.com/premium-vector/white-cat-portrait-hand-drawn-illustrations-vector_376684-65.jpg'}}" alt="">
                    </div>
                    <div class="col-md-9">
                        <div class="row gx-3">
                            <div class="col-md-12">
                                <h6 class="mb-2 text-primary">Pet Information</h6>
                                <hr class="mt-1 mb-3">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPetName">Pet Name</label>
                                <p class="text-primary fw-bold">{{$pet->pet_name}}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPetName">PetID</label>
                                <div class="">
                                    <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                        {{sprintf("VetIS-%05d", $pet->id)}}
                                    </span>
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
                <!-- <div class="row gx-5">
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
                                        Incomplete as of November 19, 2024
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1">Spayed/Neutered</label>
                                    <p>
                                        No
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1">Vaccinated with Anti-Rabies?</label>
                                    <p>
                                        No
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1">Date of Anti-Rabies Vaccination</label>
                                    <p>November 19, 2024</p>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1">Okay to use photos online?</label>
                                    <p>
                                        No
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1">Date of Last Groom</label>
                                    <p>November 19, 2024</p>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1">Okay to give treats?</label>
                                    <p> No</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Food</label>
                                    <p class="form-control">No Specific Food Identified</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">History of Aggression</label>
                                    <p class="form-control">
                                        No History of Aggression Identified
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Food Allergies</label>
                                    <p class="form-control">No Allergies Recorded</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Pet Condition</label>
                                    <p class="form-control">No Conditions Recorded</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <h6 class="mb-2 text-primary">Owner Information</h6>
                                <hr class="mt-1 mb-3">
                                <div class="row gx-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputOwnerName">Owner Name</label>
                                        <p>Julian Batz</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputOwnerAddress">Owner Address</label>
                                        <p>406 Marcellus MotorwayZiemefort, HI 04747-8777</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="ownerContact">Contact Number</label>
                                        <p>947-353-2513</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputOwnerEmail">Email Address</label>
                                        <p>zdickens@example.net</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4 shadow-none" id="historyCard" style="display: block;">
            <div class="card-header">
                History
            </div>
            <div class="card-body">
                <!-- <div class="no-records text-center p-2">
                                <i class="fa-solid fa-hippo"></i>
                                No Records Yet
                            </div> -->
                <table id="petAppointmentsHistoryTable">
                    <thead>
                        <tr>
                            <th><a href="#">Date</a></th>
                            <th><a href="#">Subject</a></th>
                            <th><a href="#">Status</a></th>
                            <th><a href="#">Action</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        @if($appointment->status === 1)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }} | {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</td>
                            <td>{{$appointment->purpose}}</td>
                            <td>Completed</td>
                            <td><a href="" class="btn btn-primary">Open</a></td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card shadow-none border mb-4">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Scheduled Appointments</span>
{{--            <div class="">--}}
{{--                <a class="btn btn-primary">Book Appointment</a>--}}
{{--            </div>--}}
        </div>
        <div class="card-body">
            <table id="petScheduledAppointmentsTable">
                <thead>
                    <tr>
                        <th><a href="#">Appointment ID</a></th>
                        <th><a href="#">Date and Time</a></th>
                        <th><a href="#">Veterinarian</a></th>
                        <th><a href="#">Purpose</a></th>
                        <th><a href="#">Status</a></th>
                        <th><a href="#">Actions</a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                    @if($appointment->status === 0)
                    <tr>
                        <td>{{ sprintf("VetIS-%05d", $appointment->id)}}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }} | {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</td>
                        <td>
                            @foreach($vets as $vet)
                            @if($vet->id == $appointment->doctor_ID)
                            {{$vet->firstname . " " . $vet->lastname}}
                            @endif
                            @endforeach
                        </td>
                        <td>{{$appointment->purpose}}</td>
                        <td>Scheduled</td>

                        <td><a href="{{route('portal.appointments.view',['appid'=>$appointment->id, 'petid'=>$appointment->pet_ID])}}" class="btn btn-primary">Open</a></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{--<div class="col-md-12">--}}
{{-- <div class="card shadow-none border mb-4">--}}
{{-- <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Prescriptions</span>--}}
{{-- </div>--}}
{{-- <div class="card-body">--}}
{{-- <table id="petPrescriptionTable">--}}
{{-- <thead>--}}
{{-- <tr>--}}
{{-- <th><a href="#">Date Created</a></th>--}}
{{-- <th><a href="#">Code</a></th>--}}
{{-- <th><a href="#">Subject</a></th>--}}
{{-- <th><a href="#">Veterinarian</a></th>--}}
{{-- <th><a href="#">Actions</a></th>--}}
{{-- </tr>--}}
{{-- </thead>--}}
{{-- <tbody>--}}
{{-- @foreach($appointments as $appointment)--}}
{{-- @if($appointment->status == 2)--}}
{{-- <tr>--}}
{{-- <td>2 September, 2024 | 14:39</td>--}}
{{-- <td>Laborum error reiciendis aut labore porro eos.</td>--}}
{{-- <td>Completed</td>--}}
{{-- <td><a href="" class="btn btn-primary">Open</a></td>--}}
{{-- </tr>--}}
{{-- @endif--}}
{{-- @endforeach--}}
{{-- </tbody>--}}
{{-- </table>--}}
{{-- </div>--}}
{{-- </div>--}}
{{--</div>--}}

@endsection
