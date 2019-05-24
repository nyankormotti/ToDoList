<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'task',
            function ($view) {
                $id = Auth::id();
                $categoryData = Category::where('user_id', $id)->get();
                $view->with('category_data', $categoryData);
            }
        );
    }
}
