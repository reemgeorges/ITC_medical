<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_Lab extends Model
{
    use HasFactory;
    public $table ='booking_labs' ;
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

    protected $casts = [
        'booking_lab_name' => 'string',
        'booking_lab_father_name' => 'string',
        'booking_lab_age' => 'string',
        'booking_lab_gender' => 'integer',
        'name_analysis' => 'string',
        'lab_id' => 'integer',
        'doctor_lab_id' => 'integer',
        'status_booking_lab' => 'integer',
        'review_lab' => 'integer',
        'user_id' => 'integer',
        'booking_date' => 'date',
        'booking_datetime' => 'datetime',
    ];
    public function doctor_lab()
    {
        return $this->belongsTo(Doctor_Lab::class);
    }
    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
