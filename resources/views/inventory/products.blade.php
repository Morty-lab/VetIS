@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<!-- Modals -->

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Product</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputProductName">Product Name</label>
                        <input class="form-control" id="inputProductName" type="text" placeholder="Product Name" value="">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="selectSupplier">Supplier</label>
                        <select class="form-control" id="selectSupplier">
                            <option disabled="" selected="">-- Select Supplier --</option>
                            <option>Supplier 1</option>
                            <option>Supplier 2</option>
                            <option>Supplier 3</option>
                        </select>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectProductCategory">Product Category</label>
                            <select class="form-control" id="selectProductCategory">
                                <option disabled="" selected="">-- Select Product Category --</option>
                                <option>Category 1</option>
                                <option>Category 2</option>
                                <option>Category 3</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectUnitType">Unit Type</label>
                            <select class="form-control" id="selectUnitType">
                                <option disabled="" selected="">-- Select Unit Type --</option>
                                <option>Unit 1</option>
                                <option>Unit 2</option>
                                <option>Unit 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="productPrice">Product Price</label>
                            <input class="form-control" id="inputBreed" type="number" placeholder="Enter Price" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="productStock">Product Stock</label>
                            <input class="form-control" id="inputBreed" type="number" placeholder="Add Stock" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Save changes</button></div>
        </div>
    </div>
</div>

<!-- View Product Modal -->
<div class="modal fade" id="viewProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Product Info</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3 px-1">
                        <label class="small mb-1" for="inputProductName">Product Name</label>
                        <p>Advantage II for Cats</p>
                    </div>
                    <div class="px-1">
                        <label class="small mb-1" for="selectProductCategory">Product Category</label>
                        <p>Flea Treatment</p>
                    </div>
                    <div class="px-1">
                        <label class="small mb-1" for="productSupplier">Supplier</label>
                        <p>Jay Vet Supplies</p>
                    </div>
                    <hr>
                    <div class="row gx-3 mb-3 px-1">
                        <div class="col-md-3">
                            <label class="small mb-1" for="selectUnitType">Unit Type</label>
                            <p>Pack</p>
                        </div>
                        <div class="col-md-3">
                            <label class="small mb-1" for="productPrice">Product Price</label>
                            <p>$50.99</p>
                        </div>
                        <div class="col-md-3">
                            <label class="small mb-1" for="productStock">Product Stock</label>
                            <p>500</p>
                        </div>
                        <div class="col-md-3">
                            <label class="small mb-1" for="productStock">Status</label>
                            <div class="badge bg-primary text-white rounded-pill">Available</div>
                        </div>
                    </div>
                    <hr>
                </form>
                <div class="row gx-3 mb-3 py-1">
                    <p for="" class="small mb-2">Actions</p>
                    <div class="col-md-4">
                        <button class="btn btn-primary w-100 mb-1" data-bs-toggle="modal" data-bs-target="#addStocksModal">Add Stocks</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-secondary w-100 mb-1" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit Product</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete Product</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Product</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputProductName">Product Name</label>
                        <input class="form-control" id="inputProductName" type="text" placeholder="Product Name" value="Product Name">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="selectSupplier">Supplier</label>
                        <select class="form-control" id="selectSupplier">
                            <option disabled="">-- Select Supplier --</option>
                            <option>Supplier 1</option>
                            <option>Supplier 2</option>
                            <option selected>Supplier 3</option>
                        </select>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectProductCategory">Product Category</label>
                            <select class="form-control" id="selectProductCategory">
                                <option disabled="">-- Select Product Category --</option>
                                <option selected>Category 1</option>
                                <option>Category 2</option>
                                <option>Category 3</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectUnitType">Unit Type</label>
                            <select class="form-control" id="selectUnitType">
                                <option disabled="" selected="">-- Select Unit Type --</option>
                                <option>Unit 1</option>
                                <option selected>Unit 2</option>
                                <option>Unit 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="productPrice">Product Price</label>
                            <input class="form-control" id="inputBreed" type="number" placeholder="Enter Price" value="50.99">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="productStock">Product Stock</label>
                            <input class="form-control" id="inputBreed" type="number" placeholder="Enter Stock" value="50">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Save changes</button></div>
        </div>
    </div>
</div>

<!-- Add Stocks Modal -->
<div class="modal fade" id="addStocksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Stocks for Product Name</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputAddStockAmount">Enter Stocks</label>
                        <input class="form-control" id="inputAddStockAmount" type="number" placeholder="Enter Stock Amount" value="">
                    </div>
                </form>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Add Stock</button></div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Delete Product</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <span class="text-primary">Product Name</span>?</p>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-danger" type="button">Delete Product</button></div>
        </div>
    </div>
</div>



<div class="container-xl px-4 mt-4">
    <div class="card mb-4">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Products List</span>
            <button class="btn btn-primary justify-end" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
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
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Advantage II for Cats</td>
                                <td>Flea Treatment</td>
                                <td>Pack</td>
                                <td>$50.99</td>
                                <td>
                                    <div class="badge bg-primary text-white rounded-pill">Available</div>
                                </td>
                                <td>120</td>
                                <td>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2" data-bs-toggle="modal" data-bs-target="#viewProductModal"><i data-feather="more-vertical"></i></button>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"><i data-feather="trash-2"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Frontline Plus for Dogs</td>
                                <td>Flea & Tick Treatment</td>
                                <td>Pack</td>
                                <td>$65.99</td>
                                <td>
                                    <div class="badge bg-primary text-white rounded-pill">Available</div>
                                </td>
                                <td>85</td>
                                <td>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i data-feather="more-vertical"></i></button>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Heartgard Plus for Dogs</td>
                                <td>Heartworm Prevention</td>
                                <td>Box</td>
                                <td>$39.99</td>
                                <td>
                                    <div class="badge bg-primary text-white rounded-pill">Available</div>
                                </td>
                                <td>200</td>
                                <td>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i data-feather="more-vertical"></i></button>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Cosequin for Cats</td>
                                <td>Joint Health Supplement</td>
                                <td>Bottle</td>
                                <td>$24.99</td>
                                <td>
                                    <div class="badge bg-primary text-white rounded-pill">Available</div>
                                </td>
                                <td>150</td>
                                <td>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i data-feather="more-vertical"></i></button>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>PetArmor for Dogs</td>
                                <td>Flea & Tick Treatment</td>
                                <td>Pack</td>
                                <td>$29.99</td>
                                <td>
                                    <div class="badge bg-primary text-white rounded-pill">Available</div>
                                </td>
                                <td>75</td>
                                <td>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i data-feather="more-vertical"></i></button>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Proviable-DC for Cats</td>
                                <td>Digestive Health Supplement</td>
                                <td>Box</td>
                                <td>$22.99</td>
                                <td>
                                    <div class="badge bg-primary text-white rounded-pill">Available</div>
                                </td>
                                <td>130</td>
                                <td>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i data-feather="more-vertical"></i></button>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
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