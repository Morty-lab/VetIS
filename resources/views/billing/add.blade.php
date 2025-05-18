@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment</h5>
                    <button type="button" class="btn-close" id="modalX" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                            @endphp
                                            <p class="mb-0">Transaction No.@if ($latestRecord != null)
                                                    {{ sprintf('%05d', $latestRecord->id + 1) }}
                                                @else
                                                    {{ sprintf('%05d', 1) }}
                                                @endif
                                            </p>
                                            <p class="mb-0">{{ \Carbon\Carbon::now()->format('F d, Y') }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row gy-3">
                                        <div class="col-md-6">
                                            <label for="owner" class="form-label">Name</label>
                                            <div class="">{{ $owner->client_name }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="owner" class="form-label">Veterinarian</label>
                                            <div class="">Dr. {{ $vet->firstname }} {{ $vet->lastname }}
                                                {{ $vet->extensionname ?? '' }}</div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Address</label>
                                            <div class="">{{ $owner->client_address }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            @php
                                                $owner_email = \App\Models\Clients::setEmailAttribute(
                                                    $owner,
                                                    $owner->user_id,
                                                );
                                            @endphp
                                            <div class="">{{ $owner_email->client_email }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Phone Number</label>
                                            <div class="">{{ $owner->client_no }}</div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                                            <label for="payable" class="form-label ">Sub Total</label>
                                            <p id="subTotal" class="subTotal">₱0</p>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                                            <label for="payable" class="form-label">Discount</label>
                                            <p id="discount" class="">₱0</p>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                                            <label for="payable" class="form-label ">Total</label>
                                            <p id="payable" class="text-primary fw-bold text-xl mb-0 total">₱0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <form id="paymentForm" action="{{ route('billing.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $owner->id }}">
                                <input type="hidden" name="vet_id" value="{{ $vet->id }}">
                                <input type="hidden" name="total_payable" id="total_payable">

                                <!-- Payment Type -->
                                <div class="row gy-3" id="paymentFields">
                                    <div class="col-md-6">
                                        <label for="paymentType" class="form-label">Payment Type</label>
                                        <select class="form-select billing-payment-type" id="paymentType"
                                            name="payment_type" onchange="updatePaymentType(this.value)"
                                            data-placeholder="Select Payment Type" required>
                                            <option value=""></option>
                                            <option value="Cash">Full Payment</option>
                                            <option value="Partial">Partial Payment</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="paymentType" class="form-label">Apply Discount</label>
                                        <select class="form-select billing-discount-type" id="" name="discount"
                                            data-placeholder="Select Discount" required
                                            onchange="applyDiscount(this.value)">
                                            <option value=""></option>
                                            @foreach ($discounts as $discount)
                                                <option value="{{ $discount->service_price }}">
                                                    {{ $discount->service_name }}
                                                    ({{ number_format($discount->service_price * 100, 0) }}%)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <!-- Due Date (only for Partial Payment) -->
                                        <div class="mb-3 d-none" id="dueDateContainer">
                                            <label for="dueDate" class="form-label">Due Date</label>
                                            <div class="input-group input-group-joined">
                                                <input type="date" class="form-control" id="dueDate"
                                                    name="due_date" placeholder="Select a Due Date">
                                                <span class="input-group-text">
                                                    <i data-feather="calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Joined input group prepend example-->
                                        <label for="cashGiven" class="form-label">Cash Given</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                ₱
                                            </span>
                                            <input type="number" class="form-control" id="cashGiven" name="cash_given"
                                                min="0" step="0.01" oninput="updateCashGiven(this.value)"
                                                required>
                                            <div class="invalid-feedback">
                                                Please provide a valid amount based on the payment type.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary w-100 mb-2" type="button"
                                            onclick="submitForm()">Enter</button>
                                    </div>
                                </div>

                                {{-- Basta ma submit na then successfull mo open sa new tab ang invoice sa billing --}}
                                <div style="" id="change">
                                    <div class="row">
                                        <div class="col-md-12 d-none" id="thankYouMessage">
                                            <h1 class="fw-500 text-primary">
                                                Thank you for your Purchase!
                                            </h1>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Payment Type:</p>
                                                <p class="text-lg mb-0 fw-400 payment-type">No Payment Method Chosen</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Total:</p>
                                                <p class="text-lg mb-0 fw-400 grand-total total">₱0</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Cash Given:</p>
                                                <p class="text-lg mb-0 fw-400 " id="cashGivenText">₱0</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-none" id="dueDateTextContainer">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Due Date:</p>
                                                <p class="text-lg mb-0 fw-400 " id="dueDateText">05/19/2025</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-none" id="remainingBalanceContainer">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0 text-lg">Remaining Balance:</p>
                                                <p class="display-6 text-blue mb-0 fw-500 " id="remainingBalanceText">250</p>
                                            </div>
                                        </div>
                                        {{-- Dili ni mag show if Partial Payment ang Change --}}
                                        <div class="col-md-12 d-none" id="changeContainer">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Change:</p>
                                                <p class="display-6 text-blue mb-0 h5 fw-500 " id="changeText">500</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="modalFooter" style="display: none;">
                    <div class="progress w-100" style="height: 20px;">
                        <div id="progressBar" class="progress-bar bg-primary" role="progressbar"
                             style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('paymentType').addEventListener('change', function() {
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
                                    {{-- <th>Category</th> --}}
                                    <th>Stocks</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medications as $medication)
                                    @php
                                        $medicationPrice = App\Models\Stocks::where('products_id', $medication->id)
                                            ->orderBy('created_at', 'asc')
                                            ->first();
                                    @endphp
                                    @if ($medicationPrice === null)
                                        @continue
                                    @endif
                                    <tr>
                                        <td>{{ $medication->SKU }}</td>
                                        <td>{{ $medication->product_name }}</td>

                                        <td>
                                            {{ $medicationPrice->stock - $medicationPrice->subtracted_stock }}
                                        </td>
                                        <td> {{ $medicationPrice->price }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-datatable px-5 py-3" data-bs-toggle="modal"
                                                data-bs-target="#itemQty-{{ $medication->id }}">Select</button>
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

    <!-- Select Fees Modal -->
    <div class="modal fade" id="selectFeesModal" tabindex="-1" role="dialog" aria-labelledby="selectFees"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Fees</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card shadow-none pt-2 pb-2 px-3 rounded-3">
                        <table class="table" id="feesListTable">
                            <thead>
                                <tr>
                                    <th>Fees</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fees as $fee)
                                    @php
                                        $feePrice = $fee->service_price;
                                    @endphp
                                    <tr>
                                        <td>{{ $fee->service_name }}</td>
                                        <td>₱{{ number_format($feePrice, 2) }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-datatable px-5 py-3" data-bs-toggle="modal"
                                                data-bs-target="#feeQty-{{ $fee->id }}">Select</button>
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
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $service->service_name }}</td>
                                        <td>₱{{ $service->service_price }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-datatable px-5 py-3" data-bs-toggle="modal"
                                                data-bs-target="#serviceQty-{{ $service->id }}"
                                                data-service-id="{{ $service->id }}">Select</button>
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


    {{--  Medication Qty --}}
    @foreach ($medications as $medication)
        @php
            $medicationPrice =
                App\Models\Stocks::where('products_id', $medication->id)->orderBy('created_at', 'asc')->first()
                    ->price ?? 0;
        @endphp
        @if ($medicationPrice === 0)
            @continue
        @endif
        <div class="modal fade" id="itemQty-{{ $medication->id }}" tabindex="-1" role="dialog"
            aria-labelledby="itemQty" style="display: none;" aria-hidden="true">
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
                                <p class="mb-0">{{ $medication->product_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Price</label>
                                <div class="">

                                    <p class="mb-0 fw-bold text-primary">
                                        ₱ {{ number_format($medicationPrice, 2) }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Barcode</label>
                                <div class="">
                                    <p class="mb-0">{{ $medication->SKU }}</p>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <label class="small mb-1">Category</label>
                                <div class="">
                                    <span class="badge bg-light text-body text-sm rounded-pill mb-1">Dog Food</span> <span
                                        class="badge bg-light text-body text-sm rounded-pill mb-1">Feast</span> <span
                                        class="badge bg-light text-body text-sm rounded-pill mb-1">Cat Treats</span>
                                </div>
                            </div> --}}
                            <hr class="mt-3 mb-2">
                            <div class="col-md-12 mb-2">
                                <label for="" class="mb-1">Enter Quantity</label>
                                <input type="number" id="quantityInput" class="form-control"
                                    placeholder="Enter Quantity" min="1" max="10" step="1" required
                                    oninput="setMedicationQuantity(this.value)">

                            </div>
                            <div class="col-md-12">
                                <label for="" class="mb-1">Who is this Medication for?</label>
                                <select class="form-select" id="pet" name="pet"
                                    onchange="setPetMedication(this)" required>
                                    <option value="" disabled selected>Select a pet</option>
                                    @foreach ($pets as $pet)
                                        <option value="{{ $pet->id }}" data-pet-name="{{ $pet->pet_name }}">
                                            {{ $pet->pet_name }}</option>
                                    @endforeach
                                </select>

                                <script>
                                    let medicationQuantity = 0;
                                    let medpet = {};

                                    function setPetMedication(selectElement) {
                                        medpet.id = selectElement.value;
                                        medpet.name = selectElement.selectedOptions[0].dataset.petName;
                                    }

                                    function setMedicationQuantity(quantity) {
                                        medicationQuantity = quantity;
                                        console.log(medicationQuantity);
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal"
                            onclick="if (medicationQuantity > 0 && medpet.id) addMedicationToTable({{ $medication->id }}, '{{ $medication->product_name }}', {{ $medicationPrice }}, medicationQuantity,medpet); else alert('Please select a pet and enter a quantity')">Add
                            Medication</button>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Select Fees Modal -->
    @foreach ($fees as $fee)
        <div class="modal fade" id="feeQty-{{ $fee->id }}" tabindex="-1" role="dialog" aria-labelledby="feeQty"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $fee->name }}</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gy-2">
                            <div class="col-md-6">
                                <label class="small mb-1">Fee</label>
                                <p class="mb-0">{{ $fee->service_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Price</label>
                                <div class="">
                                    <p class="mb-0 fw-bold text-primary">
                                        ₱ {{ number_format($fee->service_price, 2) }}

                                    </p>
                                </div>
                            </div>
                            <hr class="mt-3 mb-2">
                            <div class="col-md-12">
                                <label for="" class="mb-1">Who is this Fee for?</label>
                                <select class="form-select" id="pet" name="pet"
                                    onchange="setPetVariableFee(this)" required>
                                    <option value="" disabled selected>Select a pet</option>
                                    @foreach ($pets as $pet)
                                        <option value="{{ $pet->id }}" data-pet-name="{{ $pet->pet_name }}">
                                            {{ $pet->pet_name }}</option>
                                    @endforeach
                                </select>
                                <script>
                                    let feepet = {};

                                    function setPetVariableFee(selectElement) {
                                        feepet.id = selectElement.value;
                                        feepet.name = selectElement.selectedOptions[0].dataset.petName;
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal"
                            onclick="if (feepet.id) { addFeeToTable({{ $fee->id }}, '{{ $fee->service_name }}', {{ $fee->service_price }},feepet); } else { alert('Please select a pet.'); }">Add
                            Fee</button>


                    </div>
                </div>
            </div>
        </div>
    @endforeach


    {{--  Service Qty --}}
    @foreach ($services as $service)
        <div class="modal fade" id="serviceQty-{{ $service->id }}" tabindex="-1" role="dialog"
            aria-labelledby="serviceQty-{{ $service->id }}" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $service->service_name }}</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gy-2">
                            <div class="col-md-6">
                                <label class="small mb-1">Service</label>
                                <p class="mb-0">{{ $service->service_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Price</label>
                                <div class="">
                                    <p class="mb-0 fw-bold text-primary">
                                        ₱{{ number_format($service->service_price, 2) }}
                                    </p>
                                </div>
                            </div>
                            @if (!empty($service->veterinarian))
                                <div class="col-md-6">
                                    <label class="small mb-1">Veterinarian</label>
                                    <div>
                                        <p class="mb-0">{{ $service->veterinarian }}</p>
                                    </div>
                                </div>
                            @endif
                            <hr class="mt-3 mb-2">
                            @if ($service->service_name == 'Pet Lodge')
                                <div class="col-md-12 mb-2">
                                    <label for="" class="mb-1">Enter Quantity</label>
                                    <input type="number" id="quantityInput" class="form-control"
                                        placeholder="Enter Quantity" min="1" max="10" step="1" required
                                        oninput="setPetLodgeQuantity(this.value)">

                                </div>
                            @endif
                            <div class="col-md-12">
                                <label for="" class="mb-1">Who is this Service for?</label>
                                <select class="form-select" id="pet" name="pet" required
                                    onchange="setPetVariable(this)">
                                    <option value="" disabled selected>Select a pet</option>
                                    @foreach ($pets as $pet)
                                        <option value="{{ $pet->id }}" data-pet-name="{{ $pet->pet_name }}">
                                            {{ $pet->pet_name }}</option>
                                    @endforeach
                                </select>

                                <script>
                                    let pet = {};
                                    let petLodgeQuantity = 1;

                                    function setPetVariable(selectElement) {
                                        pet.id = selectElement.value;
                                        pet.name = selectElement.selectedOptions[0].dataset.petName;
                                    }

                                    function setPetLodgeQuantity(value) {
                                        petLodgeQuantity = value;
                                        console.log(petLodgeQuantity);
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal"
                            onclick="if (pet.id) { addServiceToTable({{ $service->id }}, '{{ $service->service_name }}', {{ $service->service_price }}, petLodgeQuantity, pet); } else { alert('Please select a pet.'); }">Add
                            Service</button>


                    </div>
                </div>
            </div>
        </div>
    @endforeach


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
                                <span class="badge bg-light text-body text-sm rounded-pill mb-1">Dog Food</span> <span
                                    class="badge bg-light text-body text-sm rounded-pill mb-1">Feast</span> <span
                                    class="badge bg-light text-body text-sm rounded-pill mb-1">Cat Treats</span>
                            </div>
                        </div>
                        <hr class="mt-3 mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="" class="mb-1">Enter Quantity</label>
                            <input type="number" id="quantityInput" class="form-control" placeholder="Enter Quantity"
                                min="1" max="10" step="1" required>
                        </div>
                        <div class="col-md-12">
                            <label for="" class="mb-1">Who is this Medication for?</label>
                            <select class="form-select" id="pet" name="pet" required>
                                <option value="" disabled selected>Select a pet</option>
                                @foreach ($pets as $pet)
                                    <option value="{{ $pet->id }}">{{ $pet->pet_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal" onclick="">Edit
                        Medication</button>
                </div>
            </div>
        </div>
    </div>

    {{--  Service Qty --}}
    {{-- <div class="modal fade" id="editServiceQty" tabindex="-1" role="dialog" aria-labelledby="editServiceQty"
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
                                @foreach ($pets as $pet)
                                    <option value="{{ $pet->id }}">{{ $pet->pet_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal" onclick="">Edit
                        Service</button>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Modal -->
    <div class="modal fade" id="editServiceQty" tabindex="-1" role="dialog" aria-labelledby="editServiceQty"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Service</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-2">
                        <div class="col-md-6">
                            <label class="small mb-1">Service</label>
                            <p id="modalServiceName" class="mb-0">Cat Vaccination</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Price</label>
                            <div class="">
                                <p id="modalServicePrice" class="mb-0 fw-bold text-primary">₱1,750.00</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Veterinarian</label>
                            <div class="">
                                <p id="modalVeterinarian" class="mb-0">Dr. {{ $vet->firstname }} {{ $vet->lastname }}
                                    {{ $vet->extensionname ?? '' }}</p>
                            </div>
                        </div>
                        <hr class="mt-3 mb-2">
                        <div class="col-md-12">
                            <label for="pet" class="mb-1">Who is this Service for?</label>
                            <select class="form-select" id="modalPet" name="pet" required>
                                <option value="" disabled selected>Select a pet</option>
                                <!-- Dynamic pets will be populated here -->
                                @foreach ($pets as $pet)
                                    <option value="{{ $pet->id }}">{{ $pet->pet_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal" onclick="saveEdit()">Save
                        Changes</button>
                </div>
            </div>
        </div>
    </div>


    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('billing') }}">Billing</a></li>
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
                                <p class="mb-0">Transaction No.@if ($latestRecord != null)
                                        {{ sprintf('%05d', $latestRecord->id + 1) }}
                                    @else
                                        {{ sprintf('%05d', 1) }}
                                    @endif
                                </p>
                                <p class="mb-0">{{ \Carbon\Carbon::now()->format('F d, Y') }}
                            </div>
                        </div>
                        <hr>
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="owner" class="form-label">Name</label>
                                <div class=""> {{ $owner->client_name }} </div>
                            </div>
                            <div class="col-md-6">
                                <label for="owner" class="form-label">Veterinarian</label>
                                <div class="">
                                    <div class="">Dr. {{ $vet->firstname }} {{ $vet->lastname }}
                                        {{ $vet->extensionname ?? '' }}</div>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Address</label>
                                <div class="">{{ $owner->client_address }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                @php
                                    App\Models\Clients::setEmailAttribute($owner, $owner->user_id);
                                @endphp
                                <div class="">{{ $owner->client_email }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <div class="">{{ $owner->client_no }}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-between align-items-center">
                                <label for="payable" class="form-label ">Sub Total</label>
                                <p id="payable" class="subTotal">₱0</p>
                            </div>
                            <div class="col-md-12 d-flex justify-content-between align-items-center">
                                <label for="payable" class="form-label ">Total</label>
                                <p id="payable" class="text-primary fw-bold text-xl total">₱0</p>
                            </div>
                            <button class="btn btn-primary d-none" type="button" data-bs-toggle="modal"
                                data-bs-target="#paymentModal" id="proceedToPayment">Proceed to Payment</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div
                    class="col-md-12 mb-2 d-flex bg-white py-2 px-3 rounded border justify-content-between align-items-center">
                    <h3 class="mb-0">Billing</h3>
                    <div class="d-flex gx-2">
                        <button class="btn btn-outline-primary me-2 " data-bs-toggle="modal"
                            data-bs-target="#selectServiceModal">Select Service</button>
                        <button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal"
                            data-bs-target="#selectMedicationModal">Select Medication/Vaccine</button>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#selectFeesModal">Add Fees</button>
                    </div>
                </div>
                <div class="card shadow-none mb-4">
                    <div class="card-body py-0">
                        <form action="{{ route('billing.store') }}" method="POST" id="bill">
                            @csrf
                            {{--                        <div class="row gx-3"> --}}
                            {{--                            <div class="col-md-12"> --}}
                            {{--                                <div class="row gx-3 p-3 rounded border"> --}}
                            {{--                                    <div class="row gx-3"> --}}
                            {{--                                        <div class="col-md-6"> --}}
                            {{--                                            <h1 class="mb-0">Pruderich Veterinary Clinic</h1> --}}
                            {{--                                            <p class="mb-0">Purok - 3, Dologon, Maramag, Bukidnon</p> --}}
                            {{--                                        </div> --}}
                            {{--                                        <div class="col-md-6"> --}}
                            {{--                                            <div class="row"> --}}
                            {{--                                                <!-- Billing Number --> --}}
                            {{--                                                @php --}}
                            {{--                                                $latestRecord = \App\Models\Billing::latest('id')->first(); --}}
                            {{--                                                $selectedOwnerID = 0; --}}
                            {{--                                                @endphp --}}
                            {{--                                                <div class="col-md-7 mt-1 mt-md-0"> --}}
                            {{--                                                    <label for="billing_number" class="form-label mb-0  text-primary">Billing Number</label> --}}
                            {{--                                                    <p class="mb-0">#@if ($latestRecord != null){{sprintf("VETISBILL-%05d",$latestRecord->id +1)}} @else {{sprintf("VETISBill-%05d",1)}} @endif</p> --}}
                            {{--                                                </div> --}}
                            {{--                                                <!-- Billing Date --> --}}
                            {{--                                                <div class="col-md-5 mt-1 mt-md-0"> --}}
                            {{--                                                    <label for="billing_date" class="form-label mb-0 text-primary">Date</label> --}}
                            {{--                                                    <p class="mb-0">{{\Carbon\Carbon::now()->format('F d, Y')}}</p> --}}
                            {{--                                                </div> --}}
                            {{--                                            </div> --}}
                            {{--                                        </div> --}}
                            {{--                                    </div> --}}
                            {{--                                </div> --}}
                            {{--                            </div> --}}
                            {{--                        </div> --}}
                            <div class="row mb-3">
                                <!-- Owner Dropdown -->
                                <!-- Pet -->
                                {{-- <div class="col-md-6">
                                    <label for="pet" class="form-label">Pet</label>
                                    <select class="form-select" id="pet" name="pet_id" required>
                                        <option value="" disabled selected>Select a pet</option>
                                        <!-- Pet options will be dynamically updated by JavaScript -->
                                    </select>
                                </div> --}}
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
                                    {{-- <tr>
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
                                        <td class="text-center"
                                            style="vertical-align: middle; width: 120px; padding: 5px; font-size: 0.85rem;">
                                            <button type="button" class="btn btn-sm btn-outline-dark"
                                                onclick="removeRow(this)"><i class="fa-solid fa-x"></i></button>
                                            <button type="button" class="btn btn-sm btn-outline-dark"
                                                onclick="removeRow(this)"><i
                                                    class="fa-solid fa-pen-to-square"></i></button>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>

                            {{--                        <div class="row mt-1"> --}}
                            {{--                            <label class="form-label">Services Availed</label> --}}
                            {{--                            <!-- Services Availed --> --}}
                            {{--                            <div class="col-12"> --}}
                            {{--                                <div id="services-container"> --}}
                            {{--                                    <div class="input-group mb-2"> --}}
                            {{--                                        <select class="form-select service" name="services[]" required> --}}
                            {{--                                            <option value="" disabled selected>Select a service</option> --}}
                            {{--                                            <!-- Dynamic service options with prices --> --}}
                            {{--                                            @foreach ($services as $service) --}}
                            {{--                                            <option value="{{$service->id}}" data-price="{{$service->service_price}}">{{$service->service_name}} - ₱{{$service->service_price}}</option> --}}
                            {{--                                            @endforeach --}}
                            {{--                                        </select> --}}
                            {{--                                        <button type="button" class="btn btn-outline-secondary add-service">Add</button> --}}
                            {{--                                    </div> --}}
                            {{--                                </div> --}}
                            {{--                            </div> --}}
                            {{--                        </div> --}}
                            {{--                        <div class="row g-3"> --}}
                            {{--                            <div class="col-12"> --}}
                            {{--                                <label for="paymentType" class="form-label">Payment Type</label> --}}
                            {{--                                <select class="form-select" id="paymentType" name="payment_type" required> --}}
                            {{--                                    <option value="" disabled selected>Select Payment Type</option> --}}
                            {{--                                    <option value="full_payment">Full Payment</option> --}}
                            {{--                                    <option value="partial_payment">Partial Payment</option> --}}
                            {{--                                    <option value="pending_payment">Pending Payment</option> --}}
                            {{--                                </select> --}}
                            {{--                            </div> --}}

                            {{--                            <!-- Due Date Field --> --}}
                            {{--                            <div class="col-12 mt-3" id="due-date-container" style="display: none;"> --}}
                            {{--                                <label for="due_date" class="form-label">Due Date</label> --}}
                            {{--                                <input type="date" class="form-control" id="due_date" name="due_date" --}}
                            {{--                                    min="{{ \Carbon\Carbon::today()->toDateString() }}" required> --}}
                            {{--                            </div> --}}

                            {{--                            <!-- Amount Paid --> --}}
                            {{--                            <!-- Total Payable --> --}}
                            {{--                            <div class="col-md-6"> --}}
                            {{--                                <label for="payable" class="form-label mb-1">Total Payable</label> --}}
                            {{--                                <p id="payable" class="p-2 ps-3 text-primary fw-bold text-lg rounded border">₱0.00</p> --}}
                            {{--                                <input type="hidden" value="" name="total_payable" id="payableInput"> --}}
                            {{--                            </div> --}}
                            {{--                            <div class=" col-md-6"> --}}
                            {{--                                <label for="amount_paid" class="form-label mb-1">Amount Paid</label> --}}
                            {{--                                <input type="number" class="form-control p-3" id="amount_paid" name="total_paid" step="0.01" required> --}}
                            {{--                            </div> --}}

                            {{--                            <!-- Submit Button --> --}}
                            {{--                            <div class="col-12"> --}}
                            {{--                                <button type="button" id="openConfirmationModal" class="btn btn-primary">Submit Billing</button> --}}
                            {{--                            </div> --}}
                            {{--                        </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    {{-- <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
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
    </div> --}}
@endsection

@section('scripts')
    <script>
        let index = 0;
        let subTotal = 0;
        let total = 0;
        let cash_given = 0;
        let payment_type = '';

        function updateCashGiven(cash) {
            cash_given = cash;
        }

        function updateSubTotal(price) {
            const subTotalElements = document.querySelectorAll('.subTotal');
            const totalElements = document.querySelectorAll('.total');
            const totalInput = document.getElementById('total_payable');
            const proceedBtn = document.getElementById('proceedToPayment');
            console.log(proceedBtn)

            subTotalElements.forEach(el => {
                subTotal = parseFloat(el.textContent.replace(/[^\d.]/g, '')) + price;
                el.textContent = `₱ ${subTotal.toFixed(2)}`;
            });

            totalElements.forEach(el => {
                total = parseFloat(el.textContent.replace(/[^\d.]/g, '')) + price;
                el.textContent = `₱ ${total.toFixed(2)}`;
            });

            totalInput.value = total;


            if (proceedBtn) {
                if (subTotal > 0) {
                    proceedBtn.classList.remove('d-none');
                } else {
                    proceedBtn.classList.add('d-none');
                }
            }
        }

        function updatePaymentType(type) {
            payment_type = type;

        }

        // Global variables
        let discountAmount = 0;
        let finalPrice = subTotal;

        // Initialize when document is ready
        // document.addEventListener('DOMContentLoaded', function() {
        //     // Assume we have a total price from somewhere in your application
        //     // For demonstration, let's set a sample price
        //     totalPrice = subTotal; // Replace this with your actual price from the system
        //     updateFinalPrice();

        //     // Initialize select2 if it's being used
        //     try {
        //         $('.billing-payment-type').select2({
        //             minimumResultsForSearch: Infinity,
        //             placeholder: $(this).data('placeholder')
        //         });

        //         $('.billing-discount-type').select2({
        //             minimumResultsForSearch: Infinity,
        //             placeholder: $(this).data('placeholder')
        //         });
        //     } catch (e) {
        //         console.log('Select2 not available or already initialized');
        //     }

        //     // Set up event listeners



        //     // Set min date for due date as tomorrow
        //     const tomorrow = new Date();
        //     tomorrow.setDate(tomorrow.getDate() + 1);
        //     document.getElementById('dueDate').min = tomorrow.toISOString().split('T')[0];
        // });

        // Function to update payment type display and validation
        function updatePaymentType(paymentType) {
            const cashGivenInput = document.getElementById('cashGiven');
            const dueDateContainer = document.getElementById('dueDateContainer');
            const dueDate = document.getElementById('dueDate');
            const paymentTextElements = document.querySelectorAll('.payment-type');
            const dueDateTextContainer = document.getElementById('dueDateTextContainer');
            const dueDateText = document.getElementById('dueDateText');

            // Reset validation styling
            cashGivenInput.classList.remove('is-invalid');

            if (paymentType === 'Cash') {
                // Full payment - Due date not needed
                dueDateContainer.classList.add('d-none');
                dueDate.required = false;

                // Update payment text
                paymentTextElements.forEach(element => {
                    element.textContent = 'Full Payment';
                });

                // Set minimum cash given to the final price
                cashGivenInput.min = total;
                cashGivenInput.setAttribute('placeholder', `Minimum ${total.toFixed(2)}`);

            } else if (paymentType === 'Partial') {
                // Partial payment - Due date required

                dueDateContainer.classList.remove('d-none');
                dueDate.required = true;

                // Update due date text on change
                dueDate.addEventListener('change', function() {
                    dueDateTextContainer.classList.remove('d-none');
                    const date = new Date(this.value);
                    const month = date.toLocaleString('default', {
                        month: 'long'
                    });
                    const day = `0${date.getDate()}`.slice(-2);
                    const year = date.getFullYear();
                    dueDateText.textContent = this.value ? `${month} ${day}, ${year}` : 'Not set';
                });

                // Update payment text
                paymentTextElements.forEach(element => {
                    element.textContent = 'Partial Payment';
                });



                // Cash given should be less than the final price but greater than 0
                cashGivenInput.min = 1;
                cashGivenInput.max = total - 0.01;
                cashGivenInput.setAttribute('placeholder', `Less than ${total.toFixed(2)}`);
            } else {
                // No selection - hide due date
                dueDateContainer.classList.add('d-none');
                dueDate.required = false;
            }

            // Clear cash given value when payment type changes
            cashGivenInput.value = '';
        }

        // Function to validate cash given
        function updateCashGiven(amount) {
            const cashGivenInput = document.getElementById('cashGiven');
            const paymentType = document.getElementById('paymentType').value;
            const cashGivenText = document.getElementById('cashGivenText');

            cashGivenText.textContent = `₱ ${amount ? parseFloat(amount).toFixed(2) : '0.00'}`;

            // Convert to number
            const cashGiven = parseFloat(amount) || 0;
            let totalpayable = parseFloat(document.getElementById('payable').textContent.replace(/[^\d.]/g, '').replace(/\.00$/, ''));

            if (paymentType === 'Cash') {
                // For full payment, cash must be >= final price
                console.log('Adding cash given (full): ', amount);
                console.log('Total payable: ', totalpayable);
                if (cashGiven < totalpayable) {
                    cashGivenInput.classList.add('is-invalid');
                    return false;
                } else {
                    cashGivenInput.classList.remove('is-invalid');
                    return true;
                }
            } else if (paymentType === 'Partial') {
                console.log('Adding cash given (partial): ', amount);
                // For partial payment, cash must be > 0 and < final price
                if (cashGiven <= 0 || cashGiven >= totalpayable) {
                    cashGivenInput.classList.add('is-invalid');
                    return false;
                } else {
                    cashGivenInput.classList.remove('is-invalid');
                    return true;
                }
            }

            return false;
        }

        // Function to apply selected discount
        function applyDiscount(discount) {
            const totalInput = document.getElementById('total_payable');
            const totalElements = document.querySelectorAll('.total');
            const discountText = document.getElementById('discount');
            const cashGivenInput = document.getElementById('cashGiven');

            console.log(discount);
            const originalTotal = parseFloat(totalInput.value.replace(/[^\d.]/g, '')) || 0;
            console.log(originalTotal);
            discountAmount = originalTotal * discount;
            console.log(discountAmount);


            discountText.textContent = discount ? `₱${(discountAmount).toFixed(2)}` : '₱0.00';



            let discountedTotal = originalTotal - discountAmount;
            totalElements.forEach(el => {
                el.textContent = `₱ ${discountedTotal.toFixed(2)}`;
            });
            cashGivenInput.setAttribute('placeholder', `Minimum ${discountedTotal.toFixed(2)}`);

        }

        // Update final price after discount
        function updateFinalPrice() {
            finalPrice = totalPrice - discountAmount;
            if (finalPrice < 0) finalPrice = 0;

            // Update any price display elements in your UI
            // For example: document.getElementById('finalPriceDisplay').textContent = `₱${finalPrice.toFixed(2)}`;

            // If payment type is already selected, update the validation constraints
            const paymentType = document.getElementById('paymentType').value;
            if (paymentType) {
                updatePaymentType(paymentType);
            }
        }

        // Function to validate the entire form before submission
        function validateForm() {
            let isValid = true;
            const paymentType = document.getElementById('paymentType').value;
            const cashGiven = document.getElementById('cashGiven').value;
            const dueDate = document.getElementById('dueDate');

            // Check if payment type is selected
            if (!paymentType) {
                document.getElementById('paymentType').classList.add('is-invalid');
                isValid = false;
            }

            // Validate cash given based on payment type
            if (!updateCashGiven(cashGiven)) {
                isValid = false;
            }

            // If partial payment, ensure due date is set
            if (paymentType === 'Partial') {
                if (!dueDate.value) {
                    dueDate.classList.add('is-invalid');
                    isValid = false;
                } else {
                    dueDate.classList.remove('is-invalid');
                }
            }

            return isValid;
        }
       function submitForm() {
            if (validateForm()) {
                const paymentType = document.getElementById('paymentType').value;
                const cashGiven = parseFloat(document.getElementById('cashGiven').value) || 0;
                const paymentFields = document.getElementById('paymentFields');
                const thankYouMessage = document.getElementById('thankYouMessage');
                const changeContainer = document.getElementById('changeContainer');
                const changeText = document.getElementById('changeText');
                const remainingBalanceContainer = document.getElementById('remainingBalanceContainer');
                const remainingBalanceText = document.getElementById('remainingBalanceText');
                const modalFooter = document.getElementById('modalFooter');
                const modalX = document.getElementById('modalX');
                const progressBar = document.getElementById('progressBar');
                modalFooter.style.display = 'block';
                modalX.style.display = 'none';

                if (paymentType === 'Cash') {
                    const change = cashGiven - (total - discountAmount);
                    paymentFields.style.display = 'none';
                    thankYouMessage.classList.remove('d-none');
                    changeContainer.classList.remove('d-none');
                    changeText.textContent = `₱ ${change.toFixed(2)}`;
                } else if (paymentType === 'Partial') {
                    paymentFields.style.display = 'none';
                    thankYouMessage.classList.remove('d-none');
                    remainingBalanceContainer.classList.remove('d-none');
                    const remaining =  (total - discountAmount) - cashGiven;
                    const dueDate = document.getElementById('dueDate').value;
                    remainingBalanceText.textContent = `₱ ${remaining.toFixed(2)}`;
                }

                // Animate progress bar for 5 seconds before submitting
                let width = 0;
                progressBar.style.width = '0%';
                progressBar.setAttribute('aria-valuenow', 0);

                const interval = setInterval(() => {
                    if (width >= 100) {
                        clearInterval(interval);
                        document.getElementById('paymentForm').submit();
                    } else {
                        width += 2; // 2% every 100ms = 5 seconds
                        progressBar.style.width = width + '%';
                        progressBar.setAttribute('aria-valuenow', width);
                    }
                }, 100);

            } else {
                alert('Please check the form for errors and try again.');
            }
        }

        // function submitForm() {
        //     if (!payment_type) {
        //         alert('Payment type is required');
        //         return;
        //     }

        //     if (cash_given != 0 && payment_type == 'Partial' && document.getElementById('dueDate').value == '') {
        //         alert('Due date is required');
        //         return;
        //     }

        //     if (cash_given < total && payment_type == 'Cash') {
        //         alert('Cash given is less than the total amount');
        //         return;
        //     }


        //     document.getElementById('paymentForm').submit();
        // }


        function addServiceToTable(serviceId, serviceName, servicePrice,petLodgeQuantity, pet) {
            updateSubTotal(servicePrice * petLodgeQuantity);
            index = document.querySelectorAll('table.table-responsive tbody tr').length;
            const tableBody = document.querySelector('table.table-responsive tbody');
            const row = document.createElement('tr');
            row.innerHTML = `
            <td class="" style="vertical-align: middle;">
                <span class="name">${serviceName}</span>
            </td>
            <td class="" style="vertical-align: middle;">
                <span class="pet_name">${pet.name}</span>
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <span>₱</span><span class="price">${servicePrice.toFixed(2)}</span>
            </td>
            <td class="text-center" style="vertical-align: middle;">
                ${petLodgeQuantity}
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <span>₱</span><span class="quantity-total">${(servicePrice * petLodgeQuantity).toFixed(2)}</span>
            </td>
            <td class="text-center"
                style="vertical-align: middle; width: 120px; padding: 5px; font-size: 0.85rem;">
                <button type="button" class="btn btn-sm btn-outline-dark"
                    onclick="removeRow(this)"><i class="fa-solid fa-x"></i></button>

            </td>



        `;
            tableBody.appendChild(row);


            const paymentForm = document.getElementById('paymentForm');
            const inputServiceID = document.createElement('input');
            inputServiceID.type = 'hidden';
            inputServiceID.name = `bill[${index}][serviceID]`;
            inputServiceID.value = serviceId;

            const inputPrice = document.createElement('input');
            inputPrice.type = 'hidden';
            inputPrice.name = `bill[${index}][price]`;
            inputPrice.value = servicePrice;

            const inputPetID = document.createElement('input');
            inputPetID.type = 'hidden';
            inputPetID.name = `bill[${index}][petID]`;
            inputPetID.value = pet.id;

            const inputQuantity = document.createElement('input');
            inputQuantity.type = 'hidden';
            inputQuantity.name = `bill[${index}][quantity]`;
            inputQuantity.value = petLodgeQuantity;

            paymentForm.appendChild(inputQuantity);
            paymentForm.appendChild(inputServiceID);
            paymentForm.appendChild(inputPrice);
            paymentForm.appendChild(inputPetID);

        }

        function addFeeToTable(serviceId, serviceName, servicePrice, pet) {
            updateSubTotal(servicePrice);
            index = document.querySelectorAll('table.table-responsive tbody tr').length;
            const tableBody = document.querySelector('table.table-responsive tbody');
            const row = document.createElement('tr');
            row.innerHTML = `
            <td class="" style="vertical-align: middle;">
                <span class="name">${serviceName}</span>
            </td>
            <td class="" style="vertical-align: middle;">
                <span class="pet_name">${pet.name}</span>
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <span>₱</span><span class="price">${servicePrice.toFixed(2)}</span>
            </td>
            <td class="text-center" style="vertical-align: middle;">
                1
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <span>₱</span><span class="quantity-total">${servicePrice.toFixed(2)}</span>
            </td>
            <td class="text-center"
                style="vertical-align: middle; width: 120px; padding: 5px; font-size: 0.85rem;">
                <button type="button" class="btn btn-sm btn-outline-dark"
                    onclick="removeFee(this)"><i class="fa-solid fa-x"></i></button>

            </td>



        `;
            tableBody.appendChild(row);


            const paymentForm = document.getElementById('paymentForm');
            const inputServiceID = document.createElement('input');
            inputServiceID.type = 'hidden';
            inputServiceID.name = `fees[${index}][serviceID]`;
            inputServiceID.value = serviceId;

            const inputPrice = document.createElement('input');
            inputPrice.type = 'hidden';
            inputPrice.name = `fees[${index}][price]`;
            inputPrice.value = servicePrice;

            const inputPetID = document.createElement('input');
            inputPetID.type = 'hidden';
            inputPetID.name = `fees[${index}][petID]`;
            inputPetID.value = pet.id;

            paymentForm.appendChild(inputServiceID);
            paymentForm.appendChild(inputPrice);
            paymentForm.appendChild(inputPetID);

        }

        function addMedicationToTable(serviceId, serviceName, servicePrice, quantity, pet) {
            updateSubTotal(servicePrice * quantity);
            index = document.querySelectorAll('table.table-responsive tbody tr').length;
            const tableBody = document.querySelector('table.table-responsive tbody');
            const row = document.createElement('tr');
            row.innerHTML = `
            <td class="" style="vertical-align: middle;">
                <span class="name">${serviceName}</span>
            </td>
            <td class="" style="vertical-align: middle;">
                <span class="pet_name">${pet.name}</span>
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <span>₱</span><span class="price">${servicePrice.toFixed(2)}</span>
            </td>
            <td class="text-center" style="vertical-align: middle;">
                ${quantity}
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <span class="quantity-total">${(quantity * servicePrice).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</span>
            </td>
            <td class="text-center"
                style="vertical-align: middle; width: 120px; padding: 5px; font-size: 0.85rem;">
                <button type="button" class="btn btn-sm btn-outline-dark"
                    onclick="removeMedication(this)"><i class="fa-solid fa-x"></i></button>

            </td>



        `;
            tableBody.appendChild(row);


            const paymentForm = document.getElementById('paymentForm');
            const inputServiceID = document.createElement('input');
            inputServiceID.type = 'hidden';
            inputServiceID.name = `medications[${index}][serviceID]`;
            inputServiceID.value = serviceId;

            const inputPrice = document.createElement('input');
            inputPrice.type = 'hidden';
            inputPrice.name = `medications[${index}][price]`;
            inputPrice.value = servicePrice;

            const inputPetID = document.createElement('input');
            inputPetID.type = 'hidden';
            inputPetID.name = `medications[${index}][petID]`;
            inputPetID.value = pet.id;

            const inputQuantity = document.createElement('input');
            inputQuantity.type = 'hidden';
            inputQuantity.name = `medications[${index}][quantity]`;
            inputQuantity.value = quantity;


            paymentForm.appendChild(inputQuantity);
            paymentForm.appendChild(inputServiceID);
            paymentForm.appendChild(inputPrice);
            paymentForm.appendChild(inputPetID);

        }

        function removeRow(button) {
            const row = button.closest('tr');
            const tableBody = row.parentNode;
            const rows = Array.from(tableBody.children);
            const index = rows.indexOf(row);

            // 1. Get the price from the row
            const priceElement = row.querySelector('.price');
            const price = parseFloat(priceElement?.textContent || '0') || 0;

            // 2. Subtract from all .subTotal and .total
            const subTotalElements = document.querySelectorAll('.subTotal');
            const totalElements = document.querySelectorAll('.total');

            subTotalElements.forEach(el => {
                let current = parseFloat(el.textContent.replace(/[^\d.]/g, '')) || 0;
                el.textContent = `₱ ${Math.max(0, current - price).toFixed(2)}`;
            });

            totalElements.forEach(el => {
                let current = parseFloat(el.textContent.replace(/[^\d.]/g, '')) || 0;
                el.textContent = `₱ ${Math.max(0, current - price).toFixed(2)}`;
            });

            // 3. Remove hidden inputs based on index
            const paymentForm = document.getElementById('paymentForm');
            const inputNames = [
                `bill[${index}][serviceID]`,
                `bill[${index}][price]`,
                `bill[${index}][petID]`
            ];

            inputNames.forEach(name => {
                const input = paymentForm.querySelector(`input[name="${name}"]`);
                if (input) paymentForm.removeChild(input);
            });

            // 4. Remove the table row
            row.remove();
        }

        function removeFee(button) {
            const row = button.closest('tr');
            const tableBody = row.parentNode;
            const rows = Array.from(tableBody.children);
            const index = rows.indexOf(row);

            // 1. Get the price from the row
            const priceElement = row.querySelector('.price');
            const price = parseFloat(priceElement?.textContent || '0') || 0;

            // 2. Subtract from all .subTotal and .total
            const subTotalElements = document.querySelectorAll('.subTotal');
            const totalElements = document.querySelectorAll('.total');

            subTotalElements.forEach(el => {
                let current = parseFloat(el.textContent.replace(/[^\d.]/g, '')) || 0;
                el.textContent = `₱ ${Math.max(0, current - price).toFixed(2)}`;
            });

            totalElements.forEach(el => {
                let current = parseFloat(el.textContent.replace(/[^\d.]/g, '')) || 0;
                el.textContent = `₱ ${Math.max(0, current - price).toFixed(2)}`;
            });

            // 3. Remove hidden inputs based on index
            const paymentForm = document.getElementById('paymentForm');
            const inputNames = [
                `fee[${index}][serviceID]`,
                `fee[${index}][price]`,
                `fee[${index}][petID]`
            ];

            inputNames.forEach(name => {
                const input = paymentForm.querySelector(`input[name="${name}"]`);
                if (input) paymentForm.removeChild(input);
            });

            // 4. Remove the table row
            row.remove();
        }

        function removeMedication(button) {
            const row = button.closest('tr');
            const tableBody = row.parentNode;
            const rows = Array.from(tableBody.children);
            const index = rows.indexOf(row);

            // 1. Get the price from the row
            const priceElement = row.querySelector('.price');
            const price = parseFloat(priceElement?.textContent || '0') || 0;

            // 2. Subtract from all .subTotal and .total
            const subTotalElements = document.querySelectorAll('.subTotal');
            const totalElements = document.querySelectorAll('.total');

            subTotalElements.forEach(el => {
                let current = parseFloat(el.textContent.replace(/[^\d.]/g, '')) || 0;
                el.textContent = `₱ ${Math.max(0, current - price).toFixed(2)}`;
            });

            totalElements.forEach(el => {
                let current = parseFloat(el.textContent.replace(/[^\d.]/g, '')) || 0;
                el.textContent = `₱ ${Math.max(0, current - price).toFixed(2)}`;
            });

            // 3. Remove hidden inputs based on index
            const paymentForm = document.getElementById('paymentForm');
            const inputNames = [
                `medication[${index}][serviceID]`,
                `medication[${index}][price]`,
                `medication[${index}][petID]`,
                `medication[${index}][quantity]`
            ];

            inputNames.forEach(name => {
                const input = paymentForm.querySelector(`input[name="${name}"]`);
                if (input) paymentForm.removeChild(input);
            });

            // 4. Remove the table row
            row.remove();
        }
    </script>
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
        if (serviceListTable) { // Fixed condition from medListTable to serviceListTable
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

            const pets = @json($pets);

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
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" data-price="{{ $service->service_price }}">{{ $service->service_name }} - ₱{{ $service->service_price }}</option>
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
                const payable = document.getElementById('payable').textContent.replace('₱', '').replace(',',
                    ''); // Get the total payable amount as a number

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
                if ((paymentTypeValue === 'partial_payment' || paymentTypeValue === 'pending_payment') && !
                    dueDateField.value) {
                    isValid = false;
                    showErrorMessage(dueDateField, 'Due date is required for partial or pending payment.');
                }

                // Validate Amount Paid
                if (!amountPaid.value) {
                    isValid = false;
                    showErrorMessage(amountPaid, 'Amount paid is required.');
                }

                // Validate Full Payment Amount
                if (paymentTypeValue === 'full_payment' && parseFloat(amountPaid.value) < parseFloat(
                        payable)) {
                    isValid = false;
                    showErrorMessage(amountPaid,
                        'Amount paid must be equal to or greater than the total payable for full payment.'
                    );
                }

                // If the form is valid, open the confirmation modal
                if (isValid) {
                    const ownerName = owner.selectedOptions[0].text;
                    const petName = pet.selectedOptions[0]?.text || "No pet selected";
                    const servicesList = [];
                    services.forEach(function(service) {
                        const serviceName = service.options[service.selectedIndex]?.text;
                        if (serviceName) {
                            const servicePrice = service.options[service.selectedIndex].dataset
                                .price;
                            servicesList.push(`${serviceName} - ₱${servicePrice}`);
                        }
                    });

                    // Set modal content
                    document.getElementById('ownerName').textContent = ownerName;
                    document.getElementById('petName').textContent = petName;
                    document.getElementById('servicesList').innerHTML = servicesList.map(service =>
                        `<li>${service}</li>`).join('');
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
