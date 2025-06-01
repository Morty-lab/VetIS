<form action="{{ route('products.update', ['id' => $product->id]) }}" method="POST" id="editProductForm">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title">Edit Product</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body row gy-2">
        <div class="col-md-12">
            <label class="small mb-1" for="inputProductBrand">Brand <span class="text-danger">*</span></label>
            <input class="form-control" id="inputProductBrand" type="text" name="brand" placeholder="Brand" value="{{ $product->brand }}">
            <span id="brandError" class="text-danger"></span>
        </div>

        <div class="col-md-12">
            <label class="small mb-1" for="inputProductName">Product Name <span class="text-danger">*</span></label>
            <input class="form-control" id="inputProductName" type="text" name="product_name" placeholder="Product Name" value="{{ $product->product_name }}">
            <span id="productNameError" class="text-danger"></span>
        </div>

        <div class="col-md-12">
            <label class="small mb-1" for="inputProductSKU">Barcode <span class="text-danger">*</span></label>
            <input class="form-control" id="inputProductSKU" type="text" name="product_sku" placeholder="Barcode" maxlength="8" value="{{ $product->SKU }}">
            <span id="productSkuError" class="text-danger"></span>
        </div>

        <div class="col-md-6">
            <label class="small mb-1" for="selectProductCategory">Product Category <span class="text-danger">*</span></label>
            <select class="form-control edit-product-category" id="selectProductCategory" name="category">
                <option value="">Select a category</option>
                @foreach ($categories as $i)
                    <option value="{{ $i->id }}" {{ $product->product_category == $i->id ? 'selected' : '' }}>{{ $i->category_name }}</option>
                @endforeach
            </select>
            <span id="categoryError" class="text-danger"></span>
        </div>

        <div class="col-md-6">
            <label class="small mb-1" for="selectUnitType">Unit Type <span class="text-danger">*</span></label>
            <select class="form-control edit-product-unit" id="selectUnitType" name="unit">
                <option value="">Select unit type</option>
                @foreach ($units as $i)
                    <option value="{{ $i->id }}" {{ $product->unit == $i->id ? 'selected' : '' }}>{{ $i->unit_name }}</option>
                @endforeach
            </select>
            <span id="unitError" class="text-danger"></span>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-primary-soft btn-primary text-primary" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Save changes</button>
    </div>
</form>

<script>
document.addEventListener("submit", function (e) {
    const form = e.target;
    if (form && form.id === "editProductForm") {
        e.preventDefault();

        let isValid = true;

        // Get elements inside the form
        const brandEl = form.querySelector("#inputProductBrand");
        const productNameEl = form.querySelector("#inputProductName");
        const productSkuEl = form.querySelector("#inputProductSKU");
        const categoryEl = form.querySelector("#selectProductCategory");
        const unitEl = form.querySelector("#selectUnitType");

        // Clear previous errors
        form.querySelector("#brandError").textContent = "";
        form.querySelector("#productNameError").textContent = "";
        form.querySelector("#productSkuError").textContent = "";
        form.querySelector("#categoryError").textContent = "";
        form.querySelector("#unitError").textContent = "";

        // Brand validation
        if (brandEl.value.trim() === "") {
            form.querySelector("#brandError").textContent = "Brand is required.";
            isValid = false;
        }

        // Product name validation
        if (productNameEl.value.trim() === "") {
            form.querySelector("#productNameError").textContent = "Product name is required.";
            isValid = false;
        }

        // SKU validation: required and max length 8
        if (productSkuEl.value.trim() === "") {
            form.querySelector("#productSkuError").textContent = "Barcode is required.";
            isValid = false;
        }

        // Category validation
        if (categoryEl.value === "") {
            form.querySelector("#categoryError").textContent = "Please select a product category.";
            isValid = false;
        }

        // Unit validation
        if (unitEl.value === "") {
            form.querySelector("#unitError").textContent = "Please select a unit type.";
            isValid = false;
        }

        if (isValid) {
            form.submit(); // Or replace with AJAX
        }
    }
});
</script>
