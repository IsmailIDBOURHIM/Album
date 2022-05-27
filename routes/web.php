<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('admin')->group(function () {
    Route::resource ('category', 'CategoryController', [
        'except' => 'show'
    ]);
    //partie maintenance réservée à l’administrateur pour la suppression d'une photo
    Route::name('maintenance.index')->get('maintenance', 'AdminController@index');
    Route::name('maintenance.destroy')->delete('maintenance', 'AdminController@destroy');
});

Route::middleware('auth')->group(function () {
   Route::resource ('image', 'ImageController', [
        'only' => ['create', 'store', 'destroy']
    ]);

    Route::resource('profile', 'UserController', [
        'only' => ['edit', 'update'],
        'parameters' => ['profile' => 'user']
    ]);
});

//afficher les photos par leurs catégories
Route::name('category')->get('category/{slug}', 'ImageController@category');

//afficher uniquement les photos d'un utilisateur
Route::name('user')->get('user/{user}', 'ImageController@user');

