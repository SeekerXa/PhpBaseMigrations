<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use Termwind\Components\Dd;
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
Route::get('/cities', [CityController::class, 'list']);
Route::get('/weathers', [CityController::class, 'listWeather']);

Route::post('/cities', [CityController::class, 'create']);

Route::put('/cities/{id}', [CityController::class, 'update']);

Route::delete('/cities/{id}', [CityController::class, 'destroy']);

Route::get('/addweather', [CityController::class, 'addWeather']);

Route::get('/testweather', [CityController::class, 'testweather']);

Route::get('/testmail', [CityController::class, 'testmail']);

Route::get('/testHasMany', [CityController::class, 'testHasMany']);

Route::get('/bocos', function () {
    dd('jj');
});




