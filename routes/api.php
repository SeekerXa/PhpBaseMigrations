<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Api\GeoapifyClitent;
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

Route::get('/test', function () {
    echo 'test';
});


Route::get('/cities', [CityController::class, 'list']);

Route::post('/cities', [CityController::class, 'create']);

Route::put('/cities/{id}', [CityController::class, 'update']);

Route::delete('/cities/{id}', [CityController::class, 'destroy']);

Route::get('/geotest', [CityController::class, 'testgeo']);