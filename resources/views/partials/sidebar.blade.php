@php
    /**
     * Menu sidebar per peran. Tambahkan item baru di sini; item yang route-nya belum ada akan disembunyikan.
     *
     * Ikon memakai class Font Awesome, contoh: 'fa-solid fa-users' (https://fontawesome.com/search).
     *
     * @var array<string, list<array{label: string, route: string, active: string, icon: string}>> $menusByRole
     */
    $menusByRole = [
        'admin' => [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'active' => 'admin.dashboard', 'icon' => 'fa-solid fa-chart-pie'],
            ['label' => 'Pengguna', 'route' => 'admin.users.index', 'active' => 'admin.users.*', 'icon' => 'fa-solid fa-users'],
        ],
        'tukang' => [
            ['label' => 'Dashboard', 'route' => 'tukang.dashboard', 'active' => 'tukang.dashboard', 'icon' => 'fa-solid fa-chart-pie'],
        ],
        'pelanggan' => [
            ['label' => 'Dashboard', 'route' => 'pelanggan.dashboard', 'active' => 'pelanggan.dashboard', 'icon' => 'fa-solid fa-chart-pie'],
        ],
    ];

    $sidebarMenu = collect($menusByRole[auth()->user()?->role] ?? [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'active' => 'dashboard', 'icon' => 'fa-solid fa-chart-pie'],
    ])->filter(fn (array $item): bool => Route::has($item['route']));
@endphp

<aside id="app-sidebar" aria-label="Sidebar"
    class="fixed top-0 left-0 z-30 h-screen w-64 -translate-x-full border-e border-default bg-neutral-primary-soft pt-16 transition-transform sm:translate-x-0">
    <div class="flex h-full flex-col overflow-y-auto px-3 py-4">
        <ul class="space-y-2 font-medium">
            @foreach ($sidebarMenu as $item)
                @php($isActive = request()->routeIs($item['active']))
                <li>
                    <a href="{{ route($item['route']) }}" @if ($isActive) aria-current="page" @endif
                        class="group flex items-center rounded-base px-2 py-1.5 {{ $isActive ? 'bg-neutral-tertiary text-fg-brand' : 'text-body hover:bg-neutral-tertiary hover:text-fg-brand' }}">
                        <i class="{{ $item['icon'] }} w-5 shrink-0 text-center text-base transition duration-75 {{ $isActive ? 'text-fg-brand' : 'group-hover:text-fg-brand' }}"
                            aria-hidden="true"></i>
                        <span class="ms-3">{{ $item['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
