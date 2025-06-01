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
                    <li class="breadcrumb-item"><a href="/managedoctor">Manage Veterinarians</a></li>
                    <li class="breadcrumb-item active">Veterinarian Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- Main page content-->
<!-- 
<form action="{{ route('doctor.updateAdmin', $doctor->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="container-xl px-4 mt-4">
        <nav class="nav nav-borders">
            <a class="nav-link ms-0" href="{{ route('doctor.profile', $doctor->id) }}">Profile</a>
            <a class="nav-link active" href="{{ route('doctor.admin', $doctor->id) }}">UM Settings</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">Role</div>
                    <div class="card-body">
                        <select class="form-control" id="exampleFormControlSelect2" name="role">
                            <option value="Doctor" {{ $doctor->role == 'doctor' ? 'selected' : '' }}>Veterinarian</option>
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
</form> -->
<div class="container-xl px-4 mt-4">
    <nav class="nav nav-borders">
        <a class="nav-link ms-0" href="{{ route('doctor.profile', $doctor->id) }}">Profile</a>
        <a class="nav-link active" href="{{ route('doctor.admin', $doctor->id) }}">UM Settings</a>
    </nav>
    <hr class="mt-0 mb-4" />
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-none mb-4">
                <div class="card-header">Role</div>
                <div class="card-body">
                    <select class="form-control" id="exampleFormControlSelect2" name="role">
                        <option value="Owner">Pet Owner</option>
                        <option value="Doctor" selected>Veterinarian</option>
                        <option value="Owner">Owner</option>
                        <option value="Administrator">Administrator</option>
                        <option value="Secretary">Secretary</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-none mb-4">
                <div class="card-header">Account</div>
                <div class="card-body">
                    <div class="row gy-2 gx-2">
                        <div class="col-md-12"><button class="btn btn-primary w-100" type="button">Edit Account</button></div>
                        <div class="col-md-6"><button class="btn btn-primary w-100" type="button">Reset Password</button></div>
                        <div class="col-md-6"><button class="btn btn-primary w-100" type="button">Disable Account</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-none mb-4">
                <div class="card-header">Permissions</div>
                <div class="card-body">
                    <p class="text-muted">Select the permissions for the user:</p>
                    <div class="row gx-3">
                        <div class="col-md-6">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="manageAppointments" name="permissions[]" value="manage_appointments">
                                <label class="form-check-label" for="manageAppointments">
                                    Manage Appointments
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="manageDoctors" name="permissions[]" value="manage_doctors">
                                <label class="form-check-label" for="manageDoctors">
                                    Manage Doctors
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="accessPOS" name="permissions[]" value="access_pos">
                                <label class="form-check-label" for="accessPOS">
                                    Access POS
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="viewReports" name="permissions[]" value="view_reports">
                                <label class="form-check-label" for="viewReports">
                                    View Reports
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="editUsers" name="permissions[]" value="edit_users">
                                <label class="form-check-label" for="editUsers">
                                    Edit Users
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="manageInventory" name="permissions[]" value="manage_inventory">
                                <label class="form-check-label" for="manageInventory">
                                    Manage Inventory
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="configureSettings" name="permissions[]" value="configure_settings">
                                <label class="form-check-label" for="configureSettings">
                                    Configure Settings
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="viewAuditLogs" name="permissions[]" value="view_audit_logs">
                                <label class="form-check-label" for="viewAuditLogs">
                                    View Audit Logs
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection

@section('scripts')
@endsection