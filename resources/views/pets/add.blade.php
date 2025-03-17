@php use App\Models\Clients; @endphp
@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<!-- Modals -->
<!-- Upload Pet Profile Picture -->
<div class="modal fade" id="petPictureModal" tabindex="-1" role="dialog" aria-labelledby="petPictureModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Upload Pet Picture</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row justify-content-center align-items-center" style="height: 100%;">
                    <div class="col-md-6 d-flex flex-column align-items-center text-center border-end p-3 pe-3">
                        <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/illustrations/profiles/pet.png') }}" alt="Profile Picture" />
                    </div>
                    <div class="col-md-6 d-flex flex-column align-items-center text-center p-3">
                        <label for="fileInput" class="btn btn-outline-primary mb-2">Select Photo</label>
                        <input type="file" id="fileInput" class="d-none" accept="image/*" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>

<div id="successAlert" class="alert alert-primary alert-icon position-fixed bottom-0 end-0 m-3" role="alert" style="display: none; z-index: 100;">
    <div class="alert-icon-aside">
        <i class="fa-regular fa-circle-check"></i>
    </div>
    <div class="alert-icon-content">
        <h6 class="alert-heading">Success</h6>
        Pet Registered Successfully!
    </div>
</div>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="/managepet">Manage Pets</a></li>
                    <li class="breadcrumb-item active">Add New Pet</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <div class="row">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card shadow-none mb-4">
                <div class="card-header">Pet Profile</div>
                <div class="card-body">
                    <form action="{{ route('pets.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPetName">Pet Name <span class="text-danger">*</span></label>
                            <input class="form-control" id="inputPetName" type="text" placeholder="Enter Pet Name" value="" name="pet_name" autocomplete="off"/>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="selectPetType">Pet Type <span class="text-danger">*</span></label>
                                <select class="select-pet-type form-control" id="selectPetType" name="pet_type" data-placeholder="Select Pet Type">
                                    <option></option>
                                    <option>Dog</option>
                                    <option>Cat</option>
                                    <option>Other</option>
                                </select>
                                <input type="text" name="" id="" class="form-control d-none">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBreed">Breed</label>
                                <input class="form-control" id="inputBreed" type="text" placeholder="Breed" value="" name="pet_breed" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputColor">Color <span class="text-danger">*</span></label>
                                <input class="form-control" id="inputColor" type="text" value="" placeholder="Color" name="pet_color" autocomplete="off"/>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputWeight">Weight (kg) <span class="text-danger">*</span></label>
                                <input class="form-control" id="inputWeight" type="number" value="" placeholder="Weight (kg)" name="pet_weight" step="0.01" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthdate">Birthdate <span class="text-danger">*</span></label>
                                <div class="input-group input-group-joined">
                                    <input class="form-control" id="inputBirthdate" type="date" value="" name="pet_birthdate" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="Select a Date"/>
                                    <span class="input-group-text">
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="selectGender">Gender <span class="text-danger">*</span></label>
                                <select class="select-pet-gender form-control" id="selectGender" name="pet_gender" data-placeholder="Select Gender">
                                    <option></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>
                        <h6 class="mb-2 mt-5 text-primary">Other Information</h6>
                        <hr class="mt-1 mb-3">
                        <div class="row gx-3 gy-4 mb-3">
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputSelectVaccinationRecord">Does pet have vaccination record?</label>
                                <select class="select-pet-vaccination-record form-control" id="inputSelectVaccinationRecord" name="pet_vaccinated" data-placeholder="No Vaccination Record/Complete/Incomplete">
                                    <option value=""></option>
                                    <option value=2>No Vaccination Record</option>
                                    <option value=1>Complete</option>
                                    <option value=0> Incomplete</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputSelectSpayedNeutered">Spayed/Neutered</label>
                                <!-- <select class="form-control" id="inputSelectSpayedNeutered" name="pet_neutered">
                                    <option disabled selected>-- Select [Yes/No] --</option>
                                    <option value=1>Yes</option>
                                    <option value=2>No</option>
                                </select> -->
                                <div class="d-flex flex-col mt-2">
                                    <div class="form-check form-check-solid me-4">
                                        <input class="form-check-input" id="petNeuteredRadio1" type="radio" name="pet_neutered" value="1">
                                        <label class="form-check-label" for="petNeuteredRadio1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-solid">
                                        <input class="form-check-input" id="petNeuteredRadio2" type="radio" name="pet_neutered" value="2">
                                        <label class="form-check-label" for="petNeuteredRadio2">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputSelectVaccinationAntiRabiesRecord">Vacccinated With Anti-Rabies?</label>
                                <!-- <select class="form-control" id="inputSelectVaccinationAntiRabiesRecord" name="vaccinated_anti_rabies">
                                    <option disabled selected>-- Select [Yes/No] --</option>
                                    <option value=1>Yes</option>
                                    <option value=2>No</option>
                                </select> -->
                                <div class="d-flex flex-col mt-2">
                                    <div class="form-check form-check-solid me-4">
                                        <input class="form-check-input" id="vaccinatedWithAR1" type="radio" name="vaccinated_anti_rabies" value="1">
                                        <label class="form-check-label" for="vaccinatedWithAR1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-solid">
                                        <input class="form-check-input" id="vaccinatedWithAR2" type="radio" name="vaccinated_anti_rabies" value="2">
                                        <label class="form-check-label" for="vaccinatedWithAR2">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputAntiRabiesDate">If vaccinated, when was it vaccinated?</label>
                                <div class="input-group input-group-joined">
                                    <input class="form-control" id="inputAntiRabiesDate" type="text" value="" name="anti_rabies_vaccination_date" placeholder="Select a Date"/>
                                    <span class="input-group-text">
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputHistoryofAggression">Any history of agression against any other dogs?</label>
                                <textarea name="history_of_aggression" id="inputHistoryofAggression" class="form-control" cols="30" rows="8" placeholder="Enter pet's history of agression here.."></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFoodAllergies">Any Food Allergies?</label>
                                <textarea name="food_allergies" id="inputFoodAllergies" class="form-control" cols="30" rows="8" placeholder="Enter pet's food allergies here.."></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputPetFood">What type of food does your pet prefer?</label>
                                <textarea name="pet_food" id="inputPetFood" class="form-control" cols="30" rows="4" placeholder="e.g., Chicken-flavored kibble, Grain-free wet food"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputTreats">Okay to give treats?</label>
                                <!-- <select class="form-control" id="inputTreats" name="okay_to_give_treats">
                                    <option disabled selected>-- Select [Yes/No] --</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select> -->
                                <div class="d-flex flex-col mt-2">
                                    <div class="form-check form-check-solid me-4">
                                        <input class="form-check-input" id="inputTreats1" type="radio" name="okay_to_give_treats" value="1">
                                        <label class="form-check-label" for="inputTreats1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-solid">
                                        <input class="form-check-input" id="inputTreats0" type="radio" name="okay_to_give_treats" value="0">
                                        <label class="form-check-label" for="inputTreats0">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhotosOnline">Okay to use photos online?</label>
                                <!-- <select class="form-control" id="inputPhotosOnline" name="okay_to_use_photos_online">
                                    <option disabled selected>-- Select [Yes/No] --</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select> -->
                                <div class="d-flex flex-col mt-2">
                                    <div class="form-check form-check-solid me-4">
                                        <input class="form-check-input" id="inputPhotosOnline1" type="radio" name="okay_to_use_photos_online" value="1">
                                        <label class="form-check-label" for="inputPhotosOnline1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-solid">
                                        <input class="form-check-input" id="inputPhotosOnline0" type="radio" name="okay_to_use_photos_online" value="0">
                                        <label class="form-check-label" for="inputPhotosOnline0">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputLastGroom">When was his/her last groom?</label>
                                <div class="input-group input-group-joined">
                                    <input class="form-control" id="inputLastGroom" type="text" value="" name="last_groom_date" placeholder="Select a Date"/>
                                    <span class="input-group-text">
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="small mb-1" for="inputCondition">Prone to any seizure, illness, ect.? If so please list:</label>
                                <textarea name="pet_condition" id="inputCondition" class="form-control" cols="30" rows="4" placeholder="Enter any illnesses or conditions here..."></textarea>
                            </div>
                        </div>
                        <h6 class="mb-2 mt-5 text-primary">Owner Information</h6>
                        <hr class="mt-1 mb-3">

                        <div class="mb-3">
                            <label class="small mb-1" for="inputOwnerName">Owner Name <span class="text-danger">*</span></label>
                            <select class="select-pet-owner form-control" id="inputOwnerName" name="owner_name" onchange="handleClientSelect()" data-placeholder="Select a Pet Owner">
                                <option></option>
                                @foreach ($clients->sortBy('client_name') as $client)
                                @php
                                Clients::setEmailAttribute($client, $client->user_id);
                                @endphp
                                <option value="{{ $client->id }}" @if(isset($clientID ) && $client->id == $clientID) selected @endif>{{ $client->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOwnerAddress">Owner Address</label>
                                <p id="inputOwnerAddress">-----</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="ownerContact">Contact Number</label>
                                <p id="ownerContact">---- --- ----</p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputOwnerEmail">Email Address</label>
                            <p id="inputOwnerEmail">-----</p>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" id="regbtn" type="submit">Add Pet</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card shadow-none mb-4 mb-xl-0">
                <div class="card-header">Pet Photo</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/illustrations/profiles/pet.png') }}" alt="" />
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#petPictureModal">Upload Pet Image</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var clients = @json($clients);


    function handleClientSelect() {




        @if(isset($clientID))
        var selectedClient = clients.find(client => client.id == {
            {
                $clientID
            }
        });

        console.log(selectedClient)
        document.getElementById('inputOwnerAddress').textContent = selectedClient.client_address;
        document.getElementById('ownerContact').textContent = selectedClient.client_no;
        document.getElementById('inputOwnerEmail').textContent = selectedClient.client_email;

        @else
        var selectedClientId = document.getElementById('inputOwnerName').value;
        var selectedClient = clients.find(client => client.id == selectedClientId);

        if (selectedClient) {
            console.log(selectedClient)
            document.getElementById('inputOwnerAddress').textContent = selectedClient.client_address;
            document.getElementById('ownerContact').textContent = selectedClient.client_no;
            document.getElementById('inputOwnerEmail').textContent = selectedClient.client_email;
        }
        @endif



    }

    window.addEventListener("load", function() {
        handleClientSelect();
    });
</script>


@endsection

@section('scripts')

@endsection
