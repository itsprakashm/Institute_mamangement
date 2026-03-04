@extends('layouts.master')

@section('title', 'Subject List')

@section('content')




        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">

            <div class="">



        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <div class="">
                <h1 class="fw-semibold mb-4 h6 text-primary-light">Subjects List </h1>
                <div class="">
                    <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
                    <span class="text-secondary-light">/ Subjects List </span>
                </div>
            </div>
            <button type="button" class="btn btn-primary-600 d-flex align-items-center gap-6" data-bs-toggle="modal" data-bs-target="#addModal">
                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>
                Add Subject
            </button>
        </div>

        <div class="mt-24">
            <div class="card h-100">
                <div class="card-body p-0 dataTable-wrapper">

                    <div
                        class="d-flex align-items-center justify-content-between flex-wrap gap-16 px-20 py-12 border-bottom border-neutral-200">
                        <div class="d-flex flex-wrap align-items-center gap-16">
                            <div class="dropdown">
                                <button type="button"
                                    class="px-12 py-5-px border border-neutral-300 radius-8 d-flex align-items-center gap-20 "
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-flex align-items-center gap-1 text-secondary-light text-sm">
                                        <i class="ri-file-upload-line text-md line-height-1"></i>
                                        Export
                                    </span>
                                    <span class="">
                                        <i class="ri-arrow-down-s-line"></i>
                                    </span>
                                </button>
                                <ul class="dropdown-menu p-12 border bg-base shadow">
                                    <li>
                                        <button type="button"
                                            class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10"
                                            data-bs-toggle="modal" data-bs-target="#exampleModalView">
                                            <i class="ri-file-3-line"></i>
                                            PDF
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button"
                                            class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10"
                                            data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                            <i class="ri-file-excel-line"></i>
                                            Excel
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <form class="navbar-search dt-search m-0">
                                <input type="text" class="dt-input bg-transparent radius-4" aria-controls="dataTable"
                                    name="search" placeholder="Search...">
                                <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                            </form>
                        </div>
                        <div class="d-flex align-items-center gap-8 text-secondary-light">
                            <span class="">
                                Rows per page:
                            </span>
                            <div class="dt-length">
                                <select name="dataTable_length" aria-controls="dataTable"
                                    class="dt-input form-control form-select">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="p-0">
                        <table class="table bordered-table mb-0 data-table" id="dataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="form-check style-check d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">
                                                S.L
                                            </label>
                                        </div>
                                    </th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subjects as $key => $subject)
                                <tr>
                                    <td>
                                        <div class="form-check style-check d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">
                                                {{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->code ?? 'N/A' }}</td>
                                    <td> 
                                        @if($subject->is_active)
                                            <span class="bg-success-100 text-success-600 px-24 py-4 radius-4 fw-medium text-sm">Active</span>
                                        @else
                                            <span class="bg-danger-100 text-danger-600 px-24 py-4 radius-4 fw-medium text-sm">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="text-primary-light text-xl"
                                                data-bs-toggle="dropdown" data-bs-display="static"
                                                aria-expanded="false">
                                                <iconify-icon icon="tabler:dots-vertical"></iconify-icon>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-lg-end border p-12">
                                                <li>
                                                    <button type="button"
                                                        class="edit-btn dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2 py-6"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-id="{{ $subject->id }}"
                                                        data-name="{{ $subject->name }}"
                                                        data-code="{{ $subject->code }}"
                                                        data-active="{{ $subject->is_active }}">
                                                        <i class="ri-edit-2-line"></i>
                                                        Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class="dropdown-item rounded text-danger bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-2 py-6"
                                                            type="submit" onclick="return confirm('Are you sure you want to delete this subject?')">
                                                            <i class="ri-delete-bin-6-line"></i>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Subject</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('subjects.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Subject Name</label>
                                <input type="text" name="name" class="form-control" required placeholder="e.g. Physics, Chemistry">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Code</label>
                                <input type="text" name="code" class="form-control" placeholder="e.g. PHY101">
                            </div>
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <button type="button" class="btn btn-secondary bg-neutral-200 text-neutral-900" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary-600">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Subject</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Subject Name</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Code</label>
                                <input type="text" name="code" id="edit_code" class="form-control">
                            </div>
                            <div class="mb-3 form-switch d-flex align-items-center gap-2">
                                <input class="form-check-input mt-0" type="checkbox" role="switch" id="edit_active" name="is_active" value="1">
                                <label class="form-check-label fw-semibold" for="edit_active">Active</label>
                            </div>
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <button type="button" class="btn btn-secondary bg-neutral-200 text-neutral-900" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary-600">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('page-scripts')
<script>
    let table = new DataTable('#dataTable');

    // ✅ Data Table start
    $('.data-table').each(function () {
        const $table = $(this);
        const tableInstance = new DataTable(this);

        // Handle search input (inside same wrapper)
        $table.closest('.dataTable-wrapper').find('.dt-search .dt-input').on('keyup', function () {
            tableInstance.search(this.value).draw();
        });

        // Handle page length change (inside same wrapper)
        $table.closest('.dataTable-wrapper').find('.dt-length .dt-input').on('change', function () {
            const value = $(this).val();
            tableInstance.page.len(value).draw();
        });
    });
    // ✅ Data Table end

    // ✅ Edit Modal populate
    $('.edit-btn').on('click', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const code = $(this).data('code');
        const active = $(this).data('active');

        $('#edit_name').val(name);
        $('#edit_code').val(code);
        $('#edit_active').prop('checked', active == 1 || active == true);

        const formAction = `{{ route('subjects.update', '') }}/${id}`;
        $('#editForm').attr('action', formAction);
    });

</script>
@endsection
