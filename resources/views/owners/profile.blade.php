@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<div id="successAlert" class="alert alert-primary alert-icon position-fixed bottom-0 end-0 m-3" role="alert" style="display: none; z-index: 100;">
    <div class="alert-icon-aside">
        <i class="fa-regular fa-circle-check"></i>
    </div>
    <div class="alert-icon-content">
        <h6 class="alert-heading">Success</h6>
        Owner Registered Successfully!
    </div>
</div>

<!-- Modals -->
<div class="modal fade" id="updateOwnerInfo" tabindex="-1" role="dialog" aria-labelledby="updateOwnerInfoTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="updateOwnerInfoTitle">Update Owner Information</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gx-3 mb-3">
                    <div class=" col-md-6 mb-2">
                        <label class="small mb-1" for="editFirstName">First Name</label>
                        <input type="text" class="form-control" name="" id="" value="John">
                    </div>
                    <div class=" col-md-6 mb-2">
                        <label class="small mb-1" for="editLastName">Last Name</label>
                        <input type="text" class="form-control" name="" id="" value="Doe">
                    </div>

                    <div class="col-md-12 mb-2">
                        <label class="small mb-1" for="editEmailAddress">Email address</label>
                        <input type="text" class="form-control" name="" id="" value="princeinventorevltn89@gmail.com">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="small mb-1" for="editAddress">Address</label>
                        <input type="text" class="form-control" name="" id="" value="{{$client->client_address}}">
                    </div>
                    <div class="col-md-6">
                        <label class="small mb-1" for="editPhone">Phone number</label>
                        <input type="text" class="form-control" name="" id="" value="{{$client->client_no}}">
                    </div>
                    <!-- Form Group (birthday)-->
                    <div class="col-md-6">
                        <label class="small mb-1" for="editBirthday">Birthday</label>
                        <input type="date" class="form-control" name="birthday" id="editBirthday" value="{{ \Carbon\Carbon::parse($client->client_birthday)->format('Y-m-d') }}">
                    </div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary" type="button">Update</button></div>
        </div>
    </div>
</div>

<div class="modal fade" id="updatePhotoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
<div class="modal fade" id="umEditAccount" tabindex="-1" role="dialog" aria-labelledby="umEditAccount" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="umEditAccount">Edit Account</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gx-3 mb-3">
                    <div class=" col-md-6 mb-2">
                        <label class="small mb-1" for="editFirstName">First Name</label>
                        <input type="text" class="form-control" name="" id="" value="John">
                    </div>
                    <div class=" col-md-6 mb-2">
                        <label class="small mb-1" for="editLastName">Last Name</label>
                        <input type="text" class="form-control" name="" id="" value="Doe">
                    </div>

                    <div class="col-md-12 mb-2">
                        <label class="small mb-1" for="editEmailAddress">Email address</label>
                        <input type="email" class="form-control" name="" id="" value="princeinventorevltn89@gmail.com">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="small mb-1" for="editAddress">Address</label>
                        <input type="text" class="form-control" name="" id="" value="{{$client->client_address}}">
                    </div>
                    <div class="col-md-6">
                        <label class="small mb-1" for="editPhone">Phone number</label>
                        <input type="number" class="form-control" name="" id="" value="{{$client->client_no}}">
                    </div>
                    <!-- Form Group (birthday)-->
                    <div class="col-md-6">
                        <label class="small mb-1" for="editBirthday">Birthday</label>
                        <input type="date" class="form-control" name="birthday" id="editBirthday" value="{{ \Carbon\Carbon::parse($client->client_birthday)->format('Y-m-d') }}">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="small mb-1" for="editUsername">Username</label>
                        <input type="text" class="form-control" name="" id="" value="princeinventorevltn89@gmail.com">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="small mb-1" for="editPassword">Password</label>
                        <input type="password" class="form-control" name="" id="" value="usfjdlfhdalks">
                    </div>
                    <div class="col-md-12">
                        <label class="small mb-1" for="editRole">Role</label>
                        <select class="form-control" id="roleSelect" name="role">
                            <option value="Owner" selected>Pet Owner</option>
                            <option value="Doctor">Veterinarian</option>
                            <option value="Owner">Owner</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Secretary">Secretary</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary" type="button">Update</button></div>
        </div>
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

