@extends('portal.layouts.app')
@section('outerContent')
    <div class="modal fade" id="editAppointmentRequestModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('portal.appointments.update', ['appointmentID' => $appointment->id]) }}"
                    method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="appointmentRequestTitle">Edit Request Appointment</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gy-3 gx-4">
                            <div class="col-md-6">
                                <!-- Select Schedule -->
                                <label for="select-schedule" class="mb-1">Select Date</label>
                                <div class="input-group input-group-joined">
                                    <input type="text" class="form-control" id="select-schedule" name="appointment_date"
                                        placeholder="YYYY-MM-DD" value="{{ $appointment->appointment_date }}">
                                    <span class="input-group-text">
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Select Schedule -->
                                <div class="form-group">
                                    <label class="small mb-1">Appointment Time</label>
                                    @php
                                        $selectedTime = \Carbon\Carbon::parse($appointment->appointment_time)->format(
                                            'g:i A',
                                        );
                                    @endphp
                                    <select class="sedit-select-time form-control" id="selectAppointmentTime"
                                        name="appointment_time" data-placeholder="Select Time" required disabled>
                                        <option value=""></option>
                                        <optgroup label="AM">
                                            <option value="8:00 AM" {{ $selectedTime === '8:00 AM' ? 'selected' : '' }}>8:00
                                                AM</option>
                                            <option value="8:30 AM" {{ $selectedTime === '8:30 AM' ? 'selected' : '' }}>8:30
                                                AM</option>
                                            <option value="9:00 AM" {{ $selectedTime === '9:00 AM' ? 'selected' : '' }}>9:00
                                                AM</option>
                                            <option value="9:30 AM" {{ $selectedTime === '9:30 AM' ? 'selected' : '' }}>9:30
                                                AM</option>
                                            <option value="10:00 AM" {{ $selectedTime === '10:00 AM' ? 'selected' : '' }}>
                                                10:00 AM</option>
                                            <option value="10:30 AM" {{ $selectedTime === '10:30 AM' ? 'selected' : '' }}>
                                                10:30 AM</option>
                                            <option value="11:00 AM" {{ $selectedTime === '11:00 AM' ? 'selected' : '' }}>
                                                11:00 AM</option>
                                            <option value="11:30 AM" {{ $selectedTime === '11:30 AM' ? 'selected' : '' }}>
                                                11:30 AM</option>
                                        </optgroup>
                                        <optgroup label="PM">
                                            <option value="1:00 PM" {{ $selectedTime === '1:00 PM' ? 'selected' : '' }}>
                                                1:00 PM</option>
                                            <option value="1:30 PM" {{ $selectedTime === '1:30 PM' ? 'selected' : '' }}>
                                                1:30 PM</option>
                                            <option value="2:00 PM" {{ $selectedTime === '2:00 PM' ? 'selected' : '' }}>
                                                2:00 PM</option>
                                            <option value="2:30 PM" {{ $selectedTime === '2:30 PM' ? 'selected' : '' }}>
                                                2:30 PM</option>
                                            <option value="3:00 PM" {{ $selectedTime === '3:00 PM' ? 'selected' : '' }}>
                                                3:00 PM</option>
                                            <option value="3:30 PM" {{ $selectedTime === '3:30 PM' ? 'selected' : '' }}>
                                                3:30 PM</option>
                                            <option value="4:00 PM" {{ $selectedTime === '4:00 PM' ? 'selected' : '' }}>
                                                4:00 PM</option>
                                            <option value="4:30 PM" {{ $selectedTime === '4:30 PM' ? 'selected' : '' }}>
                                                4:30 PM</option>
                                        </optgroup>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select an appointment time.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Select Pet -->
                                <div class="form-group">
                                    <label for="select-pet" class="mb-1">Pet/s</label>
                                    <select class="select-pet form-control" multiple="multiple" id="select-pet"
                                        name="pet_ID[]" data-placeholder="Select a Pet">
                                        @foreach ($pets as $p)
                                            <option value="{{ $p->id }}"
                                                @if ($p->id == $pet->id) selected @endif>{{ $p->pet_name }}
                                            </option>
                                        @endforeach

                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Select Veterinarian -->
                                <div class="form-group">
                                    <label for="select-veterinarian" class="mb-1">Veterinarian</label>
                                    <select class="select-vet form-control" id="select-veterinarian" name="doctor_ID">
                                        <option value="" disabled selected>Select a Veterinarian</option>
                                        @foreach ($vets as $vet)
                                            <option value="{{ $vet->id }}"
                                                @if ($vet->id == $appointment->doctor_ID) selected @endif>Dr.
                                                {{ $vet->firstname . ' ' . $vet->lastname }}</option>
                                        @endforeach
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="edit-rov" class="mb-1">Reason of Visit</label>
                                    @php
                                        $service_ids = explode(',', $appointment->purpose);
                                    @endphp
                                    <select class="edit-rov form-control" id="select-appointment-reason"
                                        name="reasonOfVisit[]" data-placeholder="Select Reason of Visit" multiple="multiple"
                                        required autocomplete="off">
                                        <option value=""></option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}"
                                                {{ in_array($service->id, $service_ids) ? 'selected' : '' }}>
                                                {{ $service->service_name }} (starts at
                                                ₱{{ number_format($service->service_price, 2) }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select at least one reason.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <!-- Concern/Complain -->
                                <div class="form-group">
                                    <label for="concern-complain" class="mb-1">Other Notes</label>
                                    <textarea class="form-control" id="concern-complain" name="remarks" rows="5"
                                        placeholder="Enter the purpose of your appointment"> {{ $appointment->remarks }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Edit Appointment Request</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Cancel Appointment Request Modal -->
    <div class="modal fade" id="cancelRequestModal" tabindex="-1" aria-labelledby="cancelRequestLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content py-3">
                <div class="modal-header border-0 text-center d-block">
                    <i class="fa-solid fa-triangle-exclamation text-warning display-4"></i>
                    <h5 class="modal-title mt-2" id="cancelRequestLabel">Cancel Appointment Request</h5>
                </div>
                <div class="modal-body text-center">
                    Are you sure you want to <strong>Cancel</strong> this appointment request? This action cannot be undone.
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <form action="{{ route('portal.appointments.cancel', ['appid' => $appointment->id]) }}"
                        method="POST">
                        @csrf
                        <button type="button" class="btn btn-light text-dark" data-bs-dismiss="modal">No, Keep
                            It</button>
                        <button type="submit" class="btn btn-warning">Yes, Cancel Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('portal.appointments') }}">Appointments</a></li>
                        <li class="breadcrumb-item active">Appointment Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 order-2 order-md-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-none border mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Appointment Details</span>
                            <div class="dropdown">
                                <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg class="svg-inline--fa fa-ellipsis-vertical" aria-hidden="true" focusable="false"
                                        data-prefix="fas" data-icon="ellipsis-vertical" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M64 360C94.93 360 120 385.1 120 416C120 446.9 94.93 472 64 472C33.07 472 8 446.9 8 416C8 385.1 33.07 360 64 360zM64 200C94.93 200 120 225.1 120 256C120 286.9 94.93 312 64 312C33.07 312 8 286.9 8 256C8 225.1 33.07 200 64 200zM64 152C33.07 152 8 126.9 8 96C8 65.07 33.07 40 64 40C94.93 40 120 65.07 120 96C120 126.9 94.93 152 64 152z">
                                        </path>
                                    </svg><!-- <i class="fa fa-ellipsis-v"></i> Font Awesome fontawesome.com -->
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    @if ($appointment->status === null)
                                        <li><a class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#editAppointmentRequestModal">Edit Request</a></li>
                                        <li>
                                            <a class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#cancelRequestModal">Cancel Request</a>
                                        </li>
                                        </li>
                                    @endif

                                    <li><a class=" dropdown-item" href="">Print</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Appointment Status</label><br>
                                    <span
                                        class="mb-3 badge
                                    @if (is_null($appointment->status)) bg-warning-soft text-warning
                                    @elseif($appointment->status === 0) bg-primary-soft text-primary
                                    @elseif($appointment->status === 1) bg-success-soft text-success
                                    @elseif($appointment->status === 2) bg-danger-soft text-danger @endif
                                    text-sm rounded-pill">
                                        @if (is_null($appointment->status))
                                            Pending
                                        @elseif($appointment->status === 0)
                                            Scheduled
                                        @elseif($appointment->status === 1)
                                            Completed
                                        @elseif($appointment->status === 2)
                                            Cancelled
                                        @endif
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Appointment ID</label>
                                    <p>{{ sprintf('VetIS-%05d', $appointment->id) }}</p>
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1">Appointment Date</label>
                                    <p class="text-primary">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }}</p>
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1">Appointment Time</label>
                                    <p class="text-primary">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Attending Veterinarian</label>
                                    <p class="text-primary fw-bold">
                                        @php
                                            $vet = $vets->firstWhere('id', $appointment->doctor_ID);
                                            $vetName = $vet ? $vet->firstname . ' ' . $vet->lastname : 'N/A';
                                        @endphp
                                        Dr. {{ $vetName }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Pet Owner</label><br>
                                    <p class="text-primary fw-bold">{{ $appointment->client->client_name }}</p>
                                </div>
                                <div class="col-md-12">
                                    <label class="small mb-1">Pet/s</label><br>
                                    @php
                                        $pet_ids = explode(',', $appointment->pet_ID);
                                        $pets = \App\Models\Pets::whereIn('id', $pet_ids)->get();
                                    @endphp
                                    @foreach ($pets as $pet)
                                        <span class="badge bg-primary-soft text-primary text-sm rounded-pill">
                                            {{ $pet->pet_name }} <span
                                                class="badge bg-white text-primary text-sm rounded-pill ms-1">{{ $pet->pet_type }}</span></span>
                                        </span>
                                    @endforeach
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="border py-3 px-3 border-top-lg border-top-primary rounded">
                                        <label class="mb-1 text-primary fw-bold b">Reason of Visit</label>
                                        <table class="table table-bordered mt-2 mb-0">
                                            @php
                                                $services = \App\Models\Services::whereIn('id', $service_ids)->get();
                                            @endphp
                                            @foreach ($services as $service)
                                                <tr>
                                                    <td>{{ $service->service_name }}</td>
                                                    <td>{{ number_format($service->service_price, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="border py-3 px-3 border-top-lg border-top-dark rounded">
                                        <label class="mb-1 text-gray-700 fw-bold b">Other Notes</label>
                                        <p class="mb-0 mt-2">
                                            {{ $appointment->remarks }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card shadow-none">
                        <div class="card-header">
                            Pet/s Details
                        </div>
                        <div class="card-body py-0">
                            <table id="petInfoTable">
                                <thead>
                                    <tr>
                                        <th>Pet Name</th>
                                        <th>Pet Type</th>
                                        <th>Pet Breed</th>
                                        <th>Age</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $pet_ids = explode(',', $appointment->pet_ID);
                                        $appointment_pets = \App\Models\Pets::whereIn('id', $pet_ids)->get();
                                    @endphp
                                    @foreach ($appointment_pets as $pet)
                                        <tr data-index="0">
                                            <td>{{ $pet->pet_name }}</td>
                                            <td>{{ $pet->pet_type }}</td>
                                            <td>{{ $pet->pet_breed }}</td>
                                            <td>{{ $pet->age }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 order-1 order-md-2">
            <div class="col-md-12">
                <div class="card shadow-none border mb-4">
                    <div class="card-header">
                        <span>Priority Number</span>
                    </div>
                    <div class="card-body">
                        <div class="col-12 border p-2 text-center rounded bg-light">
                            <h1 class="fw-700 mb-0 text-xl">{{ $appointment->priority_number }}</h1>
                        </div>
                        {{--                        <p class="text-center mt-2 mb-0 text-gray-500 font-italic">You will be given a priority number once your appointment request has been scheduled</p> --}}
                        <p class="text-center mt-2 mb-0 text-gray-500 font-italic">A priority number will be generated once
                            scheduled.</p>
                        {{--                        <p class="text-center mt-2 mb-0 text-gray-500 font-italic">Please present your priority number upon arrival.</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let selectedVet = 0;
        let selectedDate = 0;

        function selectVet(vet) {
            selectedVet = vet
            console.log(selectedVet)
        }

        function selectDate(date) {
            selectedDate = date;
            console.log(selectedDate)
        }

        function sendRequest(selectedDate, selectedVet) {
            $.ajax({
                url: '{{ route('appointments.available-times') }}',
                type: 'GET',
                data: {
                    date: selectedDate,
                    vet: selectedVet
                },
                success: function(response) {
                    console.log(response);
                    let timeSelect = $('#selectAppointmentTime');
                    timeSelect.empty();
                    timeSelect.append('<option value="">--- Select a Time ---</option>');

                    if (response.length > 0) {
                        let amGroup = $('<optgroup label="AM"></optgroup>');
                        let pmGroup = $('<optgroup label="PM"></optgroup>');

                        response.forEach(function(time) {
                            // Convert 24-hour format to 12-hour display format
                            let displayTime = convertTo12HourDisplay(time);
                            let option = `<option value="${time}">${displayTime}</option>`;

                            let hour = parseInt(time.split(':')[0]);
                            if (hour < 12) {
                                amGroup.append(option);
                            } else {
                                pmGroup.append(option);
                            }
                        });

                        timeSelect.append(amGroup);
                        timeSelect.append(pmGroup);
                        timeSelect.prop('disabled', false);

                    } else {
                        timeSelect.append('<option value="">No available times</option>');
                    }
                },
                error: function(error) {
                    console.log("Error fetching available times:", error);
                }
            });
        }

        function convertTo12HourDisplay(time24) {
            const [hours, minutes] = time24.split(':');
            const hour = parseInt(hours);
            const period = hour < 12 ? 'AM' : 'PM';
            const displayHour = hour % 12 || 12;
            return `${displayHour}:${minutes} ${period}`;
        }

        $(document).ready(function() {
            $('#vetSelect').on('change', function() {
                selectVet(this.value);
                console.log(selectedVet);
                if (selectVet) {
                    sendRequest(selectedDate, selectedVet);
                }
            });

            $('#select-schedule').on('change', function() {
                selectDate(this.value);

                if (selectedDate) {
                    sendRequest(selectedDate, selectedVet);
                }
            });

            // Helper function to convert 24-hour time to 12-hour display format

        });
    </script>
    <script>
        // Check if the 'openModal' parameter is present in the URL
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('openModal') && urlParams.get('openModal') === 'true') {
                // Open the modal after the page is loaded
                var modal = new bootstrap.Modal(document.getElementById('appointmentRequestModal'));
                modal.show();
            }
        };
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#select-schedule", {
                dateFormat: "Y-m-d", // Format for the selected date (equivalent to Litepicker's 'YYYY-MM-DD')
                minDate: "today", // Disallow past dates
                maxDate: new Date().fp_incr(60), // Limit to 2 months ahead (60 days)
            });
        });
        flatpickr("#timePicker", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i", // Time format with seconds
            minTime: "08:00",
            maxTime: "17:00",
            minuteIncrement: 5, // Optional: set minute increment
        });
    </script>
    <script>
        let selectedVet = 0;
        let selectedDate = 0;

        function selectVet(vet) {
            selectedVet = vet
            console.log(selectedVet)
        }

        function selectDate(date) {
            selectedDate = date;
            console.log(selectedDate)
        }

        function sendRequest(selectedDate, selectedVet) {
            $.ajax({
                url: '{{ route('appointments.available-times') }}',
                type: 'GET',
                data: {
                    date: selectedDate,
                    vet: selectedVet
                },
                success: function(response) {
                    console.log(response);
                    let timeSelect = $('#selectAppointmentTime');
                    timeSelect.empty();
                    timeSelect.append('<option value="">--- Select a Time ---</option>');

                    if (response.length > 0) {
                        let amGroup = $('<optgroup label="AM"></optgroup>');
                        let pmGroup = $('<optgroup label="PM"></optgroup>');

                        response.forEach(function(time) {
                            // Convert 24-hour format to 12-hour display format
                            let displayTime = convertTo12HourDisplay(time);
                            let option = `<option value="${time}">${displayTime}</option>`;

                            let hour = parseInt(time.split(':')[0]);
                            if (hour < 12) {
                                amGroup.append(option);
                            } else {
                                pmGroup.append(option);
                            }
                        });

                        timeSelect.append(amGroup);
                        timeSelect.append(pmGroup);
                        timeSelect.prop('disabled', false)
                    } else {
                        timeSelect.append('<option value="">No available times</option>');
                    }
                },
                error: function(error) {
                    console.log("Error fetching available times:", error);
                }
            });
        }

        function convertTo12HourDisplay(time24) {
            const [hours, minutes] = time24.split(':');
            const hour = parseInt(hours);
            const period = hour < 12 ? 'AM' : 'PM';
            const displayHour = hour % 12 || 12;
            return `${displayHour}:${minutes} ${period}`;
        }

        $(document).ready(function() {
            $('#vetSelect').on('change', function() {
                selectVet(this.value);
                console.log(selectedVet);
                if (selectVet) {
                    sendRequest(selectedDate, selectedVet);
                }
            });

            $('#select-schedule').on('change', function() {
                selectDate(this.value);

                if (selectedDate) {
                    sendRequest(selectedDate, selectedVet);
                }
            });

            // Helper function to convert 24-hour time to 12-hour display format

        });
    </script>
@endsection
