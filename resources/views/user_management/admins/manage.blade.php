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
              <i class="fa-solid fa-user-tie p-1"></i>
            </div>
            Manage Admin
          </h1>
          <div class="page-header-subtitle">
            Add and Edit Admin
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-n10">
  <div class="card shadow-none">
    <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Admin List</span>
      <a class="btn btn-primary justify-end" href="/um/admin/add">Add Admin</a>
    </div>
    <div class="card-body">
      <table id="datatablesSimple">
        <thead>
          <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Position</th>
            <th>Phone Number</th>
            <th>Email Address</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($admins as $admin)
          <tr>
            <td>{{$admin->firstname." ".$admin->lastname}}</td>
            <td>{{$admin->age}}</td>
            <td>Administrator</td>
            <td>{{$admin->phone_number}}</td>
            <td>{{$admin->getEmailAttribute($admin->id)}}</td>
            <td>
              <a class="btn btn-primary" href="{{route('admin.profile', ["id" => $admin->id])}}">Open</a>
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