<?php

namespace App\Models;

use App\Models\Character\Character;
use App\Models\User\AdminRecord;
use App\Models\Vehicle;
use App\Models\House;
use App\Models\Ban;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'BirthDate',
        'DedicatedTimestamp',
        'DedicatedDaymarker',
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
        static::creating(function ($user) {
            $user->DedicatedTimestamp = $user->DedicatedTimestamp ?? '1926-01-01';
            $user->DedicatedDaymarker = $user->DedicatedDaymarker ?? '1926-01-01';
        });
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

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'sqlID', 'id');
    }

    public function houses(): HasMany
    {
        return $this->hasMany(House::class, 'OwnerID', 'id');
    }

    public function businesses(): HasMany
    {
        return $this->hasMany(Business::class, 'OwnerID', 'id');
    }

    public function bans(): HasMany
    {
        return $this->hasMany(Ban::class, 'user_id', 'id');
    }

    public function faction(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Faction::class, 'Member', 'id');
    }

    public function getActiveBanAttribute()
    {
        return $this->bans()->where('status', 1)->first();
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
