@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    @include('components.header', ['title' => 'Veterinarians'], ['icon' => '<i class="fa-solid fa-user-doctor"></i>'])

    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <nav class="nav nav-borders">
            <a class="nav-link ms-0" href="{{ route('doctor.index')}}">
                <span class="px-2"><i class="fa-solid fa-arrow-left"></i></span> Back
            </a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="card shadow-none">
            <div class="card-header d-flex justify-content-between align-items-center text-red"><span><i class="fa-solid fa-box-archive me-2"></i>Veterinarian Archive</span>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($doctors->where('status', '=', 0)->sortBy(fn($doctor) => $doctor->fullname()) as $doctor)
                        @php
                            \App\Models\Doctor::setEmailAttribute($doctor,$doctor->user_id);
                        @endphp
                        <tr>
                            <td>Dr. {{ $doctor->fullname() }} @if($doctor->status == 0)
                                    <span class="badge bg-dark rounded-pill text-white ms-2">Disabled</span>
                                @endif</td>
                            <td><a class="text-body" href="mailto:{{ $doctor->doctor_email }}">{{ $doctor->doctor_email }}</a></td>
                            <td><a class="text-body" href="tel:{{ $doctor->phone_number }}">{{ $doctor->phone_number }}</a></td>
                            <td>
                                <a class="btn btn-datatable btn-primary px-5 py-3" href="{{route('doctor.profile', $doctor->id)}}">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
