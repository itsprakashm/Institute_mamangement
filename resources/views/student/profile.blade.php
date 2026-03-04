@extends('layouts.master')

@section('title', 'Student Profile')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Student Profile</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <a href="{{ route('student-portal.dashboard', ['student_id' => $student->id]) }}" class="text-secondary-light hover-text-primary hover-underline"> / Student Portal</a>
            <span class="text-secondary-light">/ Profile</span>
        </div>
    </div>
</div>

{{-- Student Selector --}}
<div class="card mb-24">
    <div class="card-body p-20">
        <form method="GET" action="{{ route('student-portal.profile') }}" class="row gy-3 align-items-end">
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
                <button type="submit" class="btn btn-primary-600 w-100">Load Profile</button>
            </div>
        </form>
    </div>
</div>

@if(isset($student))
<div class="card">
    <div class="card-header border-bottom py-16 px-24">
        <h6 class="text-lg fw-semibold mb-0">Personal Information</h6>
    </div>
    <div class="card-body p-24">
        <div class="row gy-4">
            <div class="col-md-6">
                <div class="mb-20">
                    <label class="text-sm fw-semibold text-secondary-light mb-4 d-block">Full Name</label>
                    <p class="text-primary-light fw-medium">{{ $student->first_name }} {{ $student->last_name }}</p>
                </div>
                <div class="mb-20">
                    <label class="text-sm fw-semibold text-secondary-light mb-4 d-block">Admission No</label>
                    <p class="text-primary-light fw-medium">{{ $student->admission_no }}</p>
                </div>
                <div class="mb-20">
                    <label class="text-sm fw-semibold text-secondary-light mb-4 d-block">Email</label>
                    <p class="text-primary-light fw-medium">{{ $student->email ?: '—' }}</p>
                </div>
                <div class="mb-20">
                    <label class="text-sm fw-semibold text-secondary-light mb-4 d-block">Phone</label>
                    <p class="text-primary-light fw-medium">{{ $student->phone ?: '—' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-20">
                    <label class="text-sm fw-semibold text-secondary-light mb-4 d-block">Class</label>
                    <p class="text-primary-light fw-medium">{{ $student->studentClass->name ?? 'N/A' }}</p>
                </div>
                <div class="mb-20">
                    <label class="text-sm fw-semibold text-secondary-light mb-4 d-block">Batch</label>
                    <p class="text-primary-light fw-medium">{{ $student->batch->name ?? 'N/A' }}</p>
                </div>
                <div class="mb-20">
                    <label class="text-sm fw-semibold text-secondary-light mb-4 d-block">Date of Birth</label>
                    <p class="text-primary-light fw-medium">{{ $student->dob ? \Carbon\Carbon::parse($student->dob)->format('d M Y') : '—' }}</p>
                </div>
                <div class="mb-20">
                    <label class="text-sm fw-semibold text-secondary-light mb-4 d-block">Gender</label>
                    <p class="text-primary-light fw-medium">{{ ucfirst($student->gender ?? '—') }}</p>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-0">
                    <label class="text-sm fw-semibold text-secondary-light mb-4 d-block">Address</label>
                    <p class="text-primary-light fw-medium">{{ $student->address ?: '—' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
