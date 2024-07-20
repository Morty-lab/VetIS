@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<!-- Modals -->

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Category</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputCategory">Category Name</label>
                        <input class="form-control" id="inputCategory" type="text" placeholder="Category Name" value="">
                    </div>
                </form>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Add Category</button></div>
        </div>
    </div>
</div>

<!-- View Category Modal -->
<div class="modal fade" id="viewCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Category Info</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3 px-1">
                        <label class="small mb-1" for="inputProductName">Category Type</label>
                        <p>Flea Treatment</p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary mb-1" data-bs-toggle="modal" data-bs-target="#editCategoryModal">Edit Category</button>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete Category</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Category</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputCategoryName">Category Name</label>
                        <input class="form-control" id="inputCategoryName" type="text" placeholder="Category Name" value="Flea Treatment">
                    </div>
                </form>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Edit Category</button></div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Delete Category</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <span class="text-primary">Flea Treatment</span> category?</p>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-danger" type="button">Delete Category</button></div>
        </div>
    </div>
</div>



<div class="container-xl px-4 mt-4">
    <div class="card mb-4">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Category List</span>
            <button class="btn btn-primary justify-end" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category Type</button>
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
                        <input class="datatable-input" placeholder="Search..." type="search" name="search" title="Search within table" aria-controls="datatablesSimple">
                    </div>
                </div>
                <div class="datatable-container">
                    <table class="datatable-table">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Flea Treatment</td>
                                <td>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2" data-bs-toggle="modal" data-bs-target="#viewCategoryModal"><i data-feather="more-vertical"></i></button>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"><i data-feather="trash-2"></i></button>
                                </td>
                            </tr>
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