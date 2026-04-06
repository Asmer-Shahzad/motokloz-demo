<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryExtraService extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'inventory_id',
        'title',
        'price',
    ];

    // Relation: belongs to inventory
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}