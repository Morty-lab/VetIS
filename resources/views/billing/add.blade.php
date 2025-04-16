@extends('layouts.app')

@section('styles')

@endsection

@section('content')

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true"  data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card shadow-none">
                                <div class="card-body pb-0">
                                    <h1 class="mb-3 fw-400">Pruderich Veterinary Clinic</h1>
                                    <div class="d-flex justify-content-between">
                                        <div class="gy-2">
                                            <p class="mb-0">Purok - 3, Dologon, Maramag, Bukidnon</p>
                                            <p class="">+63 917 620 0620</p>
                                        </div>
                                        <div class="text-end">
                                            @php
                                                $latestRecord = \App\Models\Billing::latest('id')->first();
                                                $selectedOwnerID = 0;
                                            @endphp
                                            <p class="mb-0">Transaction No.@if($latestRecord != null){{sprintf("%05d",$latestRecord->id +1)}} @else {{sprintf("%05d",1)}} @endif</p>
                                            <p class="mb-0">{{\Carbon\Carbon::now()->format('F d, Y')}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row gy-3">
                                        <div class="col-md-6">
                                            <label for="owner" class="form-label">Name</label>
                                            <div class="">Juan Dela Cruz</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="owner" class="form-label">Veterinarian</label>
                                            <div class="">Jane Doe</div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Address</label>
                                            <div class="">Purok - 3, Batangan, Valencia City, Bukidnon</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <div class="">email@email.com</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Phone Number</label>
                                            <div class="">09123456789</div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                                            <label for="payable" class="form-label">Sub Total</label>
                                            <p id="payable" class="">₱0</p>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                                            <label for="payable" class="form-label">Discount</label>
                                            <p id="payable" class="">₱0</p>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                                            <label for="payable" class="form-label">Total</label>
                                            <p id="payable" class="text-primary fw-bold text-xl mb-0">₱0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <form id="paymentForm">
                                <!-- Payment Type -->
                                <div class="row gy-3" style="display:none">
                                    <div class="col-md-6">
                                            <label for="paymentType" class="form-label">Payment Type</label>
                                            <select class="form-select" id="paymentType" name="payment_type" required>
                                                <option value="">-- Select Payment Type --</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Partial">Partial Payment</option>
                                            </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="paymentType" class="form-label">Apply Discount</label>
                                        <select class="form-select" id="paymentType" name="payment_type" required>
                                            <option value="">-- Select Discount --</option>
                                            <option value="Cash">Student Discount (P1000)</option>
                                            <option value="Partial">Senior Discount (5%)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <!-- Joined input group prepend example-->
                                        <label for="cashGiven" class="form-label">Cash Given</label>
                                        <div class="input-group">
                                             <span class="input-group-text">
                                                ₱
                                            </span>
                                            <input type="number" class="form-control" id="cashGiven" name="cash_given" min="0" step="0.01" required>
                                        </div>
                                    </div>
                                    <!-- Due Date (only for Partial Payment) -->
                                    <div class="mb-3 d-none" id="dueDateContainer">
                                        <label for="dueDate" class="form-label">Due Date</label>
                                        <input type="date" class="form-control" id="dueDate" name="due_date">
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary w-100">Enter</button>
                                    </div>
                                </div>
{{-- Basta ma submit na then successfull mo open sa new tab ang invoice sa billing--}}
                                <div style="" id="change">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h1 class="fw-500 text-primary">
                                                Thank you for your Purchase!
                                            </h1>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Total:</p>
                                                <p class="text-lg mb-0 fw-400 grand-total">500</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Cash Given:</p>
                                                <p class="text-lg mb-0 fw-400 " id="cash">1000</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Change:</p>
                                                <p class="display-6 text-blue mb-0 h5 fw-500 " id="change-cash">500</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('paymentType').addEventListener('change', function () {
            const dueDateContainer = document.getElementById('dueDateContainer');
            if (this.value === 'Partial') {
                dueDateContainer.classList.remove('d-none');
                document.getElementById('dueDate').setAttribute('required', 'required');
            } else {
                dueDateContainer.classList.add('d-none');
                document.getElementById('dueDate').removeAttribute('required');
            }
        });
    </script>

    <!-- Select Medication Modal -->
    <div class="modal fade" id="selectMedicationModal" tabindex="-1" role="dialog" aria-labelledby="selectMedication"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Medication</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card shadow-none pt-2 pb-2 px-3 rounded-3">
                        <table class="table" id="medListTable">
                            <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Medication</th>
                                <th>Category</th>
                                <th>Stocks</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>10290870</td>
                                        <td>Royal Canin Size Health Nutrition Adult Medium 7+ Dry Dog Food 4kg</td>
                                        <td><span class="badge bg-light text-body text-sm rounded-pill mb-1">Dog Food</span> <span class="badge bg-light text-body text-sm rounded-pill mb-1">Feast</span> <span class="badge bg-light text-body text-sm rounded-pill mb-1">Cat Treats</span> </td>
                                        <td><span class="badge bg-success-soft text-success rounded-pill text-sm">In Stock</span></td>
                                        <td>1,750.00</td>
                                        <td>
                                            <button class="btn btn-primary btn-datatable px-5 py-3" data-bs-toggle="modal"
                                                    data-bs-target="#itemQty">Select</button>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Select Service Modal -->
    <div class="modal fade" id="selectServiceModal" tabindex="-1" role="dialog" aria-labelledby="selectServiceModal"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Service</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card shadow-none pt-2 pb-2 px-3 rounded-3">
                        <table class="table" id="serviceListTable">
                            <thead>
                            <tr>
                                <th>Service</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Cat Vaccination</td>
                                <td>1,750.00</td>
                                <td>
                                    <button class="btn btn-primary btn-datatable px-5 py-3" data-bs-toggle="modal"
                                            data-bs-target="#serviceQty">Select</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--  Medication Qty --}}
    <div class="modal fade" id="itemQty" tabindex="-1" role="dialog" aria-labelledby="itemQty"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-2">
                        <div class="col-md-6">
                            <label class="small mb-1">Medication</label>
                            <p class="mb-0">Royal Canin Size Health Nutrition Adult Medium 7+ Dry Dog Food 4kg</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Price</label>
                            <div class="">
                                <p class="mb-0 fw-bold text-primary">
                                    ₱1,750.00
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Barcode</label>
                            <div class="">
                                <p class="mb-0">10290870</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Category</label>
                            <div class="">
                                <span class="badge bg-light text-body text-sm rounded-pill mb-1">Dog Food</span> <span class="badge bg-light text-body text-sm rounded-pill mb-1">Feast</span> <span class="badge bg-light text-body text-sm rounded-pill mb-1">Cat Treats</span>
                            </div>
                        </div>
                        <hr class="mt-3 mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="" class="mb-1">Enter Quantity</label>
                            <input type="number" id="quantityInput" class="form-control" placeholder="Enter Quantity" min="1" max="10" step="1" required>
                        </div>
                        <div class="col-md-12">
                            <label for="" class="mb-1">Who is this Medication for?</label>
                            <select class="form-select" id="pet" name="pet" required>
                                <option value="" disabled selected>Select a pet</option>
                                @foreach($owner as $o)
                                    <option value="{{ $o->id }}">{{ $o->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal"
                            onclick="">Add Medication</button>
                </div>
            </div>
        </div>
    </div>

    {{--  Service Qty --}}
    <div class="modal fade" id="serviceQty" tabindex="-1" role="dialog" aria-labelledby="serviceQty"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-2">
                        <div class="col-md-6">
                            <label class="small mb-1">Service</label>
                            <p class="mb-0">Cat Vaccination</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Price</label>
                            <div class="">
                                <p class="mb-0 fw-bold text-primary">
                                    ₱1,750.00
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Veterinarian</label>
                            <div class="">
                                <p class="mb-0">
                                    Jane Doe
                                </p>
                            </div>
                        </div>
                        <hr class="mt-3 mb-2">
                        <div class="col-md-12">
                            <label for="" class="mb-1">Who is this Service for?</label>
                            <select class="form-select" id="pet" name="pet" required>
                                <option value="" disabled selected>Select a pet</option>
                                @foreach($owner as $o)
                                    <option value="{{ $o->id }}">{{ $o->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal"
                            onclick="">Add Service</button>
                </div>
            </div>
        </div>
    </div>


    {{--    Edit    --}}
    {{--  Edit Medication Qty --}}
    <div class="modal fade" id="editItemQty" tabindex="-1" role="dialog" aria-labelledby="editItemQty"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-2">
                        <div class="col-md-6">
                            <label class="small mb-1">Medication</label>
                            <p class="mb-0">Royal Canin Size Health Nutrition Adult Medium 7+ Dry Dog Food 4kg</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Price</label>
                            <div class="">
                                <p class="mb-0 fw-bold text-primary">
                                    ₱1,750.00
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Barcode</label>
                            <div class="">
                                <p class="mb-0">10290870</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Category</label>
                            <div class="">
                                <span class="badge bg-light text-body text-sm rounded-pill mb-1">Dog Food</span> <span class="badge bg-light text-body text-sm rounded-pill mb-1">Feast</span> <span class="badge bg-light text-body text-sm rounded-pill mb-1">Cat Treats</span>
                            </div>
                        </div>
                        <hr class="mt-3 mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="" class="mb-1">Enter Quantity</label>
                            <input type="number" id="quantityInput" class="form-control" placeholder="Enter Quantity" min="1" max="10" step="1" required>
                        </div>
                        <div class="col-md-12">
                            <label for="" class="mb-1">Who is this Medication for?</label>
                            <select class="form-select" id="pet" name="pet" required>
                                <option value="" disabled selected>Select a pet</option>
                                @foreach($owner as $o)
                                    <option value="{{ $o->id }}">{{ $o->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal"
                            onclick="">Edit Medication</button>
                </div>
            </div>
        </div>
    </div>

    {{--  Service Qty --}}
    <div class="modal fade" id="editServiceQty" tabindex="-1" role="dialog" aria-labelledby="editServiceQty"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-2">
                        <div class="col-md-6">
                            <label class="small mb-1">Service</label>
                            <p class="mb-0">Cat Vaccination</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Price</label>
                            <div class="">
                                <p class="mb-0 fw-bold text-primary">
                                    ₱1,750.00
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Veterinarian</label>
                            <div class="">
                                <p class="mb-0">
                                    Jane Doe
                                </p>
                            </div>
                        </div>
                        <hr class="mt-3 mb-2">
                        <div class="col-md-12">
                            <label for="" class="mb-1">Who is this Service for?</label>
                            <select class="form-select" id="pet" name="pet" required>
                                <option value="" disabled selected>Select a pet</option>
                                @foreach($owner as $o)
                                    <option value="{{ $o->id }}">{{ $o->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal"
                            onclick="">Edit Service</button>
                </div>
            </div>
        </div>
    </div>


    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{route('billing')}}">Billing</a></li>
                    <li class="breadcrumb-item active">Add Billing</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-none">
                <div class="card-body">
                    <h1 class="mb-3 fw-400">Pruderich Veterinary Clinic</h1>
                    <div class="d-flex justify-content-between">
                        <div class="gy-2">
                            <p class="mb-0">Purok - 3, Dologon, Maramag, Bukidnon</p>
                            <p class="">+63 917 620 0620</p>
                        </div>
                        <div class="text-end">
                            @php
                                $latestRecord = \App\Models\Billing::latest('id')->first();
                                $selectedOwnerID = 0;
                            @endphp
                            <p class="mb-0">Transaction No.@if($latestRecord != null){{sprintf("%05d",$latestRecord->id +1)}} @else {{sprintf("%05d",1)}} @endif</p>
                            <p class="mb-0">{{\Carbon\Carbon::now()->format('F d, Y')}}
                        </div>
                    </div>
                    <hr>
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label for="owner" class="form-label">Name</label>
                           <div class="">Juan Dela Cruz</div>
                        </div>
                        <div class="col-md-6">
                            <label for="owner" class="form-label">Veterinarian</label>
                            <div class="">Jane Doe</div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Address</label>
                            <div class="">Purok - 3, Batangan, Valencia City, Bukidnon</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <div class="">email@email.com</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <div class="">09123456789</div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <label for="payable" class="form-label">Sub Total</label>
                            <p id="payable" class="">₱0</p>
                        </div>
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <label for="payable" class="form-label">Total</label>
                            <p id="payable" class="text-primary fw-bold text-xl">₱0</p>
                        </div>
                        <button class="btn btn-primary" type="button"  data-bs-toggle="modal"
                                data-bs-target="#paymentModal">Proceed to Payment</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="col-md-12 mb-2 d-flex bg-white py-2 px-3 rounded border justify-content-between align-items-center">
                <h3 class="mb-0">Billing</h3>
                <div class="d-flex gx-2">
                    <button class="btn btn-outline-primary me-2 " data-bs-toggle="modal"
                            data-bs-target="#selectServiceModal">Select Service</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#selectMedicationModal">Select Medication</button>
                </div>
            </div>
            <div class="card shadow-none mb-4">
                <div class="card-body py-0">
                    <form action="{{route('billing.store')}}" method="POST" id="bill">
                        @csrf
                        {{--                        <div class="row gx-3">--}}
                        {{--                            <div class="col-md-12">--}}
                        {{--                                <div class="row gx-3 p-3 rounded border">--}}
                        {{--                                    <div class="row gx-3">--}}
                        {{--                                        <div class="col-md-6">--}}
                        {{--                                            <h1 class="mb-0">Pruderich Veterinary Clinic</h1>--}}
                        {{--                                            <p class="mb-0">Purok - 3, Dologon, Maramag, Bukidnon</p>--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="col-md-6">--}}
                        {{--                                            <div class="row">--}}
                        {{--                                                <!-- Billing Number -->--}}
                        {{--                                                @php--}}
                        {{--                                                $latestRecord = \App\Models\Billing::latest('id')->first();--}}
                        {{--                                                $selectedOwnerID = 0;--}}
                        {{--                                                @endphp--}}
                        {{--                                                <div class="col-md-7 mt-1 mt-md-0">--}}
                        {{--                                                    <label for="billing_number" class="form-label mb-0  text-primary">Billing Number</label>--}}
                        {{--                                                    <p class="mb-0">#@if($latestRecord != null){{sprintf("VETISBILL-%05d",$latestRecord->id +1)}} @else {{sprintf("VETISBill-%05d",1)}} @endif</p>--}}
                        {{--                                                </div>--}}
                        {{--                                                <!-- Billing Date -->--}}
                        {{--                                                <div class="col-md-5 mt-1 mt-md-0">--}}
                        {{--                                                    <label for="billing_date" class="form-label mb-0 text-primary">Date</label>--}}
                        {{--                                                    <p class="mb-0">{{\Carbon\Carbon::now()->format('F d, Y')}}</p>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="row mb-3">
                            <!-- Owner Dropdown -->
                            {{--                            <!-- Pet -->--}}
                            {{--                            <div class="col-md-6">--}}
                            {{--                                <label for="pet" class="form-label">Pet</label>--}}
                            {{--                                <select class="form-select" id="pet" name="pet_id" required>--}}
                            {{--                                    <option value="" disabled selected>Select a pet</option>--}}
                            {{--                                    <!-- Pet options will be dynamically updated by JavaScript -->--}}
                            {{--                                </select>--}}
                            {{--                            </div>--}}
                        </div>
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th class="text-primary">Service/Medication</th>
                                <th class="text-primary">Pet</th>
                                <th class="text-center text-primary">Price</th>
                                <th class="text-center text-primary">Qty</th>
                                <th class="text-center text-primary">Total</th>
                                <th class="text-center text-primary"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="" style="vertical-align: middle;">
                                    <span class="name">Service Name</span>
                                </td>
                                <td class="" style="vertical-align: middle;">
                                    <span class="pet_name">Pet Name</span>
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <span>₱</span><span class="price">0</span>
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    1
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <span>₱</span><span class="total">0</span>
                                </td>
                                <!-- Action column with fixed width and smaller font -->
                                <td class="text-center" style="vertical-align: middle; width: 120px; padding: 5px; font-size: 0.85rem;">
                                    <button type="button" class="btn btn-sm btn-outline-dark" onclick="removeRow(this)"><i class="fa-solid fa-x"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-dark" onclick="removeRow(this)"><i class="fa-solid fa-pen-to-square"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        {{--                        <div class="row mt-1">--}}
                        {{--                            <label class="form-label">Services Availed</label>--}}
                        {{--                            <!-- Services Availed -->--}}
                        {{--                            <div class="col-12">--}}
                        {{--                                <div id="services-container">--}}
                        {{--                                    <div class="input-group mb-2">--}}
                        {{--                                        <select class="form-select service" name="services[]" required>--}}
                        {{--                                            <option value="" disabled selected>Select a service</option>--}}
                        {{--                                            <!-- Dynamic service options with prices -->--}}
                        {{--                                            @foreach($services as $service)--}}
                        {{--                                            <option value="{{$service->id}}" data-price="{{$service->service_price}}">{{$service->service_name}} - ₱{{$service->service_price}}</option>--}}
                        {{--                                            @endforeach--}}
                        {{--                                        </select>--}}
                        {{--                                        <button type="button" class="btn btn-outline-secondary add-service">Add</button>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="row g-3">--}}
                        {{--                            <div class="col-12">--}}
                        {{--                                <label for="paymentType" class="form-label">Payment Type</label>--}}
                        {{--                                <select class="form-select" id="paymentType" name="payment_type" required>--}}
                        {{--                                    <option value="" disabled selected>Select Payment Type</option>--}}
                        {{--                                    <option value="full_payment">Full Payment</option>--}}
                        {{--                                    <option value="partial_payment">Partial Payment</option>--}}
                        {{--                                    <option value="pending_payment">Pending Payment</option>--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}

                        {{--                            <!-- Due Date Field -->--}}
                        {{--                            <div class="col-12 mt-3" id="due-date-container" style="display: none;">--}}
                        {{--                                <label for="due_date" class="form-label">Due Date</label>--}}
                        {{--                                <input type="date" class="form-control" id="due_date" name="due_date"--}}
                        {{--                                    min="{{ \Carbon\Carbon::today()->toDateString() }}" required>--}}
                        {{--                            </div>--}}

                        {{--                            <!-- Amount Paid -->--}}
                        {{--                            <!-- Total Payable -->--}}
                        {{--                            <div class="col-md-6">--}}
                        {{--                                <label for="payable" class="form-label mb-1">Total Payable</label>--}}
                        {{--                                <p id="payable" class="p-2 ps-3 text-primary fw-bold text-lg rounded border">₱0.00</p>--}}
                        {{--                                <input type="hidden" value="" name="total_payable" id="payableInput">--}}
                        {{--                            </div>--}}
                        {{--                            <div class=" col-md-6">--}}
                        {{--                                <label for="amount_paid" class="form-label mb-1">Amount Paid</label>--}}
                        {{--                                <input type="number" class="form-control p-3" id="amount_paid" name="total_paid" step="0.01" required>--}}
                        {{--                            </div>--}}

                        {{--                            <!-- Submit Button -->--}}
                        {{--                            <div class="col-12">--}}
                        {{--                                <button type="button" id="openConfirmationModal" class="btn btn-primary">Submit Billing</button>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Billing Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Owner:</strong> <span id="ownerName"></span></p>
                <p><strong>Pet:</strong> <span id="petName"></span></p>
                <p><strong>Services Availed:</strong></p>
                <ul id="servicesList"></ul>
                <p><strong>Payment Type:</strong> <span id="paymentTypeLabel"></span></p>
                <p><strong>Due Date:</strong> <span id="dueDate"></span></p>
                <p><strong>Total Payable:</strong> <span id="totalAmount"></span></p>
                <p><strong>Amount Paid:</strong> <span id="amountPaid"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="bill">Confirm and Submit</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Medicine List Table
    const medListTable = document.getElementById("medListTable");
    if (medListTable) {
        new simpleDatatables.DataTable(medListTable, {
            labels: {
                placeholder: "Enter Medicine Name, Barcode.."
            }
        });
    }

    // Service List Table
    const serviceListTable = document.getElementById("serviceListTable");
    if (serviceListTable) {  // Fixed condition from medListTable to serviceListTable
        new simpleDatatables.DataTable(serviceListTable, {
            labels: {
                placeholder: "Enter Service Name"
            }
        });
    }


    const dueDateInput = document.getElementById('due_date');

    // Prevent typing in the input field
    dueDateInput.addEventListener('keydown', function(e) {
        e.preventDefault(); // Block keyboard input
    });

    document.addEventListener('DOMContentLoaded', function() {
        const paymentType = document.getElementById('paymentType');
        const dueDateContainer = document.getElementById('due-date-container');
        const dueDateField = document.getElementById('due_date');
        const form = document.querySelector('form');
        const openConfirmationModalButton = document.getElementById('openConfirmationModal');

        // Handle payment type change
        paymentType.addEventListener('change', function() {
            const selectedValue = paymentType.value;
            if (selectedValue === 'partial_payment' || selectedValue === 'pending_payment') {
                dueDateContainer.style.display = 'block';
                dueDateField.required = true; // Make due date required
            } else {
                dueDateContainer.style.display = 'none';
                dueDateField.required = false; // Remove due date requirement
            }
        });

        const pets = @json($pet);

        // Filter pets based on owner ID
        document.getElementById('owner').addEventListener('change', function() {
            const selectedOwnerId = parseInt(this.value);
            SelectOwner(selectedOwnerId);
        });

        function SelectOwner(ownerId) {
            const petDropdown = document.getElementById('pet');
            petDropdown.innerHTML = `<option value="" disabled selected>Select a pet</option>`; // Reset options

            // Filter pets by ownerId
            const filteredPets = pets.filter(pet => pet.owner_ID === ownerId);
            filteredPets.forEach(pet => {
                const option = document.createElement('option');
                option.value = pet.id;
                option.textContent = pet.pet_name;
                petDropdown.appendChild(option);
            });
        }

        // Update total based on selected services
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.service').forEach(service => {
                const selectedOption = service.options[service.selectedIndex];
                if (selectedOption && selectedOption.dataset.price) {
                    total += parseFloat(selectedOption.dataset.price);
                }
            });
            document.getElementById('payable').textContent = `₱${total.toFixed(2)}`;
            document.getElementById('payableInput').value = total.toFixed(2);
        }

        // Add or remove services
        document.addEventListener("click", function(event) {
            if (event.target.classList.contains("add-service")) {
                const container = document.getElementById("services-container");
                const newService = document.createElement("div");
                newService.className = "input-group mb-2";
                newService.innerHTML = `
                <select class="form-select service" name="services[]" required>
                    <option value="" disabled selected>Select a service</option>
                    @foreach($services as $service)
                        <option value="{{$service->id}}" data-price="{{$service->service_price}}">{{$service->service_name}} - ₱{{$service->service_price}}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-outline-danger remove-service">Remove</button>
            `;
                container.appendChild(newService);
                updateTotal(); // Recalculate total
            }

            if (event.target.classList.contains("remove-service")) {
                event.target.parentElement.remove();
                updateTotal(); // Recalculate total
            }
        });

        // Update total whenever a service is selected
        document.addEventListener('change', function(event) {
            if (event.target.classList.contains('service')) {
                updateTotal();
            }
        });

        // Validate form and open confirmation modal
        openConfirmationModalButton.addEventListener('click', function() {
            let isValid = true;
            const owner = document.getElementById('owner');
            const pet = document.getElementById('pet');
            const services = document.querySelectorAll('.service');
            const amountPaid = document.getElementById('amount_paid');
            const paymentTypeValue = paymentType.value;
            const dueDateField = document.getElementById('due_date'); // Get due date field
            const payable = document.getElementById('payable').textContent.replace('₱', '').replace(',', ''); // Get the total payable amount as a number

            // Validate Owner
            if (!owner.value) {
                isValid = false;
                showErrorMessage(owner, 'Owner is required.');
            }

            // Validate Pet
            if (!pet.value) {
                isValid = false;
                showErrorMessage(pet, 'Pet is required.');
            }

            // Validate at least one service selected
            let serviceSelected = false;
            services.forEach(function(service) {
                if (service.value) {
                    serviceSelected = true;
                }
            });
            if (!serviceSelected) {
                isValid = false;
                showErrorMessage(services[0], 'At least one service must be selected.');
            }

            // Validate Payment Type
            if (!paymentTypeValue) {
                isValid = false;
                showErrorMessage(paymentType, 'Payment type is required.');
            }

            // Validate Due Date for Partial or Pending Payment
            if ((paymentTypeValue === 'partial_payment' || paymentTypeValue === 'pending_payment') && !dueDateField.value) {
                isValid = false;
                showErrorMessage(dueDateField, 'Due date is required for partial or pending payment.');
            }

            // Validate Amount Paid
            if (!amountPaid.value) {
                isValid = false;
                showErrorMessage(amountPaid, 'Amount paid is required.');
            }

            // Validate Full Payment Amount
            if (paymentTypeValue === 'full_payment' && parseFloat(amountPaid.value) < parseFloat(payable)) {
                isValid = false;
                showErrorMessage(amountPaid, 'Amount paid must be equal to or greater than the total payable for full payment.');
            }

            // If the form is valid, open the confirmation modal
            if (isValid) {
                const ownerName = owner.selectedOptions[0].text;
                const petName = pet.selectedOptions[0]?.text || "No pet selected";
                const servicesList = [];
                services.forEach(function(service) {
                    const serviceName = service.options[service.selectedIndex]?.text;
                    if (serviceName) {
                        const servicePrice = service.options[service.selectedIndex].dataset.price;
                        servicesList.push(`${serviceName} - ₱${servicePrice}`);
                    }
                });

                // Set modal content
                document.getElementById('ownerName').textContent = ownerName;
                document.getElementById('petName').textContent = petName;
                document.getElementById('servicesList').innerHTML = servicesList.map(service => `<li>${service}</li>`).join('');
                document.getElementById('paymentTypeLabel').textContent = paymentTypeValue;
                document.getElementById('totalAmount').textContent = `₱${payable}`;
                document.getElementById('amountPaid').textContent = amountPaid.value;

                // Add the due date if applicable
                if (paymentTypeValue === 'partial_payment' || paymentTypeValue === 'pending_payment') {
                    document.getElementById('dueDate').textContent = dueDateField.value;
                } else {
                    document.getElementById('dueDate').textContent = "N/A";
                }

                var modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                modal.show();
            }
        });

        // Function to show error message below the input field
        function showErrorMessage(inputElement, message) {
            // Remove any existing error message if the input value is filled
            inputElement.addEventListener('input', function() {
                if (inputElement.value.trim() !== "") {
                    inputElement.classList.remove('is-invalid');
                    const errorMessage = inputElement.parentNode.querySelector('.invalid-feedback');
                    if (errorMessage) {
                        errorMessage.remove();
                    }
                }
            });

            const errorMessage = document.createElement('div');
            errorMessage.classList.add('invalid-feedback');
            errorMessage.textContent = message;
            inputElement.classList.add('is-invalid');
            inputElement.parentNode.appendChild(errorMessage);
        }
    });
</script>
@endsection
