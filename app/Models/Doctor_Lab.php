<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor_Lab extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_lab_name',
        'doctor_lab_specialty',
        'doctor_lab_certificate_image',
        'doctor_lab_phone',
        'doctor_lab_password',
        'doctor_lab_ident',
        'id_lab',
      
      
    ];
    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }


    public function booking_labs()
    {
        return $this->hasMany(Booking_Lab::class);
    }

 
}

