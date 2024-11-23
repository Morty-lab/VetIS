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
                        <div class="page-header-icon">
                            <i class="fa-regular fa-calendar-plus p-1"></i>
                        </div>
                        Schedule
                    </h1>
                    <div class="page-header-subtitle">
                        Manage your schedule with the interactive calendar
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class=" container-xl px-4 mt-n10">
    <div class="card shadow-none">
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
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