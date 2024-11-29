@extends('layouts.app')

@section('styles')

@endsection

@section('content')
@include('components.header', ['title' => 'Pet Owner'], ['icon' => '<i class="fa-solid fa-paw"></i>'])

<div class="container-xl px-4 mt-4">
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
{{--                        <th>Status</th>--}}
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
{{--                        <td>--}}
{{--                            <span class="badge bg-primary-soft text-primary rounded-pill">Active</span>--}}
{{--                            <span class="badge bg-orange-soft text-orange rounded-pill">Disabled</span>--}}
{{--                        </td>--}}
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
