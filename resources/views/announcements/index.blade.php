@extends('layouts.master')

@section('title', 'Announcements')

@section('content')

<div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div class="">
        <h1 class="fw-semibold mb-4 h6 text-primary-light">Announcements</h1>
        <div class="">
            <a href="{{ url('/') }}" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <span class="text-secondary-light">/ Announcements</span>
        </div>
    </div>
    <a href="{{ route('announcements.create') }}" class="btn btn-primary-600 d-flex align-items-center gap-6">
        <i class="ri-add-large-line"></i> New Announcement
    </a>
</div>

@if(session('success'))
<div class="alert alert-success mb-24">{{ session('success') }}</div>
@endif

<div class="row gy-4">
    @forelse($announcements as $a)
    <div class="col-12">
        <div class="card">
            <div class="card-body p-24">
                <div class="d-flex align-items-start justify-content-between gap-3">
                    <div class="flex-grow-1">
                        <h5 class="fw-semibold text-primary-light mb-8">{{ $a->title }}</h5>
                        <p class="text-secondary-light mb-12">{{ $a->message }}</p>
                        <span class="text-sm text-secondary-light">
                            <i class="ri-user-line"></i> {{ $a->author->name ?? 'System' }}&nbsp;&nbsp;
                            <i class="ri-time-line"></i> {{ $a->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <form action="{{ route('announcements.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Delete this announcement?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger-600 px-12 py-6 radius-6">
                            <i class="ri-delete-bin-6-line"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body p-24 text-center text-secondary-light">
                No announcements yet. Create one to get started.
            </div>
        </div>
    </div>
    @endforelse
</div>

<div class="mt-16">
    {{ $announcements->links() }}
</div>

@endsection
