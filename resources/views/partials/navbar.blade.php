<nav class="fixed top-0 z-40 w-full border-b border-default bg-neutral-primary-soft">
    <div class="flex h-16 items-center justify-between px-3 lg:px-5">
        <div class="flex items-center justify-start gap-2">
            @hasSection('sidebar')
                <button type="button" data-drawer-target="app-sidebar" data-drawer-toggle="app-sidebar"
                    aria-controls="app-sidebar"
                    class="inline-flex items-center rounded-base p-2 text-body hover:bg-neutral-tertiary hover:text-heading focus:outline-none focus:ring-2 focus:ring-neutral-tertiary sm:hidden">
                    <span class="sr-only">Buka sidebar</span>
                    <svg class="size-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10" />
                    </svg>
                </button>
            @endif

            <a href="{{ url('/') }}" class="flex items-center gap-2 ms-1 md:me-24">
                <span class="flex size-8 items-center justify-center rounded-base bg-brand text-white">
                    <i class="fa-solid fa-screwdriver-wrench" aria-hidden="true"></i>
                </span>
                <span class="self-center whitespace-nowrap text-xl font-semibold text-heading">
                    {{ config('app.name', 'Menukang') }}
                </span>
            </a>
        </div>

        <div class="flex items-center gap-2">
            @yield('navbar-actions')

            @auth
                <button type="button" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom-end"
                    class="flex items-center gap-2 rounded-full text-sm focus:ring-4 focus:ring-neutral-tertiary">
                    <span class="sr-only">Buka menu pengguna</span>
                    <span class="flex size-8 items-center justify-center rounded-full bg-brand-softer font-semibold text-fg-brand">
                        {{ str(auth()->user()->name)->substr(0, 1)->upper() }}
                    </span>
                </button>

                <div id="user-dropdown" class="z-50 hidden w-56 rounded-base border border-default-medium bg-neutral-primary-medium shadow-lg">
                    <div class="border-b border-default-medium px-4 py-3 text-sm">
                        <span class="block font-medium text-heading">{{ auth()->user()->name }}</span>
                        <span class="block truncate text-body">{{ auth()->user()->email }}</span>
                    </div>
                    <ul class="p-2 text-sm font-medium text-body">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex w-full items-center gap-2 rounded-sm p-2 hover:bg-neutral-tertiary-medium hover:text-heading">
                                <i class="fa-solid fa-gauge w-4 text-center" aria-hidden="true"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="inline-flex w-full items-center gap-2 rounded-sm p-2 text-fg-danger hover:bg-neutral-tertiary-medium">
                                    <i class="fa-solid fa-right-from-bracket w-4 text-center" aria-hidden="true"></i>
                                    Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>
