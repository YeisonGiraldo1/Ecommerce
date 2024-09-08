<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Models\Product; //IMPORT MODEL PRODUCT


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('products', Product::all());
        View::share('categories', Category::all());


        
        // $totalproducts = session('totalproducts', ); // Obtén la variable desde la sesión
        // View::share('totalproducts', $totalproducts);
    }
}
