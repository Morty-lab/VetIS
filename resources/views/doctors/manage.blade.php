@extends('layouts.app')

@section('styles')

@endsection

@section('content')
@include('components.header', ['title' => 'Veterinarians'], ['icon' => '<i class="fa-solid fa-user-doctor"></i>'])

<!-- Main page content-->
<div class="container-xl px-4 mt-4">
  <div class="card shadow-none">
    <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Veterinarian List</span>
      <a class="btn btn-primary justify-end" href="/adddoctor">Add Veterinarian</a>
    </div>
    <div class="card-body">
      <table id="datatablesSimple">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Position</th>
            <th>Schedules</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($doctors as $doctor)
          @php
          \App\Models\Doctor::setEmailAttribute($doctor,$doctor->user_id);
          @endphp
          <tr>
            <td>{{ $doctor->firstname ." " . $doctor->lastname }}</td>
            <td>{{ $doctor->doctor_email }} </td>
            <td>{{ $doctor->phone_number }}</td>
            <td>{{ $doctor->position }}</td>
            <td>
              <span class="badge bg-secondary-soft text-secondary rounded-pill"><span class="fw-bold">{{\App\Models\Doctor::getSchedules($doctor->id)->count()}}</span> Scheduled</span>
            </td>
            <td>
              <span class="badge {{$doctor->status ? 'bg-primary-soft text-primary' : 'bg-orange-soft text-orange'}}  rounded-pill">{{$doctor->status ? 'Active' : 'Disabled'}}</span>
            </td>
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
