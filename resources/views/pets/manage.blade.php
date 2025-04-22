@extends('layouts.app')

@section('styles')
@endsection

@section('content')
@include('components.header', ['title' => 'Pets'], ['icon' => '<i class="fa-solid fa-paw"></i>'])
<!-- Main page content-->
<div class="container-xl px-4 mt-4">
    <div class="card shadow-none">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Pets List</span>
            <div class="d-flex align-items-center">
                <a class="btn btn-primary justify-end" href="{{ route('pet.create') }}"><i class="fa-solid fa-plus me-2"></i> Add Pet</a>
                <div class="dropdown">
                    <button class="btn btn-link text-muted p-0 ms-3" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-divider"></div>
                        <div><a class="dropdown-item" href="{{route('pet.archive')}}"><i class="fa-solid fa-box-archive me-2"></i> Pets Archive</a></div>
                    </ul>
                </div>
            </div>
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
                    @foreach ($pets->sortBy('pet_name') as $pet)
                    <tr>
                        <td>PETID-{{ str_pad($pet->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $pet->pet_name }}</td>
                        <td>{{ $pet->pet_type }}</td>
                        <td>{{ $pet->pet_breed }}</td>
                        <td>{{ $pet->age }}</td>
                        <td>{{ $pet->pet_gender }}</td>
                        <td>{{ $pet->client->client_name }}</td>
                        <td>
                            @if ($pet->vaccinated === 1)
                                <div class="badge badge-sm bg-primary-soft text-primary rounded-pill">Vaccinated</div>
                            @elseif ($pet->vaccinated === 0)
                                <div class="badge badge-sm bg-orange-soft text-orange rounded-pill">Unvaccinated</div>
                            @elseif (is_null($pet->vaccinated))
                                <div class="badge badge-sm bg-gray-200 text-body rounded-pill">No Vaccination Record</div>
                            @endif
                            @if ($pet->neutered)
                                    <div class="badge badge-sm rounded-pill bg-success-soft text-success">Sterilized</div>
                            @endif
                            @if($pet->status)
                                <div class="badge badge-sm bg-primary-soft text-primary rounded-pill"><i class="fa-solid fa-check"></i></div>

                            @endif
                        </td>
                        <td>
                            <a class="btn btn-datatable btn-primary px-5 py-3" href="{{ route('pets.show', $pet->id) }}">View</a>
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
