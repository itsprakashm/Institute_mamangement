@extends('layouts.master')

@section('title', 'New Announcement')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">New Announcement</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <a href="{{ route('announcements.index') }}" class="text-secondary-light hover-text-primary hover-underline"> / Announcements</a>
            <span class="text-secondary-light">/ Create</span>
        </div>
    </div>
</div>

<form action="{{ route('announcements.store') }}" method="POST" class="mt-24">
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
                    <h6 class="text-lg fw-semibold mb-0">Announcement Details</h6>
                </div>
                <div class="card-body p-20">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label for="title" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Title <span class="text-danger-600">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Enter announcement title" required>
                        </div>
                        <div class="col-12">
                            <label for="message" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Message <span class="text-danger-600">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="6" placeholder="Enter your announcement message here..." required>{{ old('message') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex align-items-center justify-content-center gap-3 mt-8">
                <a href="{{ route('announcements.index') }}" class="btn border border-danger-600 text-danger-600 bg-hover-danger-200 text-md px-50 py-11 radius-8">Cancel</a>
                <button type="submit" class="btn btn-primary-600 border border-primary-600 text-md px-28 py-12 radius-8">Publish</button>
            </div>
        </div>
    </div>
</form>

@endsection
