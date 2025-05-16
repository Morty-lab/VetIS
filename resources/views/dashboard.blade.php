@extends('layouts.app')

@section('styles')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
@endsection

@section('content')
@php
switch (Auth::user()->role) {
    case 'veterinarian':
        header('Location: ' . route('appointments.index'));
        exit();
        break;

    case 'cashier':
        header('Location: ' . route('billing'));
        exit();
        break;

    case 'staff':
        header('Location: ' . route('products.index'));
        exit();
        break;

    case 'secretary':
        header('Location: ' . route('pet.index'));
        exit();
        break;

    default:
        // code for admin
        break;
}
@endphp

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
                            <div class="text-primary">Today's Appointments</div>
                            <div class="text-xl fw-bold">{{$todayCount}}</div>
                        </div>
                        <i class="fa-regular fa-calendar text-gray-400 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-primary stretched-link" href="/manageappointments">View Appointments</a>
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
                            <div class="text-xl fw-bold">{{$finishedCount}}</div>
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
                    <a class="text-warning stretched-link" href="{{route('appointments.pending')}}">View Requests</a>
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
                    Monthly Sales
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
                    <div class="chart-area"><canvas id="salesChart" width="100%" height="30"></canvas></div>
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
                    <div class="chart-bar"><canvas id="RevenueChart" width="100%" height="30"></canvas></div>
                </div>
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
    // Set default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = "-apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif";
    Chart.defaults.global.defaultFontColor = "#858796";

    function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '';
    var toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
    };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

    // Get the chart context and sales data
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesData = @json($monthlySales);  // Pass sales data from controller

    var labels = salesData.map(sale => {
    var date = new Date(sale.month + '-01'); // Add day to make it a valid date
    var options = { month: 'short', year: 'numeric' };
    return date.toLocaleString('en-US', options); // e.g., "May 2025"
    });

    var dataChart = salesData.map(sale => Number(sale.total_sales));

    // Create the chart
    var mySalesChart = new Chart(ctx, {
        type: 'line',  // Use 'line' for time series data
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Sales',
                lineTension: 0.3,
                backgroundColor: "rgba(0, 97, 242, 0.05)",
                borderColor: "rgba(0, 97, 242, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(0, 97, 242, 1)",
                pointBorderColor: "rgba(0, 97, 242, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(0, 97, 242, 1)",
                pointHoverBorderColor: "rgba(0, 97, 242, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: dataChart
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            legend: {
                display: false  // Hide the legend
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(value) {
                            return '₱' + number_format(value, 2); // peso sign + format with 2 decimal places
                        },
                        maxTicksLimit: 6, // Limit the number of lines
                        padding: 10,
                        beginAtZero: true
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }]
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: "#6e707e",
                titleFontSize: 14,
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: "index",
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || "";
                        return datasetLabel + ": ₱" + number_format(tooltipItem.yLabel, 2, '.', ',');  // Format tooltips as currency
                    }
                }
            }
        }
    });

    // Bar Chart Example
    var ctxbar = document.getElementById("RevenueChart");
    var revenueData = @json($monthlyRevenue);


    var labels = revenueData.map(sale => {
    var date = new Date(sale.month + '-01'); // Add day to make it a valid date
    var options = { month: 'short', year: 'numeric' };
    return date.toLocaleString('en-US', options); // e.g., "May 2025"
    });

    console.log(revenueData);

    var revenueChart = revenueData.map(sale => Number(sale.revenue));

    var myBarChart = new Chart(ctxbar, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Revenue",
                backgroundColor: "rgba(0, 97, 242, 1)",
                hoverBackgroundColor: "rgba(0, 97, 242, 0.9)",
                borderColor: "#4e73df",
                data: revenueChart,
                maxBarThickness: 25
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 6,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return "₱" + number_format(value);
                        },
                        beginAtZero: true
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: "#6e707e",
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel =
                            chart.datasets[tooltipItem.datasetIndex].label || "";
                        return datasetLabel + ": ₱" + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>
@endsection
