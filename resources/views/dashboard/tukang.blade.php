@extends('layouts.app')

@section('title', 'Dashboard Tukang')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-heading">Halo, {{ auth()->user()->name }}</h1>
        <p class="text-body">Selamat datang di dashboard tukang.</p>
    </div>

    @if ($worker)
        <div class="mb-6 grid gap-4 sm:grid-cols-3">
            @foreach ([
                'Jenis Tukang' => $worker->workerType?->name ?? '-',
                'Pengalaman' => $worker->experience_years . ' tahun',
                'Status' => $worker->status === 'active' ? 'Aktif' : 'Tidak aktif',
            ] as $statLabel => $statValue)
                <div class="rounded-base border border-default bg-neutral-primary-soft p-6 shadow-xs">
                    <p class="text-sm font-medium text-body">{{ $statLabel }}</p>
                    <p class="mt-2 text-xl font-semibold text-heading">{{ $statValue }}</p>
                </div>
            @endforeach
        </div>

        <div class="rounded-base border border-default bg-neutral-primary-soft p-6 shadow-xs">
            <h2 class="mb-4 text-lg font-semibold text-heading">Profil Tukang</h2>
            <dl class="grid gap-4 text-sm sm:grid-cols-2">
                <div>
                    <dt class="text-body">Area Layanan</dt>
                    <dd class="font-medium text-heading">{{ $worker->service_area }}</dd>
                </div>
                <div>
                    <dt class="text-body">No. Telepon</dt>
                    <dd class="font-medium text-heading">{{ auth()->user()->phone ?? '-' }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-body">Deskripsi</dt>
                    <dd class="font-medium text-heading">{{ $worker->description ?? '-' }}</dd>
                </div>
            </dl>
        </div>
    @else
        <div class="rounded-base border border-warning-subtle bg-warning-soft p-4 text-sm text-fg-warning" role="alert">
            Profil tukang Anda belum lengkap. Silakan hubungi admin.
        </div>
    @endif
@endsection
