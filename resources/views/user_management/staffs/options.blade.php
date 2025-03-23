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


    <!-- UM Modals -->
    @php
        $staff->getEmailAttribute($staff->user_id);
    @endphp
    <div class="modal fade" id="umEditAccount" tabindex="-1" role="dialog" aria-labelledby="umEditAccount"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form action="{{ route('staffs.update', ['staffID' => $staff->id]) }}" method="POST">
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
                                <input type="text" class="form-control" name="firstname" id=""
                                    value="{{ $staff->firstname }}">
                            </div>
                            <div class=" col-md-6">
                                <label class="small mb-1" for="editLastName">Last Name</label>
                                <input type="text" class="form-control" name="lastname" id=""
                                    value="{{ $staff->lastname }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editPosition">Position</label>
                                <select class="form-control" id="exampleFormControlSelect2" name="position">
                                    {{-- <option value="Owner" {{ $staff->position == 'Owner' ? 'selected' : '' }}>Pet Owner</option> --}}
                                    {{-- <option value="Doctor" {{ $staff->position == 'Doctor' ? 'selected' : '' }}>Veterinarian</option> --}}
                                    {{-- <option value="Owner" {{ $staff->position == 'Owner' ? 'selected' : '' }}>Owner</option> --}}
                                    {{-- <option value="Administrator" {{ $staff->position == 'Administrator' ? 'selected' : '' }}>Administrator</option> --}}
                                    <option value="secretary" {{ $staff->position == 'secretary' ? 'selected' : '' }}>
                                        Secretary</option>
                                    <option value="cashier" {{ $staff->position == 'cashier' ? 'selected' : '' }}>Cashier
                                    </option>
                                    <option value="staff" {{ $staff->position == 'staff' ? 'selected' : '' }}>Staff
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editBirthday">Birthday</label>
                                <input type="date" class="form-control" name="editBirthday" id="birthday"
                                    value="{{ $staff->birthday }}" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="editAddress">Address</label>
                                <input type="text" class="form-control" name="address" id=""
                                    value="{{ $staff->address }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editEmailAddress">Email address</label>
                                <input type="text" class="form-control" name="staff_email" id=""
                                    value="{{ $staff->staff_email }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editPhone">Phone number</label>
                                <input type="text" class="form-control" name="phone_number" id=""
                                    value="{{ $staff->phone_number }}">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-dark" type="button"
                            data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary" type="submit">Update
                            Account</button></div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="umResetPasswordModal" tabindex="-1" role="dialog"
        aria-labelledby="umResetPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('staffs.resetpassword', ['staffID' => $staff->id] ) }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="umResetPasswordModalLabel">Reset Admin Password</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- <div class="mb-3">
                        <label for="ownerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="ownerEmail" placeholder="Enter email" required>
                    </div> --}}
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword"
                                placeholder="Enter new password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword"
                                placeholder="Confirm new password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Reset Password</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="disableAccountModal" tabindex="-1" role="dialog"
        aria-labelledby="disableAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form action="{{ route('staffs.switchstatus', ['staffID' => $staff->id]) }}" method="POST">
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

<div class="modal fade" id="enableAccountModal" tabindex="-1" role="dialog" aria-labelledby="enableAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('staffs.switchstatus', ['staffID' => $staff->id]) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enableAccountModalLabel">Enable Account</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to enable this account?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit">Enable Account</button>
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
                        <li class="breadcrumb-item"><a href="/um/staff">Manage Staff</a></li>
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
            <a class="nav-link " href="{{ route('staffs.profile', ['id' => $staff->id]) }}">Profile</a>
            <a class="nav-link ms-0 active" href="{{ route('staffs.options', ['id' => $staff->id]) }}">Options</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-none mb-4">
                    <div class="card-header">Role</div>
                    <div class="card-body">
                        <select class="form-control" id="exampleFormControlSelect2" name="role" disabled>
                            {{-- <option value="Owner" {{ $staff->position == 'Owner' ? 'selected' : '' }}>Pet Owner</option>
                        <option value="Doctor" {{ $staff->position == 'Doctor' ? 'selected' : '' }}>Veterinarian</option> --}}
                            {{-- <option value="Owner" {{ $staff->position == 'Owner' ? 'selected' : '' }}>Owner</option> --}}
                            {{-- <option value="Administrator" {{ $staff->position == 'Administrator' ? 'selected' : '' }}>Administrator</option> --}}
                            <option value="secretary" {{ $staff->position == 'secretary' ? 'selected' : '' }}>Secretary
                            </option>
                            <option value="cashier" {{ $staff->position == 'cashier' ? 'selected' : '' }}>Cashier</option>
                            <option value="staff" {{ $staff->position == 'staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-none mb-4">
                    <div class="card-header">Account</div>
                    <div class="card-body">
                        <div class="row gy-2 gx-2">
                            <div class="col-md-12"><button class="btn btn-primary w-100" type="button"
                                    data-bs-toggle="modal" data-bs-target="#umEditAccount">Edit Account</button></div>
                            <div class="col-md-6"><button class="btn btn-primary w-100" type="button"
                                    data-bs-toggle="modal" data-bs-target="#umResetPasswordModal">Reset Password</button>
                            </div>
                            <div class="col-md-6"><button class="btn btn-primary w-100" type="button"
                                    @if ($staff->status == 0)
                                        data-bs-toggle="modal" data-bs-target="#enableAccountModal">Enable Account</button>
                                    @else
                                        data-bs-toggle="modal" data-bs-target="#disableAccountModal">Disable Account</button>
                                    @endif
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
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
