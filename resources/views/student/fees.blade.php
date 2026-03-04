@extends('layouts.master')

@section('title', 'My Fees')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">My Fees</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <a href="{{ route('student-portal.dashboard', ['student_id' => $student->id]) }}" class="text-secondary-light hover-text-primary hover-underline"> / Student Portal</a>
            <span class="text-secondary-light">/ Fees</span>
        </div>
    </div>
</div>

{{-- Student Selector --}}
<div class="card mb-24">
    <div class="card-body p-20">
        <form method="GET" action="{{ route('student-portal.fees') }}" class="row gy-3 align-items-end">
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
                <button type="submit" class="btn btn-primary-600 w-100">Load Fees</button>
            </div>
        </form>
    </div>
</div>

@if(isset($student))
{{-- Summary --}}
<div class="row gy-4 mb-24">
    <div class="col-sm-6">
        <div class="card text-center p-20 border-start border-success border-4">
            <h4 class="fw-bold text-success-600">₹{{ number_format($totalPaid, 2) }}</h4>
            <span class="text-sm text-secondary-light">Total Paid</span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card text-center p-20 border-start border-warning border-4">
            <h4 class="fw-bold text-warning-600">₹{{ number_format($totalPending, 2) }}</h4>
            <span class="text-sm text-secondary-light">Total Pending</span>
        </div>
    </div>
</div>

{{-- Fee Table --}}
<div class="card">
    <div class="card-header border-bottom py-16 px-24">
        <h6 class="text-lg fw-semibold mb-0">Fee History — {{ $student->first_name }} {{ $student->last_name }}</h6>
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-24 text-secondary-light">No fee records found.</td>
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
