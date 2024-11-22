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
    <div class="card shadow-none mb-4">
        <div class="card-header">Billing Form</div>
        <div class="card-body">
            <form action="/billing/create" method="POST">
                <div class="row g-3">
                    <!-- Billing Number -->
                    <div class="col-md-6">
                        <label for="billing_number" class="form-label">Billing Number</label>
                        <input type="text" class="form-control" id="billing_number" name="billing_number" required readonly value="#324234">
                    </div>

                    <!-- Billing Date -->
                    <div class="col-md-6">
                        <label for="billing_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="billing_date" name="billing_date" required>
                    </div>

                    <!-- Owner -->
                    <div class="col-md-6">
                        <label for="owner" class="form-label">Owner</label>
                        <select class="form-select" id="owner" name="owner" required>
                            <option value="" disabled selected>Select an owner</option>
                            <!-- Dynamic options -->
                            <option value="1">John Doe</option>
                            <option value="2">Jane Smith</option>
                        </select>
                    </div>

                    <!-- Pet -->
                    <div class="col-md-6">
                        <label for="pet" class="form-label">Pet</label>
                        <select class="form-select" id="pet" name="pet" required>
                            <option value="" disabled selected>Select a pet</option>
                            <!-- Dynamic options -->
                            <option value="1">Buddy</option>
                            <option value="2">Bella</option>
                        </select>
                    </div>

                    <!-- Services Availed -->
                    <div class="col-12">
                        <label class="form-label">Services Availed</label>
                        <div id="services-container">
                            <div class="input-group mb-2">
                                <select class="form-select service" name="services[]" required>
                                    <option value="" disabled selected>Select a service</option>
                                    <!-- Dynamic service options with prices -->
                                    <option value="consultation" data-price="500">Consultation - ₱500</option>
                                    <option value="vaccination" data-price="800">Vaccination - ₱800</option>
                                    <option value="grooming" data-price="1000">Grooming - ₱1000</option>
                                </select>
                                <button type="button" class="btn btn-outline-secondary add-service">Add</button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row g-3">
                    <!-- Payment Option -->
                    <div class="col-12">
                        <label for="paymentType" class="form-label">Payment Type</label>
                        <select class="form-select" id="paymentType" name="paymentType" required>
                            <option value="" disabled selected>Select Payment Type</option>
                            <option value="full_payment">Full Payment</option>
                            <option value="partial_payment">Partial Payment</option>
                            <option value="pending_payment">Pending Payment</option>
                        </select>
                    </div>

                    <!-- Amount Paid -->
                    <!-- Total Payable -->
                    <div class="col-md-6">
                        <label for="payable" class="form-label">Total Payable</label>
                        <input type="number" class="form-control" id="payable" name="payable" step="0.01" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="amount_paid" class="form-label">Amount Paid</label>
                        <input type="number" class="form-control" id="amount_paid" name="amount_paid" step="0.01" required>
                    </div>
                    <!-- Remaining Balance -->
                    <div class="col-md-6">
                        <label for="remaining" class="form-label">Remaining Balance</label>
                        <input type="number" class="form-control" id="remaining" name="remaining" step="0.01">
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit Billing</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.service').forEach(service => {
            const selectedOption = service.options[service.selectedIndex];
            if (selectedOption && selectedOption.dataset.price) {
                total += parseFloat(selectedOption.dataset.price);
            }
        });
        document.getElementById('payable').value = total.toFixed(2);
    }

    // Add more service selection
    document.addEventListener("click", function(event) {
        if (event.target.classList.contains("add-service")) {
            const container = document.getElementById("services-container");
            const newService = document.createElement("div");
            newService.className = "input-group mb-2";
            newService.innerHTML = `
                <select class="form-select service" name="services[]" required>
                    <option value="" disabled selected>Select a service</option>
                    <option value="consultation" data-price="500">Consultation - ₱500</option>
                    <option value="vaccination" data-price="800">Vaccination - ₱800</option>
                    <option value="grooming" data-price="1000">Grooming - ₱1000</option>
                </select>
                <button type="button" class="btn btn-outline-danger remove-service">Remove</button>
            `;
            container.appendChild(newService);
            updateTotal(); // Recalculate total
        }

        // Remove service selection
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
</script>
@endsection