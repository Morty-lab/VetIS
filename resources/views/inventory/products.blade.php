@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('styles')
@endsection

@section('content')

<!-- Modals -->
@include('inventory.modals.productsModal')

@include('inventory.general.header', ['title' => 'Products'], ['icon' => '<i class="fa-solid fa-box-open"></i>'])
<div class="container-xl px-4 mt-4">
    <div class="card mb-4 shadow-none">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Products List</span>
            <div class="">
                <button class="btn btn-primary add-product-btn">Create Product</button>
                <!-- <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Stock In</button> -->
            </div>
        </div>
        <div class="card-body">
            <table id="inventoryProductsTable">
                <thead>
                    <tr>
                        <th>Barcode</th>
                        <th>Brand</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Unit</th>
{{--                        <th>Price</th>--}}
                        <th>Status</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @php
                            $stocks = \App\Models\Stocks::getAllStocksByProductId($product->id)->sum('stock');
                            $subtracted = \App\Models\Stocks::getAllStocksByProductId($product->id)->sum('subtracted_stock');

                        @endphp
                    <tr>
                        <td class="text-center">{{ $product->SKU }}</td>
                        <td class="text-ceter">{{$product->brand}}</td>
                        <td class="text-center">{{ $product->product_name }}</td>
                        <td class="text-center">{{ \App\Models\Category::where('id', $product->product_category)->first()->category_name }}</td>
                        <td class="text-center">{{ \App\Models\Unit::where('id', $product->unit)->first()->unit_name }}</td>
                        <td class="text-center">
                            @if ($stocks - $subtracted <= 0)
                                <div class="badge bg-danger-soft text-danger rounded-pill">No Stocks</div>
                            @elseif (($stocks - $subtracted) <= ($stocks * 0.1))
                                <div class="badge bg-warning-soft text-warning rounded-pill">Low Stock</div>
                            @else
                                <div class="badge bg-primary-soft text-primary rounded-pill">Available</div>
                            @endif
                        </td>
                        <td class="text-center">
                            {{ $stocks - $subtracted ?? 'No' }} Stock/s Available
                        </td>
                        <td class="text-center">
                            <button class="btn btn-datatable btn-primary px-5 py-3 view-product-btn" data-id="{{ $product->id }}">
                                View
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.add-product-btn', function () {
            const modalEl = document.getElementById('addProductModal');
                if (modalEl) {
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();

                    $(".add-product-category").select2({
                        theme: "bootstrap-5",
                        dropdownParent: "#addProductModal",
                        width: $(this).data("width")
                            ? $(this).data("width")
                            : $(this).hasClass("w-100")
                                ? "100%"
                                : "style",
                        placeholder: $(this).data("placeholder"),
                    });
                    
                    $(".add-product-unit").select2({
                        theme: "bootstrap-5",
                        dropdownParent: "#addProductModal",
                        width: $(this).data("width")
                            ? $(this).data("width")
                            : $(this).hasClass("w-100")
                                ? "100%"
                                : "style",
                        placeholder: $(this).data("placeholder"),
                    });

                    document.addEventListener("submit", function (e) {
                    const form = e.target;
                    if (form && form.id === "addProductForm") {
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
                }

                
        });

    $(document).on('click', '.view-product-btn', function () {
    const productId = $(this).data('id');

    $.ajax({
            url: '/products/' + productId + '/modal',
            method: 'GET',
            success: function (response) {
                // Inject response into modal content container
                $('#viewProductModalContent').html(response);

                // Show the modal using Bootstrap 5's native JS API
                const modalEl = document.getElementById('viewProductModal');
                if (modalEl) {
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();

                    // Use a slight delay to ensure the modal is rendered before initializing the table
                    setTimeout(() => {
                        const table = document.querySelector("#inventoryStocksTable");
                        if (table && !table.classList.contains('datatable-loaded')) {
                            new simpleDatatables.DataTable(table);
                            table.classList.add('datatable-loaded');
                        }
                    }, 300);
                } else {
                    console.error('Modal container not found in DOM.');
                }
            },
            error: function () {
                alert('Failed to load product details. Please try again.');
            }
        });
    });

        $(document).on('click', '.edit-product-btn', function () {
            const productId = $(this).data('id');
            $.ajax({
                url: '/products/' + productId + '/modal/edit-product',
                method: 'GET',
                success: function (response) {
                    $('#editProductModalContent').html(response);

                    const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewProductModal'));
                    if (viewModal) {
                        viewModal.hide();
                    }

                    // Then show the add stock modal
                    const editModal = new bootstrap.Modal(document.getElementById('editProductModal'));
                    editModal.show();

                    $(".edit-product-category").select2({
                        theme: "bootstrap-5",
                        dropdownParent: "#editProductModal",
                        width: $(this).data("width")
                            ? $(this).data("width")
                            : $(this).hasClass("w-100")
                                ? "100%"
                                : "style",
                        placeholder: $(this).data("placeholder"),
                    });
                    
                    $(".edit-product-unit").select2({
                        theme: "bootstrap-5",
                        dropdownParent: "#editProductModal",
                        width: $(this).data("width")
                            ? $(this).data("width")
                            : $(this).hasClass("w-100")
                                ? "100%"
                                : "style",
                        placeholder: $(this).data("placeholder"),
                    });
                },
                error: function () {
                    alert('Failed to load edit product modal.');
                }
            });
        });

        $(document).on('click', '.delete-product-btn', function () {
            const productId = $(this).data('id');

            $.ajax({
                url: '/products/' + productId + '/modal/delete-product',
                method: 'GET',
                success: function (response) {
                    $('#deleteProductModalContent').html(response);

                    const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewProductModal'));
                    if (viewModal) {
                        viewModal.hide();
                    }

                    // Then show the add stock modal
                    const editModal = new bootstrap.Modal(document.getElementById('deleteProductModal'));
                    editModal.show();
                },
                error: function () {
                    alert('Failed to load delete product modal.');
                }
            });
        });

        // Handle add stock button (delegated binding)
        $(document).on('click', '.add-stock-btn', function () {
            const productId = $(this).data('id');

            $.ajax({
                url: '/products/' + productId + '/modal/add-stock',
                method: 'GET',
                success: function (response) {
                    $('#addStocksModalContent').html(response);

                    const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewProductModal'));
                    if (viewModal) {
                        viewModal.hide();
                    }

                    // Then show the add stock modal
                    const addModal = new bootstrap.Modal(document.getElementById('addStocksModal'));
                    addModal.show();

                     feather.replace();

                    $(".inventory-supplier").select2({
                        theme: "bootstrap-5",
                        dropdownParent: "#addStocksModal",
                        width: $(this).data("width")
                            ? $(this).data("width")
                            : $(this).hasClass("w-100")
                                ? "100%"
                                : "style",
                        placeholder: $(this).data("placeholder"),
                    });

                    flatpickr("#expiry_date", {
                        dateFormat: "Y-m-d", // format like 2025-03-13
                        minDate: "today",     // Restrict selection to today or earlier
                        disableMobile: "true"
                    });
                },
                error: function () {
                    alert('Failed to load add stock modal.');
                }
            });
        });

        $(document).on('click', '.edit-stock-btn', function () {
            const productId = $(this).data('id');
            const stockId = $(this).data('stockid');

            $.ajax({
                url: '/products/' + productId + '/modal/edit-stock/' + stockId,
                method: 'GET',
                success: function (response) {
                    $('#editStocksModalContent').html(response);

                    const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewProductModal'));
                    if (viewModal) {
                        viewModal.hide();
                    }

                    // Then show the add stock modal
                    const addModal = new bootstrap.Modal(document.getElementById('editStocksModal'));
                    addModal.show();

                    feather.replace();

                    $(".edit-inventory-supplier").select2({
                        theme: "bootstrap-5",
                        dropdownParent: "#editStocksModal",
                        width: $(this).data("width")
                            ? $(this).data("width")
                            : $(this).hasClass("w-100")
                                ? "100%"
                                : "style",
                        placeholder: $(this).data("placeholder"),
                    });

                    flatpickr("#expiry_date", {
                        dateFormat: "Y-m-d", // format like 2025-03-13
                        minDate: "today",     // Restrict selection to today or earlier
                        disableMobile: "true"
                    });
                },
                error: function () {
                    alert('Failed to load add stock modal.');
                }
            });
        });

        
        $(document).on('click', '.delete-stock-btn', function () {
            const productId = $(this).data('id');
            const stockId = $(this).data('stockid');

            $.ajax({
                url: '/products/' + productId + '/modal/delete-stock/' + stockId,
                method: 'GET',
                success: function (response) {
                    $('#editStocksModalContent').html(response);

                    const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewProductModal'));
                    if (viewModal) {
                        viewModal.hide();
                    }

                    // Then show the add stock modal
                    const addModal = new bootstrap.Modal(document.getElementById('editStocksModal'));
                    addModal.show();

                    feather.replace();
                },
                error: function () {
                    alert('Failed to load add stock modal.');
                }
            });
        });

        $(document).on('click', '.repack-stock-btn', function () {
            const productId = $(this).data('id');
            const stockId = $(this).data('stockid');
            $.ajax({
                url: '/products/' + productId + '/modal/repack-stock/' + stockId,
                method: 'GET',
                success: function (response) {
                    $('#repackStocksModalContent').html(response);

                    const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewProductModal'));
                    if (viewModal) {
                        viewModal.hide();
                    }
                    // Then show the add stock modal
                    const addModal = new bootstrap.Modal(document.getElementById('repackStocksModal'));
                    addModal.show();

                     $(".repack-unit").select2({
                        theme: "bootstrap-5",
                        dropdownParent: "#repackStocksModal",
                        width: $(this).data("width")
                            ? $(this).data("width")
                            : $(this).hasClass("w-100")
                                ? "100%"
                                : "style",
                        placeholder: $(this).data("placeholder"),
                    });

                    feather.replace();
                },
                error: function () {
                    alert('Failed to load add stock modal.');
                }
            });
        });
    });



    function initializeSelect2Dropdowns() {
        // Initialize Select2 for categories
        $(".edit-product-category").select2({
            theme: "bootstrap-5",
            dropdownParent: "#editProductModal",
            width: $(this).data("width")
                ? $(this).data("width")
                : $(this).hasClass("w-100")
                    ? "100%"
                    : "style",
            placeholder: $(this).data("placeholder"),
        });
        
        // Initialize Select2 for units
        $(".edit-product-unit").select2({
            theme: "bootstrap-5",
            dropdownParent: "#editProductModal",
            width: $(this).data("width")
                ? $(this).data("width")
                : $(this).hasClass("w-100")
                    ? "100%"
                    : "style",
            placeholder: $(this).data("placeholder"),
        });
    }

</script>
@endsection

@section('scripts')
@endsection
