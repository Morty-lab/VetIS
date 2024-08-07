@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- Modals -->

    <!-- Add Supplier Modal -->
    <div class="modal fade" id="addUnitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('units.add') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Unit</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUnitType">Unit Type</label>
                            <input class="form-control" id="inputUnitType" type="text" placeholder="Unit Type"
                                value="" name="unit_name">
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-secondary" type="button"
                            data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Add Unit
                            Type</button></div>
                </form>

            </div>
        </div>
    </div>

    @foreach ($units as $unit)
        <!-- View Unit Modal -->
        <div class="modal fade" id="viewUnitModal{{ $unit->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Unit Type Info</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3 px-1">
                                <label class="small mb-1" for="inputProductName">Unit Type</label>
                                <p>{{ $unit->unit_name }}</p>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary mb-1" data-bs-toggle="modal"
                            data-bs-target="#editSupplierModal">Edit Unit</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete
                            Unit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Supplier Modal -->
        <div class="modal fade" id="editSupplierModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('units.update', $unit->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Unit</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUnitType">Unit Type</label>
                                <input class="form-control" id="inputUnitType" type="text" placeholder="Unit Type"
                                    value="{{ $unit->unit_name }}" name="unit_name">
                            </div>
                        </div>
                        <div class="modal-footer"><button class="btn btn-secondary" type="button"
                                data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Edit
                                Unit Type</button></div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="confirmDeleteModal{{ $unit->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Unit</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the unit <span
                                class="text-primary">"{{ $unit->unit_name }}"</span>?</p>
                    </div>
                    <div class="modal-footer"><button class="btn btn-primary" type="button"
                            data-bs-dismiss="modal">Cancel</button><a href="{{ route('units.delete', $unit->id) }}"
                            class="btn btn-danger" type="button">Delete
                            Unit</a></div>
                </div>
            </div>
        </div>
    @endforeach



    <div class="container-xl px-4 mt-4">
        <div class="card mb-4">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Units List</span>
                <button class="btn btn-primary justify-end" data-bs-toggle="modal" data-bs-target="#addUnitModal">Add
                    Unit Type</button>
            </div>
            <div class="card-body">
                <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                    <div class="datatable-top">
                        <div class="datatable-dropdown">
                            <label>
                                <select class="datatable-selector" name="per-page">
                                    <option value="5">5</option>
                                    <option value="10" selected="">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                </select> entries per page
                            </label>
                        </div>
                        <div class="datatable-search">
                            <input class="datatable-input" placeholder="Search..." type="search" name="search"
                                title="Search within table" aria-controls="datatablesSimple">
                        </div>
                    </div>
                    <div class="datatable-container">
                        <table class="datatable-table">
                            <thead>
                                <tr>
                                    <th>Unit Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($units as $unit)
                                    <tr>
                                        <td>{{ $unit->unit_name }}</td>
                                        <td>
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewUnitModal{{ $unit->id }}"><i
                                                    data-feather="more-vertical"></i></button>
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal{{ $unit->id }}"><i
                                                    data-feather="trash-2"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
