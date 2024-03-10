<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Specification;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Exchange1SController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats_arr = Arr::pluck(DB::table('categories')->select('id', 'uuid')->get(), 'id', 'uuid');

        return response()->json($cats_arr);
    }

    public function storeCategories(Request $request)
    {
        $data = $request->get('data');
        $cats_parent = [];

        foreach ($data as $item) {
            if (isset($item['puuid'])) continue;
            $cat = Category::updateOrCreate(
                ['uuid' => $item['uuid']],
                [
                    'title' => $item['title'],
                    'slug' => Str::slug($item['title']),
                ]
            );
            $cats_parent[$cat->id] = $item['uuid'];
        }

        foreach ($data as $item) {
            if (!isset($item['puuid'])) continue;

            try {
                Category::updateOrCreate(
                    ['uuid' => $item['uuid']],
                    [
                        'title' => $item['title'],
                        'slug' => Str::slug($item['title']),
                        'parent_id' => array_search($item['puuid'], $cats_parent),
                    ]
                );
            } catch (\Exception $e) {
                return $this->jsonResponse([
                    'status' => false,
                    'data' => $data,
                    'category' => $item,
                    'message' => $e->getMessage(),
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Categories created/updated successfully!'
        ]);
    }

    public function storeProducts(Request $request)
    {
        $data = $request->get('data');
        $cats_arr = Arr::pluck(DB::table('categories')->select('id', 'uuid')->get(), 'uuid', 'id');

        foreach ($cats_arr as $key => $item) {
            $cats_arr[$key] = (string) $item;
        }

        $products_id = [];

        foreach ($data as $item) {
            $cat_id = isset($item['puuid']) ? array_search($item['puuid'], $cats_arr) : false;
            $product = Product::updateOrCreate(
                [
                    'uuid' => $item['uuid']
                ],
                [
                    'title' => $item['title'],
                    'slug' => Str::slug($item['title']),
                    'description' => $item['desc'],
                    'stock' => $item['qty'],
                    'sizes' => $item['sizes'],
                    'colors' => $item['colors'],
                    'price' => $item['price'],
                    'discount' => isset($item['discount']) ? $item['discount'] : 0,
                    'category_id' => $cat_id ?: null,
                ]
            );

            $products_id[] = $product->id;

            foreach ($item['properties'] as $property) {
                Specification::updateOrCreate(
                    ['uuid' => $property['uuid']],
                    [
                        'title' => $property['title'],
                        'product_id' => $product->id,
                        'size' => $property['size'],
                        'color' => $property['color'],
                        'price' => $property['price'],
                        'discount' => $property['discount'],
                        'stock' => $property['stock'],
                    ]
                );
            }
        }

        $products = Product::whereNotIn('id', $products_id)->where('stock', '>', 0)->get();
        foreach ($products as $product) {
            $product->stock = 0;
            $product->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Products created/updated successfully!'
        ]);
    }
}
