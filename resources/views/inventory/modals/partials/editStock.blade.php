<form action="{{ route('products.updateStock', ['id' => $product->id, 'stockid' => $stocks->id]) }}" method="POST" id="editStockForm">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Stocks</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <div class="row gx-3 gy-2">
            <!-- Product Name -->
            <div class="col-6">
                <div class="form-label">Product Name</div>
                <p>{{ $product->product_name }}</p>
            </div>

            <!-- Product Barcode -->
            <div class="col-6">
                <div class="form-label">Product Barcode</div>
                <p>{{ $product->SKU }}</p>
            </div>

            <!-- Product Unit -->
            <div class="col-6">
                <div class="form-label">Product Unit</div>
                <p>
                    @foreach ($units as $u)
                        @if ($u->id == $product->unit)
                            {{ $u->unit_name }}
                        @endif
                    @endforeach
                </p>
                <input type="hidden" value="{{ $product->unit }}" name="unit">
            </div>

            <!-- Product Category -->
            <div class="col-6">
                <div class="form-label">Product Category</div>
                <p>
                    @foreach ($categories as $c)
                        @if ($c->id == $product->product_category)
                            {{ $c->category_name }}
                        @endif
                    @endforeach
                </p>
            </div>

            <!-- Supplier -->
            <div class="col-md-12">
                <div class="form-label" for="selectSupplier">Supplier <span class="text-danger">*</span></div>
                <select class="form-control edit-inventory-supplier" id="selectSupplier" name="supplier" data-placeholder="Select Supplier">
                    <option></option>
                    @foreach ($suppliers as $i)
                        <option value="{{ $i->id }}" {{ $stocks->supplier_id == $i->id ? 'selected' : '' }}>
                            {{ $i->supplier_name }}
                        </option>
                    @endforeach
                </select>
                <div id="supplierError" class="text-danger small mt-1"></div>
            </div>

            <!-- Supplier Price -->
            <div class="col-6">
                <div class="form-label">Supplier Price <span class="text-danger">*</span></div>
                <div class="input-group">
                    <div class="input-group-text">₱</div>
                    <input type="number" step="0.01" name="stockPrice" id="stockPrice" class="form-control" value="{{ $stocks->supplier_price }}">
                </div>
                <div id="stockPriceError" class="text-danger small mt-1"></div>
            </div>

            <!-- Selling Price -->
            <div class="col-6">
                <div class="form-label">Selling Price <span class="text-danger">*</span></div>
                <div class="input-group">
                    <div class="input-group-text">₱</div>
                    <input type="number" step="0.01" name="selling_price" id="sellingPrice" class="form-control" value="{{ $stocks->price }}">
                </div>
                <div id="sellingPriceError" class="text-danger small mt-1"></div>
            </div>

            <!-- Stock Amount -->
            <div class="col-6">
                <div class="form-label">Stock Amount <span class="text-danger">*</span></div>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ $stocks->stock }}">
                <div id="stockError" class="text-danger small mt-1"></div>
            </div>

            <!-- Expiry Date -->
            <div class="col-6">
                <div class="form-label">Expiry Date</div>
                <div class="input-group input-group-joined">
                    <input type="date" name="expiry_date" id="expiry_date" class="form-control" value="{{ $stocks->expiry_date }}">
                    <div class="input-group-text">
                        <i data-feather="calendar"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Edit Stock</button>
    </div>
</form>

<script>
document.getElementById("editStockForm").addEventListener("submit", function (e) {
    e.preventDefault();
    let isValid = true;

    const stockPriceEl = document.getElementById("stockPrice");
    const sellingPriceEl = document.getElementById("sellingPrice");
    const stockEl = document.getElementById("stock");
    const supplierEl = document.getElementById("selectSupplier");

    const stockPrice = parseFloat(stockPriceEl.value);
    const sellingPrice = parseFloat(sellingPriceEl.value);
    const stock = stockEl.value.trim();
    const supplier = supplierEl.value;

    // Clear previous errors
    document.getElementById("supplierError").textContent = "";
    document.getElementById("stockPriceError").textContent = "";
    document.getElementById("sellingPriceError").textContent = "";
    document.getElementById("stockError").textContent = "";

    // Supplier validation
    if (!supplier) {
        document.getElementById("supplierError").textContent = "Please select a supplier.";
        isValid = false;
    }

    // Stock price validation
    if (stockPriceEl.value.trim() === "" || isNaN(stockPrice)) {
        document.getElementById("stockPriceError").textContent = "Supplier price is required.";
        isValid = false;
    }

    // Selling price validation
    if (sellingPriceEl.value.trim() === "" || isNaN(sellingPrice)) {
        document.getElementById("sellingPriceError").textContent = "Selling price is required.";
        isValid = false;
    } else if (!isNaN(stockPrice) && sellingPrice <= stockPrice) {
        document.getElementById("sellingPriceError").textContent = "Selling price should be greater than supplier price.";
        isValid = false;
    }

    // Stock quantity validation
    if (stock === "" || isNaN(stock)) {
        document.getElementById("stockError").textContent = "Stock amount is required.";
        isValid = false;
    }

    if (isValid) {
        this.submit();
    }
});
</script>