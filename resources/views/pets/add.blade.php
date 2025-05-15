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
    <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    <!-- Account page navigation-->
    <div class="row">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card shadow-none mb-4">
                <div class="card-header">Pet Profile</div>
                <div class="card-body">
                        @csrf
                        <div class="mb-3"><label class="small mb-1" for="inputPetName">Pet Name <span
                                    class="text-danger">*</span></label>
                            <input class="form-control @error('pet_name') is-invalid @enderror" id="inputPetName"
                                   type="text" placeholder="Enter Pet Name" value="{{ old('pet_name') }}"
                                   name="pet_name" autocomplete="off"/>
                            @error('pet_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6"><label class="small mb-1" for="selectPetType">Pet Type <span
                                        class="text-danger">*</span></label>
                                <select class="select-pet-type form-control @error('pet_type') is-invalid @enderror"
                                        id="selectPetType" name="pet_type" data-placeholder="Select Pet Type">
                                        <option></option>
                                        <optgroup label="Common Pets">
                                            <option value="Dog" {{ old('pet_type') == 'Dog' ? 'selected' : '' }}>Dog</option>
                                            <option value="Cat" {{ old('pet_type') == 'Cat' ? 'selected' : '' }}>Cat</option>
                                        </optgroup>
                                        <optgroup label="Other Pets">
                                            <option value="Chicken" {{ old('pet_type') == 'Chicken' ? 'selected' : '' }}>Chicken</option>
                                            <option value="Snake" {{ old('pet_type') == 'Snake' ? 'selected' : '' }}>Snake</option>
                                            <option value="Horse" {{ old('pet_type') == 'Horse' ? 'selected' : '' }}>Horse</option>
                                            <option value="Rabbit" {{ old('pet_type') == 'Rabbit' ? 'selected' : '' }}>Rabbit</option>
                                            <option value="Hamster" {{ old('pet_type') == 'Hamster' ? 'selected' : '' }}>Hamster</option>
                                            <option value="Guinea Pig" {{ old('pet_type') == 'Guinea Pig' ? 'selected' : '' }}>Guinea Pig</option>
                                            <option value="Bird" {{ old('pet_type') == 'Bird' ? 'selected' : '' }}>Bird</option>
                                            <option value="Turtle" {{ old('pet_type') == 'Turtle' ? 'selected' : '' }}>Turtle</option>
                                            <option value="Ferret" {{ old('pet_type') == 'Ferret' ? 'selected' : '' }}>Ferret</option>
                                        </optgroup>
                                </select>
                                @error('pet_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <input type="text" name="" id="" class="form-control d-none">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBreed">Breed <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('pet_breed') is-invalid @enderror" id="inputBreed"
                                       type="text" placeholder="Breed" value="{{ old('pet_breed') }}" name="pet_breed"
                                       autocomplete="off"/>
                                @error('pet_breed')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6"><label class="small mb-1" for="inputColor">Color <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('pet_color') is-invalid @enderror" id="inputColor"
                                       type="text" value="{{ old('pet_color') }}" placeholder="Color" name="pet_color"
                                       autocomplete="off"/>
                                @error('pet_color')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6"><label class="small mb-1" for="inputBirthdate">Birthdate <span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-joined @error('pet_birthdate') is-invalid border-danger @enderror">
                                    <input class="form-control @error('pet_birthdate') is-invalid @enderror"
                                           id="inputBirthdate" type="date" value="{{ old('pet_birthdate') }}"
                                           name="pet_birthdate" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                           placeholder="Select a Date"/>
                                    <span class="input-group-text">
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('pet_birthdate')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="selectGender">Gender <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="select-pet-gender form-control flatpickr-input @error('pet_gender') is-invalid @enderror"
                                    id="selectGender" name="pet_gender" data-placeholder="Select Gender">
                                    <option></option>
                                    <option value="Male" {{ old('pet_gender') == 'Male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="Female" {{ old('pet_gender') == 'Female' ? 'selected' : '' }}>
                                        Female
                                    </option>
                                </select>
                                @error('pet_gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <h6 class="mb-2 mt-5 text-primary">Other Information</h6>
                        <hr class="mt-1 mb-3">
                        <div class="row gx-3 gy-4 mb-3">
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputSelectVaccinationRecord">Does pet have vaccination record?</label><select
                                    class="select-pet-vaccination-record form-control @error('vaccinated') is-invalid @enderror"
                                    id="inputSelectVaccinationRecord" name="vaccinated"
                                    data-placeholder="No Vaccination Record/Complete/Incomplete">
                                    <option value=""></option>
                                    <option value="null" {{ old('vaccinated') === 'null' ? 'selected' : '' }}>No
                                        Vaccination Record
                                    </option>
                                    <option value="1" {{ old('vaccinated') == '1' ? 'selected' : '' }}>Complete</option>
                                    <option value="0" {{ old('vaccinated') == '0' ? 'selected' : '' }}>Incomplete
                                    </option>
                                </select>
                                @error('vaccinated')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                        <input class="form-check-input @error('neutered') is-invalid @enderror"
                                               id="petNeuteredRadio1" type="radio" name="neutered"
                                               value="1" {{ old('neutered') == "1" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="petNeuteredRadio1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-solid">
                                        <input class="form-check-input @error('neutered') is-invalid @enderror"
                                               id="petNeuteredRadio2" type="radio" name="neutered"
                                               value="0" {{ old('neutered') == "0" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="petNeuteredRadio2">No</label>
                                    </div>
                                    @error('neutered')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputSelectVaccinationAntiRabiesRecord">Vacccinated With Anti-Rabies?</label>
                                <div class="d-flex flex-col mt-2">
                                    <div class="form-check form-check-solid me-4">
                                        <input
                                            class="form-check-input @error('vaccinated_anti_rabies') is-invalid @enderror"
                                            id="vaccinatedWithAR1" type="radio" name="vaccinated_anti_rabies"
                                            value="1" {{ old('vaccinated_anti_rabies') == "1" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="vaccinatedWithAR1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-solid">
                                        <input
                                            class="form-check-input @error('vaccinated_anti_rabies') is-invalid @enderror"
                                            id="vaccinatedWithAR2" type="radio" name="vaccinated_anti_rabies"
                                            value="0" {{ old('vaccinated_anti_rabies') == "0" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="vaccinatedWithAR2">No</label>
                                    </div>
                                    @error('vaccinated_anti_rabies')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputAntiRabiesDate">If vaccinated, when was it
                                    vaccinated?</label>
                                <div
                                    class="input-group input-group-joined @error('anti_rabies_vaccination_date') has-validation @enderror">
                                    <input
                                        class="form-control @error('anti_rabies_vaccination_date') is-invalid @enderror"
                                        id="inputAntiRabiesDate" type="text"
                                        value="{{ old('anti_rabies_vaccination_date') }}"
                                        name="anti_rabies_vaccination_date" placeholder="Select a Date"/>
                                    <span class="input-group-text">
        <i data-feather="calendar"></i>
    </span>
                                    @error('anti_rabies_vaccination_date')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12"><label class="small mb-1" for="inputLastGroom">When was pet's last
                                    groom?</label>
                                <div
                                    class="input-group input-group-joined @error('last_groom_date') has-validation @enderror">
                                    <input class="form-control @error('last_groom_date') is-invalid @enderror"
                                           id="inputLastGroom" type="text" value="{{ old('last_groom_date') }}"
                                           name="last_groom_date" placeholder="Select a Date"/>
                                    <span class="input-group-text">
                                        <i data-feather="calendar"></i>
                                    </span>
                                    @error('last_groom_date')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6"><label class="small mb-1" for="inputPhotosOnline">Okay to use photos
                                    online?</label>
                                <div class="d-flex flex-col mt-2">
                                    <div class="form-check form-check-solid me-4">
                                        <input
                                            class="form-check-input @error('okay_to_use_photos_online') is-invalid @enderror"
                                            id="inputPhotosOnline1" type="radio" name="okay_to_use_photos_online"
                                            value="1" {{ old('okay_to_use_photos_online') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inputPhotosOnline1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-solid">
                                        <input
                                            class="form-check-input @error('okay_to_use_photos_online') is-invalid @enderror"
                                            id="inputPhotosOnline0" type="radio" name="okay_to_use_photos_online"
                                            value="0" {{ old('okay_to_use_photos_online') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inputPhotosOnline0">No</label>
                                    </div>
                                    @error('okay_to_use_photos_online')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6"><label class="small mb-1" for="inputTreats">Okay to give
                                    treats?</label>
                                <div class="d-flex flex-col mt-2">
                                    <div class="form-check form-check-solid me-4">
                                        <input
                                            class="form-check-input @error('okay_to_give_treats') is-invalid @enderror"
                                            id="inputTreats1" type="radio" name="okay_to_give_treats" value="1"
                                            {{ old('okay_to_give_treats') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inputTreats1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-solid">
                                        <input
                                            class="form-check-input @error('okay_to_give_treats') is-invalid @enderror"
                                            id="inputTreats0" type="radio" name="okay_to_give_treats" value="0"
                                            {{ old('okay_to_give_treats') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inputTreats0">No</label>
                                    </div>
                                    @error('okay_to_give_treats')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPetFood">What type of food does your pet
                                    prefer?</label>
                                <textarea name="pet_food" id="inputPetFood"
                                          class="form-control @error('pet_food') is-invalid @enderror" cols="30"
                                          rows="8"
                                          placeholder="e.g., Chicken-flavored kibble, Grain-free wet food">{{ old('pet_food') }}</textarea>
                                @error('pet_food')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFoodAllergies">Any Allergies?</label>
                                <textarea name="food_allergies" id="inputFoodAllergies"
                                          class="form-control @error('food_allergies') is-invalid @enderror" cols="30"
                                          rows="8"
                                          placeholder="Enter pet's food allergies here..">{{ old('food_allergies') }}</textarea>
                                @error('food_allergies')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputHistoryofAggression">Any history of aggression
                                    against any other dogs?</label>
                                <textarea name="history_of_aggression" id="inputHistoryofAggression"
                                          class="form-control @error('history_of_aggression') is-invalid @enderror"
                                          cols="30" rows="8"
                                          placeholder="Enter pet's history of aggression here..">{{ old('history_of_aggression') }}</textarea>
                                @error('history_of_aggression')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputCondition">Prone to any seizure, illness, etc.? If
                                    so please list:</label>
                                <textarea name="pet_condition" id="inputCondition"
                                          class="form-control @error('pet_condition') is-invalid @enderror" cols="30"
                                          rows="8"
                                          placeholder="Enter any illnesses or conditions here...">{{ old('pet_condition') }}</textarea>
                                @error('pet_condition')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <h6 class="mb-2 mt-5 text-primary">Owner Information</h6>
                        <hr class="mt-1 mb-3">
                        <div class="mb-3"><label class="small mb-1" for="inputOwnerName">Owner Name <span
                                    class="text-danger">*</span></label>
                            <select class="select-pet-owner form-control @error('owner_name') is-invalid @enderror"
                                    id="inputOwnerName" name="owner_name" onchange="handleClientSelect()"
                                    data-placeholder="Select a Pet Owner">
                                <option></option>
                                @foreach ($clients->sortBy('client_name') as $client)
                                    @php
                                        Clients::setEmailAttribute($client, $client->user_id);
                                    @endphp
                                    <option value="{{ $client->id }}"
                                            @if(old('owner_name') == $client->id || (isset($clientID ) && $client->id == $clientID)) selected @endif>{{ $client->client_name }}</option>
                                @endforeach
                            </select>
                            @error('owner_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOwnerAddress">Owner Address</label>
                                <p id="inputOwnerAddress">-----</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="ownerContact">Contact Number</label>
                                <p id="ownerContact">---- --- ----</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOwnerEmail">Email Address</label>
                                <p id="inputOwnerEmail">-----</p>
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" id="regbtn" type="submit">Add Pet</button>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card shadow-none mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image -->
                    <img id="profileImagePreview" class="img-account-profile rounded-circle mb-2"
                         src="{{ old('pet_picture') ? asset('storage/' . old('pet_picture')) : asset('assets/img/illustrations/profiles/pet.png') }}"
                         alt="Profile Picture" style="width: 150px; height: 150px; object-fit: cover;"/>
                    <!-- Profile picture help block -->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button -->
                    <input class="form-control @error('pet_picture') is-invalid @enderror" type="file"
                           name="pet_picture"
                           accept="image/png, image/jpg, image/jpeg" style="cursor: pointer;"
                           onchange="if(this.files[0].size > 5242880) {
                       alert('File size must be less than 5MB');
                       this.value = '';
                       document.getElementById('profileImagePreview').src = '{{ asset('assets/img/illustrations/profiles/pet.png') }}';
                   } else {
                       const reader = new FileReader();
                       reader.onload = function(e) {
                           document.getElementById('profileImagePreview').src = e.target.result;
                       };
                       reader.readAsDataURL(this.files[0]);
                   }"
                           value="{{ old('pet_picture') }}"/>
                    @error('pet_picture')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    </form>
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
