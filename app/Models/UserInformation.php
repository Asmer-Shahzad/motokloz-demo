<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;

    protected $table = 'user_information';
    
    protected $fillable = [
        'user_id',
        'full_name',
        'contact_number',
        'personal_website',
        'bio',
        'languages',
        'nationality',
        'avatar',
        'country',
        'city',
        'complete_address',
        'find_on_map',
        'postalCode'
    ];

    // ✅ Yeh relation sahi hai
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}