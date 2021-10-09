<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('admin/login', [AuthController::class, 'login'])->name('auth.login');


Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::get('password/email', [AuthController::class, 'forgot'])->name('password.email');
Route::get('password/email', [AuthController::class, 'forgot'])->name('password.email');
Route::get('password/update', [AuthController::class, 'set'])->name('password.update');


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


// Route::get(
//     '/login',
//     function () {
//         return view('auth.login');
//     }
// );

// Route::post('/login', 'AuthController@login')->name('login');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
 * Clients management
 * */
// Route::prefix('/clients')->group(
//     function () {
//         Route::get('/', [\App\Http\Controllers\ClientsController::class, 'index']);
//         Route::get('/{client}', [\App\Http\Controllers\ClientsController::class, 'show']);
//         Route::post('/store', [\App\Http\Controllers\ClientsController::class, 'store']);
//         Route::patch('/{client}', [\App\Http\Controllers\ClientsController::class, 'update']);
//         Route::post('/destroy', [\App\Http\Controllers\ClientsController::class, 'destroyMass']);
//         Route::delete('/{client}/destroy', [\App\Http\Controllers\ClientsController::class, 'destroy']);
//     }
// );

/*
 * Current user
 * */
// Route::prefix('/user')->group(
//     function () {
//         Route::get('/', [\App\Http\Controllers\CurrentUserController::class, 'show']);
//         Route::patch('/', [\App\Http\Controllers\CurrentUserController::class, 'update']);
//         Route::patch('/password', [\App\Http\Controllers\CurrentUserController::class, 'updatePassword']);
//     }
// );

/*
 * File upload (e.g. avatar)
 * */
// Route::post('/files/store', [\App\Http\Controllers\FilesController::class, 'store']);

// Route::get('dashboard', [CustomAuthController::class, 'dashboard']);

// Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
// Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
// Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
