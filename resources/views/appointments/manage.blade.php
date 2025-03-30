@php
    use App\Models\Clients;
    use App\Models\Pets;
@endphp
@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    @include(
        'appointments.components.header',
        ['title' => 'Appointments'],
        ['icon' => '<i class="fa-regular fa-calendar-plus"></i>']
    )

    <div class="modal fade" id="appointmentSchedModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('appointments.add') }}" method="POST">
                @csrf
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Add Appointment</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Row-->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOwnerName">Pet Owner</label>
                                <select class="select-owner-name form-control" id="inputOwnerName" name="owner_ID" data-placeholder="Select Pet Owner"
                                    onchange="fetchOwnedPets(this.value)">
                                    <option value=""></option>
                                    @foreach ($clients as $client)
                                        @php
                                            Clients::setEmailAttribute($client, $client->user_id);
                                        @endphp
                                        <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPetName">Pet/s</label>
                                <select class="select-pet-name form-control" id="inputPetName" name="pet_ID[]" multiple="multiple" data-placeholder="Select a Pet" required autocomplete="off">
                                    @foreach ($pets as $pet)
                                        <option value="{{ $pet->id }}" id="{{ $pet->owner_ID }}" class="pets">{{ $pet->pet_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputReasonOfVisit">Reason of Visit</label>
                                <select class="select-reason-of-visit form-control" id="reasonOfVisit" name="reasonOfVisit[]" multiple="multiple" data-placeholder="Select a Reason of Visit" required autocomplete="off">
                                    <option value="#">Check-Up</option>
                                    <option value="#">Vaccination</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputPurpose">Other Notes</label>
                                <textarea class="form-control" name="purpose" id="inputPurpose" rows="4"></textarea>
                            </div>
                            <hr class="mb-0">
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputEmailAddress">Attending Veterinarian</label>
                                <select class="select-attending-vet form-control" id="vetSelect" name="doctor_ID" data-placeholder="Select a Veterinarian">
                                    <option value=""></option>
                                    @foreach ($vets as $vet)
                                        <option class="form-control" value={{ $vet->id }}>Dr.
                                            {{ $vet->firstname . ' ' . $vet->lastname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputAppointmentDate">Appointment Date</label>
                                <div class="input-group input-group-joined">
                                    <input class="form-control" id="select-schedule" type="text" name="appointment_date"
                                           min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="Select a Date" />
                                    <span class="input-group-text">
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputAppointmentTime">Appointment Time</label>
                                {{--                            <input class="form-control" id="inputEmailAddress" type="time" name="appointment_time" /> --}}
                                <select class="select-appointment-time-admin form-control" id="selectAppointmentTime"
                                        name="appointment_time" data-placeholder="Select Time" required>
                                    <option value=""></option>
                                    <optgroup label="--- Select a Time ---"></optgroup>
                                    <optgroup label="AM">
                                        <option value="8:00 AM">8:00 AM</option>
                                        <option value="8:30 AM">8:30 AM</option>
                                        <option value="9:00 AM">9:00 AM</option>
                                        <option value="9:30 AM">9:30 AM</option>
                                        <option value="10:00 AM">10:00 AM</option>
                                        <option value="10:30 AM">10:30 AM</option>
                                        <option value="11:00 AM">11:00 AM</option>
                                        <option value="11:30 AM">11:30 AM</option>
                                    </optgroup>
                                    <optgroup label="PM">
                                        <option value="1:00 PM">1:00 PM</option>
                                        <option value="1:30 PM">1:30 PM</option>
                                        <option value="2:00 PM">2:00 PM</option>
                                        <option value="2:30 PM">2:30 PM</option>
                                        <option value="3:00 PM">3:00 PM</option>
                                        <option value="3:30 PM">3:30 PM</option>
                                        <option value="4:00 PM">4:00 PM</option>
                                        <option value="4:30 PM">4:30 PM</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light text-primary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Schedule Appointment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Main page content-->
    <div class=" container-xl px-4 mt-4">
        <div class="row">
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-white border-start-lg border-start-primary shadow-none text-dark h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-primary">Today's Appointments</div>
                                @php
                                    $todayCount = \App\Models\Appointments::where('status', 0)
                                        ->whereDate('appointment_date', \Carbon\Carbon::today()->format('Y-m-d'))
                                        ->count();
                                @endphp
                                <div class="text-lg fw-bold">{{ $todayCount }}</div>
                            </div>
                            <i class="fa-regular fa-calendar text-gray-400 fa-2x"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-primary stretched-link" href="/todayappointments">View Today's Appointments</a>
                        <div class=""><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-white border-start-lg border-start-success shadow-none text-dark h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                @php
                                    $finishedCount = \App\Models\Appointments::where('status', 1)
                                    ->whereDate('appointment_date', \Carbon\Carbon::today()->format('Y-m-d'))
                                        ->count();
                                @endphp
                                <div class="text-success">Finished Appointments</div>
                                <div class="text-lg fw-bold">{{ $finishedCount }}</div>
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
                <div class="card bg-white border-start-lg border-start-warning shadow-none text-dark h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                @php
                                    $requestCount = \App\Models\Appointments::where('status', null)->count();
                                @endphp
                                <div class="text-warning">Appointment Requests</div>
                                <div class="text-lg fw-bold">{{ $requestCount }}</div>
                            </div>
                            <i class="feather-xl text-gray-400" data-feather="message-circle"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-warning stretched-link" href="/pendingappointments">View Requests</a>
                        <div class=""><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-white border-start-lg border-start-danger shadow-none text-dark h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                @php
                                    $cancelledCount = \App\Models\Appointments::where('status', 2)->count();
                                @endphp
                                <div class="text-danger">Cancelled Appointments</div>
                                <div class="text-lg fw-bold">{{ $cancelledCount }}</div>
                            </div>
                            <i class="fa-solid fa-xmark text-gray-400 fa-2x"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-danger stretched-link" href="/cancelledappointments">View Cancelled
                            Appointments</a>
                        <div class=""><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-none">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Scheduled
                    Appointments</span></div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Pet Owner</th>
                            <th>Pet/s</th>
                            <th>Veterinarian</th>
                            <th>Reason of Visit</th>
                            <th>Status</th>
                            <th>Priority Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                            @if ($appointment->status === 0)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }} |
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                    </td>
                                    <td>{{ $appointment->client->client_name }}</td>
                                    <td>
                                        @php
                                            $pet_ids = explode(',', $appointment->pet_ID);
                                            $pets = \App\Models\Pets::whereIn('id', $pet_ids)->get();
                                        @endphp
                                        @foreach ($pets as $pet)
                                            <span class="badge bg-primary-soft text-primary text-xs rounded-pill">
                                            {{ $pet->pet_name }} <span class="badge bg-white text-primary text-xs rounded-pill ms-1">{{ $pet->pet_type }}</span></span>
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>Dr.
                                        {{ $vets->firstWhere('id', $appointment->doctor_ID)->lastname ?? 'No Vet Found' }}
                                    </td>
                                    <td>{{ \Illuminate\Support\Str::limit($appointment->purpose, 30, '...') }}</td>
                                    <td>
                                        @if (is_null($appointment->status) == true)
                                            <div class="badge bg-warning-soft text-warning text-xs rounded-pill">
                                                Pending
                                            </div>
                                        @elseif ($appointment->status == 0)
                                            <div class="badge bg-secondary-soft text-secondary text-xs rounded-pill">
                                                Scheduled
                                            </div>
                                        @elseif ($appointment->status == 2)
                                            <div class="badge bg-danger-soft text-danger text-xs rounded-pill">
                                                Canceled
                                            </div>
                                        @elseif ($appointment->status == 1)
                                            <div class="badge bg-success-soft text-success text-xs rounded-pill">
                                                Finished
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $appointment->priority_number }}
                                    </td>
                                    <td>
                                        <a class="btn btn-datatable btn-primary px-5 py-3"
                                            href="{{ route('appointments.view', ['id' => $appointment->id]) }}">View</a>
                                    </td>

                                </tr>
                                {{-- @else --}}
                                {{-- @continue --}}
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $('#select-schedule').on('change', function() {
            let selectedDate = $(this).val();
            if (selectedDate) {
                $.ajax({
                    url: '{{ route('appointments.available-times') }}', // Define the route in Laravel
                    type: 'GET',
                    data: {
                        date: selectedDate
                    },
                    success: function(response) {
                        console.log(response);
                        let timeSelect = $('#selectAppointmentTime');
                        timeSelect.empty(); // Clear existing options
                        timeSelect.append(
                            '<option value="">--- Select a Time ---</option>');

                        if (response.length > 0) {
                            let amGroup = $('<optgroup label="AM"></optgroup>');
                            let pmGroup = $('<optgroup label="PM"></optgroup>');

                            response.forEach(function(time) {
                                let option =
                                    `<option value="${time}">${time}</option>`;
                                let hour = parseInt(time.split(':')[0]);
                                if (hour < 12) {
                                    amGroup.append(option);
                                } else {
                                    pmGroup.append(option);
                                }
                            });

                            timeSelect.append(amGroup);
                            timeSelect.append(pmGroup);
                        } else {
                            timeSelect.append(
                                '<option value="">No available times</option>');
                        }
                    },
                    error: function(error) {
                        console.log("Error fetching available times:", error);
                    }
                });
            }
        });
    });
</script>


@endsection
