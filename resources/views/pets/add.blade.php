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
            <div class="card mb-4">
                <div class="card-header">Pet Profile</div>
                <div class="card-body">
                    <form action="{{ route('pets.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPetName">Pet Name</label>
                            <input class="form-control" id="inputPetName" type="text" placeholder="Pet Name" value="" name="pet_name"/>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="selectPetType">Pet Type</label>
                                <select class="form-control" id="selectPetType" name="pet_type" >
                                    <option disabled selected>-- Select Pet Type --</option>
                                    <option>Dog</option>
                                    <option>Cat</option>
                                    <option>Bird</option>
                                    <option>Frog</option>
                                    <option>Chicken</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBreed" >Breed</label>
                                <input class="form-control" id="inputBreed" type="text" placeholder="Breed" value="" name="pet_breed"/>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputColor" >Color</label>
                                <input class="form-control" id="inputColor" type="text" value="" placeholder="Color" name="pet_color"/>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputWeight" >Weight</label>
                                <input class="form-control" id="inputWeight" type="text" value="" placeholder="Weight" name="pet_weight"/>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthdate">Birthdate</label>
                                <input class="form-control" id="inputBirthdate" type="date" value="" name="pet_birthdate"/>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="selectGender">Gender</label>
                                <select class="form-control" id="selectGender" name="pet_gender">
                                    <option disabled selected>-- Select Gender --</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>
                        <h6 class="mb-2 mt-5 text-primary">Other Information</h6>
                        <hr class="mt-1 mb-3">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" name="pet_vaccinated">
                                    <label class="small" for="inlineCheckbox1">Vaccinated</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" name="pet_neutered">
                                    <label class="small" for="inlineCheckbox1">Spayed/Neutered</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPetDescription">Pet Description</label>
                            <textarea name="pet_description" id="inputPetDescription" class="form-control form-control-solid" cols="30" rows="5"></textarea>
                        </div>
                        <h6 class="mb-2 mt-5 text-primary">Owner Information</h6>
                        <hr class="mt-1 mb-3">

                        <div class="mb-3">
                            <label class="small mb-1" for="inputOwnerName">Owner Name</label>
                            <select class="form-control" id="inputOwnerName" name="owner_name" onchange="handleClientSelect()">
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOwnerAddress">Owner Address</label>
                                <input class="form-control" id="inputOwnerAddress" type="text" value="" placeholder="Owner Address" />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="ownerContact">Contact Number</label>
                                <input class="form-control" id="ownerContact" type="text" value="" placeholder="Contact Number" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputOwnerEmail">Email Address</label>
                            <input class="form-control" id="inputOwnerEmail" type="text" value="" placeholder="Owner Address" />
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" id="regbtn" type="submit">Add Pet</button>
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
                    <img class="img-account-profile rounded-circle mb-2" src="https://img.freepik.com/premium-vector/white-cat-portrait-hand-drawn-illustrations-vector_376684-65.jpg" alt="" />
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



    var clients = @json($clients);


    function handleClientSelect() {

        var selectedClientId = document.getElementById('inputOwnerName').value;
        var selectedClient = clients.find(client => client.id == selectedClientId);

        if (selectedClient) {
            document.getElementById('inputOwnerAddress').value = selectedClient.client_address;
            document.getElementById('ownerContact').value = selectedClient.client_no;
            document.getElementById('inputOwnerEmail').value = selectedClient.client_email_address;
        }

        console.log(selectedClientId);
    };

    window.addEventListener("load", function() {
        handleClientSelect();
});





</script>


@endsection

@section('scripts')

@endsection
