<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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

// Route::middleware('auth:sanctum')->get(
//     '/user',
//     function (Request $request) {
//         return $request->user();
//     }
// );

// Route::group(
//     ['namespace' => 'Api', 'as' => 'api.', 'prefix' => 'v1'],
//     function () {

//         Route::post('/login', [AuthController::class, 'login']);
//         Route::group(
//             ['prefix' => 'password', 'as' => 'password.'],
//             function () {
//                 Route::post('/email', 'AuthController@forgot')->name('forgot');
//                 Route::post('/reset', 'AuthController@reset')->name('reset');
//                 Route::post('/set', 'UserController@setPassword')->name('set');
//             }
//         );
//     }
// );
