<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Exchange1SController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => true
        ]);
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
}
