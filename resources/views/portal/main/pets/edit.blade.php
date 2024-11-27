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
            <form action="{{route('portal.mypets.update', ['petid' => $pet->id])}}" method="POST">
            @csrf
            <div class="card-header">Edit Pet</div>
            <div class="card-body">
                    <div class="row gx-3 gy-2 mb-3">
                        <div class="col-md-12">
                            <label class="small mb-1" for="inputPetName">Pet Name</label>
                            <input class="form-control" id="inputPetName" type="text" placeholder="Pet Name" value="{{$pet->pet_name}}" name="pet_name">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectPetType">Pet Type</label>
                            <select class="form-control" id="selectPetType" name="pet_type">
                                <option disabled {{ is_null($pet->pet_type) ? 'selected' : '' }}>-- Select Pet Type --</option>
                                <option value="Dog" {{ $pet->pet_type === 'Dog' ? 'selected' : '' }}>Dog</option>
                                <option value="Cat" {{ $pet->pet_type === 'Cat' ? 'selected' : '' }}>Cat</option>
                                <option value="Bird" {{ $pet->pet_type === 'Bird' ? 'selected' : '' }}>Bird</option>
                                <option value="Frog" {{ $pet->pet_type === 'Frog' ? 'selected' : '' }}>Frog</option>
                                <option value="Chicken" {{ $pet->pet_type === 'Chicken' ? 'selected' : '' }}>Chicken</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBreed">Breed</label>
                            <input class="form-control" id="inputBreed" type="text" placeholder="Breed" value="{{$pet->pet_breed}}" name="pet_breed">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputColor">Color</label>
                            <input class="form-control" id="inputColor" type="text" value="{{$pet->pet_color}}" placeholder="Color" name="pet_color">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputWeight">Weight</label>
                            <input class="form-control" id="inputWeight" type="number" value="{{$pet->pet_weight}}" placeholder="Weight" name="pet_weight">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBirthdate">Birthdate</label>
                            <input class="form-control" id="inputBirthdate" type="date" value="{{$pet->pet_birthdate}}" name="pet_birthdate">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectGender">Gender</label>
                            <select class="form-control" id="selectGender" name="pet_gender" >
                                <option disabled {{ is_null($pet->pet_gender) ? 'selected' : '' }}>-- Select Gender --</option>
                                <option  value="Male" {{ $pet->pet_gender === 'Male' ? 'selected' : '' }}>Male</option>
                                <option  value="Female" {{ $pet->pet_gender === 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
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
                     src="{{$pet->pet_picture != null ? asset('storage/' . $pet->pet_picture) :'https://img.freepik.com/premium-vector/white-cat-portrait-hand-drawn-illustrations-vector_376684-65.jpg'}}"
                     alt="Buddy's photo">
                <!-- Profile picture help block-->
                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                <!-- Profile picture upload form-->
                <form id="petPhotoForm" action="{{ route('pets.uploadPhoto', $pet->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="petPhotoInput" name="photo" accept="image/jpeg,image/png" style="display: none;" onchange="uploadPetPhoto()">
                    <button class="btn btn-primary" type="button" onclick="document.getElementById('petPhotoInput').click();">Change Pet Image</button>
                </form>
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

</div>
@endsection
