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
        Account Updated Successfully!
    </div>
</div>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="/um/staff">Manage Staff</a></li>
                    <li class="breadcrumb-item active">Edit Account</li>
                </ol>
            </nav>
        </div>
    </div>
</header>

<!-- Main page content -->
<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-8">
            <!-- Account details card -->
            <div class="card shadow-none mb-4">
                <div class="card-header">Edit Account Details</div>
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        @method('PUT')

                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- First name -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First Name</label>
                                <input class="form-control @error('firstname') is-invalid @enderror" id="inputFirstName" name="firstname" type="text" placeholder="First Name" />
                                @error('firstname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Last name -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last Name</label>
                                <input class="form-control @error('lastname') is-invalid @enderror" id="inputLastName" name="lastname" type="text" placeholder="Last Name" />
                                @error('lastname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email address -->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="inputEmailAddress" name="email" type="email" placeholder="Email Address" />
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputAddress">Address</label>
                            <input class="form-control @error('address') is-invalid @enderror" id="inputAddress" name="address" type="text" placeholder="Address" />
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Phone number -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone Number</label>
                                <input class="form-control @error('phone_number') is-invalid @enderror" id="inputPhone" name="phone_number" type="tel" placeholder="Phone Number" />
                                @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Birthday -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control @error('birthday') is-invalid @enderror" id="inputBirthday" name="birthday" type="date" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                                @error('birthday')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Position -->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPosition">Position</label>
                            <select class="form-control @error('position') is-invalid @enderror" id="inputPosition" name="position">
                                <option value="" disabled>Select Position</option>
                                <option value="staff">Staff</option>
                                <option value="secretary">Secretary</option>
                                <option value="cashier">Cashier</option>
                            </select>
                            @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Save changes button -->
                        <button class="btn btn-primary" id="editBtn" type="submit">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <!-- Profile picture card -->
            <div class="card shadow-none mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image -->
                    <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/illustrations/profiles/profile-1.png') }}" alt="Profile Picture" />
                    <!-- Profile picture help block -->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button -->
                    <button class="btn btn-primary" type="button">Upload Image</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var editButton = document.getElementById('editBtn');
        editButton.addEventListener('click', function() {
            var successAlert = document.getElementById('successAlert');
            successAlert.style.display = 'flex';

            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 3000);
        });
    });
</script>
@endsection

@section('scripts')
@endsection