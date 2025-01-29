<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/enquiry', [EnquiryController::class, 'index'])->name('enquiry');

Route::get('/create-enquiry', [EnquiryController::class, 'create'])->name('create_enquiry');

Route::post('/save-enquiry', [EnquiryController::class, 'store'])->name('save_enquiry');

Route::get('/edit-enquiry/{id}', [EnquiryController::class, 'edit'])->name('edit_enquiry');

Route::put('/update-enquiry/{id}', [EnquiryController::class, 'update'])->name('update_enquiry');


Route::get('/create-customer/{id}', [CustomerController::class, 'create_from_enquiry'])->name('create_customer');

Route::get('/create-new-customer', [CustomerController::class, 'create'])->name('create_new_customer');

Route::get('/customer', [CustomerController::class, 'index'])->name('customers');

Route::post('/save-customer/{id}', [CustomerController::class, 'save_from_enquiry'])->name('save_customer');

Route::post('/save-new-customer', [CustomerController::class, 'store'])->name('save_new_customer');

Route::get('/view-customer/{id}', [CustomerController::class, 'show'])->name('view_customer');

Route::get('/edit-customer/{id}', [CustomerController::class, 'edit'])->name('edit_customer');

Route::put('/update-customer/{id}', [CustomerController::class, 'update'])->name('update_customer');

Route::get('/create-quote/{id}', [CustomerController::class, 'create_quote'])->name('create_quote');


Route::post('/save-product', [ProductController::class, 'store'])->name('save_product');

Route::get('/create-product', [ProductController::class, 'create'])->name('create_product');

Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit_product');

Route::put('/update-product/{id}', [ProductController::class, 'update'])->name('update_product');




