<?php

use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth2\RegisterController;
use App\Http\Controllers\Auth2\LoginController;
use App\Http\Controllers\Adm\UserController;
use App\Http\Controllers\Adm\RoleController;
use App\Http\Controllers\Adm\CategoryController;
use App\Http\Controllers\LangController;

Route::get('/',function (){
    return redirect()->route('products.index');

});

Route::get('lang/{lang}', [LangController::class, 'switchLang'])->name('switch.lang');

Route::middleware('auth')->group(function (){
    Route::resource('products',ProductController::class)->except('index', 'show');
    Route::post('/logout', [\App\Http\Controllers\Auth2\LoginController::class,'logout'])->name('logout');

    Route::post('/products/{product}/addcart', [ProductController::class, 'addcart'])->name('products.addcart');
    Route::get('/products/cart', [ProductController::class, 'cart'])->name('products.cart');
    Route::post('/products/cart', [ProductController::class, 'buy'])->name('products.buy');
    Route::post('/products/{product}/uncart', [ProductController::class, 'uncart'])->name('products.uncart');
    Route::get('/products/orders', [ProductController::class, 'orders'])->name('products.orders');

    Route::post('/products/{product}/review', [ProductController::class, 'review'])->name('products.review');
    Route::post('/products/{product}/unreview', [ProductController::class, 'unreview'])->name('products.unreview');

    Route::post('/comment',[\App\Http\Controllers\CommentController::class,'store'])->name('comment.store');
    Route::get('/products/edit/{comment}',[\App\Http\Controllers\CommentController::class,'edit'])->name('comment.edit');
    Route::put('/comment/{comment}',[\App\Http\Controllers\CommentController::class,'update'])->name('comment.update');
    Route::delete('/comments/{comment}',[\App\Http\Controllers\CommentController::class,'destroy'])->name('comments.destroy');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

    Route::prefix('adm')->as('adm.')->middleware('hasrole:admin')->group(function (){
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/search', [UserController::class, 'index'])->name('users.search');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::put('/users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
        Route::put('/users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/comments', [\App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');
        Route::delete('/comments/{comment}',[\App\Http\Controllers\CommentController::class,'destroy'])->name('comments.destroy');
    });
    Route::prefix('adm')->as('adm.')->middleware('hasrole:moderator')->group(function (){
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories',[CategoryController::class,'store'])->name('categories.store');
        Route::delete('/categories/{category}',[CategoryController::class,'destroy'])->name('categories.destroy');

        Route::get('/cart', [\App\Http\Controllers\Adm\CartController::class, 'car'])->name('cart.index');
        Route::put('/cart/{cart}/confirm', [\App\Http\Controllers\Adm\CartController::class, 'confirm'])->name('cart.confirm');
    });

});

Route::get('/products/category/{category}',[ProductController::class,'productByCategory'])->name('products.category');
Route::resource('products',ProductController::class)->only('index', 'show');


//Route::post('/comment',[\App\Http\Controllers\CommentController::class,'store'])->name('comment.store');
//Route::get('/products/edit/{comment}',[\App\Http\Controllers\CommentController::class,'edit'])->name('comment.edit');
//Route::put('/comment/{comment}',[\App\Http\Controllers\CommentController::class,'update'])->name('comment.update');
//Route::delete('/comments/{comment}',[\App\Http\Controllers\CommentController::class,'destroy'])->name('comments.destroy');

Route::get('/register', [\App\Http\Controllers\Auth2\RegisterController::class,'create'])->name('register.form');
Route::post('/register', [\App\Http\Controllers\Auth2\RegisterController::class,'register'])->name('register');
Route::get('/login', [\App\Http\Controllers\Auth2\LoginController::class,'create'])->name('login.form');
Route::post('/login', [\App\Http\Controllers\Auth2\LoginController::class,'login'])->name('login');


//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

