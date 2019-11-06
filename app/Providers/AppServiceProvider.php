<?php

namespace App\Providers;

use Schema;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\DB;
use  Illuminate\Database\Events\QueryExecuted;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        /*if($this->app->environment()=='local'){
            DB::listen(function(QueryExecuted $query){
                file_put_contents('php://stdout',"\n".json_encode($query->sql)."\tbindings:".json_encode($query->bindings)."\n");
            });
        }*/
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
