<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validators\Validator;
use App\Http\Validators\SignUpValidator;

class SignUpServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $validator = $this->app['validator'];
        $validator->resolver(function($translator, $data, $rules, $messages) {
            return new SignUpValidator( $translator, $data, $rules, $messages);
        });
    }
}
