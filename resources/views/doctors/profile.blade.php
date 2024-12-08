@php use App\Models\Doctor; @endphp
@extends('layouts.app')

@section('styles')
@endsection

@section('content')

<!-- Modals -->
<!-- Edit Veterinarian Modal -->
<div class="modal fade" id="updateVetInfo" tabindex="-1" role="dialog" aria-labelledby="updateVetInfo" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="updateVetInfoTitle">Update Veterinarian Information</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('doctor.update', $doctor->id) }}" method="POST" id="updateVetForm">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class=" col-md-6">
                            <label class="small mb-1" for="editFirstName">First Name</label>
                            <input type="text" class="form-control" name="firstname" id="editFirstName" placeholder="Enter first name" value="{{ $doctor->firstname }}">
                        </div>
                        <div class=" col-md-6">
                            <label class="small mb-1" for="editLastName">Last Name</label>
                            <input type="text" class="form-control" name="lastname" id="editLastName" placeholder="Enter last name" value="{{ $doctor->lastname }}">
                        </div>
                        <div class=" col-md-6">
                            <label class="small mb-1" for="editPosition">Position</label>
                            <input type="text" class="form-control" name="position" id="editPosition" placeholder="Enter Position" value="{{ $doctor->position }}">
                        </div>
                        <div class=" col-md-6">
                            <label class="small mb-1" for="editDOB">Birthdate</label>
                            <input type="date" class="form-control" name="birthday" id="editBirthdate" placeholder="MM/DD/YYYY" value="{{ $doctor->birthday }}" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editAddress">Address</label>
                            <input type="text" class="form-control" name="address" id="editAddress" placeholder="Enter Address" value="{{ $doctor->address }}">
                        </div>
                        <div class="col-md-6">
                            @php
                            $doctormail = Doctor::setEmailAttribute($doctor, $doctor->user_id)
                            @endphp
                            <label class="small mb-1" for="editEmailAddress">Email address</label>
                            <input type="text" class="form-control" name="email" id="editEmailAddress" placeholder="Enter Email Address" value="{{ $doctor->doctor_email }}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editPhone">Phone number</label>
                            <input type="text" class="form-control" name="phone_number" id="editPhone" placeholder="Enter Phone Number" value="{{ $doctor->phone_number }}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button>
                <!-- Move the submit button inside the form -->
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Update Photo Modal -->
<div class="modal fade" id="updatePhotoModal" tabindex="-1" role="dialog" aria-labelledby="updatePhotoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Update Profile Picture</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row justify-content-center align-items-center" style="height: 100%;">
                    <div class="col-md-6 d-flex flex-column align-items-center text-center border-end p-3 pe-3">
                        <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/illustrations/profiles/profile-1.png') }}" alt="Profile Picture" />
                    </div>
                    <div class="col-md-6 d-flex flex-column align-items-center text-center p-3">
                        <label for="fileInput" class="btn btn-outline-primary mb-2">Select Photo</label>
                        <input type="file" id="fileInput" class="d-none" accept="image/*" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- UM Modals -->
<!-- Edit Veterinarian Modal -->
<div class="modal fade" id="updateVetAccount" tabindex="-1" role="dialog" aria-labelledby="updateVetAccount" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="updateVetInfoTitle">Edit Veterinarian Account</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('doctor.update', $doctor->id) }}" method="POST" id="updateVetForm">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class=" col-md-6">
                            <label class="small mb-1" for="editFirstName">First Name</label>
                            <input type="text" class="form-control" name="firstname" id="editFirstName" placeholder="Enter first name" value="{{ $doctor->firstname }}">
                        </div>
                        <div class=" col-md-6">
                            <label class="small mb-1" for="editLastName">Last Name</label>
                            <input type="text" class="form-control" name="lastname" id="editLastName" placeholder="Enter last name" value="{{ $doctor->lastname }}">
                        </div>
                        <div class=" col-md-6">
                            <label class="small mb-1" for="editPosition">Position</label>
                            <input type="text" class="form-control" name="position" id="editPosition" placeholder="Enter position" value="{{ $doctor->position }}">
                        </div>
                        <div class=" col-md-6">
                            <label class="small mb-1" for="editDOB">Birthdate</label>
                            <input type="date" class="form-control" name="birthday" id="editBirthdate" placeholder="MM/DD/YYYY" value="{{ $doctor->birthday }}" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editAddress">Address</label>
                            <input type="text" class="form-control" name="address" id="editAddress" placeholder="Enter address" value="{{ $doctor->address }}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editEmailAddress">Email address</label>
                            <input type="text" class="form-control" name="email" id="editEmailAddress" placeholder="Enter email address" value="{{ $doctor->doctor_email }}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="editPhone">Phone number</label>
                            <input type="text" class="form-control" name="phone_number" id="editPhone" placeholder="Enter phone number" value="{{ $doctor->phone_number }}">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editLicenseNumber">License No.</label>
                            <input type="text" class="form-control" name="license_number" id="editLicenseNumber" placeholder="Enter license number" value="{{$doctor->license_number}}">
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="editPhone">Username</label>
                            <input type="text" class="form-control" name="username" id="editPhone" placeholder="Enter username" value="">
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
            <div class="modal-footer">
                <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button>
                <!-- Move the submit button inside the form -->
                <button class="btn btn-primary" type="submit">Update Account</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Update Photo Modal -->
