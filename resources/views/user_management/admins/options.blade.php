@extends('layouts.app')

@section('styles')
@endsection

@section('content')

<!-- UM Modals -->
<div class="modal fade" id="umEditAccount" tabindex="-1" role="dialog" aria-labelledby="umEditAccount" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form action="" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="umEditAccount">Edit Account</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class=" col-md-6">
                            <label class="small mb-1" for="editFirstName">First Name</label>
                            <input type="text" class="form-control" name="editFirstName" id="" value="">
                        </div>
                        <div class=" col-md-6">
                            <label class="small mb-1" for="editLastName">Last Name</label>
                            <input type="text" class="form-control" name="editLastName" id="" value="">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editBirthday">Birthday</label>
                            <input type="date" class="form-control" name="editBirthday" id="editBirthday" value="" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editAddress">Address</label>
                            <input type="text" class="form-control" name="editAddress" id="" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editEmailAddress">Email address</label>
                            <input type="text" class="form-control" name="editEmailAddress" id="" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editPhone">Phone number</label>
                            <input type="text" class="form-control" name="editPhone" id="" value="">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editUsername">Username</label>
                            <input type="text" class="form-control" name="editUsername" id="" value="" placeholder="Enter username">
                        </div>
                        <div class="col-md-12 mt-4">
                            <h6 class="text-primary">Change Password</h6>
                            <hr class="mt-1 mb-0">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editOldPassword">Old Password</label>
                            <input type="text" class="form-control" name="username" id="editOldPassword" placeholder="Enter old password" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="updateNewPassword">New Password</label>
                            <input type="text" class="form-control" name="username" id="updateNewPassword" placeholder="Enter new password" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="updateConfirmNewPassword">Confirm New Password</label>
                            <input type="text" class="form-control" name="username" id="updatConfirmeNewPassword" placeholder="Confirm password" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary" type="submit">Update Account</button></div>
            </div>

        </form>

    </div>
</div>

<div class="modal fade" id="umResetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="umResetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="umResetPasswordModalLabel">Reset Admin Password</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="ownerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="ownerEmail" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" placeholder="Enter new password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm new password" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Reset Password</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="disableAccountModal" tabindex="-1" role="dialog" aria-labelledby="disableAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form action="" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="disableAccountModalLabel">Disable Account</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to disable this account?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Disable Account</button>
                </div>
            </div>
        </form>
    </div>
</div>


<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="/um/admin">Manage Administrator</a></li>
                    <li class="breadcrumb-item">Profile</li>
                    <li class="breadcrumb-item active">Options</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-4">

    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link ms-0" href="{{route('admin.profile', ['id'=> $admin->id])}}">Profile</a>
        <a class="nav-link active" href="{{route('admin.profile.options', ['id'=> $admin->id])}}">Options</a>
    </nav>
    <hr class="mt-0 mb-4" />
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-none mb-4">
                <div class="card-header">Role</div>
                <div class="card-body">
                    <select disabled class="form-control" id="exampleFormControlSelect2" name="role">
                        <option value="Doctor">Veterinarian</option>
                        <option value="Owner">Owner</option>
                        <option value="Administrator" selected>Administrator</option>
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
                        <div class="col-md-12"><button class="btn btn-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#umEditAccount">Edit Account</button></div>
                        <div class="col-md-6"><button class="btn btn-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#umResetPasswordModal">Reset Password</button></div>
                        <div class="col-md-6"><button class="btn btn-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#disableAccountModal">Disable Account</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row">--}}
    {{-- <div class="col-lg-12">--}}
    {{-- <div class="card mb-4">--}}
    {{-- <div class="card-header">Permissions</div>--}}
    {{-- <div class="card-body">--}}
    {{-- <p class="text-muted">Select the permissions for the user:</p>--}}
    {{-- <div class="row gx-3">--}}
    {{-- <!-- Column 1 -->--}}
    {{-- <div class="col-md-6">--}}
    {{-- <div class="form-check mb-2">--}}
    {{-- <input class="form-check-input" type="checkbox" id="manageAppointments" name="permissions[]" value="manage_appointments">--}}
    {{-- <label class="form-check-label" for="manageAppointments">--}}
    {{-- Manage Appointments--}}
    {{-- </label>--}}
    {{-- </div>--}}
    {{-- <div class="form-check mb-2">--}}
    {{-- <input class="form-check-input" type="checkbox" id="manageDoctors" name="permissions[]" value="manage_doctors">--}}
    {{-- <label class="form-check-label" for="manageDoctors">--}}
    {{-- Manage Doctors--}}
    {{-- </label>--}}
    {{-- </div>--}}
    {{-- <div class="form-check mb-2">--}}
    {{-- <input class="form-check-input" type="checkbox" id="accessPOS" name="permissions[]" value="access_pos">--}}
    {{-- <label class="form-check-label" for="accessPOS">--}}
    {{-- Access POS--}}
    {{-- </label>--}}
    {{-- </div>--}}
    {{-- <div class="form-check mb-2">--}}
    {{-- <input class="form-check-input" type="checkbox" id="viewReports" name="permissions[]" value="view_reports">--}}
    {{-- <label class="form-check-label" for="viewReports">--}}
    {{-- View Reports--}}
    {{-- </label>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- <!-- Column 2 -->--}}
    {{-- <div class="col-md-6">--}}
    {{-- <div class="form-check mb-2">--}}
    {{-- <input class="form-check-input" type="checkbox" id="editUsers" name="permissions[]" value="edit_users">--}}
    {{-- <label class="form-check-label" for="editUsers">--}}
    {{-- Edit Users--}}
    {{-- </label>--}}
    {{-- </div>--}}
    {{-- <div class="form-check mb-2">--}}
    {{-- <input class="form-check-input" type="checkbox" id="manageInventory" name="permissions[]" value="manage_inventory">--}}
    {{-- <label class="form-check-label" for="manageInventory">--}}
    {{-- Manage Inventory--}}
    {{-- </label>--}}
    {{-- </div>--}}
    {{-- <div class="form-check mb-2">--}}
    {{-- <input class="form-check-input" type="checkbox" id="configureSettings" name="permissions[]" value="configure_settings">--}}
    {{-- <label class="form-check-label" for="configureSettings">--}}
    {{-- Configure Settings--}}
    {{-- </label>--}}
    {{-- </div>--}}
    {{-- <div class="form-check mb-2">--}}
    {{-- <input class="form-check-input" type="checkbox" id="viewAuditLogs" name="permissions[]" value="view_audit_logs">--}}
    {{-- <label class="form-check-label" for="viewAuditLogs">--}}
    {{-- View Audit Logs--}}
    {{-- </label>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- <div class="card-footer">--}}
    {{-- <button type="submit" class="btn btn-primary">Save Changes</button>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- </div>--}}

    {{-- </div>--}}
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the register button
        var registerButton = document.getElementById('regbtn');

        // Add event listener to the register button
        registerButton.addEventListener('click', function() {
            // Show the success alert
            var successAlert = document.getElementById('successAlert');
            successAlert.style.display = 'flex';

            setTimeout(function() {
                window.location.href = '/managedoctor';
            }, 4000);

            // Optionally, hide the alert after a certain period (e.g., 3 seconds)
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 3000);
        });
    });
</script>
@endsection

@section('scripts')
@endsection