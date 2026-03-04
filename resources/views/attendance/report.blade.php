@extends('layouts.master')

@section('title', 'Attendance Report')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Attendance Report</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <span class="text-secondary-light">/ Attendance / Report</span>
        </div>
    </div>
    <a href="{{ route('attendance.mark') }}" class="btn btn-primary-600 d-flex align-items-center gap-6">
        <i class="ri-edit-line"></i> Mark Attendance
    </a>
</div>

{{-- Filter Form --}}
<div class="card mb-24">
    <div class="card-body p-20">
        <form method="GET" action="{{ route('attendance.report') }}" class="row gy-3 align-items-end">
            <div class="col-md-4">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Filter by Batch</label>
                <select name="batch_id" class="form-control form-select">
                    <option value="">All Batches</option>
                    @foreach($batches as $b)
                        <option value="{{ $b->id }}" {{ request('batch_id') == $b->id ? 'selected' : '' }}>
                            {{ $b->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">From Date</label>
                <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
            </div>
            <div class="col-md-3">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">To Date</label>
                <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary-600 w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table bordered-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Batch</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $i => $record)
                    <tr>
                        <td>{{ $records->firstItem() + $i }}</td>
                        <td>{{ $record->student->first_name ?? 'N/A' }} {{ $record->student->last_name ?? '' }}</td>
                        <td>{{ $record->batch->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}</td>
                        <td>
                            @if($record->status == 'present')
                                <span class="bg-success-100 text-success-600 px-16 py-4 radius-4 fw-medium text-sm">Present</span>
                            @elseif($record->status == 'absent')
                                <span class="bg-danger-100 text-danger-600 px-16 py-4 radius-4 fw-medium text-sm">Absent</span>
                            @else
                                <span class="bg-warning-100 text-warning-600 px-16 py-4 radius-4 fw-medium text-sm">Late</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-24 text-secondary-light">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-20 py-12">
            {{ $records->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection
