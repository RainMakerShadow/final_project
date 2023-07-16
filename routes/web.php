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
use App\Http\Livewire\Index;
use App\Http\Livewire\Shop;


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
})->name('main');
Route::get('/', Index::class)->name('main.page');
Route::get('/shop', Shop::class)->name('shop.page');
Route::get('/shop/sadzhanci-vinogradu', Shop::class)->name('shop.page');
Route::get('/shop/vinograd', Shop::class)->name('shop.page');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
//      user routs
    Route::get('dashboard/users', Users\ShowUsers::class)->name('user.show');
    Route::get('dashboard/user/{id}/edit', Users\EditUser::class)->name('user.edit');
    Route::get('dashboard/user/add', Users\AddUser::class)->name('user.add');
    Route::get('dashboard/users/delete{toDelete}', Users\DeleteUser::class)->name('user.delete');

//    product routs
    Route::get('dashboard/products', Products\ShowProducts::class)->name('products.show');
    Route::get('dashboard/product/{id}/edit', Products\EditProduct::class)->name('product.edit');
    Route::get('dashboard/product/add', Products\AddProduct::class)->name('product.add');
    Route::get('dashboard/products/delete{toDelete}', Products\DeleteProducts::class)->name('products.delete');

//      categories routs
    Route::get('dashboard/products/categories', ProductsCategories\ShowProductsCategories::class)->name('products-categories.show');
    Route::get('dashboard/product/category/{id}/edit', ProductsCategories\EditProductsCategories::class)->name('product-category.edit');
    Route::get('dashboard/product/category/add', ProductsCategories\AddProductsCategories::class)->name('product-category.add');
    Route::get('dashboard/products/categories/delete{toDelete}', ProductsCategories\DeleteProductsCategories::class)->name('products-categories.delete');

//      news routs
    Route::get('dashboard/news', News\ShowNews::class)->name('news.show');
    Route::get('dashboard/news/{id}/edit', News\EditNews::class)->name('news.edit');
    Route::get('dashboard/news/add', News\AddNews::class)->name('news.add');
    Route::get('dashboard/news/delete{toDelete}', News\DeleteNews::class)->name('news.delete');

//      news categories routs
    Route::get('dashboard/news/categories', NewsCategories\ShowNewsCategories::class)->name('news-categories.show');
    Route::get('dashboard/news/category/{id}/edit', NewsCategories\EditNewsCategories::class)->name('news-category.edit');
    Route::get('dashboard/news/category/add', NewsCategories\AddNewsCategories::class)->name('news-category.add');
    Route::get('dashboard/news/categories/delete{toDelete}', NewsCategories\DeleteNewsCategories::class)->name('news-categories.delete');

//      articles routs
    Route::get('dashboard/articles', Articles\ShowArticles::class)->name('articles.show');
    Route::get('dashboard/articles/{id}/edit', Articles\EditArticles::class)->name('articles.edit');
    Route::get('dashboard/articles/add', Articles\AddArticles::class)->name('articles.add');
    Route::get('dashboard/articles/delete{toDelete}', Articles\DeleteArticles::class)->name('articles.delete');

//      articles categories routs
    Route::get('dashboard/articles/categories', ArticlesCategories\ShowArticlesCategories::class)->name('articles-categories.show');
    Route::get('dashboard/articles/category/{id}/edit', ArticlesCategories\EditArticlesCategories::class)->name('articles-category.edit');
    Route::get('dashboard/articles/category/add', ArticlesCategories\AddArticlesCategories::class)->name('articles-category.add');
    Route::get('dashboard/articles/categories/delete{toDelete}', ArticlesCategories\DeleteArticlesCategories::class)->name('articles-categories.delete');

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
