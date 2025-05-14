@extends('layouts.app')

@section('styles')
@endsection

@section('content')

  <!-- Check In -->
  <div class="modal fade" id="checkInModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
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
                                <option
                                    value="{{ $client->id }}" {{ old('petOwner') == $client->id ? 'selected' : '' }}>{{ $client->client_name }}</option>
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
              <div class="modal-footer"><button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Close</button> <button class="btn btn-primary">Check-In</button></div>
          </div>
      </div>
  </div>

  {{-- Check Out --}}

    <div class="modal fade" id="checkOutModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Check-Out Pet</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="icon mb-3"><i class="fa-solid fa-right-from-bracket fa-2x"></i></div>
                    Are you sure you want to <strong>Check-Out</strong> pet name?
                </div>
                <div class="modal-footer"><button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Close</button> <button class="btn btn-primary">Check-Out</button></div>
            </div>
        </div>
    </div>

    
  {{-- Delete Room --}}

  <div class="modal fade" id="deleteRoomModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <div class="modal-footer"><button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Close</button> <button class="btn btn-danger">Delete</button></div>
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
                <button class="btn btn-link text-muted p-0 ms-3" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <div class="dropdown-divider"></div>
                    <div><div class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#deleteRoomModal"> <i class="fa-solid fa-trash me-2"></i> Delete Room</div></div>
                </ul>
            </div>

        </div>
    </div>
</header>

<div class="container-xl px-4 mt-4 justify-content-center d-flex">
    <div class="w-75">
        <div class="row gy-3">
            <div class="col-md-12">
                <div class="card shadow-none border-start-lg border-start-warning">
                    <div class="card-body p-0">
                        <div class="row m-0">
                            <div class="col-md-1 border-end px-5 d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-house-medical text-gray-400 fa-2x"></i>
                            </div>
                            <div class="col-md-10">
                                <div class="d-flex justify-content-between w-100">
                                    <div class="p-3">
                                        <div class="label">Room</div>
                                        <div class="text-primary">Room #1</div>
                                    </div>
                                    <div class="col-md-4 p-3">
                                        <div class="label">Room Status</div>
                                        <div class="badge bg-warning-soft text-warning rounded-pill text-sm">Occupied</div>
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
                            <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkInModal"><i class="fa-solid fa-plus me-2"></i>Check In</div>
                            <div class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#checkOutModal"><i class="fa-solid fa-right-from-bracket me-2"></i>Check Out</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <div class="row gy-2">
                                    <div class="col-md-12">
                                        <div class="label">Pet</div>
                                        <div class="text-primary">Lexie</div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="label">Pet Owner</div>
                                        <div class="text-primary">Kent Invento</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row gy-2">
                                    <div class="col-md-12">
                                        <div class="label">Date of Check In</div>
                                        <div class="text-primary">August 11, 2025</div>
                                    </div>
                                </div>
                            </div>
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
                            <tr>
                                <td>Lexie</td>
                                <td>Kent Invento</td>
                                <td>August 11, 2025</td>
                                <td>August 15, 2025</td>
                                <td>4 days</td>
                            </tr>
                            <tr>
                                <td>Max</td>
                                <td>John Doe</td>
                                <td>July 1, 2025</td>
                                <td>July 5, 2025</td>
                                <td>4 days</td>
                            </tr>
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
            success: function (data) {
                petSelect.append(new Option('Select Pet', '', true, true));
                let pets = JSON.parse(data);
                pets.forEach(function (pet) {
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
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });

    $(".pet-lodge").select2({
        theme: "bootstrap-5",
        dropdownParent: "#checkInModal",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });
</script>
@endsection