<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Blueprint::macro('auditable', function (){
            $this->uuid('created_by')
                ->nullable()
                ->index();
            $this->uuid('updated_by')
                ->nullable()
                ->index();
        });

        Paginator::useBootstrap();
    }
}
