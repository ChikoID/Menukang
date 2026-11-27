@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@php
    $totalLainnya = max($totalUsers - $totalTukang - $totalPelanggan, 0);

    /** @var list<array{label: string, value: int, icon: string, iconClass: string}> $statCards */
    $statCards = [
        ['label' => 'Total Pengguna', 'value' => $totalUsers, 'iconClass' => 'bg-brand-softer text-fg-brand', 'icon' => 'fa-solid fa-users'],
        ['label' => 'Tukang', 'value' => $totalTukang, 'iconClass' => 'bg-success-soft text-fg-success', 'icon' => 'fa-solid fa-helmet-safety'],
        ['label' => 'Pelanggan', 'value' => $totalPelanggan, 'iconClass' => 'bg-warning-soft text-fg-warning', 'icon' => 'fa-solid fa-user'],
        ['label' => 'Jenis Tukang', 'value' => $totalWorkerTypes, 'iconClass' => 'bg-neutral-tertiary text-heading', 'icon' => 'fa-solid fa-toolbox'],
    ];

    /** @var list<array{label: string, value: int, barClass: string}> $roleDistribution */
    $roleDistribution = [
        ['label' => 'Tukang', 'value' => $totalTukang, 'barClass' => 'bg-success'],
        ['label' => 'Pelanggan', 'value' => $totalPelanggan, 'barClass' => 'bg-warning'],
        ['label' => 'Admin & lainnya', 'value' => $totalLainnya, 'barClass' => 'bg-brand'],
    ];

    /** @var array<string, string> $roleBadgeClasses */
    $roleBadgeClasses = [
        'admin' => 'bg-brand-softer text-fg-brand-strong',
        'tukang' => 'bg-success-soft text-fg-success-strong',
        'pelanggan' => 'bg-warning-soft text-fg-warning',
    ];
@endphp

@section('content')
    {{-- Header --}}
    <div class="mb-4">
        <nav class="mb-2 flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center gap-1 text-sm font-medium text-body">
                <li class="inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-house text-xs" aria-hidden="true"></i>
                    {{ config('app.name', 'Menukang') }}
                </li>
                <li aria-hidden="true">
                    <svg class="size-3.5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>
                </li>
                <li class="text-heading" aria-current="page">Dashboard</li>
            </ol>
        </nav>
        <h1 class="text-xl font-semibold text-heading sm:text-2xl">Dashboard Admin</h1>
    </div>

    {{-- Stat cards --}}
    <div class="mb-4 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($statCards as $card)
            <div class="flex items-center justify-between rounded-base border border-default bg-neutral-primary-soft p-4 shadow-xs sm:p-6">
                <div>
                    <h3 class="text-base font-normal text-body">{{ $card['label'] }}</h3>
                    <span class="text-2xl font-bold leading-none text-heading sm:text-3xl">{{ number_format($card['value']) }}</span>
                </div>
                <span class="flex size-12 shrink-0 items-center justify-center rounded-base {{ $card['iconClass'] }}">
                    <i class="{{ $card['icon'] }} text-xl" aria-hidden="true"></i>
                </span>
            </div>
        @endforeach
    </div>

    <div class="grid gap-4 xl:grid-cols-3">
        {{-- Role distribution --}}
        <div class="rounded-base border border-default bg-neutral-primary-soft p-4 shadow-xs sm:p-6 xl:col-span-2">
            <div class="mb-6 flex items-start justify-between gap-4">
                <div>
                    <span class="text-2xl font-bold leading-none text-heading sm:text-3xl">{{ number_format($totalUsers) }}</span>
                    <h3 class="text-base font-light text-body">Pengguna terdaftar</h3>
                </div>
                <span class="rounded-sm bg-neutral-tertiary px-2.5 py-0.5 text-xs font-medium text-heading">Berdasarkan peran</span>
            </div>

            {{-- Stacked bar --}}
            <div class="mb-6 flex h-4 w-full overflow-hidden rounded-full bg-neutral-tertiary">
                @foreach ($roleDistribution as $segment)
                    @if ($segment['value'] > 0)
                        <div class="{{ $segment['barClass'] }} h-4" style="width: {{ $segment['value'] / max($totalUsers, 1) * 100 }}%"
                            title="{{ $segment['label'] }}: {{ $segment['value'] }}"></div>
                    @endif
                @endforeach
            </div>

            <ul class="space-y-4">
                @foreach ($roleDistribution as $segment)
                    @php($percentage = round($segment['value'] / max($totalUsers, 1) * 100))
                    <li>
                        <div class="mb-1 flex items-center justify-between text-sm">
                            <span class="flex items-center gap-2 font-medium text-heading">
                                <span class="size-2.5 rounded-full {{ $segment['barClass'] }}"></span>
                                {{ $segment['label'] }}
                            </span>
                            <span class="text-body">{{ number_format($segment['value']) }} &middot; {{ $percentage }}%</span>
                        </div>
                        <div class="h-2 w-full rounded-full bg-neutral-tertiary">
                            <div class="{{ $segment['barClass'] }} h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="mt-6 flex items-center justify-end border-t border-default pt-4">
                <a href="{{ route('admin.users.index') }}"
                    class="inline-flex items-center rounded-base px-3 py-2 text-sm font-medium uppercase text-fg-brand hover:bg-neutral-tertiary">
                    Kelola Pengguna
                    <svg class="ms-1 size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Latest users --}}
        <div class="rounded-base border border-default bg-neutral-primary-soft p-4 shadow-xs sm:p-6">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-xl font-bold leading-none text-heading">Pengguna Terbaru</h3>
                <a href="{{ route('admin.users.index') }}" class="rounded-base p-2 text-sm font-medium text-fg-brand hover:bg-neutral-tertiary">
                    Lihat semua
                </a>
            </div>

            <ul role="list" class="divide-y divide-default">
                @forelse ($latestUsers as $user)
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center gap-4">
                            <span class="flex size-8 shrink-0 items-center justify-center rounded-full bg-neutral-tertiary text-sm font-semibold text-heading">
                                {{ str($user->name)->substr(0, 1)->upper() }}
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="truncate font-medium text-heading">{{ $user->name }}</p>
                                <p class="truncate text-sm text-body">{{ $user->email }}</p>
                            </div>
                            <div class="flex flex-col items-end gap-1">
                                <span class="rounded-sm px-2 py-0.5 text-xs font-medium {{ $roleBadgeClasses[$user->role] ?? 'bg-neutral-tertiary text-heading' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                                <span class="text-xs text-body">{{ $user->created_at?->format('d M Y') }}</span>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="py-3 text-sm text-body">Belum ada pengguna.</li>
                @endforelse
            </ul>

            @if ($latestUsers->hasPages())
                <div class="mt-4 border-t border-default pt-4">
                    {{ $latestUsers->onEachSide(1)->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
