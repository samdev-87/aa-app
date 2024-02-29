<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'uuid',
        'title',
        'slug',
        'photo',
        'parent_id'
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

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function child_cat()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }
}
