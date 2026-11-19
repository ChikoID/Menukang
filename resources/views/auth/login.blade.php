@extends('layouts.app')

@section('title', 'Masuk')

@php
    $inputClass = 'block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand';
    $errorInputClass = 'block w-full rounded-base border border-danger-subtle bg-danger-soft px-3 py-2.5 text-sm text-fg-danger-strong shadow-xs placeholder:text-fg-danger-strong focus:border-danger focus:ring-danger';
@endphp

@section('content')
    <div class="mx-auto w-full max-w-md py-8 sm:py-12">
        <div class="rounded-base border border-default bg-neutral-primary p-6 shadow-xs sm:p-8">
            <h1 class="mb-1 text-2xl font-semibold text-heading">Masuk</h1>
            <p class="mb-6 text-sm text-body">Masuk ke akun {{ config('app.name', 'Menukang') }} Anda.</p>

            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
                @csrf

                <div>
                    <label for="email" class="mb-2.5 block text-sm font-medium text-heading">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="{{ $errors->has('email') ? $errorInputClass : $inputClass }}"
                        placeholder="nama@email.com" autocomplete="email" required autofocus>
                    @error('email')
                        <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-2.5 block text-sm font-medium text-heading">Kata Sandi</label>
                    <input type="password" id="password" name="password"
                        class="{{ $errors->has('password') ? $errorInputClass : $inputClass }}"
                        placeholder="••••••••" autocomplete="current-password" required>
                    @error('password')
                        <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" value="1" @checked(old('remember'))
                        class="size-4 rounded-xs border border-default-medium bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                    <label for="remember" class="ms-2 text-sm font-medium text-heading">Ingat saya</label>
                </div>

                <button type="submit"
                    class="w-full rounded-base bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                    Masuk
                </button>

                <p class="text-center text-sm text-body">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-fg-brand hover:underline">Daftar sekarang</a>
                </p>
            </form>
        </div>
    </div>
@endsection
