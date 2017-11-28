<?php

namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class FormMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::macro('myCheckbox', function($name,$value = 1, $id= null, $class, $label) {
            return '<label for="'.$name.'" style="margin-right:30px">
            <input id="'.$id.'" class="'.$class.'" name="'.$name.'" value="'.$value.'" type="checkbox">
            '.$label.'
            </label>';
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