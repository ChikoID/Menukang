@extends('layouts.app')

@section('title', 'Edit Jenis Tukang')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
    <div class="mb-4">
        <nav class="mb-2 flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center gap-1.5 text-sm font-medium text-body">
                <li><a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 hover:text-fg-brand"><i class="fa-solid fa-house text-xs" aria-hidden="true"></i> Dashboard</a></li>
                <li aria-hidden="true"><i class="fa-solid fa-chevron-right text-2xs"></i></li>
                <li><a href="{{ route('admin.worker-types.index') }}" class="hover:text-fg-brand">Jenis Tukang</a></li>
                <li aria-hidden="true"><i class="fa-solid fa-chevron-right text-2xs"></i></li>
                <li class="text-heading" aria-current="page">Edit</li>
            </ol>
        </nav>
        <h1 class="text-xl font-semibold text-heading sm:text-2xl">Edit Jenis Tukang: {{ $workerType->name }}</h1>
    </div>

    <form method="POST" action="{{ route('admin.worker-types.update', $workerType) }}">
        @csrf
        @method('PUT')
        @include('admin.worker-types.form', ['workerType' => $workerType])
    </form>
@endsection
