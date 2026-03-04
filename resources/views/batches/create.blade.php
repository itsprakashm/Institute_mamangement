@extends('layouts.master')

@section('title', 'Add New Batch')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Add New Batch</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <a href="{{ route('batches.index') }}" class="text-secondary-light hover-text-primary hover-underline"> / Batches</a>
            <span class="text-secondary-light">/ Add</span>
        </div>
    </div>
</div>

<form action="{{ route('batches.store') }}" method="POST" class="mt-24">
    @csrf

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row gy-3">
        <div class="col-lg-12">
            <div class="shadow-1 radius-12 bg-base overflow-hidden">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Batch Information</h6>
                </div>
                <div class="card-body p-20">
                    <div class="row gy-3">

                        <div class="col-xxl-6 col-sm-6">
                            <label for="name" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Batch Name <span class="text-danger-600">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="e.g., Morning Batch A" required>
                        </div>

                        <div class="col-xxl-6 col-sm-6">
                            <label for="class_id" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Class <span class="text-danger-600">*</span></label>
                            <select id="class_id" name="class_id" class="form-control form-select" required>
                                <option value="" disabled selected>Select Class</option>
                                @foreach($classes as $c)
                                    <option value="{{ $c->id }}" {{ old('class_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xxl-6 col-sm-6">
                            <label for="teacher_id" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Assign Teacher</label>
                            <select id="teacher_id" name="teacher_id" class="form-control form-select">
                                <option value="">Not Assigned</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xxl-3 col-sm-6">
                            <label for="start_time" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Start Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" value="{{ old('start_time') }}">
                        </div>

                        <div class="col-xxl-3 col-sm-6">
                            <label for="end_time" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time') }}">
                        </div>

                        <div class="col-xxl-6 col-sm-6">
                            <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex align-items-center justify-content-center gap-3 mt-8">
                <a href="{{ route('batches.index') }}" class="btn border border-danger-600 text-danger-600 bg-hover-danger-200 text-md px-50 py-11 radius-8">Cancel</a>
                <button type="submit" class="btn btn-primary-600 border border-primary-600 text-md px-28 py-12 radius-8">Save Batch</button>
            </div>
        </div>
    </div>
</form>

@endsection
