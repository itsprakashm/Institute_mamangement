@extends('layouts.master')

@section('title', 'Collect Fee')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Fee Collection</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <span class="text-secondary-light">/ Fees / Collect</span>
        </div>
    </div>
    <a href="{{ route('fees.report') }}" class="btn btn-outline-primary-600 d-flex align-items-center gap-6">
        <i class="ri-file-chart-line"></i> Fee Report
    </a>
</div>

{{-- Select Student --}}
<div class="card mb-24">
    <div class="card-body p-20">
        <form method="GET" action="{{ route('fees.collect') }}" class="row gy-3 align-items-end">
            <div class="col-md-8">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Search Student</label>
                <select name="student_id" class="form-control form-select" required>
                    <option value="" disabled {{ !request('student_id') ? 'selected' : '' }}>Select Student</option>
                    @foreach($students as $s)
                        <option value="{{ $s->id }}" {{ request('student_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->first_name }} {{ $s->last_name }} ({{ $s->admission_no }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary-600 w-100">Load Fees</button>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success mb-24">{{ session('success') }}</div>
@endif

@if($selectedStudent)
<div class="row gy-4 mb-24">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-20">
                <h6 class="fw-semibold mb-16">Student Info</h6>
                <p class="mb-4 text-sm"><span class="text-secondary-light">Name:</span> <strong>{{ $selectedStudent->first_name }} {{ $selectedStudent->last_name }}</strong></p>
                <p class="mb-4 text-sm"><span class="text-secondary-light">Admission No:</span> {{ $selectedStudent->admission_no }}</p>
                <p class="mb-0 text-sm"><span class="text-secondary-light">Class:</span> {{ $selectedStudent->studentClass->name ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-20">
                <h6 class="fw-semibold mb-16">Add Fee Entry</h6>
                <form method="POST" action="{{ route('fees.generate') }}" class="row gy-3">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $selectedStudent->id }}">
                    <div class="col-6">
                        <label class="text-sm fw-semibold mb-4">Month</label>
                        <input type="month" name="month" class="form-control" value="{{ date('Y-m') }}" required>
                    </div>
                    <div class="col-6">
                        <label class="text-sm fw-semibold mb-4">Amount (₹)</label>
                        <input type="number" name="amount" class="form-control" placeholder="Amount" min="0" step="0.01" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary-600 w-100">Add Fee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Fee History --}}
<div class="card">
    <div class="card-header border-bottom py-16 px-24">
        <h6 class="text-lg fw-semibold mb-0">Fee History</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table bordered-table mb-0">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Amount (₹)</th>
                        <th>Status</th>
                        <th>Paid Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fees as $fee)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($fee->month . '-01')->format('M Y') }}</td>
                        <td>₹{{ number_format($fee->amount, 2) }}</td>
                        <td>
                            @if($fee->status == 'paid')
                                <span class="bg-success-100 text-success-600 px-16 py-4 radius-4 fw-medium text-sm">Paid</span>
                            @else
                                <span class="bg-warning-100 text-warning-600 px-16 py-4 radius-4 fw-medium text-sm">Pending</span>
                            @endif
                        </td>
                        <td>{{ $fee->paid_date ? \Carbon\Carbon::parse($fee->paid_date)->format('d M Y') : '—' }}</td>
                        <td>
                            @if($fee->status == 'pending')
                            <form method="POST" action="{{ route('fees.mark-paid', $fee->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success-600 text-sm px-12 py-4 radius-4">Mark Paid</button>
                            </form>
                            @else
                                <span class="text-secondary-light text-sm">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-24 text-secondary-light">No fee records found for this student.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-20 py-12">
            {{ $fees->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endif

@endsection
