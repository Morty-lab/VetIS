@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<!-- Modals -->

<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Supplier</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputSupplierName">Supplier Name</label>
                        <input class="form-control" id="inputSupplierName" type="text" placeholder="Supplier Name" value="">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputSupplierAddress">Supplier Address</label>
                        <input class="form-control" id="inputSupplierAddress" type="text" placeholder="Supplier Address" value="">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputContactPerson">Contact Person</label>
                        <input class="form-control" id="inputContactPerson" type="text" placeholder="Contact Person" value="">
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="phoneNumber">Phone Number</label>
                            <input class="form-control" id="inputPhoneNumber" type="number" placeholder="Enter Phone Number" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="supplierEmailAddress">Email Address</label>
                            <input class="form-control" id="inputSupplierEmailAddress" type="email" placeholder="Enter Email Address" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Add Supplier</button></div>
        </div>
    </div>
</div>

<!-- View Supplier Modal -->
<div class="modal fade" id="viewSupplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <p>Jay Agrivet Supplies</p>
                    </div>
                    <div class="row gx-3 px-1">
                        <div class="col-lg-4">
                            <label class="small mb-1" for="selectUnitType">Contact Person</label>
                            <p>Jay Invento</p>
                        </div>
                        <div class="col-lg-4">
                            <label class="small mb-1" for="supplierContactNumber">Contact Number</label>
                            <p>+639942194953</p>
                        </div>
                        <div class="col-lg-4">
                            <label class="small mb-1" for="supplierEmail">Email</label>
                            <p>jayinvento@gmail.com</p>
                        </div>
                    </div>
                    <div class="mb-3 px-1">
                        <label class="small mb-1" for="inputProductName">Address</label>
                        <p>Purok - 3, Batangan, Valencia City, Bukidnon</p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary mb-1" data-bs-toggle="modal" data-bs-target="#editSupplierModal">Edit Supplier</button>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete Supplier</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Supplier Modal -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Supplier</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputSupplierName">Supplier Name</label>
                        <input class="form-control" id="inputSupplierName" type="text" placeholder="Supplier Name" value="Jay Agrivet Supplies">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputSupplierAddress">Supplier Address</label>
                        <input class="form-control" id="inputSupplierAddress" type="text" placeholder="Supplier Address" value="Purok - 3, Batangan, Valencia City, Bukidnon">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputContactPerson">Contact Person</label>
                        <input class="form-control" id="inputContactPerson" type="text" placeholder="Contact Person" value="Jay Invento">
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="phoneNumber">Phone Number</label>
                            <input class="form-control" id="inputPhoneNumber" type="number" placeholder="Enter Phone Number" value="639942194953">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="supplierEmailAddress">Email Address</label>
                            <input class="form-control" id="inputSupplierEmailAddress" type="email" placeholder="Enter Email Address" value="jayinvento@gmail.com">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Add Supplier</button></div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Delete Supplier</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <span class="text-primary">Supplier Name</span>?</p>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-danger" type="button">Delete Supplier</button></div>
        </div>
    </div>
</div>



<div class="container-xl px-4 mt-4">
    <div class="card mb-4">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Suppliers List</span>
            <button class="btn btn-primary justify-end" data-bs-toggle="modal" data-bs-target="#addSupplierModal">Add Supplier</button>
        </div>
        <div class="card-body">
            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                <div class="datatable-top">
                    <div class="datatable-dropdown">
                        <label>
                            <select class="datatable-selector" name="per-page">
                                <option value="5">5</option>
                                <option value="10" selected="">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                            </select> entries per page
                        </label>
                    </div>
                    <div class="datatable-search">
                        <input class="datatable-input" placeholder="Search..." type="search" name="search" title="Search within table" aria-controls="datatablesSimple">
                    </div>
                </div>
                <div class="datatable-container">
                    <table class="datatable-table">
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
                            <tr>
                                <td>Jay Agrivet Supplies</td>
                                <td>Jay Invento</td>
                                <td>+639942194953</td>
                                <td>jayinvento@gmail.com</td>
                                <td>Purok - 3, Batangan, Valencia City, Bukidnon</td>
                                <td>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2" data-bs-toggle="modal" data-bs-target="#viewSupplierModal"><i data-feather="more-vertical"></i></button>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"><i data-feather="trash-2"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

@endsection