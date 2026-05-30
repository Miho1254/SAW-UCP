<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    protected $table = 'bans';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'ip_address', 'reason', 'date_added', 'date_unban', 'status', 'admin',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getIsActiveAttribute(): bool
    {
        if ($this->status == 0) return false;
        if ($this->date_unban && strtotime($this->date_unban) < time()) return false;
        return true;
    }

    public function getIsPermanentAttribute(): bool
    {
        return is_null($this->date_unban) || $this->date_unban === '0000-00-00 00:00:00';
    }
}
