@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
    <div class="mb-4">
        <nav class="mb-2 flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center gap-1.5 text-sm font-medium text-body">
                <li><a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 hover:text-fg-brand"><i class="fa-solid fa-house text-xs" aria-hidden="true"></i> Dashboard</a></li>
                <li aria-hidden="true"><i class="fa-solid fa-chevron-right text-2xs"></i></li>
                <li><a href="{{ route('admin.users.index') }}" class="hover:text-fg-brand">Pengguna</a></li>
                <li aria-hidden="true"><i class="fa-solid fa-chevron-right text-2xs"></i></li>
                <li class="text-heading" aria-current="page">Edit</li>
            </ol>
        </nav>
        <h1 class="text-xl font-semibold text-heading sm:text-2xl">Edit Pengguna: {{ $user->name }}</h1>
    </div>

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')
        @include('admin.users.form', ['user' => $user])
    </form>
@endsection
