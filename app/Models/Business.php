<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'businesses';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'Name', 'OwnerID', 'Username', 'Type', 'Value', 'Status',
        'Level', 'LevelProgress', 'SafeBalance', 'Inventory',
        'InventoryCapacity', 'AutoSale', 'TotalSales', 'TotalProfits',
    ];

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'OwnerID', 'id');
    }

    public function getTypeNameAttribute(): string
    {
        return match((int)$this->Type) {
            1 => 'Gas Station',
            2 => 'Clothing Store',
            3 => 'Restaurant',
            4 => 'Gun Shop',
            5 => 'Car Dealership',
            6 => 'Mechanic',
            7 => 'Bar/Club',
            8 => 'Store/Market',
            default => 'Other',
        };
    }

    public function getInventoryPercentAttribute(): float
    {
        if ($this->InventoryCapacity == 0) return 0;
        return round(($this->Inventory / $this->InventoryCapacity) * 100, 1);
    }
}
