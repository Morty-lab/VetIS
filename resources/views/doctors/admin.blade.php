@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div id="successAlert" class="alert alert-primary alert-icon position-fixed bottom-0 end-0 m-3" role="alert"
        style="display: none; z-index: 100;">
        <div class="alert-icon-aside">
            <i class="fa-regular fa-circle-check"></i>
        </div>
        <div class="alert-icon-content">
            <h6 class="alert-heading">Success</h6>
            Doctor Registered Successfully!
        </div>
    </div>

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="/managedoctor">Manage Doctors</a></li>
                        <li class="breadcrumb-item active">Doctor Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>
    <!-- Main page content-->

    <form action="{{ route('doctor.updateAdmin', $doctor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="container-xl px-4 mt-4">

            <!-- Account page navigation-->
            <nav class="nav nav-borders">
                <a class="nav-link ms-0" href="{{ route('doctor.profile', $doctor->id) }}">Profile</a>
                <a class="nav-link" href="{{ route('doctor.security', $doctor->id) }}">Security</a>
                <a class="nav-link active" href="{{ route('doctor.admin', $doctor->id) }}">Admin Settings</a>
            </nav>
            <hr class="mt-0 mb-4" />
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">Role</div>
                        <div class="card-body">
                            <select class="form-control" id="exampleFormControlSelect2" name="role">
                                <option value="Doctor" {{ $doctor->role == 'doctor' ? 'selected' : '' }}>Doctor</option>
                                <option value="Admin/Owner" {{ $doctor->role == 'admin' ? 'selected' : '' }}>Admin/Owner</option>
                                <option value="Secretary" {{ $doctor->role == 'Secretary' ? 'selected' : '' }}>Secretary</option>
                                <option value="Staff" {{ $doctor->role == 'staff' ? 'selected' : '' }}>Staff</option>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">Account</div>
                        <div class="card-body">
                            <button class="btn btn-primary" type="button">Reset Password</button>
                            <button class="btn btn-primary" type="button">Disable Account</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">Permissions</div>
                        <div class="card-body">
                            <p class="text-diabled">This is the permissions card --WIP--</p>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>

    </form>
@endsection

@section('scripts')
@endsection
