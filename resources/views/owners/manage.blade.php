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
                            <i class="fa-solid fa-user-doctor p-1"></i>
                        </div>
                        Manage Pet Owners
                    </h1>
                    <div class="page-header-subtitle">
                        Add and Edit Pet Owners
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-n10">
    <div class="card shadow-none">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Pet Owners List</span>
            <a class="btn btn-primary justify-end" href="/addowner">Add Pet Owner</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>OwnerID</th>
                        <th>Name</th>
                        {{-- <th>Age</th>--}}
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Pets Owned</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td>{{ sprintf("OWN-%05d", $client->id) }}</td>
                        <td>{{$client->client_name}}</td>
                        {{-- <td>{{$client->age}}</td>--}}
                        <td>{{$client->client_address}}</td>
                        <td>{{$client->client_no}}</td>
                        <td>{{$client->petsOwned($client->id)->count()}}</td>
                        <td>
                            <a class="btn btn-datatable btn-primary px-5 py-3" href="{{route('owners.show',  $client->id)}}">Open</a>
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