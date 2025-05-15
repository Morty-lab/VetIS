@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    {{--  Create Medical Record Modal  --}}
    <div class="modal fade" id="createRoomModal" tabindex="-1" aria-labelledby="Create Room" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('lodge.add') }}" method="POST">
                @csrf
                <div class="modal-content py-3">
                    <div class="modal-header border-0 text-center d-block">
                        <i class="fa-solid fa-plus text-primary display-5"></i>
                        <h5 class="modal-title mt-2" id="createRoomModal">Add Room</h5>
                    </div>
                    <div class="modal-body text-center">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <label for="roomQuantity" class="form-label">How many rooms do we create?</label>
                                <input type="number" class="form-control @error('roomQuantity') is-invalid @enderror"
                                    id="roomQuantity" name="roomQuantity" min="1" value="1" required />
                                @error('roomQuantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                        <button type="button" class="btn btn-primary-soft text-primary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <header class="mt-n10 pt-10 bg-white border-bottom">
        <div class="container-xl px-4">
            <div class="page-header-content py-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <h1 class="d-flex text-primary mb-0">
                        <div class="nav-link-icon me-2">
                            <p class="mb-0"><i class="fa-solid fa-house-medical"></i></p>
                        </div>
                        <p class="mb-0">Pet Lodge</p>
                    </h1>
                    <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoomModal"><i
                            class="fa-solid fa-plus me-2"></i>Create Room</div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-4">
        <div class="row gy-4">
            @foreach ($rooms as $room)
                <div class="col-md-4">
                    <div
                        class="card shadow-none h-100 border-start-lg
                        @if ($room->status === 1 || $room->status === 'Occupied') border-start-warning
                        @elseif ($room->status === 0 || $room->status === 'Available') border-start-success
                        @elseif ($room->status === 2 || $room->status === 'Maintenance') border-start-danger @endif
                        ">
                        <div class="row m-0 h-100">
                            <div class="col-md-2 p-3 border-end">
                                <i class="fa-solid fa-house-medical text-gray-400 w-100 h-100"></i>
                            </div>
                            <div class="col-md-10 p-0 d-flex flex-column justify-content-between">
                                <div class="py-3 px-3">
                                    <div class="justify-content-between d-flex mb-1">
                                        <p class="fw-600 text-lg text-dark mb-0">Room #{{ $room->id }}</p>
                                        <div class="">
                                            @if ($room->status === 1)
                                                <div class="badge bg-warning-soft text-warning rounded-pill">
                                                    Occupied
                                                </div>
                                            @elseif ($room->status === 0)
                                                <div class="badge bg-success-soft text-success rounded-pill">
                                                    Available
                                                </div>
                                            @elseif ($room->status === 2)
                                                <div class="badge bg-danger-soft text-danger rounded-pill">
                                                    Maintenance
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @php
                                        $petID = App\Models\RoomOccupant::where('room_id', $room->id)->orderBy('check_in', 'desc')->first();
                                        $pet = null;
                                        $owner = null;
                                        if ($petID !== null) {
                                            $pet = App\Models\Pets::where('id', $petID->pet_id)->first();
                                            $owner = App\Models\Clients::where('id', $pet->owner_ID)->first();
                                        }

                                    @endphp
                                    @if ($room->status === 2)
                                        <p class="mb-1 text-danger fw-600">Room is under maintenance</p>
                                    @elseif ($room->status === 0)
                                        <p class="mb-1 text-success fw-600">Room is available</p>
                                    @elseif ($room->status === 1)
                                        <p class="mb-1">Pet: <span
                                                class="text-primary fw-600">{{ $pet ? $pet->pet_name : '' }}</span>
                                        </p>
                                        <p class="mb-1">Pet Owner: <span
                                                class="text-primary fw-600">{{ $owner ? $owner->client_name : '' }}</span>
                                        </p>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center justify-content-between small border-top px-3 py-2">
                                    <a class="text-primary stretched-link"
                                        href="{{ route('lodge.view', ['id' => $room->id]) }}">Open</a>
                                    <div>
                                        <i class="fa-solid fa-angle-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        @if ($rooms->isEmpty())
            {{-- This will show if there are no rooms --}}
            <div class="d-flex justify-content-center align-items-center" style="height: 70vh;">
                <div class="text-center text-muted">
                    <i class="fa-solid fa-plus display-6 mb-2"></i>
                    <p class="mb-0">No rooms found. Set up a room <br> to accommodate pets in the lodge.</p>
                </div>
            </div>
        @endif 
    </div>
@endsection
@section('scripts')
@endsection
