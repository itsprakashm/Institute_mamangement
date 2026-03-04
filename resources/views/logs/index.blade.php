@extends('layouts.master')

@section('title', 'Activity Logs')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Activity Logs</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <span class="text-secondary-light">/ Activity Logs</span>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table bordered-table mb-0 data-table" id="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Module</th>
                        <th>Record ID</th>
                        <th>Description</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $i => $log)
                    <tr>
                        <td>{{ $logs->firstItem() + $i }}</td>
                        <td>{{ $log->user->name ?? 'System' }}</td>
                        <td>
                            @php
                                $badgeClass = match($log->action) {
                                    'created' => 'bg-success-100 text-success-600',
                                    'updated' => 'bg-primary-100 text-primary-600',
                                    'deleted' => 'bg-danger-100 text-danger-600',
                                    default   => 'bg-neutral-200 text-neutral-700',
                                };
                            @endphp
                            <span class="{{ $badgeClass }} px-12 py-4 radius-4 fw-medium text-sm">{{ ucfirst($log->action) }}</span>
                        </td>
                        <td>{{ ucfirst($log->module) }}</td>
                        <td>{{ $log->record_id ?? '—' }}</td>
                        <td>{{ $log->description ?? '—' }}</td>
                        <td class="text-sm text-secondary-light">{{ $log->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-24 text-secondary-light">No activity logs yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-20 py-12">
            {{ $logs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection
