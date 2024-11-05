@extends('layouts.app')

@section('styles')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
@endsection

@section('content')
<header class="mt-n10 pt-10 mb-4 bg-white border-bottom">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="">
                <div class="">
                    <h1 class="d-flex text-primary">
                        <div class="nav-link-icon me-2"><i class="fa-solid fa-bolt"></i></div>
                        <p>Dashboard</p>
                    </h1>
                    <!-- <div class="page-header-subtitle mt-3">Good Morning, Dr. {{Auth::user()->name}}</div> -->
                </div>
                <!-- <div class="col-12 col-xl-auto mt-4">
                    <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                        <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                        <input class="form-control ps-0 pointer" id="litepickerRangePlugin" placeholder="Select date range..." />
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</header>

<!-- Main page content-->
<div class="container-xl px-4">
    <!-- Example Colored Cards for Dashboard Demo-->
    <div class="row">
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card border-start-lg border-start-primary bg-white text-dark shadow-none h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-primary">Upcoming Appointments</div>
                            <div class="text-xl fw-bold">{{$appointmentCount}}</div>
                        </div>
                        <i class="fa-regular fa-calendar text-gray-400 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-primary stretched-link" href="/todayappointments">View Appointments</a>
                    <div class=""><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card border-start-lg border-start-success bg-white text-dark shadow-none h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-success">Finished Appointments</div>
                            <div class="text-xl fw-bold">{{$finishedAppointments}}</div>
                        </div>
                        <i class="fa-regular fa-calendar-check text-gray-400 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-success stretched-link" href="/finishedappointments">View Finished Appointments</a>
                    <div class=""><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card border-start-lg border-start-secondary bg-white text-dark shadow-none h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-secondary">Registered Pets</div>
                            <div class="text-xl fw-bold">{{$petCount}}</div>
                        </div>
                        <i class="fa-solid fa-paw text-gray-400 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-secondary stretched-link" href="{{route('pet.index')}}">View Pets</a>
                    <div class=""><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card border-start-lg border-start-warning bg-white text-dark shadow-none h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-warning">Appointment Requests</div>
                            <div class="text-xl fw-bold">{{$appointmentRequests}}</div>
                        </div>
                        <i class="feather-xl text-gray-400" data-feather="message-circle"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-warning stretched-link" href="dashboard-1.html#!">View Requests</a>
                    <div class=""><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Example Charts for Dashboard Demo-->
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
    <div class="col mb-4">
        <div class="card card-header-actions h-100 shadow-none">
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
            events: [{
                    date: '2024-09-15',
                    backgroundColor: '#ff9f89',
                    borderColor: '#ff9f89'
                },
                {
                    date: '2024-09-07',
                    backgroundColor: '#ff9f89',
                    borderColor: '#ff9f89',
                    title: 'Important Meeting'
                },

                // Add more dates here...
            ],
            eventDisplay: 'block',
            eventBackgroundColor: '#ff9f89',
            eventBorderColor: '#ff9f89',
        });
        calendar.render();
    });
</script>
@endsection
