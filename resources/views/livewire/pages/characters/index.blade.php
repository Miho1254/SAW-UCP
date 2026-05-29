<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;

new
#[Layout('layouts.app')]
#[Title('My Character')]
class extends Component {

    public $characters;
    public $charCount = 0;


    public function mount()
    {
        $this->characters = auth()->user()->characters;
        $this->charCount = $this->characters->count();
    }

}; ?>

<div>
        <div class="w-full inline-flex items-start justify-center p-6 space-x-4">
            <a href="{{ url()->previous() }}" class="h-10 w-10 hidden md:block rounded-full bg-[#2D2F34] p-2 text-gray-500 hover:text-gray-400 transition">
                <x-heroicon-c-arrow-left-circle class="w-6 h-6" />
            </a>
            <div class="w-full md:w-2/3 lg:w-1/2 space-y-4">
                <h1 class="text-2xl font-bold text-gray-200">{{ __('My Character') }}</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($characters as $character)
                        <x-characters.character-slot :character="$character" :locked="false" :has-premium="false" />
                    @endforeach
                </div>
            </div>
        </div>
</div>
