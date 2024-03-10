<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class Product extends Model
{
    /**
     * PRODUCT ATTRIBUTES
     * $this->items - Item[] - contains the associated items
     */

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

    public static function sumPricesByQuantities($productsInCart, mixed $productsInSession)
    {
        $total = 0;
        foreach ($productsInCart as $product) {
            $total = $total + ($product->price);
        }

        return $total;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function specifications()
    {
        return $this->hasMany(Specification::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }
}
