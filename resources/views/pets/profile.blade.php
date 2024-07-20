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
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="{{ route('pets.show', $pet->id) }}">Pet Profile</a>
        @if (auth()->user()->role != "staff")
        <a class="nav-link" href="{{ route('pets.edit', $pet->id) }}">Edit Profile</a>
        @endif
    </nav>
    <hr class="mt-0 mb-4" />
    <div class="row">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Pet Profile</div>
                <div class="card-body">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputPetName">Pet Name</label>
                            <p>{{$pet->pet_name}}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputPetName">PetID</label>
                            <p>{{$pet->id}}</p>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectPetType">Pet Type</label>
                            <p>{{$pet->pet_type}}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBreed">Breed</label>
                            <p>{{$pet->pet_breed}}</p>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputColor">Color</label>
                            <p>{{$pet->pet_color}}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputWeight">Weight</label>
                            <p>{{$pet->pet_weight}}</p>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBirthdate">Birthdate</label>
                            <p>{{$pet->pet_birthdate}}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectGender">Gender</label>
                            <p>{{$pet->pet_gender}}</p>
                        </div>
                    </div>
                    <h6 class="mb-2 mt-5 text-primary">Other Information</h6>
                    <hr class="mt-1 mb-3">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="vaccinatedCheckbox" value="option1" @checked($pet->vaccinated) disabled>
                                <label class="small" for="vaccinatedCheckbox">Vaccinated</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="neuteredCheckbox" value="option1" @checked($pet->neutered) disabled>
                                <label class="small" for="neuteredCheckbox">Spayed/Neutered</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="small mb-1" for="inputPetDescription">Pet Description</label>
                        <p>{{$pet->pet_description}}</p>
                    </div>
                    <h6 class="mb-2 mt-5 text-primary">Owner Information</h6>
                    <hr class="mt-1 mb-3">

                    <div class="mb-3">
                        <label class="small mb-1" for="inputOwnerName">Owner Name</label>
                        <p>{{$pet->client->client_name}}</p>
                    </div>
                    <div class="row gx-3 mb-1">
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputOwnerAddress">Owner Address</label>
                            <p>{{$pet->client->client_address}}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="ownerContact">Contact Number</label>
                            <p>{{$pet->client->client_no}}</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputOwnerEmail">Email Address</label>
                        <p>{{$pet->client->client_email_address}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Pet Photo</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="https://img.freepik.com/premium-vector/white-cat-portrait-hand-drawn-illustrations-vector_376684-65.jpg" alt="" />
                </div>
            </div>
            <div class="card mb-4 mt-5 mb-xl-0">
                <div class="card-header">Pet History</div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var pet = @json($pet);
    console.log(pet);
</script>
@endsection

@section('scripts')

@endsection
