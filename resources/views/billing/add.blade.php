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
            <form action="{{route('billing.store')}}" method="POST">
                @csrf
                <div class="row g-3">
                    <!-- Billing Number -->
                    @php
                        $latestRecord = \App\Models\Billing::latest('id')->first();
                        $selectedOwnerID = 0;
                    @endphp
                    <div class="col-md-6">
                        <label for="billing_number" class="form-label">Billing Number</label>
                        <input type="text" class="form-control" id="billing_number" name="billing_number" required readonly value="#@if($latestRecord != null) {{sprintf("VETISBill-%05d",$latestRecord->id +1)}} @else {{sprintf("VETISBill-%05d",1)}} @endif">
                    </div>

                    <!-- Billing Date -->
                    <div class="col-md-6">
                        <label for="billing_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="billing_date" name="billing_date" required>
                    </div>

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

                    <!-- Services Availed -->
                    <div class="col-12">
                        <label class="form-label">Services Availed</label>
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
                    <!-- Payment Option -->
                    <div class="col-12">
                        <label for="paymentType" class="form-label">Payment Type</label>
                        <select class="form-select" id="paymentType" name="payment_type" required>
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
                        <input type="number" class="form-control" id="payable" name="total_payable" step="0.01" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="amount_paid" class="form-label">Amount Paid</label>
                        <input type="number" class="form-control" id="amount_paid" name="total_paid" step="0.01" required>
                    </div>
                    <!-- Remaining Balance -->
{{--                    <div class="col-md-6">--}}
{{--                        <label for="remaining" class="form-label">Remaining Balance</label>--}}
{{--                        <input type="number" class="form-control" id="remaining" name="remaining" step="0.01">--}}
{{--                    </div>--}}

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
    const pets = @json($pet);

    // Ensure the DOM is fully loaded before adding the event listener
    document.addEventListener('DOMContentLoaded', function () {
        const ownerDropdown = document.getElementById('owner');
        ownerDropdown.addEventListener('change', function () {
            const selectedOwnerId = parseInt(this.value);
            SelectOwner(selectedOwnerId);
        });
    });



    // Filter pets based on owner ID
    function SelectOwner(ownerId) {
        console.log(pets);
        console.log(`Selected Owner ID: ${ownerId}`); // Debugging


        const petDropdown = document.getElementById('pet');
        petDropdown.innerHTML = `<option value="" disabled selected>Select a pet</option>`; // Reset options

        // Filter pets by ownerId
        const filteredPets = pets.filter(pet => pet.owner_ID === ownerId);

        // Populate the dropdown with filtered pets
        filteredPets.forEach(pet => {
            const option = document.createElement('option');
            option.value = pet.id;
            option.textContent = pet.pet_name;
            petDropdown.appendChild(option);
        });
    }
</script>

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
                     @foreach($services as $service)
                        <option value="{{$service->id}}" data-price="{{$service->service_price}}">{{$service->service_name}} - ₱{{$service->service_price}}</option>
                    @endforeach
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
