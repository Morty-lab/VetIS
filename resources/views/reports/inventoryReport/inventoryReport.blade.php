@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<div class="container-xl px-4 mt-4">
    <nav class="nav nav-borders">
        <a class="nav-link ms-0" href="javascript:void(0);" onclick="history.back()"><span class="px-2">
                <i class="fa-solid fa-arrow-left"></i> Back</a>
    </nav>
    <hr class="mt-0 mb-4">
    <div class="card shadow-none p-3 py-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                <h3 class="mb-0 text-primary">Inventory Reports</h3>
            </div>
        </div>
    </div>
    <div class="card shadow-none mt-4" id="dailySalesCard">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                Products List
                <div class="">
                    <a href="{{route('reports.inventory.productsList')}}" target="_blank" class="btn btn-outline-primary">Print All Products</a>
                    <a href="{{route('reports.inventory.allStockList')}}" target="_blank" class="btn btn-outline-primary">Print All Stocks</a>
                    <a href="{{route('reports.inventory.lowStockList')}}" target="_blank" class="btn btn-outline-primary">Print Low Stocks</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <th>SKU</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr data-index="0">
                        <td>VetIS-00001</td>
                        <td>Turtle Tank Filter</td>
                        <td>
                            Supplements
                        </td>
                        <td>
                            Bottles
                        </td>
                        <td>
                            Php 85.37
                        </td>
                        <td>
                            <div class="badge bg-primary-soft text-primary rounded-pill">Available</div>
                        </td>
                        <td>
                            No stocks available </td>
                        <td>
                            <a class="btn btn-datatable btn-outline-primary px-5 py-3" href="{{route('reports.inventory.itemStock')}}" target="_blank"><i class="fa-solid fa-print"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.nav-tab');
        const cards = {
            'daily-sales': document.getElementById('dailySalesCard'),
            'monthly-sales': document.getElementById('monthlySalesCard'),
        };

        // Ensure Pet Profile is active initially
        document.querySelector('.nav-link[href="#daily-sales"]').classList.add('active');
        cards['daily-sales'].style.display = 'block'; // Show Pet Profile Card by default

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                // Hide all cards
                Object.values(cards).forEach(card => card.style.display = 'none');

                // Show the clicked tab's corresponding card
                const targetCard = tab.getAttribute('href').substring(1);
                if (cards[targetCard]) {
                    cards[targetCard].style.display = 'block';
                }
            });
        });

        // Trigger the click on the Pet Profile tab to show it initially
        document.querySelector('.nav-tab.active').click();
    });
</script> -->
@endsection