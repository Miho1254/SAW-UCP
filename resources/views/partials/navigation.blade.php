<nav x-data="{ open: false }">
    <div class="max-w-7xl mx-auto py-4 w-full px-4 lg:px-0">
        <div class="flex justify-between h-auto">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="transition hover:opacity-80">
                        <x-application-logo class="block h-24 w-auto fill-current text-gray-800 my-2" />
                    </a>
                </div>
            </div>

            <div class="hidden lg:flex sm:items-center sm:ms-6 space-x-4 w-fit">
                <a href="samp://{{config('app.server_ip')}}:{{config('app.server_ip_port')}}" class="inline-flex items-center space-x-2 transition hover:opacity-80" id="server-status-pc">
                    <div class="h-3 w-3 rounded-full bg-gray-500 animate-pulse"></div>
                    <span class="text-gray-400 font-semibold text-sm">Đang tải...</span>
                </a>
                <a href="samp://{{config('app.server_ip')}}:{{config('app.server_ip_port')}}" class="py-2 px-4 h-10 rounded-full inline-flex items-center justify-center bg-button-primary text-white font-semibold hover:bg-button-primary-hover transition-all duration-200 active:scale-95">
                    {{ __('Play Now') }}
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" title="Đăng xuất" class="text-start h-10 w-10 rounded-full inline-flex items-center justify-center bg-gray-800 hover:bg-gray-700 text-[#787878] hover:text-[#C2C2C2] transition-all duration-200 active:scale-95">
                        <x-heroicon-m-arrow-right-start-on-rectangle class="h-6 w-6" />
                    </button>
                </form>
            </div>

            <div class="-me-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- PC Nav --}}
    <div class="hidden bg-gray-800 max-w-7xl mx-auto px-5 rounded-lg border border-stroke-primary lg:flex items-center transition-all duration-200">
        <div class="flex items-center space-x-1 flex-1">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                <x-heroicon-m-cube-transparent class="h-5 w-5" />
                <span>Dashboard</span>
            </x-nav-link>
            <x-nav-link :href="route('characters')" :active="request()->routeIs('characters*')" wire:navigate>
                <x-heroicon-m-user-group class="h-5 w-5" />
                <span>Nhân vật</span>
            </x-nav-link>
            <x-nav-link :href="route('vehicles')" :active="request()->routeIs('vehicles')" wire:navigate>
                <x-heroicon-m-truck class="h-5 w-5" />
                <span>Phương tiện</span>
            </x-nav-link>
            <x-nav-link :href="route('properties')" :active="request()->routeIs('properties')" wire:navigate>
                <x-heroicon-m-home-modern class="h-5 w-5" />
                <span>Bất động sản</span>
            </x-nav-link>
            <x-nav-link :href="route('map')" :active="request()->routeIs('map')">
                <x-heroicon-m-map class="h-5 w-5" />
                <span>Bản đồ</span>
            </x-nav-link>
        </div>

        <div class="flex items-center">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-300 focus:outline-none transition duration-150 ease-in-out">
                        <x-heroicon-m-bars-3 class="h-6 w-6 text-[#787878] hover:text-[#C2C2C2] transition" />
                    </button>
                </x-slot>
                <x-slot name="content">
                    <div class="px-4 py-2">
                        <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Tài khoản</p>
                    </div>
                    <x-dropdown-link :href="route('account')" wire:navigate>
                        <x-heroicon-m-user-circle class="w-4 h-4 mr-2" /> Tài khoản
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('connections')" wire:navigate>
                        <x-heroicon-m-globe-alt class="w-4 h-4 mr-2" /> Kết nối
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('bancheck')" wire:navigate>
                        <x-heroicon-m-shield-check class="w-4 h-4 mr-2" /> Kiểm tra cấm
                    </x-dropdown-link>
                    <div class="border-t border-gray-700 my-1"></div>
                    <div class="px-4 py-2">
                        <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Server</p>
                    </div>
                    <x-dropdown-link :href="route('adminrecord')" wire:navigate>
                        <x-heroicon-m-scale class="w-4 h-4 mr-2" /> Lý lịch quản trị
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('help')" wire:navigate>
                        <x-heroicon-m-ticket class="w-4 h-4 mr-2" /> Hỗ trợ
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('marketplace')" wire:navigate>
                        <x-heroicon-m-banknotes class="w-4 h-4 mr-2" /> Chợ
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('premium')" wire:navigate>
                        <x-heroicon-m-star class="w-4 h-4 mr-2" /> Premium
                    </x-dropdown-link>
                    <div class="border-t border-gray-700 my-1"></div>
                    <x-dropdown-link :href="route('updates')" wire:navigate>
                        <x-heroicon-m-bell class="w-4 h-4 mr-2" /> Cập nhật
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('map')">
                        <x-heroicon-m-map class="w-4 h-4 mr-2" /> Bản đồ
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
    </div>

    {{-- Mobile Nav --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="lg:hidden bg-gray-800 mx-2 rounded-lg border border-stroke-primary" style="display: none;">
        <div class="px-4 py-3 border-b border-gray-700">
            <a href="samp://{{config('app.server_ip')}}:{{config('app.server_ip_port')}}" class="inline-flex items-center space-x-2" id="server-status-mobile">
                <div class="h-2.5 w-2.5 rounded-full bg-gray-500 animate-pulse"></div>
                <span class="text-gray-400 font-semibold text-sm">Đang tải...</span>
            </a>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>Dashboard</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('characters')" :active="request()->routeIs('characters*')" wire:navigate>Nhân vật</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('vehicles')" :active="request()->routeIs('vehicles')" wire:navigate>Phương tiện</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('properties')" :active="request()->routeIs('properties')" wire:navigate>Bất động sản</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('map')">Bản đồ</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-300">{{ auth()->user()->Username ?? '' }}</div>
                <div class="font-medium text-sm text-gray-400">Người chơi</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('account')" wire:navigate>Tài khoản</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('connections')" wire:navigate>Kết nối</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('bancheck')" wire:navigate>Kiểm tra cấm</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('adminrecord')" wire:navigate>Lý lịch quản trị</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('help')" wire:navigate>Hỗ trợ</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('marketplace')" wire:navigate>Chợ</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('premium')" wire:navigate>Premium</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('updates')" wire:navigate>Cập nhật</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-start">
                        <x-responsive-nav-link>Đăng xuất</x-responsive-nav-link>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
fetch('/server-status.php')
    .then(r => r.json())
    .then(data => {
        const pc = document.getElementById('server-status-pc');
        const mobile = document.getElementById('server-status-mobile');
        if (data.status) {
            if (pc) pc.innerHTML = '<div class="h-3 w-3 rounded-full bg-green-600"></div><span class="text-green-600 font-semibold text-sm">Online</span>';
            if (mobile) mobile.innerHTML = '<div class="h-2.5 w-2.5 rounded-full bg-green-600"></div><span class="text-green-600 font-semibold text-sm">Online</span>';
        } else {
            if (pc) pc.innerHTML = '<div class="h-3 w-3 rounded-full bg-red-600"></div><span class="text-red-600 font-semibold text-sm">Offline</span>';
            if (mobile) mobile.innerHTML = '<div class="h-2.5 w-2.5 rounded-full bg-red-600"></div><span class="text-red-600 font-semibold text-sm">Offline</span>';
        }
    })
    .catch(() => {
        const pc = document.getElementById('server-status-pc');
        const mobile = document.getElementById('server-status-mobile');
        if (pc) pc.innerHTML = '<div class="h-3 w-3 rounded-full bg-red-600"></div><span class="text-red-600 font-semibold text-sm">Offline</span>';
        if (mobile) mobile.innerHTML = '<div class="h-2.5 w-2.5 rounded-full bg-red-600"></div><span class="text-red-600 font-semibold text-sm">Offline</span>';
    });
</script>
