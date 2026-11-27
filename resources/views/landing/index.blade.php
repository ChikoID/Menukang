@extends('layouts.app')

@section('title', 'Temukan Tukang Terpercaya')

{{-- Section selebar layar, tanpa padding bawaan <main>. --}}
@section('main-class', 'flex-1')

@php
    /** Tujuan tombol "cari tukang" sampai fitur pencarian tukang dibangun. */
    $findWorkerUrl = auth()->check() ? route('dashboard') : route('register');

    /** @var list<array{href: string, label: string}> $landingMenu */
    $landingMenu = [
        ['href' => '#home', 'label' => 'Beranda'],
        ['href' => '#tentang', 'label' => 'Tentang Kami'],
        ['href' => '#layanan', 'label' => 'Layanan'],
        ['href' => '#keunggulan', 'label' => 'Keunggulan'],
    ];

    /** @var list<array{title: string, description: string, image: string, alt: string, icon: string}> $services */
    $services = [
        [
            'title' => 'Tukang Bangunan',
            'description' => 'Membantu kebutuhan pembangunan rumah, renovasi, perbaikan, dan pekerjaan konstruksi lainnya.',
            'image' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=900',
            'alt' => 'Tukang bangunan sedang bekerja',
            'icon' => 'fa-solid fa-trowel-bricks',
        ],
        [
            'title' => 'Tukang Kebun',
            'description' => 'Membantu perawatan taman, pemangkasan tanaman, penataan kebun, dan menjaga kebersihan lingkungan.',
            'image' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=900',
            'alt' => 'Tukang kebun merawat tanaman',
            'icon' => 'fa-solid fa-seedling',
        ],
    ];

    /** @var list<array{title: string, description: string, icon: string}> $benefits */
    $benefits = [
        ['title' => 'Mudah Menemukan Tukang', 'description' => 'Temukan tenaga kerja sesuai kategori pekerjaan yang Anda butuhkan.', 'icon' => 'fa-solid fa-magnifying-glass'],
        ['title' => 'Pilihan Layanan', 'description' => 'Tersedia pilihan tukang bangunan dan tukang kebun dalam satu platform.', 'icon' => 'fa-solid fa-screwdriver-wrench'],
        ['title' => 'Praktis dan Efisien', 'description' => 'Membantu proses pencarian tenaga kerja menjadi lebih mudah dan terorganisir.', 'icon' => 'fa-solid fa-bolt'],
    ];
@endphp

