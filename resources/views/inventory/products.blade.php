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
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Create Product</button>
                <!-- <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Stock In</button> -->
            </div>
        </div>
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
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>2393084232</td>
                                <td>{{ $product->product_name }}</td>
                                <td>
                                    @foreach ($categories as $i)
                                    @if ($i->id == $product->product_category)
                                    {{ $i->category_name }}
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($units as $i)
                                    @if ($i->id == $product->unit)
                                    {{ $i->unit_name }}
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    Php {{ $product->price }}
                                </td>
                                <td>
                                    @if ($product->status == 1)
                                    <div class="badge bg-primary text-white rounded-pill">Available</div>
                                    @else
                                    {{-- @if($products->stocks->) @endif--}}
                                    <div class="badge bg-danger text-white rounded-pill">Unavailable</div>
                                    @endif
                                </td>
                                <td>
                                    @php
                                    if ($product->stocks->isNotEmpty() && $product->stocks->first()->status == 1){
                                    $allStocks = $product->stocks;
                                    $stock = 0;
                                    $expiredStocks = 0;
                                    foreach ($allStocks as $i){
                                    if( $i->expiry_date == null ){
                                    $stock += $i->stock;
                                    }
                                    if( $i->expiry_date != null && $i->expiry_date > Carbon::today()){
                                    $stock += $i->stock;
                                    }
                                    if( $i->expiry_date != null && $i->expiry_date <= Carbon::today()){
                                        $expiredStocks +=$i->stock;
                                        }
                                        }
                                        echo $stock." stocks Available ";
                                        if( $expiredStocks != 0){
                                        echo $expiredStocks." stock Expired";
                                        }
                                        }
                                        else{
                                        echo "No stocks available";
                                        }
                                        @endphp
                                </td>
                                <td>
                                    <button class="btn btn-datatable btn-primary px-5 py-3" data-bs-toggle="modal" data-bs-target="#viewProductModal{{ $product->id }}">Open</button>
                                    <!-- <button class="btn btn-datatable btn-icon btn-transparent-dark"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal{{ $product->id }}"><i
                                            data-feather="trash-2"></i></button> -->
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
@endsection

@section('scripts')
@endsection