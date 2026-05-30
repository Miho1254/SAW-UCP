<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;

new
#[Title('Chợ')]
#[Layout('layouts.app')]
class extends Component {

}; ?>

<div class="p-6">
    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-12 text-center">
        <x-heroicon-m-banknotes class="w-16 h-16 text-gray-600 mx-auto mb-4" />
        <h1 class="text-2xl font-bold text-gray-200 mb-2">Chợ</h1>
        <p class="text-gray-400 mb-4">Mua bán trao đổi vật phẩm, phương tiện và bất động sản với người chơi khác.</p>
        <span class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-900/30 text-yellow-400 border border-yellow-800 text-sm font-medium">
            Sắp ra mắt
        </span>
    </div>
</div>
