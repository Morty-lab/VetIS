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
                            Manage Pet Owner
                        </h1>
                        <div class="page-header-subtitle">
                            Add and Edit Pet Owner
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Pet Owner List</span>
                <a class="btn btn-primary justify-end" href="/um/client/add">Add Pet Owner</a>
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

                            <tr>
                                <td>Kent Ivento</td>
                                <td>22</td>
                                <td>Pet Owner</td>
                                <td>09942194953</td>
                                <td>kentinvento@gmail.com</td>
                                <td>
                                    <a class="btn btn-primary" href="/um/client/profile">Open</a>
                                </td>
                            </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
