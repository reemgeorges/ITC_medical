<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_Clinc extends Model
{
    use HasFactory;
    public $table ='booking_clincs' ;
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

    protected $casts = [
        'use_name' => 'string',
        'user_old' => 'string',
        'user_phone' => 'string',
     'user_gender' => 'integer',
      'booking_status' => 'integer',
        'booking_date' => 'date',
        'booking_datetime' => 'datetime',
        'review_booking' => 'integer',
        'user_id' => 'integer',
        'doctor_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
