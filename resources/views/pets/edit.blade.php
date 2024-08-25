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
            <div class="card mb-4">
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
                        </div>
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
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Pet Photo</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2"
                        src="https://img.freepik.com/premium-vector/white-cat-portrait-hand-drawn-illustrations-vector_376684-65.jpg"
                        alt="" />
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" type="button">Upload Pet Image</button>
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