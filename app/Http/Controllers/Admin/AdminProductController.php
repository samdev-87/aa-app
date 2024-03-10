<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Админка - Товары - Anna Anna';
        $viewData['products'] = Product::with('category', 'specifications')->simplePaginate(25);
//        dd($viewData['products']);
        return view('admin.product.index')->with('viewData', $viewData);
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData['title'] = 'Admin Page - Edit Product - Anna Anna';
        $viewData['product'] = Product::findOrFail($id);
        return view('admin.product.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, $id)
    {
        Product::validate($request);

        if ($request->hasFile('photo')) {
            $product = Product::findOrFail($id);
            $photoName = $product->uuid . '.' . $request->file('photo')->extension();
            Storage::disk('public')->put(
                $photoName,
                file_get_contents($request->file('photo')->getRealPath())
            );
            $product->photo = $photoName;
            $product->save();

            return redirect()->route('admin.product.index');
        } else {
            back();
        }
    }
}
