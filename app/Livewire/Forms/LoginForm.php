<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|string')]
    public string $account_name = '';

    #[Validate('required|string')]
    public string $account_password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $user = User::where('Username', $this->account_name)->first();

        if (!$user) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'form.account_name' => trans('auth.failed'),
            ]);
        }

        $hashedInput = strtoupper(hash('whirlpool', $this->account_password . $user->Salt));

        if ($hashedInput !== $user->Key) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'form.account_name' => trans('auth.failed'),
            ]);
        }

        if ($user->Online != 0) {
            throw ValidationException::withMessages([
                'form.account_name' => 'Tai khoan dang online trong game. Vui long thoat game truoc khi dang nhap UCP.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Auth::login($user, false);
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.account_name' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->account_name).'|'.request()->ip());
    }
}
