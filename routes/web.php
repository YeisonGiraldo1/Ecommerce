<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;

use App\Livewire\AddressForm;
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



Route::resource('categories', CategoryController::class);//GLOBAL ROUTE FOR CATEGORIES(CRUD)



Route::resource('products', ProductController::class);//GLOBAL ROUTE FOR PRODUCTS(CRUD)

});



Route::get('/detail/product{id}', [ProductController::class, 'detail'])->name('detailproduct');//ROUTE DETAIL PRODUCT


//SHOPING CART
Route::group(['middleware' => 'auth'], function () {

    Route::post('/cart/add/{id}/{user_id}', [CartController::class, 'addtocart'])->name('cart.add');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::get('/delete/cart/{id}', [CartController::class, 'delete'])->name('cart.delete');
    
    Route::get('/cart/update/{id}/{quantity}', [CartController::class, 'update'])->name('cart.update');

});


Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');//ROUTE VIEW CHECKOUT

});

Route::middleware('auth')->group(function () {
    //CRUD ADRESSES
Route::resource('addresses', AddressController::class);
});


//CONTACT
Route::get('/contact', [ContactController::class, 'showform'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submitform'])->name('contact.submit');
Route::get('/contact/success', [ContactController::class, 'successview'])->name('contact.success');


//show contact messages to admin
Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/messages', [ContactController::class, 'index'])->name('contact.index');
Route::get('/message/detail/{id}', [ContactController::class, 'show'])->name('contact.show');
});


//ORDERS USERS
Route::middleware('auth')->group(function () {
//make an order
Route::get('/checkout/place-order', [CheckoutController::class, 'placeorder'])->name('checkout.placeorder');

//user order confirmation
Route::get('/confirmation/{order}', [OrderController::class,'orderconfirmation'] )->name('order.confirmation');

//shows a user's orders
Route::get('/myorders', [OrderController::class,'userorders'] )->name('order.user');

//user order detail
Route::get('/order/{orderId}', [OrderController::class, 'userorderdetail'])->name('order.user.detail');
});



//ORDERS ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
//show all orders to admin
Route::get('/all/orders', [OrderController::class,'allorders'] )->name('orders.all');
    
//order detail
Route::get('/detail/order/{order}', [OrderController::class,'orderdetail'] )->name('order.detail');
});



Route::get('/products/category/{category}', [CategoryController::class, 'showproducts'])->name('show.products');


Route::get('/all/users', [UserController::class, 'allusers'])->name('users.all');
