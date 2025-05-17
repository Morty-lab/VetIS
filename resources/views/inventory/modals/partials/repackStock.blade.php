<div class="modal-header">
    <h5 class="modal-title" id="exampleModalCenterTitle">Repack Stock for {{ $product->product_name }}</h5>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('products.repackStocks', ['stockid' => $stocks->id]) }}" method="POST" id="repackStockForm">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="supplier_price" value="{{ $stocks->supplier_price }}">
    <input type="hidden" name="supplier" value="{{ $stocks->supplier_id }}">
    <div class="modal-body">
        <div class="mb-3">
            <label class="small mb-1" for="inputRepackProductName">Product Name (Repacked)</label>
            <input class="form-control" id="inputRepackProductName" type="text" placeholder="Enter Quantity" name="product_name" value="{{ $product->product_name }}">
            <span id="productNameError" class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label class="small mb-1" for="inputRepackedSKU">Barcode</label>
            <input class="form-control" id="inputRepackedSKU" type="text" placeholder="Enter unique barcode for repacked product" name="repacked_SKU" maxlength="24" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            <span id="repackedSKUError" class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label class="small mb-1" for="inputRepackQuantity">Quantity Used for Repacking</label>
            <input class="form-control" id="inputRepackQuantity" type="number" placeholder="Enter amount of original stock used" name="quantity">
            <span id="quantityError" class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label class="small mb-1" for="selectRepackUnit">Repacked Unit Type</label>
            <select class="form-control repack-unit" id="selectRepackUnit" name="unit" data-placeholder="Select unit">
                <option></option>
                @foreach ($units as $i)
                    <option value="{{ $i->id }}">{{ $i->unit_name }}</option>
                @endforeach
            </select>
            <span id="unitError" class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label class="small mb-1" for="inputNumberRepackedUnits">Total Units Produced</label>
            <input class="form-control" id="inputNumberRepackedUnits" type="number" placeholder="Enter number of units after repacking" name="number_repacked_units">
            <span id="numberRepackedUnitsError" class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label class="small mb-1" for="inputRepackStockPrice">Selling Price (Repacked)</label>
            <div class="input-group input-group-joined">
                <div class="input-group-text">
                    ₱
                </div>
                  <input class="form-control" id="inputRepackStockPrice" type="number" step="0.01" placeholder="Enter price per repacked unit" name="stock_price">
            </div>
            <span id="stockPriceError" class="text-danger"></span>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Repack Stock</button>
    </div>
</form>

<script>
document.getElementById("repackStockForm").addEventListener("submit", function (e) {
    e.preventDefault();
    let isValid = true;

    // Elements
    const productNameEl = document.getElementById("inputRepackProductName");
    const repackedSKUEl = document.getElementById("inputRepackedSKU");
    const quantityEl = document.getElementById("inputRepackQuantity");
    const unitEl = document.getElementById("selectRepackUnit");
    const numberRepackedUnitsEl = document.getElementById("inputNumberRepackedUnits");
    const stockPriceEl = document.getElementById("inputRepackStockPrice");

    // Values
    const productName = productNameEl.value.trim();
    const repackedSKU = repackedSKUEl.value.trim();
    const quantity = quantityEl.value.trim();
    const unit = unitEl.value;
    const numberRepackedUnits = numberRepackedUnitsEl.value.trim();
    const stockPrice = stockPriceEl.value.trim();

    // Clear previous errors
    document.getElementById("productNameError").textContent = "";
    document.getElementById("repackedSKUError").textContent = "";
    document.getElementById("quantityError").textContent = "";
    document.getElementById("unitError").textContent = "";
    document.getElementById("numberRepackedUnitsError").textContent = "";
    document.getElementById("stockPriceError").textContent = "";

    // Validation

    if (!productName) {
        document.getElementById("productNameError").textContent = "Please enter a valid product name.";
        isValid = false;
    }

    if (!repackedSKU) {
        document.getElementById("repackedSKUError").textContent = "Please enter a valid barcode.";
        isValid = false;
    }

    if (!quantity || isNaN(quantity) || Number(quantity) <= 0) {
        document.getElementById("quantityError").textContent = "Please enter a valid quantity.";
        isValid = false;
    }

    if (!unit) {
        document.getElementById("unitError").textContent = "Please select a unit.";
        isValid = false;
    }

    if (!numberRepackedUnits || isNaN(numberRepackedUnits) || Number(numberRepackedUnits) <= 0) {
        document.getElementById("numberRepackedUnitsError").textContent = "Please enter a valid number of repacked units.";
        isValid = false;
    }

    if (!stockPrice || isNaN(stockPrice) || Number(stockPrice) <= 0) {
        document.getElementById("stockPriceError").textContent = "Please enter a valid selling price.";
        isValid = false;
    }

    if (isValid) {
        this.submit();
    }
});
</script>