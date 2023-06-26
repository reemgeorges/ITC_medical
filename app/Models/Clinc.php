<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinc extends Model
{
    use HasFactory;
    protected $fillable = [
        'clinic_name',
        'clinic_name_english',
 
      
      
    ];

    public function doctors()
    {
        return $this->HasMany(Doctor::class);
    }


}
