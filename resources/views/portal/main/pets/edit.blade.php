@extends('portal.layouts.app')
@section('outerContent')
<header class="page-header page-header-compact page-header-light border-bottom bg-white">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{route('portal.mypets')}}">My Pets</a></li>
                    <li class="breadcrumb-item"><a href="{{route('portal.mypets.view',['petid' =>$pet->id])}}">Pet Profile</a></li>
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
            <form action="{{route('portal.mypets.update', ['petid' => $pet->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">Edit Pet</div>
                <div class="card-body">
                    <div class="row gx-3 gy-2 mb-3">
                        <div class="col-md-12">
                            <label class="small mb-1" for="inputPetName">Pet Name <span class="text-danger">*</span></label>
                            <input class="form-control" id="inputPetName" type="text" placeholder="Pet Name" value="{{$pet->pet_name}}" name="pet_name">
                            @error('pet_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectPetType">Pet Type <span class="text-danger">*</span></label>
                              <select class="select-pet-type form-control @error('pet_type') is-invalid @enderror"
                                        id="selectPetType" name="pet_type" data-placeholder="Select Pet Type">
                                        <option value="" {{ old('pet_type', $pet->pet_type) === null ? 'selected' : '' }}>-- Select Pet Type --</option>
                                        <optgroup label="Common Pets">
                                            <option value="Dog" {{ old('pet_type', $pet->pet_type) == 'Dog' ? 'selected' : '' }}>Dog</option>
                                            <option value="Cat" {{ old('pet_type', $pet->pet_type) == 'Cat' ? 'selected' : '' }}>Cat</option>
                                        </optgroup>
                                        <optgroup label="Other Pets">
                                            <option value="Chicken" {{ old('pet_type', $pet->pet_type) == 'Chicken' ? 'selected' : '' }}>Chicken</option>
                                            <option value="Snake" {{ old('pet_type', $pet->pet_type) == 'Snake' ? 'selected' : '' }}>Snake</option>
                                            <option value="Horse" {{ old('pet_type', $pet->pet_type) == 'Horse' ? 'selected' : '' }}>Horse</option>
                                            <option value="Rabbit" {{ old('pet_type', $pet->pet_type) == 'Rabbit' ? 'selected' : '' }}>Rabbit</option>
                                            <option value="Hamster" {{ old('pet_type', $pet->pet_type) == 'Hamster' ? 'selected' : '' }}>Hamster</option>
                                            <option value="Guinea Pig" {{ old('pet_type', $pet->pet_type) == 'Guinea Pig' ? 'selected' : '' }}>Guinea Pig</option>
                                            <option value="Bird" {{ old('pet_type', $pet->pet_type) == 'Bird' ? 'selected' : '' }}>Bird</option>
                                            <option value="Turtle" {{ old('pet_type', $pet->pet_type) == 'Turtle' ? 'selected' : '' }}>Turtle</option>
                                            <option value="Ferret" {{ old('pet_type', $pet->pet_type) == 'Ferret' ? 'selected' : '' }}>Ferret</option>
                                    </optgroup>
                                    @error('pet_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBreed">Breed <span class="text-danger">*</span></label>
                            <input class="form-control" id="inputBreed" type="text" placeholder="Breed" value="{{$pet->pet_breed}}" name="pet_breed">
                            @error('pet_breed')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputColor">Color <span class="text-danger">*</span></label>
                            <input class="form-control" id="inputColor" type="text" value="{{$pet->pet_color}}" placeholder="Color" name="pet_color">
                            @error('pet_color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBirthdate">Birthdate <span class="text-danger">*</span></label>
                            <div class="input-group input-group-joined">
                                <input class="form-control" id="select-birth" type="date" value="{{$pet->pet_birthdate}}" name="pet_birthdate" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                                <span class="input-group-text">
                                    <i data-feather="calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectGender">Gender <span class="text-danger">*</span></label>
                            <select
                                class="select-pet-gender form-control flatpickr-input @error('pet_gender') is-invalid @enderror"
                                id="selectGender" name="pet_gender" data-placeholder="Select Gender">
                                <option value="" {{ old('pet_gender', $pet->pet_gender) === null ? 'selected' : '' }}></option>
                                <option value="Male" {{ old('pet_gender', $pet->pet_gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('pet_gender', $pet->pet_gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('pet_gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" id="editbtn" type="submit">Save Changes</button>
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
                <img id="petPhotoPreview" class="img-account-profile rounded-circle mb-2"
                    src="{{$pet->pet_picture != null ? asset('storage/' . $pet->pet_picture) : asset('assets/img/illustrations/profiles/pet.png')}}"
                    alt="Buddy's photo">
                <!-- Profile picture help block-->
                <!-- <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div> -->
                <!-- Profile picture upload form-->
            </div>
            <div class="card-footer text-center">
                <form id="petPhotoForm" action="{{ route('pets.uploadPhoto', $pet->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="petPhotoInput" name="photo" accept="image/jpeg,image/png" style="display: none;" onchange="uploadPetPhoto()">
                    <button class="btn btn-primary" type="button" onclick="document.getElementById('petPhotoInput').click();">Change Pet Image</button>
                </form>
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
                            } else {
                                console.log(data);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            </script>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
            $(".select-pet-type").select2({
                theme: "bootstrap-5",
                tags: true, // Allow users to add new values
                width: $(this).data("width")
                    ? $(this).data("width")
                    : $(this).hasClass("w-100")
                    ? "100%"
                    : "style",
                placeholder: $(this).data("placeholder"),
            });

            $(".select-pet-gender").select2({
                theme: "bootstrap-5",
                tags: true, // Allow users to add new values
                width: $(this).data("width")
                    ? $(this).data("width")
                    : $(this).hasClass("w-100")
                    ? "100%"
                    : "style",
                placeholder: $(this).data("placeholder"),
            });
            flatpickr("#select-birth", {
                dateFormat: "Y-m-d", // Format for the selected date (equivalent to Litepicker's 'YYYY-MM-DD')
                minDate: "today", // Disallow past dates
                maxDate: new Date().fp_incr(60), // Limit to 2 months ahead (60 days)
            });
        });

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
