<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Builder;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // macro used for search data on a database
        Builder::macro('search', function($field, $string) {
            return $string ? $this->where($field,'like', '%'.$string.'%') : $this;
        });
    }
}
