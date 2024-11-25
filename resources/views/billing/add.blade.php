@extends('layouts.app')

@section('styles')

@endsection

@section('content')
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
<div class="container-xl px-4 mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <nav class="nav nav-borders">
                <a class="nav-link ms-0" href="{{route('billing')}}"><span class="px-2"><i class="fa-solid fa-arrow-left"></i></span> Back</a>
            </nav>
            <hr class="mt-0 mb-4">
            <div class="card shadow-none mb-4">
                <div class="card-header">Billing Form</div>
                <div class="card-body">
                    <form action="{{route('billing.store')}}" method="POST">
                        @csrf
                        <div class="row gx-3">
                            <div class="col-md-12">
                                <div class="row gx-3 p-3 rounded border">
                                    <div class="row gx-3">
                                        <div class="col-md-6">
                                            <h1 class="mb-0">Pruderich Veterinary Clinic</h1>
                                            <p class="mb-0">Purok - 3, Dologon, Maramag, Bukidnon</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <!-- Billing Number -->
                                                @php
                                                $latestRecord = \App\Models\Billing::latest('id')->first();
                                                $selectedOwnerID = 0;
                                                @endphp
                                                <div class="col-md-7 mt-1 mt-md-0">
                                                    <label for="billing_number" class="form-label mb-0  text-primary">Billing Number</label>
                                                    <p class="mb-0">#@if($latestRecord != null){{sprintf("VETISBILL-%05d",$latestRecord->id +1)}} @else {{sprintf("VETISBill-%05d",1)}} @endif</p>
                                                </div>
                                                <!-- Billing Date -->
                                                <div class="col-md-5 mt-1 mt-md-0">
                                                    <label for="billing_date" class="form-label mb-0 text-primary">Date</label>
                                                    <p class="mb-0">11/23/2024</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mt-1 mb-3">
                            <!-- Owner Dropdown -->
                            <div class="col-md-6">
                                <label for="owner" class="form-label">Owner</label>
                                <select class="form-select" id="owner" name="user_id" required>
                                    <option value="" disabled selected>Select an owner</option>
                                    @foreach($owner as $o)
                                    <option value="{{ $o->id }}">{{ $o->client_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pet -->
                            <div class="col-md-6">
                                <label for="pet" class="form-label">Pet</label>
                                <select class="form-select" id="pet" name="pet_id" required>
                                    <option value="" disabled selected>Select a pet</option>
                                    <!-- Pet options will be dynamically updated by JavaScript -->
                                </select>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <label class="form-label">Services Availed</label>
                            <!-- Services Availed -->
                            <div class="col-12">
                                <div id="services-container">
                                    <div class="input-group mb-2">
                                        <select class="form-select service" name="services[]" required>
                                            <option value="" disabled selected>Select a service</option>
                                            <!-- Dynamic service options with prices -->
                                            @foreach($services as $service)
                                            <option value="{{$service->id}}" data-price="{{$service->service_price}}">{{$service->service_name}} - ₱{{$service->service_price}}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-outline-secondary add-service">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="paymentType" class="form-label">Payment Type</label>
                                <select class="form-select" id="paymentType" name="payment_type" required>
                                    <option value="" disabled selected>Select Payment Type</option>
                                    <option value="full_payment">Full Payment</option>
                                    <option value="partial_payment">Partial Payment</option>
                                    <option value="pending_payment">Pending Payment</option>
                                </select>
                            </div>

                            <!-- Due Date Field -->
                            <div class="col-12 mt-3" id="due-date-container" style="display: none;">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" class="form-control" id="due_date" name="due_date"
                                    min="{{ \Carbon\Carbon::today()->toDateString() }}" required>
                            </div>

                            <!-- Amount Paid -->
                            <!-- Total Payable -->
                            <div class="col-md-6">
                                <label for="payable" class="form-label mb-1">Total Payable</label>
                                <p id="payable" class="p-2 ps-3 text-primary fw-bold text-lg rounded border">₱0.00</p>
                            </div>
                            <div class=" col-md-6">
                                <label for="amount_paid" class="form-label mb-1">Amount Paid</label>
                                <input type="number" class="form-control p-3" id="amount_paid" name="total_paid" step="0.01" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="button" id="openConfirmationModal" class="btn btn-primary">Submit Billing</button>

                            </div>
                        </div>
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
                <button type="submit" class="btn btn-primary" form="billingForm">Confirm and Submit</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
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