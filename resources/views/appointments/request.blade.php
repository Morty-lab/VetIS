@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    @include('appointments.components.header', [
        'title' => 'Appointments',
        'icon' => '<i class="fa-regular fa-calendar"></i>',
        'appointments' => $appointments ?? collect(), // Fallback to empty collection if undefined
    ])

    <!-- Main page content-->
    <div class=" container-xl px-4 mt-4">
        <nav class="nav nav-borders">
            <a class="nav-link ms-0" href="{{ route('appointments.index') }}"><span class="px-2"><i
                        class="fa-solid fa-arrow-left"></i></span> Back</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="card shadow-none">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Appointment
                    Requests</span>
            </div>
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments->sortBy('created_at') as $appointment)
                            @if (auth()->user()->role == 'veterinarian')
                            @php
                                $vetID = App\Models\Doctor::where('user_id', auth()->user()->id)->first()->id;
                            @endphp
                                @if ($appointment->status === null && $appointment->doctor_ID == $vetID)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }} {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                        </td>
                                        <td>{{ $appointment->client->client_name }}</td>
                                        <td>
                                            @php
                                                $pet_ids = explode(',', $appointment->pet_ID);
                                                $pets = \App\Models\Pets::whereIn('id', $pet_ids)->get();
                                            @endphp
                                            @foreach ($pets as $pet)
                                                <span class="badge bg-primary-soft text-primary text-xs rounded-pill">
                                                    {{ $pet->pet_name }} <span
                                                        class="badge bg-white text-primary text-xs rounded-pill ms-1">{{ $pet->pet_type }}</span></span>
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>Dr.
                                            {{ $vets->firstWhere('id', $appointment->doctor_ID)->lastname ?? 'No Vet Found' }}
                                        </td>
                                        <td>
                                            @php
                                                $service_ids = explode(',', $appointment->purpose);
                                                $services = \App\Models\Services::whereIn('id', $service_ids)->pluck('service_name')->toArray();
                                                $service_list = implode(', ', $services);
                                            @endphp
                                            {{ \Illuminate\Support\Str::limit($service_list, 35) }}
                                        </td>
                                        <td>
                                            <div class="badge bg-warning-soft text-warning text-xs rounded-pill">
                                                Pending
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-datatable btn-primary px-5 py-3"
                                                href="{{ route('appointments.view', ['id' => $appointment->id]) }}">View</a>
                                        </td>
                                    </tr>
                                @else
                                    @continue
                                @endif
                            @else
                                @if ($appointment->status === null)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }} {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                        </td>
                                        <td>{{ $appointment->client->client_name }}</td>
                                        <td>
                                            @php
                                                $pet_ids = explode(',', $appointment->pet_ID);
                                                $pets = \App\Models\Pets::whereIn('id', $pet_ids)->get();
                                            @endphp
                                            @foreach ($pets as $pet)
                                                <span class="badge bg-primary-soft text-primary text-xs rounded-pill">
                                                    {{ $pet->pet_name }} <span
                                                        class="badge bg-white text-primary text-xs rounded-pill ms-1">{{ $pet->pet_type }}</span></span>
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>Dr.
                                            {{ $vets->firstWhere('id', $appointment->doctor_ID)->lastname ?? 'No Vet Found' }}
                                        </td>
                                        <td>
                                            @php
                                                $service_ids = explode(',', $appointment->purpose);
                                                $services = \App\Models\Services::whereIn('id', $service_ids)->pluck('service_name')->toArray();
                                                $service_list = implode(', ', $services);
                                            @endphp
                                            {{ \Illuminate\Support\Str::limit($service_list, 35) }}
                                        </td>
                                        <td>
                                            <div class="badge bg-warning-soft text-warning text-xs rounded-pill">
                                                Pending
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-datatable btn-primary px-5 py-3"
                                                href="{{ route('appointments.view', ['id' => $appointment->id]) }}">View</a>
                                        </td>
                                    </tr>
                                @else
                                    @continue
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
