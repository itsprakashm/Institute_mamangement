@extends('layouts.master')

@section('title', 'My Attendance')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">My Attendance</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <a href="{{ route('student-portal.dashboard', ['student_id' => $student->id]) }}" class="text-secondary-light hover-text-primary hover-underline"> / Student Portal</a>
            <span class="text-secondary-light">/ Attendance</span>
        </div>
    </div>
</div>

{{-- Student Selector --}}
<div class="card mb-24">
    <div class="card-body p-20">
        <form method="GET" action="{{ route('student-portal.attendance') }}" class="row gy-3 align-items-end">
            <div class="col-md-4">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Select Student</label>
                <select name="student_id" class="form-control form-select" required>
                    <option value="" disabled {{ !request('student_id') ? 'selected' : '' }}>Choose Student</option>
                    @foreach($students as $s)
                        <option value="{{ $s->id }}" {{ request('student_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->first_name }} {{ $s->last_name }} ({{ $s->admission_no }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">From</label>
                <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
            </div>
            <div class="col-md-3">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">To</label>
                <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary-600 w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

@if(isset($student))
{{-- Summary --}}
<div class="row gy-4 mb-24">
    <div class="col-sm-4">
        <div class="card text-center p-20 border-start border-success border-4">
            <h4 class="fw-bold text-success-600">{{ $totalPresent }}</h4>
            <span class="text-sm text-secondary-light">Present</span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card text-center p-20 border-start border-danger border-4">
            <h4 class="fw-bold text-danger-600">{{ $totalAbsent }}</h4>
            <span class="text-sm text-secondary-light">Absent</span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card text-center p-20 border-start border-warning border-4">
            <h4 class="fw-bold text-warning-600">{{ $totalLate }}</h4>
            <span class="text-sm text-secondary-light">Late</span>
        </div>
    </div>
</div>

{{-- Records Table --}}
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table bordered-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $i => $rec)
                    <tr>
                        <td>{{ $records->firstItem() + $i }}</td>
                        <td>{{ \Carbon\Carbon::parse($rec->date)->format('d M Y (l)') }}</td>
                        <td>
                            @if($rec->status == 'present')
                                <span class="bg-success-100 text-success-600 px-16 py-4 radius-4 fw-medium text-sm">Present</span>
                            @elseif($rec->status == 'absent')
                                <span class="bg-danger-100 text-danger-600 px-16 py-4 radius-4 fw-medium text-sm">Absent</span>
                            @else
                                <span class="bg-warning-100 text-warning-600 px-16 py-4 radius-4 fw-medium text-sm">Late</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-24 text-secondary-light">No attendance records found.</td>
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
@endif

@endsection
