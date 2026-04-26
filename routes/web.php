<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;



Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::post('/chatbot', [MainController::class, 'chatbot'])->name('chatbot');


Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/product/{product}', [MainController::class, 'product'])->name('product.show');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/filter-products', [MainController::class, 'products'])->name('products.filter');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/increase/{product}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{product}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::get('/search', [MainController::class, 'search'])->name('search');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');


Route::middleware(['guest'])->group(function(){
   Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
   Route::post('/login', [AuthController::class, 'login'])->name('loginAction');

   Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
   Route::post('/register', [AuthController::class, 'register'])->name('registerAction');
});


Route::middleware(['auth'])->group(function(){
   Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
   Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
   Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

 
Route::middleware(['auth' , 'admin'])->group(function(){
    Route::get('/admin/home', [AdminController::class, 'main'])->name('admin.home');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users/role/{user}',[AdminController::class,'toggleRole'])->name('admin.toggleRole');
    Route::post('/admin/users/delete/{user}',[AdminController::class,'deleteUser'])->name('admin.deleteUser');
    Route::get('/admin/carousel',[AdminController::class,'carouselPage'])->name('admin.carousel');
    Route::post('/admin/carousel',[AdminController::class,'carouselUpload'])->name('admin.carouselUpload');
    Route::get('/carousel/edit/{carousel}', [AdminController::class, 'editCarousel'])->name('admin.carousel.edit');
    Route::post('/carousel/update/{carousel}', [AdminController::class, 'updateCarousel'])->name('admin.carousel.update');
    Route::post('/carousel/delete/{carousel}', [AdminController::class, 'deleteCarousel'])->name('admin.carousel.delete');
    Route::get('/admin/products', [AdminController::class, 'adminProducts'])->name('admin.products');
    Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::post('/admin/products/toggle/{product}', [AdminController::class, 'toggleProduct'])->name('admin.products.toggle');
    Route::get('/admin/products/edit/{product}', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::post('/admin/products/update/{product}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/admin/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::post('/admin/categories/toggle/{category}', [AdminController::class, 'toggleCategory'])->name('admin.categories.toggle');
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::post('/admin/orders/status/{order}', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.status');
});
   



