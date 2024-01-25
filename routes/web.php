<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

Route::resource('categories', CategoryController::class);

//CRUD PRODUCTS
Route::resource('products', ProductController::class);//GLOBAL ROUTE FOR PRODUCTS(CRUD)
});



Route::get('/detail/product{id}', [ProductController::class, 'detail'])->name('detailproduct');

