@php
    /**
     * Menu sidebar per peran. Item yang route-nya belum terdaftar otomatis disembunyikan,
     * sehingga menu baru cukup ditambahkan di sini begitu route-nya dibuat.
     *
     * @var array<string, list<array{label: string, route: string, icon: string, active?: string}>> $menusByRole
     */
    $menusByRole = [
        'admin' => [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'home'],
            ['label' => 'Pengguna', 'route' => 'admin.users.index', 'icon' => 'users', 'active' => 'admin.users.*'],
        ],
        'tukang' => [
            ['label' => 'Dashboard', 'route' => 'tukang.dashboard', 'icon' => 'home'],
        ],
        'pelanggan' => [
            ['label' => 'Dashboard', 'route' => 'pelanggan.dashboard', 'icon' => 'home'],
        ],
    ];

    $menuItems = collect($menusByRole[auth()->user()?->role] ?? [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'home'],
    ])->filter(fn (array $item): bool => Route::has($item['route']));
@endphp

<aside id="app-sidebar" aria-label="Sidebar"
    class="fixed top-0 left-0 z-30 h-screen w-64 -translate-x-full border-r border-default bg-neutral-primary pt-16 transition-transform sm:translate-x-0">
    <div class="flex h-full flex-col overflow-y-auto px-3 py-4">
        <ul class="flex flex-col gap-1 font-medium">
            @foreach ($menuItems as $item)
                <li>
                    <x-sidebar-link :href="route($item['route'])" :icon="$item['icon']"
                        :active="request()->routeIs($item['active'] ?? $item['route'])">
                        {{ $item['label'] }}
                    </x-sidebar-link>
                </li>
            @endforeach
        </ul>

        <ul class="mt-auto flex flex-col gap-1 border-t border-default pt-4 font-medium">
            <li>
                <x-sidebar-link :href="route('home')" icon="globe">Ke Beranda</x-sidebar-link>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center gap-3 rounded-base px-3 py-2 text-fg-danger hover:bg-danger-soft">
                        <x-icon name="logout" class="size-5" />
                        <span>Keluar</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
