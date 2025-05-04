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


<!-- Modals -->
<!-- Archive Medical Record Modal -->
<div class="modal fade" id="archiveMedicalRecordModal" tabindex="-1" aria-labelledby="archiveMedicalRecordModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content py-3">
            <div class="modal-header border-0 text-center d-block">
                <i class="fa-solid fa-box-archive text-warning display-4"></i>
                <h5 class="modal-title mt-2" id="archiveMedicalRecordModal">Archive Medical Record</h5>
            </div>
            <div class="modal-body text-center">
                Are you sure you want to <strong>Archive</strong> this medical record?
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <form action="" method="POST">
                    @csrf
                    <button type="button" class="btn btn-light text-dark" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Archive</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{--  Edit Medical Record Modal  --}}
<div class="modal fade " id="editMedicalRecord" tabindex="-1" role="dialog" aria-labelledby="editMedicalRecord"
     aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Medical Record for <span class="text-primary">{{$pet->pet_name}}</span></h5>
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
                            <select name="" id="" class="form-select">
                                <option value=""></option>
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
                        <hr class="mt-3 mb-2">
                        <div class="col-md-12">
                            <label for="" class="mb-1">Medical Record Status</label>
                            <select name="" id="" class="form-select">
                                <option value="">Ongoing</option>
                                <option value="">Completed</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="addVaccinationBtn">Edit</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Attending Veterinarian -->
<div class="modal fade" id="veterinarianListModal" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-user-doctor"></i> Veterinarian List</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control mb-4" placeholder="Enter Veterinarian Name or ID">
                <div class="card shadow-none pt-2 pb-2 px-3 rounded-3">
                    <table class="table table-hover text-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vets as $vet)
                            <tr data-bs-toggle="modal" data-bs-target=""
                                style="cursor: pointer;" onclick="selectVeterinarian({{$vet}})">
                                <td> {{ sprintf("VETIS-%05d", $vet->id) }}</td>
                                <td>{{$vet->firstname." ".$vet->lastname}}</td>
                                <td>Veterinarian</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination-section d-flex w-full justify-content-end mt-2">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination mb-0">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Owner Modal -->
<div class="modal fade" id="petOwnerListModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-user"></i> Pet Owner List</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-between">
                    <div class="col-md-10">
                        <input type="text" class="form-control mb-4" placeholder="Enter Pet Owner Name or ID">
                    </div>
                    <div class="col-md-2  d-flex justify-content-end">
                        <button class="btn btn-primary mb-4 d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-plus"></i> <span class="ms-2">New</span>
                        </button>
                    </div>
                </div>

                <div class="card shadow-none pt-2 pb-2 px-3 rounded-3">
                    <table class="table table-hover text-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>No. of Pets</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-bs-toggle="modal" data-bs-target=""
                                style="cursor: pointer;">
                                <td>23</td>
                                <td>Kent Invento</td>
                                <td>2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pagination-section d-flex w-full justify-content-end mt-2">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination mb-0">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pets Modal -->
<div class="modal fade" id="petListModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-cat"></i> Pet List</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-between">
                    <div class="col-md-10">
                        <input type="text" class="form-control mb-4"
                            placeholder="Enter Pet ID, Pet Name, Pet Owner, Pet Type">
                    </div>
                    <div class="col-md-2  d-flex justify-content-end">
                        <button class="btn btn-primary mb-4 d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-plus"></i> <span class="ms-2">New</span>
                        </button>
                    </div>
                </div>
                <div class="card shadow-none pt-2 pb-2 px-3 rounded-3">
                    <table class="table table-hover text-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Owner</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-bs-toggle="modal" data-bs-target=""
                                style="cursor: pointer;">
                                <td>23</td>
                                <td>Lexie</td>
                                <td>Dog</td>
                                <td>Kent Invento</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pagination-section d-flex w-full justify-content-end mt-2">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination mb-0">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Modal -->
<div class="modal fade" id="serviceListModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-notes-medical"></i> Services List</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-between">
                    <div class="col-md-12">
                        <input type="text" class="form-control mb-4" placeholder="Enter Service">
                    </div>
                    <!-- <div class="col-md-2  d-flex justify-content-end">
                            <button class="btn btn-primary mb-4 d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-plus"></i> <span class="ms-2">New</span>
                            </button>
                        </div> -->
                </div>
                <div class="card shadow-none pt-2 pb-2 px-3 rounded-3">
                    <table class="table table-hover text-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Service</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-bs-toggle="modal" data-bs-target="" style="cursor: pointer;" onclick="addService({
                            service: 'Deworming',
                            date_return: '{{\Carbon\Carbon::now()}}',
                            status: 'ongoing'
                            })">
                                <td>1</td>
                                <td>Deworming</td>
                                <td>500.00</td>
                            </tr>
                            <tr data-bs-toggle="modal" data-bs-target="" style="cursor: pointer;" onclick="addService({
                            service: 'Vaccination',
                            date_return: '{{\Carbon\Carbon::now()}}',
                            status: 'ongoing'
                            })">
                                <td>2</td>
                                <td>Vaccination</td>
                                <td>500.00</td>
                            </tr>
                            <tr data-bs-toggle="modal" data-bs-target="" style="cursor: pointer;" onclick="addService({
                            service: 'Grooming',
                            date_return: '{{\Carbon\Carbon::now()}}',
                            status: 'ongoing'
                            })">
                                <td>3</td>
                                <td>Grooming</td>
                                <td>200.00</td>
                            </tr>
                        </tbody>
                    </table>
                    <form action="{{route('plan.store',['recordID' =>$record->id])}}"
                        method="post" id="serviceForm">
                        @csrf
                    </form>
                </div>
                <div class="pagination-section d-flex w-full justify-content-end mt-2">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination mb-0">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

