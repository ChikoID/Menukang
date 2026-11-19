@extends('layouts.app')

@section('title', 'Jenis Tukang')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <nav class="mb-2 flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center gap-1.5 text-sm font-medium text-body">
                    <li><a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 hover:text-fg-brand"><i class="fa-solid fa-house text-xs" aria-hidden="true"></i> Dashboard</a></li>
                    <li aria-hidden="true"><i class="fa-solid fa-chevron-right text-2xs"></i></li>
                    <li class="text-heading" aria-current="page">Jenis Tukang</li>
                </ol>
            </nav>
            <h1 class="text-xl font-semibold text-heading sm:text-2xl">Jenis Tukang</h1>
        </div>

        <a href="{{ route('admin.worker-types.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-base bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
            <i class="fa-solid fa-plus" aria-hidden="true"></i> Tambah Jenis Tukang
        </a>
    </div>

    <div class="relative overflow-hidden rounded-base border border-default bg-neutral-primary-soft shadow-xs">
        {{-- Search --}}
        <form method="GET" action="{{ route('admin.worker-types.index') }}"
            class="flex flex-col gap-3 border-b border-default p-4 md:flex-row md:items-center">
            <div class="relative w-full md:max-w-sm">
                <div class="pointer-events-none absolute inset-y-0 inset-s-0 flex items-center ps-3 text-body">
                    <i class="fa-solid fa-magnifying-glass text-sm" aria-hidden="true"></i>
                </div>
                <label for="search" class="sr-only">Cari jenis tukang</label>
                <input type="search" id="search" name="search" value="{{ $search }}" placeholder="Cari jenis tukang..."
                    class="block w-full rounded-base border border-default-medium bg-neutral-secondary-medium py-2.5 ps-9 pe-3 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand">
            </div>

            <div class="flex gap-2">
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-base border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm font-medium text-heading shadow-xs hover:bg-neutral-tertiary-medium focus:outline-none focus:ring-4 focus:ring-neutral-tertiary">
                    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i> Cari
                </button>
                @if ($search !== '')
                    <a href="{{ route('admin.worker-types.index') }}"
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
                        <th scope="col" class="px-6 py-3 font-medium">Deskripsi</th>
                        <th scope="col" class="px-6 py-3 font-medium">Jumlah Tukang</th>
                        <th scope="col" class="px-6 py-3 font-medium"><span class="sr-only">Aksi</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($workerTypes as $workerType)
                        <tr class="border-b border-default bg-neutral-primary last:border-b-0 hover:bg-neutral-secondary-soft">
                            <th scope="row" class="whitespace-nowrap px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="flex size-9 shrink-0 items-center justify-center rounded-base bg-success-soft text-fg-success">
                                        <i class="fa-solid fa-toolbox" aria-hidden="true"></i>
                                    </span>
                                    <span class="font-medium text-heading">{{ $workerType->name }}</span>
                                </div>
                            </th>
                            <td class="max-w-md px-6 py-4">
                                <p class="line-clamp-2">{{ $workerType->description ?? '-' }}</p>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 rounded-sm bg-neutral-tertiary px-2 py-0.5 text-xs font-medium text-heading">
                                    <i class="fa-solid fa-helmet-safety" aria-hidden="true"></i> {{ $workerType->workers_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.worker-types.show', $workerType) }}" title="Detail"
                                        class="inline-flex size-8 items-center justify-center rounded-base text-body hover:bg-neutral-tertiary hover:text-heading">
                                        <i class="fa-solid fa-eye" aria-hidden="true"></i><span class="sr-only">Detail</span>
                                    </a>
                                    <a href="{{ route('admin.worker-types.edit', $workerType) }}" title="Edit"
                                        class="inline-flex size-8 items-center justify-center rounded-base text-body hover:bg-neutral-tertiary hover:text-fg-brand">
                                        <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i><span class="sr-only">Edit</span>
                                    </a>
                                    @if ($workerType->workers_count === 0)
                                        <form method="POST" action="{{ route('admin.worker-types.destroy', $workerType) }}"
                                            onsubmit="return confirm(@js('Hapus jenis tukang '.$workerType->name.'?'))">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus"
                                                class="inline-flex size-8 items-center justify-center rounded-base text-body hover:bg-danger-soft hover:text-fg-danger">
                                                <i class="fa-solid fa-trash" aria-hidden="true"></i><span class="sr-only">Hapus</span>
                                            </button>
                                        </form>
                                    @else
                                        <span title="Masih digunakan oleh tukang"
                                            class="inline-flex size-8 cursor-not-allowed items-center justify-center rounded-base text-fg-disabled">
                                            <i class="fa-solid fa-trash" aria-hidden="true"></i><span class="sr-only">Tidak dapat dihapus</span>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-neutral-primary">
                            <td colspan="4" class="px-6 py-10 text-center">
                                <i class="fa-solid fa-toolbox mb-2 text-2xl" aria-hidden="true"></i>
                                <p>Belum ada jenis tukang.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($workerTypes->hasPages())
            <div class="border-t border-default p-4">
                {{ $workerTypes->links() }}
            </div>
        @endif
    </div>
@endsection
