@extends('layouts.master')

@section('title', 'Edit Student')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Edit Student</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <a href="{{ route('students.index') }}" class="text-secondary-light hover-text-primary hover-underline "> / Student</a>
            <span class="text-secondary-light">/ Edit</span>
        </div>
    </div>
</div>

<form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data" class="mt-24">
    @csrf
    @method('PUT')
    
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
            <div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Personal Info</h6>
                </div>
                <div class="card-body p-20">
                    <div class="row gy-3">
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="">
                                <label for="admission_no" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Admission No <span class="text-danger-600">*</span> </label>
                                <input type="text" class="form-control" id="admission_no" value="{{ $student->admission_no }}" readonly>
                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="">
                                <label for="first_name" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">First Name <span class="text-danger-600">*</span> </label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $student->first_name) }}" placeholder="Enter First Name" required>
                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="">
                                <label for="last_name" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Last Name </label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $student->last_name) }}" placeholder="Enter Last Name">
                            </div>
                        </div>
                        
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="">
                                <label for="gender" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Gender <span class="text-danger-600">*</span></label>
                                <select id="gender" name="gender" class="form-control form-select" required>
                                    <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="">
                                <label for="dob" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Date Of Birth </label>
                                <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', $student->dob) }}">
                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="">
                                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Student Photo</label>
                                <input type="file" name="photo" class="form-control" accept="image/*">
                                @if($student->photo)
                                    <div class="mt-2 text-sm">
                                        Current: <a href="{{ asset($student->photo) }}" target="_blank">View Photo</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-12">
            <div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Academic Information</h6>
                </div>
                <div class="card-body p-20">
                    <div class="row gy-3">
                        <div class="col-xxl-4 col-sm-6">
                            <div class="">
                                <label for="class_id" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Class </label>
                                <select id="class_id" name="class_id" class="form-control form-select">
                                    <option value="">Select Class</option>
                                    @foreach($classes as $c)
                                        <option value="{{ $c->id }}" {{ old('class_id', $student->class_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-sm-6">
                            <div class="">
                                <label for="batch_id" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Batch </label>
                                <select id="batch_id" name="batch_id" class="form-control form-select">
                                    <option value="">Select Batch</option>
                                    @foreach($batches as $b)
                                        <option value="{{ $b->id }}" {{ old('batch_id', $student->batch_id) == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-sm-6">
                            <div class="">
                                <label for="status" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Status <span class="text-danger-600">*</span></label>
                                <select id="status" name="status" class="form-control form-select" required>
                                    <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="deleted" {{ old('status', $student->status) == 'deleted' ? 'selected' : '' }}>Deleted</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Guardian Info & Address</h6>
                </div>
                <div class="card-body p-20">
                    <div class="row gy-3">
                        <div class="col-xxl-6 col-sm-6">
                            <div class="">
                                <label for="guardian_name" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Guardian Name</label>
                                <input type="text" class="form-control" id="guardian_name" name="guardian_name" value="{{ old('guardian_name', $student->guardian_name) }}" placeholder="Enter Guardian Name">
                            </div>
                        </div>
                        <div class="col-xxl-6 col-sm-6">
                            <div class="">
                                <label for="guardian_phone" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Guardian Phone</label>
                                <input type="text" class="form-control" id="guardian_phone" name="guardian_phone" value="{{ old('guardian_phone', $student->guardian_phone) }}" placeholder="Enter Guardian Phone">
                            </div>
                        </div>
                        <div class="col-xxl-12 col-sm-12">
                            <div class="">
                                <label for="address" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter Address">{{ old('address', $student->address) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex align-items-center justify-content-center gap-3 mt-8">
                <a href="{{ route('students.index') }}" class="btn border border-danger-600 text-danger-600 bg-hover-danger-200 text-md px-50 py-11 radius-8">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary-600 border border-primary-600 text-md px-28 py-12 radius-8">
                    Update Student
                </button>
            </div>
        </div>
    </div>
</form>

@endsection
