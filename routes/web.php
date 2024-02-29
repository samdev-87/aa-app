<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name('admin.home.index');

Route::get('/admin/category', 'App\Http\Controllers\Admin\AdminCategoryController@index')->name('admin.category.index');
//Route::post('/admin/category/store', 'App\Http\Controllers\Admin\AdminCategoryController@store')->name('admin.category.store');
Route::get('/admin/category/{id}/edit', 'App\Http\Controllers\Admin\AdminCategoryController@edit')->name('admin.category.edit');
Route::put('/admin/category/{id}/update', 'App\Http\Controllers\Admin\AdminCategoryController@update')->name('admin.category.update');

Route::get('/admin/product', 'App\Http\Controllers\Admin\AdminProductController@index')->name('admin.product.index');
Route::get('/admin/product/{id}/edit', 'App\Http\Controllers\Admin\AdminProductController@edit')->name('admin.product.edit');
Route::put('/admin/product/{id}/update', 'App\Http\Controllers\Admin\AdminProductController@update')->name('admin.product.update');