<div class="modal fade" id="disableAccountModal" tabindex="-1" role="dialog" aria-labelledby="disableAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
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
                <button class="btn btn-danger" type="button">Disable Account</button>
            </div>
        </div>
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
    <div class="row">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Owner Information</span>
                    <!-- Three-dot (kebab) menu button -->
                    <div class="dropdown">
                        <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateOwnerInfo">Update Information</a></li>
                            <!-- You can add more items here -->
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Form Row-->
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="small mb-1">Owner ID</label>
                            <p>{{ sprintf("OWN-%05d", $client->id) }}</p>
                        </div>
                        <!-- Form Group (first name)-->
                        <div class=" col-md-6">
                            <label class="small mb-1" for="inputFirstName">Owner Name</label>
                            <p>{{$client->client_name}}</p>
                        </div>
                        <!-- Form Group (last name)-->
                        {{-- <div class="col-md-6">--}}
                        {{-- <label class="small mb-1" for="inputLastName">Last name</label>--}}
                        {{-- <p>Invento</p>--}}
                        {{-- </div>--}}
                        <div class="col-md-12 mb-2">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <p>princeinventorevltn89@gmail.com</p>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="small mb-1" for="inputAddress">Address</label>
                            <p>{{$client->client_address}}</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="small mb-1" for="inputPhone">Phone number</label>
                            <p>{{$client->client_no}}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBirthday">Birthday</label>
                            <p>{{ \Carbon\Carbon::parse($client->client_birthday)->format('M d, Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Pets Owned</label>
                            <p>{{$client->petsOwned($client->id)->count()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Profile Picture</span>
                    <!-- Three-dot (kebab) menu button -->
                    <div class="dropdown">
                        <button class="btn btn-link text-muted p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updatePhotoModal">Update Photo</a></li>
                            <!-- You can add more items here -->
                        </ul>
                    </div>
                </div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/illustrations/profiles/profile-1.png') }}" alt="" />
                </div>
                <div class="card-footer text-center">
                </div>
            </div>
            <div class="card mb-4 mt-4 mb-xl-0">
                <div class="card-header">UM Settings</div>
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

    <div class="card mb-4">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Pets List</span>
            <a class="btn btn-primary justify-end" href="/addpet">Add Pet</a>
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
                        {{-- <th>Owner</th>--}}
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pets as $pet)
                    <tr>
                        <td>{{ sprintf("%05d", $pet->id) }}</td>
                        <td>{{ $pet->pet_name }}</td>
                        <td>{{ $pet->pet_type }}</td>
                        <td>{{ $pet->pet_breed }}</td>
                        <td>{{ $pet->age }} Months</td>
                        <td>{{ $pet->pet_gender }}</td>
                        {{-- <td>{{ $pet->client->client_name }}</td>--}}
                        <td>
                            @if ($pet->vaccinated)
                            <div class="badge bg-primary text-white rounded-pill">Vaccinated</div>
                            @elseif ($pet->sterilized)
                            <div class="badge bg-primary text-white rounded-pill">Sterilized</div>
                            @else
                            <div class="badge bg-primary text-white rounded-pill">Unvaccinated</div>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('pets.show', $pet->id) }}">Open</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div class="card mb-2">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Billing History</span>
        </div>
        <div class="card-body">
            <table id="billingTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Billing #</th>
                        <th>Payable</th>
                        <th>Remaining</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>04/19/2024</td>
                        <td>PH20324232</td>
                        <td>Php. 2000</td>
                        <td>Php. 0.00</td>
                        <td>
                            <a class="btn btn-primary" href="/profilepet">Open</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
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