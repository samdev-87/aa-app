<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Главная Страница - Anna Anna';
        $viewData['categories'] = Category::whereNull('parent_id')->get();
        return view('home.index')->with('viewData', $viewData);
    }
}
