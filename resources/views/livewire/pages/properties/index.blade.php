<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;

new
#[Title('Bất động sản')]
#[Layout('layouts.app')]
class extends Component {

    public $houses;
    public $businesses;

    public function mount()
    {
        $this->houses = auth()->user()->houses()->get();
        $this->businesses = auth()->user()->businesses()->get();
    }

}; ?>

<div class="p-6 space-y-8">
    {{-- Houses --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-200 mb-4">Nhà ở</h1>

        @if($houses->isEmpty())
            <div class="bg-gray-900 rounded-lg border border-stroke-primary p-8 text-center">
                <x-heroicon-m-home class="w-12 h-12 text-gray-600 mx-auto mb-3" />
                <p class="text-gray-400">Bạn chưa sở hữu nhà nào.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($houses as $h)
                    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-gray-200 font-semibold">Nhà #{{ $h->id }}</h3>
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-900/50 text-blue-400 border border-blue-800">Level {{ $h->Level }}</span>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div>
                                <p class="text-gray-500">Giá trị</p>
                                <p class="text-green-400">${{ number_format($h->Value) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Tiền két</p>
                                <p class="text-yellow-400">${{ number_format($h->SafeMoney) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Vật liệu</p>
                                <p class="text-gray-300">{{ number_format($h->Materials) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Trạng thái</p>
                                <p class="text-gray-300">{{ $h->isLocked ? '🔒 Khóa' : '🔓 Mở' }}</p>
                            </div>
                        </div>

                        @if($h->totalDrugs > 0)
                            <div class="bg-gray-800 rounded-lg p-3">
                                <p class="text-gray-400 text-xs mb-2">Ma túy trong két</p>
                                <div class="grid grid-cols-5 gap-1 text-xs text-center">
                                    @foreach(['Pot' => 'Pot', 'Crack' => 'Crack', 'Heroin' => 'Heroin', 'Meth' => 'Meth', 'Ecstasy' => 'Ecstasy'] as $label => $field)
                                        @if($h->$field > 0)
                                            <div class="bg-gray-700 rounded p-1">
                                                <p class="text-gray-400">{{ $label }}</p>
                                                <p class="text-gray-200">{{ $h->$field }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($h->isRentable)
                            <div class="text-xs text-gray-500">
                                Cho thuê: ${{ number_format($h->RentFee) }}/lần
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Businesses --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-200 mb-4">Doanh nghiệp</h1>

        @if($businesses->isEmpty())
            <div class="bg-gray-900 rounded-lg border border-stroke-primary p-8 text-center">
                <x-heroicon-m-building-storefront class="w-12 h-12 text-gray-600 mx-auto mb-3" />
                <p class="text-gray-400">Bạn chưa sở hữu doanh nghiệp nào.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($businesses as $b)
                    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-gray-200 font-semibold">{{ $b->Name }}</h3>
                            <span class="px-2 py-1 text-xs rounded-full bg-purple-900/50 text-purple-400 border border-purple-800">Level {{ $b->Level }}</span>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div>
                                <p class="text-gray-500">Loại</p>
                                <p class="text-gray-300">{{ $b->type_name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Giá trị</p>
                                <p class="text-green-400">${{ number_format($b->Value) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Két an toàn</p>
                                <p class="text-yellow-400">${{ number_format($b->SafeBalance) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Tồn kho</p>
                                <p class="text-gray-300">{{ number_format($b->Inventory) }}/{{ number_format($b->InventoryCapacity) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Tổng bán</p>
                                <p class="text-gray-300">{{ number_format($b->TotalSales) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Lợi nhuận</p>
                                <p class="text-green-400">${{ number_format($b->TotalProfits) }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-gray-500 text-xs mb-1">Tồn kho: {{ $b->inventory_percent }}%</p>
                            <div class="w-full bg-gray-800 rounded-full h-2">
                                <div class="bg-purple-500 h-2 rounded-full" style="width: {{ $b->inventory_percent }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>