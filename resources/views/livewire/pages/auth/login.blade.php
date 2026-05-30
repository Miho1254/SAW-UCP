<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        auth()->user()->connections()->create([
            'ip_address' => request()->ip(),
            'is_web' => 1,
            'created_at' => now(),
        ]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col items-center justify-center h-full w-full space-y-4 max-w-sm">

    <div class="flex flex-col items-center justify-center space-y-2 w-full">
        <h2 class="font-manrope mt-6 text-xl font-bold text-center text-gray-200">{{ __('Welcome back to Los Santos!') }}</h2>
        <p class="mt-2 text-sm text-center text-gray-400">
            {{ __('Explore the streets of rural Los Santos during the peak of the 90s gang epidemic.') }}
        </p>
    </div>

    <div class="mb-4 w-full rounded-lg bg-gray-900 border border-stroke-primary p-3">
        <p class="text-xs text-gray-400">
            <span class="text-gray-300 font-medium">Lần đầu chơi?</span> Bạn cần
            <a href="{{ route('register') }}" class="text-blue-400 hover:underline" wire:navigate>đăng ký tài khoản</a>
            trước khi vào game.
        </p>
    </div>

    <form wire:submit="login" class="mt-4 w-full">
        <!-- Email Address -->
        <div>
            <x-input-label for="account_name" :value="__('Username')" />
            <x-text-input wire:model="form.account_name" id="account_name" class="block mt-1 w-full" type="text" name="account_name" required autofocus autocomplete="username" placeholder="Tên tài khoản" />
            <x-input-error :messages="$errors->get('form.account_name')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="inline-flex items-center justify-between w-full">
                <x-input-label for="account_password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-500 hover:text-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <x-text-input wire:model="form.account_password" id="account_password" class="block mt-1 w-full"
                            type="password"
                            name="account_password"
                            required autocomplete="current-password"
                            placeholder="Mật khẩu"
            />

            <x-input-error :messages="$errors->get('form.account_password')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center justify-center space-y-4">
            <x-primary-button class="w-full mt-4">
                {{ __('Log In') }}
            </x-primary-button>
            <a class="text-sm text-gray-600 hover:text-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}" wire:navigate>
                {{ __('Don\'t have an account?') }}
                <span class="underline font-semibold">{{ __('Register here') }}</span>
            </a>
        </div>


    </form>
</div>
