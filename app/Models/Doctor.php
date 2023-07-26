<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Sanctum\HasApiTokens;

class Doctor extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    public $table = 'doctors';
    protected $fillable = [
        'doctor_name',
        'doctor_specialty',
        'doctor_certificate_image',
        'doctor_phone',
        'doctor_password',
        'doctor_description',
        'doctor_ident',
        'doctor_license_number',
        'doctor_license_image',
        'address_clinc_doctor',
        'clinc_id',

    ];




    public function clinc()
    {
        return $this->belongsTo(Clinc::class);
    }

    public function booking_clincs()
    {
        return $this->hasMany(Booking_Clinc::class);
    }


}
