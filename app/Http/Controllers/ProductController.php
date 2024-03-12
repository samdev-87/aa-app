<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Товары - Anna Anna";
        $viewData["subtitle"] = "Список товаров";
        $viewData["products"] = Product::all();
        return view('product.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];
        $product = Product::findOrFail($id);
        $viewData["title"] = $product->name . " - Anna Anna";
        $viewData["subtitle"] = $product->name . " - Информация о товаре";
        $viewData["product"] = $product;
        return view('product.show')->with("viewData", $viewData);
    }

    public function getSizesByColor(Request $request)
    {
        $sizes = DB::table('specifications')
            ->select('size')
            ->where('product_id', $request->get('id'))
            ->where('color', $request->get('color'))
            ->get();
        $html = view('template.options')->with('options', $sizes)->render();
        return response()->json(['html' => $html]);
    }
}
