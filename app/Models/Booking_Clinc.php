<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_Clinc extends Model
{
    use HasFactory;
    protected $fillable = [
        'use_name',
        'user_old',
        'user_phone',
        'user_gender',
        'booking_status',
        'booking_date',
        'booking_datetime',
        'review_booking',
        'user_id',
        'doctor_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
