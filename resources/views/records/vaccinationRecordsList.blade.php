@extends('layouts.app')

@section('styles')
@endsection

@section('content')

    {{--  Create Medical Record Modal  --}}
    <div class="modal fade" id="addMedicalRecord" tabindex="-1" role="dialog" aria-labelledby="addMedicalRecord" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('records.medical.create') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Create Vaccination Record<span
                                class="text-primary"></span></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gy-3">
                            <div class="col-md-12">
                                <label for="" class="mb-1">Type of Vaccination</label>
                                <select name="vaccinationType" id="vac-type"
                                        class="form-select attending-vet-med-rec"
                                        data-placeholder="Select Vaccination Type">
                                    <option value=""></option>
                                    <!-- For Dogs -->
                                    <optgroup label="For Dogs">
                                        <option value="anti_rabies_dog">Anti-Rabies Vaccine</option>
                                        <option value="5in1_dog">Canine 5-in-1 Vaccine (DHPPI)</option>
                                        <option value="6in1_dog">Canine 6-in-1 Vaccine (DHPPI + Lepto)</option>
                                        <option value="8in1_dog">Canine 8-in-1 Vaccine (DHPPI + Lepto + Corona)</option>
                                        <option value="kennel_cough">Kennel Cough Vaccine (Bordetella)</option>
                                    </optgroup>

                                    <!-- For Cats -->
                                    <optgroup label="For Cats">
                                        <option value="anti_rabies_cat">Anti-Rabies Vaccine</option>
                                        <option value="3in1_cat">Feline 3-in-1 Vaccine (FVRCP)</option>
                                        <option value="4in1_cat">Feline 4-in-1 Vaccine (FVRCP + Chlamydia)</option>
                                        <option value="feline_leukemia">Feline Leukemia Vaccine (FeLV)</option>
                                        <option value="fip_vaccine">Feline Infectious Peritonitis Vaccine (FIP)</option>
                                    </optgroup>
                                </select>
                                @error('petOwner')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="petOwner">Pet Owner</label>
                                <select name="petOwner" id="client_id"
                                        class="form-select attending-vet-med-rec @error('petOwner') is-invalid @enderror"
                                        onchange="fetchOwnedPetsForMedRec(this.value)" data-placeholder="Select Pet Owner">
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
                            <div class="col-md-6">
                                <label for="pet">Pet</label>
                                <select name="pet" id="pet_id"
                                        class="form-select pet-med-rec @error('pet') is-invalid @enderror"
                                        data-placeholder="Select Pet" disabled>
                                    <option value=""></option>
                                </select>
                                @error('pet')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" id="addVaccinationBtn">Create Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @include('components.header', ['title' => 'Vaccination Records'], ['icon' => '<i class="fa-solid fa-syringe"></i>'])
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="card shadow-none">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Vaccination Records</span>
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary justify-end" data-bs-toggle="modal" data-bs-target="#addMedicalRecord" href="javascript:void(0)">
                        <i class="fa-solid fa-plus me-2"></i> Create Vaccination Record
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-link text-muted p-0 ms-3" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <div class="dropdown-divider"></div>
                            <div><a class="dropdown-item" href="{{route('pet.archive')}}"><i class="fa-solid fa-box-archive me-2"></i> Vaccination Records Archive</a></div>
                        </ul>
                    </div>
                </div>
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
                                @endif
                            </td>
                            <td>
                                <a href="" class="btn btn-datatable btn-primary px-5 py-3">View</a>
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
    <script>

        function fetchOwnedPetsForMedRec(ownerID) {
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

        $(".attending-vet-med-rec").select2({
            theme: "bootstrap-5",
            dropdownParent: "#addMedicalRecord",
            width: $(this).data("width")
                ? $(this).data("width")
                : $(this).hasClass("w-100")
                    ? "100%"
                    : "style",
            placeholder: $(this).data("placeholder"),
        });

        $(".pet-owner-med-rec").select2({
            theme: "bootstrap-5",
            dropdownParent: "#addMedicalRecord",
            width: $(this).data("width")
                ? $(this).data("width")
                : $(this).hasClass("w-100")
                    ? "100%"
                    : "style",
            placeholder: $(this).data("placeholder"),
        });

        $(".pet-med-rec").select2({
            theme: "bootstrap-5",
            dropdownParent: "#addMedicalRecord",
            width: $(this).data("width")
                ? $(this).data("width")
                : $(this).hasClass("w-100")
                    ? "100%"
                    : "style",
            placeholder: $(this).data("placeholder"),
        });
    </script>
@endsection
