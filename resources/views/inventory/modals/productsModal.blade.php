@php use Carbon\Carbon; @endphp

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('products.store') }}" method="POST" id="addProductForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create Product <span class="text-danger">*</span></h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row gy-2">
                    <div class="col-md-12">
                        <label class="small mb-1" for="inputProductBrand">Brand <span class="text-danger">*</span></label>
                        <input class="form-control" id="inputProductBrand" type="text" placeholder="Brand"
                            value="" name="brand">
                        <div id="brandError" class="text-danger small mt-1"></div>
                    </div>
                    <div class="col-md-12">
                        <label class="small mb-1" for="inputProductName">Product Name <span class="text-danger">*</span></label>
                        <input class="form-control" id="inputProductName" type="text" placeholder="Product Name"
                            value="" name="product_name">
                        <div id="productNameError" class="text-danger small mt-1"></div>
                    </div>
                    <div class="col-md-12">
                        <label class="small mb-1" for="inputProductSKU">Barcode <span class="text-danger">*</span></label>
                        <input class="form-control" id="inputProductSKU" type="text" maxlength="8"
                            placeholder="Barcode" name="product_sku">
                        <div id="productSkuError" class="text-danger small mt-1"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="small mb-1" for="selectProductCategory">Product Category <span class="text-danger">*</span></label>
                        <select class="form-control add-product-category" id="selectProductCategory" name="category" data-placeholder="Select Product Category">
                            <option></option>
                            @foreach ($categories as $i)
                                <option value="{{ $i->id }}">{{ $i->category_name }}</option>
                            @endforeach
                        </select>
                        <div id="categoryError" class="text-danger small mt-1"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="small mb-1" for="selectUnitType">Unit Type <span class="text-danger">*</span></label>
                        <select class="form-control add-product-unit" id="selectUnitType" name="unit" data-placeholder="Select Product Unit">
                            <option></option>
                            @foreach ($units as $i)
                                <option value="{{ $i->id }}">{{ $i->unit_name }}</option>
                            @endforeach
                        </select>
                        <div id="unitError" class="text-danger small mt-1"></div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-primary-soft text-primary" type="button"
                        data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Save
                        changes</button></div>
            </form>

        </div>
    </div>
</div>
    <!-- View Product Modal -->
    <div class="modal fade" id="viewProductModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content" id="viewProductModalContent">
            </div>
        </div>
    </div>

    {{-- Edit Product Modal --}}
    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" id="editProductModalContent"></div>
        </div>
    </div>
    
    {{-- Delete Product Modal --}}
     <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" id="deleteProductModalContent">
            </div>
        </div>
    </div>

    {{-- Add Stock Modal --}}
    <div class="modal fade" id="addStocksModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" id="addStocksModalContent"></div>
        </div>
    </div>

    {{-- Edit Stock Modal --}}
    <div class="modal fade" id="editStocksModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" id="editStocksModalContent"></div>
        </div>
    </div>


    {{-- Delete Stock Modal --}}
    <div class="modal fade" id="deleteStockModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" id="deleteStocksModalContent">
            </div>
        </div>
    </div>

    {{-- Repack Product Modal --}}
    <div class="modal fade" id="repackStocksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="repackStocksModalContent">  
            </div>
        </div>
    </div>