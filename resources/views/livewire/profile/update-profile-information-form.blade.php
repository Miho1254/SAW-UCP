<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $account_name = '';
    public string $account_email = '';

    public function mount(): void
    {
        $this->account_name = Auth::user()->Username;
        $this->account_email = Auth::user()->Email;
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'account_name' => ['required', 'string', 'max:32'],
            'account_email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        ]);

        $user->fill([
            'Username' => $validated['account_name'],
            'Email' => $validated['account_email'],
        ]);

        if ($user->isDirty('Email')) {
            $user->EmailConfirmed = 0;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->Username);
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-200">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="account_name" :value="__('Name')" />
            <x-text-input wire:model="account_name" id="account_name" name="account_name" type="text" class="mt-1 block w-full" required autofocus autocomplete="account_name" />
            <x-input-error class="mt-2" :messages="$errors->get('account_name')" />
        </div>

        <div>
            <x-input-label for="account_email" :value="__('Email')" />
            <x-text-input wire:model="account_email" id="account_email" name="account_email" type="email" class="mt-1 block w-full" required autocomplete="account_email" />
            <x-input-error class="mt-2" :messages="$errors->get('account_email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
