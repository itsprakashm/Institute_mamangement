@extends('layouts.master')

@section('title', 'Fee Report')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Fee Report</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <span class="text-secondary-light">/ Fees / Report</span>
        </div>
    </div>
    <a href="{{ route('fees.collect') }}" class="btn btn-primary-600 d-flex align-items-center gap-6">
        <i class="ri-money-dollar-circle-line"></i> Collect Fee
    </a>
</div>

{{-- Filters --}}
<div class="card mb-24">
    <div class="card-body p-20">
        <form method="GET" action="{{ route('fees.report') }}" class="row gy-3 align-items-end">
            <div class="col-md-4">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Student</label>
                <select name="student_id" class="form-control form-select">
                    <option value="">All Students</option>
                    @foreach($students as $s)
                        <option value="{{ $s->id }}" {{ request('student_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->first_name }} {{ $s->last_name }} ({{ $s->admission_no }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Month</label>
                <input type="month" name="month" class="form-control" value="{{ request('month') }}">
            </div>
            <div class="col-md-3">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Status</label>
                <select name="status" class="form-control form-select">
                    <option value="">All</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary-600 w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table bordered-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Month</th>
                        <th>Amount (₹)</th>
                        <th>Status</th>
                        <th>Paid Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $i => $rec)
                    <tr>
                        <td>{{ $records->firstItem() + $i }}</td>
                        <td>{{ $rec->student->first_name ?? 'N/A' }} {{ $rec->student->last_name ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($rec->month . '-01')->format('M Y') }}</td>
                        <td>₹{{ number_format($rec->amount, 2) }}</td>
                        <td>
                            @if($rec->status == 'paid')
                                <span class="bg-success-100 text-success-600 px-16 py-4 radius-4 fw-medium text-sm">Paid</span>
                            @else
                                <span class="bg-warning-100 text-warning-600 px-16 py-4 radius-4 fw-medium text-sm">Pending</span>
                            @endif
                        </td>
                        <td>{{ $rec->paid_date ? \Carbon\Carbon::parse($rec->paid_date)->format('d M Y') : '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-24 text-secondary-light">No fee records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
            {{ $records->links() }}
    </div>
</div>

@endsection
