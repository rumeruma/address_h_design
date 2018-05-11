<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Menu;
use App\Package;
use App\Post;
use App\BusinessCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        //


//        \URL::forceScheme('https');
        //
        Schema::defaultStringLength(191);

        view()->composer('template-parts.nav', function($view){
                $view->with('themenu', Menu::getMenu('primary-menu'));
        });
        view()->composer('template-parts.footer', function($view){
                $view->with('themenu', Menu::getMenu('footer-menu'));
        });

        view()->composer('template-parts.package', function($view){
                $view->with('thepackages', Package::getActive());
        });

        view()->composer('template-parts.memberRecent', function($view){
                $view->with('recentposts', Post::custom('c-profile',6));
        });

        view()->composer('template-parts.categoryList', function($view){
                $view->with('basecategories', BusinessCategory::basecategories(8));
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
