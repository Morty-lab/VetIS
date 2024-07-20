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
                                <i class="fa-solid fa-paw p-1"></i>
                            </div>
                            Manage Pets
                        </h1>
                        <div class="page-header-subtitle">
                            Add and Edit Pets
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Pets List</span>
                <a class="btn btn-primary justify-end" href="{{ route('pet.create') }}">Add Pet</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>PetID</th>
                            <th>Pet Name</th>
                            <th>Type</th>
                            <th>Breed</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Owner</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pets as $pet)
                            <tr>
                                <td>{{ $pet->id }}</td>
                                <td>{{ $pet->pet_name }}</td>
                                <td>{{ $pet->pet_type }}</td>
                                <td>{{ $pet->pet_breed }}</td>
                                <td>{{ $pet->age }} Months</td>
                                <td>{{ $pet->pet_gender }}</td>
                                <td>{{ $pet->client->client_name }}</td>
                                <td>
                                    @if ($pet->vaccinated)
                                        <div class="badge bg-primary text-white rounded-pill">Vaccinated</div>
                                    @elseif ($pet->sterilized)
                                        <div class="badge bg-primary text-white rounded-pill">Sterilized</div>
                                    @else
                                        <div class="badge bg-primary text-white rounded-pill">Unvaccinated</div>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('pets.show', $pet->id) }}">Open</a>
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
