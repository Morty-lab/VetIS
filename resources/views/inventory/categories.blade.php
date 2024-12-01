@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<!-- Modals -->

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('categories.add') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Category</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="small mb-1" for="inputCategory">Category Name</label>
                        <input class="form-control" id="inputCategory" type="text" placeholder="Category Name"
                            value="" name="category_name">
                    </div>

                </div>
                <div class="modal-footer"><button class="btn btn-secondary" type="button"
                        data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Add
                        Category</button></div>
            </form>
        </div>
    </div>
</div>

@foreach ($categories as $item)
<!-- View Category Modal -->
<div class="modal fade" id="viewCategoryModal{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <p>{{ $item->category_name }}</p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary mb-1" data-bs-toggle="modal"
                    data-bs-target="#editCategoryModal{{ $item->id }}">Edit Category</button>
                <button class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#confirmDeleteModal{{ $item->id }}">Delete
                    Category</button>
            </div>

        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('categories.update', $item->id) }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Category</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf
                    <div class="mb-3">
                        <label class="small mb-1" for="inputCategoryName">Category Name</label>
                        <input class="form-control" id="inputCategoryName" type="text"
                            placeholder="Category Name" value="{{ $item->category_name }}" name="category_name">
                    </div>

                </div>
                <div class="modal-footer"><button class="btn btn-secondary" type="button"
                        data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Edit
                        Category</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Delete Category</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <span class="text-primary">{{ $item->category_name }}</span>
                    category?</p>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button"
                    data-bs-dismiss="modal">Cancel</button><a href="{{ route('categories.delete', $item->id) }}"
                    class="btn btn-danger">Delete
                    Category</a></div>
        </div>

    </div>
</div>
@endforeach

@include('inventory.general.header', ['title' => 'Categories'], ['icon' => '<i class="fa-solid fa-tags"></i>'])

<div class="container-xl px-4 mt-4">
    <div class="card mb-4 shadow-none">
        <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Category List</span>
            <button class="btn btn-primary justify-end" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add
                Category Type</button>
        </div>
        <div class="card-body">
            <table id="inventoryCategoryTable">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $i)
                    <tr>
                        <td>{{ $i->category_name }}</td>
                        <td>
                            <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                data-bs-toggle="modal"
                                data-bs-target="#viewCategoryModal{{ $i->id }}"><i
                                    data-feather="more-vertical"></i></button>
                            <button class="btn btn-datatable btn-icon btn-transparent-dark"
                                data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal{{ $i->id }}"><i
                                    data-feather="trash-2"></i></button>
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