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
                        <label class="small mb-1" for="inputProductSKU">Barcode</label>
                        <input class="form-control" id="inputProductSKU" type="text" maxlength="8"
                            placeholder="Barcode" name="product_sku">
                    </div>
                    <div class="col-md-12">
                        <label class="small mb-1" for="inputProductBrand">Brand</label>
                        <input class="form-control" id="inputProductBrand" type="text" placeholder="Brand"
                            value="" name="brand">
                    </div>
                    {{--                    <div class="col-md-12"> --}}
                    {{--                        <label class="small mb-1" for="inputProductSKU">SKU</label> --}}
                    {{--                        <input class="form-control" id="inputProductSKU" type="number" placeholder="Product SKU" --}}
                    {{--                            value="" name="product_sku"> --}}
                    {{--                    </div> --}}
                    {{-- <div class="mb-3"> --}}
                    {{-- <label class="small mb-1" for="selectSupplier">Supplier</label> --}}
                    {{-- <select class="form-control" id="selectSupplier" name="supplier"> --}}
                    {{-- <option disabled="" selected="">-- Select Supplier --</option> --}}
                    {{-- @foreach ($suppliers as $i) --}}
                    {{-- <option value="{{ $i->id }}">{{ $i->supplier_name }}</option> --}}
                    {{-- @endforeach --}}
                    {{-- </select> --}}
                    {{-- </div> --}}
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
                    {{--                    <div class="col-md-12"> --}}
                    {{--                        <label class="small mb-1" for="productPrice">Product Price</label> --}}
                    {{--                        <input class="form-control" id="inputBreed" type="number" placeholder="Enter Price" --}}
                    {{--                            value="" name="price"> --}}
                    {{--                    </div> --}}
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

