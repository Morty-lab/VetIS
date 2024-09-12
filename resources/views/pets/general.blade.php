@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<div id="successAlert" class="alert alert-primary alert-icon position-fixed bottom-0 end-0 m-3" role="alert" style="display: none; z-index: 100;">
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
    <!-- <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="{{ route('pets.show', $pet->id) }}">General</a>
        <a class="nav-link ms-0" href="{{ route('pets.show', $pet->id) }}">Records</a>
    </nav>
    <hr class="mt-0 mb-4" /> -->
    <div class="row">
        <!-- <div class="col-xl-4">

            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Pet Photo</div>
                <div class="card-body text-center">

                    <img class="img-account-profile rounded-circle mb-2" src="https://img.freepik.com/premium-vector/white-cat-portrait-hand-drawn-illustrations-vector_376684-65.jpg" alt="" />
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-primary" type="button">Update Profile Picture</button>
                </div>
            </div>
            <div class="card mb-4 mt-5 mb-xl-0">
                <div class="card-header">Pet Schedule</div>
                <div class="card-body">

                </div>
            </div>
        </div> -->
        <div class="col-md-12">
            <!-- Account details card-->
            <div class="card mb-4 shadow-none">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Pet Profile</span>
                    <div class="dropdown">
                        <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="{{ route('pets.edit', $pet->id) }}">Edit Pet</a></li>
                            <li><a class="dropdown-item" href="">Print</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gx-5 px-3">
                        <div class="col d-flex justify-content-center align-items-center card shadow-none">
                            <img class="img-account-profile rounded-circle mb-2 p-1" src="https://img.freepik.com/premium-vector/white-cat-portrait-hand-drawn-illustrations-vector_376684-65.jpg" alt="" />
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <h6 class="mb-2 text-primary">Pet Information</h6>
                                    <hr class="mt-1 mb-3">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPetName">Pet Name</label>
                                    <p>{{$pet->pet_name}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPetName">PetID</label>
                                    <p>{{$pet->id}}</p>
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
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <h6 class="mb-2 text-primary">Other Information</h6>
                                    <hr class="mt-1 mb-3">
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="col">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="vaccinatedCheckbox" value="option1" @checked($pet->vaccinated) disabled>
                                            <label class="" for="vaccinatedCheckbox">Vaccinated</label>
                                        </div>
                                    </div>
                                    <div class="col small">
                                        Last Date Vaccinated: 08/11/2024
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="col">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="neuteredCheckbox" value="option1" @checked($pet->neutered) disabled>
                                            <label class="" for="neuteredCheckbox">Spayed/Neutered</label>
                                        </div>
                                    </div>
                                    <div class="col small">
                                        Date Spayed/Neutered: N/A
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="small mb-1" for="inputPetDescription">Pet Description</label>
                                    <p>{{$pet->pet_description}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <h6 class="mb-2 text-primary">Owner Information</h6>
                                    <hr class="mt-1 mb-3">
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputOwnerName">Owner Name</label>
                                        <p>{{$pet->client->client_name}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputOwnerAddress">Owner Address</label>
                                    <p>{{$pet->client->client_address}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="ownerContact">Contact Number</label>
                                    <p>{{$pet->client->client_no}}</p>
                                </div>
                                <div class="col-md-12">
                                    <label class="small mb-1" for="inputOwnerEmail">Email Address</label>
                                    <p>{{$pet->client->client_email_address}}</p>
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
            <div class="card mb-4 shadow-none">
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
{{--                                <th>Type</th>--}}
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $appointments as $appointment)
                                @if($appointment->pet_ID == $pet->id && $appointment->status != 1)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }} |
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</td>
{{--                                        <td>Consultation</td>--}}
                                        <td>{{$appointment->purpose}}</td>
                                        @if(is_null($appointment->status) == true)

                                            <td>Pending</td>

                                        @elseif($appointment->status == 0)

                                            <td>Scheduled</td>

                                        @elseif($appointment->status == 2)

                                            <td>Cancelled</td>

                                        @endif
                                        <td><a href="{{route('appointments.view',['id'=>$appointment->id])}}" class="btn btn-primary">Open</a></td>
                                    </tr>

                                @else
                                    @continue
                                @endif

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 shadow-none">
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
                                <th>Date</th>
{{--                                <th>Type</th>--}}
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($appointments as $appointment)
                            @if($appointment->pet_ID == $pet->id && $appointment->status == 1)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }} |
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</td>
                                    {{--                                        <td>Consultation</td>--}}
                                    <td>{{$appointment->purpose}}</td>
                                    <td>Completed</td>
                                    <td><a href="{{route('appointments.view',['id'=>$appointment->id])}}" class="btn btn-primary">Open</a></td>
                                </tr>
                            @endif
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mb-4 shadow-none">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Records</span>
                    <a class="btn btn-primary" type="button" href="/petinfo/soap">New</a>
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
                            <tr>
                                <td>08/11/2024</td>
                                <td>VETIS-2032</td>
                                <td>...</td>
                                <td>...</td>
                                <td>...</td>
                                <td>
                                    <a class="btn btn-primary" href="/petinfo/soap">Open</a>
                                </td>
                            </tr>
                            <tr>
                                <td>08/11/2024</td>
                                <td>VETIS-2032</td>
                                <td>Consultation</td>
                                <td>Pet Consultation</td>
                                <td>Pending</td>
                                <td>
                                    <a class="btn btn-primary" href="/petinfo/soap">Open</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-12">
            <div class="card mb-4 shadow-none">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Vaccination</span>
                    <button class="btn btn-primary" type="button">New</button>
                </div>
                <div class="card-body">
                    <table id="vaccinationTable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>08/11/2024</td>
                                <td>VETIS-2032</td>
                                <td>Consultation</td>
                                <td>Pet Consultation</td>
                                <td>Pending</td>
                                <td>
                                    <a class="btn btn-primary" href="/um/admin/profile">Open</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->
    </div>
</div>

<script>
    var pet = @json($pet);
    console.log(pet);
</script>
@endsection

@section('scripts')

@endsection
