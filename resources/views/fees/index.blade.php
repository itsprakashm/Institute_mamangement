@extends('layouts.master')

@section('title', 'Fee Structures')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Fee Structures</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <span class="text-secondary-light">/ Fees / Structures</span>
        </div>
    </div>
    <a href="{{ route('fees.create-structure') }}" class="btn btn-primary-600 d-flex align-items-center gap-6">
        <span class="d-flex text-md"><i class="ri-add-large-line"></i></span>
        Add Fee Structure
    </a>
</div>

@if(session('success'))
<div class="alert alert-success mb-24">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table bordered-table mb-0 data-table" id="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Class</th>
                        <th>Monthly Fee (₹)</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($structures as $i => $fs)
                    <tr>
                        <td>{{ $structures->firstItem() + $i }}</td>
                        <td>{{ $fs->studentClass->name ?? 'N/A' }}</td>
                        <td>₹{{ number_format($fs->monthly_fee, 2) }}</td>
                        <td>{{ $fs->description ?: '—' }}</td>
                        <td>
                            <a href="{{ route('fees.create-structure') }}?edit={{ $fs->id }}" class="text-primary-600">
                                <i class="ri-edit-2-line"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-24 text-secondary-light">No fee structures yet. Add one to get started.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-20 py-12">
            {{ $structures->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection
