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
    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-4">
        <div class="flex items-start space-x-3">
            <x-heroicon-s-wrench-screwdriver class="w-6 h-6 text-orange-400 flex-shrink-0 mt-0.5" />
            <div class="flex-1">
                <h3 class="text-sm font-semibold text-gray-200 mb-1">Bị kẹt / Crash?</h3>
                <p class="text-xs text-gray-400 mb-3">Nếu bạn bị kẹt hoặc crash trong game, nhấn nút bên dưới rồi kết nối lại vào server.</p>
                <x-danger-button wire:click="fixStuck" wire:loading.attr="disabled" class="w-full text-sm">
                    <x-heroicon-s-wrench-screwdriver class="w-4 h-4 mr-1.5" />
                    Fix kẹt
                </x-danger-button>
            </div>
        </div>
    </div>
    @else
    <div class="bg-green-900/20 rounded-lg border border-green-800/50 p-4">
        <div class="flex items-start space-x-3">
            <x-heroicon-s-check-circle class="w-6 h-6 text-green-400 flex-shrink-0 mt-0.5" />
            <div>
                <h3 class="text-sm font-semibold text-green-300 mb-1">Đã gửi yêu cầu!</h3>
                <p class="text-xs text-green-400">Hãy kết nối lại vào server. Bạn sẽ được teleport về vị trí an toàn.</p>
            </div>
        </div>
    </div>
    @endif
</div>
