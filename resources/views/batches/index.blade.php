@extends('layouts.master')

@section('title', 'Batch List')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Batch List</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <span class="text-secondary-light">/ Batch List</span>
        </div>
    </div>
    <a href="{{ route('batches.create') }}" class="btn btn-primary-600 d-flex align-items-center gap-6">
        <span class="d-flex text-md"><i class="ri-add-large-line"></i></span>
        Add Batch
    </a>
</div>

<div class="mt-24">
    <div class="card h-100">
        <div class="card-body p-0 dataTable-wrapper">

            @if(session('success'))
            <div class="alert alert-success m-3">{{ session('success') }}</div>
            @endif

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-16 px-20 py-12 border-bottom border-neutral-200">
                <form class="navbar-search dt-search m-0">
                    <input type="text" class="dt-input bg-transparent radius-4" name="search" placeholder="Search...">
                    <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                </form>
            </div>

            <div class="p-0 table-responsive">
                <table class="table bordered-table mb-0 data-table" id="dataTable" data-page-length='10'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Batch Name</th>
                            <th>Class</th>
                            <th>Teacher</th>
                            <th>Timing</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($batches as $batch)
                        <tr>
                            <td>{{ $batch->id }}</td>
                            <td><h6 class="text-md mb-0 fw-medium">{{ $batch->name }}</h6></td>
                            <td>{{ $batch->studentClass->name ?? 'N/A' }}</td>
                            <td>{{ $batch->teacher->name ?? 'Not Assigned' }}</td>
                            <td>
                                @if($batch->start_time && $batch->end_time)
                                    {{ \Carbon\Carbon::parse($batch->start_time)->format('h:i A') }} – {{ \Carbon\Carbon::parse($batch->end_time)->format('h:i A') }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($batch->is_active)
                                    <span class="bg-success-100 text-success-600 px-24 py-4 radius-4 fw-medium text-sm">Active</span>
                                @else
                                    <span class="bg-danger-100 text-danger-600 px-24 py-4 radius-4 fw-medium text-sm">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="text-primary-light text-xl" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                        <iconify-icon icon="tabler:dots-vertical"></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-lg-end border p-12">
                                        <li>
                                            <a href="{{ route('batches.edit', $batch->id) }}" class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2 py-6">
                                                <i class="ri-edit-2-line"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('batches.destroy', $batch->id) }}" method="POST" onsubmit="return confirm('Delete this batch?');">
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

                {{ $batches->links() }}

        </div>
    </div>
</div>

@endsection
