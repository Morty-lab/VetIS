@extends('layouts.app')

@section('content')
@include('billing.components.header', ['title' => 'Discounts'], ['icon' => '<i class="fa-solid fa-shield-dog"></i>'])

<div class="container-xl px-4 mt-4">
    <div class="card shadow-none">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Discounts List</span>
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
                            <a href="#" class="btn btn-datatable btn-transparent-dark" data-bs-toggle="modal"
                               data-bs-target="#discountModal-{{$discount->id}}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-datatable btn-transparent-dark" data-bs-toggle="modal"
                               data-bs-target="#editPriceModal-{{$discount->id}}">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a class="btn btn-datatable btn-transparent-dark text-body" data-bs-toggle="modal"
                               data-bs-target="#deleteServiceModal-{{$discount->id}}">
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

<!-- Modals -->
@foreach($discounts as $discount)
<!-- View Modal -->
<div class="modal fade" id="discountModal-{{$discount->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Discount Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7">
                        <label class="form-label text-primary">Discount Name</label>
                        <p>{{$discount->service_name}}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-primary">Percentage</label>
                        <p>{{number_format($discount->service_price * 100, 0)}}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editPriceModal-{{$discount->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('billing.discount.edit', $discount->id) }}" method="POST" onsubmit="return validateEditForm({{$discount->id}})">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Discount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">New Amount for {{$discount->service_name}}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="newDiscountPrice-{{$discount->id}}" name="new_price"
                                   value="{{number_format($discount->service_price * 100, 0)}}">
                            <div class="input-group-text">%</div>
                        </div>
                        <small class="text-danger d-none" id="editError-{{$discount->id}}">Enter a valid percentage (1–100).</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-soft text-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteServiceModal-{{$discount->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('billing.discount.delete', $discount->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Delete Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Delete <strong>{{$discount->service_name}}</strong> with <strong>{{number_format($discount->service_price * 100, 0)}}%</strong> discount?</p>
                    <p>This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-soft text-primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Service</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Add Modal -->
<div class="modal fade" id="addDiscountModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{route('billing.discounts.add')}}" method="POST" onsubmit="return validateAddForm()">
                @csrf
                <input type="hidden" name="service_type" value="discounts">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Discount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Discount Name</label>
                        <input type="text" class="form-control" name="service_name" id="addDiscountName">
                        <small class="text-danger d-none" id="nameError">Discount name is required.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Discount Percentage</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="addDiscountPrice" name="service_price">
                            <div class="input-group-text">%</div>
                        </div>
                        <small class="text-danger d-none" id="addError">Enter a valid percentage (1–100).</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-soft text-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Discount</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function validateAddForm() {
        const nameInput = document.getElementById('addDiscountName');
        const priceInput = document.getElementById('addDiscountPrice');
        const nameError = document.getElementById('nameError');
        const priceError = document.getElementById('addError');

        const name = nameInput.value.trim();
        const price = parseFloat(priceInput.value);

        let valid = true;

        if (name === '') {
            nameError.classList.remove('d-none');
            nameInput.classList.add('is-invalid');
            valid = false;
        } else {
            nameError.classList.add('d-none');
            nameInput.classList.remove('is-invalid');
        }

        if (isNaN(price) || price < 1 || price > 100) {
            priceError.classList.remove('d-none');
            priceInput.classList.add('is-invalid');
            valid = false;
        } else {
            priceError.classList.add('d-none');
            priceInput.classList.remove('is-invalid');
        }

        return valid;
    }

    function validateEditForm(id) {
        const priceInput = document.getElementById('newDiscountPrice-' + id);
        const errorMsg = document.getElementById('editError-' + id);
        const price = parseFloat(priceInput.value);

        if (isNaN(price) || price < 1 || price > 100) {
            errorMsg.classList.remove('d-none');
            priceInput.classList.add('is-invalid');
            return false;
        }

        errorMsg.classList.add('d-none');
        priceInput.classList.remove('is-invalid');
        return true;
    }
</script>
@endsection