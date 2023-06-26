<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'categories_name',
        'categories_image',
        'categories_name_english',
 
    ];
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
