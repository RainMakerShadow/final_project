<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Users;
use App\Http\Livewire\Products;
use App\Http\Livewire\ProductsCategories;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('/layouts/main');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
//      user routs
    Route::get('/users', Users\ShowUsers::class)->name('user.show');
    Route::get('/user/{id}/edit', Users\EditUser::class)->name('user.edit');
    Route::get('/user/add', Users\AddUser::class)->name('user.add');
    Route::get('/users/delete{toDelete}', Users\DeleteUser::class)->name('user.delete');

//    product routs
    Route::get('/products', Products\ShowProducts::class)->name('products.show');
    Route::get('/product/{id}/edit', Products\EditProduct::class)->name('product.edit');
    Route::get('/product/add', Products\AddProduct::class)->name('product.add');
    Route::get('/products/delete{toDelete}', Products\DeleteProducts::class)->name('products.delete');

//      categories routs
    Route::get('/products/categories', ProductsCategories\ShowProductsCategories::class)->name('products-categories.show');
    Route::get('/products/category/{id}/edit', ProductsCategories\EditProductsCategories::class)->name('product-category.edit');
    Route::get('/product/category/add', ProductsCategories\AddProductsCategories::class)->name('product-category.add');
    Route::get('/products/categories/delete{toDelete}', ProductsCategories\DeleteProductsCategories::class)->name('products-categories.delete');
});
