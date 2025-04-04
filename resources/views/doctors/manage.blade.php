@extends('layouts.app')

@section('styles')

@endsection

@section('content')
@include('components.header', ['title' => 'Veterinarians'], ['icon' => '<i class="fa-solid fa-user-doctor"></i>'])

<!-- Main page content-->
<div class="container-xl px-4 mt-4">
  <div class="card shadow-none">
    <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Veterinarian List</span>
      <a class="btn btn-primary justify-end" href="/adddoctor"><i class="fa-solid fa-plus me-2"></i> Add Veterinarian</a>
    </div>
    <div class="card-body">
      <table id="datatablesSimple">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Contact Number</th>
{{--            <th>Position</th>--}}
            <th>Appointment Schedules</th>
{{--            <th>Status</th>--}}
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($doctors as $doctor)
          @php
          \App\Models\Doctor::setEmailAttribute($doctor,$doctor->user_id);
          @endphp
          <tr>
            <td>Dr. {{ $doctor->firstname ." " . $doctor->lastname }}</td>
            <td><a class="text-body" href="mailto:{{ $doctor->doctor_email }}">{{ $doctor->doctor_email }}</a></td>
            <td><a class="text-body" href="tel:{{ $doctor->phone_number }}">{{ $doctor->phone_number }}</a></td>
{{--            <td>{{ $doctor->position }}</td>--}}
              @php
                  $appointmentCount = \App\Models\Doctor::getSchedules($doctor->id)->count();
                  $badgeClass = $appointmentCount === 0 ? 'bg-light text-body' : 'bg-primary-soft text-primary';
                  $badgeText = $appointmentCount === 0 ? 'No Schedules' : $appointmentCount . ' Appointment Scheduled';
              @endphp

              <td>
                <span class="badge badge-sm {{ $badgeClass }} rounded-pill">
                    <span class="">{{ $badgeText }}</span>
                </span>
              </td>
{{--            <td>--}}
{{--              <span class="badge {{$doctor->status ? 'bg-primary-soft text-primary' : 'bg-orange-soft text-orange'}}  rounded-pill">{{$doctor->status ? 'Active' : 'Disabled'}}</span>--}}
{{--            </td>--}}
            <td>
              <a class="btn btn-datatable btn-primary px-5 py-3" href="{{route('doctor.profile', $doctor->id)}}"><i class="fa-solid fa-eye me-2"></i>View</a>
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