<!-- Single Dynamic Repack Stock Modal -->
<div class="modal fade" id="repackStockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="repackStockForm" action="{{ route('products.repackStocks') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="repackModalTitle">Repack Stock</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="product_id" id="modal_product_id">
                    <input type="hidden" name="supplier_price" id="modal_supplier_price">
                    <input type="hidden" name="supplier" id="modal_supplier">

                    <div class="mb-3">
                        <label class="small mb-1" for="modal_product_name">Product Name (Repacked)</label>
                        <input class="form-control" id="modal_product_name" type="text" name="product_name"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label class="small mb-1" for="modal_repacked_SKU">Barcode</label>
                        <input class="form-control" id="modal_repacked_SKU" type="text" name="repacked_SKU"
                            maxlength="24" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                    </div>

                    <div class="mb-3">
                        <label class="small mb-1" for="modal_quantity">Quantity Used for Repacking</label>
                        <input class="form-control" id="modal_quantity" type="number" name="quantity">
                    </div>

                    <div class="mb-3">
                        <label class="small mb-1" for="modal_unit">Repacked Unit Type</label>
                        <select class="form-control" id="modal_unit" name="unit">
                            <option disabled selected>-- Select Unit --</option>
                            @foreach ($units as $i)
                                <option value="{{ $i->id }}">{{ $i->unit_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="small mb-1" for="modal_number_units">Total Units Produced</label>
                        <input class="form-control" id="modal_number_units" type="number"
                            name="number_repacked_units">
                    </div>

                    <div class="mb-3">
                        <label class="small mb-1" for="modal_stock_price">Unit Price (Repacked)</label>
                        <input class="form-control" id="modal_stock_price" type="number" step="0.01"
                            name="stock_price">
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Repack Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- View Product Modal -->
    <div class="modal fade" id="viewProductModal" tabindex="-1" role="dialog"
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
                                <h3 id="modalProductName" class="mb-3 text-primary">{{ $product->product_name }}</h3>
                            </div>
                            <div class="col-md-8 pt-3 pb-1">
                                <div class="row ps-2">
                                    {{-- <div class="col">
                                        <div class="label">Price</div>
                                        <h4 class="mb-0 text-primary">Php {{ $product->price }}</h4>
                                    </div> --}}
                                    <div class="col flex flex-row">
                                        <div class="label">Total Stocks</div>
                                        @php
                                            $productStock = \App\Models\Stocks::getAllStocksByProductId(
                                                $product->id,
                                            )->sum('stock');
                                            $subtracted = \App\Models\Stocks::getAllStocksByProductId(
                                                $product->id,
                                            )->sum('subtracted_stock');
                                        @endphp
                                       <p id="modalStockBadge" class="badge rounded-pill"></p>
                                    </div>
                                    <div class="col">
                                        <div class="label">Unit</div>
                                        <p id="modalUnitBadge" class="badge bg-primary-soft text-primary rounded-pill"></p>
                                    </div>
                                    <div class="col flex flex-row">
                                        <div class="label">Category</div>
                                          <p id="modalCategoryBadge" class="badge bg-primary-soft text-primary rounded-pill"></p>
                                    </div>
                                    <div class="col-1 p-0">
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown">
                                                <button class="btn btn-outline-gray me-2" id="productInfoMenuButton"
                                                    type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><i
                                                        class="fa-solid fa-ellipsis"></i></button>
                                                <div class="dropdown-menu animated--fade-in"
                                                    aria-labelledby="productInfoMenuButton">
                                                    <button class="dropdown-item cursor-pointer"
                                                        data-bs-toggle="modal" data-bs-target="#editProductModal">Edit
                                                        Product</button>
                                                    <button class="dropdown-item cursor-pointer"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmDeleteModal{{ $product->id }}">Delete
                                                        Product</button>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item cursor-pointer"
                                                        href="{{ route('reports.inventory.itemStock', ['product_id' => $product->id]) }}">Print</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="border-bottom bg-white d-flex d-flex justify-content-between align-items-center py-2 px-3">
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
                            <table id="inventoryStocksTable">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Supplier</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $stockforproduct = \App\Models\Stocks::getAllStocksByProductId($product->id);
                                    @endphp
                                    @foreach ($stockforproduct as $stockP)
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">Product Name: <span
                                                            class="text-primary fw-600">{{ $product->product_name }}</span>
                                                    </div>
                                                    <div class="col-md-12">Supplier:
                                                        {{ \App\Models\Suppliers::where('id', $stockP->supplier_id)->first()->supplier_name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-8">Retail Price</div>
                                                    <div class="col-md-4 mb-2"><span
                                                            class="text-primary">₱{{ $stockP->price }}</span></div>
                                                    <div class="col-md-8">Supplier Price</div>
                                                    <div class="col-md-4"><span
                                                            class="text-primary">₱{{ $stockP->supplier_price }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12"><span
                                                            class="text-primary badge badge-sm bg-primary-soft text-primary fw-bold rounded-pill">
                                                            {{ $stockP->stock - $stockP->subtracted_stock }}
                                                            {{ \App\Models\Unit::where('id', $stockP->unit)->first()->unit_name }}
                                                            Available</span></div>
                                                    <div class="col-md-12">Date Added:
                                                        {{ $stockP->created_at->format('F d Y') }}</div>
                                                    <div class="col-md-12">
                                                        Expiry:
                                                        {{ $stockP->expiry_date ? \Carbon\Carbon::parse($stockP->expiry_date)->format('F d Y') : 'No Expiry' }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <button class="btn btn-datatable btn-outline-primary me-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editStockModal-{{ $product->id }}""><i
                                                            class="fa-regular fa-pen-to-square"></i></button>
                                                    <button class="btn btn-datatable btn-outline-primary me-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteStockModal-{{ $product->id }}""><i
                                                            class="fa-solid fa-trash"></i></button>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#repackStockModal"
                                                        data-product-id="{{ $product->id }}"
                                                        data-product-name="{{ $product->product_name }}"
                                                        data-supplier-id="{{ $stockP->supplier_id }}"
                                                        data-supplier-price="{{ $stockP->supplier_price }}">
                                                        Repack
                                                    </button>
                                                </div>
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
    </div>





    {{-- <!-- View Stock Modal -->
    <div class="modal fade" id="viewStockInfoModal" tabindex="-1" role="dialog" aria-labelledby="viewStockInfo"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">View Stock Info</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Stock</label>
                            <p>Stock-00001</p>
                        </div>
                        <div class="col-md-6">
                            <label for="">Product Name</label>
                            <p>Turtle Tank Filter</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <!-- Add Stocks Modal -->
    <div class="modal fade" id="addStocksModal{{ $product->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form action="{{ route('products.addStocks', $product->id) }}" method="POST">
                @csrf
                <input type="hidden" name="encoder" value="{{ auth()->user()->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Stocks</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gx-3 gy-2">
                            <div class="col-6">
                                <div class="label">Product Name</div>
                                <p>{{ $product->product_name }}</p>
                            </div>
                            <div class="col-6">
                                <div class="label">Product Category</div>
                                <p>
                                    @foreach ($categories as $u)
                                        @if ($u->id == $product->product_category)
                                            {{ $u->category_name }}
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                            {{--                        <div class="col-6"> --}}
                            {{--                            <div class="label">SKU</div> --}}
                            {{--                            <p>{{ sprintf("VetIS-%05d", $product->id)}}</p> --}}
                            {{--                        </div> --}}
                            <div class="col-6">
                                <div class="label">Product Unit</div>
                                <p>{{ \App\Models\Unit::where('id', $product->unit)->first()->unit_name }}</p>
                                <input type="hidden" value="{{ $product->unit }}" name="unit">
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
                            <div class="col-6">
                                <div class="label">Supplier Price</div>
                                <input type="number" name="stockPrice" id="" class="form-control">
                            </div>
                            <div class="col-6">
                                <div class="label">Selling Price</div>
                                <input type="number" name="sellingPrice" id="" class="form-control">
                            </div>
                            <div class="col-6">
                                <div class="label">Stock Amount</div>
                                <input type="number" name="stock" id="" class="form-control">
                            </div>
                            <div class="col-6">
                                <div class="label">Expiry Date</div>
                                <input type="date" name="expiry_date" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Add Stock</button>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <!-- Edit Stock Stock -->
    <div class="modal fade" id="editStockModal-{{ $product->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form action="{{ route('products.addStocks', $product->id) }}" method="POST">
                @csrf
                <input type="hidden" name="encoder" value="{{ auth()->user()->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Stocks</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gx-3 gy-2">
                            <div class="col-6">
                                <div class="label">Product Name</div>
                                <p>{{ $product->product_name }}</p>
                            </div>
                            <div class="col-6">
                                <div class="label">Product Category</div>
                                <p>
                                    @foreach ($categories as $u)
                                        @if ($u->id == $product->product_category)
                                            {{ $u->category_name }}
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-6">
                                <div class="label">SKU</div>
                                <p>{{ sprintf('VetIS-%05d', $product->id) }}</p>
                            </div>
                            <div class="col-6">
                                <div class="label">Product Unit</div>
                                <p>
                                    @foreach ($units as $u)
                                        @if ($u->id == $product->unit)
                                            {{ $u->unit_name }}
                                        @endif
                                    @endforeach
                                </p>
                                <input type="hidden" value="{{ $product->unit }}" name="unit">
                            </div>
                            <div class="col-6">
                                <div class="label">Expiry Date</div>
                                <input type="date" name="expiry_date" id="" class="form-control">
                            </div>
                            <div class="col-6">
                                <div class="label">SRP</div>
                                <input type="number" name="" value="{{ $product->price }}" id=""
                                    class="form-control" disabled>
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
                            <div class="col-6">
                                <div class="label">Supplier Price</div>
                                <input type="number" name="stockPrice" id="" class="form-control">
                            </div>
                            <div class="col-6">
                                <div class="label">Stock Amount</div>
                                <input type="number" name="stock" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Edit Stock</button>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <!-- Delete Stock Modal -->
    <div class="modal fade" id="deleteStockModal-{{ $product->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Stock</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the stock of <span
                            class="text-primary">{{ $product->product_name }}</span>?</p>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button"
                        data-bs-dismiss="modal">Cancel</button><a href="" class="btn btn-danger"
                        type="button">Delete Stock</a></div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal-{{ $product->id }}" tabindex="-1" role="dialog"
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
                                    {{-- <option disabled="" selected="">-- Select Unit Type --</option> --}}
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
                        {{--                    <div class="row gx-3 mb-3"> --}}
                        {{--                        <div class="col-md-6"> --}}
                        {{--                            <label class="small mb-1" for="productPrice">Product Price</label> --}}
                        {{--                            <input class="form-control" id="inputBreed" type="number" placeholder="Enter Price" --}}
                        {{--                                value="{{ $product->price }}" name="price"> --}}
                        {{--                        </div> --}}
                        {{--                         <div class="col-md-6"> --}}
                        {{--                                    <label class="small mb-1" for="productStock">Product Stock</label> --}}
                        {{--                                    <input class="form-control" id="inputBreed" type="number" placeholder="Enter Stock" --}}
                        {{--                                        value="50"> --}}
                        {{--                                </div> --}}
                        {{--                    </div> --}}
                    </div>
                    <div class="modal-footer"><button class="btn btn-secondary" type="button"
                            data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Save
                            changes</button></div>
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
