<nav class="fixed top-0 z-40 w-full border-b border-default bg-neutral-primary">
    <div class="mx-auto flex h-16 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8 @sectionMissing('sidebar') max-w-7xl @endif">
        <div class="flex items-center gap-2">
            @hasSection('sidebar')
                <button type="button" data-drawer-target="app-sidebar" data-drawer-toggle="app-sidebar"
                    aria-controls="app-sidebar"
                    class="inline-flex items-center rounded-base p-2 text-body hover:bg-neutral-tertiary focus:outline-none focus:ring-2 focus:ring-neutral-quaternary sm:hidden">
                    <span class="sr-only">Buka sidebar</span>
                    <x-icon name="menu" class="size-6" />
                </button>
            @endif

            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <x-application-logo class="size-8" />
                <span class="text-xl font-semibold text-heading">{{ config('app.name', 'Menukang') }}</span>
            </a>
        </div>

        <div class="flex items-center gap-2 md:order-2">
            @auth
                <button type="button" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom-end"
                    class="flex items-center gap-2 rounded-base px-2 py-1.5 text-sm hover:bg-neutral-tertiary focus:outline-none focus:ring-2 focus:ring-neutral-quaternary">
                    <span class="sr-only">Buka menu pengguna</span>
                    <span class="flex size-8 items-center justify-center rounded-full bg-brand-softer font-semibold text-fg-brand">
                        {{ str(auth()->user()->name)->substr(0, 1)->upper() }}
                    </span>
                    <span class="hidden font-medium text-heading sm:inline">{{ auth()->user()->name }}</span>
                    <x-icon name="chevron-down" class="hidden size-4 sm:inline" />
                </button>

                <div id="user-dropdown" class="z-50 hidden w-56 rounded-base border border-default bg-neutral-primary shadow-lg">
                    <div class="border-b border-default px-4 py-3">
                        <p class="text-sm font-medium text-heading">{{ auth()->user()->name }}</p>
                        <p class="truncate text-sm text-body-subtle">{{ auth()->user()->email }}</p>
                    </div>
                    <ul class="p-2 text-sm">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center gap-2 rounded-sm px-3 py-2 hover:bg-neutral-tertiary">
                                <x-icon name="home" class="size-4" /> Dashboard
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center gap-2 rounded-sm px-3 py-2 text-fg-danger hover:bg-danger-soft">
                                    <x-icon name="logout" class="size-4" /> Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="hidden items-center gap-2 md:flex">
                    <x-button :href="route('login')" variant="secondary" size="sm">Masuk</x-button>
                    <x-button :href="route('register')" size="sm">Daftar</x-button>
                </div>
            @endauth

            @sectionMissing('sidebar')
                <button type="button" data-collapse-toggle="navbar-menu" aria-controls="navbar-menu" aria-expanded="false"
                    class="inline-flex items-center rounded-base p-2 text-body hover:bg-neutral-tertiary focus:outline-none focus:ring-2 focus:ring-neutral-quaternary md:hidden">
                    <span class="sr-only">Buka menu navigasi</span>
                    <x-icon name="menu" class="size-6" />
                </button>
            @endif
        </div>

        @sectionMissing('sidebar')
            <div id="navbar-menu"
                class="absolute inset-x-0 top-16 hidden border-b border-default bg-neutral-primary md:static md:order-1 md:flex md:flex-1 md:justify-center md:border-0 md:bg-transparent">
                <ul class="flex flex-col gap-1 p-4 font-medium md:flex-row md:gap-6 md:p-0">
                    <li><x-nav-link :href="route('home')" :active="request()->routeIs('home')">Beranda</x-nav-link></li>
                    <li><x-nav-link :href="route('home') . '#layanan'">Layanan</x-nav-link></li>
                    <li><x-nav-link :href="route('home') . '#cara-kerja'">Cara Kerja</x-nav-link></li>

                    @guest
                        <li class="flex flex-col gap-2 border-t border-default pt-3 md:hidden">
                            <x-button :href="route('login')" variant="secondary">Masuk</x-button>
                            <x-button :href="route('register')">Daftar</x-button>
                        </li>
                    @endguest
                </ul>
            </div>
        @endif
    </div>
</nav>
