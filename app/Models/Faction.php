<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faction extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Name',
        'Type',
    ];
}
