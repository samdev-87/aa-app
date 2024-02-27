<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Админка - Товары - Anna Anna';
        $viewData['products'] = Product::all();
        return view('admin.product.index')->with('viewData', $viewData);
    }
}
