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
                                    <td>  {{ sprintf("VETIS-%05d", $vet->id) }}</td>
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
                            reason_for_return: 'dummy reaseon',
                            status: 'ongoing'
                            })">
                                <td>1</td>
                                <td>Deworming</td>
                                <td>500.00</td>
                            </tr>
                            <tr data-bs-toggle="modal" data-bs-target="" style="cursor: pointer;">
                                <td>2</td>
                                <td>Vaccination</td>
                                <td>500.00</td>
                            </tr>
                            <tr data-bs-toggle="modal" data-bs-target="" style="cursor: pointer;">
                                <td>3</td>
                                <td>Grooming</td>
                                <td>200.00</td>
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

    <!-- Service Plan  Edit Modal -->
    <div class="modal fade" id="servicePlanEditModal" tabindex="-1" role="dialog"
         aria-labelledby="myExtraLargeModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa-solid fa-kit-medical me-1"></i> Service Name</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="" class="text-sm fw-400">Date Return</label>
                    <input type="date" name="" id="" class="form-control">
                    <label for="" class="mt-3 text-sm fw-400">Reason for Return</label>
                    <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                    <div class="dropdown mt-3 mb-2">
                        <label for="" class="text-sm fw-400">Status</label>
                        <button class="form-select d-flex justify-between" id="serviceStatusMenuButton" type="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Status
                        </button>
                        <div class="select-dropdown-menu dropdown-menu" aria-labelledby="serviceStatusMenuButton">
                            <a class="select-dropdown-item dropdown-item" href="#" data-selected="true" data-value="1">Upcoming</a>
                            <a class="select-dropdown-item dropdown-item" href="#" data-value="2">Completed</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-1">
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="serviceDeleteConfirmationModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa-solid fa-trash me-2"></i>Delete
                        Service</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the selected service <span
                            class="text-primary">'[Service Name]'</span>?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button"
                            data-bs-dismiss="modal">Cancel
                    </button>
                    <a href=""
                       class="btn btn-danger" type="button">Delete</a></div>
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
                        <li class="breadcrumb-item active">SOAP Record</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>




    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">

        <nav class="nav nav-borders">
            <a class="nav-link ms-0" href=""><span class="px-2"><i class="fa-solid fa-arrow-left"></i></span> Back</a>
        </nav>
        <hr class="mt-0 mb-4">

        <div class="row">
            <div class="col-md-12">
                <!-- Account details card-->
                    <div class="card mb-4 shadow-none">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>SOAP Record</span>
                            <!-- Mo gawas rang print dropdown if ma save na -->
                            <div class="dropdown">
                                <button class="btn btn-outline-dark dropdown-toggle" id="printMenuButton" type="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Print
                                    Record
                                </button>
                                <div class="dropdown-menu" aria-labelledby="printMenuButton">
                                    <a class="dropdown-item" href="dropdowns.html#!">SOAP</a>
                                    <a class="dropdown-item" href="dropdowns.html#!">Prescription</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card mb-4 shadow-none">
                                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <span>General</span>
                                </div>
                                <div class="card-body bg-white">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <span class="text-primary fw-500">Information</span>
                                            <hr class="mt-0">
                                            <div class="row gy-3">
                                                <div class="col-12">
                                                    <label for="">SOAP ID</label>
                                                    <input type="text" class="form-control bg-gray-100"
                                                           value="{{sprintf("VETISSOAP-%05d",$record->id)}}"
                                                           disabled>
                                                </div>
                                                <div class=" col-12">
                                                    <div class="dropdown">
                                                        <label for="">Status</label>
                                                        <button class="form-select d-flex justify-between"
                                                                id="dropdownMenuButton" type="button"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"
                                                                disabled>{{($record->status == 1) ? "Filled" : "Ongoing"}}
                                                        </button>
                                                        <div class="select-dropdown-menu dropdown-menu"
                                                             aria-labelledby="dropdownMenuButton">
                                                            <a class="select-dropdown-item dropdown-item" href="#"
                                                               data-selected="true" data-value="1">Filed</a>
                                                            <a class="select-dropdown-item dropdown-item" href="#"
                                                               data-value="2">Ongoing</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="">Date</label>
                                                    <input type="date" class="form-control" name="date"
                                                           value="{{$record->record_date}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="text-primary fw-500">Patient Information</span>
                                            <hr class="mt-0">
                                            <div class="row gy-3">
                                                <div class="col-12">
                                                    <div class="dropdown">
                                                        <label for="">Type</label>
                                                        @php
                                                            $consultation_type =  [
                                                                1=> "Walk-In"  ,
                                                                2=> "Consultation"  ,
                                                                3=> "Vaccination",
                                                                4=> "Surgery"
                                                            ];
                                                        @endphp
                                                        <button class="form-select d-flex justify-between" id="soapType"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false"
                                                                disabled>{{$consultation_type[$record->consultation_type] }}
                                                        </button>
                                                        <div class="dropdown-menu select-dropdown-menu"
                                                             aria-labelledby="soapType">
                                                            <a class="dropdown-item select-dropdown-item" href="#"
                                                               data-value="1">Walk-In</a>
                                                            <a class="dropdown-item select-dropdown-item" href="#"
                                                               data-value="2">Consultation</a>
                                                            <a class="dropdown-item select-dropdown-item" href="#"
                                                               data-value="3">Vaccination</a>
                                                            <a class="dropdown-item select-dropdown-item" href="#"
                                                               data-value="4">Surgery</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    @php
                                                        $doctor = \App\Models\Doctor::getDoctorById($record->doctorID)
                                                    @endphp
                                                    <label for="">Attending Veterinarian</label>
                                                    <button class="form-control d-flex justify-content-between"
                                                            type="button" data-bs-toggle="modal"
                                                            data-bs-target="#veterinarianListModal" disabled><span
                                                            id="vet">{{$doctor->firstname." ".$doctor->lastname}}</span>
                                                        <i class="fa-solid fa-user-doctor"></i></button>
                                                </div>
                                                <div class="col-12">
                                                    <label for="">Pet Owner</label>
                                                    <button class="form-control d-flex justify-content-between"
                                                            type="button" data-bs-toggle="modal"
                                                            data-bs-target="#petOwnerListModal" disabled>
                                                        <span>{{$owner->client_name}}</span> <i
                                                            class="fa-solid fa-user"></i></button>
                                                </div>
                                                <div class="col-12">
                                                    <label for="">Pet</label>
                                                    <button class="form-control d-flex justify-content-between"
                                                            type="button" data-bs-toggle="modal"
                                                            data-bs-target="#petListModal" disabled>
                                                        <span>{{$pet->pet_name}}</span> <i class="fa-solid fa-cat"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-3">
                                <div class="col-md-12">
                                    <div class="card shadow-none">
                                        <div class="card-header">Primary Complaint/History</div>
                                        <div class="card-body"><textarea name="complaint" id="" cols="30" rows="10"
                                                                         class="form-control w-full">{{$record->complaint}}</textarea>
                                        </div>
                                    </div>
                                </div>
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
                                        <div class="card-body"><textarea name="examination" id="examinationTextArea" cols="30" rows="10"
                                                                         class="form-control w-full"></textarea></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card shadow-none">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <span>Laboratory/Interpretation</span>
                                            <button class="btn-outline-primary btn">Add</button>
                                        </div>
                                        <div class="row gy-3 mt-2 mb-4">
                                            <!-- Laboratory File -->
                                            <div class="col-12">
                                                <div class="card shadow-none mx-3">
                                                    <div class="row p-3">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="formFile" class="form-label">Upload</label>
                                                                <input class="form-control" type="file" id="formFile">
                                                            </div>
                                                            <div
                                                                class="card shadow-none p-2 d-flex justify-content-center align-items-center">
                                                                <img
                                                                    src="https://t3.ftcdn.net/jpg/07/23/05/68/360_F_723056816_irMoAo8SFXjh9PNlT9kb7FUePA73JzK7.jpg"
                                                                    alt=""
                                                                    style="max-width: auto; max-height: 200px; object-fit: contain;">
                                                            </div>
                                                        </div>
                                                        <div class=" col-md-8">
                                                            <div class="row">
                                                                <label class="form-label">Remark</label>
                                                                <div class="col">
                                                                    <textarea name="" id="" cols="30" rows="18"
                                                                              class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card-footer d-flex py-3 justify-content-end align-items-center bg-white">
                                                        <button class="btn btn-outline-danger">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mx-3 mb-4 px-1">
                                            <span class="text-primary fw-500">Interpretation</span>
                                            <textarea name="" id="interpretationTextField" cols="30" rows="10"
                                                      class="form-control mt-2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card shadow-none">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <span>Plan</span>
                                            <button class="btn-outline-primary btn" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#serviceListModal">Add Services
                                            </button>
                                        </div>
                                        <div class="px-4">
                                            <table id="treatmentPlanTable">
                                                <thead>
                                                <tr>
                                                    <th>Service</th>
                                                    <th>Date Return</th>
                                                    <th>Reason for Return</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody id="treatmentPlanTableBody">
                                                {{--                                            <tr>--}}
                                                {{--                                                <!-- sample if no need na mag return -->--}}
                                                {{--                                                <td>Deworming</td>--}}
                                                {{--                                                <td>...</td>--}}
                                                {{--                                                <td>...</td>--}}
                                                {{--                                                <td>...</td>--}}
                                                {{--                                                <td>--}}
                                                {{--                                                    <button class="btn btn-success" href="#" type="button" data-bs-toggle="modal" data-bs-target="#servicePlanEditModal"><i class="fa-solid fa-edit"></i></button>--}}
                                                {{--                                                    <button class="btn btn-danger" href="#" type="button" data-bs-toggle="modal" data-bs-target="#serviceDeleteConfirmationModal"><i class="fa-solid fa-trash"></i></button>--}}
                                                {{--                                                </td>--}}
                                                {{--                                            </tr>--}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card shadow-none">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <span>Diagnosis</span>
                                            <button class="btn-outline-primary btn" onclick="fillTemplate('diagnosis')">
                                                Fill Template
                                            </button>
                                        </div>
                                        <div class="card-body"><textarea name="diagnosis" id="diagnosisTextArea" cols="30" rows="10"
                                                                         class="form-control w-full"></textarea></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card shadow-none">
                                        <div class="card-header">Treatment</div>
                                        <div class="card-body"><textarea name="treatment" id="treatmentTextArea" cols="30" rows="10"
                                                                         class="form-control w-full"></textarea></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card shadow-none">
                                        <div class="card-header">Prescription</div>
                                        <div class="card-body"><textarea name="prescription" id="prescriptionTextArea" cols="30" rows="10"
                                                                         class="form-control w-full"></textarea></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card shadow-none">
                                        <div class="card-header">Client Communication</div>
                                        <div class="card-body"><textarea name="client_communication" id="clientCommunicationTextArea" cols="30"
                                                                         rows="10"
                                                                         class="form-control w-full"></textarea></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <form action="{{route('soap.update', ['id' => $pet->id,'recordID' => $record->id ])}}" method="post" id="updateForm" >
                                @csrf
                                <input type="hidden" value="" name="examination" id="examination" >
                                <input type="hidden" value="" name="interpretation" id="interpretation">
                                <input type="hidden" value="" name="diagnosis" id="diagnosis">
                                <input type="hidden" value="" name="treatment" id="treatment">
                                <input type="hidden" value="" name="prescription" id="prescription">
                                <input type="hidden" value="" name="client_communication" id="client_communication">
                            <button class="btn btn-primary" type="button" onclick="submitTextFields()"><i class="fa-solid fa-floppy-disk"></i> <span class="ms-2">Save Record</span>
                            </button>
                            </form>
                            <!-- Only shows pag na save na -->
                            <!-- <button class="btn btn-outline-dark"><i class="fa-solid fa-pen-to-square"></i> <span class="ms-2">Update Record</span></button> -->
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/soap.js') }}"></script>
    <script>
        document.querySelectorAll('.select-dropdown-menu').forEach(menu => {
            // Handle dropdown item clicks
            menu.querySelectorAll('.select-dropdown-item').forEach(item => {
                item.addEventListener('click', function (event) {
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
