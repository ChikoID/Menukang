@extends('layouts.app')

@section('title', $user->name)

@section('sidebar')
    @include('partials.sidebar')
@endsection

@php
    $roleLabels = ['admin' => 'Admin', 'tukang' => 'Tukang', 'pelanggan' => 'Pelanggan'];
    $roleBadgeClasses = [
        'admin' => 'bg-brand-softer text-fg-brand-strong',
        'tukang' => 'bg-success-soft text-fg-success-strong',
        'pelanggan' => 'bg-warning-soft text-fg-warning',
    ];
@endphp

@section('content')
    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <nav class="mb-2 flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center gap-1.5 text-sm font-medium text-body">
                    <li><a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 hover:text-fg-brand"><i class="fa-solid fa-house text-xs" aria-hidden="true"></i> Dashboard</a></li>
                    <li aria-hidden="true"><i class="fa-solid fa-chevron-right text-2xs"></i></li>
                    <li><a href="{{ route('admin.users.index') }}" class="hover:text-fg-brand">Pengguna</a></li>
                    <li aria-hidden="true"><i class="fa-solid fa-chevron-right text-2xs"></i></li>
                    <li class="text-heading" aria-current="page">Detail</li>
                </ol>
            </nav>
            <h1 class="text-xl font-semibold text-heading sm:text-2xl">Detail Pengguna</h1>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('admin.users.edit', $user) }}"
                class="inline-flex items-center gap-2 rounded-base bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i> Edit
            </a>
            @unless ($user->is(auth()->user()))
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                    onsubmit="return confirm(@js('Hapus pengguna '.$user->name.'?'))">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-base bg-danger px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-danger-strong focus:outline-none focus:ring-4 focus:ring-danger-medium">
                        <i class="fa-solid fa-trash" aria-hidden="true"></i> Hapus
                    </button>
                </form>
            @endunless
        </div>
    </div>

    <div class="grid gap-4 xl:grid-cols-3">
        {{-- Profile card --}}
        <div class="rounded-base border border-default bg-neutral-primary-soft p-4 shadow-xs sm:p-6">
            <div class="flex flex-col items-center text-center">
                <span class="mb-4 flex size-20 items-center justify-center rounded-full bg-brand-softer text-3xl font-semibold text-fg-brand">
                    {{ str($user->name)->substr(0, 1)->upper() }}
                </span>
                <h2 class="text-xl font-semibold text-heading">{{ $user->name }}</h2>
                <p class="mb-3 text-body">{{ $user->email }}</p>
                <span class="rounded-sm px-2.5 py-0.5 text-xs font-medium {{ $roleBadgeClasses[$user->role] ?? 'bg-neutral-tertiary text-heading' }}">
                    {{ $roleLabels[$user->role] ?? ucfirst($user->role) }}
                </span>
            </div>
        </div>

        {{-- Contact info --}}
        <div class="rounded-base border border-default bg-neutral-primary-soft p-4 shadow-xs sm:p-6 xl:col-span-2">
            <h2 class="mb-4 text-lg font-semibold text-heading">Informasi Akun</h2>
            <dl class="grid gap-4 text-sm sm:grid-cols-2">
                <div>
                    <dt class="mb-1 flex items-center gap-2 text-body"><i class="fa-solid fa-phone w-4" aria-hidden="true"></i> No. Telepon</dt>
                    <dd class="font-medium text-heading">{{ $user->phone ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="mb-1 flex items-center gap-2 text-body"><i class="fa-solid fa-calendar w-4" aria-hidden="true"></i> Terdaftar</dt>
                    <dd class="font-medium text-heading">{{ $user->created_at?->format('d M Y, H:i') }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="mb-1 flex items-center gap-2 text-body"><i class="fa-solid fa-location-dot w-4" aria-hidden="true"></i> Alamat</dt>
                    <dd class="font-medium text-heading">{{ $user->address ?? '-' }}</dd>
                </div>
            </dl>
        </div>

        {{-- Worker profile --}}
        @if ($user->worker)
            <div class="rounded-base border border-default bg-neutral-primary-soft p-4 shadow-xs sm:p-6 xl:col-span-3">
                <h2 class="mb-4 flex items-center gap-2 text-lg font-semibold text-heading">
                    <i class="fa-solid fa-helmet-safety text-fg-success" aria-hidden="true"></i> Profil Tukang
                </h2>
                <dl class="grid gap-4 text-sm sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <dt class="mb-1 text-body">Jenis Tukang</dt>
                        <dd class="font-medium text-heading">{{ $user->worker->workerType?->name ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="mb-1 text-body">Area Layanan</dt>
                        <dd class="font-medium text-heading">{{ $user->worker->service_area ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="mb-1 text-body">Pengalaman</dt>
                        <dd class="font-medium text-heading">{{ $user->worker->experience_years ?? 0 }} tahun</dd>
                    </div>
                    <div>
                        <dt class="mb-1 text-body">Status</dt>
                        <dd>
                            @if ($user->worker->status === 'active')
                                <span class="rounded-sm bg-success-soft px-2 py-0.5 text-xs font-medium text-fg-success-strong">Aktif</span>
                            @else
                                <span class="rounded-sm bg-neutral-tertiary px-2 py-0.5 text-xs font-medium text-heading">Tidak aktif</span>
                            @endif
                        </dd>
                    </div>
                    <div class="sm:col-span-2 lg:col-span-4">
                        <dt class="mb-1 text-body">Deskripsi</dt>
                        <dd class="font-medium text-heading">{{ $user->worker->description ?? '-' }}</dd>
                    </div>
                </dl>
            </div>
        @endif
    </div>
@endsection
