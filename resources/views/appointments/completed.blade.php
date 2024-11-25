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
        <a class="nav-link ms-0" href="{{route('appointments.index')}}"><span class="px-2"><i class="fa-solid fa-arrow-left"></i></span> Back</a>
    </nav>
    <hr class="mt-0 mb-4">
    <div class="card shadow-none">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Finished Appointments</span>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Appointment ID</th>
                        <th>Pet Owner</th>
                        <th>Pet</th>
                        <th>Pet Type</th>
                        <th>Veterinarian</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                    @if ( $appointment->status == 1 && \Carbon\Carbon::parse($appointment->updated_at)->isToday() )
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }} |
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                        </td>
                        <td>{{ sprintf("VETIS-%05d", $appointment->id) }}</td>
                        <td>{{$appointment->client->client_name}}</td>
                        <td>{{$appointment->pet->pet_name}}</td>
                        <td>{{$appointment->pet->pet_type}}</td>
                        <td>The Veterinarian</td>
                        <td>The Purpose</td>
                        <td>
                            <div class="badge bg-success-soft text-success rounded-pill">Finished</div>
                        </td>
                        <td>
                            <a class="btn btn-outline-primary" href="{{route('appointments.view',['id'=>$appointment->id])}}">Open</a>
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