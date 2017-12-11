<?php

Route::get('/','WelcomeController@index');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/report/income', 'ReportsController@income')->name('income_report');
Route::get('/report/expense', 'ReportsController@expense')->name('expense_report');

Route::resource('users', 'UsersController');

Route::resource('invoices', 'InvoiceController');

Route::resource('payments', 'PaymentController');

Route::resource('contacts', 'ContactController');

Route::resource('complains', 'ComplainController');
Route::resource('expenses', 'ExpenseController');