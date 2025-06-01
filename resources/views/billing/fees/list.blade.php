@extends('layouts.app')

@section('styles')
<!-- You can add additional styles for the modal here -->
@endsection

@section('content')
@include('billing.components.header', ['title' => 'Fees'], ['icon' => '<i class="fa-solid fa-shield-dog"></i>'])

<div class="container-xl px-4 mt-4">
    <div class="card shadow-none">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Fees List</span>
            <!-- Trigger the modal -->
            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#addServiceModal">Add Fee</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Fee</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{$service->service_name}}</td>
                        <td>₱ {{ number_format($service->service_price, 2)}}</td>
                        <td>
                            <a href="#" class="btn btn-datatable btn-transparent-dark" data-bs-toggle="modal"
                               data-bs-target="#serviceModal-{{$service->id}}"
                               data-name="Consultation" data-price="50">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-datatable btn-transparent-dark" data-bs-toggle="modal"
                               data-bs-target="#editPriceModal-{{$service->id}}">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a class="btn btn-datatable btn-transparent-dark text-body" data-bs-toggle="modal"
                               data-bs-target="#deleteServiceModal-{{$service->id}}">
                                <i class="fa-solid fa-trash"></i>
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
                <h5 class="modal-title" id="serviceModalLabel">Fee Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7">
                        <label for="serviceName" class="form-label text-primary">Fee</label>
                        <p>{{$service->service_name}}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="servicePrice" class="form-label text-primary">Price</label>
                        <p>₱ {{ number_format($service->service_price, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal for editing service price -->
<div class="modal fade" id="editPriceModal-{{$service->id}}" tabindex="-1" aria-labelledby="editPriceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPriceModalLabel">Edit Fee Price</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('billing.fees.edit', $service->id) }}" method="POST">
                    @csrf
                    @method('PUT')
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="newServicePrice-{{$service->id}}" class="form-label">New Price for {{$service->service_name}}</label>
                        <!-- Use the old price as the value -->
                        <div class="input-group input-group-prepend">
                            <div class="input-group-text">
                                ₱
                            </div>
                            <input type="number" class="form-control" id="newServicePrice-{{$service->id}}" name="new_price" value="{{$service->service_price}}" required>
                        </div>
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
                <form action="{{ route('billing.fees.delete', $service->id) }}" method="POST" class="d-inline">
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
            <form action="{{route('billing.fees.add')}}" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">Add New Fee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="service_type" value="fees">
                    <div class="mb-3">
                        <label for="serviceName" class="form-label">Fee Name</label>
                        <input type="text" class="form-control" id="serviceName" name="service_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="servicePrice" class="form-label">Fee Price</label>
                        <div class="input-group input-group-prepend">
                            <div class="input-group-text">
                                ₱
                            </div>
                            <input type="number" class="form-control" id="servicePrice" name="service_price" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-soft text-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Fee</button>
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
