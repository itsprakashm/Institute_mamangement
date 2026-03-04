@extends('layouts.master')

@section('title', 'Fee Report')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Fee Report</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <span class="text-secondary-light">/ Reports / Fees</span>
        </div>
    </div>
</div>

{{-- Filters --}}
<div class="card mb-24">
    <div class="card-body p-20">
        <form method="GET" action="{{ route('reports.fees') }}" class="row gy-3 align-items-end">
            <div class="col-md-8">
                <label class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Filter by Class</label>
                <select name="class_id" class="form-control form-select">
                    <option value="">All Classes</option>
                    @foreach($classes as $c)
                        <option value="{{ $c->id }}" {{ request('class_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary-600 w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header border-bottom py-16 px-24 d-flex justify-content-between align-items-center">
        <h6 class="text-lg fw-semibold mb-0">Fee Summary per Student</h6>
        <button onclick="window.print()" class="btn btn-sm btn-outline-primary-600 px-16 py-6 radius-6">
            <i class="ri-printer-line"></i> Print
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table bordered-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Class</th>
                        <th>Total Fees (₹)</th>
                        <th>Paid (₹)</th>
                        <th>Pending (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; $grandPaid = 0; $grandPending = 0; @endphp
                    @forelse($students as $i => $rec)
                    @php
                        $grandTotal += $rec->total_fees;
                        $grandPaid += $rec->total_paid;
                        $grandPending += $rec->total_pending;
                    @endphp
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $rec->student->first_name }} {{ $rec->student->last_name }}</td>
                        <td>{{ $rec->student->studentClass->name ?? 'N/A' }}</td>
                        <td>₹{{ number_format($rec->total_fees, 2) }}</td>
                        <td class="text-success-600 fw-medium">₹{{ number_format($rec->total_paid, 2) }}</td>
                        <td class="text-danger-600 fw-medium">₹{{ number_format($rec->total_pending, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-24 text-secondary-light">No students found.</td>
                    </tr>
                    @endforelse
                </tbody>
                @if($students->count() > 0)
                <tfoot class="bg-neutral-100">
                    <tr>
                        <td colspan="3" class="fw-bold text-end">Grand Total</td>
                        <td class="fw-bold">₹{{ number_format($grandTotal, 2) }}</td>
                        <td class="fw-bold text-success-600">₹{{ number_format($grandPaid, 2) }}</td>
                        <td class="fw-bold text-danger-600">₹{{ number_format($grandPending, 2) }}</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>

@endsection
