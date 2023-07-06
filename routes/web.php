<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Users;

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
    Route::get('/users-show', Users\ShowUsers::class)->name('user.show');
    Route::get('/users/{id}/edit', Users\EditUser::class)->name('user.edit');
    Route::get('/users/add', Users\AddUser::class)->name('user.add');
    Route::get('/users/delete{toDelete}', Users\DeleteUser::class)->name('user.delete');

});
