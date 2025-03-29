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
                    <li class="breadcrumb-item active">Pet Record</li>
                </ol>
            </nav>
        </div>
    </div>
</header>



<!-- Main page content-->
<div class="container-xl px-4 mt-4">

    <nav class="nav nav-borders">
        <a class="nav-link ms-0" href="javascript:void(0);" onclick="window.history.back();">
            <span class="px-2"><i class="fa-solid fa-arrow-left"></i></span> Back
        </a>
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
                                    Birthdate
                                    <p class="">{{ \Carbon\Carbon::parse($pet->pet_birthdate)->format('F d, Y') }}</p>
                                </div>
                                <div class="col-md-3">
                                    Weight
                                    <p class="">{{$pet->pet_weight}} kg</p>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1">Spayed/Neutered</label>
                                    <p>
                                        {{$pet->neutered == 1 ? 'Yes' : 'No'}}
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1">Vaccinated with Anti-Rabies?</label>
                                    <p>
                                        {{$pet->vaccinated_anti_rabies == 1 ? 'Yes' : 'No'}}
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1">Date of Anti-Rabies Vaccination</label>
                                    <p>{{ $pet->anti_rabies_vaccination_date ? \Carbon\Carbon::parse($pet->anti_rabies_vaccination_date)->format('F j, Y') : 'Incomplete'}}</p>
                                </div>
                                <div class="col-md-9">
                                    <label class="small mb-1">Okay to give treats?</label>
                                    <p> {{$pet->okay_to_give_treats == 1 ? 'Yes' : 'No'}}</p>
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
                                <a class="nav-link nav-tab active {{ request()->is('general') ? 'active' : '' }}" href="#general">Complaint</a>
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
                                        <div class="card-header">Complaint</div>
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
                                            <button class="btn-outline-primary btn" type="button"
                                                    onclick="fillTemplate('examination')">Fill Template
                                            </button>
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

                            <div id="diagnosisSection" style="display: none">
                                <div class="col-md-12">
                                    <div class="card shadow-none">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <span>Diagnosis</span>
                                            <button class="btn-outline-primary btn" onclick="fillTemplate('diagnosis')">
                                                Fill Template
                                            </button>
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
                                        <div class="card shadow-none">
                                            <div class="card-header">Medication Given</div>
                                            <div class="card-body"><textarea name="medication_given" id="treatmentTextArea" cols="30"
                                                                             rows="10"
                                                                             class="form-control w-full">
                                            {!! $record->medication_given !!}
                                            </textarea></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card shadow-none">
                                            <div class="card-header">Procedure Given</div>
                                            <div class="card-body"><textarea name="procedure_given" id="treatmentTextArea" cols="30"
                                                                             rows="10"
                                                                             class="form-control w-full">
                                            {!! $record->procedure_given !!}

                                            </textarea></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="prescriptionSection" style="display: none">
                                <div class="col-md-12">
                                    <div class="card shadow-none">
                                        <div class="card-header">Prescription</div>
                                        <div class="card-body">
                                            <div id="prescription" class="mb-3" style="height: 400px;">
                                                {!! $record->prescription !!}
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
                            <div class="card shadow-none">
                                <div class="card-header">
                                    Record Information
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            Date Created
                                            <p class="text-primary">{{\Carbon\Carbon::parse($record->record_date)->format('F d, Y')}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            Status
                                            <p class="text-primary">Completed</p>
                                        </div>
                                        <div class="col-md-12">
                                            Subject
                                            <p class="text-primary">The Subject of this pet record</p>
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
                                            Pet
                                            <p class="text-primary">{{$pet->pet_name}}</p>
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

@endsection
