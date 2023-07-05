<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('/users-show', \App\Http\Livewire\ShowUsers::class)->name('user.show');
    Route::get('/users/{id}/edit', \App\Http\Livewire\EditUser::class,)->name('user.edit');
    Route::get('/users/add', \App\Http\Livewire\AddUser::class,)->name('user.add');

});
