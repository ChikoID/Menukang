@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('navbar-actions')
    @if (Route::has('login'))
        @auth
            <a href="{{ url('/dashboard') }}"
                class="rounded-base border border-default bg-neutral-primary px-4 py-2 text-sm font-medium text-heading hover:bg-neutral-tertiary">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}"
                class="rounded-base px-4 py-2 text-sm font-medium text-heading hover:bg-neutral-tertiary">
                Masuk
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="rounded-base bg-brand px-4 py-2 text-sm font-medium text-white hover:bg-brand-strong">
                    Daftar
                </a>
            @endif
        @endauth
    @endif
@endsection

@section('content')
    <div class="mx-auto max-w-4xl py-8 sm:py-16">
        <div class="rounded-base border border-default bg-neutral-primary p-6 shadow-xs lg:p-12">
            <h1 class="mb-2 text-2xl font-semibold text-heading">Let's get started</h1>
            <p class="mb-6 text-body">
                With so many options available to you, we suggest you start with the following:
            </p>

            <ul class="mb-6 flex flex-col gap-3">
                <li>
                    Read the
                    <a href="https://laravel.com/docs" target="_blank" rel="noopener"
                        class="font-medium text-fg-brand underline underline-offset-4">Documentation</a>
                </li>
                <li>
                    Watch video tutorials at
                    <a href="https://laracasts.com" target="_blank" rel="noopener"
                        class="font-medium text-fg-brand underline underline-offset-4">Laracasts</a>
                </li>
            </ul>

            <a href="https://cloud.laravel.com" target="_blank" rel="noopener"
                class="inline-block rounded-base bg-brand px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-strong">
                Deploy now
            </a>

            <p class="mt-8 text-sm text-body-subtle">
                Laravel v{{ app()->version() }}
                <a href="https://github.com/laravel/framework/blob/13.x/CHANGELOG.md" target="_blank" rel="noopener"
                    class="ml-1 font-medium text-fg-brand underline underline-offset-4">View changelog</a>
            </p>
        </div>
    </div>
@endsection
