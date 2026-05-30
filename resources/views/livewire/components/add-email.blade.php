<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;


new class extends Component {

    public $account_email;

    public function addEmail()
    {
        $user = Auth::user();

        $validated = $this->validate([
            'account_email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        ]);

        $user->Email = $validated['account_email'];
        $user->save();

        return redirect()->route('dashboard');
    }

}; ?>


<div>
    <div class="flex flex-col">
        <h2 class="text-gray-100 text-xl font-bold mb-2">Thêm email</h2>
        <p class="text-gray-400 mb-4">Để tiếp tục, bạn phải nhập địa chỉ email hợp lệ để xác nhận tài khoản.</p>
        <form wire:submit.prevent="addEmail" class="space-y-4">
            <div>
                <x-input-label for="account_email" :value="__('Email')" />
                <x-text-input wire:model="account_email" id="account_email" name="account_email" type="email" class="mt-1 block w-full" required autocomplete="account_email" />
                <x-input-error class="mt-2" :messages="$errors->get('account_email')" />
            </div>
            <x-primary-button type="submit" class="w-full">Thêm email</x-primary-button>
        </form>
    </div>
</div>
