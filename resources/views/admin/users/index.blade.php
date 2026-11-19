@extends('layouts.app')

@section('title', 'Pengguna')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@php
    /** @var array<string, string> $roleLabels */
    $roleLabels = ['admin' => 'Admin', 'tukang' => 'Tukang', 'pelanggan' => 'Pelanggan'];

    /** @var array<string, string> $roleBadgeClasses */
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
                    <li class="text-heading" aria-current="page">Pengguna</li>
                </ol>
            </nav>
            <h1 class="text-xl font-semibold text-heading sm:text-2xl">Pengguna</h1>
        </div>

        <a href="{{ route('admin.users.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-base bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
            <i class="fa-solid fa-plus" aria-hidden="true"></i> Tambah Pengguna
        </a>
    </div>

    <div class="relative overflow-hidden rounded-base border border-default bg-neutral-primary-soft shadow-xs">
        {{-- Filter --}}
        <form method="GET" action="{{ route('admin.users.index') }}"
            class="flex flex-col gap-3 border-b border-default p-4 md:flex-row md:items-center">
            <div class="relative w-full md:max-w-sm">
                <div class="pointer-events-none absolute inset-y-0 inset-s-0 flex items-center ps-3 text-body">
                    <i class="fa-solid fa-magnifying-glass text-sm" aria-hidden="true"></i>
                </div>
                <label for="search" class="sr-only">Cari pengguna</label>
                <input type="search" id="search" name="search" value="{{ $search }}" placeholder="Cari nama atau email..."
                    class="block w-full rounded-base border border-default-medium bg-neutral-secondary-medium py-2.5 ps-9 pe-3 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand">
            </div>

            <label for="role" class="sr-only">Filter peran</label>
            <select id="role" name="role"
                class="block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3 py-2.5 text-sm text-heading shadow-xs focus:border-brand focus:ring-brand md:w-48">
                <option value="">Semua peran</option>
                @foreach ($roleLabels as $roleValue => $roleLabel)
                    <option value="{{ $roleValue }}" @selected($role === $roleValue)>{{ $roleLabel }}</option>
                @endforeach
            </select>

            <div class="flex gap-2">
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-base border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm font-medium text-heading shadow-xs hover:bg-neutral-tertiary-medium focus:outline-none focus:ring-4 focus:ring-neutral-tertiary">
                    <i class="fa-solid fa-filter" aria-hidden="true"></i> Filter
                </button>
                @if ($search !== '' || $role !== '')
                    <a href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center rounded-base px-4 py-2.5 text-sm font-medium text-body hover:bg-neutral-tertiary hover:text-heading">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-body rtl:text-right">
                <thead class="border-b border-default bg-neutral-secondary-soft text-sm text-body">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">Nama</th>
                        <th scope="col" class="px-6 py-3 font-medium">Peran</th>
                        <th scope="col" class="px-6 py-3 font-medium">Telepon</th>
                        <th scope="col" class="px-6 py-3 font-medium">Jenis Tukang</th>
                        <th scope="col" class="px-6 py-3 font-medium">Terdaftar</th>
                        <th scope="col" class="px-6 py-3 font-medium"><span class="sr-only">Aksi</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b border-default bg-neutral-primary last:border-b-0 hover:bg-neutral-secondary-soft">
                            <th scope="row" class="whitespace-nowrap px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="flex size-9 shrink-0 items-center justify-center rounded-full bg-neutral-tertiary font-semibold text-heading">
                                        {{ str($user->name)->substr(0, 1)->upper() }}
                                    </span>
                                    <div>
                                        <div class="font-medium text-heading">{{ $user->name }}</div>
                                        <div class="font-normal text-body">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                <span class="rounded-sm px-2 py-0.5 text-xs font-medium {{ $roleBadgeClasses[$user->role] ?? 'bg-neutral-tertiary text-heading' }}">
                                    {{ $roleLabels[$user->role] ?? ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $user->phone ?? '-' }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $user->worker?->workerType?->name ?? '-' }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $user->created_at?->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.users.show', $user) }}" title="Detail"
                                        class="inline-flex size-8 items-center justify-center rounded-base text-body hover:bg-neutral-tertiary hover:text-heading">
                                        <i class="fa-solid fa-eye" aria-hidden="true"></i><span class="sr-only">Detail</span>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}" title="Edit"
                                        class="inline-flex size-8 items-center justify-center rounded-base text-body hover:bg-neutral-tertiary hover:text-fg-brand">
                                        <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i><span class="sr-only">Edit</span>
                                    </a>
                                    @unless ($user->is(auth()->user()))
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                            onsubmit="return confirm(@js('Hapus pengguna '.$user->name.'?'))">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus"
                                                class="inline-flex size-8 items-center justify-center rounded-base text-body hover:bg-danger-soft hover:text-fg-danger">
                                                <i class="fa-solid fa-trash" aria-hidden="true"></i><span class="sr-only">Hapus</span>
                                            </button>
                                        </form>
                                    @endunless
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-neutral-primary">
                            <td colspan="6" class="px-6 py-10 text-center">
                                <i class="fa-solid fa-users-slash mb-2 text-2xl" aria-hidden="true"></i>
                                <p>Tidak ada pengguna yang ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="border-t border-default p-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
