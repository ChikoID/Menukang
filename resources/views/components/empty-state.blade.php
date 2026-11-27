@props([
    'icon' => 'fa-solid fa-folder-open',
    'title' => 'Belum ada data',
    'message' => 'Data yang kamu cari belum tersedia.',
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center px-6 py-12 text-center']) }}>
    <div class="mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-brand-softer">
        <i class="{{ $icon }} text-3xl text-brand" aria-hidden="true"></i>
    </div>

    <h3 class="mb-2 text-xl font-bold text-heading font-raleway">
        {{ $title }}
    </h3>

    <p class="max-w-md text-sm leading-relaxed text-body font-open-sans">
        {{ $message }}
    </p>

    @if ($slot->isNotEmpty())
        <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
            {{ $slot }}
        </div>
    @endif

</div>
