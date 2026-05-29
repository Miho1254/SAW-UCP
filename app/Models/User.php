<?php

namespace App\Models;

use App\Models\Character\Character;
use App\Models\User\AdminRecord;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasName
{
    use Notifiable;

    protected $table = 'accounts';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Username',
        'Key',
        'Salt',
        'Email',
        'IP',
        'RegiDate',
        'LastLogin',
        'UpdateDate',
        'EmailConfirmed',
    ];

    protected $hidden = [
        'Key',
        'Salt',
    ];

    protected function casts(): array
    {
        return [];
    }

    protected static function booted(): void
    {
        static::saving(function ($user) {
            $user->UpdateDate = now();
        });
    }

    public function characters(): HasMany
    {
        return $this->hasMany(Character::class, 'id', 'id');
    }

    public function adminRecords(): HasMany
    {
        return $this->hasMany(AdminRecord::class, 'account_id', 'id');
    }

    public function connections(): HasMany
    {
        return $this->hasMany(Connection::class, 'account_id', 'id');
    }

    public function is_admin(): bool
    {
        return $this->AdminLevel > 1;
    }

    public function getCharacterCount(): int
    {
        return $this->characters->count();
    }

    public function hasVerifiedEmail(): bool
    {
        return $this->EmailConfirmed == 1;
    }

    public function getAuthPassword()
    {
        return $this->Key;
    }

    public function getAuthPasswordName()
    {
        return 'Key';
    }

    public function username(): string
    {
        return 'Username';
    }

    public function getEmailForPasswordReset()
    {
        return $this->Email;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->AdminLevel >= 4;
    }

    public function getFilamentName(): string
    {
        return $this->Username;
    }
}
