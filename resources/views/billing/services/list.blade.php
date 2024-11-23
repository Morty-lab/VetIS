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
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{$service->service_name}}</td>
                        <td>PHP {{$service->service_price}}</td>
                        <td>
                            <!-- Open modal with service details -->
                            <a href="#" class="btn btn-datatable btn-primary px-5 py-3" data-bs-toggle="modal" data-bs-target="#serviceModal-{{$service->id}}"
                                data-name="Consultation" data-price="50">
                                Open
                            </a>
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
                    <div class="mb-3">
                        <label for="serviceName" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="serviceName" value="{{$service->service_name}}" name="service_name" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="servicePrice" class="form-label">Service Price</label>
                        <input type="number" class="form-control" id="servicePrice" value="{{$service->service_price}}" name="price" required readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Edit Price Button -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPriceModal-{{$service->id}}">Edit Price</button>
                <!-- Delete Button -->
                <button type="button" class="btn btn-danger" id="deleteService">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="newServicePrice-{{$service->id}}" class="form-label">New Price for {{$service->service_name}}</label>
                        <!-- Use the old price as the value -->
                        <input type="number" class="form-control" id="newServicePrice-{{$service->id}}" name="new_price" value="{{$service->service_price}}" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="savePriceBtn">Save Price</button>
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
                    <div class="mb-3">
                        <label for="serviceName" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="serviceName" name="service_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="servicePrice" class="form-label">Service Price</label>
                        <input type="number" class="form-control" id="servicePrice" name="service_price" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
</script>

@endsection