@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
  <div class="container-xl px-4">
    <div class="page-header-content pt-4">
      <div class="row align-items-center justify-content-between">
        <div class="col-auto mt-4">
          <h1 class="page-header-title">
            <div class="page-header-icon">
              <i class="fa-solid fa-user-doctor p-1"></i>
            </div>
            Manage Doctors
          </h1>
          <div class="page-header-subtitle">
            Add and Edit Veterinary Doctors
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-n10">
  <div class="card">
    <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Doctors List</span>
      <a class="btn btn-primary justify-end" href="/adddoctor">Add Doctor</a>
    </div>
    <div class="card-body">
      <table id="datatablesSimple">
        <thead>
          <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Position</th>
            <th>Start date</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
          <tr>
            <td>{{ $doctor->firstname }} {{ $doctor->lastname }}</td>
            <td>{{ $doctor->age }}</td>
            <td>{{ $doctor->position }}</td>
            <td>{{ $doctor->created_at->format('Y-m-d') }}</td>
            <td>
              <div class="badge bg-primary text-white rounded-pill">Full-time</div>
            </td>
            <td>
              <a class="btn btn-primary" href="{{route('doctor.profile', $doctor->user_id)}}">Open</a>
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
