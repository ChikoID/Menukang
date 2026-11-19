@extends('layouts.app')

@section('title', 'Dashboard')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-heading">Halo, {{ auth()->user()->name }}</h1>
        <p class="text-body">Selamat datang di {{ config('app.name', 'Menukang') }}.</p>
    </div>

    <div class="rounded-base border border-default bg-neutral-primary-soft p-6 shadow-xs">
        <p class="text-body">Akun Anda belum memiliki peran. Silakan hubungi admin untuk mengatur peran akun Anda.</p>
    </div>
@endsection
