@extends('portal.layouts.app')
@section('styles')
<style>
    .custom-img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        object-position: center;
    }
</style>
@endsection
@section('outerContent')
<header class="mt-n10 pt-10 bg-white border-bottom">
    <div class="container-xl px-4">
        <div class="page-header-content py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="text-primary mb-0">My Pets</h1>
                <a href="{{ route('portal.mypets.register')}}" class="btn btn-primary">Register Pet</a>
            </div>
        </div>
    </div>
</header>
@endsection
@section('content')
<div class="row">
    @foreach($pets as $pet)
    <div class="col-md-3 mb-4">
        <div class="card border-top-lg border-top-primary shadow-none border">
            <!-- Card -->
            <div class="card-body p-0">
                <div class="d-flex justify-content-center pt-2 px-2">
                    <img class="img-account-profile mb-2 rounded border custom-img" src="{{$pet->pet_picture != null ? asset('storage/' . $pet->pet_picture) :'https://img.freepik.com/premium-vector/white-cat-portrait-hand-drawn-illustrations-vector_376684-65.jpg'}}" alt="Profile Picture" />
                </div>
                <div class="pet-info mt-2 py-2 px-4 border-top bg-white">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="text-sm">Pet Name</div>
                            <h4 class="mb-0">{{$pet->pet_name}}</h4>
                            <p class="mb-0">{{$pet->pet_type}}</p>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <span class="badge bg-primary-soft text-primary text-sm rounded-pill"><i class="fa-solid fa-check"></i></span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer mt-0 d-flex justify-content-end">
                <a href="{{ route('portal.mypets.view', ['petid' => $pet->id])}}" class="btn btn-primary w-100">Open</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection