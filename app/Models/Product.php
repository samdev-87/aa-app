<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'photo',
        'stock',
        'sizes',
        'colors',
        'price',
        'discount',
        'category_id'
    ];
}
