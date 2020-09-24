<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Authentication is not important here because of that Auth routes are Commented
| But If it was important, JWT Token would have handled the Auth process in our
| SPA. Also I have deleted "api" prefix because all of our routes are in this
| file, so putting "api" in every url here only makes urls messy!
|
*/

/* If we have Auth concern */
// Route::post('login', 'MainController@login')->name('login');
// Route::get('refresh', 'MainController@refresh');

// ['middleware' => 'auth:api'] should be passed as first parameter of bellow group
Route::group([], function() {

    Route::get('/', 'MainController@dashboard')->name('dashboard');
//  Route::post('user/info', 'MainController@userInfo')->name('users.info');
//  Route::post('logout', 'MainController@logout')->name('logout');

//  Route::resource('/users', 'UsersController');

    // In a SPA, 'GET' methods that have data response (e.g. Json) should be changed to 'POST' method so users do not have unpleasant UX
    Route::get('accounts/{id}', 'AccountsController@index')->name('accounts.index');
    Route::get('accounts/{id}/transactions', 'AccountsController@showTransactions')->name('transactions.show');
    Route::post('accounts/{id}/transactions', 'AccountsController@createTransactions')->name('transactions.create');

    Route::get('currencies', 'CurrenciesController@index')->name('currencies');

});


