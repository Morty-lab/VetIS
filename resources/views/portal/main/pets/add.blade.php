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
                            <label class="small mb-1" for="inputPetName">Pet Name <span
                                        class="text-danger">*</span></label>
                            <input class="form-control @error('pet_name') is-invalid @enderror" id="inputPetName" type="text" placeholder="Pet Name" value="{{ old('pet_name', '') }}" name="pet_name">
                            @error('pet_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6"><label class="small mb-1" for="selectPetType">Pet Type <span
                                        class="text-danger">*</span></label>
                                <select class="select-pet-type form-control @error('pet_type') is-invalid @enderror"
                                        id="selectPetType" name="pet_type" data-placeholder="Select Pet Type">
                                        <option value="" {{ old('pet_type') === null ? 'selected' : '' }}>-- Select Pet Type --</option>
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
                            <input class="form-control @error('pet_breed') is-invalid @enderror" id="inputBreed" type="text" placeholder="Breed" value="{{ old('pet_breed', '') }}" name="pet_breed">
                            @error('pet_breed')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputColor">Color <span
                                        class="text-danger">*</span></label>
                            <input class="form-control @error('pet_color') is-invalid @enderror" id="inputColor" type="text" value="{{ old('pet_color', '') }}" placeholder="Color" name="pet_color">
                            @error('pet_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBirthdate">Birthdate <span
                                        class="text-danger">*</span></label>
                            <div class="input-group input-group-joined @error('pet_birthdate') is-invalid border-danger @enderror">
                                <input class="form-control @error('pet_birthdate') is-invalid @enderror" placeholder="Select birthdate" id="select-birth" type="date" value="{{ old('pet_birthdate', '') }}" name="pet_birthdate" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                                <div class="input-group-text">
                                    <i data-feather="calendar"></i>
                                </div>
                            </div>
                            @error('pet_birthdate')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="selectGender">Gender <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="select-pet-gender form-control flatpickr-input @error('pet_gender') is-invalid @enderror"
                                    id="selectGender" name="pet_gender" data-placeholder="Select Gender">
                                    <option value="" {{ old('pet_gender') === null ? 'selected' : '' }}>-- Select Gender --</option>
                                    <option value="Male" {{ old('pet_gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('pet_gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('pet_gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="petPhotoInput">Upload Pet Photo</label>
                            <input class="form-control @error('photo') is-invalid @enderror" type="file" id="petPhotoInput" name="photo" accept="image/jpeg,image/png">
                            @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                minDate: null, // Allow past dates
                maxDate: "today", // Limit to current date
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

