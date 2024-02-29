<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class Product extends Model
{
    protected $fillable = [
        'uuid',
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

    /**
     * @param $request Request
     * @return void
     */
    public static function validate($request)
    {
        $request->validate([
            //'title' => 'required|max:255',
            'photo' => 'image'
        ]);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