<div class="modal fade" id="updatePhotoModal" tabindex="-1" role="dialog" aria-labelledby="updatePhotoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Update Profile Picture</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row justify-content-center align-items-center" style="height: 100%;">
                    <div class="col-md-6 d-flex flex-column align-items-center text-center border-end p-3 pe-3">
                        <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/illustrations/profiles/profile-1.png') }}" alt="Profile Picture" />
                    </div>
                    <div class="col-md-6 d-flex flex-column align-items-center text-center p-3">
                        <label for="fileInput" class="btn btn-outline-primary mb-2">Select Photo</label>
                        <input type="file" id="fileInput" class="d-none" accept="image/*" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- Reset Password -->
<div class="modal fade" id="umResetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="umResetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="umResetPasswordModalLabel">Reset Password</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="ownerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="ownerEmail" placeholder="Enter owner email" required>
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
<!-- Disable Account Modal -->
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
                    <li class="breadcrumb-item"><a href="/managedoctor">Manage Veterinarians</a></li>
                    <li class="breadcrumb-item active">Veterinarian Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
@php
Doctor::setEmailAttribute($doctor,$doctor->user_id);
@endphp

<!-- Main page content-->
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link nav-tab ms-0{{ request()->is('vet-profile') ? 'active' : '' }}" href="#vet-profile">Vet Profile</a>
        <a class="nav-link nav-tab{{ request()->is('schedules') ? 'active' : '' }}" href="#schedules">Schedules</a>
        <a class="nav-link nav-tab{{ request()->is('records') ? 'active' : '' }}" href="#records">Records</a>
        <a class="nav-link nav-tab{{ request()->is('um') ? 'active' : '' }}" href="#um">UM Settings</a>
    </nav>
    <hr class="mt-0 mb-4" />
    <div class="row">
        <div class="col-md-12" id="vetProfileCard" style="display:none;">
            <div class="row">
                <div class="col-xl-8">
                    <div class="card shadow-none mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Veterinarian Profile</span>
                            <div class="dropdown">
                                <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateVetInfo">Update Information</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="small mb-1">Veterinarian Name</label>
                                    <p>{{ $doctor->firstname }} {{ $doctor->lastname }}</p>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1">Veterinarian ID</label>
                                    <div>
                                        <p class="badge bg-primary-soft text-primary rounded-pill">VETID-{{ str_pad($doctor->user_id, 5, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1">License Number</label>
                                    <div>
                                        <p class="badge bg-primary-soft text-primary rounded-pill">{{$doctor->license_number}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Position</label>
                                    <p>{{ $doctor->position }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Birthday</label>
                                    <p>{{ $doctor->birthday }}</p>
                                </div>
                                <div class="col-md-12">
                                    <label class="small mb-1">Address</label>
                                    <p>{{ $doctor->address }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Email Address</label>
                                    <p>
                                        <a href="mailto:{{ $doctor->doctor_email }}" class="text-body">
                                            {{ $doctor->doctor_email }}
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Phone Number</label>
                                    <p>
                                        <a href="tel:{{ $doctor->phone_number }}" class="text-body">
                                            {{ $doctor->phone_number }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card shadow-none mb-4 mb-xl-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Profile Picture</span>
                            <!-- Three-dot (kebab) menu button -->
                            <div class="dropdown">
                                <button class="btn btn-link text-muted p-0" type="button" id="updatePhotoBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="updatePhotoBtn">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updatePhotoModal">Update Photo</a></li>
                                    <!-- You can add more items here -->
                                </ul>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/illustrations/profiles/profile-1.png') }}" alt="" />
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Schedules -->
        <div class="col-md-12" id="schedulesCard" style="display:none;">
            <div class="card shadow-none">
                <div class="card-header">
                    Schedules
                </div>
                <div class="card-body">
                    <table id="petSchedTable">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Appointment ID</th>
                                <th>Pet Owner</th>
                                <th>Pet</th>
                                <th>Pet Type</th>
                                <th>Purpose</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $schedules = Doctor::getSchedules($doctor->id)
                            @endphp
                            @foreach($schedules as $schedule)
                            <tr>
                                <td>
                                    {{ \Carbon\Carbon::parse($schedule->appointment_date)->format('j F, Y') }} |
                                    {{ \Carbon\Carbon::parse($schedule->appointment_time)->format('H:i') }}
                                </td>
                                <td>{{ sprintf("VetIS-%05d", $schedule->id)}}</td>

                                <td>
                                    {{ $clients->firstWhere('id', $schedule->owner_ID)->client_name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $pets->firstWhere('id', $schedule->pet_ID)->pet_name ?? 'N/A' }}
                                </td>
                                <td>
                                    {{ $pets->firstWhere('id', $schedule->pet_ID)->pet_type ?? 'N/A' }}
                                </td>
                                <td>
                                    {{$schedule->purpose}}
                                </td>
                                <td>
                                    <div class="badge bg-secondary-soft text-secondary rounded-pill">Scheduled</div>
                                </td>
                                <td>
                                    <a class="btn btn-datatable btn-primary px-5 py-3" href="{{route('appointments.view',['id'=>$schedule->id])}}">Open</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Records -->
        <div class="col-md-12" id="recordsCard" style="display:none;">
            <div class="card shadow-none">
                <div class="card-header">
                    Records
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>Code</th>
                                <th>Pet</th>
                                <th>Owner</th>
                                <th>Type</th>
                                <th>Subjective</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $consultation_type = [
                            1=> "Walk-In" ,
                            2=> "Consultation" ,
                            3=> "Vaccination",
                            4=> "Surgery"
                            ];
                            @endphp
                            @foreach($records as $record)

                            <tr>
                                <td>{{$record->created_at}}</td>
                                <td>{{ sprintf("VetIS-%05d", $record->id)}}</td>
                                <td>{{\App\Models\Pets::where('id',$record->petID)->first()->pet_name}}</td>
                                <td>{{ \App\Models\Clients::where('id',$record->ownerID)->first()->client_name }}</td>
                                <td>{{$consultation_type[$record->consultation_type] }}</td>
                                <td>{{ $record->complaint }}</td>
                                <td>{{($record->status == 1) ? "Filled" : "Ongoing"}}</td>
                                <td>
                                    <a class="btn btn-datatable btn-primary px-5 py-3" href="{{route('soap.view', ['id' => $record->petID, 'recordID' => $record->id])}}">Open</a>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- UM -->
        <div class="col-md-12" id="umCard" style="display:none;">
            <!-- UM Settings -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none">
                        <div class="card-header">UM Settings</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card shadow-none">
                                        <div class="card-header">Role</div>
                                        <div class="card-body"><select class="form-control" id="exampleFormControlSelect2" name="role">
                                                <option value="Owner">Pet Owner</option>
                                                <option value="Doctor" selected>Veterinarian</option>
                                                <option value="Owner">Owner</option>
                                                <option value="Administrator">Administrator</option>
                                                <option value="Secretary">Secretary</option>
                                                <option value="Staff">Staff</option>
                                            </select>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card shadow-none">
                                        <div class="card-header">Account</div>
                                        <div class="card-body">
                                            <div class="row g-2">
                                                <div class="col-md-12"><button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#updateVetAccount">Edit Account</button></div>
                                                <div class="col-md-6"><button class="btn btn-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#umResetPasswordModal">Reset Password</button></div>
                                                <div class="col-md-6"><button class="btn btn-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#disableAccountModal">Disable Account</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.nav-tab');
        const cards = {
            'vet-profile': document.getElementById('vetProfileCard'),
            'schedules': document.getElementById('schedulesCard'),
            'records': document.getElementById('recordsCard'),
            'um': document.getElementById('umCard')
        };

        // Ensure Pet Profile is active initially
        document.querySelector('.nav-link[href="#vet-profile"]').classList.add('active');
        cards['vet-profile'].style.display = 'block'; // Show Pet Profile Card by default

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                // Hide all cards
                Object.values(cards).forEach(card => card.style.display = 'none');

                // Show the clicked tab's corresponding card
                const targetCard = tab.getAttribute('href').substring(1);
                if (cards[targetCard]) {
                    cards[targetCard].style.display = 'block';
                }
            });
        });
        // Trigger the click on the Pet Profile tab to show it initially
        document.querySelector('.nav-tab.active').click();
    });
</script>
@endsection