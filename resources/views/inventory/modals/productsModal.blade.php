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
                <div class="modal-footer"><button class="btn btn-primary-soft text-primary" type="button"
                        data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Save
                        changes</button></div>
            </form>

        </div>
    </div>
</div>

@foreach ($products as $product)
    @php
        $stockforproduct = \App\Models\Stocks::getAllStocksByProductId($product->id);
    @endphp
    @foreach ($stockforproduct as $stockP)
        <!-- Repack Stock Modal -->
        <div class="modal fade" id="repackStockModal-{{ $product->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Repack
                            Stock for {{ $product->product_name }}
                        </h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('products.repackStocks') }}" method="POST">
                            {{-- {{ route('repackStock') }} --}}
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="supplier_price" value="{{ $stockP->supplier_price }}">
                            <input type="hidden" name="supplier" value="{{ $stockP->supplier_id }}">

                            <div class="mb-3">
                                <label class="small mb-1" for="inputRepackQuantity">Product Name (Repacked)</label>
                                <input class="form-control" id="inputRepackQuantity" type="text"
                                    placeholder="Enter Quantity" name="product_name"
                                    value="{{ $product->product_name }}">
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="inputRepackedSKU">Barcode</label>
                                <input class="form-control" id="inputRepackedSKU" type="text"
                                    placeholder="Enter unique barcode for repacked product" name="repacked_SKU"
                                    value="" maxlength="24"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="inputRepackQuantity">Quantity Used for
                                    Repacking</label>
                                <input class="form-control" id="inputRepackQuantity" type="number"
                                    placeholder="Enter amount of original stock used" name="quantity">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="selectRepackUnit">Repacked Unit Type</label>
                                <select class="form-control" id="selectRepackUnit" name="unit">
                                    <option disabled="" selected="">-- Select
                                        Unit --</option>
                                    @foreach ($units as $i)
                                        <option value="{{ $i->id }}">
                                            {{ $i->unit_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputNumberRepackedUnits">Total Units Produced
                                </label>
                                <input class="form-control" id="inputNumberRepackedUnits" type="number"
                                    placeholder="Enter number of units after repacking" name="number_repacked_units">
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="inputRepackStockPrice">Unit Price (Repacked)</label>
                                <input class="form-control" id="inputRepackStockPrice" type="number" step="0.01"
                                    placeholder="Enter price per repacked unit" name="stock_price">
                            </div>


                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button"
                                    data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Repack
                                    Stock</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
                                        <p
                                            class="badge {{ $productStock - $subtracted == 0 ? 'bg-danger-soft text-danger' : 'bg-primary-soft text-primary' }} rounded-pill">

                                            {{ $productStock - $subtracted == 0 ? 'No' : $productStock - $subtracted }}
                                            Stocks Available
                                        </p>
                                    </div>
                                    <div class="col">
                                        <div class="label">Unit</div>
                                        <p class="badge bg-primary-soft text-primary rounded-pill">
                                            @foreach ($units as $u)
                                                @if ($u->id == $product->unit)
                                                    {{ $u->unit_name }}
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="col flex flex-row">
                                        <div class="label">Category</div>
                                        <p class="badge bg-primary-soft text-primary rounded-pill">
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
                                                <button class="btn btn-outline-gray me-2" id="productInfoMenuButton"
                                                    type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><i
                                                        class="fa-solid fa-ellipsis"></i></button>
                                                <div class="dropdown-menu animated--fade-in"
                                                    aria-labelledby="productInfoMenuButton">
                                                    <button class="dropdown-item cursor-pointer"
                                                        data-bs-toggle="modal" data-bs-target="#editProductModal-{{ $product->id }}">Edit
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

                        <div class="card-body">
                            <table id="inventoryStocksTable">

                                <thead>
                                    <tr>
                                        <th>Product Information</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Actions</th>
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
                                                    <div class="col-md-12"><span
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
                                                    <div class="col-md-4"><span class="text-primary">₱{{ $stockP->price }}</span></div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-8">Supplier Price</div>
                                                    <div class="col-md-4"><span
                                                            class="text-primary">₱{{ $stockP->supplier_price }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                            $availableStock = $stockP->stock - $stockP->subtracted_stock;
                                                        @endphp

                                                        <span class="badge badge-sm fw-bold rounded-pill
                                                            {{ $availableStock > 0 ? 'bg-primary-soft text-primary' : 'bg-danger-soft text-danger' }}">
                                                            {{ $availableStock > 0 ? $availableStock . ' Stocks Available' : 'No Stocks' }}
                                                        </span>
                                                    </div>
                                                    <div class="col-md-12 mt-2">Date Added:
                                                        {{ $stockP->created_at->format('F d Y') }}</div>
                                                    <div class="col-md-12 mt-2">
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
                                                    <button class="btn btn-datatable btn-outline-primary me-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#repackStockModal-{{ $product->id }}"><i
                                                            class="fa-solid fa-box-open"></i></button>
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


    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('products.update', ['id' =>$product->id]) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Product</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row gy-2">
                        <div class="col-md-12">
                            <label class="small mb-1" for="inputProductName">Product Name</label>
                            <input class="form-control" id="inputProductName" type="text" placeholder="Product Name"
                                value="{{ $product->product_name }}" name="product_name">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="inputProductSKU">Barcode</label>
                            <input class="form-control" id="inputProductSKU" type="text" maxlength="8"
                                placeholder="Barcode" value="{{ $product->SKU }}" name="product_sku">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="inputProductBrand">Brand</label>
                            <input class="form-control" id="inputProductBrand" type="text" placeholder="Brand"
                                value="{{ $product->brand }}" name="brand">
                        </div>

                        <div class="col-md-6">
                            <label class="small mb-1" for="selectProductCategory">Product Category</label>
                            <select class="form-control" id="selectProductCategory" name="category">
                                <option disabled="" selected="">-- Select Product Category --</option>
                                @foreach ($categories as $i)
                                    <option value="{{ $i->id }}" {{ $product->product_category == $i->id ? 'selected' : '' }}>{{ $i->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="selectUnitType">Unit Type</label>
                            <select class="form-control" id="selectUnitType" name="unit">
                                <option disabled="" selected="">-- Select Unit Type --</option>
                                @foreach ($units as $i)
                                    <option value="{{ $i->id }}" {{ $product->unit == $i->id ? 'selected' : '' }}>{{ $i->unit_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row gx-3">
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-secondary" type="button"
                            data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Save
                            changes</button></div>
                </form>
            </div>
        </div>
    </div>


    <!-- View Stock Modal -->
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
    </div>


    <!-- Add Stocks Modal -->
    <div class="modal fade" id="addStocksModal{{ $product->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form action="{{ route('products.addStocks', $product->id) }}" method="POST" id="addStockForm">
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
                                <p> {{ App\Models\Category::where('id', $product->product_category)->first()->category_name }}
                                </p>
                            </div>
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
                                <span id="supplierError" class="text-danger"></span>
                            </div>
                            <div class="col-6">
                                <div class="label">Supplier Price</div>
                                <input type="number" name="stockPrice" id="stockPrice" class="form-control">
                                <span id="stockPriceError" class="text-danger"></span>
                            </div>
                            <div class="col-6">
                                <div class="label">Selling Price</div>
                                <input type="number" name="sellingPrice" id="sellingPrice" class="form-control">
                                <span id="sellingPriceError" class="text-danger"></span>
                            </div>
                            <div class="col-6">
                                <div class="label">Stock Quantity</div>
                                <input type="number" name="stock" id="stock" class="form-control">
                                <span id="stockError" class="text-danger"></span>
                            </div>
                            <div class="col-6">
                                <div class="label">Expiry Date</div>
                                <input type="date" name="expiry_date" id="expiry_date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Add Stock</button>
                    </div>
                </div>
            </form>

            <script>
                document.getElementById("addStockForm").addEventListener("submit", function(e) {
                    e.preventDefault();
                    var isValid = true;

                    var stockPrice = document.getElementById("stockPrice").value;
                    var sellingPrice = document.getElementById("sellingPrice").value;
                    var stock = document.getElementById("stock").value;
                    var supplier = document.getElementById("selectSupplier").value;

                    document.getElementById("supplierError").textContent = "";
                    document.getElementById("stockPriceError").textContent = "";
                    document.getElementById("sellingPriceError").textContent = "";
                    document.getElementById("stockError").textContent = "";

                    if (supplier === "-- Select Supplier --") {
                        document.getElementById("supplierError").textContent = "Please select a supplier.";
                        isValid = false;
                    }

                    if (stockPrice === "") {
                        document.getElementById("stockPriceError").textContent = "Supplier price is required.";
                        isValid = false;
                    }

                    if (sellingPrice === "") {
                        document.getElementById("sellingPriceError").textContent = "Selling price is required.";
                        isValid = false;
                    }

                    if (stock === "") {
                        document.getElementById("stockError").textContent = "Stock amount is required.";
                        isValid = false;
                    }

                    if (isValid && sellingPrice <= stockPrice) {
                        document.getElementById("sellingPriceError").textContent = "Selling price should be higher than supplier price.";
                        isValid = false;
                    }

                    if (isValid) {
                        this.submit();
                    }
                });
            </script>
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
@endforeach
