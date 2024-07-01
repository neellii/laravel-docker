<?php

namespace App\Providers;

use App\Http\Controllers\Admin\CategoryController;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();

        view()->share('categoriesTree', Category::where('parent_id', null)->with('children')->get());
    }
}
