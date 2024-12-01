@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<!-- Modals -->

<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Supplier</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('suppliers.add') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="small mb-1" for="inputSupplierName">Supplier Name</label>
                        <input class="form-control" id="inputSupplierName" type="text" placeholder="Supplier Name"
                            name="supplier_name">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputSupplierAddress">Supplier Address</label>
                        <input class="form-control" id="inputSupplierAddress" type="text"
                            placeholder="Supplier Address" name="supplier_address">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputContactPerson">Contact Person</label>
                        <input class="form-control" id="inputContactPerson" type="text" placeholder="Contact Person"
                            name="supplier_contact_person">
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="phoneNumber">Phone Number</label>
                            <input class="form-control" id="inputPhoneNumber" type="text"
                                placeholder="Enter Phone Number" name="supplier_phone_number">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="supplierEmailAddress">Email Address</label>
                            <input class="form-control" id="inputSupplierEmailAddress" type="email"
                                placeholder="Enter Email Address" name="supplier_email_address">
                        </div>
                    </div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button"
                    data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Add
                    Supplier</button></div>
        </div>
        </form>

    </div>
</div>

@foreach ($suppliers as $i)
<!-- View Supplier Modal -->
<div class="modal fade" id="viewSupplierModal{{ $i->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Supplier Info</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3 px-1">
                        <label class="small mb-1" for="inputSupplierName">Supplier Name</label>
                        <p>{{ $i->supplier_name }}</p>
                    </div>
                    <div class="row gx-3 px-1">
                        <div class="col-lg-4">
                            <label class="small mb-1" for="selectUnitType">Contact Person</label>
                            <p>{{ $i->supplier_contact_person }}</p>
                        </div>
                        <div class="col-lg-4">
                            <label class="small mb-1" for="supplierContactNumber">Contact Number</label>
                            <p>{{ $i->supplier_phone_number }}</p>
                        </div>
                        <div class="col-lg-4">
                            <label class="small mb-1" for="supplierEmail">Email</label>
                            <p>{{ $i->supplier_email_address }}</p>
                        </div>
                    </div>
                    <div class="mb-3 px-1">
                        <label class="small mb-1" for="inputProductName">Address</label>
                        <p>{{ $i->supplier_address }}</p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary mb-1" data-bs-toggle="modal"
                    data-bs-target="#editSupplierModal{{ $i->id }}">Edit Supplier</button>
                <button class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#confirmDeleteModal{{ $i->id }}">Delete Supplier</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Supplier Modal -->
<div class="modal fade" id="editSupplierModal{{ $i->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Update Supplier Information</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('suppliers.update', $i->id) }}" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label class="small mb-1" for="inputSupplierName">Supplier Name</label>
                        <input class="form-control" id="inputSupplierName" type="text"
                            placeholder="Supplier Name" value="{{ $i->supplier_name }}" name="supplier_name">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputSupplierAddress">Supplier Address</label>
                        <input class="form-control" id="inputSupplierAddress" type="text"
                            placeholder="Supplier Address" value="{{ $i->supplier_address }}"
                            name="supplier_address">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputContactPerson">Contact Person</label>
                        <input class="form-control" id="inputContactPerson" type="text"
                            placeholder="Contact Person" value="{{ $i->supplier_contact_person }}"
                            name="supplier_contact_person">
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="phoneNumber">Phone Number</label>
                            <input class="form-control" id="inputPhoneNumber" type="text"
                                placeholder="Enter Phone Number" value="{{ $i->supplier_phone_number }}"
                                name="supplier_phone_number">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="supplierEmailAddress">Email Address</label>
                            <input class="form-control" id="inputSupplierEmailAddress" type="email"
                                placeholder="Enter Email Address" value="{{ $i->supplier_email_address }}"
                                name="supplier_email_address">
                        </div>
                    </div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button"
                    data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Update
                    Supplier</button></div>
        </div>
        </form>

    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal{{ $i->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Delete Supplier</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <span class="text-primary">{{ $i->supplier_name }}</span>?</p>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button"
                    data-bs-dismiss="modal">Cancel</button><a href="{{ route('suppliers.delete', $i->id) }}"
                    class="btn btn-danger" type="button">Delete
                    Supplier</a></div>
        </div>
    </div>
</div>
@endforeach

@include('inventory.general.header', ['title' => 'Suppliers'], ['icon' => '<i class="fa-solid fa-truck-field"></i>'])

<div class="container-xl px-4 mt-4">
    <div class="card mb-4 shadow-none">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Suppliers List</span>
            <button class="btn btn-primary justify-end" data-bs-toggle="modal" data-bs-target="#addSupplierModal">Add
                Supplier</button>
        </div>
        <div class="card-body">
            <table id="inventorySuppliersTable">
                <thead>
                    <tr>
                        <th>Supplier Name</th>
                        <th>Contact Person</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->supplier_name }}</td>
                        <td>{{ $supplier->supplier_contact_person }}</td>
                        <td>{{ $supplier->supplier_phone_number }}</td>
                        <td>{{ $supplier->supplier_email_address }}</td>
                        <td>{{ $supplier->supplier_address }}</td>
                        <td>
                            <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                data-bs-toggle="modal"
                                data-bs-target="#viewSupplierModal{{ $supplier->id }}"><i
                                    data-feather="more-vertical"></i></button>
                            <button class="btn btn-datatable btn-icon btn-transparent-dark"
                                data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal{{ $supplier->id }}"><i
                                    data-feather="trash-2"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection