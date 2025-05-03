@extends('layouts.app')

@section('styles')
<!-- You can add additional styles for the modal here -->
@endsection

@section('content')
@include('billing.components.header', ['title' => 'Services'], ['icon' => '<i class="fa-solid fa-shield-dog"></i>'])

<div class="container-xl px-4 mt-4">
    <div class="card shadow-none">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Services List</span>
            <!-- Trigger the modal -->
            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#addServiceModal">Add Service</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Base Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{$service->service_name}}</td>
                        <td>₱ {{ number_format($service->service_price, 2) }}</td>
                        <td><!-- Open modal with service details -->
                            <a href="#" class="btn btn-datatable btn-transparent-dark" data-bs-toggle="modal"
                               data-bs-target="#serviceModal-{{$service->id}}"
                               data-name="Consultation" data-price="50">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-datatable btn-transparent-dark" data-bs-toggle="modal"
                               data-bs-target="#editPriceModal-{{$service->id}}">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <button class="btn btn-datatable btn-transparent-dark text-body" data-bs-toggle="modal"
                               data-bs-target="#deleteServiceModal-{{$service->id}}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for viewing service details -->
@foreach($services as $service)
<div class="modal fade" id="serviceModal-{{$service->id}}" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Service Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Service details form -->
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-7">
                            <label for="serviceName" class="form-label text-primary">Service Name</label>
                            <p>{{$service->service_name}}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="servicePrice" class="form-label text-primary">Service Price</label>
                            <p>₱ {{ number_format($service->service_price, 2) }}</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal for editing service price -->
<div class="modal fade" id="editPriceModal-{{$service->id}}" tabindex="-1" aria-labelledby="editPriceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPriceModalLabel">Edit Service Price</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('billing.services.update', $service->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="newServicePrice-{{$service->id}}" class="form-label">New Price for {{$service->service_name}}</label>
                        <div class="input-group input-group-prepend">
                            <span class="input-group-text">₱</span>
                            <input type="number" step="0.01"
                                   class="form-control @error('new_price') is-invalid @enderror"
                                   id="newServicePrice-{{$service->id}}"
                                   name="new_price"
                                   value="{{ old('new_price', $service->service_price) }}" required>
                        </div>
                        @error('new_price')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary-soft text-primary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="savePriceBtn">Save Price</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal for deleting service -->
<div class="modal fade" id="deleteServiceModal-{{$service->id}}" tabindex="-1" aria-labelledby="deleteServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteServiceModalLabel">Delete Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the service <strong>{{$service->service_name}}</strong> with price <strong>₱{{$service->service_price}}</strong>?</p>
                <p>This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary-soft text-primary" data-bs-dismiss="modal">Cancel</button>
                <!-- The delete button, which will be hooked to the service's delete action -->
                <form action="{{ route('billing.services.delete', $service->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Service</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endforeach




<!-- Modal for adding new service -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{route('billing.services.add')}}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="service_type" value="services">
                    <div class="mb-3">
                        <label for="serviceName" class="form-label">Service Name</label>
                        <input type="text" class="form-control @error('service_name') is-invalid @enderror" id="serviceName" name="service_name" autocomplete="off">
                        @error('service_name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="servicePrice" class="form-label">Service Price</label>
                        <div class="input-group input-group-prepend">
                            <span class="input-group-text">₱</span>
                            <input type="number" step="0.01" class="form-control @error('service_price') is-invalid @enderror" id="servicePrice"
                                   name="service_price" autocomplete="off">
                        </div>
                        @error('service_price')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-soft text-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    // When the "Open" button is clicked, populate the modal with the service details
    var serviceModal = document.getElementById('serviceModal');
    serviceModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var serviceName = button.getAttribute('data-name');
        var servicePrice = button.getAttribute('data-price');

        var modalServiceName = serviceModal.querySelector('#serviceName');
        var modalServicePrice = serviceModal.querySelector('#servicePrice');

        // Update modal content
        modalServiceName.value = serviceName;
        modalServicePrice.value = servicePrice;
    });

    // Handle delete button click
    document.getElementById('deleteService').addEventListener('click', function() {
        // Add logic to delete the service
        alert('Service Deleted');
    });

    // Handle edit price button click
    document.getElementById('savePriceBtn').addEventListener('click', function() {
        var newPrice = document.getElementById('newServicePrice').value;
        // Add logic to update the price
        alert('Price Updated to ' + newPrice);
    });
        document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('#addServiceModal form');
        const servicePriceInput = document.getElementById('servicePrice');

        // Block letters and negative numbers while typing
        servicePriceInput.addEventListener('keypress', function (e) {
        const char = String.fromCharCode(e.which);
        if (!/[0-9.]/.test(char)) {
        e.preventDefault();
    }
    });

        // Prevent pasting non-numeric or invalid data
        servicePriceInput.addEventListener('paste', function (e) {
        const pasteData = e.clipboardData.getData('text');
        if (!/^\d*\.?\d*$/.test(pasteData)) {
        e.preventDefault();
    }
    });

        // Validate before submit
        form.addEventListener('submit', function (e) {
        const value = parseFloat(servicePriceInput.value);

        if (isNaN(value) || value <= 0) {
        e.preventDefault(); // block form submission
        servicePriceInput.classList.add('is-invalid');
        showError("Please enter a valid service price greater than 0.");
    } else {
        servicePriceInput.classList.remove('is-invalid');
        clearError();
    }
    });

        function showError(message) {
        let errorEl = document.getElementById('priceError');
        if (!errorEl) {
        errorEl = document.createElement('div');
        errorEl.id = 'priceError';
        errorEl.className = 'text-danger mt-1';
        servicePriceInput.parentElement.appendChild(errorEl);
    }
        errorEl.textContent = message;
    }

        function clearError() {
        const errorEl = document.getElementById('priceError');
        if (errorEl) {
        errorEl.remove();
    }
    }
    });
</script>

@endsection
