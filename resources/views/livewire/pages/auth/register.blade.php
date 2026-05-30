<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;


new #[Layout('layouts.guest')] class extends Component
{
    public string $account_name = '';
    public string $account_email = '';
    public string $account_password = '';
    public string $account_password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'account_name' => ['required', 'string', 'max:32', 'unique:accounts,Username'],
            'account_email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'account_password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $salt = Str::random(10);
        $hashedPassword = strtoupper(hash('whirlpool', $validated['account_password'] . $salt));

        event(new Registered($user = User::create([
            'Username' => $validated['account_name'],
            'Key' => $hashedPassword,
            'Salt' => $salt,
            'Email' => $validated['account_email'],
            'IP' => request()->ip(),
            'RegiDate' => now(),
            'LastLogin' => now(),
            'BirthDate' => '1926-01-01',
        ])));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col items-center justify-center h-full w-full space-y-4">
    <div class="flex flex-col items-center justify-center">
        <h2 class="font-manrope mt-6 text-xl font-bold text-center text-gray-200">{{ __('Register an account') }}</h2>
    </div>

    <div class="mb-4 rounded-lg bg-blue-900/20 border border-blue-800/50 p-4">
        <div class="flex items-start space-x-3">
            <x-heroicon-s-information-circle class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" />
            <div class="text-sm text-blue-200 space-y-2">
                <p class="font-semibold text-blue-100">Lưu ý trước khi đăng ký:</p>
                <ul class="list-disc list-inside space-y-1 text-blue-300">
                    <li><strong>Tên tài khoản</strong> sẽ là tên nhân vật trong game, định dạng <code class="bg-blue-900/50 px-1 rounded">Họ_Tên</code> (ví dụ: <code class="bg-blue-900/50 px-1 rounded">Nguyen_Van_A</code>)</li>
                    <li>Sau khi đăng ký, hãy mở SA-MP và kết nối vào server — bạn sẽ tạo nhân vật lần đầu trong game</li>
                    <li>Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ, số và ký tự đặc biệt</li>
                </ul>
            </div>
        </div>
    </div>

    <form wire:submit="register" class="mt-4 w-full">
        <!-- Name -->
        <div>
            <x-input-label for="account_name" :value="__('Name')" />
            <x-text-input wire:model="account_name" id="account_name" class="block mt-1 w-full" type="text" name="account_name" required autofocus autocomplete="account_name" placeholder="Nhập tên tài khoản" />
            <p class="text-xs text-gray-500 mt-1">Tên này sẽ là tên nhân vật trong game. Phải theo định dạng Họ_Tên (ví dụ: Tran_Minh)</p>
            <x-input-error :messages="$errors->get('account_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="account_email" :value="__('Email')" />
            <x-text-input wire:model="account_email" id="account_email" class="block mt-1 w-full" type="email" name="account_email" required autocomplete="username" placeholder="Nhập địa chỉ email" />
            <x-input-error :messages="$errors->get('account_email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="account_password" :value="__('Password')" />

            <x-text-input wire:model="account_password" id="account_password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Nhập mật khẩu" />
            <p class="text-xs text-gray-500 mt-1">Tối thiểu 8 ký tự, bao gồm chữ, số và ký tự đặc biệt</p>
            <x-input-error :messages="$errors->get('account_password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="account_password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="account_password_confirmation" id="account_password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="account_password_confirmation" required autocomplete="new-password" placeholder="Xác nhận mật khẩu" />

            <x-input-error :messages="$errors->get('account_password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center justify-center space-y-4">
            <x-primary-button class="w-full mt-4">
                {{ __('Register') }}
            </x-primary-button>
            <a class="text-sm text-gray-600 hover:text-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Already have an account?') }}
                <span class="underline font-semibold">{{ __('Log in') }}</span>
            </a>
        </div>
    </form>

    <div class="mt-6 w-full rounded-lg bg-gray-900 border border-stroke-primary p-4">
        <h3 class="text-sm font-semibold text-gray-300 mb-3">Sau khi đăng ký thành công:</h3>
        <ol class="text-sm text-gray-400 space-y-2 list-decimal list-inside">
            <li>Tải và cài đặt <a href="https://www.sa-mp.mp/downloads/" class="text-blue-400 hover:underline" target="_blank">SA-MP</a> (nếu chưa có)</li>
            <li>Mở SA-MP → nhập địa chỉ server → kết nối</li>
            <li>Đăng nhập bằng tài khoản vừa tạo</li>
            <li>Tạo nhân vật (chọn giới tính, ngoại hình) — bước này chỉ làm 1 lần</li>
        </ol>
    </div>
</div>
