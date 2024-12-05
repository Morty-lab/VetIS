@extends('layouts.app')

@section('styles')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    <style>
        /* Smooth transition for view changes */
        #calendar {
            opacity: 1;
            transition: opacity 0.5s ease-in-out; /* Add transition */
        }

        /* Hidden state for smoother transition */
        .fc-hidden {
            opacity: 0 !important;
        }
    </style>
@endsection

@section('content')
    @include('components.header', ['title' => 'Calendar'], ['icon' => '<i class="fa-solid fa-calendar-days"></i>'])

    <!-- Main page content -->
    <div class="container-xl px-4 mt-4">
        <div class="card shadow-none">
            <div class="card-body">
                <!-- Back to Month View Button -->
                <button id="backToMonthView" class="btn btn-primary mb-3" style="display: none;">
                    Back to Month View
                </button>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var backToMonthViewBtn = document.getElementById('backToMonthView');

            // Get appointments data from server-side rendered JSON
            var appointments = {!! $appointments !!};

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                nowIndicator: true, // Show the "now" indicator
                events: appointments, // Use directly loaded appointments data

                // Transition between views with a fade effect
                viewWillEnter: function() {
                    // Fade in when entering a new view
                    calendarEl.classList.remove('fc-hidden');
                },
                viewWillLeave: function() {
                    // Fade out when leaving the current view
                    calendarEl.classList.add('fc-hidden');
                },

                // Add event to enable switching views when clicking on a date
                dateClick: function(info) {
                    // Check if the clicked date is within a day or week range and change to the list view
                    if (calendar.view.type === 'dayGridMonth') {
                        calendar.changeView('listWeek', info.date); // Switch to listWeek view
                        backToMonthViewBtn.style.display = 'block'; // Show the back button
                    }
                },

                // When the view changes, ensure the transition is applied after rendering
                viewDidChange: function() {
                    calendarEl.classList.remove('fc-hidden'); // Ensure the calendar becomes visible after view change
                }
            });

            calendar.render();

            // Event listener for the "Back to Month View" button
            backToMonthViewBtn.addEventListener('click', function() {
                calendar.changeView('dayGridMonth'); // Switch back to month view
                backToMonthViewBtn.style.display = 'none'; // Hide the back button
            });
        });
    </script>
@endsection
