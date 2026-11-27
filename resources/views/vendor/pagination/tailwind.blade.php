{{--
    Paginasi gaya Flowbite. Menimpa view bawaan Laravel, jadi otomatis dipakai oleh semua `$items->links()`.
--}}
@php
    $baseClass = 'flex h-9 items-center justify-center box-border border border-default-medium text-sm font-medium focus:outline-none';
    $linkClass = $baseClass . ' bg-neutral-secondary-medium text-body hover:bg-neutral-tertiary-medium hover:text-heading';
    $disabledClass = $baseClass . ' cursor-not-allowed bg-neutral-secondary-medium text-fg-disabled';
    $activeClass = $baseClass . ' bg-neutral-tertiary-medium text-fg-brand';
@endphp

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navigasi halaman" class="flex flex-wrap items-center justify-center gap-3 sm:justify-between">
        <p class="text-sm text-body">
            Menampilkan
            @if ($paginator->firstItem())
                <span class="font-semibold text-heading">{{ $paginator->firstItem() }}</span>
                &ndash;
                <span class="font-semibold text-heading">{{ $paginator->lastItem() }}</span>
            @else
                <span class="font-semibold text-heading">{{ $paginator->count() }}</span>
            @endif
            dari
            <span class="font-semibold text-heading">{{ $paginator->total() }}</span>
            data
        </p>

        <ul class="flex -space-x-px text-sm">
            {{-- Previous --}}
            <li>
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" class="{{ $disabledClass }} rounded-s-base px-3">
                        <i class="fa-solid fa-chevron-left text-xs sm:hidden" aria-hidden="true"></i>
                        <span class="hidden sm:inline">Sebelumnya</span>
                        <span class="sr-only sm:hidden">Sebelumnya</span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="{{ $linkClass }} rounded-s-base px-3">
                        <i class="fa-solid fa-chevron-left text-xs sm:hidden" aria-hidden="true"></i>
                        <span class="hidden sm:inline">Sebelumnya</span>
                        <span class="sr-only sm:hidden">Sebelumnya</span>
                    </a>
                @endif
            </li>

            {{-- Page numbers --}}
            @foreach ($elements as $element)
                {{-- "..." separator --}}
                @if (is_string($element))
                    <li>
                        <span aria-disabled="true" class="{{ $disabledClass }} w-9">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li>
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page" class="{{ $activeClass }} w-9">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" aria-label="Ke halaman {{ $page }}" class="{{ $linkClass }} w-9">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            <li>
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="{{ $linkClass }} rounded-e-base px-3">
                        <span class="hidden sm:inline">Berikutnya</span>
                        <span class="sr-only sm:hidden">Berikutnya</span>
                        <i class="fa-solid fa-chevron-right text-xs sm:hidden" aria-hidden="true"></i>
                    </a>
                @else
                    <span aria-disabled="true" class="{{ $disabledClass }} rounded-e-base px-3">
                        <span class="hidden sm:inline">Berikutnya</span>
                        <span class="sr-only sm:hidden">Berikutnya</span>
                        <i class="fa-solid fa-chevron-right text-xs sm:hidden" aria-hidden="true"></i>
                    </span>
                @endif
            </li>
        </ul>
    </nav>
@endif
