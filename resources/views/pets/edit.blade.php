@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<!-- Update Pet Profile Modal -->
<div class="modal fade" id="petPictureModal" tabindex="-1" role="dialog" aria-labelledby="profilePictureModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Update Pet Picture</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row justify-content-center align-items-center" style="height: 100%;">
                    <div class="col-md-6 d-flex flex-column align-items-center text-center border-end p-3 pe-3">
                        <img class="img-account-profile rounded-circle mb-2" src="{{$pet->pet_picture != null ? asset('storage/' . $pet->pet_picture) : asset('assets/img/illustrations/profiles/pet.png')}}" alt="Profile Picture" />
                    </div>
                    <div class="col-md-6 d-flex flex-column align-items-center text-center p-3">

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



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
        <a class="nav-link ms-0" href="{{ route('pets.show', $pet->id) }}"><span class="px-2"><i class="fa-solid fa-arrow-left"></i></span> Back</a>
    </nav>
    <hr class="mt-0 mb-4" />
    <div class="row">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card shadow-none mb-4">
                <div class="card-header">Pet Profile</div>
                <div class="card-body">
                    <form action="{{ route('pets.update', ['petID' => $pet->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPetName">Pet Name <span
                                    class="text-danger">*</span></label>
                            <input class="form-control @error('pet_name') is-invalid @enderror" id="inputPetName"
                                   type="text" placeholder="Enter Pet Name"
                                   value="{{ old('pet_name', $pet->pet_name) }}" name="pet_name" autocomplete="off"/>
                            @error('pet_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6"><label class="small mb-1" for="selectPetType">Pet Type <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="edit-select-pet-type form-control @error('pet_type') is-invalid @enderror"
                                    id="selectPetType" name="pet_type" data-placeholder="Select Pet Type">
                                    <option value="Dog" @if (old('pet_type', $pet->pet_type) == 'Dog') selected @endif>
                                        Dog
                                    </option>
                                    <option value="Cat" @if (old('pet_type', $pet->pet_type) == 'Cat') selected @endif>
                                        Cat
                                    </option>
                                </select>
                                @error('pet_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="col-md-6"><label class="small mb-1" for="inputBreed">Breed <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('pet_breed') is-invalid @enderror" id="inputBreed"
                                       type="text" placeholder="Breed"
                                       value="{{ old('pet_breed', $pet->pet_breed) }}" name="pet_breed"
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
                                       type="text"
                                       value="{{ old('pet_color', $pet->pet_color) }}" placeholder="Color"
                                       name="pet_color" autocomplete="off"/>
                                @error('pet_color')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6"><label class="small mb-1" for="inputBirthdate">Birthdate <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('pet_birthdate') is-invalid @enderror"
                                       id="inputBirthdate" type="date"
                                       value="{{ old('pet_birthdate', $pet->pet_birthdate) }}" name="pet_birthdate"
                                       max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"/>
                                @error('pet_birthdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="selectGender">Gender <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="edit-select-pet-gender form-control @error('pet_gender') is-invalid @enderror"
                                    id="selectGender" name="pet_gender" data-placeholder="Select Gender">
                                    <option
                                        value="" {{ old('pet_gender', $pet->pet_gender) == '' ? 'selected' : '' }}></option>
                                    <option
                                        value="Male" {{ old('pet_gender', $pet->pet_gender) == 'Male' ? 'selected' : '' }}>
                                        Male
                                    </option>
                                    <option
                                        value="Female" {{ old('pet_gender', $pet->pet_gender) == 'Female' ? 'selected' : '' }}>
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
                        <div class="row gx-3 gy-3 mb-3">
                            <div class="col-md-12"><label class="small mb-1" for="inputSelectVaccinationRecord">Does pet
                                    have vaccination record?</label>
                                <select
                                    class="edit-select-pet-vaccination-record form-control @error('vaccinated') is-invalid @enderror"
                                    id="inputSelectVaccinationRecord" name="vaccinated"
                                    data-placeholder="No Vaccination Record/Complete/Incomplete">
                                    <option value=""></option>
                                    <option
                                        value="null" {{ old('vaccinated', $pet->vaccinated) === null ? 'selected' : '' }}>
                                        No Vaccination Record
                                    </option>
                                    <option value="1" {{ old('vaccinated', $pet->vaccinated) == 1 ? 'selected' : '' }}>
                                        Complete
                                    </option>
                                    <option value="0" {{ old('vaccinated', $pet->vaccinated) === 0 ? 'selected' : '' }}>
                                        Incomplete
                                    </option>
                                </select>
                                @error('vaccinated')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputSelectSpayedNeutered">Spayed/Neutered</label>
                                <div class="d-flex flex-col mt-2">
                                    <div class="form-check form-check-solid me-4">
                                        <input class="form-check-input @error('neutered') is-invalid @enderror"
                                               id="petNeuteredRadio1" type="radio" name="neutered"
                                               value="1" {{ old('neutered', $pet->neutered) === 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="petNeuteredRadio1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-solid">
                                        <input class="form-check-input @error('neutered') is-invalid @enderror"
                                               id="petNeuteredRadio2" type="radio" name="neutered"
                                               value="0" {{ old('neutered', $pet->neutered) === 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="petNeuteredRadio2">No</label>
                                    </div>
                                    @error('neutered')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
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
                                        <input
                                            class="form-check-input @error('vaccinated_anti_rabies') is-invalid @enderror"
                                            id="vaccinatedWithAR1" type="radio" name="vaccinated_anti_rabies"
                                            value="1" {{ old('vaccinated_anti_rabies', $pet->vaccinated_anti_rabies) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="vaccinatedWithAR1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-solid">
                                        <input
                                            class="form-check-input @error('vaccinated_anti_rabies') is-invalid @enderror"
                                            id="vaccinatedWithAR2" type="radio" name="vaccinated_anti_rabies"
                                            value="0" {{ old('vaccinated_anti_rabies', $pet->vaccinated_anti_rabies) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="vaccinatedWithAR2">No</label>
                                    </div>
                                    @error('vaccinated_anti_rabies')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
{{--                            <div class="col-md-6">--}}
{{--                                <label class="small mb-1" for="inputSelectVaccinationAntiRabiesRecord">Vacccinated With Anti-Rabies?</label>--}}
{{--                                <select class="form-control" id="inputSelectVaccinationAntiRabiesRecord" name="vaccinated_anti_rabies">--}}
{{--                                    <option value='1>Yes</option>--}}
{{--                                    <option value='0'>No</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputAntiRabiesDate">If vaccinated, when was it
                                    vaccinated?</label>
                                <div class="input-group input-group-joined">
                                    <input type="month" id="inputAntiRabiesDate" name="anti_rabies_vaccination_date"
                                           class="form-control @error('anti_rabies_vaccination_date') is-invalid @enderror"
                                           value="{{ old('anti_rabies_vaccination_date', $pet->anti_rabies_vaccination_date ? \Carbon\Carbon::parse($pet->anti_rabies_vaccination_date)->format('Y-m') : '') }}"
                                           placeholder="Select a Date">
                                    <span class="input-group-text"><i data-feather="calendar"></i></span>
                                    @error('anti_rabies_vaccination_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="small mb-1" for="inputLastGroom">When was pet's last groom?</label>
                                <div class="input-group input-group-joined">
                                    <input type="month" name="last_groom_date" id="inputLastGroom"
                                           class="form-control @error('last_groom_date') is-invalid @enderror"
                                           value="{{ old('last_groom_date', $pet->last_groom_date ? \Carbon\Carbon::parse($pet->last_groom_date)->format('Y-m') : '') }}"
                                           placeholder="Select a Date">
                                    <span class="input-group-text">
        <i data-feather="calendar"></i>
    </span>
                                    @error('last_groom_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputTreats">Okay to give treats?</label>
                                <div class="d-flex flex-col mt-2">
                                    <div class="form-check form-check-solid me-4">
                                        <input
                                            class="form-check-input @error('okay_to_give_treats') is-invalid @enderror"
                                            id="inputTreats1" type="radio" name="okay_to_give_treats"
                                            value="1" {{ old('okay_to_give_treats', $pet->okay_to_give_treats) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inputTreats1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-solid">
                                        <input
                                            class="form-check-input @error('okay_to_give_treats') is-invalid @enderror"
                                            id="inputTreats0" type="radio" name="okay_to_give_treats"
                                            value="0" {{ old('okay_to_give_treats', $pet->okay_to_give_treats) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inputTreats0">No</label>
                                    </div>
                                    @error('okay_to_give_treats')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                        <input
                                            class="form-check-input @error('okay_to_use_photos_online') is-invalid @enderror"
                                            id="inputPhotosOnline1" type="radio" name="okay_to_use_photos_online"
                                            value="1" {{ old('okay_to_use_photos_online', $pet->okay_to_use_photos_online) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inputPhotosOnline1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-solid">
                                        <input
                                            class="form-check-input @error('okay_to_use_photos_online') is-invalid @enderror"
                                            id="inputPhotosOnline0" type="radio" name="okay_to_use_photos_online"
                                            value="0" {{ old('okay_to_use_photos_online', $pet->okay_to_use_photos_online) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inputPhotosOnline0">No</label>
                                    </div>
                                    @error('okay_to_use_photos_online')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPetFood">What type of food does your pet prefer?</label>
                                <textarea
                                    name="pet_food"
                                    id="inputPetFood"
                                    class="form-control @error('pet_food') is-invalid @enderror"
                                    cols="30"
                                    rows="8"
                                    placeholder="e.g., Chicken-flavored kibble, Grain-free wet food"
                                >{{ old('pet_food', $pet->pet_food) }}</textarea>

                                @error('pet_food')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFoodAllergies">Any Allergies?</label>
                                <textarea name="food_allergies" id="inputFoodAllergies"
                                          class="form-control @error('food_allergies') is-invalid @enderror" cols="30"
                                          rows="8"
                                          placeholder="Enter pet's food allergies here..">{{ old('food_allergies', $pet->food_allergies) }}</textarea>
                                @error('food_allergies')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputHistoryofAggression">Any history of agression against any other dogs?</label>
                                <textarea name="history_of_aggression" id="inputHistoryofAggression"
                                          class="form-control @error('history_of_aggression') is-invalid @enderror"
                                          cols="30" rows="8"
                                          placeholder="Enter pet's history of aggression here..">{{ old('history_of_aggression', $pet->history_of_aggression) }}</textarea>
                                @error('history_of_aggression')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputCondition">Prone to any seizure, illness, ect.? If so please list:</label>
                                <textarea name="pet_condition" id="inputCondition"
                                          class="form-control @error('pet_condition') is-invalid @enderror" cols="30"
                                          rows="8"
                                          placeholder="Enter any illnesses or conditions here...">{{ old('pet_condition', $pet->pet_condition) }}</textarea>
                                @error('pet_condition')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <h6 class="mb-2 mt-5 text-primary">Owner Information</h6>
                        <hr class="mt-1 mb-3">

                        @php
                        $client = \App\Models\Clients::where('id',$pet->owner_ID)->first();
                        $client->setEmailAttribute($client,$client->user_id)
                        @endphp

                        <div class="mb-3">
                            <label class="small mb-1" for="inputOwnerName">Owner Name</label><input
                                class="form-control @error('client_name') is-invalid @enderror" id="inputOwnerName"
                                type="text" placeholder="Owner Name"
                                value="{{ old('client_name', $client->client_name) }}" disabled/>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOwnerAddress">Owner Address</label>
                                <p id="inputOwnerAddress">{{$client->client_address}}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="ownerContact">Contact Number</label>
                                <p id="ownerContact">{{$client->client_no}}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOwnerEmail">Email Address</label>
                                <p id="inputOwnerEmail">{{$client->client_email}}</p>
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" id="regbtn" type="submit">Save
                            Changes</button>
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
                    <img class="img-account-profile rounded-circle mb-2"
                         id="petPhotoPreview"
                        src="{{$pet->pet_picture != null ? asset('storage/' . $pet->pet_picture) : asset('assets/img/illustrations/profiles/pet.png')}}"
                        alt="" style="width: 150px; height: 150px; object-fit: cover;"/>
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <form id="petPhotoForm" action="{{ route('pets.uploadPhoto', $pet->id) }}" method="POST" >
                        @csrf

                        <input type="file" id="petPhotoInput" name="photo" accept="image/jpeg,image/png" style="display: none;" onchange="uploadPetPhoto()">
                        <button class="btn btn-primary" type="button" onclick="document.getElementById('petPhotoInput').click();">Upload Pet Image</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function uploadPetPhoto() {
        const form = document.getElementById('petPhotoForm');
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('petPhotoPreview').src = data.photo_url;
                    alert('Pet photo updated successfully!');
                } else {
                    alert('Failed to upload pet photo. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while uploading the pet photo.');
            });
    }
</script>
@endsection

@section('scripts')
@endsection
