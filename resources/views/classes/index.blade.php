@extends('layouts.master')

@section('title', 'Class List')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Class List</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <span class="text-secondary-light">/ Class List</span>
        </div>
    </div>
    <a href="{{ route('classes.create') }}" class="btn btn-primary-600 d-flex align-items-center gap-6 ">
        <span class="d-flex text-md">
            <i class="ri-add-large-line"></i>
        </span>
        Add Class
    </a>
</div>

<div class="mt-24">
    <div class="card h-100">
        <div class="card-body p-0 dataTable-wrapper">

            @if(session('success'))
            <div class="alert alert-success m-3">
                {{ session('success') }}
            </div>
            @endif

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-16 px-20 py-12 border-bottom border-neutral-200">
                <div class="d-flex flex-wrap align-items-center gap-16">
                    <form class="navbar-search dt-search m-0">
                        <input type="text" class="dt-input bg-transparent radius-4" aria-controls="dataTable"
                            name="search" placeholder="Search...">
                        <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                    </form>
                </div>
            </div>

            <div class="p-0 table-responsive">
                <table class="table bordered-table mb-0 data-table" id="dataTable" data-page-length='10'>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Class Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $class)
                        <tr>
                            <td>{{ $class->id }}</td>
                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $class->name }}</h6></td>
                            <td>{{ $class->description }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="text-primary-light text-xl" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                        <iconify-icon icon="tabler:dots-vertical"></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-lg-end border p-12">
                                        <li>
                                            <a href="{{ route('classes.edit', $class->id) }}" class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2 py-6">
                                                <i class="ri-edit-2-line"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('classes.destroy', $class->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this class?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2 py-6">
                                                    <i class="ri-delete-bin-6-line"></i> Delete
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

            <div class="px-20 py-12">
                {{ $classes->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>

@endsection
