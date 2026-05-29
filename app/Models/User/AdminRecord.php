<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AdminRecord extends Model
{
    protected $table = 'admin_record';
    protected $primaryKey = 'record_id';
    public $timestamps = false;

    protected $fillable = [
        'account_id',
        'record_type',
        'record_reason',
        'record_admin',
        'record_time',
        'record_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'account_id', 'id');
    }
}
