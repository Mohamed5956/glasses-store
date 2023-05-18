<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Models\Category;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */

     public function boot()
     {
         View::composer('layouts.sidebar', function ($view) {
             $categories = Category::all();
             $view->with('categories', $categories);
         });
     }

}
