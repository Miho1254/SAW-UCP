<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $table = 'houses';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Owned', 'Level', 'Description', 'OwnerID', 'Username',
        'Value', 'SafeMoney', 'Lock', 'Rentable', 'RentFee',
        'Pot', 'Crack', 'Heroin', 'Meth', 'Ecstasy', 'Materials',
        'Weapons0', 'Weapons1', 'Weapons2', 'Weapons3', 'Weapons4',
    ];

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'OwnerID', 'id');
    }

    public function getIsLockedAttribute(): bool
    {
        return $this->Lock > 0;
    }

    public function getIsRentableAttribute(): bool
    {
        return $this->Rentable > 0;
    }

    public function getTotalDrugsAttribute(): int
    {
        return $this->Pot + $this->Crack + $this->Heroin + $this->Meth + $this->Ecstasy;
    }
}