{{--@foreach($petPlan as $plan)--}}
{{--<!-- Service Plan  Edit Modal -->--}}
{{--<div class="modal fade" id="servicePlanEditModal-{{$plan->id}}" tabindex="-1" role="dialog"--}}
{{-- aria-labelledby="myExtraLargeModalLabel"--}}
{{-- style="display: none;" aria-hidden="true">--}}
{{-- <div class="modal-dialog modal-dialog-centered modal-md" role="document">--}}
{{-- <div class="modal-content">--}}
{{-- <form action="{{route('plan.update', [ 'recordID' => $record->id,'id' => $plan->id])}}" method="post">--}}
{{-- @csrf--}}
{{-- <div class="modal-header">--}}
{{-- <h5 class="modal-title"><i class="fa-solid fa-kit-medical me-1"></i> {{$plan->service_name}}</h5>--}}
{{-- <input type="hidden" name="service_name" value="{{$plan->service_name}}">--}}
{{-- <input type="hidden" name="status" value=1>--}}
{{-- <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{-- </div>--}}
{{-- <div class="modal-body">--}}
{{-- <label for="" class="text-sm fw-400">Date Return</label>--}}
{{-- <input type="date" name="date" value="{{$plan->date_return}}" id="" class="form-control">--}}
{{-- <label for="" class="mt-3 text-sm fw-400">Reason for Return</label>--}}
{{-- <textarea name="reason_for_return" id="" cols="30" rows="5" class="form-control">{{$plan->reason_for_return}}</textarea>--}}
{{-- <div class="dropdown mt-3 mb-2">--}}
{{-- <label for="" class="text-sm fw-400">Status</label>--}}
{{-- <button class="form-select d-flex justify-between" id="serviceStatusMenuButton" type="button"--}}
{{-- data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Status--}}
{{-- </button>--}}
{{-- <div class="select-dropdown-menu dropdown-menu" aria-labelledby="serviceStatusMenuButton">--}}
{{-- <a class="select-dropdown-item dropdown-item" href="#" data-selected="true" data-value="1">Upcoming</a>--}}
{{-- <a class="select-dropdown-item dropdown-item" href="#" data-value="2">Completed</a>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- <div class="modal-footer py-1">--}}
{{-- <button class="btn btn-primary">Save</button>--}}
{{-- </div>--}}
{{-- </form>--}}
{{-- </div>--}}
{{-- </div>--}}
{{--</div>--}}
{{--<!-- Delete Confirmation Modal -->--}}
{{--<div class="modal fade" id="serviceDeleteConfirmationModal-{{$plan->id}}" tabindex="-1" role="dialog"--}}
{{-- aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{-- <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{-- <div class="modal-content">--}}
{{-- <div class="modal-header">--}}
{{-- <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa-solid fa-trash me-2"></i>Delete--}}
{{-- Service</h5>--}}
{{-- <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{-- </div>--}}
{{-- <div class="modal-body">--}}
{{-- <p>Are you sure you want to delete the selected service <span--}}
{{-- class="text-primary">'{{$plan->service_name}}'</span>?</p>--}}
{{-- </div>--}}
{{-- <div class="modal-footer">--}}
{{-- <button class="btn btn-primary" type="button"--}}
{{-- data-bs-dismiss="modal">Cancel--}}
{{-- </button>--}}
{{-- <a href="{{route('plan.delete',["id" => $plan->id, "recordID" =>$record->id])}}"--}}
{{-- class="btn btn-danger" type="button">Delete</a>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{--</div>--}}
{{--@endforeach--}}



<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('pet.index') }}">Manage Pets</a></li>
                    <li class="breadcrumb-item active">Pet Profile</li>
                    <li class="breadcrumb-item active">Medical Record</li>
                </ol>
            </nav>
        </div>
    </div>
</header>



<!-- Main page content-->
<div class="container-xl px-4 mt-4">
    <nav class="nav nav-borders">
        <a class="nav-link ms-0" href="javascript:window.history.back();"><span class="px-2"><i class="fa-solid fa-arrow-left"></i></span> Back</a>
    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <form action="{{route('soap.update', ['id' => $pet->id,'recordID' => $record->id ])}}" method="post" id="updateForm">
            @csrf
            <div class="row gy-2">
                <div class="col-md-8">
                    <div class="card mb-5 shadow-none">
                        <div class="card-header">
                            <span>Pet Information</span>
                        </div>
                        <div class="card-body">
                            <div class="row gy-2">
                                <div class="col-md-3">
                                    Pet Name
                                    <p class="text-primary">{{$pet->pet_name}}</p>
                                </div>
                                <div class="col-md-3">
                                    Pet Type
                                    <p class="">{{$pet->pet_type}}</p>
                                </div>
                                <div class="col-md-3">
                                    Breed
                                    <p class="">{{$pet->pet_breed}}</p>
                                </div>
                                <div class="col-md-3">
                                    Color
                                    <p class="">{{$pet->pet_color}}</p>
                                </div>
                                <div class="col-md-3">
                                    Gender
                                    <p class="">{{$pet->pet_gender}}</p>
                                </div>
                                <div class="col-md-3">
                                    Birthdate
                                    <p class="">{{ \Carbon\Carbon::parse($pet->pet_birthdate)->format('F d, Y') }}</p>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1">Spayed/Neutered</label>
                                    <p>
                                        {{$pet->neutered === null ? 'No Record' : ($pet->neutered == 1 ? 'Yes' : 'No')}}
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1">Vaccinated with Anti-Rabies?</label>
                                    <p>
                                        {{$pet->vaccinated_anti_rabies === null ? 'No Record' : ($pet->vaccinated_anti_rabies == 1 ? 'Yes' : 'No')}}
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1">Date of Vaccination</label>
                                    <p>{{ $pet->anti_rabies_vaccination_date ? \Carbon\Carbon::parse($pet->anti_rabies_vaccination_date)->format('F j, Y') : 'No Record'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Account details card-->
                    <div class="card mb-4 shadow-none">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Pet Record</span>
                            <!-- Mo gawas rang print dropdown if ma save na -->
                        </div>
                        <div class="card-body">
                            <nav class="nav nav-borders">
                                <a class="nav-link nav-tab active {{ request()->is('general') ? 'active' : '' }}" href="#general">Chief Complaint</a>
                                <a class="nav-link nav-tab{{ request()->is('examination') ? 'active' : '' }}" href="#examination">Examination</a>
                                <a class="nav-link nav-tab{{ request()->is('diagnosis') ? 'active' : '' }}" href="#diagnosis">Diagnosis</a>
                                <a class="nav-link nav-tab{{ request()->is('treatment') ? 'active' : '' }}" href="#treatment">Treatment</a>
                                <a class="nav-link nav-tab{{ request()->is('remarks') ? 'active' : '' }}" href="#remarks">Remarks</a>
                                <a class="nav-link nav-tab{{ request()->is('prescription') ? 'active' : '' }}" href="#prescription">Prescription</a>
                            </nav>
                            <hr class="mt-0 mb-4" />
                            <div id="generalSection" style="display: none">
                                <div class="col-md-12">
                                    <div class="card shadow-none">
                                        <div class="card-header">Chief Complaint (CC)</div>
                                        <div class="card-body">
                                            <div id="quill-editor" class="mb-3" style="height: 400px;">
                                                {!! $record->complaint !!}
                                            </div>
                                            <textarea rows="3" class="mb-3 d-none" name="complaint" id="quill-editor-area">
                                                {!! $record->complaint !!}
                                            </textarea>
                                            {{--                                    <textarea name="" id="" cols="30" rows="10" class="form-control w-full"></textarea>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="examinationSection" style="display: none">
                                <div class="col-md-12">
                                    <div class="card shadow-none">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <span>Examination</span>
                                        </div>
                                        <!--
                                                --- MAO NIY DAPAT MA FILL SA TEMPLATE ---
                                                Heart Rate (BPM):
                                                Respiration Rate (BRPM):
                                                Weight (KG):
                                                Length (CM):
                                                CRT:
                                                BCS:
                                                Lymph Nodes:
                                                Palpebral Reflex:
                                                Temperature:
                                            -->
                                        <div class="card-body">
                                            <div class="row gy-5 mb-5">
                                                <div class="col-md-4">
                                                    <label class="form-label">Temperature:</label>
                                                    <div class="input-group">
                                                    <input type="text" class="form-control" inputmode="decimal" pattern="[0-9.]*" autocomplete="off" autocorrect="off" autocapitalize="off" onkeypress="return (event.charCode == 46 || event.charCode >= 48 && event.charCode <= 57)" name="temperature" value="{{$examination->temperature ?? ''}}">
                                                        <span class="input-group-text">°C</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">Heart Rate:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" inputmode="numeric" pattern="[0-9]*" autocomplete="off" autocorrect="off" autocapitalize="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="heart_rate" value="{{ $examination->heart_rate ?? '' }}">
                                                        <span class="input-group-text">bpm</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">Respiratory Rate:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" inputmode="numeric" pattern="[0-9]*" autocomplete="off" autocorrect="off" autocapitalize="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="respiratory_rate" value="{{ $examination->respiration_rate ?? '' }}">
                                                        <span class="input-group-text">bpm</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Weight:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" inputmode="decimal" pattern="[0-9.]*" autocomplete="off" autocorrect="off" autocapitalize="off" onkeypress="return (event.charCode == 46 || event.charCode >= 48 && event.charCode <= 57)" name="weight" value="{{ $examination->weight ?? '' }}">
                                                        <span class="input-group-text">kg</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Length:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" inputmode="decimal" pattern="[0-9.]*" autocomplete="off" autocorrect="off" autocapitalize="off" onkeypress="return (event.charCode == 46 || event.charCode >= 48 && event.charCode <= 57)" name="length" value="{{ $examination->length ?? '' }}">
                                                        <span class="input-group-text">cm</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Height:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" inputmode="decimal" pattern="[0-9.]*" autocomplete="off" autocorrect="off" autocapitalize="off" onkeypress="return (event.charCode == 46 || event.charCode >= 48 && event.charCode <= 57)" name="height" value="{{ $examination->height ?? '' }}">
                                                        <span class="input-group-text">cm</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Body Condition:</label> <br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="body_condition[underweight]" id="underweight" @if (isset($examination->body_condition) && array_key_exists('underweight', json_decode($examination->body_condition, true)) && json_decode($examination->body_condition, true)['underweight'] == 'on') checked @endif>
                                                        <label class="form-check-label" for="underweight">Underweight</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="body_condition[normal]" id="normal" @if (isset($examination->body_condition) && array_key_exists('normal', json_decode($examination->body_condition, true)) && json_decode($examination->body_condition, true)['normal'] == 'on') checked @endif>
                                                        <label class="form-check-label" for="normal">Normal</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="body_condition[overweight]" id="overweight" @if (isset($examination->body_condition) && array_key_exists('overweight', json_decode($examination->body_condition, true)) && json_decode($examination->body_condition, true)['overweight'] == 'on') checked @endif>
                                                        <label class="form-check-label" for="overweight">Overweight</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">General Appearance:</label>
                                                    <br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="general_appearance[active]" id="active" @if (isset($examination->general_appearance) && array_key_exists('active', json_decode($examination->general_appearance, true)) && json_decode($examination->general_appearance, true)['active'] == 'on') checked @endif>
                                                        <label class="form-check-label" for="active">Active</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="general_appearance[lethargic]" id="lethargic" @if (isset($examination->general_appearance) && array_key_exists('lethargic', json_decode($examination->general_appearance, true)) && json_decode($examination->general_appearance, true)['lethargic'] == 'on') checked @endif>
                                                        <label class="form-check-label" for="lethargic">Lethargic</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="general_appearance[unresponsive]" id="unresponsive" @if (isset($examination->general_appearance) && array_key_exists('unresponsive', json_decode($examination->general_appearance, true)) && json_decode($examination->general_appearance, true)['unresponsive'] == 'on') checked @endif>
                                                        <label class="form-check-label" for="unresponsive">Unresponsive</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="general_appearance[aggresive]" id="aggressive" @if (isset($examination->general_appearance) && array_key_exists('aggresive', json_decode($examination->general_appearance, true)) && json_decode($examination->general_appearance, true)['aggresive'] == 'on') checked @endif>
                                                        <label class="form-check-label" for="unresponsive">Aggressive</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                        <label class="form-label">Skin & Coat Condition:</label>
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="skin_coat_condition[healthy]" id="healthySkin" @if (isset($examination->skin_coat_condition) && array_key_exists('healthy', json_decode($examination->skin_coat_condition, true)) && json_decode($examination->skin_coat_condition, true)['healthy'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="healthySkin">Healthy</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="skin_coat_condition[dry]" id="dry" @if (isset($examination->skin_coat_condition) && array_key_exists('dry', json_decode($examination->skin_coat_condition, true)) && json_decode($examination->skin_coat_condition, true)['dry'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="dry">Dry</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="skin_coat_condition[flaky]" id="flaky" @if (isset($examination->skin_coat_condition) && array_key_exists('flaky', json_decode($examination->skin_coat_condition, true)) && json_decode($examination->skin_coat_condition, true)['flaky'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="flaky">Flaky</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="skin_coat_condition[hairLoss]" id="hairLoss" @if (isset($examination->skin_coat_condition) && array_key_exists('hairLoss', json_decode($examination->skin_coat_condition, true)) && json_decode($examination->skin_coat_condition, true)['hairLoss'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="hairLoss">Hair Loss</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="skin_coat_condition[parasites]" id="parasites" @if (isset($examination->skin_coat_condition) && array_key_exists('parasites', json_decode($examination->skin_coat_condition, true)) && json_decode($examination->skin_coat_condition, true)['parasites'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="parasites">Parasites Present</label>
                                                        </div>
                                                </div>

                                                <div class="col-md-6">
                                                        <label class="form-label">Eyes, Ears, Nose, & Throat:</label>
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="eyes_ears_nose_throat[clear]" id="clear" @if (isset($examination->eyes_ears_nose_throat) && array_key_exists('clear', json_decode($examination->eyes_ears_nose_throat, true)) && json_decode($examination->eyes_ears_nose_throat, true)['clear'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="clear">Clear</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="eyes_ears_nose_throat[discharge]" id="discharge" @if (isset($examination->eyes_ears_nose_throat) && array_key_exists('discharge', json_decode($examination->eyes_ears_nose_throat, true)) && json_decode($examination->eyes_ears_nose_throat, true)['discharge'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="discharge">Discharge</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="eyes_ears_nose_throat[redness]" id="redness" @if (isset($examination->eyes_ears_nose_throat) && array_key_exists('redness', json_decode($examination->eyes_ears_nose_throat, true)) && json_decode($examination->eyes_ears_nose_throat, true)['redness'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="redness">Redness</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="eyes_ears_nose_throat[swelling]" id="swelling" @if (isset($examination->eyes_ears_nose_throat) && array_key_exists('swelling', json_decode($examination->eyes_ears_nose_throat, true)) && json_decode($examination->eyes_ears_nose_throat, true)['swelling'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="swelling">Swelling</label>
                                                        </div>
                                                </div>

                                                <div class="col-md-6">
                                                        <label class="form-label">Mouth & Teeth:</label>
                                                    <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="mouth_teeth[healthy]" id="healthyMouth" @if (isset($examination->mouth_teeth) && array_key_exists('healthy', json_decode($examination->mouth_teeth, true)) && json_decode($examination->mouth_teeth, true)['healthy'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="healthyMouth">Healthy</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="mouth_teeth[tartar]" id="tartar" @if (isset($examination->mouth_teeth) && array_key_exists('tartar', json_decode($examination->mouth_teeth, true)) && json_decode($examination->mouth_teeth, true)['tartar'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="tartar">Tartar</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="mouth_teeth[gingivitis]" id="gingivitis" @if (isset($examination->mouth_teeth) && array_key_exists('gingivitis', json_decode($examination->mouth_teeth, true)) && json_decode($examination->mouth_teeth, true)['gingivitis'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="gingivitis">Gingivitis</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="mouth_teeth[missingTeeth]" id="missingTeeth" @if (isset($examination->mouth_teeth) && array_key_exists('missingTeeth', json_decode($examination->mouth_teeth, true)) && json_decode($examination->mouth_teeth, true)['missingTeeth'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="missingTeeth">Missing Teeth</label>
                                                        </div>
                                                </div>

                                                <div class="col-md-6">
                                                        <label class="form-label">Lymph Nodes:</label>
                                                    <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="lymph_nodes[normal]" id="normalNodes" @if (isset($examination->lymph_nodes) && array_key_exists('normal', json_decode($examination->lymph_nodes, true)) && json_decode($examination->lymph_nodes, true)['normal'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="normalNodes">Normal</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="lymph_nodes[swollen]" id="swollenNodes" @if (isset($examination->lymph_nodes) && array_key_exists('swollen', json_decode($examination->lymph_nodes, true)) && json_decode($examination->lymph_nodes, true)['swollen'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="swollenNodes">Swollen</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="lymph_nodes[enlarged]" id="enlargedNodes" @if (isset($examination->lymph_nodes) && array_key_exists('enlarged', json_decode($examination->lymph_nodes, true)) && json_decode($examination->lymph_nodes, true)['enlarged'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="enlargedNodes">Enlarged</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                        <label class="form-label">Cardiovascular System:</label>
                                                    <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="cardiovascular_system[normal]" id="normalHeart" @if (isset($examination->cardiovascular_system) && array_key_exists('normal', json_decode($examination->cardiovascular_system, true)) && json_decode($examination->cardiovascular_system, true)['normal'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="normalHeart">Normal</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="cardiovascular_system[murmurs]" id="murmurs" @if (isset($examination->cardiovascular_system) && array_key_exists('murmurs', json_decode($examination->cardiovascular_system, true)) && json_decode($examination->cardiovascular_system, true)['murmurs'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="murmurs">Murmurs</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="cardiovascular_system[irregularBeat]" id="irregularBeat" @if (isset($examination->cardiovascular_system) && array_key_exists('irregularBeat', json_decode($examination->cardiovascular_system, true)) && json_decode($examination->cardiovascular_system, true)['irregularBeat'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="irregularBeat">Irregular Heartbeat</label>
                                                        </div>
                                                </div>

                                                <div class="col-md-6">
                                                        <label class="form-label">Respiratory System:</label>
                                                    <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="respiratory_system[normal]" id="normalResp" @if (isset($examination->respiratory_system) && array_key_exists('normal', json_decode($examination->respiratory_system, true)) && json_decode($examination->respiratory_system, true)['normal'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="normalResp">Normal</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="respiratory_system[wheezing]" id="wheezing" @if (isset($examination->respiratory_system) && array_key_exists('wheezing', json_decode($examination->respiratory_system, true)) && json_decode($examination->respiratory_system, true)['wheezing'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="wheezing">Wheezing</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="respiratory_system[coughing]" id="coughing" @if (isset($examination->respiratory_system) && array_key_exists('coughing', json_decode($examination->respiratory_system, true)) && json_decode($examination->respiratory_system, true)['coughing'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="coughing">Coughing</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="respiratory_system[laboredBreathing]" id="laboredBreathing" @if (isset($examination->respiratory_system) && array_key_exists('laboredBreathing', json_decode($examination->respiratory_system, true)) && json_decode($examination->respiratory_system, true)['laboredBreathing'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="laboredBreathing">Labored Breathing</label>
                                                        </div>
                                                </div>

                                                <div class="col-md-6">
                                                        <label class="form-label">Digestive System:</label>
                                                    <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="digestive_system[normal]" id="normalDigestive" @if (isset($examination->digestive_system) && array_key_exists('normal', json_decode($examination->digestive_system, true)) && json_decode($examination->digestive_system, true)['normal'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="normalDigestive">Normal</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="digestive_system[bloating]" id="bloating" @if (isset($examination->digestive_system) && array_key_exists('bloating', json_decode($examination->digestive_system, true)) && json_decode($examination->digestive_system, true)['bloating'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="bloating">Bloating</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="digestive_system[vomiting]" id="vomiting" @if (isset($examination->digestive_system) && array_key_exists('vomiting', json_decode($examination->digestive_system, true)) && json_decode($examination->digestive_system, true)['vomiting'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="vomiting">Vomiting</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="digestive_system[diarrhea]" id="diarrhea" @if (isset($examination->digestive_system) && array_key_exists('diarrhea', json_decode($examination->digestive_system, true)) && json_decode($examination->digestive_system, true)['diarrhea'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="diarrhea">Diarrhea</label>
                                                        </div>
                                                </div>

                                                <div class="col-md-6">
                                                        <label class="form-label">Musculoskeletal System:</label>
                                                    <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="musculoskeletal_system[normal]" id="normalMusculo" @if (isset($examination->musculoskeletal_system) && array_key_exists('normal', json_decode($examination->musculoskeletal_system, true)) && json_decode($examination->musculoskeletal_system, true)['normal'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="normalMusculo">Normal</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="musculoskeletal_system[limping]" id="limping" @if (isset($examination->musculoskeletal_system) && array_key_exists('limping', json_decode($examination->musculoskeletal_system, true)) && json_decode($examination->musculoskeletal_system, true)['limping'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="limping">Limping</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="musculoskeletal_system[jointPain]" id="jointPain" @if (isset($examination->musculoskeletal_system) && array_key_exists('jointPain', json_decode($examination->musculoskeletal_system, true)) && json_decode($examination->musculoskeletal_system, true)['jointPain'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="jointPain">Joint Pain</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="musculoskeletal_system[muscleAtrophy]" id="muscleAtrophy" @if (isset($examination->musculoskeletal_system) && array_key_exists('muscleAtrophy', json_decode($examination->musculoskeletal_system, true)) && json_decode($examination->musculoskeletal_system, true)['muscleAtrophy'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="muscleAtrophy">Muscle Atrophy</label>
                                                        </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Neurological System:</label>
                                                    <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="neurological_system[normal]" id="normalNeuro" @if (isset($examination->neurological_system) && array_key_exists('normal', json_decode($examination->neurological_system, true)) && json_decode($examination->neurological_system, true)['normal'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="normalNeuro">Normal</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="neurological_system[seizures]" id="seizures"  @if (isset($examination->neurological_system) && array_key_exists('seizures', json_decode($examination->neurological_system, true)) && json_decode($examination->neurological_system, true)['seizures'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="seizures">Seizures</label>
                                                        </div>
                                                            <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="neurological_system[weakness]" id="weakness"  @if (isset($examination->neurological_system) && array_key_exists('weakness', json_decode($examination->neurological_system, true)) && json_decode($examination->neurological_system, true)['weakness'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="weakness">Weakness</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="neurological_system[uncoordinatedMovements]" id="uncoordinated"  @if (isset($examination->neurological_system) && array_key_exists('uncoordinatedMovements', json_decode($examination->neurological_system, true)) && json_decode($examination->neurological_system, true)['uncoordinatedMovements'] == 'on') checked @endif>
                                                            <label class="form-check-label" for="uncoordinated">Uncoordinated Movements</label>
                                                        </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">Other Notes:</label>
                                                    <div id="examination" class="mb-3" style="height: 400px;">
                                                        {{--                                            @if(isset($examination))  Heart Rate: {{$examination->heart_rate}}--}}
                                                        {{--                                            Respiration Rate: {{$examination->respiration_rate}}--}}
                                                        {{--                                            Weight: {{$examination->weight}}--}}
                                                        {{--                                            Length: {{$examination->length}}--}}
                                                        {{--                                            CRT: {{$examination->crt}}--}}
                                                        {{--                                            BCS: {{$examination->bcs}}--}}
                                                        {{--                                            Lymph Nodes: {{$examination->lymph_nodes}}--}}
                                                        {{--                                            Palpebral Reflex: {{$examination->palpebral_reflex}}--}}
                                                        {{--                                            Temperature: {{$examination->temperature}}--}}
                                                        {{--                                            @endif--}}
                                                        {!! $record->examination !!}
                                                    </div>
                                                    <textarea rows="3" class="mb-3 d-none" name="examination" id="examinationTextArea">
                                                        {!! $record->examination !!}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="diagnosisSection" style="display: none">
                                <div class="col-md-12">
                                    <div class="card shadow-none">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <span>Diagnosis</span>
{{--                                            <button class="btn-outline-primary btn" onclick="fillTemplate('diagnosis')">--}}
{{--                                                Fill Template--}}
{{--                                            </button>--}}
                                        </div>
                                        <div class="card-body">

                                            <div id="diagnosis" class="mb-3" style="height: 400px;">
                                                {!! $record->diagnosis !!}
                                            </div>
                                            <textarea rows="3" class="mb-3 d-none" name="diagnosis" id="diagnosisTextArea">
                                                {!! $record->diagnosis !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="treatmentSection" style="display: none">
                                <div class="row gy-3">
                                    <div class="col-md-12">
                                        <div class="card shadow-none mb-4">
                                            <div class="card-header">Medication Received</div>
                                            <div class="card-body" id="medications">
                                                <div class="row mb-2 gy-2 medication-entry gx-2">
                                                    <div class="col-md-4">
{{--                                                        <input type="text" class="form-control med-name" placeholder="Medication Name">--}}
                                                        <select class="form-control med-name select-med" style="width: 100%;">
                                                            <option value="">Select Medication</option>
                                                            @foreach ($medications as $medication)
                                                                <option value="{{ $medication->id }}">{{ $medication->product_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control med-dosage" placeholder="Dosage">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control med-frequency" placeholder="Frequency">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <select class="form-control form-select med-type">
                                                            <option value=""></option>
                                                            <option>Oral</option>
                                                            <option>IV (Intravenous)</option>
                                                            <option>IM (Intramuscular)</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <a href="" class="btn btn-primary add-med">+</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card shadow-none">
                                            <div class="card-header">Procedure Received</div>
                                            <div class="card-body" id="procedures">
                                                <div class="row mb-2 procedure-entry">
                                                    <div class="col-md-6">
                                                        <select class="form-control proc-name select-proc" style="width: 100%;">
                                                            <option value="">Select Procedure</option>
                                                            <option value="Blood Test">Blood Test</option>
                                                            <option value="X-Ray">X-Ray</option>
                                                            <option value="MRI Scan">MRI Scan</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control proc-outcome" placeholder="Outcome">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <a href="" class="btn btn-primary add-proc">+</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card shadow-none">
                                            <div class="card-header">Treatment Notes</div>
                                            <div class="card-body">
                                                <div id="treatmentnotes" class="mb-3" style="height: 200px;">

                                                </div>
                                                <textarea rows="3" class="mb-3 d-none" name="treatmentnotes" id="treatmentnotes">

                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="card shadow-none">--}}
{{--                                            <div class="card-header">Medication Given</div>--}}
{{--                                            <div class="card-body"><textarea name="medication_given" id="treatmentTextArea" cols="30"--}}
{{--                                                                             rows="10"--}}
{{--                                                                             class="form-control w-full">--}}
{{--                                            {!! $record->medication_given !!}--}}
{{--                                            </textarea></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="card shadow-none">--}}
{{--                                            <div class="card-header">Procedure Given</div>--}}
{{--                                            <div class="card-body"><textarea name="procedure_given" id="treatmentTextArea" cols="30"--}}
{{--                                                                             rows="10"--}}
{{--                                                                             class="form-control w-full">--}}
{{--                                            {!! $record->procedure_given !!}--}}

{{--                                            </textarea></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>

                            <div id="prescriptionSection" style="display: none">
                                <div class="col-md-12">
                                    <div class="card shadow-none">
                                        <div class="card-header">Prescription</div>
                                        <div class="card-body">
                                            <div class="prescriptions">
                                                <div class="row mb-2 gy-2 prescription-entry gx-2">
                                                    <!-- Medication Name -->
                                                    <div class="col-md-5">
                                                        <select class="form-control presc-name select-med">
                                                            <option value=""></option>
                                                            @foreach ($medications as $medication)
                                                                <option value="{{ $medication->id }}">{{ $medication->product_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!-- Dosage -->
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control presc-dosage" placeholder="Dosage">
                                                    </div>
                                                    <!-- Frequency -->
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control presc-frequency" placeholder="Frequency">
                                                    </div>
                                                    <!-- Duration -->
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control presc-duration" placeholder="Duration">
                                                    </div>
                                                    <!-- Add Button -->
                                                    <div class="col-md-1 d-flex align-items-center">
                                                        <a href="#" class="btn btn-primary add-med">+</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="othernotes mt-4">
                                                <label for="" class="text-primary mb-2">Notes:</label>
                                                <div id="prescription" class="mb-3" style="height: 400px;">
                                                    {!! $record->prescription !!}
                                                </div>
                                            </div>
                                            <textarea rows="3" class="mb-3 d-none" name="prescription" id="prescriptionTextArea">
                                                    {!! $record->prescription !!}
                                        </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="remarksSection" style="display: none">
                                <div class="col-md-12">
                                    <div class="card shadow-none">
                                        <div class="card-header">Remarks</div>
                                        <div class="card-body">
                                            <div id="remarks" class="mb-3" style="height: 400px;">
                                                {!! $record->prescription !!}
                                            </div>
                                            <textarea rows="3" class="mb-3 d-none" name="client_communication" id="clientCommunicationTextArea">
                                                {!! $record->prescription !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-header-actions shadow-none">
                                <div class="card-header">
                                    Record Information
                                    <div class="dropdown no-caret">
                                        <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="areaChartDropdownExample" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical text-gray-500"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></button>
                                        <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="areaChartDropdownExample" style="">
                                            <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal" data-bs-target="#editMedicalRecord"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Record</a>
                                            <hr class="mt-0">
                                            <a class="dropdown-item text-danger" href="#" type="button" data-bs-toggle="modal" data-bs-target="#archiveMedicalRecordModal"><i class="fa-solid fa-box-archive me-2"></i>Archive Record</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            Date Created
                                            <p class="text-primary">{{ \Carbon\Carbon::parse($record->record_date)->format('F d, Y h:i A') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            Status
                                            <p class="text-{{ $record->status == 0 ? 'warning' : ($record->status == 1 ? 'success' : 'danger') }}">
                                                {{ $record->status == 0 ? 'Ongoing' : ($record->status == 1 ? 'Completed' : 'Archived') }}
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            Subject
                                            <p class="text-primary">{{$record->subject}}</p>
                                        </div>
                                        <hr>
                                        <div class="col-md-12">
                                            @php
                                                $doctor = '';
                                                if (!is_null($record->doctorID)){
                                                $doctor = \App\Models\Doctor::getName($record->doctorID) ;

                                                }
                                            @endphp
                                            Veterinarian
                                            <p class="text-primary">
                                                Dr. {{$doctor ?? ''}}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            Pet Owner
                                            <p class="text-primary">{{$owner->client_name}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            Owner Contact No.
                                            <p class="text-primary">{{$owner->client_no}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-dark dropdown-toggle" id="printMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa-solid fa-print"></i> <span class="ms-2">Print</span>
                                        </button>
                                        <button class="btn btn-primary" type="submit" >
                                            <i class="fa-solid fa-floppy-disk"></i> <span class="ms-2">Save Record</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="printMenuButton">
                                            <a class="dropdown-item" href="dropdowns.html#!">Record</a>
                                            <a class="dropdown-item" href="dropdowns.html#!">Prescription</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="card shadow-none">
                            <div class="card-header">
                                Medical Information
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="small mb-1">Pet's Medical Condition</label>
                                        <div class="border rounded p-3 mb-3" style="min-height: 100px">{{$pet->pet_condition != null ? $pet->pet_condition : "No Conditions Recorded"}}</div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="small mb-1">Allergies</label>
                                        <div class="border rounded p-3 mb-3" style="min-height: 100px">{{$pet->food_allergies !=  null ? $pet->food_allergies : "No Allergies Recorded"}}</div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="small mb-1">History of Aggression</label>
                                        <div class="border rounded p-3 mb-3" style="min-height: 100px">
                                            {{$pet->history_of_aggression != null ? $pet->history_of_aggression : 'No History of Aggression Identified'}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
            <script>
                var toolbarOptions = [
                    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                    ['blockquote'],
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],          // Header levels
                    [{ 'indent': '-1' }, { 'indent': '+1' }],     // Indentation
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }], // Lists
                    [ 'link', 'image' ],                          // Links and images
                    ['clean']                                     // Clear formatting
                ];
                var quill = new Quill('#quill-editor', {
                    modules: {
                        toolbar: toolbarOptions,
                        imageResize: {
                            displaySize: true
                        },
                    },
                    theme: 'snow'
                });

                quill.on('text-change', function() {
                    document.getElementById('quill-editor-area').value = quill.root.innerHTML;
                });

                // Ensure textarea is updated before form submission
                document.querySelector("form").addEventListener("submit", function() {
                    document.getElementById('quill-editor-area').value = quill.root.innerHTML;
                });

                var examination = new Quill('#examination', {
                    modules: {
                        toolbar: toolbarOptions,
                        imageResize: {
                            displaySize: true
                        },
                    },
                    theme: 'snow'
                });

                examination.on('text-change', function() {
                    document.getElementById('examinationTextArea').value = examination.root.innerHTML;
                });

                // Ensure textarea is updated before form submission
                document.querySelector("form").addEventListener("submit", function() {
                    document.getElementById('examinationTextArea').value = examination.root.innerHTML;
                });

                var treatmentnotes = new Quill('#treatmentnotes', {
                    modules: {
                        toolbar: toolbarOptions,
                        imageResize: {
                            displaySize: true
                        },
                    },
                    theme: 'snow'
                });

                treatmentnotes.on('text-change', function() {
                    document.getElementById('treatmentnotes').value = treatmentnotes.root.innerHTML;
                });

                // Ensure textarea is updated before form submission
                document.querySelector("form").addEventListener("submit", function() {
                    document.getElementById('treatmentnotes').value = treatmentnotes.root.innerHTML;
                });

                var diagnosis = new Quill('#diagnosis', {
                    modules: {
                        toolbar: toolbarOptions,
                        imageResize: {
                            displaySize: true
                        },
                    },
                    theme: 'snow'
                });

                diagnosis.on('text-change', function() {
                    document.getElementById('diagnosisTextArea').value = diagnosis.root.innerHTML;
                });

                // Ensure textarea is updated before form submission
                document.querySelector("form").addEventListener("submit", function() {
                    document.getElementById('diagnosisTextArea').value = diagnosis.root.innerHTML;
                });

                var remarks = new Quill('#remarks', {
                    modules: {
                        toolbar: toolbarOptions,
                        imageResize: {
                            displaySize: true
                        },
                    },
                    theme: 'snow'
                });

                remarks.on('text-change', function() {
                    document.getElementById('clientCommunicationTextArea').value = remarks.root.innerHTML;
                });

                // Ensure textarea is updated before form submission
                document.querySelector("form").addEventListener("submit", function() {
                    document.getElementById('clientCommunicationTextArea').value = remarks.root.innerHTML;
                });

                var prescription = new Quill('#prescription', {
                    modules: {
                        toolbar: toolbarOptions,
                        imageResize: {
                            displaySize: true
                        },
                    },
                    theme: 'snow'
                });

                prescription.on('text-change', function() {
                    document.getElementById('prescriptionTextArea').value = prescription.root.innerHTML;
                });

                // Ensure textarea is updated before form submission
                document.querySelector("form").addEventListener("submit", function() {
                    document.getElementById('prescriptionTextArea').value = prescription.root.innerHTML;
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const tabs = document.querySelectorAll('.nav-tab');
                    const cards = {
                        'general': document.getElementById('generalSection'),
                        'examination': document.getElementById('examinationSection'),
                        'diagnosis': document.getElementById('diagnosisSection'),
                        'treatment': document.getElementById('treatmentSection'),
                        'prescription': document.getElementById('prescriptionSection'),
                        'remarks': document.getElementById('remarksSection')
                    };

                    // Function to activate a specific tab and show its corresponding card
                    const activateTab = (tabId) => {
                        // Remove active class from all tabs
                        tabs.forEach(tab => tab.classList.remove('active'));

                        // Hide all cards
                        Object.values(cards).forEach(card => card.style.display = 'none');

                        // Activate the target tab and show its card
                        const targetTab = document.querySelector(`.nav-tab[href="#${tabId}"]`);
                        if (targetTab) {
                            targetTab.classList.add('active');
                            if (cards[tabId]) {
                                cards[tabId].style.display = 'block'; // Show the target card
                            }
                        }
                    };

                    // Initialize based on the URL hash or default to 'general'
                    const initialTab = window.location.hash.substring(1) || 'general';
                    activateTab(initialTab);

                    // Add click event listeners to tabs
                    tabs.forEach(tab => {
                        tab.addEventListener('click', function (e) {
                            e.preventDefault(); // Prevent the default scroll behavior

                            const targetCard = tab.getAttribute('href').substring(1);

                            // // Update the URL hash without scrolling
                            // history.pushState(null, null, `#${targetCard}`);

                            // Activate the clicked tab
                            activateTab(targetCard);
                        });
                    });
                });
            </script>
<script src="{{ asset('js/soap.js') }}"></script>
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


    document.querySelectorAll('.select-dropdown-menu').forEach(menu => {
        // Handle dropdown item clicks
        menu.querySelectorAll('.select-dropdown-item').forEach(item => {
            item.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default anchor behavior

                // Find the related button using the aria-labelledby attribute
                const buttonId = menu.getAttribute('aria-labelledby');
                const button = document.querySelector(`#${buttonId}`);

                if (button) {
                    // Remove the data-selected attribute from all items
                    menu.querySelectorAll('.select-dropdown-item').forEach(i => i.setAttribute('data-selected', 'false'));

                    // Set the selected item and update the button text
                    this.setAttribute('data-selected', 'true');
                    button.textContent = this.textContent;

                    // Optionally, you can close the dropdown after selection
                    $(button).dropdown('toggle');
                } else {
                    console.error('Button not found for the dropdown menu.');
                }
            });
        });

        // Set the default selected item based on data-selected attribute
        const buttonId = menu.getAttribute('aria-labelledby');
        const button = document.querySelector(`#${buttonId}`);

        if (button) {
            const defaultItem = menu.querySelector('.select-dropdown-item[data-selected="true"]');

            if (defaultItem) {
                button.textContent = defaultItem.textContent;
            } else {
                console.error('Default selected item not found in the dropdown menu.');
            }
        } else {
            console.error('Button not found for the dropdown menu.');
        }
    });
</script>
            <script>

                $(document).ready(function () {
                    // Add new prescription entry
                    $(document).on('click', '.add-med', function (event) {
                        event.preventDefault();

                        let lastEntry = $('.prescriptions .prescription-entry').last();
                        let name = lastEntry.find('.presc-name').val().trim();
                        let dosage = lastEntry.find('.presc-dosage').val().trim();
                        let frequency = lastEntry.find('.presc-frequency').val().trim();
                        let duration = lastEntry.find('.presc-duration').val().trim();

                        if (name !== "" && dosage !== "" && frequency !== "" && duration !== "") {
                            $('.prescriptions').find('.text-danger').remove(); // Clear previous error
                            $('.prescriptions').append(`
                    <div class="row mb-2 gy-2 prescription-entry gx-2">
                        <div class="col-md-5">
                            <select class="form-control presc-name select-presc">
                                @foreach ($medications as $medication)
                                    <option value="{{ $medication->id }}">{{ $medication->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control presc-dosage" placeholder="Dosage">
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control presc-frequency" placeholder="Frequency">
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control presc-duration" placeholder="Duration">
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <a href="#" class="btn btn-danger remove-presc">-</a>
                        </div>
                    </div>
                `);
                        } else {
                            if ($('.prescriptions').find('.text-danger').length === 0) {
                                let error = $('<div class="text-danger mt-2">Please fill in all fields before adding another prescription.</div>');
                                $('.prescriptions').append(error);

                                setTimeout(() => {
                                    error.fadeOut(500, function () {
                                        $(this).remove();
                                    });
                                }, 4000);
                            }
                        }
                    });

                    // Remove prescription entry
                    $(document).on('click', '.remove-presc', function (event) {
                        event.preventDefault();
                        $(this).closest('.prescription-entry').remove();
                        $('.prescriptions').find('.text-danger').remove(); // Clear error
                    });
                });


                $(document).ready(function () {
                    // Medication field validation
                    $('.add-med').click(function () {
                        event.preventDefault();
                        let lastEntry = $('#medications .medication-entry').last();
                        let name = lastEntry.find('.med-name').val().trim();
                        let dosage = lastEntry.find('.med-dosage').val().trim();
                        let type = lastEntry.find('.med-type').val().trim();

                        if (name !== "" && dosage !== "" && type !== "") {
                            $('#medications').append(`
                        <div class="row mb-2 gy-2 medication-entry gx-2">
                            <div class="col-md-4">
                                   <select class="form-control med-name select-med" style="width: 100%;">
                                    <option value="">Select Medication</option>
                                    @foreach ($medications as $medication)
                                        <option value="{{ $medication->id }}">{{ $medication->product_name }}</option>
                                    @endforeach
                              </select>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control med-dosage" placeholder="Dosage">
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control med-frequency" placeholder="Frequency">
                            </div>
                            <div class="col-md-3">
                                <select class="form-control form-select med-type">
                                    <option value="">Medication Type</option>
                                    <option>Oral</option>
                                    <option>IV</option>
                                    <option>IM</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <a href="" class="btn btn-danger remove-med">-</a>
                            </div>
                        </div> `);

                            $(".select-med").select2({
                                theme: "bootstrap-5",
                                tags: true,  // Allow users to add new values
                                placeholder: "Select or type medication",
                                allowClear: true
                            });

                            $(".med-type").select2({
                                theme: "bootstrap-5",
                                minimumResultsForSearch: -1,
                                placeholder: "Medication Type",
                            });

                            $('#medications').find('.text-danger').remove(); // Remove error message when new row is added
                        } else {
                            if ($('#medications').find('.text-danger').length === 0) {
                                let errorMsg = $('<div class="text-danger mt-3">Please fill in all fields before adding a new entry.</div>');
                                $('#medications').append(errorMsg);

                                setTimeout(function () {
                                    errorMsg.fadeOut(500, function () {
                                        $(this).remove();
                                    });
                                }, 5000);
                            }
                        }
                    });

                    $(document).on('click', '.remove-med', function () {
                        event.preventDefault();
                        $(this).closest('.medication-entry').remove();
                        $('#medications').find('.text-danger').remove(); // Remove error if fields are cleared
                    });

                    $('.add-proc').click(function (event) {
                        event.preventDefault(); // Prevents page reload

                        let lastEntry = $('#procedures .procedure-entry').last();
                        let procName = lastEntry.find('.proc-name').val().trim();
                        let procOutcome = lastEntry.find('.proc-outcome').val().trim();

                        if (procName !== "") {
                            $('#procedures .text-danger').remove(); // Remove existing error message

                            $('#procedures').append(`
                                <div class="row mb-2 procedure-entry">
                                    <div class="col-md-6">
                                        <select class="form-control proc-name select-proc" style="width: 100%;">
                                            <option value="">Select Procedure</option>
                                            <option value="Blood Test">Blood Test</option>
                                            <option value="X-Ray">X-Ray</option>
                                            <option value="MRI Scan">MRI Scan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control proc-outcome" placeholder="Outcome">
                                    </div>
                                    <div class="col-md-1">
                                        <a href="#" class="btn btn-danger remove-procedure">-</a>
                                    </div>
                                </div>
                            `);

                            $(".select-proc").select2({
                                theme: "bootstrap-5",
                                tags: true,  // Allow users to add new values
                                placeholder: "Select or type procedure",
                                allowClear: true
                            });
                        } else {
                            if (procName === "") {
                                if ($('#procedures .text-danger').length === 0) {
                                    let errorMsg = $('<div class="text-danger mt-3">Please fill in the procedure name before adding a new entry.</div>');
                                    $('#procedures').append(errorMsg);

                                    setTimeout(function () {
                                        errorMsg.fadeOut(500, function () {
                                            $(this).remove();
                                        });
                                    }, 5000);
                                }
                            } else {
                                $('#procedures .text-danger').remove(); // Remove error if the procedure name is filled
                            }
                        }
                    });

                    // Remove procedure entry
                    $(document).on('click', '.remove-procedure', function (event) {
                        event.preventDefault(); // Prevents page reload
                        $(this).closest('.procedure-entry').remove();

                        // Remove error message if there are no more entries
                        if ($('#procedures .procedure-entry').length === 0) {
                            $('#procedures .text-danger').remove();
                        }
                    });
                });
            </script>

@endsection
