<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $table = 'ucp_connections';
    protected $primaryKey = 'id';

    protected $fillable = [
        'account_id',
        'ip_address',
        'is_web',
        'created_at',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'account_id', 'id');
    }
}
