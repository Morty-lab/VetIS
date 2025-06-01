@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    @include('components.header', ['title' => 'Pet Owner'], ['icon' => '<i class="fa-solid fa-paw"></i>'])

    <div class="container-xl px-4 mt-4">
        <div class="card shadow-none">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Pet Owners List</span>
                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'secretary')
                    <a class="btn btn-primary justify-end" href="/addowner"><i class="fa-solid fa-plus me-2"></i>Add Pet
                        Owner</a>
                @endif

            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            {{-- <th>Age</th> --}}
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>Email Address</th>
                            <th>Pets Owned</th>
                            {{--                        <th>Status</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients->sortBy('client_name') as $client)
                            @php
                                \App\Models\Clients::setEmailAttribute($client, $client->user_id);
                            @endphp
                            <tr>
                                <td>{{ $client->client_name }}</td>
                                {{-- <td>{{$client->age}}</td> --}}
                                <td>{{ $client->client_address }}</td>
                                <td><a class="text-body" href="tel:{{ $client->client_no }}">{{ $client->client_no }}</a></td>
                                <td><a class="text-body"
                                        href="mailto:{{ $client->client_email }}">{{ $client->client_email }}</a></td>
                                <td>
                                    @php
                                        $petCount = $client->petsOwned($client->id)->count();
                                        $badgeClass =
                                            $petCount === 0 ? 'bg-light text-body' : 'bg-primary-soft text-primary';
                                        $badgeText =
                                            $petCount === 0
                                                ? '0 Pet Owned'
                                                : ($petCount === 1
                                                    ? '1 Pet Owned'
                                                    : $petCount . ' Pets Owned');
                                    @endphp

                                    <span class="badge {{ $badgeClass }} rounded-pill badge-sm">{{ $badgeText }}</span>
                                </td>
                                {{--                        <td> --}}
                                {{--                            <span class="badge bg-primary-soft text-primary rounded-pill">Active</span> --}}
                                {{--                            <span class="badge bg-orange-soft text-orange rounded-pill">Disabled</span> --}}
                                {{--                        </td> --}}
                                <td>
                                    <a class="btn btn-datatable btn-primary px-5 py-3"
                                        href="{{ route('owners.show', $client->id) }}">View</a>
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
