@extends('layouts.master')

@section('title', 'Mark Attendance')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Mark Attendance</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <span class="text-secondary-light">/ Attendance / Mark</span>
        </div>
    </div>
    <a href="{{ route('attendance.report') }}" class="btn btn-outline-primary-600 d-flex align-items-center gap-6">
        <i class="ri-file-chart-line"></i> View Report
    </a>
</div>

{{-- Filter Form --}}
<div class="card mb-24">
    <div class="card-body p-20">
        <form method="GET" action="{{ route('attendance.mark') }}" class="row gy-3 align-items-end">
            <div class="col-md-4">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Select Batch <span class="text-danger-600">*</span></label>
                <select name="batch_id" class="form-control form-select" required>
                    <option value="" disabled {{ !request('batch_id') ? 'selected' : '' }}>Choose Batch</option>
                    @foreach($batches as $b)
                        <option value="{{ $b->id }}" {{ request('batch_id') == $b->id ? 'selected' : '' }}>
                            {{ $b->name }} ({{ $b->studentClass->name ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Date <span class="text-danger-600">*</span></label>
                <input type="date" name="date" class="form-control" value="{{ $selectedDate }}" required>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary-600 w-100">Load Students</button>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success mb-24">{{ session('success') }}</div>
@endif

{{-- Attendance Grid --}}
@if($selectedBatch && $students->count() > 0)
<form method="POST" action="{{ route('attendance.save') }}">
    @csrf
    <input type="hidden" name="batch_id" value="{{ $selectedBatch->id }}">
    <input type="hidden" name="date" value="{{ $selectedDate }}">

    <div class="card">
        <div class="card-header border-bottom py-16 px-24 d-flex align-items-center justify-content-between">
            <h6 class="text-lg fw-semibold mb-0">
                {{ $selectedBatch->name }} &mdash; {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}
            </h6>
            <span class="text-secondary-light text-sm">{{ $students->count() }} students</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table bordered-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Admission No</th>
                            <th>
                                <span class="text-success-600">Present</span>
                            </th>
                            <th>
                                <span class="text-danger-600">Absent</span>
                            </th>
                            <th>
                                <span class="text-warning-600">Late</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $i => $student)
                        @php $existing = $existingAttendance->get($student->id); @endphp
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td>{{ $student->admission_no }}</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                        name="attendance[{{ $student->id }}]"
                                        value="present"
                                        {{ (!$existing || $existing->status == 'present') ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                        name="attendance[{{ $student->id }}]"
                                        value="absent"
                                        {{ ($existing && $existing->status == 'absent') ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                        name="attendance[{{ $student->id }}]"
                                        value="late"
                                        {{ ($existing && $existing->status == 'late') ? 'checked' : '' }}>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer py-16 px-24 text-end">
            <button type="submit" class="btn btn-primary-600 px-32">Save Attendance</button>
        </div>
    </div>
</form>
@elseif($selectedBatch && $students->count() == 0)
    <div class="alert alert-warning">No active students found in this batch.</div>
@endif

@endsection