@section('navbar-menu')
    <ul class="flex flex-col gap-1 p-4 text-sm font-medium md:flex-row md:gap-8 md:p-0">
        @foreach ($landingMenu as $menuItem)
            <li>
                <a href="{{ $menuItem['href'] }}"
                    class="block rounded-base px-3 py-2 text-body hover:bg-neutral-tertiary hover:text-fg-brand md:p-0 md:hover:bg-transparent">
                    {{ $menuItem['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection

@section('navbar-actions')
    @guest
        <a href="{{ route('login') }}"
            class="rounded-base px-4 py-2 text-sm font-medium text-fg-brand hover:bg-brand-softer">
            Masuk
        </a>
        <a href="{{ route('register') }}"
            class="hidden rounded-base bg-brand px-4 py-2 text-sm font-medium text-white shadow-xs hover:bg-brand-strong sm:inline-flex">
            Daftar
        </a>
    @endguest
@endsection

@section('content')
    {{-- Hero --}}
    <section id="home" class="scroll-mt-16 bg-krem">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-14 sm:px-6 lg:grid-cols-2 lg:px-8 lg:py-24">
            <div>
                <span class="mb-4 inline-flex rounded-full bg-white px-4 py-2 text-sm font-medium text-fg-brand shadow-xs">
                    Solusi Kebutuhan Tenaga Kerja
                </span>

                <h1 class="mb-5 text-4xl font-extrabold leading-tight text-heading lg:text-5xl">
                    Butuh Tukang? Temukan Solusinya di <span class="text-fg-brand">Menukang!</span>
                </h1>

                <p class="mb-8 max-w-lg text-base leading-relaxed text-body">
                    Bingung mencari tukang untuk kebutuhan bangunan atau kebun? Menukang hadir untuk membantu Anda
                    menemukan tenaga kerja sesuai kebutuhan dengan lebih mudah dan praktis.
                </p>

                <a href="#layanan"
                    class="inline-flex items-center gap-2 rounded-base bg-brand px-6 py-3 text-sm font-semibold text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                    Cari Tukang <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>

            <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1000" alt="Pekerja konstruksi"
                class="h-64 w-full rounded-3xl object-cover shadow-xl sm:h-80 lg:h-96">
        </div>
    </section>

    {{-- Tentang --}}
    <section id="tentang" class="scroll-mt-16 bg-white">
        <div class="mx-auto max-w-3xl px-4 py-16 text-center sm:px-6 lg:py-20">
            <h2 class="mb-4 text-3xl font-bold text-heading">Tentang Menukang</h2>
            <p class="leading-relaxed text-body">
                Menukang merupakan platform yang memudahkan masyarakat dalam menemukan tenaga kerja untuk kebutuhan
                pembangunan, renovasi, maupun perawatan taman dan kebun. Kami hadir untuk menghubungkan pengguna dengan
                tukang sesuai kategori pekerjaan yang dibutuhkan.
            </p>
        </div>
    </section>

    {{-- Layanan --}}
    <section id="layanan" class="scroll-mt-16 bg-krem">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
            <div class="mb-10 text-center">
                <h2 class="mb-2 text-3xl font-bold text-heading">Layanan Kami</h2>
                <p class="text-body">Pilih kategori tukang sesuai kebutuhan Anda.</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($services as $service)
                    <div class="overflow-hidden rounded-2xl border border-default bg-white shadow-xs transition hover:-translate-y-1.5 hover:shadow-lg">
                        <img src="{{ $service['image'] }}" alt="{{ $service['alt'] }}" class="h-56 w-full object-cover">

                        <div class="p-6">
                            <h3 class="mb-2 flex items-center gap-2 text-lg font-bold text-heading">
                                <i class="{{ $service['icon'] }} text-fg-brand" aria-hidden="true"></i>
                                {{ $service['title'] }}
                            </h3>
                            <p class="mb-5 text-sm leading-relaxed text-body">{{ $service['description'] }}</p>

                            <a href="{{ $findWorkerUrl }}"
                                class="inline-flex items-center gap-2 rounded-base border border-brand px-4 py-2 text-sm font-semibold text-fg-brand hover:bg-brand hover:text-white">
                                Lihat Tukang <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Keunggulan --}}
    <section id="keunggulan" class="scroll-mt-16 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
            <div class="mb-10 text-center">
                <h2 class="mb-2 text-3xl font-bold text-heading">Kenapa Memilih Menukang?</h2>
                <p class="text-body">Kemudahan dalam menemukan tenaga kerja untuk kebutuhan Anda.</p>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                @foreach ($benefits as $benefit)
                    <div class="rounded-2xl border border-default bg-krem p-6">
                        <span class="mb-5 flex size-12 items-center justify-center rounded-xl bg-brand text-xl text-white">
                            <i class="{{ $benefit['icon'] }}" aria-hidden="true"></i>
                        </span>
                        <h3 class="mb-2 font-bold text-heading">{{ $benefit['title'] }}</h3>
                        <p class="text-sm leading-relaxed text-body">{{ $benefit['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-white px-4 pb-16 sm:px-6 lg:px-8 lg:pb-20">
        <div class="mx-auto max-w-7xl rounded-3xl bg-brand px-6 py-14 text-center text-white">
            <h2 class="mb-3 text-3xl font-bold">Temukan Tukang yang Anda Butuhkan!</h2>
            <p class="mb-8 text-white/80">Mulai cari tenaga kerja sesuai kebutuhan Anda bersama Menukang.</p>
            <a href="{{ $findWorkerUrl }}"
                class="inline-flex items-center gap-2 rounded-base bg-white px-6 py-3 text-sm font-semibold text-fg-brand hover:bg-krem focus:outline-none focus:ring-4 focus:ring-white/40">
                Mulai Sekarang <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </section>
@endsection

@section('footer')
    <footer class="bg-hijau-gelap text-white">
        <div class="mx-auto max-w-7xl px-4 pt-12 pb-6 sm:px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-4">
                <div class="md:col-span-2">
                    <h2 class="mb-3 text-xl font-extrabold tracking-wide">MENUKANG.</h2>
                    <p class="max-w-sm text-sm leading-relaxed text-white/70">
                        Solusi mudah untuk menemukan tenaga kerja bangunan dan kebun sesuai kebutuhan Anda.
                    </p>
                </div>

                <div>
                    <h3 class="mb-3 text-sm font-bold">Navigasi</h3>
                    <ul class="space-y-2 text-sm text-white/70">
                        <li><a href="#home" class="hover:text-white">Beranda</a></li>
                        <li><a href="#tentang" class="hover:text-white">Tentang Kami</a></li>
                        <li><a href="#layanan" class="hover:text-white">Layanan</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="mb-3 text-sm font-bold">Layanan</h3>
                    <ul class="space-y-2 text-sm text-white/70">
                        <li><a href="#layanan" class="hover:text-white">Tukang Bangunan</a></li>
                        <li><a href="#layanan" class="hover:text-white">Tukang Kebun</a></li>
                    </ul>
                </div>
            </div>

            <hr class="my-6 border-white/20">

            <p class="text-center text-sm text-white/70">&copy; {{ now()->year }} Menukang. Semua hak dilindungi.</p>
        </div>
    </footer>
@endsection
