@extends('portal.layouts.app')

@section('outerContent')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="">Appointments</a></li>
                        <li class="breadcrumb-item active">Request Appointment</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <div class="card shadow-none mb-5 mt-5">
        <div class="card-header">
            Appointment Request
        </div>
        <div class="card-body">
            <div class="card shadow-none">
                <div class="card-body">
                    <h3 class="text-primary mb-3 mt-2 text-center">Select a Veterinarian</h3>
                    <div class="d-flex">
                        <div class="container-xl px-4 mt-4">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-3 mb-4">
                                    <div class="card border-top-lg border-top-primary shadow-none border">
                                        <div class="card-body p-0">
                                            <div class="d-flex justify-content-center pt-2 px-2">
                                                <img class="img-account-profile mb-2 rounded border w-100 h-100" src="http://127.0.0.1:8000/assets/img/illustrations/profiles/profile-1.png" alt="Profile Picture">
                                            </div>
                                            <div class="pet-info mt-2 py-2 px-4 border-top bg-white">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <h6 class="mb-0">John Doe</h6>
                                                        <p class="mb-0">Veterinarian I</p></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer mt-0 d-flex justify-content-end">
                                            <a href="" class="btn btn-primary w-100">Select Veterinarian</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-top-lg border-top-primary shadow-none border">
                                        <div class="card-body p-0">
                                            <div class="d-flex justify-content-center pt-2 px-2">
                                                <img class="img-account-profile mb-2 rounded border w-100 h-100" src="http://127.0.0.1:8000/assets/img/illustrations/profiles/profile-1.png" alt="Profile Picture">
                                            </div>
                                            <div class="pet-info mt-2 py-2 px-4 border-top bg-white">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <h6 class="mb-0">John Doe</h6>
                                                        <p class="mb-0">Veterinarian I</p></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer mt-0 d-flex justify-content-end">
                                            <a href="" class="btn btn-primary w-100">Select Veterinarian</a>
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
