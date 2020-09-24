<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This is a SPA so all the routes will be handled in api.php routes. we only
| handle the main route to our MainController here.
|
*/

Route::get('/{any}', 'MainController@dashboard')->where('any', '.*');
