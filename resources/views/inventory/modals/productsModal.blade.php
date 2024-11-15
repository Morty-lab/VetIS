@php use Carbon\Carbon; @endphp

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create Product</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row gy-2">
                    <div class="col-md-12">
                        <label class="small mb-1" for="inputProductName">Product Name</label>
                        <input class="form-control" id="inputProductName" type="text" placeholder="Product Name"
                            value="" name="product_name">
                    </div>
                    <div class="col-md-12">
                        <label class="small mb-1" for="inputProductSKU">SKU</label>
                        <input class="form-control" id="inputProductSKU" type="number" placeholder="Product SKU"
                            value="" name="product_sku">
                    </div>
                    <!-- <div class="mb-3">
                        <label class="small mb-1" for="selectSupplier">Supplier</label>
                        <select class="form-control" id="selectSupplier" name="supplier">
                            <option disabled="" selected="">-- Select Supplier --</option>
                            @foreach ($suppliers as $i)
                            <option value="{{ $i->id }}">{{ $i->supplier_name }}</option>
                            @endforeach
                        </select>
                    </div> -->
                    <div class="col-md-6">
                        <label class="small mb-1" for="selectProductCategory">Product Category</label>
                        <select class="form-control" id="selectProductCategory" name="category">
                            <option disabled="" selected="">-- Select Product Category --</option>
                            @foreach ($categories as $i)
                            <option value="{{ $i->id }}">{{ $i->category_name }}</option>
                            @endforeach
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
                    <div class="col-md-12">
                        <label class="small mb-1" for="productPrice">Product Price</label>
                        <input class="form-control" id="inputBreed" type="number" placeholder="Enter Price"
                            value="" name="price">
                    </div>
                    <div class="row gx-3">
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
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Product Information</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 px-0 pb-0">
                <div class="border-bottom bg-white">
                    <div class="row mx-3">
                        <div class="col-md-4 pt-3 ps-0 border-end">
                            <div class="label">Product Name</div>
                            <h3 class="mb-3 text-primary">{{ $product->product_name }}</h3>
                        </div>
                        <div class="col-md-8 pt-3 pb-1">
                            <div class="row ps-2">
                                <div class="col">
                                    <div class="label">Price</div>
                                    <h4 class="mb-0">Php {{ $product->price }}</h4>
                                </div>
                                <div class="col flex flex-row">
                                    <div class="label">Total Stocks</div>
                                    <p class="text-primary">23 pcs</p>
                                </div>
                                <div class="col">
                                    <div class="label">Unit</div>
                                    <p>Box</p>
                                </div>
                                <div class="col flex flex-row">
                                    <div class="label">Category</div>
                                    <p class="badge bg-primary text-white rounded-pill">
                                        @foreach ($categories as $i)
                                        @if ($i->id == $product->product_category)
                                        {{ $i->category_name }}
                                        @endif
                                        @endforeach
                                    </p>
                                </div>
                                <div class="col-1 p-0">
                                    <div class="d-flex justify-content-end">
                                        <div class="dropdown">
                                            <button class="btn btn-outline-gray me-2" id="productInfoMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-ellipsis"></i></button>
                                            <div class="dropdown-menu animated--fade-in" aria-labelledby="productInfoMenuButton">
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit Product</a>
                                                <a class="dropdown-item" href="dropdowns.html#!">Delete Product</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="dropdowns.html#!">Print</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-bottom bg-white d-flex d-flex justify-content-between align-items-center py-2 px-3">
                    <span class="text-primary">Stock List</span>
                    <div class="">
                        <button class="btn btn-sm btn-primary px-3 py-3" data-bs-toggle="modal"
                            data-bs-target="#addStocksModal{{ $product->id }}">Add Stock</button>
                    </div>
                </div>

                <div class=" card mt-4 mb-4 mx-3 shadow-none">
                    <!-- <div class="card-header bg-white d-flex d-flex justify-content-between align-items-center py-2">
                    </div> -->
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
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const searchInput = document.querySelector('.datatable-input');
                                            const tableRows = document.querySelectorAll('.datatable-table tbody tr');

                                            searchInput.addEventListener('keyup', function() {
                                                const searchTerm = this.value.toLowerCase();

                                                tableRows.forEach(function(row) {
                                                    const productNameCell = row.cells[0];
                                                    const productName = productNameCell.textContent.toLowerCase();

                                                    if (productName.includes(searchTerm)) {
                                                        row.style.display = '';
                                                    } else {
                                                        row.style.display = 'none';
                                                    }
                                                });
                                            });

                                            // Show all rows initially
                                            tableRows.forEach(function(row) {
                                                row.style.display = '';
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="datatable-container">
                                <table class="datatable-table">
                                    <thead>
                                        <tr>
                                            <th>SKU</th>
                                            <th>Product Name</th>
                                            <th>Expiry Date</th>
                                            <th>Supplier</th>
                                            <th>Supplier Price</th>
                                            <th>SRP</th>
                                            <th>Stock</th>
                                            <th>Encoder</th>
                                            <th>Date Added</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2393084232</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>
                                                10/10/2026
                                            </td>
                                            <td>
                                                The Amazing Supplier Supply Ltd.
                                            </td>
                                            <td>
                                                Php 50.00
                                            </td>
                                            <td>
                                                Php 40.00
                                            </td>
                                            <td>
                                                <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                                    10 pcs
                                                </span>
                                            </td>
                                            <td>
                                                Prince Zeljay Kent Invento
                                            </td>
                                            <td>
                                                11/06/2024 04:30PM
                                            </td>
                                            <td>
                                                <button class="btn btn-datatable btn-outline-primary me-2"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <form>
                    <div class="mb-3 px-1">
                        <label class="small mb-1" for="inputProductName">Product Name</label>
                        <p>{{ $product->product_name }}</p>
                    </div>
                    <div class="px-1">
                        <label class="small mb-1" for="selectProductCategory">Product Category</label>
                        @foreach ($categories as $i)
                        @if ($i->id == $product->product_category)
                        <p>{{ $i->category_name }}</p>
                        @endif
                        @endforeach
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
                </div> -->
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
                    <!-- <div class="mb-3">
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
                    </div> -->
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectProductCategory">Product Category</label>
                            <select class="form-control" id="selectProductCategory" name="category">
                                <option disabled="">-- Select Product Category --</option>
                                @foreach ($categories as $i)
                                @if ($i->id == $product->product_category)
                                <option value="{{ $i->id }}" selected>{{ $i->category_name }}
                                </option>
                                @else
                                <option value="{{ $i->id }}">{{ $i->category_name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectUnitType">Unit Type</label>
                            <select class="form-control" id="selectUnitType" name="unit">
                                {{-- <option disabled="" selected="">-- Select Unit Type --</option>--}}
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
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Stocks</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gx-3 gy-2">
                    <div class="col-6">
                        <div class="label">Product Name</div>
                        <p>The Chuchuness</p>
                    </div>
                    <div class="col-6">
                        <div class="label">Product Category</div>
                        <p>Vaccine</p>
                    </div>
                    <div class="col-6">
                        <div class="label">SKU</div>
                        <p>53452435234</p>
                    </div>
                    <div class="col-6">
                        <div class="label">Product Unit</div>
                        <p>Box</p>
                    </div>
                    <div class="col-6">
                        <div class="label">Expiry Date</div>
                        <input type="date" name="" id="" class="form-control">
                    </div>
                    <div class="col-6">
                        <div class="label">SRP</div>
                        <input type="number" name="" id="" class="form-control">
                    </div>
                    <div class="col-6">
                        <div class="label">Supplier</div>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-6">
                        <div class="label">Supplier Price</div>
                        <input type="number" name="" id="" class="form-control">
                    </div>
                    <div class="col-6">
                        <div class="label">Stock Amount</div>
                        <input type="number" name="" id="" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Add Stock</button>
            </div>
            <!-- <form action="{{ route('products.addStocks', $product->id) }}" method="POST">
                @csrf
                @foreach ($units as $u)
                @if ($u->id == $product->unit)
                <input type="hidden" name="unit" value={{ $u->id }}>
                @endif
                @endforeach
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Stocks
                    </h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="small mb-1" for="inputAddStockAmount">Enter Stocks</label>
                        <input class="form-control" id="inputAddStockAmount" type="number"
                            placeholder="Enter Stock Amount" value="" name="stock">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputAddStockAmount">Expiry Date</label>
                        <input class="form-control" id="inputAddStockAmount" type="date"
                            placeholder="Enter Stock Amount" value="" name="expiry_date">
                    </div>

                </div>
                <div class="modal-footer"><button class="btn btn-secondary" type="button"
                        data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Add
                        Stock</button></div>
            </form> -->

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