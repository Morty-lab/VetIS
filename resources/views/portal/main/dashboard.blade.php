@extends('portal.layouts.app')

@section('content')
<div class="card card-waves shadow-none border mb-4 mt-5">
    <div class="card-body px-5 py-4 pb-xxl-1">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-7">
                @php
                    $client = \App\Models\Clients::getClientByUserID(\Illuminate\Support\Facades\Auth::user()->id)
                @endphp
                <h1 class="text-primary text-xl">Hello, {{$client->client_name}}</h1>
                <p class="text-gray-700">Welcome to <b class="text-primary">PetHub Portal</b> - Your gateway to managing pet care effortlessly. Explore personalized features like managing your pets' profiles, scheduling veterinary appointments, and staying on top of their wellness—all in one convenient platform!</p>
                <div class="d-flex">
                    <a href="{{route('portal.mypets')}}" class="btn btn-primary me-2">My Pets <i class="ms-1" data-feather="arrow-right"></i></a>
                    <a href="{{route('portal.appointments')}}" class="btn btn-outline-primary">Appointment <i class="ms-1" data-feather="arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-5 d-none d-lg-flex justify-content-center mt-xxl-n5"><img class="img-fluid px-xl-4 w-100" src="{{ asset('assets/img/illustrations/veterinary.svg')}}" /></div>
        </div>
    </div>
</div>
<div class="card shadow-none border mb-4">
    <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Scheduled Appointments</span>
        <div class="">
            <a href="{{ route('portal.appointments') }}?openModal=true" class="btn btn-primary">
                Request Appointment
            </a>
        </div>
    </div>
    <div class="card-body">
        <table id="myScheduleTable">
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Date and Time</th>
                    <th>Veterinarian</th>
                    <th>Pet</th>
                    <th>Pet Type</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($appointments->isNotEmpty())
                @foreach ($appointments as $appointment)
                    @if ($appointment->status === 0)
                    <tr>
                        <td>{{ $appointment->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('j F, Y') }} | {{ $appointment->appointment_time }}</td>
                        <td>
                            @php
                                $vet = $vets->firstWhere('id', $appointment->doctor_ID);
                                $vetName = $vet ? $vet->firstname . ' ' . $vet->lastname : 'N/A';
                            @endphp
                            {{ $vetName }}
                        </td>
                        <td>
                            @php
                                $pet = $pets->firstWhere('id', $appointment->pet_ID);
                                $petName = $pet ? $pet->pet_name : 'N/A';
                            @endphp
                            {{ $petName }}
                        </td>
                        <td>
                            {{ $pet ? $pet->pet_type : 'N/A' }}
                        </td>
                        <td>{{ $appointment->purpose }}</td>
                        <td>
                            <span class="badge bg-success-soft text-success text-sm rounded-pill">
                                Scheduled
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('portal.appointments.view', ['appid' => $appointment->id,'petid' => $appointment->pet_ID]) }}" class="btn btn-outline-primary">
                                Open
                            </a>
                        </td>
                    </tr>
                    @endif
                @endforeach

                @endif

            </tbody>
        </table>
    </div>
</div>
@endsection
