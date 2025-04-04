@php use App\Models\Clients; @endphp
@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <!-- Delete Pet Modal -->
    <div class="modal fade" id="deletePetModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Pet</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Pet?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a href="" class="btn btn-danger" type="button">Delete Pet</a></div>
            </div>
        </div>
    </div>

    <!-- Verify Pet Modal -->
    <div class="modal fade" id="verifyPetModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Verify Pet</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to verify this Pet?</p>
                    <form id="verifyPetForm" action="{{ route('pets.verify',['pet_id'=>$pet->id]) }}" method="POST">
                        @csrf
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" form="verifyPetForm" type="submit">Verify Pet</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Vaccination Modal -->
    <div class="modal fade" id="addVaccination" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{route('vaccination.add', ['pet_id' => $pet->id])}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Vaccination</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="vaccineType">Vaccine Type</label>
                                <select class="form-select" name="pet_vaccination" id="pet_vaccination">
                                    <option value="">Select Vaccination Type</option>
                                    <option value="distemper_virus">Distemper Virus</option>
                                    <option value="parvovirus">Parvovirus</option>
                                    <option value="adenovirus">Adenovirus – Hepatitis</option>
                                    <option value="rabies">Rabies</option>
                                    <option value="leptospirosis">Leptospirosis</option>
                                    <option value="bordetella">Bordetella (Kennel Cough)</option>
                                    <option value="coronavirus">Coronavirus</option>
                                    <option value="lyme_disease">Lyme Disease</option>
                                    <option value="panleukopenia">Panleukopenia</option>
                                    <option value="calicivirus">Calicivirus</option>
                                    <option value="herpesvirus">Herpesvirus</option>
                                    <option value="leukemia">Leukemia Virus</option>
                                    <option value="immunodeficiency">Immunodeficiency Virus</option>
                                    <option value="infectious_peritonitis">Infectious Peritonitis</option>
                                    <option value="chlamydia">Chlamydia</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nextDueDate">Return Date</label>
                                <input type="date" name="nextDueDate" id="nextDueDate" class="form-control">
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="noNextDueDate">
                                    <label for="noNextDueDate" class="form-check-label">No Return Date</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="selectVeterinarian">Administered By</label>
                                <select class="form-control" id="selectVeterinarian" name="doctor_id">
                                    @foreach($vets as $vet)
                                        <option value={{$vet->id}}>Dr. {{$vet->firstname. ' ' . $vet->lastname}}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="selectStatus">Status</label>
                                <select class="form-select" id="selectStatus" name="status">
                                    <option value=1>Completed</option>
                                    <option value=0>Scheduled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" id="addVaccinationBtn">Add</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{--  Create Medical Record Modal  --}}
    <div class="modal fade " id="addMedicalRecord" tabindex="-1" role="dialog" aria-labelledby="addMedicalRecord"
         aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Create Medical Record for <span class="text-primary">{{$pet->pet_name}}</span></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gy-2">
                            <div class="col-md-12">
                                <label for="" class="mb-1">Subject</label>
                                <input type="text" name="" id="" placeholder="Specify the purpose of this record" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="" class="mb-1">Attending Veterinarian</label>
                                <select name="" id="" class="form-select attending-vet-med-rec">
                                    @foreach($vets as $vet)
                                        <option value={{$vet->id}}>Dr. {{$vet->firstname. ' ' . $vet->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="" class="mb-1">Date of Visit</label>
                                <div class="input-group input-group-joined">
                                    <input class="form-control" id="inputBirthdate" type="date" value="" name="pet_birthdate" max="" placeholder="Select a Date"/>
                                    <span class="input-group-text">
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" id="addVaccinationBtn">Add</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- View Vaccination Modal -->
    @foreach($vaccinations as $vac)

        <div class="modal fade" id="viewVaccination-{{$vac->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">View Vaccination</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-1">
                            <div class="col-md-6">
                                <label for="">Vaccine Type</label>
                                <p class="text-primary">{{$vac->vaccine_type}}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="">Date</label>
                                <div class="">
                                    <p class="badge bg-primary-soft text-primary rounded-pill">{{\Carbon\Carbon::parse($vac->created_at)->format('F j, Y')}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="selectVeterinarian">Administered By</label>
                                <p class="text-primary">
                                    @php
                                        $vet = $vets->where('id',$vac->doctor_id)->first();
                                    @endphp
                                    {{$vet->firstname. " " .$vet->lastname}}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label for="selectStatus">Status</label>
                                <div class="">
                                    <p class="badge {{$vac->status ? 'bg-success-soft text-success' : "bg-info-soft text-info"}} rounded-pill">
                                        {{$vac->status ? 'Completed' : 'Scheduled'}}</p>
                                </div>
                                <!-- <div class="">
                                    <p class="badge bg-secondary-soft text-secondary rounded-pill">Ongoing</p>
                                </div> -->
                            </div>
                            <div class="col-md-6">
                                <label for="">Return Date</label>
                                <p class="text-primary">{{\Carbon\Carbon::parse($vac->next_vaccine_date)->format('F j, Y')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal"
                                data-bs-target="#editVaccination-{{$vac->id}}">Edit
                        </button>
                        <button href="" class="btn btn-outline-danger" type="button" data-bs-toggle="modal"
                                data-bs-target="#deleteVaccination-{{$vac->id}}">Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Edit Vaccination Modal -->
        <div class="modal fade" id="editVaccination-{{$vac->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{route('vaccination.update', ['vacID'=>$vac->id])}}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Vaccination</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="vaccineType">Vaccine Type</label>
                                    <input type="text" name="vaccineType" id="vaccineType" class="form-control"
                                           value="{{$vac->vaccine_type}}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nextDueDate">Return Date</label>
                                    <input type="date" name="nextDueDate" id="nextDueDate" class="form-control"
                                           value="{{$vac->next_vaccine_date}}">
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input" id="noNextDueDate">
                                        <label for="noNextDueDate" class="form-check-label">No Return Date</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="selectVeterinarian">Administered By</label>
                                    <select class="form-control" id="selectVeterinarian" disabled>
                                        @php
                                            $doctor = \App\Models\Doctor::where('id',$vac->doctor_id)->first()
                                        @endphp
                                        <option selected>{{$doctor->firstname. ' ' . $doctor->lastname}}</option>

                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="selectStatus">Status</label>
                                    <select class="form-control" id="selectStatus" name="status">
                                        <option value="1" {{$vac->status == 1 ? 'selected' : ''}}>Completed</option>
                                        <option value="0" {{$vac->status == 0 ? 'selected' : ''}}>Scheduled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel
                            </button>
                            <button class="btn btn-primary" type="submit" id="editVaccinationBtn">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Vaccination -->
        <!-- Delete Pet Modal -->
        <div class="modal fade" id="deleteVaccination-{{$vac->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Vacciantion</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this vaccination?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <a href="" class="btn btn-danger" type="button">Delete Vaccination</a></div>
                </div>
            </div>
        </div>

    @endforeach

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
            <a class="nav-link nav-tab{{ request()->is('pet-profile') ? 'active' : '' }}" href="#pet-profile">Pet
                Profile</a>
            <a class="nav-link nav-tab{{ request()->is('schedules') ? 'active' : '' }}" href="#schedules">Appointment Schedules</a>
            <a class="nav-link nav-tab{{ request()->is('history') ? 'active' : '' }}" href="#history">Appointment History</a>
            <a class="nav-link nav-tab{{ request()->is('records') ? 'active' : '' }}" href="#records">Medical Records</a>
            <a class="nav-link nav-tab{{ request()->is('records') ? 'active' : '' }}"
               href="#vaccination">Vaccination Records</a>
        </nav>
        <hr class="mt-0 mb-4"/>
        <div id="petProfileCard" style="display:none;">
            <div class="row">
            <div class="col-md-8">
                <!-- Account details card-->
                <div class="card mb-4 shadow-none">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Pet Profile</span>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('pets.edit', $pet->id) }}">Update Pet</a></li>

                                @if(!$pet->status)
                                    <div class="dropdown-divider"></div>
                                    <li>
                                        <button class="dropdown-item text-primary" data-bs-toggle="modal"
                                                data-bs-target="#verifyPetModal">Verify Pet
                                        </button>
                                    </li>
                                @endif
                                {{--                            <div class="dropdown-divider"></div>--}}
                                {{--                            <li><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deletePetModal">Delete Pet</button></li>--}}
                            </ul>
                        </div>
                    </div>
                    <div class=" card-body">
                        <div class="row gx-5 px-3">
                            <div class="col-md-3 d-flex justify-content-center p-0 h-50 align-items-center">
                                <img class="img-account-profile rounded-circle p-1"
                                     src="{{ $pet->pet_picture != null ? asset('storage/' . $pet->pet_picture) : asset('assets/img/illustrations/profiles/pet.png') }}"
                                     alt=""
                                     style="width: 100%; height: 100%; object-fit: cover;"/>
                            </div>
                            <div class="col-md-9 ps-md-5 p-0">
                                <div class="row gx-3">
                                    <div class="col-md-5">
                                        <label class="small mb-1">Pet Name</label>
                                        <p class="text-primary">{{$pet->pet_name}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1">PetID</label>
                                        <div>
                                            <p class="badge bg-primary-soft text-primary rounded-pill">
                                                PETID-{{ str_pad($pet->id, 5, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small mb-1">Verification Status</label>
                                        <div>
                                            @if($pet->status)
                                                <p class="badge bg-primary-soft text-primary rounded-pill"><i
                                                        class="fa-solid fa-check"></i> Verified</p>
                                            @else
                                                <p class="badge bg-light text-body rounded-pill"><i
                                                        class="fa-solid fa-minus"></i> Not Verified</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="small mb-1">Pet Type</label>
                                        <p>{{$pet->pet_type}}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="small mb-1">Breed</label>
                                        <p>{{$pet->pet_breed}}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="small mb-1">Color</label>
                                        <p>{{$pet->pet_color}}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="small mb-1">Birthdate</label>
                                        <p>{{\Carbon\Carbon::parse($pet->pet_birthdate)->format('F d, Y')}}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="small mb-1">Gender</label>
                                        <p>{{$pet->pet_gender}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gx-5">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-2 text-primary">Other Information</h6>
                                        <hr class="mt-1 mb-3">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1">Vacciantion Record</label>
                                        <p>
                                            @if($pet->vaccinated == 1)
                                                Complete as
                                                of {{ \Carbon\Carbon::parse($pet->anti_rabies_vaccination_date)->format('F j, Y') }}
                                            @elseif($pet->vaccinated == 0)
                                                Incomplete as of {{ \Carbon\Carbon::now()->format('F j, Y') }}
                                            @else
                                                No Vaccination record
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1">Spayed/Neutered</label>
                                        <p>
                                            {{$pet->neutered == 1 ? 'Yes' : 'No'}}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1">Vaccinated with Anti-Rabies?</label>
                                        <p>
                                            {{$pet->vaccinated_anti_rabies == 1 ? 'Yes' : 'No'}}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1">Date of Anti-Rabies Vaccination</label>
                                        <p>{{ $pet->anti_rabies_vaccination_date ? \Carbon\Carbon::parse($pet->anti_rabies_vaccination_date)->format('F j, Y') : 'Incomplete'}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1">Okay to use photos online?</label>
                                        <p>
                                            {{$pet->okay_to_use_photos_online == 1 ? 'Yes' : 'No'}}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1">Date of Last Groom</label>
                                        <p>{{ $pet->last_groom_date ? \Carbon\Carbon::parse($pet->last_groom_date)->format('F j, Y') : 'No Record'}}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="small mb-1">Okay to give treats?</label>
                                        <p> {{$pet->okay_to_give_treats == 1 ? 'Yes' : 'No'}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Food Preferences</label>
                                        <div class="border rounded p-3 mb-3" style="min-height: 150px">{{$pet->pet_food != null ? $pet->pet_food : "No Specific Food Identified"}}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Allergies</label>
                                        <div class="border rounded p-3 mb-3" style="min-height: 150px">{{$pet->food_allergies !=  null ? $pet->food_allergies : "No Allergies Recorded"}}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">History of Aggression</label>
                                        <div class="border rounded p-3 mb-3" style="min-height: 150px">
                                            {{$pet->history_of_aggression != null ? $pet->history_of_aggression : 'No History of Aggression Identified'}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Pet's Medical Condition</label>
                                        <div class="border rounded p-3 mb-3" style="min-height: 150px">{{$pet->pet_condition != null ? $pet->pet_condition : "No Conditions Recorded"}}</div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12 mt-3">--}}
                                {{-- <label class="small mb-1" for="inputPetDescription">Pet Description</label>--}}
                                {{-- <p>{{$pet->pet_description}}</p>--}}
                                {{-- </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow-none">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="">Pet Owner Details</div>
                        <a class="btn btn-datatable btn-primary px-5 py-3 m-0" href="{{ route('owners.show', $pet->client->user_id) }}"><svg class="svg-inline--fa fa-arrow-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 278.6l-160 160C272.4 444.9 264.2 448 256 448s-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L338.8 288H32C14.33 288 .0016 273.7 .0016 256S14.33 224 32 224h306.8l-105.4-105.4c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160C451.1 245.9 451.1 266.1 438.6 278.6z"></path></svg><!-- <i class="fas fa-arrow-right"></i> Font Awesome fontawesome.com --></a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                                <div class="row gx-3">
                                    @php
                                        Clients::setEmailAttribute($pet->client, $pet->client->user_id);
                                    @endphp
                                    <div class="col-md-12">
                                        <p class="small mb-1" for="inputOwnerName">Owner Name</p>
                                        <p class="text-primary">{{$pet->client->client_name}}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="small mb-1" for="inputOwnerAddress">Owner Address</p>
                                        <p>{{$pet->client->client_address}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="small mb-1" for="ownerContact">Contact Number</p>
                                        <a href="tel:{{$pet->client->client_no}}">{{$pet->client->client_no}}</a>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="small mb-1" for="inputOwnerEmail">Email Address</p>
                                        <a href="mailto:{{$pet->client->client_email}}">{{$pet->client->client_email}}</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card mb-4 shadow-none" id="schedulesCard" style="display:none;">
                    <div class="card-header">
                        Appointment Schedules
                    </div>
                    <div class="card-body">
                        <!-- <div class="no-records text-center p-2">
                                    <i class="fa-solid fa-hippo"></i>
                                    No Records Yet
                                </div> -->
                        <table id="petSchedTable">
                            <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Reason of Visit</th>
                                <th>Veterinarian</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $appointments as $appointment)
                                @if($appointment->pet_ID == $pet->id && $appointment->status != 1)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }}
                                            |
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                        </td>
                                        <td>{{ sprintf("VetISAPT-%05d", $appointment->id)}}</td>

                                        <td>{{$appointment->purpose}}</td>

                                        <td>
                                            @if(is_null($appointment->status) == true)
                                                Pending
                                            @elseif($appointment->status == 0)
                                                <div class="badge bg-secondary-soft text-secondary rounded-pill">
                                                    Scheduled
                                                </div>
                                            @elseif($appointment->status == 2)
                                                Cancelled
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('appointments.view',['id'=>$appointment->id])}}"
                                               class="btn btn-datatable btn-primary px-5 py-3">View</a>
                                        </td>
                                    </tr>

                                @else
                                    @continue
                                @endif

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 shadow-none" id="historyCard" style="display:none;">
                        <div class="card-header">
                            Appointment History
                        </div>
                        <div class="card-body">
                            <!-- <div class="no-records text-center p-2">
                                    <i class="fa-solid fa-hippo"></i>
                                    No Records Yet
                                </div> -->
                            <table id="petHistoryTable">
                                <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Reason of Visit</th>
                                    <th>Veterinarian</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appointments as $appointment)
                                    @if($appointment->pet_ID == $pet->id && $appointment->status == 1)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }}
                                                |
                                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                            </td>
                                            <td>Appointment ID</td>
                                            <td>{{$appointment->purpose}}</td>
                                            <td>
                                                <div class="badge bg-success-soft text-success rounded-pill">Finished
                                                </div>
                                            </td>
                                            <td><a href="{{route('appointments.view',['id'=>$appointment->id])}}"
                                                   class="btn btn-datatable btn-primary px-5 py-3">View</a></td>
                                        </tr>
                                    @endif
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-4 shadow-none" id="recordsCard" style="display:none;">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>Medical Records</span>
{{--                                @if(auth()->user()->role === "veterinarian")--}}
{{--                                    @php--}}

{{--                                        $doctor_id = \App\Models\Doctor::getDoctorById(auth()->id())->id--}}
{{--                                    @endphp--}}
{{--                                    <form action="{{route('soap.add', ['id' =>$pet->id,'doctorID' => $doctor_id])}}"--}}
{{--                                          method="post">--}}
{{--                                        @csrf--}}

{{--                                        <button class="btn btn-primary" type="submit">New--}}
{{--                                        </button>--}}
{{--                                    </form>--}}
{{--                                @endif--}}
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addMedicalRecord"><i class="fa-solid fa-plus me-2"></i> Create Medical Record</button>
                            </div>
                            <div class="card-body">
                                <!-- only shows if there is no record -->
                                <!-- <div class="no-records text-center p-2">
                                    <i class="fa-solid fa-hippo"></i>
                                    No Records Yet
                                </div> -->
                                <table id="datatablesSimple">
                                    <thead>
                                    <tr>
                                        <th>Date of Visit</th>
                                        <th>Subject</th>
                                        <th>Attending Veterinarian</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pet_records as $record)
                                        <tr>
                                            <td>{{$record->record_date}}</td>
                                            <td>{{sprintf('VETIS-%05d', $record->id)}}</td>
                                            <td>{{$record->complaint}}</td>
                                            <td>{{($record->status == 1) ? "Filled" : "Ongoing"}}</td>
                                            <td>
                                                <a class="btn btn-datatable btn-primary px-5 py-3"
                                                   href="{{route('soap.view', ['id' => $pet->id, 'recordID' => $record->id])}}">View</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-4 shadow-none" id="vaccinationCard" style="display: none;">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>Vaccination Record</span>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                        data-bs-target="#addVaccination">Add
                                </button>
                            </div>
                            <div class="card-body">
                                <!-- only shows if there is no record -->
                                <!-- <div class="no-records text-center p-2">
                                    <i class="fa-solid fa-hippo"></i>
                                    No Records Yet
                                </div> -->
                                <table id="vaccinationTable">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Vaccine Type</th>
                                        <th>Next Return Date</th>
                                        <th>Administered By</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vaccinations as $vac)
                                        <tr>
                                            <td>{{\Carbon\Carbon::parse($vac->created_at)->format('F j, Y')}}</td>
                                            <td>{{$vac->vaccine_type}}</td>
                                            <td>{{\Carbon\Carbon::parse($vac->next_vaccine_date)->format('F j, Y') ?? 'No Next Vaccination Scheduled'}}</td>
                                            <td>
                                                @php
                                                    $vet = $vets->where('id', $vac->doctor_id)->first();
                                                @endphp
                                                {{$vet->firstname . " " . $vet->lastname}}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge {{$vac->status == true ? 'bg-success-soft text-success' : 'bg-info-soft text-info'}} rounded-pill">{{$vac->status ==  true ? 'Completed' : 'Scheduled'}}</span>
                                            </td>
                                            <td>
                                                <button class="btn btn-datatable btn-primary px-5 py-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#viewVaccination-{{$vac->id}}">View
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var pet = @json($pet);
        console.log(pet);

        // Handle the "No Next Due Date" checkbox logic
        document.getElementById('noNextDueDate').addEventListener('change', function () {
            const nextDueDateInput = document.getElementById('nextDueDate');
            if (this.checked) {
                nextDueDateInput.value = '';
                nextDueDateInput.disabled = true;
            } else {
                nextDueDateInput.disabled = false;
            }
        });

        $(document).ready(function(){
            $(".attending-vet-med-rec").select2({
                theme: "bootstrap-5",
                dropdownParent: "#addMedicalRecord",
                width: $(this).data("width")
                    ? $(this).data("width")
                    : $(this).hasClass("w-100")
                        ? "100%"
                        : "style",
                placeholder: $(this).data("placeholder"),
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.nav-tab');
            const cards = {
                'pet-profile': document.getElementById('petProfileCard'),
                'schedules': document.getElementById('schedulesCard'),
                'history': document.getElementById('historyCard'),
                'records': document.getElementById('recordsCard'),
                'vaccination': document.getElementById('vaccinationCard')
            };

            // Ensure Pet Profile is active initially
            document.querySelector('.nav-link[href="#pet-profile"]').classList.add('active');
            cards['pet-profile'].style.display = 'block'; // Show Pet Profile Card by default

            tabs.forEach(tab => {
                tab.addEventListener('click', function (e) {
                    e.preventDefault();
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');

                    // Hide all cards
                    Object.values(cards).forEach(card => card.style.display = 'none');

                    // Show the clicked tab's corresponding card
                    const targetCard = tab.getAttribute('href').substring(1);
                    if (cards[targetCard]) {
                        cards[targetCard].style.display = 'block';
                    }
                });
            });

            // Trigger the click on the Pet Profile tab to show it initially
            document.querySelector('.nav-tab.active').click();
        });
    </script>

@endsection
