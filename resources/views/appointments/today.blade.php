@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    @include('appointments.components.header', [
        'title' => 'Appointments',
        'icon' => '<i class="fa-regular fa-calendar"></i>',
        'appointments' => $appointments ?? collect(), // Fallback to empty collection if undefined
    ])

    <div class=" container-xl px-4 mt-4">
        <nav class="nav nav-borders">
            <a class="nav-link ms-0" href="{{ route('appointments.index') }}"><span class="px-2"><i
                        class="fa-solid fa-arrow-left"></i></span> Back</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="card shadow-none">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Today's
                    Appointments</span>
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
                            <th>Priority Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                            @if ($appointment->status == 0 && \Carbon\Carbon::parse($appointment->appointment_date)->isToday())
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }} |
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                    </td>
                                    <td>{{ $appointment->client->client_name }}</td>
                                    <td>
                                        @php
                                            $petIDs = explode(',', $appointment->pet_ID);
                                            $pets = [];
                                            foreach ($petIDs as $petID) {
                                                $pet = \App\Models\Pets::find($petID);
                                                if ($pet) {
                                                    $pets[] = $pet->pet_name . ' | ' . $pet->pet_type;
                                                }
                                            }
                                        @endphp
                                        @foreach ($pets as $pet)
                                            <span class="badge bg-primary-soft text-primary text-xs rounded-pill">
                                                {{ $pet }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>Dr.
                                        {{ $vets->firstWhere('id', $appointment->doctor_ID)->lastname ?? 'No Vet Found' }}
                                    </td>
                                    <td>{{ $appointment->purpose }}</td>
                                    <td>
                                        <div class="badge bg-primary-soft text-primary rounded-pill">Scheduled</div>
                                    </td>
                                    <td>
                                        {{ $appointment->priority_number }}
                                    </td>
                                    <td>
                                        <a class="btn btn-datatable btn-primary px-5 py-3"
                                            href="{{ route('appointments.view', ['id' => $appointment->id]) }}">View</a>
                                    </td>
                                </tr>
                            @else
                                @continue
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
