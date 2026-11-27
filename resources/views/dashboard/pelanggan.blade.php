@extends('layouts.app')

@section('title', 'Dashboard Pelanggan')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-heading">Halo, {{ auth()->user()->name }}</h1>
        <p class="text-body">Temukan tukang yang tepat untuk kebutuhan Anda.</p>
    </div>

    <div class="mb-6 grid gap-4 sm:grid-cols-2">
        <div class="rounded-base border border-default bg-neutral-primary-soft p-6 shadow-xs">
            <p class="text-sm font-medium text-body">Tukang Aktif</p>
            <p class="mt-2 text-3xl font-semibold text-heading">{{ number_format($totalWorkers) }}</p>
        </div>
        <div class="rounded-base border border-default bg-neutral-primary-soft p-6 shadow-xs">
            <p class="text-sm font-medium text-body">Jenis Layanan</p>
            <p class="mt-2 text-3xl font-semibold text-heading">{{ number_format($workerTypes->total()) }}</p>
        </div>
    </div>

    <div class="rounded-base border border-default bg-neutral-primary-soft p-6 shadow-xs">
        <h2 class="mb-4 text-lg font-semibold text-heading">Jenis Layanan</h2>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            @forelse ($workerTypes as $workerType)
                <div class="rounded-base border border-default bg-neutral-primary p-4">
                    <h3 class="font-semibold text-heading">{{ $workerType->name }}</h3>
                    <p class="mt-1 text-sm text-body">{{ $workerType->description ?? 'Belum ada deskripsi.' }}</p>
                </div>
            @empty
                <p class="text-sm text-body">Belum ada jenis layanan.</p>
            @endforelse
        </div>

        @if ($workerTypes->hasPages())
            <div class="mt-6 border-t border-default pt-4">
                {{ $workerTypes->links() }}
            </div>
        @endif
    </div>
@endsection
