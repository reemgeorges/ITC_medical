<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'Laboratories_name',
        'Laboratories_location',
        'Laboratories_describe',
        'Laboratories_image',
        'lab_license_image',
        'lab_license_number',
    ];




    public function doctor_labs()
    {
        return $this->hasMany(Doctor_Lab::class);
    }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}



