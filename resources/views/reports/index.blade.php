@extends('layouts.app')

@section('styles')

@endsection

@section('content')
@include('components.header', ['title' => 'Reports'], ['icon' => '<i class="fa-solid fa-chart-simple"></i>'])

<div class="container-xl px-4 mt-4">
    <div class="card mb-4 shadow-none">
        <div class="card-header">
            Reports
        </div>
        <div class="card-body">
            <a href="{{route('reports.pos')}}" class="btn btn-outline-primary">POS Sales Reports</a>
            <a href="{{route('reports.inventory')}}" class="btn btn-outline-primary">Inventory Reports</a>
            <a href="{{route('reports.replenishment')}}" class="btn btn-outline-primary">Replenishment Reports</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 mb-4">
            <div class="card card-header-actions h-100 shadow-none">
                <div class="card-header">
                    Earnings Breakdown
                    <div class="dropdown no-caret">
                        <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="areaChartDropdownExample" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                        <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="areaChartDropdownExample">
                            <a class="dropdown-item" href="dashboard-1.html#!">Last 12 Months</a>
                            <a class="dropdown-item" href="dashboard-1.html#!">Last 30 Days</a>
                            <a class="dropdown-item" href="dashboard-1.html#!">Last 7 Days</a>
                            <a class="dropdown-item" href="dashboard-1.html#!">This Month</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="dashboard-1.html#!">Custom Range</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-4">
            <div class="card card-header-actions h-100 shadow-none">
                <div class="card-header">
                    Monthly Revenue
                    <div class="dropdown no-caret">
                        <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="areaChartDropdownExample" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                        <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="areaChartDropdownExample">
                            <a class="dropdown-item" href="dashboard-1.html#!">Last 12 Months</a>
                            <a class="dropdown-item" href="dashboard-1.html#!">Last 30 Days</a>
                            <a class="dropdown-item" href="dashboard-1.html#!">Last 7 Days</a>
                            <a class="dropdown-item" href="dashboard-1.html#!">This Month</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="dashboard-1.html#!">Custom Range</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-bar"><canvas id="myBarChart" width="100%" height="30"></canvas></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
</script>
@endsection