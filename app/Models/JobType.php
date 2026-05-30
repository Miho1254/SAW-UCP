<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    protected $table = 'jobs_types';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['id', 'name'];
}
