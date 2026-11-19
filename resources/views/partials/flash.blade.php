@php
    /** @var array<string, array{class: string, icon: string}> $flashStyles */
    $flashStyles = [
        'success' => ['class' => 'border-success-subtle bg-success-soft text-fg-success-strong', 'icon' => 'fa-solid fa-circle-check'],
        'error' => ['class' => 'border-danger-subtle bg-danger-soft text-fg-danger-strong', 'icon' => 'fa-solid fa-circle-exclamation'],
    ];
@endphp

@foreach ($flashStyles as $flashKey => $flashStyle)
    @if (session()->has($flashKey))
        <div id="flash-{{ $flashKey }}" role="alert"
            class="mb-4 flex items-center gap-3 rounded-base border p-4 text-sm {{ $flashStyle['class'] }}">
            <i class="{{ $flashStyle['icon'] }} shrink-0" aria-hidden="true"></i>
            <div class="flex-1 font-medium">{{ session($flashKey) }}</div>
            <button type="button" data-dismiss-target="#flash-{{ $flashKey }}" aria-label="Tutup"
                class="-m-1.5 inline-flex size-8 items-center justify-center rounded-base hover:opacity-75 focus:ring-2 focus:ring-current">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
        </div>
    @endif
@endforeach
