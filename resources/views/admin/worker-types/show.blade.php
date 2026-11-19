@extends('layouts.app')

@section('title', $workerType->name)

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
                    <li><a href="{{ route('admin.worker-types.index') }}" class="hover:text-fg-brand">Jenis Tukang</a></li>
                    <li aria-hidden="true"><i class="fa-solid fa-chevron-right text-2xs"></i></li>
                    <li class="text-heading" aria-current="page">Detail</li>
                </ol>
            </nav>
            <h1 class="text-xl font-semibold text-heading sm:text-2xl">{{ $workerType->name }}</h1>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('admin.worker-types.edit', $workerType) }}"
                class="inline-flex items-center gap-2 rounded-base bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i> Edit
            </a>
            @if ($workerType->workers_count === 0)
                <form method="POST" action="{{ route('admin.worker-types.destroy', $workerType) }}"
                    onsubmit="return confirm(@js('Hapus jenis tukang '.$workerType->name.'?'))">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-base bg-danger px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-danger-strong focus:outline-none focus:ring-4 focus:ring-danger-medium">
                        <i class="fa-solid fa-trash" aria-hidden="true"></i> Hapus
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="grid gap-4 xl:grid-cols-3">
        {{-- Summary --}}
        <div class="rounded-base border border-default bg-neutral-primary-soft p-4 shadow-xs sm:p-6">
            <div class="mb-4 flex items-center gap-4">
                <span class="flex size-12 shrink-0 items-center justify-center rounded-base bg-success-soft text-xl text-fg-success">
                    <i class="fa-solid fa-toolbox" aria-hidden="true"></i>
                </span>
                <div>
                    <p class="text-sm text-body">Jumlah tukang</p>
                    <p class="text-2xl font-bold text-heading">{{ number_format($workerType->workers_count) }}</p>
                </div>
            </div>
            <h2 class="mb-1 text-sm font-medium text-body">Deskripsi</h2>
            <p class="text-heading">{{ $workerType->description ?? '-' }}</p>
        </div>

        {{-- Workers --}}
        <div class="overflow-hidden rounded-base border border-default bg-neutral-primary-soft shadow-xs xl:col-span-2">
            <h2 class="p-4 text-lg font-semibold text-heading sm:px-6">Daftar Tukang</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-body rtl:text-right">
                    <thead class="border-y border-default bg-neutral-secondary-soft text-sm text-body">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">Nama</th>
                            <th scope="col" class="px-6 py-3 font-medium">Area Layanan</th>
                            <th scope="col" class="px-6 py-3 font-medium">Pengalaman</th>
                            <th scope="col" class="px-6 py-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($workerType->workers as $worker)
                            <tr class="border-b border-default bg-neutral-primary last:border-b-0">
                                <th scope="row" class="whitespace-nowrap px-6 py-4">
                                    @if ($worker->user)
                                        <a href="{{ route('admin.users.show', $worker->user) }}" class="font-medium text-heading hover:text-fg-brand">
                                            {{ $worker->user->name }}
                                        </a>
                                        <div class="font-normal text-body">{{ $worker->user->email }}</div>
                                    @else
                                        <span class="text-body">-</span>
                                    @endif
                                </th>
                                <td class="px-6 py-4">{{ $worker->service_area ?? '-' }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $worker->experience_years ?? 0 }} tahun</td>
                                <td class="px-6 py-4">
                                    @if ($worker->status === 'active')
                                        <span class="rounded-sm bg-success-soft px-2 py-0.5 text-xs font-medium text-fg-success-strong">Aktif</span>
                                    @else
                                        <span class="rounded-sm bg-neutral-tertiary px-2 py-0.5 text-xs font-medium text-heading">Tidak aktif</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-neutral-primary">
                                <td colspan="4" class="px-6 py-8 text-center">Belum ada tukang dengan jenis ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
