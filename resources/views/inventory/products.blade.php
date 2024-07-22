@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- Modals -->
    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Product</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="small mb-1" for="inputProductName">Product Name</label>
                            <input class="form-control" id="inputProductName" type="text" placeholder="Product Name"
                                value="" name="product_name">
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="selectSupplier">Supplier</label>
                            <select class="form-control" id="selectSupplier" name="supplier">
                                <option disabled="" selected="">-- Select Supplier --</option>
                                @foreach ($suppliers as $i)
                                    <option value="{{ $i->id }}">{{ $i->supplier_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="selectProductCategory">Product Category</label>
                                <select class="form-control" id="selectProductCategory" name="category">
                                    <option disabled="" selected="">-- Select Product Category --</option>
                                    <option>Category 1</option>
                                    <option>Category 2</option>
                                    <option>Category 3</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="selectUnitType">Unit Type</label>
                                <select class="form-control" id="selectUnitType" name="unit">
                                    <option disabled="" selected="">-- Select Unit Type --</option>
                                    @foreach ($units as $i)
                                        <option value="{{ $i->id }}">{{ $i->unit_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="productPrice">Product Price</label>
                                <input class="form-control" id="inputBreed" type="number" placeholder="Enter Price"
                                    value="" name="price">
                            </div>
                            {{-- <div class="col-md-6">
                                <label class="small mb-1" for="productStock">Product Stock</label>
                                <input class="form-control" id="inputBreed" type="number" placeholder="Add Stock"
                                    value="">
                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-secondary" type="button"
                            data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Save
                            changes</button></div>
                </form>

            </div>
        </div>
    </div>

    @foreach ($products as $product)
        <!-- View Product Modal -->
        <div class="modal fade" id="viewProductModal{{ $product->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                <p>{{ $product->product_name }}</p>
                            </div>
                            <div class="px-1">
                                <label class="small mb-1" for="selectProductCategory">Product Category</label>
                                <p>{{ $product->product_category }}</p>
                            </div>
                            <div class="px-1">
                                <label class="small mb-1" for="productSupplier">Supplier</label>
                                @foreach ($suppliers as $i)
                                    @if ($i->id == $product->supplier_id)
                                        <p>{{ $i->supplier_name }}</p>
                                    @endif
                                @endforeach
                            </div>
                            <hr>
                            <div class="row gx-3 mb-3 px-1">
                                <div class="col-md-3">
                                    <label class="small mb-1" for="selectUnitType">Unit Type</label>
                                    @foreach ($units as $i)
                                        @if ($i->id == $product->unit)
                                            <p>{{ $i->unit_name }}</p>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1" for="productPrice">Product Price</label>
                                    <p>PHP {{ $product->price }}</p>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1" for="productStock">Product Stock</label>
                                    @if ($product->stocks->isNotEmpty())
                                        <p>{{ $product->stocks->first()->stock }}</p>
                                    @else
                                        <p class="text-danger">Out of Stock</p>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1" for="productStock">Status</label>
                                    @if ($product->status == 1)
                                        <div class="badge bg-primary text-white rounded-pill">Available</div>
                                    @else
                                        <div class="badge bg-danger text-white rounded-pill">Not Available</div>
                                    @endif

                                </div>
                            </div>
                            <hr>
                        </form>
                        <div class="row gx-3 mb-3 py-1">
                            <p for="" class="small mb-2">Actions</p>
                            <div class="col-md-4">
                                <button class="btn btn-primary w-100 mb-1" data-bs-toggle="modal"
                                    data-bs-target="#addStocksModal{{ $product->id }}">Add Stocks</button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-secondary w-100 mb-1" data-bs-toggle="modal"
                                    data-bs-target="#editProductModal">Edit Product</button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-danger w-100" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal{{ $product->id }}">Delete Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Product Modal -->
        <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Product</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="small mb-1" for="inputProductName">Product Name</label>
                                <input class="form-control" id="inputProductName" type="text"
                                    placeholder="Product Name" value="{{ $product->product_name }}" name="product_name">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="selectSupplier">Supplier</label>
                                <select class="form-control" id="selectSupplier" name="supplier">
                                    <option disabled="">-- Select Supplier --</option>
                                    @foreach ($suppliers as $i)
                                        @if ($i->id == $product->supplier_id)
                                            <option value="{{ $i->id }}" selected>{{ $i->supplier_name }}</option>
                                        @else
                                            <option value="{{ $i->id }}">{{ $i->supplier_name }}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="selectProductCategory">Product Category</label>
                                    <select class="form-control" id="selectProductCategory" name="category">
                                        <option disabled="">-- Select Product Category --</option>
                                        <option selected>Category 1</option>
                                        <option>Category 2</option>
                                        <option>Category 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="selectUnitType">Unit Type</label>
                                    <select class="form-control" id="selectUnitType" name="unit">
                                        <option disabled="" selected="">-- Select Unit Type --</option>
                                        @foreach ($units as $i)
                                            @if ($i->id == $product->unit_id)
                                                <option value="{{ $i->id }}" selected>{{ $i->unit_name }}</option>
                                            @else
                                                <option value="{{ $i->id }}">{{ $i->unit_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="productPrice">Product Price</label>
                                    <input class="form-control" id="inputBreed" type="number" placeholder="Enter Price"
                                        value="{{ $product->price }}" name="price">
                                </div>
                                {{-- <div class="col-md-6">
                                    <label class="small mb-1" for="productStock">Product Stock</label>
                                    <input class="form-control" id="inputBreed" type="number" placeholder="Enter Stock"
                                        value="50">
                                </div> --}}
                            </div>
                        </div>
                        <div class="modal-footer"><button class="btn btn-secondary" type="button"
                                data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Save
                                changes</button></div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Add Stocks Modal -->
        <div class="modal fade" id="addStocksModal{{ $product->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('products.addStocks', $product->id) }}" method="POST">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Add Stocks for
                                {{ $product->product_name }}</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="small mb-1" for="inputAddStockAmount">Enter Stocks</label>
                                <input class="form-control" id="inputAddStockAmount" type="number"
                                    placeholder="Enter Stock Amount" value="" name="stock">
                            </div>

                        </div>
                        <div class="modal-footer"><button class="btn btn-secondary" type="button"
                                data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Add
                                Stock</button></div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="confirmDeleteModal{{ $product->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Product</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <span class="text-primary">{{ $product->product_name }}</span>?
                        </p>
                    </div>
                    <div class="modal-footer"><button class="btn btn-primary" type="button"
                            data-bs-dismiss="modal">Cancel</button><a href="{{ route('products.delete', $product->id) }}"
                            class="btn btn-danger" type="button">Delete
                            Product</a></div>
                </div>
            </div>
        </div>
    @endforeach


    <div class="container-xl px-4 mt-4">
        <div class="card mb-4">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Products List</span>
                <button class="btn btn-primary justify-end" data-bs-toggle="modal" data-bs-target="#addProductModal">Add
                    Product</button>
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
                            <input class="datatable-input" placeholder="Search..." type="search" name="search"
                                title="Search within table" aria-controls="datatablesSimple">
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
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_category }}</td>
                                        <td>
                                            @foreach ($units as $i)
                                                @if ($i->id == $product->unit)
                                                    <p>{{ $i->unit_name }}</p>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="d-flex justify-content-between">
                                            <div class="col-auto">Php</div>
                                            <div class="col-auto">{{ $product->price }}</div>
                                        </td>

                                        <td>
                                            @if ($product->status == 1)
                                                <div class="badge bg-primary text-white rounded-pill">Available</div>
                                            @else
                                                <div class="badge bg-danger text-white rounded-pill">Unavailable</div>
                                            @endif


                                        </td>
                                        <td>
                                            @if ($product->stocks->isNotEmpty() && $product->stocks->first()->status == 1)
                                                {{ $product->stocks->first()->stock }}
                                            @else
                                                No stocks available
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewProductModal{{ $product->id }}"><i
                                                    data-feather="more-vertical"></i></button>
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal{{ $product->id }}"><i
                                                    data-feather="trash-2"></i></button>
                                        </td>
                                    </tr>
                                @endforeach



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
