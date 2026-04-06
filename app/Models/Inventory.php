<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    //  Table name
    protected $table = 'inventories';

    //  Mass assignable fields
     protected $fillable = [
        'user_id','title', 'model', 'type', 'condition', 'stock_number',
        'mileage', 'transmission', 'description', 'features', 'price', 'images', 'primary_image'
    ];

    //  Agar tum timestamps use nahi karna chahte
    // public $timestamps = false;

    /*
    |--------------------------------------------------------------------------
    |  Relationships (optional - future use)
    |--------------------------------------------------------------------------
    */

    // Example: Inventory belongs to Dealer
    public function extraServices()
    {
        return $this->hasMany(InventoryExtraService::class);
    }

    // Example: Inventory belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    |  Scopes (optional - filtering ke liye useful)
    |--------------------------------------------------------------------------
    */

    // Filter by make
    public function scopeMake($query, $make)
    {
        if ($make) {
            return $query->where('make', $make);
        }
        return $query;
    }

    // Filter by condition
    public function scopeCondition($query, $condition)
    {
        if ($condition) {
            return $query->where('condition', $condition);
        }
        return $query;
    }
}