@extends('layouts.master')

@section('title', 'Student Report')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Student Report</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <span class="text-secondary-light">/ Reports / Students</span>
        </div>
    </div>
</div>

{{-- Filters --}}
<div class="card mb-24">
    <div class="card-body p-20">
        <form method="GET" action="{{ route('reports.students') }}" class="row gy-3 align-items-end">
            <div class="col-md-3">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Class</label>
                <select name="class_id" class="form-control form-select">
                    <option value="">All Classes</option>
                    @foreach($classes as $c)
                        <option value="{{ $c->id }}" {{ request('class_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Batch</label>
                <select name="batch_id" class="form-control form-select">
                    <option value="">All Batches</option>
                    @foreach($batches as $b)
                        <option value="{{ $b->id }}" {{ request('batch_id') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Status</label>
                <select name="status" class="form-control form-select">
                    <option value="">All</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary-600 w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header border-bottom py-16 px-24 d-flex justify-content-between align-items-center">
        <h6 class="text-lg fw-semibold mb-0">Students ({{ $students->total() }})</h6>
        <button onclick="window.print()" class="btn btn-sm btn-outline-primary-600 px-16 py-6 radius-6">
            <i class="ri-printer-line"></i> Print
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table bordered-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Admission No</th>
                        <th>Class</th>
                        <th>Batch</th>
                        <th>Phone</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $i => $s)
                    <tr>
                        <td>{{ $students->firstItem() + $i }}</td>
                        <td>{{ $s->first_name }} {{ $s->last_name }}</td>
                        <td>{{ $s->admission_no }}</td>
                        <td>{{ $s->studentClass->name ?? 'N/A' }}</td>
                        <td>{{ $s->batch->name ?? 'N/A' }}</td>
                        <td>{{ $s->phone ?: '—' }}</td>
                        <td>
                            @if($s->status == 'active')
                                <span class="bg-success-100 text-success-600 px-12 py-4 radius-4 fw-medium text-sm">Active</span>
                            @else
                                <span class="bg-danger-100 text-danger-600 px-12 py-4 radius-4 fw-medium text-sm">Inactive</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-24 text-secondary-light">No students found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-20 py-12">
            {{ $students->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection
