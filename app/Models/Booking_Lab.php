<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_Lab extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_lab_name',
        'booking_lab_father_name',
        'booking_lab_age',
        'booking_lab_gender',
        'name_analysis',
        'lab_id',
        'doctor_lab_id',
        'status_booking_lab',
        'review_lab',
        'user_id',
        'booking_date',
        'booking_datetime',

      
      
    ];
    public function doctor_lab()
    {
        return $this->belongsTo(Doctor_Lab::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
