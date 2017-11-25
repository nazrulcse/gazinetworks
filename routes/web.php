<?php

Route::get('/','WelcomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController');