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
                        @if (Route::currentRouteName() === 'appointments.index' &&
                                (auth()->user()->role == 'staff' || auth()->user()->role == 'admin'))
                            <button class="btn btn-outline-primary me-2" type="button" data-bs-toggle="modal"
                                data-bs-target="#appointmentSchedModal"><i class="fa-solid fa-plus me-2"></i> Add Appointment
                            </button>
                        @endif

                        @if (Route::currentRouteName() !== 'appointments.index')
                            <nav class="nav nav-borders">
                                <a class="nav-link {{ Route::is('appointments.today') ? 'active' : '' }} ms-0"
                                    href="{{ route('appointments.today') }}">
                                    @php
                                        $todayCount = 0;
                                        foreach ($appointments as $appointment) {
                                            if (auth()->user()->role == 'veterinarian') {
                                                $vet = \App\Models\Doctor::where('user_id', auth()->user()->id)->first()
                                                    ->id;
                                                if (
                                                    $appointment->status === 0 &&
                                                    $appointment->doctor_ID == $vet
                                                ) {
                                                    $todayCount++;
                                                } else {
                                                    continue;
                                                }
                                            } else {
                                                if (
                                                    $appointment->status === 0
                                                ) {
                                                    $todayCount++;
                                                } else {
                                                    continue;
                                                }
                                            }
                                        }
                                    @endphp
                                    Scheduled <span
                                        class="badge bg-secondary-soft text-secondary ms-auto">{{ $todayCount }}</span>
                                </a>
                                <a class="nav-link {{ Route::is('appointments.finished') ? 'active' : '' }}"
                                    href="{{ route('appointments.finished') }}">
                                    @php
                                        $finishedCount = 0;
                                        foreach ($appointments as $appointment) {
                                            if (auth()->user()->role == 'veterinarian') {
                                                $vet = \App\Models\Doctor::where('user_id', auth()->user()->id)->first()
                                                    ->id;
                                                if (
                                                    $appointment->status == 1 &&
                                                    \Carbon\Carbon::parse($appointment->updated_at)->isToday() &&
                                                    $appointment->doctor_ID == $vet
                                                ) {
                                                    $finishedCount++;
                                                } else {
                                                    continue;
                                                }
                                            } else {
                                                if (
                                                    $appointment->status == 1
//                                                     &&
//                                                    \Carbon\Carbon::parse($appointment->updated_at)->isToday()
                                                ) {
                                                    $finishedCount++;
                                                } else {
                                                    continue;
                                                }
                                            }
                                        }
                                    @endphp
                                    Finished <span
                                        class="badge bg-success-soft text-success ms-auto">{{ $finishedCount }}</span>
                                </a>
                                <a class="nav-link {{ Route::is('appointments.pending') ? 'active' : '' }}"
                                    href="{{ route('appointments.pending') }}">
                                    @php
                                        $requestCount = 0;
                                        if (auth()->user()->role == 'veterinarian') {
                                            $requestCount = \App\Models\Appointments::where('status', null)
                                                ->where(
                                                    'doctor_ID',
                                                    \App\Models\Doctor::where('user_id', auth()->user()->id)->first()
                                                        ->id,
                                                )
                                                ->count();
                                        } else {
                                            $requestCount = \App\Models\Appointments::where('status', null)->count();
                                        }
                                    @endphp
                                    Request <span
                                        class="badge bg-warning-soft text-warning ms-auto">{{ $requestCount }}</span>
                                </a>
                                <a class="nav-link {{ Route::is('appointments.cancelled') ? 'active' : '' }}"
                                    href="{{ route('appointments.cancelled') }}">
                                    @php
                                        $cancelledCount = 0;
                                        if (auth()->user()->role == 'veterinarian') {
                                            $cancelledCount = \App\Models\Appointments::where('status', 2)
                                                ->where(
                                                    'doctor_ID',
                                                    \App\Models\Doctor::where('user_id', auth()->user()->id)->first()
                                                        ->id,
                                                )
                                                ->count();
                                        } else {
                                            $cancelledCount = \App\Models\Appointments::where('status', 2)->count();
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
