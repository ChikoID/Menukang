@props([
    'rating' => 0,
    'max' => 5,
])

@php
    $rating = max(0, min((float) $rating, $max));
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-1']) }}>
    @for ($i = 1; $i <= $max; $i++)
        @if ($rating >= $i)
            <i class="fa-solid fa-star text-fg-yellow" aria-hidden="true"></i>
        @elseif ($rating >= $i - 0.5)
            <i class="fa-solid fa-star-half-stroke text-fg-yellow" aria-hidden="true"></i>
        @else
            <i class="fa-regular fa-star text-fg-disabled" aria-hidden="true"></i>
        @endif
    @endfor

    <span class="ml-1 text-sm font-medium text-body">
        {{ number_format($rating, 1) }}
    </span>
</div>
