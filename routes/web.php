<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/orders', 'OrderController');
Route::resource('/products', 'ProductController');
Route::resource('/suppliers', 'SupplierController');
Route::resource('/companies', 'CompanyController');
Route::resource('/companies', 'CompanyController');
Route::resource('/transactions', 'TransactionController');
Route::resource('/users', 'UserController');
