<?php

use App\Http\Controllers\CookiesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'buy',
    'middleware' => 'auth',
    'as' => 'buy.',
], function () {
    Route::get('/', [CookiesController::class, 'index'])->name('index');
    Route::post('/', [CookiesController::class, 'buy'])->name('cookies');
});

//Route::get('buy/{cookies}', function ($cookies) {
//
//    $user = Auth::user();
//
//    if ($cookies > $user->wallet) {
//        return new \Illuminate\Http\Response('There is not enough money in the balance', \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
//    }
//
//    $new_amount = $user->wallet - $cookies;
//
//    $user->update(['wallet' => $new_amount]);
//
//    Log:info('User ' . $user->email . ' have bought ' . $cookies . ' cookies'); // we need to log who ordered and how much
//
////    return 'Success, you have bought ' . $cookies . ' cookies!';
//    return 'Success, you have bought ' . $cookies . ' ' . Str::plural('cookie', $cookies) . '!';
//
//});
