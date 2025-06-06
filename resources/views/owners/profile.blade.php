@php use App\Models\Clients; @endphp

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
            Owner Registered Successfully!
        </div>
    </div>



    @php
        Clients::setEmailAttribute($client, $client->user_id);
    @endphp
    <!-- Modals -->
    <div class="modal fade" id="updateOwnerInfo" tabindex="-1" role="dialog" aria-labelledby="updateOwnerInfoTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="updateOwnerInfoTitle">Update Owner Information</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('owners.update', ['id' => $client->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="row g-3 mb-3">
                            <div class=" col-md-12">
                                <label class="small mb-1" for="editFirstName">Owner Name</label>
                                <input type="text" class="form-control" name="owner_name" id=""
                                    value="{{ $client->client_name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editBirthday">Birthday</label>
                                <input type="date" class="form-control" name="owner_bday" id="editBirthday"
                                    value="{{ \Carbon\Carbon::parse($client->client_birthday)->format('Y-m-d') }}"
                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="editAddress">Address</label>
                                <input type="text" class="form-control" name="owner_address" id=""
                                    value="{{ $client->client_address }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editEmailAddress">Email address</label>
                                <input type="text" class="form-control" name="owner_email" id=""
                                    value="{{ $client->client_email }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editPhone">Phone number</label>
                                <input type="text" class="form-control" name="owner_no" id=""
                                    value="{{ $client->client_no }}">
                            </div>
                            <!-- Form Group (birthday)-->

                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-dark" type="button"
                            data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary"
                            type="submit">Update</button></div>
                </form>

            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="updatePhotoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Update Profile Picture</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row justify-content-center align-items-center" style="height: 100%;">
                    <div class="col-md-6 d-flex flex-column align-items-center text-center border-end p-3 pe-3">
                        <img id="petPhotoPreview" class="img-account-profile rounded-circle mb-2" src="{{ $client->client_profile_picture ? asset('storage/' . $client->client_profile_picture) : asset('assets/img/illustrations/profiles/profile-1.png') }}" alt="Profile Picture" />
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
</div> --}}

    <!-- UM Modals -->
    <div class="modal fade" id="umEditAccount" tabindex="-1" role="dialog" aria-labelledby="umEditAccount"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form action="{{ route('owners.update', ['id' => $client->id]) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="umEditAccount">Edit Account</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class=" col-md-12">
                                <label class="small mb-1" for="editFirstName">Owner Name</label>
                                <input type="text" class="form-control" name="owner_name" id=""
                                    value="{{ $client->client_name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editBirthday">Birthday</label>
                                <input type="date" class="form-control" name="owner_bday" id="editBirthday"
                                    value="{{ \Carbon\Carbon::parse($client->client_birthday)->format('Y-m-d') }}"
                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="editAddress">Address</label>
                                <input type="text" class="form-control" name="owner_address" id=""
                                    value="{{ $client->client_address }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editEmailAddress">Email address</label>
                                <input type="text" class="form-control" name="owner_email" id=""
                                    value="{{ $client->client_email }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editPhone">Phone number</label>
                                <input type="text" class="form-control" name="owner_no" id=""
                                    value="{{ $client->client_no }}">
                            </div>
                            {{-- <div class="col-md-12"> --}}
                            {{-- <label class="small mb-1" for="editUsername">Username</label> --}}
                            {{-- <input type="text" class="form-control" name="owner_username" id="" value="" placeholder="Enter username"> --}}
                            {{-- </div> --}}
                            {{-- <div class="col-md-12 mt-4"> --}}
                            {{-- <h6 class="text-primary">Change Password</h6> --}}
                            {{-- <hr class="mt-1 mb-0"> --}}
                            {{-- </div> --}}
                            {{-- <div class="col-md-12"> --}}
                            {{-- <label class="small mb-1" for="editOldPassword">Old Password</label> --}}
                            {{-- <input type="text" class="form-control" name="username" id="editOldPassword" placeholder="Enter old password" value=""> --}}
                            {{-- </div> --}}
                            {{-- <div class="col-md-6"> --}}
                            {{-- <label class="small mb-1" for="updateNewPassword">New Password</label> --}}
                            {{-- <input type="text" class="form-control" name="username" id="updateNewPassword" placeholder="Enter new password" value=""> --}}
                            {{-- </div> --}}
                            {{-- <div class="col-md-6"> --}}
                            {{-- <label class="small mb-1" for="updateConfirmNewPassword">Confirm New Password</label> --}}
                            {{-- <input type="text" class="form-control" name="username" id="updatConfirmeNewPassword" placeholder="Confirm password" value=""> --}}
                            {{-- </div> --}}
                        </div>
                        {{-- <div class="row"> --}}
                        {{-- <div class="col-md-6 mb-2"> --}}
                        {{-- <label class="small mb-1" for="editUsername">Username</label> --}}
                        {{-- <input type="text" class="form-control" name="" id="" value="princeinventorevltn89@gmail.com"> --}}
                        {{-- </div> --}}
                        {{-- <div class="col-md-6 mb-2"> --}}
                        {{-- <label class="small mb-1" for="editPassword">Password</label> --}}
                        {{-- <input type="password" class="form-control" name="" id="" value="usfjdlfhdalks"> --}}
                        {{-- </div> --}}
                        {{-- <div class="col-md-12"> --}}
                        {{-- <label class="small mb-1" for="editRole">Role</label> --}}
                        {{-- <select class="form-control" id="roleSelect" name="role"> --}}
                        {{-- <option value="Owner" selected>Pet Owner</option> --}}
                        {{-- <option value="Doctor">Veterinarian</option> --}}
                        {{-- <option value="Owner">Owner</option> --}}
                        {{-- <option value="Administrator">Administrator</option> --}}
                        {{-- <option value="Secretary">Secretary</option> --}}
                        {{-- <option value="Staff">Staff</option> --}}
                        {{-- </select> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
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
                <div class="modal-header">
                    <h5 class="modal-title" id="umResetPasswordModalLabel">Reset Admin Password</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="ownerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="ownerEmail" placeholder="Enter owner email"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword"
                                placeholder="Enter new password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword"
                                placeholder="Confirm new password" required>
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

    <div class="modal fade" id="disableAccountModal" tabindex="-1" role="dialog"
        aria-labelledby="disableAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form action="{{ route('owners.disable', $client->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="disableAccountModalLabel">
                            @if ($client->status == true)
                                Disable Account
                            @else
                                Enable Account
                            @endif
                        </h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to @if ($client->status == true)
                                disable
                            @else
                                enable
                            @endif this account?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn @if ($client->status == true) btn-danger @else btn-success @endif"
                            type="submit">
                            @if ($client->status == true)
                                Disable Account
                            @else
                                Enable Account
                            @endif
                        </button>
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
                        <li class="breadcrumb-item"><a href="/manageowners">Manage Pet Owner</a></li>
                        <li class="breadcrumb-item active">Owner Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link nav-tab ms-0{{ request()->is('own-profile') ? 'active' : '' }}" href="#own-profile">Owner
                Profile</a>
            <a class="nav-link nav-tab{{ request()->is('pets') ? 'active' : '' }}" href="#pets">Pet List</a>
            @if (in_array(auth()->user()->role, ['secretary', 'admin']))
                <a class="nav-link nav-tab{{ request()->is('billinghistory') ? 'active' : '' }}"
                    href="#billinghistory">Billing History</a>
                <a class="nav-link nav-tab{{ request()->is('um') ? 'active' : '' }}" href="#um">Account Settings</a>
            @endif
        </nav>
        <hr class="mt-0 mb-4" />

        <div class="row">
            <div class="col-md-12" id="ownerProfileCard" style="display:none;">
                <div class="row">
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card shadow-none mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>Owner Information</span>
                                <!-- Three-dot (kebab) menu button -->
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#updateOwnerInfo">Update Information</a></li>
                                        <!-- You can add more items here -->
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label class="small mb-1">Name</label>
                                        <p>{{ $client->client_name }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small mb-1">Owner ID</label>
                                        <div>
                                            <p class="badge bg-primary-soft text-primary rounded-pill">
                                                {{ sprintf('OWN-%05d', $client->id) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small mb-1">Status</label>
                                        <div>
                                            @if ($client->status == true)
                                                <p class="badge bg-primary-soft text-primary rounded-pill">Active</p>
                                            @else
                                                <p class="badge bg-orange-soft text-orange rounded-pill">Disabled</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputBirthday">Birthday</label>
                                        <p>{{ \Carbon\Carbon::parse($client->client_birthday)->format('M d, Y') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Pets Owned</label>
                                        <p>{{ $client->petsOwned($client->id)->count() }}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="small mb-1" for="inputAddress">Address</label>
                                        <p>{{ $client->client_address }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                        <p>{{ $client->client_email }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputPhone">Phone number</label>
                                        <p>{{ $client->client_no }}</p>
                                    </div>
                                    <!-- Form Group (first name)-->
                                    <!-- Form Group (last name)-->
                                    {{-- <div class="col-md-6"> --}}
                                    {{-- <label class="small mb-1" for="inputLastName">Last name</label> --}}
                                    {{-- <p>Invento</p> --}}
                                    {{-- </div> --}}
                                    {{-- Update when schema is changed
                        Client(Status attribute)
                        Client(Model Fillable)
                        Client(Controller function add)
                        --}}
                                    {{-- <div class="col-md-6"> --}}
                                    {{-- <label class="small mb-1">Status</label> --}}
                                    {{-- <p>{{$client->status}}</p> --}}
                                    {{-- </div> --}}
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
                                {{--                            <div class="dropdown"> --}}
                                {{--                                <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"> --}}
                                {{--                                    <i class="fa fa-ellipsis-v"></i> --}}
                                {{--                                </button> --}}
                                {{--                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"> --}}
                                {{--                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updatePhotoModal">Update Photo</a></li> --}}
                                {{--                                    <!-- You can add more items here --> --}}
                                {{--                                </ul> --}}
                                {{--                            </div> --}}
                                <form id="petPhotoForm" action="{{ route('uploadPhoto', $client->user_id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="dropdown">
                                        <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                            <input type="file" id="petPhotoInput" name="photo" accept="image/jpeg,image/png" style="display: none;" onchange="uploadPetPhoto()">

                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a class="dropdown-item" href="#" onclick="document.getElementById('petPhotoInput').click(); return false;">
                                                        Update Profile Picture
                                                    </a>
                                                </li>
                                            </ul>

                                    </div>
                                </form>
                            </div>
                            <div class="card-body text-center">
                                <!-- Profile picture image-->
                                <img id="petPhotoPreview" class="img-account-profile rounded-circle mb-2" style="width: 200px; height: 200px; object-fit: cover;"
                                    src="{{ $client->client_profile_picture ? asset('storage/' . $client->client_profile_picture) : asset('assets/img/illustrations/profiles/profile-1.png') }}"
                                    alt="" />
                            </div>
                            <div class="card-footer text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="petsCard" style="display: none;">
                <div class="card shadow-none mb-4">
                    <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Pets
                            List</span>
                        <a class="btn btn-primary justify-end"
                            href="{{ route('pet.create', ['clientID' => $client->id]) }}">Add Pet</a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>PetID</th>
                                    <th>Pet Name</th>
                                    <th>Type</th>
                                    <th>Breed</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    {{-- <th>Owner</th> --}}
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pets as $pet)
                                    <tr>
                                        <td>PETID-{{ sprintf('%05d', $pet->id) }}</td>
                                        <td>{{ $pet->pet_name }}</td>
                                        <td>{{ $pet->pet_type }}</td>
                                        <td>{{ $pet->pet_breed }}</td>
                                        <td>{{ $pet->age }}</td>
                                        <td>{{ $pet->pet_gender }}</td>
                                        {{-- <td>{{ $pet->client->client_name }}</td> --}}
                                        <td>
                                            @if ($pet->vaccinated === 1)
                                                <div class="badge badge-sm bg-primary-soft text-primary rounded-pill">Vaccinated</div>
                                            @elseif ($pet->vaccinated === 0)
                                                <div class="badge badge-sm bg-orange-soft text-orange rounded-pill">Unvaccinated</div>
                                            @elseif (is_null($pet->vaccinated))
                                                <div class="badge badge-sm bg-gray-200 text-body rounded-pill">No Vaccination Record</div>
                                            @endif
                                            @if ($pet->neutered)
                                                <div class="badge badge-sm rounded-pill bg-success-soft text-success">Sterilized</div>
                                            @endif
                                            @if($pet->status)
                                                <div class="badge badge-sm bg-primary-soft text-primary rounded-pill"><i class="fa-solid fa-check"></i></div>

                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-datatable btn-primary px-5 py-3"
                                                href="{{ route('pets.show', $pet->id) }}">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="billingCard" style="display: none;">
                <div class="card shadow-none mb-2">
                    <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Billing
                            History</span>
                    </div>
                    <div class="card-body">
                        <table id="billingTable">
                            <thead>
                                <tr>
                                    <th>Invoice/Billing Number</th>
                                    <th>Billing Date</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($billing as $bill)
                                    <tr>
                                        <td>{{ sprintf('#%05d', $bill->id) }} </td>
                                        <td>{{ $bill->created_at->format('d M, Y h:i A') }}</td>
                                        <td>
                                            @if ($bill->total_payable - $bill->total_paid == 0)
                                                <div class="badge bg-success-soft text-success text-sm rounded-pill">Fully
                                                    Paid</div>
                                            @else
                                                <div class="badge bg-secondary-soft text-secondary text-sm rounded-pill">
                                                    Partially Paid</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-datatable btn-primary px-5 py-3"
                                                href="{{ route('billing.view', ['billingID' => $bill->id]) }}">View</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="umCard" style="display: none;">
                <div class="card shadow-none">
                    <div class="card-header">UM Settings</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card shadow-none mb-4 mt-4 mb-xl-0">
                                    <div class="card-header">Account Settings</div>
                                    <div class="card-body">
                                        <div class="row gy-2 gx-2">
                                            <div class="col-md-12"><button class="btn btn-primary w-100" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#umEditAccount">Edit
                                                    Account</button></div>
                                            <div class="col-md-6"><button class="btn btn-primary w-100" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#umResetPasswordModal">Reset
                                                    Password</button></div>
                                            <div class="col-md-6"><button class="btn btn-primary w-100" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#disableAccountModal">
                                                    @if ($client->status == true)
                                                        Disable Account
                                                    @else
                                                        Enable Account
                                                    @endif
                                                </button></div>
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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

        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.nav-tab');
            const cards = {
                'own-profile': document.getElementById('ownerProfileCard'),
                'pets': document.getElementById('petsCard'),
                'billinghistory': document.getElementById('billingCard'),
                'um': document.getElementById('umCard')
            };

            // Ensure Pet Profile is active initially
            document.querySelector('.nav-link[href="#own-profile"]').classList.add('active');
            cards['own-profile'].style.display = 'block'; // Show Pet Profile Card by default

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
    <script>
            function uploadPetPhoto() {
                const form = document.getElementById('petPhotoForm');
                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('petPhotoPreview').src = data.photo_url;
                            toastr.success('Photo updated successfully!');
                        } else {
                            toastr.error('Failed to upload pet photo. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        toastr.error('An error occurred while uploading the pet photo.');
                    });
            }
    </script>
@endsection

@section('scripts')
@endsection
