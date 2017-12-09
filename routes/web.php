<?php

Route::get('/','WelcomeController@index');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::resource('users', 'UsersController');

Route::resource('invoices', 'InvoiceController');

Route::resource('payments', 'PaymentController');

Route::resource('contacts', 'ContactController');

Route::resource('complains', 'ComplainController');
Route::resource('expenses', 'ExpenseController');