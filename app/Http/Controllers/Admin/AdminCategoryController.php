<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Admin - Categories - Anna Anna';
        $viewData['categories'] = Category::whereNull('parent_id')->get();
        return view('admin.category.index')->with('viewData', $viewData);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'photo' => 'image',
        ]);

        $data = $request->only(['title']);
        $data['uuid'] = Str::uuid();
        $data['slug'] = Str::slug($data['title']);
        $category = Category::create($data);

        if ($request->hasFile('photo')) {
            $photoName = $category->id . "." . $request->file('photo')->extension();
            Storage::disk('public')
                ->put($photoName, file_get_contents($request->file('photo')->getRealPath()));
            $category->photo = $photoName;
            $category->save();
        }

        return back();
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData['title'] = 'Admin Page - Edit Category - Anna Anna';
        $viewData['category'] = Category::findOrFail($id);
        return view('admin.category.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, $id)
    {
        Category::validate($request);


        if ($request->hasFile('photo')) {
            $category = Category::findOrFail($id);
            $photoName = $category->uuid . '.' . $request->file('photo')->extension();
            Storage::disk('public')->put(
                $photoName,
                file_get_contents($request->file('photo')->getRealPath())
            );
            $category->photo = $photoName;
            $category->save();

            return redirect()->route('admin.category.index');
        } else {
            back();
        }
    }
}
