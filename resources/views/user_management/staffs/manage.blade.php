@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon">
                                <i class="fa-solid fa-user-tie p-1"></i>
                            </div>
                            Manage Staff
                        </h1>
                        <div class="page-header-subtitle">
                            Add and Edit Staff
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Staff List</span>
                <a class="btn btn-primary justify-end" href="/um/staff/add">Add Staff</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Position</th>
                            <th>Phone Number</th>
                            <th>Email Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staff as $item)
                            <tr>
                                <td>{{$item->firstname . ' ' . $item->lastname}}</td>
                                <td>{{$item->age}}</td>
                                <td>Staff</td>
                                <td>{{$item->phone_number}}</td>
                                <td>{{$item->getEmailAttribute($item->user_id)}}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('staffs.profile',['id'=> $item->id])}}">Open</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
