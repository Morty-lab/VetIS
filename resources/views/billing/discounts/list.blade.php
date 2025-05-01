@extends('layouts.app')

@section('styles')
<!-- You can add additional styles for the modal here -->
@endsection

@section('content')
@include('billing.components.header', ['title' => 'Discounts'], ['icon' => '<i class="fa-solid fa-shield-dog"></i>'])

<div class="container-xl px-4 mt-4">
    <div class="card shadow-none">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Discounts List</span>
            <!-- Trigger the modal -->
            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#addDiscountModal">Add Discount</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Discount</th>
                        <th>Percentage/Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($discounts as $discount)
                    <tr>
                        <td>{{$discount->service_name}}</td>
                        <td>{{number_format($discount->service_price * 100, 0)}}%</td>
                        <td>
                            <!-- Open modal with discount details -->
                            <a href="#" class="btn btn-datatable btn-primary px-5 py-3" data-bs-toggle="modal" data-bs-target="#discountModal-{{$discount->id}}"
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

<!-- Modal for viewing discount details -->
@foreach($discounts as $discount)
<div class="modal fade" id="discountModal-{{$discount->id}}" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="discountModalLabel">Discount Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Discount details form -->
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="discountName" class="form-label">Discount Name</label>
                        <input type="text" class="form-control" id="discountName" value="{{$discount->service_name}}" name="discount_name" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="discountPrice" class="form-label">Discount Percentage</label>
                        <input type="number" class="form-control" id="discountPrice" value="{{number_format($discount->service_price * 100, 0)}}" name="price" required readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Edit Price Button -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPriceModal-{{$discount->id}}">Edit Price</button>
                <!-- Delete Button -->
                <button type="button" class="btn btn-danger" id="deleteDiscount">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal for editing discount price -->
<div class="modal fade" id="editPriceModal-{{$discount->id}}" tabindex="-1" aria-labelledby="editPriceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPriceModalLabel">Edit Discount Price</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="newDiscountPrice-{{$discount->id}}" class="form-label">New Amount for {{$discount->service_name}}</label>
                        <!-- Use the old price as the value -->
                        <input type="number" class="form-control" id="newDiscountPrice-{{$discount->id}}" name="new_price" value="{{number_format($discount->service_price * 100, 0)}}" required>
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




<!-- Modal for adding new discount -->
<div class="modal fade" id="addDiscountModal" tabindex="-1" aria-labelledby="addDiscountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{route('billing.discounts.add',)}}" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title" id="addDiscountModalLabel">Add New Discount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="service_type" value="discounts">

                    <div class="mb-3">
                        <label for="discountName" class="form-label">Discount Name</label>
                        <input type="text" class="form-control" id="discountName" name="service_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="discountPrice" class="form-label">Discount Percentage</label>
                        <input type="number" class="form-control" id="discountPrice" name="service_price" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Discount</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    // When the "Open" button is clicked, populate the modal with the discount details
    var discountModal = document.getElementById('discountModal');
    discountModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var discountName = button.getAttribute('data-name');
        var discountPrice = button.getAttribute('data-price');

        var modalDiscountName = discountModal.querySelector('#discountName');
        var modalDiscountPrice = discountModal.querySelector('#discountPrice');

        // Update modal content
        modalDiscountName.value = discountName;
        modalDiscountPrice.value = discountPrice;
    });

    // Handle delete button click
    document.getElementById('deleteDiscount').addEventListener('click', function() {
        // Add logic to delete the discount
        alert('Discount Deleted');
    });

    // Handle edit price button click
    document.getElementById('savePriceBtn').addEventListener('click', function() {
        var newPrice = document.getElementById('newDiscountPrice').value;
        // Add logic to update the price
        alert('Price Updated to ' + newPrice);
    });
</script>

@endsection

