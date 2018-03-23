<?php

Route::get('/','WelcomeController@index');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/report/income', 'ReportsController@income')->name('income_report');
Route::get('/report/expense', 'ReportsController@expense')->name('expense_report');

Route::resource('users', 'UsersController');
Route::get('/users/{id}/change_status', 'UsersController@change_status');
Route::get('/customers/search', 'UsersController@search');
Route::get('/customers/report', 'UsersController@customer_report');
Route::get('/agents/report', 'UsersController@agent_report');

Route::resource('invoices', 'InvoiceController');
Route::get('/invoice_reports', 'InvoiceController@invoice_report');

Route::resource('payments', 'PaymentController');

Route::resource('contacts', 'ContactController');

Route::resource('complains', 'ComplainController');

Route::resource('expense_categories', 'ExpenseCategoryController');

Route::resource('expenses', 'ExpenseController');
Route::resource('announcements', 'AnnouncementController');

// Graph URL
Route::get('/dashboard/graph_inex', 'HomeController@graph_inex')->name('graph_inex');
Route::get('/dashboard/graph_income_expense', 'HomeController@graph_income_expense')->name('graph_income_expense');
Route::get('/dashboard/graph_expense', 'HomeController@graph_expense')->name('graph_expense');
Route::get('/dashboard/graph_invoice', 'HomeController@graph_invoice')->name('graph_invoice');

// Route for view/blade file.
Route::get('/importExport', 'MaatwebsiteController@importExport');
Route::get('/importExport/createinvoice', 'MaatwebsiteController@createAllInvoice');
// Route for export/download tabledata to .csv, .xls or .xlsx
//Route::get('downloadExcel/{type}', 'MaatwebsiteController@downloadExcel');
// Route for import excel data to database.
Route::post('/importExcel', 'MaatwebsiteController@importExcel');