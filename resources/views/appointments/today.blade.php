@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="/manageappointments">Manage Appointments</a></li>
                    <li class="breadcrumb-item active">Today's Appointments</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class=" container-xl px-4 ">
    <div class="row">
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Today's Appointments</div>
                            <div class="text-lg fw-bold">25</div>
                        </div>
                        <i class="fa-regular fa-calendar text-white-50 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href="/todayappointments">View Today's Appointments</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-success text-white h-100">
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
                    <a class="text-white stretched-link" href="/finishedappointments">View Finished Appointments</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Appointment Requests</div>
                            <div class="text-lg fw-bold">17</div>
                        </div>
                        <i class="fa-solid fa-xmark text-white-50 fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href="/pendingappointments">View Requests</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Cancelled Appointments</div>
                            <div class="text-lg fw-bold">17</div>
                        </div>
                        <i class="feather-xl text-white-50" data-feather="message-circle"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href="/cancelledappointments">View Cancelled Appointments</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Today's Appointments</span>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Appointment ID</th>
                        <th>Owner</th>
                        <th>Pet Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>April 7, 2024 | 12:00PM</td>
                        <td>VETIS-00001</td>
                        <td>Kent Invento</td>
                        <td>Dog</td>
                        <td>
                            <div class="badge bg-primary text-white rounded-pill">Scheduled</div>
                        </td>
                        <td>
                            <a class="btn btn-outline-primary" href="/viewappointments">Open</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection