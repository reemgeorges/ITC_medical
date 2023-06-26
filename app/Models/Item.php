<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'items_name',
        'items_name_english',
        'items_description',
        'items_description_english',
        'category_id',
      
    ];
    public function category()
    {
        return $this->belongsTo(category::class);
    }

}
