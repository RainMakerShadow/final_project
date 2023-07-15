<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Users;
use App\Http\Livewire\Products;
use App\Http\Livewire\ProductsCategories;
use App\Http\Livewire\News;
use App\Http\Livewire\NewsCategories;
use App\Http\Livewire\Articles;
use App\Http\Livewire\ArticlesCategories;
use App\Http\Livewire\Menu;
use App\Http\Livewire\Gallery;
use App\Http\Livewire\Main;

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
    Route::get('/product/category/{id}/edit', ProductsCategories\EditProductsCategories::class)->name('product-category.edit');
    Route::get('/product/category/add', ProductsCategories\AddProductsCategories::class)->name('product-category.add');
    Route::get('/products/categories/delete{toDelete}', ProductsCategories\DeleteProductsCategories::class)->name('products-categories.delete');

//      news routs
    Route::get('/news', News\ShowNews::class)->name('news.show');
    Route::get('/news/{id}/edit', News\EditNews::class)->name('news.edit');
    Route::get('/news/add', News\AddNews::class)->name('news.add');
    Route::get('/news/delete{toDelete}', News\DeleteNews::class)->name('news.delete');

//      news categories routs
    Route::get('/news/categories', NewsCategories\ShowNewsCategories::class)->name('news-categories.show');
    Route::get('/news/category/{id}/edit', NewsCategories\EditNewsCategories::class)->name('news-category.edit');
    Route::get('/news/category/add', NewsCategories\AddNewsCategories::class)->name('news-category.add');
    Route::get('/news/categories/delete{toDelete}', NewsCategories\DeleteNewsCategories::class)->name('news-categories.delete');

//      articles routs
    Route::get('/articles', Articles\ShowArticles::class)->name('articles.show');
    Route::get('/articles/{id}/edit', Articles\EditArticles::class)->name('articles.edit');
    Route::get('/articles/add', Articles\AddArticles::class)->name('articles.add');
    Route::get('/articles/delete{toDelete}', Articles\DeleteArticles::class)->name('articles.delete');

//      articles categories routs
    Route::get('/articles/categories', ArticlesCategories\ShowArticlesCategories::class)->name('articles-categories.show');
    Route::get('/articles/category/{id}/edit', ArticlesCategories\EditArticlesCategories::class)->name('articles-category.edit');
    Route::get('/articles/category/add', ArticlesCategories\AddArticlesCategories::class)->name('articles-category.add');
    Route::get('/articles/categories/delete{toDelete}', ArticlesCategories\DeleteArticlesCategories::class)->name('articles-categories.delete');

//      menu edit routs
    Route::get('/menu', Menu\ShowMenu::class)->name('menu.show');
    Route::get('/menu/{id}/edit', Menu\EditMenu::class)->name('menu.edit');
    Route::get('/menu/add', Menu\AddMenu::class)->name('menu.add');
    Route::get('/menu/delete{toDelete}', Menu\DeleteMenu::class)->name('menu.delete');

//      gallery routs
    Route::get('/gallery', Gallery\ShowGallery::class)->name('gallery.show');
    Route::get('/gallery/{id}/edit', Gallery\EditGallery::class)->name('gallery.edit');
    Route::get('/gallery/add', Gallery\AddGallery::class)->name('gallery.add');
    Route::get('/gallery/delete{toDelete}', Gallery\DeleteGallery::class)->name('gallery.delete');

// logout user
});
