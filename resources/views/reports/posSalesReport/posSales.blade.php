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
    <div class="card shadow-none p-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                <h3 class="mb-0 text-primary">POS Sales Reports</h3>
            </div>
            <div class="">
                <nav class="nav nav-borders">
                    <a class="ms-0 nav-link nav-tab {{ request()->is('daily-sales') ? 'active' : '' }}" href="#daily-sales">
                        Daily Sales
                    </a>
                    <a class="nav-link nav-tab {{ request()->is('monthly-sales') ? 'active' : '' }}" href="#monthly-sales">
                        Monthly Sales
                    </a>
                </nav>
            </div>
        </div>
    </div>
    <div class="card shadow-none mt-4" id="dailySalesCard" style="display: none;">
        <div class="card-header">
            Daily Sales Report
        </div>
        <div class="card-body">
            <table id="dailySalesReportsTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Items Sold</th>
                        <th>Total Sales</th>
                        <th>Revenue</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)
{{--                    @if($sale->created_at === \Carbon\Carbon::today())--}}
                        <tr>
                            <td>{{\Carbon\Carbon::parse($sale->date)->format('F j, Y')}}</td>
                            <td>{{$sale->items_sold}}</td>
                            <td>₱{{ $sale->total_sales  }}</td>
                            <td>₱{{$sale->revenue}}</td>
                            <td><a class="btn btn-datatable btn-primary px-5 py-3" href="{{route('reports.pos.daily.reports',['date'=>$sale->date])}}" target=" _blank"><i class="fa-solid fa-print"></i></a></td>
                        </tr>
{{--                    @endif--}}
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="card shadow-none mt-4" id="monthlySalesCard" style="display: none;">
        <div class="card-header">
            Monthly Sales Report
        </div>
        <div class="card-body">
            <table id="monthlySalesReportsTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Items Sold</th>
                        <th>Total Sales</th>
                        <th>Revenue</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($monthlyReports as $month)
                    <tr>
                        <td>{{ $month->month }}</td>
                        <td>{{ $month->items_sold }}</td>
                        <td>₱{{ $month->total_sales  }}</td>
                        <td>₱{{ $month->revenue }}</td>
                        <td>
                            <a class="btn btn-datatable btn-primary px-5 py-3" href="{{ route('reports.pos.monthly.reports',['date'=>$month->month]) }}" target="_blank">
                                <i class="fa-solid fa-print"></i>
                            </a>
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
<script>
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
</script>
@endsection
