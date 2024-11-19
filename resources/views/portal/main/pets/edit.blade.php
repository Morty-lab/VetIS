@extends('portal.layouts.app')
@section('outerContent')
<header class="page-header page-header-compact page-header-light border-bottom bg-white">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{route('portal.mypets')}}">My Pets</a></li>
                    <li class="breadcrumb-item"><a href="{{route('portal.mypets.view')}}">Pet Profile</a></li>
                    <li class="breadcrumb-item active">Edit Pet</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
@endsection
@section('content')
<div class="row gx-4">
    <div class="col-xl-8">
        <div class="card shadow-none border mb-4">
            <div class="card-header">Edit Pet</div>
            <div class="card-body">
                <form action="" method="">
                    <div class="row gx-3 gy-2 mb-3">
                        <div class="col-md-12">
                            <label class="small mb-1" for="inputPetName">Pet Name</label>
                            <input class="form-control" id="inputPetName" type="text" placeholder="Pet Name" value="Buddy" name="pet_name">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectPetType">Pet Type</label>
                            <select class="form-control" id="selectPetType" name="pet_type">
                                <option disabled="">-- Select Pet Type --</option>
                                <option selected>Dog</option>
                                <option>Cat</option>
                                <option>Bird</option>
                                <option>Frog</option>
                                <option>Chicken</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBreed">Breed</label>
                            <input class="form-control" id="inputBreed" type="text" placeholder="Breed" value="Golden Retriever" name="pet_breed">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputColor">Color</label>
                            <input class="form-control" id="inputColor" type="text" value="Golden" placeholder="Color" name="pet_color">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputWeight">Weight</label>
                            <input class="form-control" id="inputWeight" type="text" value="25 kg" placeholder="Weight" name="pet_weight">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBirthdate">Birthdate</label>
                            <input class="form-control" id="inputBirthdate" type="date" value="2022-01-15" name="pet_birthdate">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectGender">Gender</label>
                            <select class="form-control" id="selectGender" name="pet_gender">
                                <option disabled="">-- Select Gender --</option>
                                <option selected>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="editbtn" type="submit">Save Changes</button>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <!-- Profile picture card-->
        <div class="card shadow-none border mb-4 mb-xl-0">
            <div class="card-header">Pet Photo</div>
            <div class="card-body text-center">
                <!-- Profile picture image-->
                <img class="img-account-profile rounded-circle mb-2"
                    src="https://img.freepik.com/premium-vector/white-cat-portrait-hand-drawn-illustrations-vector_376684-65.jpg"
                    alt="Buddy's photo">
                <!-- Profile picture help block-->
                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                <!-- Profile picture upload button-->
                <button class="btn btn-primary" type="button">Change Pet Image</button>
            </div>
        </div>
    </div>
</div>
@endsection