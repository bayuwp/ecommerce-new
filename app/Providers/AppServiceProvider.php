<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share data for 'kategoris' only if the table exists
        if (Schema::hasTable('kategoris')) {
            View::share('kategoris', Kategori::all());
        }

        // Share data for best-selling products only if the 'produks' table exists
        if (Schema::hasTable('produks')) {
            View::share('bestSellingProducts', Produk::orderBy('sold', 'desc')->take(5)->get());
            View::share('recommendedProducts', Produk::inRandomOrder()->take(5)->get());
        }

        // Share cart count if the 'carts' table exists and user is authenticated
        if (Schema::hasTable('carts')) {
            View::share('cartCount', Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0);
        }
    }
}
