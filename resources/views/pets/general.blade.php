@php use App\Models\Clients; @endphp
@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- Delete Pet Modal -->
    <div class="modal fade" id="deletePetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
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
                    <a href="" class="btn btn-danger" type="button">Delete Pet</a>
                </div>
            </div>
        </div>
    </div>


    @if(!$pet -> status)
    <!-- Verify Pet Modal -->
        <div class="modal fade" id="verifyPetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Verify Pet</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to verify this Pet?</p>
                        <form id="verifyPetForm" action="{{ route('pets.verify', ['pet_id' => $pet->id]) }}" method="POST">
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
    @endif


    @if(!$pet -> isArchived)
        <!-- Archive Pet Modal -->
    <div class="modal fade" id="archivePetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Archive Pet</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to archive this Pet?</p>
                    <form id="archivePetForm" action="{{ route('pets.archivePet', ['pet_id' => $pet->id]) }}" method="POST">
                        @csrf
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" form="archivePetForm" type="submit">Archive</button>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Unarchive Pet Modal -->
    <div class="modal fade" id="unarchivePetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Unarchive Pet</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to Unarchive this Pet?</p>
                    <form id="unarchivePetForm" action="{{ route('pets.unarchivePet', ['pet_id' => $pet->id]) }}" method="POST">
                        @csrf
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" form="unarchivePetForm" type="submit">Unarchive</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Vaccination Modal -->
    <div class="modal fade" id="addVaccination" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('vaccination.add', ['pet_id' => $pet->id]) }}" method="post">
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
                                    @foreach ($vets as $vet)
                                        <option value={{ $vet->id }}>Dr. {{ $vet->firstname . ' ' . $vet->lastname }}
                                        </option>
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
    <div class="modal fade" id="addMedicalRecord" tabindex="-1" role="dialog" aria-labelledby="addMedicalRecord"
         aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('soap.add', ['pet_id' => $pet->id]) }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Create Medical Record for <span
                                class="text-primary">{{ $pet->pet_name }}</span></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gy-2">
                            <div class="col-md-12">
                                <label for="" class="mb-1">Subject</label>
                                <input type="text" name="subject" id=""
                                       placeholder="Specify the purpose of this record" class="form-control
                                @error('subject') is-invalid @enderror" value="{{ old('subject') }}" autocomplete="off">
                                @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                @php
                                    if (auth()->user()->role === 'veterinarian') {
                                        $doctor = \App\Models\Doctor::getDoctorById(auth()->id());
                                    }
                                @endphp
                                <label for="" class="mb-1">Attending Veterinarian</label>
                                <select name="doctorID" id="" class="form-select attending-vet-med-rec
                                @error('doctorID') is-invalid @enderror" data-placeholder="Select Attending Veterinarian"
                                    {{ auth()->user()->role === 'veterinarian' ? 'disabled' : '' }}>
                                    <option value=""></option>
                                    @foreach ($vets as $vet)
                                        <option value="{{ $vet->id }}"
                                            {{ old('doctorID') == $vet->id ? 'selected' : (auth()->user()->role === 'veterinarian' && isset($doctor) && $doctor->id === $vet->id ? 'selected' : '') }}>
                                            Dr. {{ $vet->firstname . ' ' . $vet->lastname }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('doctorID')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (auth()->user()->role === 'veterinarian')
                                    <input type="hidden" name="doctorID" value="{{ $doctor->id }}">
                                @endif
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
            <a class="nav-link nav-tab{{ request()->is('schedules') ? 'active' : '' }}" href="#schedules">Appointment
                Schedules</a>
            <a class="nav-link nav-tab{{ request()->is('history') ? 'active' : '' }}" href="#history">Appointment
                History</a>
            <a class="nav-link nav-tab{{ request()->is('records') ? 'active' : '' }}" href="#records">Medical Records</a>
            <a class="nav-link nav-tab{{ request()->is('records') ? 'active' : '' }}" href="#vaccination">Vaccination
                Records</a>
        </nav>
        <hr class="mt-0 mb-4" />
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
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    @if (!$pet->isArchived)
                                    <div>
                                        <a class="dropdown-item" href="{{ route('pets.edit', $pet->id) }}"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Pet</a>
                                    </div>
                                    @endif
                                    @if (!$pet->status && !$pet->isArchived)
                                        <div class="dropdown-divider"></div>
                                        <div>
                                            <button class="dropdown-item text-primary" data-bs-toggle="modal"
                                                data-bs-target="#verifyPetModal"><i class="fa-solid fa-circle-check me-2"></i>Verify Pet
                                            </button>
                                        </div>
                                    @endif
                                    @if (!$pet->isArchived)
                                    <div class="dropdown-divider"></div>
                                    <div class="">
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                                data-bs-target="#archivePetModal">
                                            <i class="fa-solid fa-box-archive me-2"></i> Archive Pet
                                        </button>
                                    </div>
                                    @else
                                    <div class="">
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item text-primary" data-bs-toggle="modal"
                                                data-bs-target="#unarchivePetModal"><i class="fa-solid fa-inbox me-2"></i> Unarchive Pet
                                        </button>
                                    </div>
                                    @endif
                                    {{--                            <div class="dropdown-divider"></div> --}}
                                    {{--                            <li><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deletePetModal">Delete Pet</button></li> --}}
                                </div>
                            </div>
                        </div>
                        <div class=" card-body">
                            <div class="row gx-5 px-2">
                                <div class="col-md-3 d-flex justify-content-center p-0 align-items-center">
                                    <img class="img-account-profile rounded-circle"
                                         src="{{ $pet->pet_picture != null ? asset('storage/' . $pet->pet_picture) : asset('assets/img/illustrations/profiles/pet.png') }}"
                                         alt=""
                                         style="width: 200px; height: 200px; object-fit: cover;"/>
                                </div>
                                <div class="col-md-9">
                                    <div class="row gx-3 p-xs-3">
                                        <div class="col-md-5">
                                            <label class="small mb-1">Pet Name</label>
                                            <p class="text-primary">{{ $pet->pet_name }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="small mb-1">PetID</label>
                                            <div>
                                                <p class="badge bg-primary-soft text-primary rounded-pill">
                                                    PETID-{{ str_pad($pet->id, 5, '0', STR_PAD_LEFT) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="small mb-1">Pet Status</label>
                                            <div>
                                                @if ($pet->status && !$pet->isArchived)
                                                    <p class="badge bg-primary-soft text-primary rounded-pill"><i
                                                            class="fa-solid fa-check"></i> Verified</p>
                                                @elseif(!$pet->status && !$pet->isArchived)
                                                    <p class="badge bg-light text-body rounded-pill"><i
                                                            class="fa-solid fa-minus"></i> Not Verified</p>
                                                @endif
                                                @if ($pet->isArchived)
                                                <p class="badge bg-gray-800 text-white rounded-pill">
                                                    Archived
                                                </p>
                                            @endif
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="small mb-1">Pet Type</label>
                                            <p>{{ $pet->pet_type }}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="small mb-1">Breed</label>
                                            <p>{{ $pet->pet_breed }}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="small mb-1">Color</label>
                                            <p>{{ $pet->pet_color }}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="small mb-1">Birthdate</label>
                                            <p>{{ \Carbon\Carbon::parse($pet->pet_birthdate)->format('F d, Y') }}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="small mb-1">Gender</label>
                                            <p>{{ $pet->pet_gender }}</p>
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
                                                @if ($pet->vaccinated === 1)
                                                    Complete as of {{ \Carbon\Carbon::parse($pet->anti_rabies_vaccination_date)->format('F, Y') }}
                                                @elseif ($pet->vaccinated === 0)
                                                    Incomplete
                                                @elseif (is_null($pet->vaccinated))
                                                    No Vaccination record
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="small mb-1">Spayed/Neutered</label>
                                            <p>
                                                {{ $pet->neutered === 1 ? 'Yes' : ($pet->neutered === 0 ? 'No' : 'No Record') }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="small mb-1">Vaccinated with Anti-Rabies?</label>
                                            <p>
                                                {{ $pet->vaccinated_anti_rabies == 1 ? 'Yes' : 'No' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="small mb-1">Date of Anti-Rabies Vaccination</label>
                                            <p>{{ $pet->anti_rabies_vaccination_date ? \Carbon\Carbon::parse($pet->anti_rabies_vaccination_date)->format('F, Y') : 'No Record' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="small mb-1">Okay to use photos online?</label>
                                            <p>
                                                {{ $pet->okay_to_use_photos_online == 1 ? 'Yes' : 'No' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="small mb-1">Date of Last Groom</label>
                                            <p>{{ $pet->last_groom_date ? \Carbon\Carbon::parse($pet->last_groom_date)->format('F, Y') : 'No Record' }}
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="small mb-1">Okay to give treats?</label>
                                            <p> {{ $pet->okay_to_give_treats == 1 ? 'Yes' : 'No' }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1">Food Preferences</label>
                                            <div class="border rounded p-3 mb-3" style="min-height: 150px">
                                                {{ $pet->pet_food != null ? $pet->pet_food : 'No Specific Food Identified' }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1">Allergies</label>
                                            <div class="border rounded p-3 mb-3" style="min-height: 150px">
                                                {{ $pet->food_allergies != null ? $pet->food_allergies : 'No Allergies Recorded' }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1">History of Aggression</label>
                                            <div class="border rounded p-3 mb-3" style="min-height: 150px">
                                                {{ $pet->history_of_aggression != null ? $pet->history_of_aggression : 'No History of Aggression Identified' }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1">Pet's Medical Condition</label>
                                            <div class="border rounded p-3 mb-3" style="min-height: 150px">
                                                {{ $pet->pet_condition != null ? $pet->pet_condition : 'No Conditions Recorded' }}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mt-3"> --}}
                                    {{-- <label class="small mb-1" for="inputPetDescription">Pet Description</label> --}}
                                    {{-- <p>{{$pet->pet_description}}</p> --}}
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-none">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="">Pet Owner Details</div>
                            <a class="btn btn-datatable btn-primary px-5 py-3 m-0"
                                href="{{ route('owners.show', $pet->client->id) }}"><svg
                                    class="svg-inline--fa fa-arrow-right" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="arrow-right" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M438.6 278.6l-160 160C272.4 444.9 264.2 448 256 448s-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L338.8 288H32C14.33 288 .0016 273.7 .0016 256S14.33 224 32 224h306.8l-105.4-105.4c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160C451.1 245.9 451.1 266.1 438.6 278.6z">
                                    </path>
                                </svg><!-- <i class="fas fa-arrow-right"></i> Font Awesome fontawesome.com --></a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="row gx-3">
                                    @php
                                        Clients::setEmailAttribute($pet->client, $pet->client->user_id);
                                    @endphp
                                    <div class="col-md-12">
                                        <p class="small mb-1" for="inputOwnerName">Owner Name</p>
                                        <p class="text-primary">{{ $pet->client->client_name }}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="small mb-1" for="inputOwnerAddress">Owner Address</p>
                                        <p>{{ $pet->client->client_address }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="small mb-1" for="ownerContact">Contact Number</p>
                                        <a href="tel:{{ $pet->client->client_no }}">{{ $pet->client->client_no }}</a>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="small mb-1" for="inputOwnerEmail">Email Address</p>
                                        <a
                                            href="mailto:{{ $pet->client->client_email }}">{{ $pet->client->client_email }}</a>
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
                            @foreach ($appointments->sortBy(function($appointment) {
                            return $appointment->appointment_date . ' ' . $appointment->appointment_time;
                            }) as $appointment)
                                    @if (in_array($pet->id, explode(',', $appointment->pet_ID)) && $appointment->status == 0)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }}
                                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                            </td>
                                            <td>
                                                @php
                                                    $service_ids = explode(',', $appointment->purpose);
                                                    $services = \App\Models\Services::whereIn('id', $service_ids)->pluck('service_name')->toArray();
                                                    $service_list = implode(', ', $services);
                                                @endphp

                                                {{ \Illuminate\Support\Str::limit($service_list, 35) }}
                                            </td>

                                            <td>
                                                Dr. {{ $vets->firstWhere('id', $appointment->doctor_ID)->lastname ?? 'No Vet Found' }}
                                            </td>

                                            <td>
                                                @if (is_null($appointment->status) == true)
                                                    Pending
                                                @elseif($appointment->status == 0)
                                                    <div class="badge badge-sm bg-secondary-soft text-secondary text-sm rounded-pill">
                                                        Scheduled
                                                    </div>
                                                @elseif($appointment->status == 2)
                                                    Cancelled
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('appointments.view', ['id' => $appointment->id]) }}"
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
                                @foreach ($appointments->sortBy(function($appointment) {
                                return $appointment->appointment_date . ' ' . $appointment->appointment_time;
                                }) as $appointment)
                                        @if (in_array($pet->id, explode(',', $appointment->pet_ID)) && $appointment->status == 1)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }} {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                                </td>
                                                <td>  @php
                                                        $service_ids = explode(',', $appointment->purpose);
                                                        $services = \App\Models\Services::whereIn('id', $service_ids)->pluck('service_name')->toArray();
                                                        $service_list = implode(', ', $services);
                                                    @endphp

                                                    {{ \Illuminate\Support\Str::limit($service_list, 35) }}</td>
                                                <td>
                                                    Dr. {{ $vets->firstWhere('id', $appointment->doctor_ID)->lastname ?? 'No Vet Found' }}
                                                </td>
                                                <td>
                                                    <div class="badge badge-sm text-sm bg-success-soft text-success rounded-pill">Finished
                                                    </div>
                                                </td>
                                                <td><a href="{{ route('appointments.view', ['id' => $appointment->id]) }}"
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
                                {{--                                @if (auth()->user()->role === 'veterinarian') --}}
                                {{--                                    @php --}}

                                {{--                                        $doctor_id = \App\Models\Doctor::getDoctorById(auth()->id())->id --}}
                                {{--                                    @endphp --}}
                                {{--                                    <form action="{{route('soap.add', ['id' =>$pet->id,'doctorID' => $doctor_id])}}" --}}
                                {{--                                          method="post"> --}}
                                {{--                                        @csrf --}}

                                {{--                                        <button class="btn btn-primary" type="submit">New --}}
                                {{--                                        </button> --}}
                                {{--                                    </form> --}}
                                {{--                                @endif --}}
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#addMedicalRecord"><i class="fa-solid fa-plus me-2"></i> Create
                                    Medical Record</button>
                            </div>
                            <div class="card-body">
                                <!-- only shows if there is no record -->
                                <!-- <div class="no-records text-center p-2">
                                            <i class="fa-solid fa-hippo"></i>
                                            No Records Yet
                                        </div> -->
                                <table id="medicalRecordsTable">
                                    <thead>
                                        <tr>
                                            <th>Date Created</th>
                                            <th>Subject</th>
                                            <th>Attending Veterinarian</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pet_records->sortByDesc('record_date') as $record)
                                        <tr>
                                                <td>{{ \Carbon\Carbon::parse($record->record_date)->format('F d, Y h:i A') }}</td>
                                                <td>{{ $record->subject }}</td>
                                                <td>
                                                    @php
                                                        $doctor = \App\Models\Doctor::where('id', $record->doctorID)->first();
                                                    @endphp
                                                    Dr. {{ $doctor->firstname}} {{ $doctor->lastname}}
                                                </td>
                                                <td>{!! $record->status == 1
    ? '<span class="badge rounded-pill bg-success-soft text-success text-sm">Completed</span>'
    : '<span class="badge rounded-pill bg-warning-soft text-warning text-sm">Ongoing</span>' !!}</td>
                                                <td>
                                                    <a class="btn btn-datatable btn-primary px-5 py-3"
                                                        href="{{ route('soap.view', ['id' => $pet->id, 'recordID' => $record->id]) }}">View</a>
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
                                {{-- <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#addVaccination">Add
                                </button> --}}
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
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vaccinations as $vaccination)
                                            <tr>
                                                <td>{{ $vaccination->created_at->format('M d, Y') }}</td>
                                                <td>{{ $vaccination->vaccine_type }}</td>
                                                <td>
                                                    @if ($vaccination->status == 0)
                                                        <span class="badge badge-sm text-sm bg-warning-soft text-warning rounded-pill">Ongoing</span>
                                                    @elseif ($vaccination->status == 1)
                                                        <span class="badge badge-sm text-sm bg-success-soft text-success rounded-pill">Completed</span>
                                                    @elseif ($vaccination->status == 2)
                                                        <span class="badge badge-sm text-sm bg-danger-soft text-danger rounded-pill">Archived</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('records.vaccination.view', ['vaccination_id' => $vaccination->id]) }}"
                                                        class="btn btn-datatable btn-primary px-5 py-3">View</a>
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
        document.getElementById('noNextDueDate').addEventListener('change', function() {
            const nextDueDateInput = document.getElementById('nextDueDate');
            if (this.checked) {
                nextDueDateInput.value = '';
                nextDueDateInput.disabled = true;
            } else {
                nextDueDateInput.disabled = false;
            }
        });

        $(document).ready(function() {
            $(".attending-vet-med-rec").select2({
                theme: "bootstrap-5",
                dropdownParent: "#addMedicalRecord",
                width: $(this).data("width") ?
                    $(this).data("width") : $(this).hasClass("w-100") ?
                    "100%" : "style",
                placeholder: $(this).data("placeholder"),
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Nav switch logic
            const tabs = document.querySelectorAll('.nav-tab');
            const cards = {
                'pet-profile': document.getElementById('petProfileCard'),
                'schedules': document.getElementById('schedulesCard'),
                'history': document.getElementById('historyCard'),
                'records': document.getElementById('recordsCard'),
                'vaccination': document.getElementById('vaccinationCard')
            };


            @if ($errors->has('subject') || $errors->has('doctorID'))
            // Show the modal
            var addMedicalRecordModal = new bootstrap.Modal(document.getElementById('addMedicalRecord'));
            addMedicalRecordModal.show();

            document.querySelector('.nav-link[href="#records"]').classList.add('active');
            document.getElementById('recordsCard').style.display = 'block';
            @else
                document.querySelector('.nav-link[href="#pet-profile"]').classList.add('active');
                cards['pet-profile'].style.display = 'block'; // Show Pet Profile Card by default
            @endif

            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
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
