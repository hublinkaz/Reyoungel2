<?php

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/order/store', [\App\Http\Controllers\OrdersController::class,'store'])->name('store');


Route::post('/bot/getupdates', function () {
    $updates = Telegram::getUpdates();
    return (json_encode($updates));
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
