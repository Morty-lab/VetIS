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
            <table id="inventoryProductsTable">
                <thead>
                    <tr>
                        <th>SKU (Stock Keeping Unit)</th>
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
                        <td>{{ sprintf("VetIS-%05d", $product->SKU)}}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{\App\Models\Category::where('id',$product->product_category)->first()->category_name}}</td>
                        <td>{{\App\Models\Unit::where('id',$product->unit)->first()->unit_name}}</td>
{{--                        <td>--}}
{{--                            Php {{ $product->price }}--}}
{{--                        </td>--}}
                        <td>
                            @if ($stocks - $subtracted <= 0)
                                <div class="badge bg-danger-soft text-danger rounded-pill">No Stocks</div>
                            @elseif (($stocks - $subtracted) <= ($stocks * 0.1))
                                <div class="badge bg-warning-soft text-warning rounded-pill">Low Stock</div>
                            @else
                                <div class="badge bg-primary-soft text-primary rounded-pill">Available</div>
                            @endif
                        </td>
                        <td>

                            {{$stocks - $subtracted ?? 'No'}} Stock/s Available
                        </td>
                        <td>
                            <button class="btn btn-datatable btn-primary px-5 py-3" data-bs-toggle="modal" data-bs-target="#viewProductModal{{ $product->id }}">Open</button>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
