{{--
    Form pengguna bersama untuk halaman create dan edit.
    Variabel: $workerTypes, $user (opsional, hanya saat edit).
--}}
@php
    $user ??= null;
    $worker = $user?->worker;
    $selectedRole = old('role', $user?->role ?? 'pelanggan');

    $inputClass = 'block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand';
    $errorInputClass = 'block w-full rounded-base border border-danger-subtle bg-danger-soft px-3 py-2.5 text-sm text-fg-danger-strong shadow-xs placeholder:text-fg-danger-strong focus:border-danger focus:ring-danger';
    $labelClass = 'mb-2.5 block text-sm font-medium text-heading';
@endphp

<div class="grid gap-4 xl:grid-cols-3">
    {{-- Account data --}}
    <div class="rounded-base border border-default bg-neutral-primary-soft p-4 shadow-xs sm:p-6 xl:col-span-2">
        <h2 class="mb-4 text-lg font-semibold text-heading">Data Akun</h2>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="name" class="{{ $labelClass }}">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user?->name) }}"
                    class="{{ $errors->has('name') ? $errorInputClass : $inputClass }}" required>
                @error('name')
                    <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="{{ $labelClass }}">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user?->email) }}"
                    class="{{ $errors->has('email') ? $errorInputClass : $inputClass }}" placeholder="nama@email.com" required>
                @error('email')
                    <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="{{ $labelClass }}">No. Telepon <span class="font-normal text-body">(opsional)</span></label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone', $user?->phone) }}"
                    class="{{ $errors->has('phone') ? $errorInputClass : $inputClass }}" placeholder="08xxxxxxxxxx">
                @error('phone')
                    <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="{{ $labelClass }}">Peran</label>
                <select id="role" name="role" data-role-select
                    class="{{ $errors->has('role') ? $errorInputClass : $inputClass }}" required>
                    @foreach (['admin' => 'Admin', 'tukang' => 'Tukang', 'pelanggan' => 'Pelanggan'] as $roleValue => $roleLabel)
                        <option value="{{ $roleValue }}" @selected($selectedRole === $roleValue)>{{ $roleLabel }}</option>
                    @endforeach
                </select>
                @error('role')
                    <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="address" class="{{ $labelClass }}">Alamat <span class="font-normal text-body">(opsional)</span></label>
                <textarea id="address" name="address" rows="2"
                    class="{{ $errors->has('address') ? $errorInputClass : $inputClass }}">{{ old('address', $user?->address) }}</textarea>
                @error('address')
                    <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Password --}}
    <div class="rounded-base border border-default bg-neutral-primary-soft p-4 shadow-xs sm:p-6">
        <h2 class="mb-1 text-lg font-semibold text-heading">Kata Sandi</h2>
        @if ($user)
            <p class="mb-4 text-sm text-body">Kosongkan jika tidak ingin mengubah kata sandi.</p>
        @else
            <p class="mb-4 text-sm text-body">Minimal 8 karakter.</p>
        @endif

        <div class="flex flex-col gap-5">
            <div>
                <label for="password" class="{{ $labelClass }}">Kata Sandi{{ $user ? ' Baru' : '' }}</label>
                <input type="password" id="password" name="password" autocomplete="new-password"
                    class="{{ $errors->has('password') ? $errorInputClass : $inputClass }}" @required(! $user)>
                @error('password')
                    <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="{{ $labelClass }}">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                    class="{{ $inputClass }}" @required(! $user)>
            </div>
        </div>
    </div>

    {{-- Worker profile, only for the tukang role --}}
    <div id="worker-fields" class="rounded-base border border-default bg-neutral-primary-soft p-4 shadow-xs sm:p-6 xl:col-span-3"
        @if ($selectedRole !== 'tukang') hidden @endif>
        <h2 class="mb-4 flex items-center gap-2 text-lg font-semibold text-heading">
            <i class="fa-solid fa-helmet-safety text-fg-success" aria-hidden="true"></i> Profil Tukang
        </h2>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <label for="worker_type_id" class="{{ $labelClass }}">Jenis Tukang</label>
                <select id="worker_type_id" name="worker_type_id"
                    class="{{ $errors->has('worker_type_id') ? $errorInputClass : $inputClass }}">
                    <option value="">Pilih jenis tukang</option>
                    @foreach ($workerTypes as $workerType)
                        <option value="{{ $workerType->id }}"
                            @selected((string) old('worker_type_id', $worker?->worker_type_id) === (string) $workerType->id)>
                            {{ $workerType->name }}
                        </option>
                    @endforeach
                </select>
                @error('worker_type_id')
                    <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="service_area" class="{{ $labelClass }}">Area Layanan</label>
                <input type="text" id="service_area" name="service_area" value="{{ old('service_area', $worker?->service_area) }}"
                    class="{{ $errors->has('service_area') ? $errorInputClass : $inputClass }}" placeholder="Contoh: Jakarta Selatan">
                @error('service_area')
                    <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="experience_years" class="{{ $labelClass }}">Pengalaman (tahun)</label>
                <input type="number" id="experience_years" name="experience_years" min="0"
                    value="{{ old('experience_years', $worker?->experience_years) }}"
                    class="{{ $errors->has('experience_years') ? $errorInputClass : $inputClass }}">
                @error('experience_years')
                    <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="{{ $labelClass }}">Status</label>
                <select id="status" name="status" class="{{ $errors->has('status') ? $errorInputClass : $inputClass }}">
                    @foreach (['active' => 'Aktif', 'inactive' => 'Tidak aktif'] as $statusValue => $statusLabel)
                        <option value="{{ $statusValue }}" @selected(old('status', $worker?->status ?? 'active') === $statusValue)>{{ $statusLabel }}</option>
                    @endforeach
                </select>
                @error('status')
                    <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                @enderror
            </div>

            <div class="sm:col-span-2 lg:col-span-4">
                <label for="description" class="{{ $labelClass }}">Deskripsi <span class="font-normal text-body">(opsional)</span></label>
                <textarea id="description" name="description" rows="3" placeholder="Keahlian dan pengalaman tukang"
                    class="{{ $errors->has('description') ? $errorInputClass : $inputClass }}">{{ old('description', $worker?->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="mt-4 flex items-center justify-end gap-2">
    <a href="{{ route('admin.users.index') }}"
        class="inline-flex items-center rounded-base border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm font-medium text-heading shadow-xs hover:bg-neutral-tertiary-medium">
        Batal
    </a>
    <button type="submit"
        class="inline-flex items-center gap-2 rounded-base bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
        <i class="fa-solid fa-floppy-disk" aria-hidden="true"></i> Simpan
    </button>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const roleSelect = document.querySelector('[data-role-select]');
            const workerFields = document.getElementById('worker-fields');

            roleSelect.addEventListener('change', () => {
                workerFields.hidden = roleSelect.value !== 'tukang';
            });
        });
    </script>
@endpush
