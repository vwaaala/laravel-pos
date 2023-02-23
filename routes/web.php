<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('/products', 'ProductController');
Route::resource('/suppliers', 'SupplierController');
Route::resource('/companies', 'CompanyController');
Route::resource('/companies', 'CompanyController');
Route::resource('/transactions', 'TransactionController');
Route::resource('/users', 'UserController');
Route::controller(UserController::class)->prefix('/users')->name('users.')->group(function () {
    Route::get('', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::put('/update/{id}', 'update')->name('update');
    Route::delete('/delete/{id}', 'destroy')->name('delete');
});