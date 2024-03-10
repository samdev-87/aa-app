<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $fillable = [
        'uuid',
        'title',
        'product_id',
        'size',
        'color',
        'price',
        'discount',
        'photo',
        'stock',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
