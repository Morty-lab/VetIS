@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- Check In -->
    <div class="modal fade" id="checkInModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('lodge.checkIn') }}" method="POST">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title">Check-In Pet</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gy-3">
                            <div class="col-md-12">
                                <label for="petOwner">Pet Owner</label>
                                <select name="petOwner" id="client_id"
                                    class="form-select pet-owner-lodge @error('petOwner') is-invalid @enderror"
                                    onchange="fetchOwnedPetsForLodge(this.value)" data-placeholder="Select Pet Owner">
                                    <option value=""></option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}"
                                            {{ old('petOwner') == $client->id ? 'selected' : '' }}>
                                            {{ $client->client_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('petOwner')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="pet">Pet</label>
                                <select name="pet" id="pet_id"
                                    class="form-select pet-lodge @error('pet') is-invalid @enderror"
                                    data-placeholder="Select Pet" disabled>
                                    <option value=""></option>
                                </select>
                                @error('pet')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-primary-soft text-primary" type="button"
                            data-bs-dismiss="modal">Close</button> <button class="btn btn-primary">Check-In</button></div>
                </form>
            </div>
        </div>
    </div>

    {{-- Check Out --}}
    @if ($room->status === 1)
        @php
            $petID = App\Models\RoomOccupant::where('room_id', $room->id)->where('check_out', null)->first();

            $pet = App\Models\Pets::where('id', $petID->pet_id)->first();
            $owner = App\Models\Clients::where('id', $pet->owner_ID)->first();
        @endphp
        <div class="modal fade" id="checkOutModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('lodge.checkOut', ['room_id' => $room->id, 'occupant_id' => $petID->id]) }}"
                        method="POST">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title">Check-Out Pet</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <div class="icon mb-3"><i class="fa-solid fa-right-from-bracket fa-2x"></i></div>
                            Are you sure you want to <strong>Check-Out</strong> {{ $pet->pet_name }}?
                        </div>
                        <div class="modal-footer"><button class="btn btn-primary-soft text-primary" type="button"
                                data-bs-dismiss="modal">Close</button> <button class="btn btn-primary">Check-Out</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- Delete Room --}}

    <div class="modal fade" id="deleteRoomModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Room</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="icon mb-3"><i class="fa-solid fa-trash fa-2x"></i></div>
                    Are you sure you want to <strong>delete</strong> this room?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('lodge.delete', ['room_id' => $room->id]) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary-soft text-primary" type="button"
                            data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Set Under Maintenance --}}
    <div class="modal fade" id="setRoomUnderMaintenanceModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('lodge.setUnderMaintenance', ['room_id' => $room->id]) }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Set Under Maintenance</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="icon mb-3"><i class="fa-solid fa-tools fa-2x"></i></div>
                        Are you sure you want to <strong>set</strong> this room under
                        maintenance?
                    </div>
                    <div class="modal-footer"><button class="btn btn-primary-soft text-primary" type="button"
                            data-bs-dismiss="modal">Close</button> <button class="btn btn-primary">Set Under
                            Maintenance</button></div>
                </form>
            </div>
        </div>
    </div>


    {{-- Maintenance Done --}}


    <div class="modal fade" id="maintenanceDoneModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('lodge.maintenanceDone', ['room_id' => $room->id]) }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Maintenance Done</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="icon mb-3"><i class="fa-solid fa-check fa-2x"></i></div>
                        Are you sure you want to <strong>mark</strong> this room as maintenance
                        done?
                    </div>
                    <div class="modal-footer"><button class="btn btn-primary-soft text-primary" type="button"
                            data-bs-dismiss="modal">Close</button> <button class="btn btn-primary">Maintenance
                            Done</button></div>
                </form>
            </div>
        </div>
    </div>




    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content d-flex justify-content-between align-items-center">
                <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('lodge.index') }}">Pet Lodge</a></li>
                        <li class="breadcrumb-item active">Room Details</li>
                    </ol>
                </nav>

                <div class="dropdown">
                    <button class="btn btn-link text-muted p-0 ms-3" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-divider"></div>
                        <div>
                            @if ($room->status !== 2)
                                <div class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#setRoomUnderMaintenanceModal"> <i class="fa-solid fa-tools me-2"></i>
                                    Set Under Maintenance</div>
                            @else
                                <div class="dropdown-item" data-bs-toggle="modal" data-bs-target="#maintenanceDoneModal">
                                    <i class="fa-solid fa-check me-2"></i> Maintenance Done</div>
                            @endif

                            <div class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteRoomModal"> <i
                                    class="fa-solid fa-trash me-2"></i> Delete Room</div>


                        </div>
                    </ul>
                </div>

            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-4 justify-content-center d-flex">
        <div class="w-75">
            <div class="row gy-3">
                <div class="col-md-12">
                    <div
                        class="card shadow-none
                @if ($room->status === 1 || $room->status === 'Occupied') border-start-warning
                @elseif ($room->status === 0 || $room->status === 'Available') border-start-success
                @elseif ($room->status === 2 || $room->status === 'Maintenance') border-start-danger @endif
                ">
                        <div class="card-body p-0">
                            <div class="row m-0">
                                <div class="col-md-1 border-end px-5 d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-house-medical text-gray-400 fa-2x"></i>
                                </div>
                                <div class="col-md-10">
                                    <div class="d-flex justify-content-between w-100">
                                        <div class="p-3">
                                            <div class="label">Room</div>
                                            <div class="text-primary">Room #{{ $room->id }}</div>
                                        </div>
                                        <div class="col-md-4 p-3">
                                            <div class="label">Room Status</div>
                                            @if ($room->status === 1)
                                                <div class="badge bg-warning-soft text-warning rounded-pill text-sm">
                                                    Occupied</div>
                                            @elseif ($room->status === 0)
                                                <div class="badge bg-success-soft text-success rounded-pill text-sm">
                                                    Available</div>
                                            @elseif ($room->status === 2)
                                                <div class="badge bg-danger-soft text-danger rounded-pill text-sm">
                                                    Maintenance</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card shadow-none">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            Occupant Details
                            <div class="buttons">
                                @if ($room->status === 0)
                                    <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkInModal"><i
                                            class="fa-solid fa-plus me-2"></i>Check In</div>
                                @elseif ($room->status === 1)
                                    <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkOutModal">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i>Check Out
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row gy-3">
                                @if ($room->status === 1)
                                    @php
                                        $petID = App\Models\RoomOccupant::where('room_id', $room->id)->first();

                                        $pet = App\Models\Pets::where('id', $petID->pet_id)->first();
                                        $owner = App\Models\Clients::where('id', $pet->owner_ID)->first();

                                    @endphp
                                    <div class="col-md-6">
                                        <div class="row gy-2">
                                            <div class="col-md-12">
                                                <div class="label">Pet</div>
                                                @if ($pet)
                                                    <div class="text-primary">{{ $pet->pet_name }}</div>
                                                @else
                                                    <div class="text-primary">No Pet Assigned</div>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div class="label">Pet Owner</div>
                                                @if ($pet && $owner)
                                                    <div class="text-primary">{{ $owner->client_name }}</div>
                                                @else
                                                    <div class="text-primary">No Pet Owner Assigned</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row gy-2">
                                            <div class="col-md-12">
                                                <div class="label">Date of Check In</div>
                                                <div class="text-primary">
                                                    {{ \Carbon\Carbon::parse($room->check_in)->format('F j, Y') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @if ($room->status === 0)
                                        <div class="col-md-12 text-center">
                                            <div class="label">Room Status</div>
                                            <div class="badge bg-success-soft text-success rounded-pill text-sm">Room is
                                                Available</div>
                                        </div>
                                    @elseif ($room->status === 2)
                                        <div class="col-md-12 text-center">
                                            <div class="label">Room Status</div>
                                            <div class="badge bg-danger-soft text-danger rounded-pill text-sm">Room is in
                                                Maintenance</div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-4">
            <div class="card shadow-none">
                <div class="card-header">
                    Room History
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <th>Pet</th>
                            <th>Pet Owner</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Total Days Stayed</th>
                        </thead>
                        <tbody>
                            @php
                                $history = App\Models\RoomOccupant::where('room_id', $room->id)
                                    ->orderBy('check_in', 'desc')
                                    ->get();
                            @endphp
                            @foreach ($history as $item)
                                @php
                                    $pet = App\Models\Pets::where('id', $item->pet_id)->first();
                                    $owner = App\Models\Clients::where('id', $pet->owner_ID)->first();
                                @endphp
                                <tr>
                                    <td>{{ $pet->pet_name }}</td>
                                    <td>{{ $owner->client_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->check_in)->format('F j, Y') }}</td>
                                    <td>
                                        @if ($item->check_out)
                                            {{ \Carbon\Carbon::parse($item->check_out)->format('F j, Y') }}
                                        @else
                                            <span class="badge bg-warning-soft text-warning rounded-pill text-sm">Still
                                                Occupied</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->check_in)->diffInDays(\Carbon\Carbon::parse($item->check_out)) }}
                                        days</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function fetchOwnedPetsForLodge(ownerID) {
            let petSelect = $("#pet_id");
            petSelect.empty(); // Clear all options from the select

            $.ajax({
                url: "/api/pets",
                type: "GET",
                success: function(data) {
                    petSelect.append(new Option('Select Pet', '', true, true));
                    let pets = JSON.parse(data);
                    pets.forEach(function(pet) {
                        if (pet.owner_ID === Number(ownerID)) {
                            let petName = pet.pet_name;
                            let petID = pet.id;
                            petSelect.append(new Option(petName, petID, false, false));
                        }
                    });

                    let seen = {};
                    petSelect.find('option').each(function() {
                        let txt = $(this).text();
                        if (seen[txt]) {
                            $(this).remove();
                        } else {
                            seen[txt] = true;
                        }
                    });
                    petSelect.prop("disabled", false);
                    petSelect.trigger("change.select2");
                },
            });
        }

        $(".pet-owner-lodge").select2({
            theme: "bootstrap-5",
            dropdownParent: "#checkInModal",
            width: $(this).data("width") ?
                $(this).data("width") : $(this).hasClass("w-100") ?
                "100%" : "style",
            placeholder: $(this).data("placeholder"),
        });

        $(".pet-lodge").select2({
            theme: "bootstrap-5",
            dropdownParent: "#checkInModal",
            width: $(this).data("width") ?
                $(this).data("width") : $(this).hasClass("w-100") ?
                "100%" : "style",
            placeholder: $(this).data("placeholder"),
        });
    </script>
@endsection
