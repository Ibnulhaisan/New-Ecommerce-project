<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/',[\App\Http\Controllers\Frontend\FrontendController::class,'index']);
Route::get('category',[\App\Http\Controllers\Frontend\FrontendController::class,'category']);
Route::get('category/{slug}',[\App\Http\Controllers\Frontend\FrontendController::class,'viewcategory']);
Route::get('category/{cate_slug}/{prod_slug}',[\App\Http\Controllers\Frontend\FrontendController::class,'productview']);
Route::get('product-list',[\App\Http\Controllers\Admin\FrontendController::class,'productlistAjax']);
Route::post('searchproduct',[\App\Http\Controllers\Admin\FrontendController::class,'searchProduct']);
Auth::routes();

Route::get('load-cart-data',[\App\Http\Controllers\Frontend\CartController::class,'cartCount']);
Route::get('load-wishlist-data',[\App\Http\Controllers\Frontend\WishlistController::class,'wishlistCount']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', function () {
    return view('logout');
});

Route::post('/add-to-cart',[\App\Http\Controllers\Frontend\CartController::class,'addProduct']);
Route::post('delete-cart-item',[\App\Http\Controllers\Frontend\CartController::class,'deleteproduct']);
Route::post('update-cart',[\App\Http\Controllers\Frontend\CartController::class,'updateCart']);
Route::post('add-to-wishlist',[\App\Http\Controllers\Frontend\WishlistController::class,'add']);
Route::post('delete-wishlist-item',[\App\Http\Controllers\Frontend\WishlistController::class,'deleteItem']);


Route::middleware(['auth'])->group(function(){
    Route::get('cart',[\App\Http\Controllers\Frontend\CartController::class,'viewcart']);
    Route::get('checkout',[\App\Http\Controllers\Frontend\CheckoutController::class,'index']);
    Route::post('place-order',[\App\Http\Controllers\Frontend\CheckoutController::class,'placeOrder']);

    Route::get('my-orders',[\App\Http\Controllers\Frontend\UserController::class,'index']);
    Route::get('view-order/{id}',[\App\Http\Controllers\Frontend\UserController::class,'view']);

    Route::post('add-rating',[\App\Http\Controllers\Frontend\RatingController::class,'add']);
    Route::get('add-review/{product_slug}/user_review',[\App\Http\Controllers\Frontend\ReviewController::class,'add']);
    Route::post('add-review',[\App\Http\Controllers\Frontend\ReviewController::class,'create']);
    Route::get('edit-review/{product_slug}/user_review',[\App\Http\Controllers\Frontend\ReviewController::class,'edit']);
    Route::put('update-review',[\App\Http\Controllers\Frontend\ReviewController::class,'update']);
    Route::get('wishlist',[\App\Http\Controllers\Frontend\WishlistController::class,'index']);
    Route::post('proceed-to-pay',[\App\Http\Controllers\Frontend\CheckoutController::class,'razorpayCheck']);

});

Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('dashboard',[\App\Http\Controllers\Admin\FrontendController::class,'index']);
    Route::get('categories',[\App\Http\Controllers\Admin\CategoryController::class,'index'])->name('category.info');
    Route::get('add-category',[\App\Http\Controllers\Admin\CategoryController::class,'add']);
    Route::post('insert-category',[\App\Http\Controllers\Admin\CategoryController::class,'insert']);
    Route::get('edit-category/{id}',[\App\Http\Controllers\Admin\CategoryController::class,'edit']);
    Route::put('update-category/{id}',[\App\Http\Controllers\Admin\CategoryController::class,'update']);
    Route::get('delete-category/{id}',[\App\Http\Controllers\Admin\CategoryController::class,'destroy']);
    Route::get('dashboard',[\App\Http\Controllers\Admin\CategoryController::class,'dashboard'])->name('dashboard');
    Route::get('add-color',[\App\Http\Controllers\Admin\ColorController::class,'color']);
    Route::post('insert-color',[\App\Http\Controllers\Admin\ColorController::class,'insertColor']);
    Route::get('show-list',[\App\Http\Controllers\Admin\ColorController::class,'showList']);
    Route::get('edit-color/{id}',[\App\Http\Controllers\Admin\ColorController::class,'editColor']);
    Route::put('update-color/{id}',[\App\Http\Controllers\Admin\ColorController::class,'updateColor']);
    Route::get('delete-color/{id}',[\App\Http\Controllers\Admin\ColorController::class,'deleteColor']);
    Route::get('product-size',[\App\Http\Controllers\Admin\SizeController::class,'size']);
    Route::post('insert-size',[\App\Http\Controllers\Admin\SizeController::class,'insertSize']);
    Route::get('show-size-list',[\App\Http\Controllers\Admin\SizeController::class,'sizeList']);
    Route::get('edit-size/{id}',[\App\Http\Controllers\Admin\SizeController::class,'editSize']);
    Route::post('update-size/{id}',[\App\Http\Controllers\Admin\SizeController::class,'updateSize']);
    Route::get('delete-size/{id}',[\App\Http\Controllers\Admin\SizeController::class,'deleteSize']);


    Route::get('products',[\App\Http\Controllers\Admin\ProductController::class,'index']);
    Route::get('add-products',[\App\Http\Controllers\Admin\ProductController::class,'add']);
    Route::post('insert-product',[\App\Http\Controllers\Admin\ProductController::class,'insert']);


    Route::get('edit-product/{id}',[\App\Http\Controllers\Admin\ProductController::class,'edit']);
    Route::put('update-product/{id}',[\App\Http\Controllers\Admin\ProductController::class,'update']);
    Route::get('delete-product/{id}',[\App\Http\Controllers\Admin\ProductController::class,'destroy']);
    Route::get('users',[\App\Http\Controllers\Admin\FrontendController::class,'users']);
    Route::get('orders',[\App\Http\Controllers\Admin\OrderController::class,'index']);
    Route::get('admin/view-order/{id}',[\App\Http\Controllers\Admin\OrderController::class,'view']);
    Route::put('update-order/{id}',[\App\Http\Controllers\Admin\OrderController::class,'updateOrder']);
    Route::get('order-history',[\App\Http\Controllers\Admin\OrderController::class,'orderHistory']);
    Route::get('users',[\App\Http\Controllers\Admin\DashboardController::class,'users']);
    Route::get('view-user/{id}',[\App\Http\Controllers\Admin\DashboardController::class,'viewUser']);

});
