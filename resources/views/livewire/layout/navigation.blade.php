<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use App\Helpers\SampQueryAPI;

new class extends Component
{

    public int $online = -1;

    public function mount(): void
    {
        try {
            $this->online = SampQueryAPI::getServerPlayerCount();
        } catch (\Throwable $e) {
            $this->online = -1;
        }
    }

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }

}; ?>

<nav x-data="{ open: false }">
    {{-- Top Bar --}}
    <div class="max-w-7xl mx-auto py-4 w-full px-4 lg:px-0">
        <div class="flex justify-between h-auto">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-24 w-auto fill-current text-gray-800 my-2" />
                    </a>
                </div>
            </div>

            {{-- PC: Server status + Play Now + Logout --}}
            <div class="hidden lg:flex sm:items-center sm:ms-6 space-x-4 w-fit">
                <a href="samp://{{config('app.server_ip')}}:{{config('app.server_ip_port')}}" class="inline-flex items-center space-x-2">
                    @if($online != -1)
                        <div class="h-3 w-3 rounded-full bg-green-600"></div>
                        <span class="text-green-600 font-semibold">{{$online}} Online</span>
                    @else
                        <div class="h-3 w-3 rounded-full bg-red-600"></div>
                        <span class="text-red-600 font-semibold">Offline</span>
                    @endif
                </a>
                <a href="samp://{{config('app.server_ip')}}:{{config('app.server_ip_port')}}" class="py-2 px-4 h-10 rounded-full inline-flex items-center justify-center bg-button-primary text-white font-semibold hover:bg-button-primary-hover transition">
                    {{ __('Play Now') }}
                </a>
                <button title="Đăng xuất" wire:click="logout" class="text-start h-10 w-10 rounded-full inline-flex items-center justify-center bg-gray-800 hover:bg-gray-700 text-[#787878] hover:text-[#C2C2C2] transition">
                    <x-heroicon-m-arrow-right-start-on-rectangle class="h-6 w-6" />
                </button>
            </div>

            {{-- Mobile: Hamburger --}}
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

    {{-- PC Navigation Bar --}}
    <div class="hidden bg-gray-800 max-w-7xl mx-auto px-5 rounded-lg border border-stroke-primary lg:flex items-center">
        {{-- Main Nav Links --}}
        <div class="flex items-center space-x-1 flex-1">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <x-heroicon-m-cube-transparent class="h-5 w-5" />
                <span>{{ __('Dashboard') }}</span>
            </x-nav-link>
            <x-nav-link :href="route('characters')" :active="request()->routeIs('characters*')">
                <x-heroicon-m-user-group class="h-5 w-5" />
                <span>{{ __('Nhân vật') }}</span>
            </x-nav-link>
            <x-nav-link :href="route('vehicles')" :active="request()->routeIs('vehicles')">
                <x-heroicon-m-truck class="h-5 w-5" />
                <span>{{ __('Phương tiện') }}</span>
            </x-nav-link>
            <x-nav-link :href="route('properties')" :active="request()->routeIs('properties')">
                <x-heroicon-m-home-modern class="h-5 w-5" />
                <span>{{ __('Bất động sản') }}</span>
            </x-nav-link>
            <x-nav-link :href="route('map')" :active="request()->routeIs('map')">
                <x-heroicon-m-map class="h-5 w-5" />
                <span>{{ __('Bản đồ') }}</span>
            </x-nav-link>
        </div>

        {{-- Dropdown --}}
        <div class="flex items-center">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <x-heroicon-m-bars-3 class="h-6 w-6 text-[#787878] hover:text-[#C2C2C2] transition" />
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="px-4 py-2">
                        <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Tài khoản</p>
                    </div>
                    <x-dropdown-link :href="route('account')">
                        <x-heroicon-m-user-circle class="w-4 h-4 mr-2" />
                        {{ __('Tài khoản') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('connections')">
                        <x-heroicon-m-globe-alt class="w-4 h-4 mr-2" />
                        {{ __('Kết nối') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('bancheck')">
                        <x-heroicon-m-shield-check class="w-4 h-4 mr-2" />
                        {{ __('Kiểm tra cấm') }}
                    </x-dropdown-link>

                    <div class="border-t border-gray-700 my-1"></div>
                    <div class="px-4 py-2">
                        <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Server</p>
                    </div>
                    <x-dropdown-link :href="route('adminrecord')">
                        <x-heroicon-m-scale class="w-4 h-4 mr-2" />
                        {{ __('Lý lịch quản trị') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('help')">
                        <x-heroicon-m-ticket class="w-4 h-4 mr-2" />
                        {{ __('Hỗ trợ') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('marketplace')">
                        <x-heroicon-m-banknotes class="w-4 h-4 mr-2" />
                        {{ __('Chợ') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('premium')">
                        <x-heroicon-m-star class="w-4 h-4 mr-2" />
                        {{ __('Premium') }}
                    </x-dropdown-link>

                    <div class="border-t border-gray-700 my-1"></div>
                    <x-dropdown-link :href="route('updates')">
                        <x-heroicon-m-bell class="w-4 h-4 mr-2" />
                        {{ __('Cập nhật') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
    </div>

    {{-- Mobile Navigation --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden bg-gray-800 mx-2 rounded-lg border border-stroke-primary">
        {{-- Server Status Mobile --}}
        <div class="px-4 py-3 border-b border-gray-700">
            <a href="samp://{{config('app.server_ip')}}:{{config('app.server_ip_port')}}" class="inline-flex items-center space-x-2">
                @if($online != -1)
                    <div class="h-2.5 w-2.5 rounded-full bg-green-600"></div>
                    <span class="text-green-600 font-semibold text-sm">{{$online}} Online</span>
                @else
                    <div class="h-2.5 w-2.5 rounded-full bg-red-600"></div>
                    <span class="text-red-600 font-semibold text-sm">Offline</span>
                @endif
            </a>
        </div>

        {{-- Main Links --}}
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <x-heroicon-m-cube-transparent class="h-5 w-5" />
                <span>{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('characters')" :active="request()->routeIs('characters*')">
                <x-heroicon-m-user-group class="h-5 w-5" />
                <span>{{ __('Nhân vật') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('vehicles')" :active="request()->routeIs('vehicles')">
                <x-heroicon-m-truck class="h-5 w-5" />
                <span>{{ __('Phương tiện') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('properties')" :active="request()->routeIs('properties')">
                <x-heroicon-m-home-modern class="h-5 w-5" />
                <span>{{ __('Bất động sản') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('map')" :active="request()->routeIs('map')">
                <x-heroicon-m-map class="h-5 w-5" />
                <span>{{ __('Bản đồ') }}</span>
            </x-responsive-nav-link>
        </div>

        {{-- Account Section --}}
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-300" x-data="{{ json_encode(['name' => auth()->user()->Username]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-400">Người chơi</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('account')">
                    <x-heroicon-m-user-circle class="h-5 w-5" />
                    <span>{{ __('Tài khoản') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('connections')">
                    <x-heroicon-m-globe-alt class="h-5 w-5" />
                    <span>{{ __('Kết nối') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('bancheck')">
                    <x-heroicon-m-shield-check class="h-5 w-5" />
                    <span>{{ __('Kiểm tra cấm') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('adminrecord')">
                    <x-heroicon-m-scale class="h-5 w-5" />
                    <span>{{ __('Lý lịch quản trị') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('help')">
                    <x-heroicon-m-ticket class="h-5 w-5" />
                    <span>{{ __('Hỗ trợ') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('marketplace')">
                    <x-heroicon-m-banknotes class="h-5 w-5" />
                    <span>{{ __('Chợ') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('premium')">
                    <x-heroicon-m-star class="h-5 w-5" />
                    <span>{{ __('Premium') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('updates')">
                    <x-heroicon-m-bell class="h-5 w-5" />
                    <span>{{ __('Cập nhật') }}</span>
                </x-responsive-nav-link>

                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        <x-heroicon-m-arrow-right-start-on-rectangle class="h-5 w-5" />
                        <span>{{ __('Đăng xuất') }}</span>
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
