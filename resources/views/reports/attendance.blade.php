@extends('layouts.master')

@section('title', 'Attendance Report')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Attendance Report</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <span class="text-secondary-light">/ Reports / Attendance</span>
        </div>
    </div>
</div>

{{-- Filters --}}
<div class="card mb-24">
    <div class="card-body p-20">
        <form method="GET" action="{{ route('reports.attendance') }}" class="row gy-3 align-items-end">
            <div class="col-md-4">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Batch <span class="text-danger-600">*</span></label>
                <select name="batch_id" class="form-control form-select" required>
                    <option value="" disabled {{ !request('batch_id') ? 'selected' : '' }}>Select Batch</option>
                    @foreach($batches as $b)
                        <option value="{{ $b->id }}" {{ request('batch_id') == $b->id ? 'selected' : '' }}>
                            {{ $b->name }} ({{ $b->studentClass->name ?? '' }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">From</label>
                <input type="date" name="from_date" class="form-control" value="{{ $fromDate }}">
            </div>
            <div class="col-md-3">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">To</label>
                <input type="date" name="to_date" class="form-control" value="{{ $toDate }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary-600 w-100">Generate</button>
            </div>
        </form>
    </div>
</div>

@if($records->count() > 0)
<div class="card">
    <div class="card-header border-bottom py-16 px-24 d-flex justify-content-between align-items-center">
        <h6 class="text-lg fw-semibold mb-0">Attendance Summary ({{ \Carbon\Carbon::parse($fromDate)->format('d M Y') }} — {{ \Carbon\Carbon::parse($toDate)->format('d M Y') }})</h6>
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
                        <th>Student</th>
                        <th class="text-success-600">Present</th>
                        <th class="text-danger-600">Absent</th>
                        <th class="text-warning-600">Late</th>
                        <th>Total Days</th>
                        <th>Attendance %</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $i => $rec)
                    @php
                        $pct = $rec->total > 0 ? round((($rec->present + $rec->late) / $rec->total) * 100, 1) : 0;
                    @endphp
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $rec->student->first_name }} {{ $rec->student->last_name }}</td>
                        <td>{{ $rec->present }}</td>
                        <td>{{ $rec->absent }}</td>
                        <td>{{ $rec->late }}</td>
                        <td>{{ $rec->total }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-8">
                                <div class="progress w-100" style="height: 6px;">
                                    <div class="progress-bar {{ $pct >= 75 ? 'bg-success' : ($pct >= 50 ? 'bg-warning' : 'bg-danger') }}"
                                         style="width: {{ $pct }}%"></div>
                                </div>
                                <span class="text-sm fw-medium">{{ $pct }}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@endsection
