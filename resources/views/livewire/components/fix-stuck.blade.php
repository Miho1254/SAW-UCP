<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

new class extends Component {

    public bool $fixed = false;

    public function fixStuck(): void
    {
        $user = Auth::user();

        DB::table('accounts')
            ->where('id', $user->id)
            ->update(['fixstuck' => 1]);

        $this->fixed = true;
    }

}; ?>

<div>
    @if(!$fixed)
    <div class="bg-gray-900 rounded-lg border border-stroke-primary overflow-hidden">
        <div class="border-l-4 border-amber-500 p-4">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 inline-flex items-center justify-center bg-amber-500/15 rounded-lg">
                        <x-heroicon-m-exclamation-triangle class="w-5 h-5 text-amber-400" />
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-200">Bị kẹt / Crash?</h3>
                        <p class="text-xs text-gray-500">Fix vị trí nhân vật</p>
                    </div>
                </div>
            </div>
            <p class="text-xs text-gray-400 mb-3 leading-relaxed">Nếu bạn bị kẹt hoặc crash trong game, nhấn nút bên dưới rồi kết nối lại vào server để được đưa về vị trí an toàn.</p>
            <button wire:click="fixStuck" wire:loading.attr="disabled" wire:target="fixStuck"
                class="w-full inline-flex items-center justify-center space-x-2 px-4 py-2.5 bg-amber-600 hover:bg-amber-700 disabled:opacity-50 disabled:cursor-not-allowed text-white text-sm font-medium rounded-lg transition-all duration-200 active:scale-[0.98]">
                <span wire:loading.remove wire:target="fixStuck" class="inline-flex items-center space-x-2">
                    <x-heroicon-m-wrench-screwdriver class="w-4 h-4" />
                    <span>Fix kẹt</span>
                </span>
                <span wire:loading wire:target="fixStuck" class="inline-flex items-center space-x-2">
                    <svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Đang xử lý...</span>
                </span>
            </button>
        </div>
    </div>
    @else
    <div class="bg-gray-900 rounded-lg border border-stroke-primary overflow-hidden">
        <div class="border-l-4 border-green-500 p-4">
            <div class="flex items-center space-x-2 mb-2">
                <div class="w-8 h-8 inline-flex items-center justify-center bg-green-500/15 rounded-lg">
                    <x-heroicon-m-check-circle class="w-5 h-5 text-green-400" />
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-green-300">Đã gửi yêu cầu!</h3>
                    <p class="text-xs text-gray-500">Thành công</p>
                </div>
            </div>
            <p class="text-xs text-gray-400 leading-relaxed ml-10">Hãy kết nối lại vào server. Bạn sẽ được teleport về vị trí an toàn.</p>
        </div>
    </div>
    @endif
</div>
