<?php

namespace App\Providers;

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
      \Validator::extend('verificar_user_login', function ($attribute, $value, $parameters, $validator) {
            $verificar = \DB::table('usuario')->select('contrasenha')->where('usuario', $value)->count();
            return ($verificar > 0);
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
