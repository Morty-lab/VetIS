@extends('layouts.app')

@section('styles')
@endsection

@section('content')

 {{--  Create Medical Record Modal  --}}
    <div class="modal fade" id="createRoomModal" tabindex="-1" aria-labelledby="Create Room" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content py-3">
                <div class="modal-header border-0 text-center d-block">
                    <i class="fa-solid fa-plus text-primary display-5"></i>
                    <h5 class="modal-title mt-2" id="createRoomModal">Create Room</h5>
                </div>
                <div class="modal-body text-center">
                    Are you sure you want to <strong>Create</strong> a new room?
                </div>
                <div class="modal-footer border-0 justify-content-center">
                        <button type="button" class="btn btn-primary-soft text-primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>

<header class="mt-n10 pt-10 bg-white border-bottom">
    <div class="container-xl px-4">
        <div class="page-header-content py-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h1 class="d-flex text-primary mb-0">
                    <div class="nav-link-icon me-2"> <p class="mb-0"><i class="fa-solid fa-house-medical"></i></p></div>
                    <p class="mb-0">Pet Lodge</p>
                </h1>
                <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoomModal"><i class="fa-solid fa-plus me-2"></i>Create Room</div>
            </div>
        </div>
    </div>
</header>
<div class="container-xl px-4 mt-4">
    <div class="row gy-4">
        <div class="col-md-4">
            <div class="card shadow-none h-100 border-start-lg border-start-warning">
                <div class="row m-0 h-100">
                    <div class="col-md-2 p-3 border-end">
                        <i class="fa-solid fa-house-medical text-gray-400 w-100 h-100"></i>
                    </div>
                    <div class="col-md-10 p-0 d-flex flex-column justify-content-between">
                        <div class="py-3 px-3">
                            <div class="justify-content-between d-flex mb-1">
                                <p class="fw-600 text-lg text-dark mb-0">Room #1</p>
                                <div class="">
                                    <div class="badge bg-warning-soft text-warning rounded-pill">Occupied</div>
                                </div>
                            </div>
                            <p class="mb-1">Pet: <span class="text-primary fw-600">Lexie</span></p>
                            <p class="mb-1">Pet Owner: <span class="text-primary fw-600">Kent Invento</span></p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between small border-top px-3 py-2">
                            <a class="text-primary stretched-link" href="{{ route('lodge.view') }}">Open</a>
                            <div>
                                <i class="fa-solid fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-none h-100 border-start-lg border-start-success">
                <div class="row m-0 h-100">
                    <div class="col-md-2 p-3 border-end">
                        <i class="fa-solid fa-house-medical text-gray-400 w-100 h-100"></i>
                    </div>
                    <div class="col-md-10 p-0 h-100 d-flex flex-column justify-content-between">
                        <div class="py-3 px-3">
                            <div class="justify-content-between d-flex mb-1">
                                <p class="fw-600 text-lg text-dark mb-0">Room #2</p>
                                <div class="">
                                    <div class="badge bg-success-soft text-success rounded-pill">Available</div>
                                </div>
                            </div>
                            <p class="mb-1">Pet: --</p>
                            <p class="mb-1">Pet Owner: --</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between small border-top px-3 py-2">
                            <a class="text-primary stretched-link" href="{{ route('lodge.view') }}">Open</a>
                            <div>
                                <i class="fa-solid fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-none h-100 border-start-lg border-start-success">
                <div class="row m-0 h-100">
                    <div class="col-md-2 p-3 border-end">
                        <i class="fa-solid fa-house-medical text-gray-400 w-100 h-100"></i>
                    </div>
                    <div class="col-md-10 p-0 h-100 d-flex flex-column justify-content-between">
                        <div class="py-3 px-3">
                            <div class="justify-content-between d-flex mb-1">
                                <p class="fw-600 text-lg text-dark mb-0">Room #3</p>
                                <div class="">
                                    <div class="badge bg-success-soft text-success rounded-pill">Available</div>
                                </div>
                            </div>
                            <p class="mb-1">Pet: --</p>
                            <p class="mb-1">Pet Owner: --</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between small border-top px-3 py-2">
                            <a class="text-primary stretched-link" href="{{ route('lodge.view') }}">Open</a>
                            <div>
                                <i class="fa-solid fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-none h-100 border-start-lg border-start-success">
                <div class="row m-0 h-100">
                    <div class="col-md-2 p-3 border-end">
                        <i class="fa-solid fa-house-medical text-gray-400 w-100 h-100"></i>
                    </div>
                    <div class="col-md-10 p-0 h-100 d-flex flex-column justify-content-between">
                        <div class="py-3 px-3">
                            <div class="justify-content-between d-flex mb-1">
                                <p class="fw-600 text-lg text-dark mb-0">Room #4</p>
                                <div class="">
                                    <div class="badge bg-success-soft text-success rounded-pill">Available</div>
                                </div>
                            </div>
                            <p class="mb-1">Pet: --</p>
                            <p class="mb-1">Pet Owner: --</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between small border-top px-3 py-2">
                            <a class="text-primary stretched-link" href="{{ route('lodge.view') }}">Open</a>
                            <div>
                                <i class="fa-solid fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- If walang rooms ni mag show --}}
    {{-- <div class="d-flex justify-content-center align-items-center" style="height: 70vh;">
        <div class="text-center text-muted">
            <i class="fa-solid fa-plus display-6 mb-2"></i>
            <p class="mb-0">No rooms found. Set up a room </br> to accommodate pets in the lodge.</p>
        </div>
    </div>     --}}
</div>
@endsection
@section('scripts')
@endsection