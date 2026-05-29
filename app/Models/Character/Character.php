<?php

namespace App\Models\Character;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = 'accounts';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Username',
        'IP',
        'Model',
        'Sex',
        'RegiDate',
    ];

    public function getCleanName(): string
    {
        return str_replace('_', ' ', $this->Username);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function getPlayerNameAttribute()
    {
        return $this->Username;
    }

    public function getPlayerSkinidAttribute()
    {
        return $this->Model;
    }

    public function getPlayerHoursAttribute()
    {
        return $this->Hours;
    }

    public function getPlayerLogindateAttribute()
    {
        return $this->LastLogin;
    }

    public function getPlayerRegisterdateAttribute()
    {
        return $this->RegiDate;
    }

    public function getPlayerAjailTimeAttribute()
    {
        return $this->JailTime;
    }

    public function getPlayerOajailReasonAttribute()
    {
        return $this->PrisonReason;
    }

    public function getPlayerOajailAdminAttribute()
    {
        return $this->PrisonedBy;
    }

    public function getPlayerIdAttribute()
    {
        return $this->id;
    }
}
