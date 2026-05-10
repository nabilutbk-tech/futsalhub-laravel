<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    // Tambahkan 'image' di sini!
    protected $fillable = ['name', 'price_per_hour', 'image']; 

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}