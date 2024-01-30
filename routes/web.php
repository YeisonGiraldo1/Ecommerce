<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




    
    Route::get('/', function () {
        if (auth()->check()) {
           //USER IS AUTENTICATED,VERIFI ROLE
            if (auth()->user()->role === 'admin') {
                return redirect('/dashboard');
            } else {
              //IF "USER" ,SHOW WELCOME VIEW
                return view('welcome');
            }
        }
    
        //IF NOT AUTENTICATED,SHOW WELCOME VIEW
        return view('welcome');
    });




    //MIDDLEWARE SO THAT THE NORMAL USER CANNOT ACCESS THE ADMIN DASHBOARD VIEW
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });
    
    
Route::middleware('auth')->group(function () {

//CRUD CATEGORIES

Route::resource('categories', CategoryController::class);//GLOBAL ROUTE FOR CATEGORIES(CRUD)


//CRUD PRODUCTS
Route::resource('products', ProductController::class);//GLOBAL ROUTE FOR PRODUCTS(CRUD)

});


//ROUTE DETAIL PRODUCT
Route::get('/detail/product{id}', [ProductController::class, 'detail'])->name('detailproduct');


//SHOPING CART
Route::group(['middleware' => 'auth'], function () {

    Route::post('/cart/add/{id}/{user_id}', [CartController::class, 'addtocart'])->name('cart.add');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::get('/delete/cart/{id}', [CartController::class, 'delete'])->name('cart.delete');
    
    Route::get('/cart/update/{id}/{quantity}', [CartController::class, 'update'])->name('cart.update');

});


Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

});

Route::middleware('auth')->group(function () {
    //CRUD ADRESSES
Route::resource('addresses', AddressController::class);
});