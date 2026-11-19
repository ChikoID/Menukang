{{--
    Form jenis tukang bersama untuk halaman create dan edit.
    Variabel: $workerType (opsional, hanya saat edit).
--}}
@php
    $workerType ??= null;

    $inputClass = 'block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand';
    $errorInputClass = 'block w-full rounded-base border border-danger-subtle bg-danger-soft px-3 py-2.5 text-sm text-fg-danger-strong shadow-xs placeholder:text-fg-danger-strong focus:border-danger focus:ring-danger';
    $labelClass = 'mb-2.5 block text-sm font-medium text-heading';
@endphp

<div class="max-w-2xl rounded-base border border-default bg-neutral-primary-soft p-4 shadow-xs sm:p-6">
    <div class="flex flex-col gap-5">
        <div>
            <label for="name" class="{{ $labelClass }}">Nama Jenis Tukang</label>
            <input type="text" id="name" name="name" value="{{ old('name', $workerType?->name) }}"
                class="{{ $errors->has('name') ? $errorInputClass : $inputClass }}" placeholder="Contoh: Tukang Listrik" required>
            @error('name')
                <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="{{ $labelClass }}">Deskripsi <span class="font-normal text-body">(opsional)</span></label>
            <textarea id="description" name="description" rows="4" placeholder="Jelaskan jenis pekerjaan yang dilayani"
                class="{{ $errors->has('description') ? $errorInputClass : $inputClass }}">{{ old('description', $workerType?->description) }}</textarea>
            @error('description')
                <p class="mt-2 text-sm text-fg-danger-strong">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-2 border-t border-default pt-4">
        <a href="{{ route('admin.worker-types.index') }}"
            class="inline-flex items-center rounded-base border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm font-medium text-heading shadow-xs hover:bg-neutral-tertiary-medium">
            Batal
        </a>
        <button type="submit"
            class="inline-flex items-center gap-2 rounded-base bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
            <i class="fa-solid fa-floppy-disk" aria-hidden="true"></i> Simpan
        </button>
    </div>
</div>
