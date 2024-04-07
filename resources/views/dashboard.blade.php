@extends('layouts.app')

@section('styles')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
@endsection

@section('content')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                        Dashboard
                    </h1>
                    <div class="page-header-subtitle mt-3">Good Morning, Dr. {{Auth::user()->name}}</div>
                </div>
                <div class="col-12 col-xl-auto mt-4">
                    <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                        <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                        <input class="form-control ps-0 pointer" id="litepickerRangePlugin" placeholder="Select date range..." />
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main page content-->
<div class="container-xl px-4 mt-n10">
    <!-- Example Colored Cards for Dashboard Demo-->
    <div class="row">
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Upcoming Appointments</div>
                            <div class="text-lg fw-bold">25</div>
                        </div>
                        <i class="fa-regular fa-calendar text-white-50 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href="dashboard-1.html#!">View Appointments</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Finished Appointments</div>
                            <div class="text-lg fw-bold">15</div>
                        </div>
                        <i class="fa-regular fa-calendar-check text-white-50 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href="dashboard-1.html#!">View Finished Appointments</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Registered Pets</div>
                            <div class="text-lg fw-bold">24</div>
                        </div>
                        <i class="fa-solid fa-paw text-white-50 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href="dashboard-1.html#!">View Pets</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Pending Appointment Requests</div>
                            <div class="text-lg fw-bold">17</div>
                        </div>
                        <i class="feather-xl text-white-50" data-feather="message-circle"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href="dashboard-1.html#!">View Requests</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Example Charts for Dashboard Demo-->
    <div class="row">
        <div class="col-xl-6 mb-4">
            <div class="card card-header-actions h-100">
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
            <div class="card card-header-actions h-100">
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
    <div class="col mb-4">
        <div class="card card-header-actions h-100">
            <div class="card-header">
                Schedule Calendar
            </div>
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <!-- Example DataTable for Dashboard Demo-->
</div>
@endsection

@section('scripts')
<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/swiper/swiper.js')}}"></script>

<!-- Main JS -->
<script src="../../assets/js/main.js"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
        });
        calendar.render();
    });
</script>
@endsection