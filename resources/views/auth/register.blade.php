@extends('layouts.app')

@section('title', 'Daftar')

@php
    $inputClass = 'block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand';
    $errorInputClass = 'block w-full rounded-base border border-danger-subtle bg-danger-soft px-3 py-2.5 text-sm text-fg-danger-strong shadow-xs placeholder:text-fg-danger-strong focus:border-danger focus:ring-danger';
    $labelClass = 'mb-2.5 block text-sm font-medium text-heading';
@endphp

@section('content')
    <div class="mx-auto w-full max-w-2xl py-8 sm:py-12">
        <div class="rounded-base border border-default bg-neutral-primary p-6 shadow-xs sm:p-8">
            <h1 class="mb-1 text-2xl font-semibold text-heading">Daftar Akun</h1>
            <p class="mb-6 text-sm text-body">Buat akun sebagai pelanggan atau tukang.</p>

            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
                @csrf

                <div>
                    <span class="{{ $labelClass }}">Daftar sebagai</span>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach (['pelanggan' => 'Pelanggan', 'tukang' => 'Tukang'] as $roleValue => $roleLabel)
                            <label class="flex cursor-pointer items-center gap-2 rounded-base border border-default-medium bg-neutral-secondary-medium px-4 py-3 text-sm font-medium text-heading has-checked:border-brand has-checked:bg-brand-softer">
                                <input type="radio" name="role" value="{{ $roleValue }}" data-role-input
                                    class="size-4 border-default-medium text-fg-brand focus:ring-2 focus:ring-brand-soft"
                                    @checked(old('role', 'pelanggan') === $roleValue)>
                                {{ $roleLabel }}
                            </label>
                        @endforeach
                    </div>
                    @error('role')
                        <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name" class="{{ $labelClass }}">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="{{ $errors->has('name') ? $errorInputClass : $inputClass }}"
                            autocomplete="name" required autofocus>
                        @error('name')
                            <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="{{ $labelClass }}">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="{{ $errors->has('email') ? $errorInputClass : $inputClass }}"
                            placeholder="nama@email.com" autocomplete="email" required>
                        @error('email')
                            <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="{{ $labelClass }}">No. Telepon <span class="text-body-subtle">(opsional)</span></label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                            class="{{ $errors->has('phone') ? $errorInputClass : $inputClass }}"
                            placeholder="08xxxxxxxxxx" autocomplete="tel">
                        @error('phone')
                            <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="{{ $labelClass }}">Alamat <span class="text-body-subtle">(opsional)</span></label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}"
                            class="{{ $errors->has('address') ? $errorInputClass : $inputClass }}"
                            autocomplete="street-address">
                        @error('address')
                            <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="{{ $labelClass }}">Kata Sandi</label>
                        <input type="password" id="password" name="password"
                            class="{{ $errors->has('password') ? $errorInputClass : $inputClass }}"
                            placeholder="Minimal 8 karakter" autocomplete="new-password" required>
                        @error('password')
                            <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="{{ $labelClass }}">Konfirmasi Kata Sandi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="{{ $inputClass }}" autocomplete="new-password" required>
                    </div>
                </div>

                {{-- Data tambahan khusus tukang --}}
                <fieldset id="worker-fields" class="flex flex-col gap-5 rounded-base border border-default p-4 sm:p-5"
                    @if (old('role', 'pelanggan') !== 'tukang') hidden @endif>
                    <legend class="px-2 text-sm font-semibold text-heading">Data Tukang</legend>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="worker_type_id" class="{{ $labelClass }}">Jenis Tukang</label>
                            <select id="worker_type_id" name="worker_type_id"
                                class="{{ $errors->has('worker_type_id') ? $errorInputClass : $inputClass }}">
                                <option value="">Pilih jenis tukang</option>
                                @foreach ($workerTypes as $workerType)
                                    <option value="{{ $workerType->id }}" @selected((string) old('worker_type_id') === (string) $workerType->id)>
                                        {{ $workerType->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('worker_type_id')
                                <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="experience_years" class="{{ $labelClass }}">Pengalaman (tahun)</label>
                            <input type="number" id="experience_years" name="experience_years" min="0"
                                value="{{ old('experience_years') }}"
                                class="{{ $errors->has('experience_years') ? $errorInputClass : $inputClass }}">
                            @error('experience_years')
                                <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="service_area" class="{{ $labelClass }}">Area Layanan</label>
                        <input type="text" id="service_area" name="service_area" value="{{ old('service_area') }}"
                            class="{{ $errors->has('service_area') ? $errorInputClass : $inputClass }}"
                            placeholder="Contoh: Jakarta Selatan, Depok">
                        @error('service_area')
                            <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="{{ $labelClass }}">Deskripsi <span class="text-body-subtle">(opsional)</span></label>
                        <textarea id="description" name="description" rows="3"
                            class="{{ $errors->has('description') ? $errorInputClass : $inputClass }}"
                            placeholder="Ceritakan keahlian Anda">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                        @enderror
                    </div>
                </fieldset>

                <button type="submit"
                    class="w-full rounded-base bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                    Daftar
                </button>

                <p class="text-center text-sm text-body">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-fg-brand hover:underline">Masuk</a>
                </p>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const workerFields = document.getElementById('worker-fields');

            document.querySelectorAll('[data-role-input]').forEach((input) => {
                input.addEventListener('change', () => {
                    workerFields.hidden = input.value !== 'tukang';
                });
            });
        });
    </script>
@endpush
