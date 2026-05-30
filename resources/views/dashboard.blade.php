<x-app-layout>

    <div class="min-w-full h-auto sm:h-72 lg:h-80 md:uses_dashboard_background flex flex-col items-center space-y-8 sm:py-16 p-6 sm:px-0">
        <div class="flex flex-col items-center w-full space-y-2">
            <h1 class="text-white text-3xl font-bold text-center">Chào mừng trở lại, {{Auth::user()->Username}}</h1>
            @php $onlinePlayers = \Illuminate\Support\Facades\Cache::get('current_player_count', -1); @endphp
            <p class="text-gray-400 text-center w-full sm:w-1/2 md:w-1/3 lg:w-1/4">Đường phố đang chờ bạn. Tham gia ngay cùng {{$onlinePlayers != -1 ? $onlinePlayers : '' }} người chơi trực tuyến.</p>
        </div>
        <div class="sm:space-x-2 space-y-2 md:space-y-0">
            <x-primary-interactive-button href="samp://{{config('app.server_ip')}}:{{config('app.server_ip_port')}}" class="w-full sm:w-fit">
                <x-heroicon-m-play class="w-6 h-6 mr-2"/>
                {{ __('Play Now') }} <span class="md:hidden ml-1">(Chỉ PC)</span>
            </x-primary-interactive-button>
            <x-secondary-interactive-button href="https://www.sa-mp.mp/downloads/" class="w-full sm:w-fit">
                <img src="{{asset('assets/logos/samp.jpg')}}" class="w-6 h-6 mr-2" alt="GTA San Andreas Multiplayer Icon"/>
                {{ __('Get SA:MP') }}
            </x-secondary-interactive-button>
        </div>
    </div>
    @if(Auth::user()->Hours == 0 && Auth::user()->Registered == 0)
    <div class="mx-6 mt-4 rounded-lg bg-gradient-to-r from-blue-900/40 to-purple-900/40 border border-blue-700/50 p-5">
        <div class="flex items-start space-x-4">
            <x-heroicon-s-rocket-launch class="w-8 h-8 text-blue-400 flex-shrink-0" />
            <div>
                <h3 class="text-lg font-bold text-gray-100 mb-1">Chào mừng bạn đến với SAW Community!</h3>
                <p class="text-sm text-gray-300 mb-3">Đây là các bước để bắt đầu chơi:</p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="flex items-center space-x-2 bg-gray-800/50 rounded-lg p-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-bold flex items-center justify-center">1</span>
                        <span class="text-sm text-gray-300">Tải <a href="https://www.sa-mp.mp/downloads/" class="text-blue-400 hover:underline" target="_blank">SA-MP</a></span>
                    </div>
                    <div class="flex items-center space-x-2 bg-gray-800/50 rounded-lg p-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-bold flex items-center justify-center">2</span>
                        <span class="text-sm text-gray-300">Kết nối vào server</span>
                    </div>
                    <div class="flex items-center space-x-2 bg-gray-800/50 rounded-lg p-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-bold flex items-center justify-center">3</span>
                        <span class="text-sm text-gray-300">Tạo nhân vật & chơi!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 p-6">
        <div class="md:col-span-4 space-y-8">
            <livewire:components.dashboard-stats />
            <div>
                <h2 class="text-lg font-medium text-gray-400">
                    {{ __('Discord') }}
                </h2>
                <a target="_blank" href="{{config('app.discord_url') ?? ''}}" class="w-full p-3 bg-[#404EED] rounded-lg inline-flex items-center space-x-2 mt-4">
                    <img src="{{ asset('assets/logos/discord.svg') }}" alt="Discord Logo" class="h-12 w-12">
                    <span class="text-gray-200 font-semibold">Tham gia Discord</span>
                </a>
            </div>
            <livewire:components.fix-stuck />
        </div>
        <div class="md:col-span-8 w-full space-y-8">
            <livewire:components.dashboard-announcements/>

            @php
                $updates = \App\Models\ReleaseNote::orderBy('created_at', 'desc')->limit(5)->get();
            @endphp

            <div class="bg-gray-900 rounded-lg border border-stroke-primary p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-200 flex items-center space-x-2">
                        <x-heroicon-m-bell class="w-5 h-5 text-orange-400" />
                        <span>Ghi chú phát hành</span>
                    </h2>
                    <a href="{{ route('updates') }}" class="text-sm text-blue-400 hover:text-blue-300 transition" wire:navigate>Xem tất cả</a>
                </div>
                @if($updates->isEmpty())
                    <p class="text-sm text-gray-500">Chưa có cập nhật nào.</p>
                @else
                <div class="space-y-3">
                    @foreach($updates as $update)
                    <a href="{{ route('update.view', $update->slug) }}" class="block bg-gray-800 hover:bg-gray-750 rounded-lg border border-stroke-primary p-4 transition group" wire:navigate>
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-2 mb-1">
                                    @if($update->type === 'release')
                                        <span class="bg-green-500/25 text-green-400 text-xs font-bold px-2 py-0.5 rounded-full">PHÁT HÀNH</span>
                                    @else
                                        <span class="bg-orange-500/25 text-orange-400 text-xs font-bold px-2 py-0.5 rounded-full">GAME</span>
                                    @endif
                                    <span class="text-xs text-gray-500">{{ $update->created_at->diffForHumans() }}</span>
                                </div>
                                <h3 class="text-sm font-semibold text-gray-200 group-hover:text-white transition truncate">{{ $update->title }}</h3>
                                @if($update->description)
                                    <p class="text-xs text-gray-400 mt-1 line-clamp-2">{{ Str::limit(strip_tags($update->description), 120) }}</p>
                                @endif
                            </div>
                            <x-heroicon-m-chevron-right class="w-4 h-4 text-gray-600 group-hover:text-gray-400 flex-shrink-0 mt-1 ml-3 transition" />
                        </div>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="bg-gray-900 rounded-lg border border-stroke-primary p-6">
                <h2 class="text-lg font-semibold text-gray-200 mb-4 flex items-center space-x-2">
                    <x-heroicon-s-book-open class="w-5 h-5 text-blue-400" />
                    <span>Hướng dẫn bắt đầu</span>
                </h2>
                <div class="space-y-4 text-sm text-gray-300">
                    <div>
                        <h3 class="font-semibold text-gray-200 mb-1">Bước 1: Đăng ký tài khoản</h3>
                        <p class="text-gray-400">Truy cập trang đăng ký, nhập tên nhân vật (định dạng Họ_Tên), email và mật khẩu.</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-200 mb-1">Bước 2: Tải SA-MP</h3>
                        <p class="text-gray-400">Tải SA-MP tại <a href="https://www.sa-mp.mp/downloads/" class="text-blue-400 hover:underline" target="_blank">www.sa-mp.mp/downloads</a> và cài đặt.</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-200 mb-1">Bước 3: Kết nối vào server</h3>
                        <p class="text-gray-400">Mở SA-MP → Add Server → nhập địa chỉ server → Connect. Đăng nhập bằng tài khoản đã tạo.</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-200 mb-1">Bước 4: Tạo nhân vật</h3>
                        <p class="text-gray-400">Lần đầu vào game, hệ thống sẽ hướng dẫn bạn chọn giới tính, ngoại hình và hoàn thành tutorial.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
