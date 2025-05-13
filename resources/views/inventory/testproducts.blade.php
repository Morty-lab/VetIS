@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- Modals -->
    {{-- @include('inventory.modals.productsModal') --}}

    @include(
        'inventory.general.header',
        ['title' => 'Products'],
        ['icon' => '<i class="fa-solid fa-box-open"></i>']
    )
    <div class="container-xl px-4 mt-4">
        <div class="card mb-4 shadow-none">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Products List</span>
                <div class="">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Create
                        Product</button>
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
                            {{--                        <th>Price</th> --}}
                            <th>Status</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            @php
                                $stocks = \App\Models\Stocks::getAllStocksByProductId($product->id)->sum('stock');
                                $subtracted = \App\Models\Stocks::getAllStocksByProductId($product->id)->sum(
                                    'subtracted_stock',
                                );

                            @endphp
                            <tr>
                                <td class="text-center">{{ $product->SKU }}</td>
                                <td class="text-ceter">{{ $product->brand }}</td>
                                <td class="text-center">{{ $product->product_name }}</td>
                                <td class="text-center">
                                    {{ \App\Models\Category::where('id', $product->product_category)->first()->category_name }}
                                </td>
                                <td class="text-center">
                                    {{ \App\Models\Unit::where('id', $product->unit)->first()->unit_name }}</td>
                                <td class="text-center">
                                    @if ($stocks - $subtracted <= 0)
                                        <div class="badge bg-danger-soft text-danger rounded-pill">No Stocks</div>
                                    @elseif ($stocks - $subtracted <= $stocks * 0.1)
                                        <div class="badge bg-warning-soft text-warning rounded-pill">Low Stock</div>
                                    @else
                                        <div class="badge bg-primary-soft text-primary rounded-pill">Available</div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $stocks - $subtracted ?? 'No' }} Stock/s Available
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-datatable btn-primary px-5 py-3" data-bs-toggle="modal"
                                        data-bs-target="#viewProductModal" data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->product_name }}"
                                        data-unit="{{ $units->firstWhere('id', $product->unit)?->unit_name }}"
                                        data-category="{{ $categories->firstWhere('id', $product->product_category)?->category_name }}"
                                        data-stock="{{ \App\Models\Stocks::getAllStocksByProductId($product->id)->sum('stock') - \App\Models\Stocks::getAllStocksByProductId($product->id)->sum('subtracted_stock') }}"
                                        data-product-id="{{ $product->id }}">
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
    @include('inventory.modals.testproductmodal')
@endsection

@section('scripts')
    {{-- repack stock script --}}
    <script>
        const repackModal = document.getElementById('repackStockModal');
        repackModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            document.getElementById('modal_product_id').value = button.getAttribute('data-product-id');
            document.getElementById('modal_supplier').value = button.getAttribute('data-supplier-id');
            document.getElementById('modal_supplier_price').value = button.getAttribute('data-supplier-price');
            document.getElementById('modal_product_name').value = button.getAttribute('data-product-name');

            // Clear or reset optional fields
            document.getElementById('modal_repacked_SKU').value = '';
            document.getElementById('modal_quantity').value = '';
            document.getElementById('modal_unit').selectedIndex = 0;
            document.getElementById('modal_number_units').value = '';
            document.getElementById('modal_stock_price').value = '';

            document.getElementById('repackModalTitle').innerText = 'Repack Stock for ' + button.getAttribute(
                'data-product-name');
        });
    </script>
    {{-- view product modal script --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewProductModal = document.getElementById('viewProductModal');

        viewProductModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const name = button.getAttribute('data-product-name');
            const stock = button.getAttribute('data-stock');
            const unit = button.getAttribute('data-unit');
            const category = button.getAttribute('data-category');
            document.getElementById('modalProductName').textContent = name;

            const stockBadge = document.getElementById('modalStockBadge');
            stockBadge.textContent = stock == 0 ? 'No Stocks Available' : `${stock} Stocks Available`;
            stockBadge.className = 'badge rounded-pill ' + (stock == 0 ? 'bg-danger-soft text-danger' : 'bg-primary-soft text-primary');

            document.getElementById('modalUnitBadge').textContent = unit;
            document.getElementById('modalCategoryBadge').textContent = category;

            
        });
    });
</script>

@endsection
