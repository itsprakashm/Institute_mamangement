@extends('layouts.master')

@section('title', 'Student Details')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Student Details</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <a href="{{ route('students.index') }}" class="text-secondary-light hover-text-primary hover-underline "> / Student</a>
            <span class="text-secondary-light">/ Details</span>
        </div>
    </div>
    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary-600 d-flex align-items-center gap-6 ">
        <span class="d-flex text-md">
            <i class="ri-edit-2-line"></i>
        </span>
        Edit Student
    </a>
</div>

<div class="row gy-4">
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-body text-center p-24">
                <div class="mb-24">
                    <img src="{{ $student->photo ? asset($student->photo) : asset('assets/images/thumbs/avatar-img1.png') }}" 
                         alt="{{ $student->first_name }}" 
                         class="rounded-circle object-fit-cover shadow-sm bg-neutral-200 border border-4 border-white"
                         style="width: 140px; height: 140px;">
                </div>
                <h4 class="mb-4 text-primary-light">{{ $student->first_name }} {{ $student->last_name }}</h4>
                <p class="mb-16 text-secondary-light">Admission No: <strong>{{ $student->admission_no }}</strong></p>
                
                <div class="mt-24">
                    @if($student->status == 'active')
                        <span class="bg-success-100 text-success-600 px-24 py-8 radius-4 fw-medium text-sm">Active</span>
                    @elseif($student->status == 'inactive')
                        <span class="bg-warning-100 text-warning-600 px-24 py-8 radius-4 fw-medium text-sm">Inactive</span>
                    @else
                        <span class="bg-danger-100 text-danger-600 px-24 py-8 radius-4 fw-medium text-sm">Deleted</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header border-bottom py-16 px-24">
                <h6 class="text-lg fw-semibold mb-0">Information</h6>
            </div>
            <div class="card-body p-24">
                <div class="row gy-4">
                    <div class="col-sm-6 col-md-4">
                        <p class="text-sm text-secondary-light mb-4">First Name</p>
                        <h6 class="text-md fw-medium text-primary-light mb-0">{{ $student->first_name }}</h6>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <p class="text-sm text-secondary-light mb-4">Last Name</p>
                        <h6 class="text-md fw-medium text-primary-light mb-0">{{ $student->last_name ?: 'N/A' }}</h6>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <p class="text-sm text-secondary-light mb-4">Gender</p>
                        <h6 class="text-md fw-medium text-primary-light mb-0">{{ ucfirst($student->gender) }}</h6>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <p class="text-sm text-secondary-light mb-4">Date of Birth</p>
                        <h6 class="text-md fw-medium text-primary-light mb-0">{{ $student->dob ? \Carbon\Carbon::parse($student->dob)->format('d M Y') : 'N/A' }}</h6>
                    </div>
                    
                    <div class="col-sm-6 col-md-4">
                        <p class="text-sm text-secondary-light mb-4">Class</p>
                        <h6 class="text-md fw-medium text-primary-light mb-0">{{ $student->studentClass->name ?? 'N/A' }}</h6>
                    </div>
                    
                    <div class="col-sm-6 col-md-4">
                        <p class="text-sm text-secondary-light mb-4">Batch</p>
                        <h6 class="text-md fw-medium text-primary-light mb-0">{{ $student->batch->name ?? 'N/A' }}</h6>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <p class="text-sm text-secondary-light mb-4">Guardian Name</p>
                        <h6 class="text-md fw-medium text-primary-light mb-0">{{ $student->guardian_name ?: 'N/A' }}</h6>
                    </div>
                    
                    <div class="col-sm-6 col-md-4">
                        <p class="text-sm text-secondary-light mb-4">Guardian Phone</p>
                        <h6 class="text-md fw-medium text-primary-light mb-0">{{ $student->guardian_phone ?: 'N/A' }}</h6>
                    </div>
                    
                    <div class="col-12">
                        <p class="text-sm text-secondary-light mb-4">Address</p>
                        <h6 class="text-md fw-medium text-primary-light mb-0">{{ $student->address ?: 'N/A' }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
