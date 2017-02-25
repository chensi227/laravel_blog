<?php

namespace App\Providers;

use App\Model\Navs;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         *
         * 方法一
        $navs = Navs::all();
        view()->share('navs', $navs);

        */


        /*
         * 方法二
         view()->composer('layouts.home', function ($view) {
            $navs = Navs::all();
            $view->with('navs',$navs);
        });

        */
        View::composer('layouts.home', 'App\Http\ViewComposers\MyViewComposer');
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
