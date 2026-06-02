<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use App\Models\ReleaseNote;

new
#[Layout('layouts.update')]
#[Title('Xem cập nhật')]
class extends Component {

    public $slug;
    public $update;

    public function mount(): void
    {
        $this->update = ReleaseNote::where('slug', $this->slug)->first();
    }

    public function getImageUrl(): ?string
    {
        if (!$this->update->image) return null;
        return asset('storage/' . $this->update->image);
    }

}; ?>

<div>
    <div class="bg-gray-800 p-5 rounded-lg border border-stroke-primary mt-5">
        <div class="space-y-3">
            <span class="bg-[#83B41C]/25 font-ibm text-[#83B41C] font-bold tracking-widest text-xs rounded-full py-0.5 px-2">TỔNG QUAN TÍNH NĂNG</span>
            <h1 class="text-white text-2xl font-manrope">{{$update->title}}</h1>
            <span class="text-[#666666] text-sm text-semibold">Viết bởi {{$update->author}} · {{$update->created_at->diffForHumans()}}</span>
        </div>
        @if($update->image)
            <img src="{{ $this->getImageUrl() }}" alt="{{$update->title}}" class="w-full h-96 object-cover rounded-lg my-4">
        @endif
        <div class="text-gray-300 uses_discs render_markdown">
            {!! $update->description !!}
        </div>
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="text-gray-300 uses_discs render_markdown">
            {!! $update->content !!}
        </div>
        @if($update->added || $update->changed || $update->fixed || $update->removed)
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <div class="space-y-4">
                <h2 class="text-white text-xl font-manrope font-semibold">Nhật ký thay đổi</h2>
                @if($update->added)
                    <div>
                        <div class="text-green-500 inline-flex items-center space-x-1">
                            <x-heroicon-m-plus-circle class="w-5 h-5"/>
                            <h3 class="font-bold tracking-wide">THÊM MỚI</h3>
                        </div>
                        <div class="text-gray-300 list-disc uses_discs ml-2 render_markdown">
                            {!! $update->added !!}
                        </div>
                    </div>
                @endif
                @if($update->changed)
                    <div>
                        <div class="text-blue-400 inline-flex items-center space-x-1">
                            <x-heroicon-m-pencil-square class="w-5 h-5"/>
                            <h3 class="font-bold tracking-wide">THAY ĐỔI</h3>
                        </div>
                        <div class="text-gray-300 list-disc uses_discs ml-2 render_markdown">
                            {!! $update->changed !!}
                        </div>
                    </div>
                @endif
                @if($update->fixed)
                    <div>
                        <div class="text-orange-500 inline-flex items-center space-x-1">
                            <x-heroicon-m-bug-ant class="w-5 h-5"/>
                            <h3 class="font-bold tracking-wide">SỬA LỖI</h3>
                        </div>
                        <div class="text-gray-300 list-disc uses_discs ml-2 render_markdown">
                            {!! $update->fixed !!}
                        </div>
                    </div>
                @endif
                @if($update->removed)
                    <div>
                        <div class="text-red-500 inline-flex items-center space-x-1">
                            <x-heroicon-m-trash class="w-5 h-5"/>
                            <h3 class="font-bold tracking-wide">ĐÃ XÓA</h3>
                        </div>
                        <div class="text-gray-300 list-disc uses_discs ml-2 render_markdown">
                            {!! $update->removed !!}
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
