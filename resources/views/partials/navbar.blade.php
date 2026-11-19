<nav class="fixed top-0 z-40 w-full border-b border-default bg-neutral-primary">
    <div class="flex h-16 items-center justify-between px-4 sm:px-6">
        <div class="flex items-center gap-2">
            @hasSection('sidebar')
                <button type="button" data-drawer-target="app-sidebar" data-drawer-toggle="app-sidebar"
                    aria-controls="app-sidebar"
                    class="inline-flex items-center rounded-base p-2 text-body hover:bg-neutral-tertiary focus:outline-none focus:ring-2 focus:ring-neutral-quaternary sm:hidden">
                    <span class="sr-only">Buka sidebar</span>
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            @endif

            <a href="{{ url('/') }}" class="text-xl font-semibold text-heading">
                {{ config('app.name', 'Menukang') }}
            </a>
        </div>

        <div class="flex items-center gap-2">
            @yield('navbar-actions')
        </div>
    </div>
</nav>
