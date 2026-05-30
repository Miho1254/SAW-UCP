<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;

new
#[Title('Phương tiện')]
#[Layout('layouts.app')]
class extends Component {

    public $vehicles;

    public function mount()
    {
        $this->vehicles = auth()->user()->vehicles()->get();
    }

}; ?>

<div class="p-6 space-y-6">
    <h1 class="text-2xl font-bold text-gray-200">Phương tiện của tôi</h1>

    @if($vehicles->isEmpty())
        <div class="bg-gray-900 rounded-lg border border-stroke-primary p-8 text-center">
            <x-heroicon-m-truck class="w-12 h-12 text-gray-600 mx-auto mb-3" />
            <p class="text-gray-400">Bạn chưa sở hữu phương tiện nào.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($vehicles as $v)
                <div class="bg-gray-900 rounded-lg border border-stroke-primary overflow-hidden">
                    <div class="bg-gray-800 h-32 flex items-center justify-center">
                        <img src="https://weedarr.wdfiles.com/local--files/veh/{{ $v->pvModelId }}.png" alt="{{ $v->vehicle_name }}" class="h-24 object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <x-heroicon-m-truck class="w-16 h-16 text-gray-600" style="display:none;" />
                    </div>
                    <div class="p-4 space-y-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-200 font-semibold">{{ $v->vehicle_name }}</h3>
                            <p class="text-gray-500 text-xs">ID: {{ $v->pvModelId }}</p>
                        </div>
                        @if($v->isImpounded)
                            <span class="px-2 py-1 text-xs rounded-full bg-red-900/50 text-red-400 border border-red-800">Bị tịch thu</span>
                        @elseif($v->isDisabled)
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-700 text-gray-400">Tắt</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-green-900/50 text-green-400 border border-green-800">Hoạt động</span>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div>
                            <p class="text-gray-500">Biển số</p>
                            <p class="text-gray-300">{{ $v->pvPlate ?: 'Không có' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Giá trị</p>
                            <p class="text-green-400">${{ number_format($v->pvPrice) }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Nhiên liệu</p>
                            <div class="flex items-center space-x-2">
                                <div class="flex-1 bg-gray-800 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $v->pvFuel }}%"></div>
                                </div>
                                <span class="text-gray-300">{{ number_format($v->pvFuel, 0) }}%</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-gray-500">Máu xe</p>
                            <div class="flex items-center space-x-2">
                                <div class="flex-1 bg-gray-800 rounded-full h-2">
                                    <div class="bg-{{ $v->healthPercent > 50 ? 'green' : ($v->healthPercent > 25 ? 'yellow' : 'red') }}-500 h-2 rounded-full" style="width: {{ $v->healthPercent }}%"></div>
                                </div>
                                <span class="text-gray-300">{{ $v->healthPercent }}%</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 text-xs text-gray-500">
                        <span class="inline-flex items-center space-x-1">
                            <x-heroicon-m-lock-closed class="w-3 h-3" />
                            <span>{{ $v->isLocked ? 'Khóa' : 'Mở' }}</span>
                        </span>
                        @if($v->pvTicket > 0)
                            <span class="inline-flex items-center space-x-1 text-yellow-500">
                                <x-heroicon-m-exclamation-triangle class="w-3 h-3" />
                                <span>Phạt: ${{ number_format($v->pvTicket) }}</span>
                            </span>
                        @endif
                        <span class="inline-flex items-center space-x-1">
                            <x-heroicon-m-paint-brush class="w-3 h-3" />
                            <span>{{ $v->pvColor1 }}/{{ $v->pvColor2 }}</span>
                        </span>
                    </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>