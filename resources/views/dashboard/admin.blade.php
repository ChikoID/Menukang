@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-heading">Dashboard Admin</h1>
        <p class="text-body">Ringkasan data {{ config('app.name', 'Menukang') }}.</p>
    </div>

    <div class="mb-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            'Total Pengguna' => $totalUsers,
            'Tukang' => $totalTukang,
            'Pelanggan' => $totalPelanggan,
            'Jenis Tukang' => $totalWorkerTypes,
        ] as $statLabel => $statValue)
            <div class="rounded-base border border-default bg-neutral-primary-soft p-6 shadow-xs">
                <p class="text-sm font-medium text-body">{{ $statLabel }}</p>
                <p class="mt-2 text-3xl font-semibold text-heading">{{ number_format($statValue) }}</p>
            </div>
        @endforeach
    </div>

    <div class="relative overflow-x-auto rounded-base border border-default bg-neutral-primary-soft shadow-xs">
        <div class="flex items-center justify-between gap-4 p-4">
            <h2 class="text-lg font-semibold text-heading">Pengguna Terbaru</h2>
            <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-fg-brand hover:underline">Lihat semua</a>
        </div>

        <table class="w-full text-left text-sm text-body rtl:text-right">
            <thead class="border-y border-default bg-neutral-secondary-soft text-sm text-body">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">Nama</th>
                    <th scope="col" class="px-6 py-3 font-medium">Email</th>
                    <th scope="col" class="px-6 py-3 font-medium">Peran</th>
                    <th scope="col" class="px-6 py-3 font-medium">Terdaftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($latestUsers as $user)
                    <tr class="border-b border-default bg-neutral-primary last:border-b-0">
                        <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-heading">{{ $user->name }}</th>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="rounded-sm bg-brand-softer px-1.5 py-0.5 text-xs font-medium text-fg-brand-strong">{{ ucfirst($user->role) }}</span>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">{{ $user->created_at?->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr class="bg-neutral-primary">
                        <td colspan="4" class="px-6 py-4 text-center">Belum ada pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
