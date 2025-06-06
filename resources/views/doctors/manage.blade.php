@extends('layouts.app')

@section('styles')

@endsection

@section('content')
@include('components.header', ['title' => 'Veterinarians'], ['icon' => '<i class="fa-solid fa-user-doctor"></i>'])

<!-- Main page content-->
<div class="container-xl px-4 mt-4">
  <div class="card shadow-none">
    <div class="card-header d-flex justify-content-between align-items-center"><span>Veterinarian List</span>
        <div class="d-flex align-items-center">
            <a class="btn btn-primary justify-end" href="/adddoctor"><i class="fa-solid fa-plus me-2"></i> Add Veterinarian</a>
            <div class="dropdown">
                <button class="btn btn-link text-muted p-0 ms-3" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis-vertical"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <div class="dropdown-divider"></div>
                    <div><a class="dropdown-item" href="{{route('doctor.archive')}}"><i class="fa-solid fa-box-archive me-2"></i> Veterinarian Archive</a></div>
                </div>
            </div>
        </div>
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
        @foreach ($doctors->where('status', '!=', 0)->sortBy(fn($doctor) => $doctor->fullname()) as $doctor)
          @php
          \App\Models\Doctor::setEmailAttribute($doctor,$doctor->user_id);
          @endphp
          <tr>
            <td>Dr. {{ $doctor->fullname() }}</td>
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
