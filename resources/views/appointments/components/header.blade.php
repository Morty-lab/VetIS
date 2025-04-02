<header class="mt-n10 pt-10 bg-white border-bottom">
    <div class="container-xl px-4">
        <div class="page-header-content py-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h1 class="d-flex text-primary mb-0">
                    <div class="nav-link-icon me-2">{!! $icon !!}</div>
                    <p class="mb-0">{{ $title }}</p>
                </h1>
                <div class="w-100 w-md-auto">
                    <div class="d-flex flex-column flex-md-row justify-content-md-end">
                        @if (Route::currentRouteName() === 'appointments.index' && (auth()->user()->role == 'staff' || auth()->user()->role == 'admin' ))

                            <button class="btn btn-outline-primary me-2" type="button" data-bs-toggle="modal"
                                    data-bs-target="#appointmentSchedModal">Add Appointment
                            </button>

                        @endif

                        @if (Route::currentRouteName() !== 'appointments.index')
                            <nav class="nav nav-borders">
                                <a class="nav-link {{ Route::is('appointments.today') ? 'active' : '' }} ms-0"
                                   href="{{route('appointments.today')}}">
                                    @php
                                        $todayCount = 0;
                                        foreach ($appointments as $appointment) {
                                        if (
                                        $appointment->status === 0 &&
                                        \Carbon\Carbon::parse($appointment->appointment_date)->isToday()
                                        ) {
                                        $todayCount++;
                                        } else {
                                        continue;
                                        }
                                        }
                                    @endphp
                                    Today <span
                                        class="badge bg-primary-soft text-primary ms-auto">{{ $todayCount }}</span>
                                </a>
                                <a class="nav-link {{ Route::is('appointments.finished') ? 'active' : '' }}"
                                   href="{{route('appointments.finished')}}">
                                    @php
                                        $finishedCount = 0;
                                        foreach ($appointments as $appointment) {
                                        if (
                                        $appointment->status == 1 &&
                                        \Carbon\Carbon::parse($appointment->updated_at)->isToday()
                                        ) {
                                        $finishedCount++;
                                        } else {
                                        continue;
                                        }
                                        }
                                    @endphp
                                    Finished <span
                                        class="badge bg-success-soft text-success ms-auto">{{ $finishedCount }}</span>
                                </a>
                                <a class="nav-link {{ Route::is('appointments.pending') ? 'active' : '' }}"
                                   href="{{route('appointments.pending')}}">
                                    @php
                                        $requestCount = 0;
                                        foreach ($appointments as $appointment) {
                                        if (is_null($appointment->status) == true) {
                                        $requestCount++;
                                        } else {
                                        continue;
                                        }
                                        }
                                    @endphp
                                    Request <span
                                        class="badge bg-warning-soft text-warning ms-auto">{{ $requestCount }}</span>
                                </a>
                                <a class="nav-link {{ Route::is('appointments.cancelled') ? 'active' : '' }}"
                                   href="{{route('appointments.cancelled')}}">
                                    @php
                                        $cancelledCount = 0;
                                        foreach ($appointments as $appointment) {
                                        if (
                                        $appointment->status == 2
                                        ) {
                                        $cancelledCount++;
                                        } else {
                                        continue;
                                        }
                                        }
                                    @endphp
                                    Cancelled <span
                                        class="badge bg-danger-soft text-danger ms-auto">{{ $cancelledCount }}</span>
                                </a>
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
