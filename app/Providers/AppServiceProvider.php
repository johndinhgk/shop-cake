<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ProductType;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    //View composers are callbacks or class
    //methods that are called when a view is rendered.
    //If you have data that you want to be bound to a view each time that view is rendered,
    //a view composer can help you organize that logic into a single location.
    public function boot()
    {
        view()->composer('header',function($view) {
            $loai_sp = ProductType::all();
            $view->with('loai_sp',$loai_sp);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
