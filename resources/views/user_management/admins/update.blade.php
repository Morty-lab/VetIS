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
        Admin Updated Successfully!
    </div>
</div>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="/um/admin">Manage Administrator</a></li>
                    <li class="breadcrumb-item active">Edit Admin</li>
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
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        @method('PUT')

                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (First Name) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First Name</label>
                                <input class="form-control @error('firstname') is-invalid @enderror" id="inputFirstName" name="firstname" type="text" placeholder="First Name" value="" />
                                @error('firstname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Form Group (Last Name) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last Name</label>
                                <input class="form-control @error('lastname') is-invalid @enderror" id="inputLastName" name="lastname" type="text" placeholder="Last Name" value="" />
                                @error('lastname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Group (Email Address) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="inputEmailAddress" name="email" type="email" placeholder="Email Address" value="" />
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Form Group (Address) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputAddress">Address</label>
                            <input class="form-control @error('address') is-invalid @enderror" id="inputAddress" name="address" type="text" placeholder="Address" value="" />
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (Phone Number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone Number</label>
                                <input class="form-control @error('phone_number') is-invalid @enderror" id="inputPhone" name="phone_number" type="tel" placeholder="Phone Number" value="" />
                                @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Form Group (Birthday) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control @error('birthday') is-invalid @enderror" id="inputBirthday" name="birthday" type="date" value="" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                                @error('birthday')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Group (Position) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPosition">Position</label>
                            <input class="form-control @error('position') is-invalid @enderror" id="inputPosition" name="position" type="text" placeholder="Position" value="" />
                            @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Save changes button -->
                        <button class="btn btn-primary" type="submit">Update</button>
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
                    <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/illustrations/profiles/profile-1.png') }}" alt="" />
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
        // Show success alert when update is successful
        var successAlert = document.getElementById('successAlert');
        if (successAlert) {
            successAlert.style.display = 'flex';
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 3000);
        }
    });
</script>
@endsection

@section('scripts')

@endsection