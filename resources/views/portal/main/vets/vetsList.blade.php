@extends('portal.layouts.app')
@section('styles')
@endsection
@section('outerContent')
<header class="mt-n10 pt-10 bg-white border-bottom">
    <div class="container-xl px-4">
        <div class="page-header-content py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="text-primary mb-0">Veterinarians</h1>
            </div>
        </div>
    </div>
</header>
@endsection
@section('content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card border-top-lg border-top-primary shadow-none border">
            <!-- Card -->
            <div class="card-body p-0">
                <div class="d-flex justify-content-center pt-2 px-2">
                    <img class="img-account-profile mb-2 rounded border custom-img" src="{{asset('assets/img/illustrations/profiles/profile-1.png')}}" alt="Profile Picture" />
                </div>
                <div class="pet-info mt-2 py-2 px-4 border-top bg-white">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="mb-0">John Doe</h4>
                            <p class="mb-0">Veterinarian I</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer mt-0 d-flex justify-content-end">
                <a href="{{ route('portal.appointments') }}?openModal=true" class="btn btn-primary w-100">Book Appointment</a>
            </div>
        </div>
    </div>
</div>
@endsection