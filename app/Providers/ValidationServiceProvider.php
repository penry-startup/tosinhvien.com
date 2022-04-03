<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application service.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('password_valid', function ($attribute, $value, $parameters, $validator) {
            if (preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $value)) {
                return true;
            }
            return false;
        });

        Validator::extend('phone_valid', function ($attribute, $value, $parameters, $validator) {
            $value = (string) $value;
            if (strlen($value) === 0) return true;
            if ($value[0] != '0') return false;
            if (strlen($value) === 10) return true;

            return false;
        });
    }

    /**
     * Register the application service.
     *
     * @return void
     */
    public function register()
    {

    }
}
