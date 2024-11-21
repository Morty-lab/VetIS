@extends('portal.layouts.app')
@section('content')
<div class="row gx-4">
    <div class="col-xl-8">
        <div class="card shadow-none border mb-4">
            <form action="{{route('portal.mypets.add')}}" method="POST">
            <div class="card-header">Register Pet</div>
            <div class="card-body">

                    @csrf
                    <div class="row gx-3 gy-2 mb-3">
                        <div class="col-md-12">
                            <label class="small mb-1" for="inputPetName">Pet Name</label>
                            <input class="form-control" id="inputPetName" type="text" placeholder="Pet Name" value="" name="pet_name">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectPetType">Pet Type</label>
                            <select class="form-control" id="selectPetType" name="pet_type">
                                <option disabled="" selected="">-- Select Pet Type --</option>
                                <option>Dog</option>
                                <option>Cat</option>
                                <option>Bird</option>
                                <option>Frog</option>
                                <option>Chicken</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBreed">Breed</label>
                            <input class="form-control" id="inputBreed" type="text" placeholder="Breed" value="" name="pet_breed">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputColor">Color</label>
                            <input class="form-control" id="inputColor" type="text" value="" placeholder="Color" name="pet_color">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputWeight">Weight</label>
                            <input class="form-control" id="inputWeight" type="text" value="" placeholder="Weight" name="pet_weight">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBirthdate">Birthdate</label>
                            <input class="form-control" id="inputBirthdate" type="date" value="" name="pet_birthdate">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectGender">Gender</label>
                            <select class="form-control" id="selectGender" name="pet_gender">
                                <option disabled="" selected="">-- Select Gender --</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>

            </div>
            <div class="card-footer ">
                <button class="btn btn-primary" type="submit">Register Pet</button>
            </div>
            </form>
        </div>
    </div>
    <div class="col-xl-4">
        <!-- Profile picture card-->
        <div class="card shadow-none border mb-4 mb-xl-0">
            <div class="card-header">Pet Photo</div>
            <div class="card-body text-center">
                <!-- Profile picture image-->
                <img class="img-account-profile rounded-circle mb-2" src="https://img.freepik.com/premium-vector/white-cat-portrait-hand-drawn-illustrations-vector_376684-65.jpg" alt="">
                <!-- Profile picture help block-->
                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                <!-- Profile picture upload button-->
                <button class="btn btn-primary" type="button">Upload Pet Image</button>
            </div>
        </div>
    </div>
</div>
@endsection
