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
        Staff Registered Successfully!
    </div>
</div>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="/um/staff">Manage Staff</a></li>
                    <li class="breadcrumb-item active">Add Staff</li>
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
            <div class="card shadow-none mb-4">
                <div class="card-header">Account Registration</div>
                <div class="card-body">
                    <form method="POST" action="{{route('staffs.add')}}">
                        @csrf
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <input class="form-control @error('firstname') is-invalid @enderror" id="inputFirstName" name="firstname" type="text" placeholder="First Name" />
                                @error('firstname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class="form-control @error('lastname') is-invalid @enderror" id="inputLastName" name="lastname" type="text" placeholder="Last Name" />
                                @error('lastname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="inputEmailAddress" name="email" type="email" placeholder="Email Address" value="" />
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Add similar error handling for other fields -->
                        <!-- Form Group (address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputAddress">Address</label>
                            <input class="form-control @error('address') is-invalid @enderror" id="inputAddress" name="address" type="text" placeholder="Address" value="" />
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control @error('phone_number') is-invalid @enderror" id="inputPhone" name="phone_number" type="tel" placeholder="Phone Number" value="" />
                                @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control @error('birthday') is-invalid @enderror" id="inputBirthday" name="birthday" type="date" placeholder="MM/DD/YYYY" value="" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                                @error('birthday')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Form Group (position)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPosition">Position</label>
                            <select class="form-control @error('position') is-invalid @enderror" id="inputPosition" name="position">
                                <option value="" disabled selected>Select Position</option>
                                <option value="staff" {{ old('position') == 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="secretary" {{ old('position') == 'secretary' ? 'selected' : '' }}>Secretary</option>
                                <option value="cashier" {{ old('position') == 'cashier' ? 'selected' : '' }}>Cashier</option>
                            </select>
                            @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Form Group (username)-->
                        {{-- <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username</label>
                            <input class="form-control @error('username') is-invalid @enderror" id="inputUsername" name="username" type="text" placeholder="Username" value="" />
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}
                </div>
                @enderror
            </div> --}}
            <!-- Form Row-->
            <div class="row gx-3 mb-3">
                <!-- Form Group (password)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="inputPassword">Password</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" name="password" type="password" placeholder="Password" value="" />
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Form Group (confirm password)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="confirmPassword">Confirm Password</label>
                    <input class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmPassword" name="password_confirmation" type="password" placeholder="Confirm Password" value="" />
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Save changes button-->
            <button class="btn btn-primary" id="regbtn" type="submit">Register</button>
            </form>


        </div>
    </div>
</div>
{{--<div class="col-xl-4">--}}
{{--    <!-- Profile picture card-->--}}
{{--    <div class="card shadow-none mb-4 mb-xl-0">--}}
{{--        <div class="card-header">Profile Picture</div>--}}
{{--        <div class="card-body text-center">--}}
{{--            <!-- Profile picture image-->--}}
{{--            <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/illustrations/profiles/profile-1.png') }}" alt="" />--}}
{{--            <!-- Profile picture help block-->--}}
{{--            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>--}}
{{--            <!-- Profile picture upload button-->--}}
{{--            <button class="btn btn-primary" type="button">Upload Image</button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
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
