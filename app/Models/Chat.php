<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chats';

    protected $fillable = [
        'client_id',
        'user_id',
        'inventory_id',
        'message_body',
        'sender_type',
        'is_read',
        'time',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function dealer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
