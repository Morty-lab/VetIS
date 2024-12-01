@extends('portal.layouts.app')
@section('content')
<div class="row gx-4">
    <div class="col-xl-8">
        <div class="card shadow-none border mb-4">
            <form action="{{ route('portal.mypets.add') }}" method="POST" enctype="multipart/form-data" id="petPhotoForm">
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
                                <option disabled selected>-- Select Pet Type --</option>
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
                            <input class="form-control" id="inputBirthdate" type="date" value="" name="pet_birthdate" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectGender">Gender</label>
                            <select class="form-control" id="selectGender" name="pet_gender">
                                <option disabled selected>-- Select Gender --</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="petPhotoInput">Upload Pet Photo</label>
                            <input class="form-control" type="file" id="petPhotoInput" name="photo" accept="image/jpeg,image/png">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Register Pet</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card shadow-none border mb-4 mb-xl-0">
            <div class="card-header">Pet Photo</div>
            <div class="card-body text-center">
                <img id="petPhotoPreview" class="img-account-profile rounded-circle mb-2"
                    src="{{asset('assets/img/illustrations/profiles/pet.png')}}"
                    alt="Preview">
                <!-- <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div> -->
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>

<script>
    document.getElementById('petPhotoInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('petPhotoPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection