@extends('layouts.app')

@section('styles')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
@endsection

@section('content')
@include('components.header', ['title' => 'Calendar'], ['icon' => '<i class="fa-solid fa-calendar-days"></i>'])

<!-- Main page content-->
<div class=" container-xl px-4 mt-4">
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