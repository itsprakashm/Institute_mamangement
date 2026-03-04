@extends('layouts.master')

@section('title', 'Student Dashboard')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Student Dashboard</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <span class="text-secondary-light">/ Student Portal</span>
        </div>
    </div>
</div>

{{-- Student Selector --}}
<div class="card mb-24">
    <div class="card-body p-20">
        <form method="GET" action="{{ route('student-portal.dashboard') }}" class="row gy-3 align-items-end">
            <div class="col-md-8">
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
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary-600 w-100">Load Dashboard</button>
            </div>
        </form>
    </div>
</div>

@if(isset($student))
{{-- Summary Cards --}}
<div class="row gy-4 mb-24">
    <div class="col-xxl-3 col-sm-6">
        <div class="card px-24 py-18 shadow-none radius-8 border h-100 bg-gradient-start-1">
            <div class="card-body p-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-10 mb-0">
                    <div>
                        <h6 class="fw-semibold text-lg mb-1">{{ $student->first_name }} {{ $student->last_name }}</h6>
                        <span class="text-secondary-light text-sm">{{ $student->admission_no }}</span>
                    </div>
                    <div class="w-50-px h-50-px bg-primary-600 bg-opacity-10 d-flex justify-content-center align-items-center radius-8">
                        <iconify-icon icon="solar:user-bold-duotone" class="text-primary-600 text-2xl"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-6">
        <div class="card px-24 py-18 shadow-none radius-8 border h-100 bg-gradient-start-2">
            <div class="card-body p-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-10 mb-0">
                    <div>
                        <h6 class="fw-semibold text-lg mb-1">{{ ($attendanceSummary['present'] ?? 0) + ($attendanceSummary['late'] ?? 0) }} / {{ array_sum($attendanceSummary) }}</h6>
                        <span class="text-secondary-light text-sm">Attendance (30 Days)</span>
                    </div>
                    <div class="w-50-px h-50-px bg-success-600 bg-opacity-10 d-flex justify-content-center align-items-center radius-8">
                        <iconify-icon icon="solar:calendar-bold-duotone" class="text-success-600 text-2xl"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-6">
        <div class="card px-24 py-18 shadow-none radius-8 border h-100 bg-gradient-start-3">
            <div class="card-body p-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-10 mb-0">
                    <div>
                        <h6 class="fw-semibold text-lg mb-1">{{ $pendingFees }}</h6>
                        <span class="text-secondary-light text-sm">Pending Fees</span>
                    </div>
                    <div class="w-50-px h-50-px bg-warning-600 bg-opacity-10 d-flex justify-content-center align-items-center radius-8">
                        <iconify-icon icon="solar:wallet-bold-duotone" class="text-warning-600 text-2xl"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-6">
        <div class="card px-24 py-18 shadow-none radius-8 border h-100 bg-gradient-start-4">
            <div class="card-body p-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-10 mb-0">
                    <div>
                        <h6 class="fw-semibold text-lg mb-1">{{ $student->studentClass->name ?? 'N/A' }}</h6>
                        <span class="text-secondary-light text-sm">Class / Batch: {{ $student->batch->name ?? 'N/A' }}</span>
                    </div>
                    <div class="w-50-px h-50-px bg-info bg-opacity-10 d-flex justify-content-center align-items-center radius-8">
                        <iconify-icon icon="solar:book-bold-duotone" class="text-info text-2xl"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Quick Links --}}
<div class="row gy-4 mb-24">
    <div class="col-md-4">
        <a href="{{ route('student-portal.profile', ['student_id' => $student->id]) }}" class="card text-center p-24 text-decoration-none h-100">
            <div class="card-body">
                <i class="ri-user-3-line text-primary-600 text-3xl mb-8"></i>
                <h6 class="fw-semibold">My Profile</h6>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('student-portal.attendance', ['student_id' => $student->id]) }}" class="card text-center p-24 text-decoration-none h-100">
            <div class="card-body">
                <i class="ri-calendar-check-line text-success-600 text-3xl mb-8"></i>
                <h6 class="fw-semibold">My Attendance</h6>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('student-portal.fees', ['student_id' => $student->id]) }}" class="card text-center p-24 text-decoration-none h-100">
            <div class="card-body">
                <i class="ri-money-dollar-circle-line text-warning-600 text-3xl mb-8"></i>
                <h6 class="fw-semibold">My Fees</h6>
            </div>
        </a>
    </div>
</div>

{{-- Latest Announcements --}}
<div class="card">
    <div class="card-header border-bottom py-16 px-24">
        <h6 class="text-lg fw-semibold mb-0">Latest Announcements</h6>
    </div>
    <div class="card-body p-20">
        @forelse($announcements as $a)
            <div class="mb-16 pb-16 {{ !$loop->last ? 'border-bottom' : '' }}">
                <h6 class="text-md fw-semibold text-primary-light mb-4">{{ $a->title }}</h6>
                <p class="text-secondary-light text-sm mb-4">{{ Str::limit($a->message, 150) }}</p>
                <span class="text-xs text-secondary-light"><i class="ri-time-line"></i> {{ $a->created_at->diffForHumans() }}</span>
            </div>
        @empty
            <p class="text-secondary-light text-center">No announcements.</p>
        @endforelse
    </div>
</div>
@endif

@endsection
