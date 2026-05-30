<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;

new
#[Title('Kiểm tra cấm')]
#[Layout('layouts.app')]
class extends Component {

    public $bans;
    public $hasActiveBan = false;

    public function mount()
    {
        $this->bans = auth()->user()->bans()->orderByDesc('date_added')->get();
        $this->hasActiveBan = $this->bans->contains(fn($b) => $b->is_active);
    }

}; ?>

<div class="p-6 space-y-6">
    <h1 class="text-2xl font-bold text-gray-200">Trạng thái cấm</h1>

    @if($hasActiveBan)
        <div class="bg-red-900/30 border border-red-800 rounded-lg p-4 flex items-start space-x-3">
            <x-heroicon-m-exclamation-circle class="w-6 h-6 text-red-400 flex-shrink-0 mt-0.5" />
            <div>
                <p class="text-red-400 font-semibold">Tài khoản của bạn đang bị cấm.</p>
                <p class="text-red-300 text-sm mt-1">Vui lòng liên hệ quản trị viên nếu bạn muốn kháng cáo.</p>
            </div>
        </div>
    @else
        <div class="bg-green-900/30 border border-green-800 rounded-lg p-4 flex items-start space-x-3">
            <x-heroicon-m-check-circle class="w-6 h-6 text-green-400 flex-shrink-0 mt-0.5" />
            <div>
                <p class="text-green-400 font-semibold">Tài khoản của bạn không bị cấm.</p>
                <p class="text-green-300 text-sm mt-1">Bạn có thể chơi bình thường.</p>
            </div>
        </div>
    @endif

    @if($bans->isNotEmpty())
        <div class="bg-gray-900 rounded-lg border border-stroke-primary overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-stroke-primary">
                        <th class="text-left p-4 text-gray-400 font-medium">#</th>
                        <th class="text-left p-4 text-gray-400 font-medium">Lý do</th>
                        <th class="text-left p-4 text-gray-400 font-medium">Quản trị viên</th>
                        <th class="text-left p-4 text-gray-400 font-medium">Ngày cấm</th>
                        <th class="text-left p-4 text-gray-400 font-medium">Ngày hết hạn</th>
                        <th class="text-left p-4 text-gray-400 font-medium">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bans as $ban)
                        <tr class="border-b border-stroke-primary hover:bg-gray-800/50">
                            <td class="p-4 text-gray-300">{{ $ban->id }}</td>
                            <td class="p-4 text-gray-300">{{ $ban->reason }}</td>
                            <td class="p-4 text-gray-300">{{ $ban->admin }}</td>
                            <td class="p-4 text-gray-400 text-xs">{{ $ban->date_added }}</td>
                            <td class="p-4 text-gray-400 text-xs">{{ $ban->is_permanent ? 'Vĩnh viễn' : $ban->date_unban }}</td>
                            <td class="p-4">
                                @if($ban->is_active)
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-900/50 text-red-400 border border-red-800">Đang cấm</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-700 text-gray-400">Hết hạn</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-gray-900 rounded-lg border border-stroke-primary p-8 text-center">
            <x-heroicon-m-shield-check class="w-12 h-12 text-gray-600 mx-auto mb-3" />
            <p class="text-gray-400">Bạn chưa từng bị cấm. Tiếp tục như vậy!</p>
        </div>
    @endif
</div>
