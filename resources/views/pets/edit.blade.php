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
                        <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/illustrations/profiles/profile-1.png') }}" alt="Profile Picture" />
                    </div>
                    <div class="col-md-6 d-flex flex-column align-items-center text-center p-3">
                        <label for="fileInput" class="btn btn-outline-primary mb-2">Select Photo</label>
                        <input type="file" id="fileInput" class="d-none" accept="image/*" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary">Update</button>
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
                    <form action="{{ route('pets.update', $pet->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPetName">Pet Name</label>
                            <input class="form-control" id="inputPetName" type="text" placeholder="Pet Name"
                                value="{{ $pet->pet_name }}" name="pet_name" />
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="selectPetType">Pet Type</label>
                                <select class="form-control" id="selectPetType" name="pet_type">
                                    <option>-- Select Pet Type --</option>
                                    <option value="Dog" @if ($pet->pet_type == 'Dog') selected @endif>Dog
                                    </option>
                                    <option value="Cat" @if ($pet->pet_type == 'Cat') selected @endif>Cat
                                    </option>
                                    <option value="Bird" @if ($pet->pet_type == 'Bird') selected @endif>Bird
                                    </option>
                                    <option value="Frog" @if ($pet->pet_type == 'Frog') selected @endif>Frog
                                    </option>
                                    <option value="Chicken" @if ($pet->pet_type == 'Chicken') selected @endif>Chicken
                                    </option>
                                </select>

                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBreed">Breed</label>
                                <input class="form-control" id="inputBreed" type="text" placeholder="Breed"
                                    value="{{ $pet->pet_breed }}" name="pet_breed" />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputColor">Color</label>
                                <input class="form-control" id="inputColor" type="text" value="{{ $pet->pet_color }}"
                                    placeholder="Color" name="pet_color" />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputWeight">Weight</label>
                                <input class="form-control" id="inputWeight" type="text"
                                    value="{{ $pet->pet_weight }}" placeholder="Weight" name="pet_weight" />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthdate">Birthdate</label>
                                <input class="form-control" id="inputBirthdate" type="date"
                                    value="{{ $pet->pet_birthdate }}" name="pet_birthdate" />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="selectGender">Gender</label>
                                <select class="form-control" id="selectGender" name="pet_gender">
                                    <option disabled selected>-- Select Gender --</option>
                                    <option value="Male" @if ($pet->pet_gender == 'Male') selected @endif>Male
                                    </option>
                                    <option value="Female" @if ($pet->pet_gender == 'Female') selected @endif>Female
                                    </option>
                                </select>

                            </div>
                        </div>
                        <h6 class="mb-2 mt-5 text-primary">Other Information</h6>
                        <hr class="mt-1 mb-3">
                        <div class="row gx-3 gy-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputSelectVaccinationRecord">Vaccination Record</label>
                                <select class="form-control" id="inputSelectVaccinationRecord">
                                    <option disabled selected>-- Select Record --</option>
                                    <option>No Vaccination Record</option>
                                    <option>Complete</option>
                                    <option>Incomplete</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputSelectSpayedNeutered">Spayed/Neutered</label>
                                <select class="form-control" id="inputSelectSpayedNeutered">
                                    <option disabled selected>-- Select [Yes/No] --</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputSelectVaccinationAntiRabiesRecord">Vacccinated With Anti-Rabies?</label>
                                <select class="form-control" id="inputSelectVaccinationAntiRabiesRecord">
                                    <option disabled selected>-- Select [Yes/No] --</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputAntiRabiesDate">If so, when was it vaccinated?</label>
                                <input type="month" id="inputAntiRabiesDate" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputHistoryofAggression">Any history of agression against any other dogs?</label>
                                <textarea name="historyOfAggression" id="inputHistoryofAggression" class="form-control" cols="30" rows="3" placeholder="Enter pet's history of agression here.."></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFoodAllergies">Any Food Allergies?</label>
                                <textarea name="foodAllergies" id="inputFoodAllergies" class="form-control" cols="30" rows="3" placeholder="Enter pet's food allergies here.."></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPetFood">Food?</label>
                                <input type="text" name="petFood" id="inputPetFood" class="form-control" placeholder="Enter pet's food here..">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputTreats">Okay to give treats?</label>
                                <select class="form-control" id="inputTreats">
                                    <option disabled selected>-- Select [Yes/No] --</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastGroom">When was his/her last groom?</label>
                                <input type="month" id="inputLastGroom" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhotosOnline">Okay to use photos online?</label>
                                <select class="form-control" id="inputPhotosOnline">
                                    <option disabled selected>-- Select [Yes/No] --</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputCondition">Prone to any seizure, illness, ect.? If so please list:</label>
                                <textarea name="petCondition" id="inputCondition" class="form-control" cols="30" rows="4" placeholder="Enter any illnesses or conditions here..."></textarea>
                            </div>
                        </div>
                        <!--                         
                        <div class="row gx-3 mb-3">
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="vaccinated" value="0">
                                    <input class="form-check-input" type="checkbox" id="vaccinatedCheckbox" value="1" @checked($pet->vaccinated) name="vaccinated">
                                    <label class="small" for="vaccinatedCheckbox">Vaccinated</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="neutered" value="0">
                                    <input class="form-check-input" type="checkbox" id="neuteredCheckbox" value="1" @checked($pet->neutered) name="neutered">
                                    <label class="small" for="neuteredCheckbox">Spayed/Neutered</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPetDescription">Pet Description</label>
                            <textarea name="pet_description" id="inputPetDescription" class="form-control form-control-solid" cols="30"
                                rows="5">{{ $pet->pet_description }}</textarea>
                        </div> -->
                        <h6 class="mb-2 mt-5 text-primary">Owner Information</h6>
                        <hr class="mt-1 mb-3">

                        <div class="mb-3">
                            <label class="small mb-1" for="inputOwnerName">Owner Name</label>
                            <input class="form-control" id="inputOwnerName" type="text" placeholder="Owner Name"
                                value="{{$pet->client->client_name}}" disabled />
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOwnerAddress">Owner Address</label>
                                <input class="form-control" id="inputOwnerAddress" type="text" value="{{$pet->client->client_address}}"
                                    placeholder="Owner Address" disabled />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="ownerContact">Contact Number</label>
                                <input class="form-control" id="ownerContact" type="text" value="{{$pet->client->client_no}}"
                                    placeholder="Contact Number" disabled />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputOwnerEmail">Email Address</label>
                            <input class="form-control" id="inputOwnerEmail" type="text" value="{{$pet->client->client_email_address}}"
                                placeholder="Owner Address" disabled />
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
                        src="https://img.freepik.com/premium-vector/white-cat-portrait-hand-drawn-illustrations-vector_376684-65.jpg"
                        alt="" />
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

</script>
@endsection

@section('scripts')
@endsection