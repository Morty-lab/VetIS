@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    @include('components.header', ['title' => 'Medical Records'], ['icon' => '<i class="fa-solid fa-file-medical"></i>'])
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <nav class="nav nav-borders">
            <a class="nav-link ms-0" href="{{ route('records.medical')}}">
                <span class="px-2"><i class="fa-solid fa-arrow-left"></i></span> Back
            </a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="card shadow-none">
            <div class="card-header d-flex d-flex justify-content-between align-items-center text-red"><span><i class="fa-solid fa-box-archive me-2"></i>Medical Records Archive</span>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                       <th>File #</th>
                        <th>Date Created</th>
                        <th>Subject</th>
                        <th>Pet</th>
                        <th>Pet Type</th>
                        <th>Owner</th>
                        <th>Attending Veterinarian</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($petRecords as $record)
                        <tr>
                            <td>File-{{ str_pad($record->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $record->created_at->format('M d, Y g:i A') }}</td>
                            <td>{{ $record->subject }}</td>
                            <td>{{ $record->pet->pet_name }}</td>
                            <td>{{ $record->pet->pet_type }}</td>
                            <td>{{ $record->clients->client_name }}</td>
                            <td>Dr. {{ $record->doctor->firstname }} {{ $record->doctor->lastname }}</td>
                            <td>
                                @if($record->status == 0)
                                    <span class="badge badge-sm text-sm bg-warning-soft text-warning rounded-pill">Ongoing</span>
                                @elseif($record->status == 1)
                                    <span class="badge badge-sm text-sm bg-success-soft text-success rounded-pill">Completed</span>
                                @elseif($record->status == 2)
                                    <span class="badge badge-sm text-sm bg-danger-soft text-danger rounded-pill">Archived</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('soap.view', ['id' => $record->petID, 'recordID' => $record->id])}}" class="btn btn-datatable btn-primary px-5 py-3">View</a>
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
