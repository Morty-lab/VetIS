<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register - PetHub Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href=" {{ asset('assets/img/favicon.png')}}" />
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body class="bg-white">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <!-- Basic register form-->
                            <div class="card shadow-none border-1 rounded-lg mt-5">
                                <div class="card-header justify-content-center">
                                    <h3 class="fw-light my-1">Create an account</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Display Errors at the Top -->
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    <!-- Register form-->
                                    <form action="{{route('register')}}" method="POST">
                                        @csrf
                                        <!-- Form Row-->
                                        <div class="row gx-3">
                                            <div class="col-md-6">
                                                <!-- Form Group (first name)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputFirstName">First Name</label>
                                                    <input class="form-control" id="inputFirstName" type="text" name="first_name" placeholder="Enter first name" autocomplete="off"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Form Group (last name)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputLastName">Last Name</label>
                                                    <input class="form-control" id="inputLastName" type="text" name="last_name" placeholder="Enter last name" autocomplete="off"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Form Group (email address)            -->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control" id="inputEmailAddress" type="email" aria-describedby="emailHelp" name="email" placeholder="Enter email address" autocomplete="off"/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputAddress">Address</label>
                                            <input class="form-control" id="inputAddress" type="text" aria-describedby="addressHelp" name="address" placeholder="Enter address" autocomplete="off"/>
                                        </div>
                                        <div class="row gx-3">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="inputPhoneNumber" class="small mb-1">Phone Number</label>
                                                    <input type="text" name="phone_number" class="form-control" id="inputPhoneNumber" placeholder="Enter phone number" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="inputBirthdate" class="small mb-1">Birthday</label>
                                                    <div class="input-group input-group-joined">
                                                        <input type="text" name="birthday" id="inputBirthdate" class="form-control @error('birthday') is-invalid @enderror"
                                                            max="{{ \Carbon\Carbon::now()->toDateString() }}" placeholder="yyyy-mm-dd">
                                                        <span class="input-group-text">
                                                            <i class="fa-solid fa-calendar-days"></i>
                                                        </span>
                                                    </div>
                                                    @error('birthday')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gx-3">
                                            <div class="col-md-6">
                                                <!-- Form Group (password)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputPassword">Password</label>
                                                    <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Enter password" autocomplete="off"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Form Group (confirm password)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                    <input class="form-control" id="inputConfirmPassword" type="password" placeholder="Confirm password" autocomplete="off"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Form Group (create account submit)-->
                                        <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="{{route('portal.login')}}">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="footer-admin mt-auto footer-light">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small">Copyright © PetHub 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js')}}"></script>
    <script src="{{ asset('js/forms/flatpickr.js')}}"></script>
</body>

</html>