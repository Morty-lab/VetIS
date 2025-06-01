<!-- Add Stocks Modal Content -->
<form action="{{ route('products.addStocks', $product->id) }}" method="POST" id="addStockForm">
    @csrf
    <input type="hidden" name="encoder" value="{{ auth()->user()->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Stock</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gx-3 gy-2">
                            <div class="col-6">
                                <div class="form-label">Product Name</div>
                                <p>{{ $product->product_name }}</p>
                            </div>
                             <div class="col-6">
                                <div class="form-label">Product Barcode</div>
                                <p>{{ $product->SKU }}</p>
                            </div>
                             <div class="col-6">
                                <div class="form-label">Product Unit</div>
                                <p>{{ \App\Models\Unit::where('id', $product->unit)->first()->unit_name }}</p>
                                <input type="hidden" value="{{ $product->unit }}" name="unit">
                            </div>
                            <div class="col-6">
                                <div class="form-label">Product Category</div>
                                <p> {{ App\Models\Category::where('id', $product->product_category)->first()->category_name }}
                                </p>
                            </div>
                            <hr class="mb-2">
                            <div class="col-md-12">
                                <label class="form-label" for="selectSupplier">Supplier <span class="text-danger">*</span></label>
                                <select class="form-control inventory-supplier" id="selectSupplier" name="supplier" data-placeholder="Select Supplier">
                                    <option></option>
                                    @foreach ($suppliers as $i)
                                        <option value="{{ $i->id }}">{{ $i->supplier_name }}</option>
                                    @endforeach
                                </select>
                                <span id="supplierError" class="text-danger"></span>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Supplier Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="number" name="stockPrice" id="stockPrice" class="form-control" step="0.01">
                                </div>
                                <span id="stockPriceError" class="text-danger"></span>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Selling Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="number" name="sellingPrice" id="sellingPrice" class="form-control" step="0.01">
                                </div>
                                <span id="sellingPriceError" class="text-danger"></span>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Quantity <span class="text-danger">*</span></label>
                                <div class="input-group input-group-joined">
                                    <input type="number" name="stock" id="stock" class="form-control">
                                </div>
                                <span id="stockError" class="text-danger"></span>
                            </div>
                            <div class="col-6">
                                    <div class="form-label">Expiry Date</div>
                                    <div class="input-group input-group-joined">
                                    <input type="text" name="expiry_date" id="expiry_date" class="form-control">
                                    <span class="input-group-text"><i data-feather="calendar"></i></span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Add Stock</button>
                    </div>
</form>

<script>
document.getElementById("addStockForm").addEventListener("submit", function (e) {
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
    if (isNaN(stockPriceEl.value) || stockPriceEl.value.trim() === "") {
        document.getElementById("stockPriceError").textContent = "Supplier price is required.";
        isValid = false;
    }

    // Selling price validation
    if (isNaN(sellingPriceEl.value) || sellingPriceEl.value.trim() === "") {
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