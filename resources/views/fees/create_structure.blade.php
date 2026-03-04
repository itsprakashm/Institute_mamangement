@extends('layouts.master')

@section('title', 'Add Fee Structure')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Add / Update Fee Structure</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <a href="{{ route('fees.index') }}" class="text-secondary-light hover-text-primary hover-underline"> / Fee Structures</a>
            <span class="text-secondary-light">/ Add</span>
        </div>
    </div>
</div>

<form action="{{ route('fees.store-structure') }}" method="POST" class="mt-24">
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
                    <h6 class="text-lg fw-semibold mb-0">Fee Structure Details</h6>
                </div>
                <div class="card-body p-20">
                    <div class="row gy-3">
                        <div class="col-xxl-4 col-md-6">
                            <label for="class_id" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Class <span class="text-danger-600">*</span></label>
                            <select id="class_id" name="class_id" class="form-control form-select" required>
                                <option value="" disabled selected>Select Class</option>
                                @foreach($classes as $c)
                                    <option value="{{ $c->id }}" {{ old('class_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <label for="monthly_fee" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Monthly Fee (₹) <span class="text-danger-600">*</span></label>
                            <input type="number" step="0.01" min="0" class="form-control" id="monthly_fee" name="monthly_fee" value="{{ old('monthly_fee') }}" placeholder="e.g., 2500" required>
                        </div>
                        <div class="col-xxl-12">
                            <label for="description" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Optional notes...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex align-items-center justify-content-center gap-3 mt-8">
                <a href="{{ route('fees.index') }}" class="btn border border-danger-600 text-danger-600 bg-hover-danger-200 text-md px-50 py-11 radius-8">Cancel</a>
                <button type="submit" class="btn btn-primary-600 border border-primary-600 text-md px-28 py-12 radius-8">Save Structure</button>
            </div>
        </div>
    </div>
</form>

@endsection
