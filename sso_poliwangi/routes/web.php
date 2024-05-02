<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\authController;
use App\Http\Controllers\OAuth\oauthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/login', [authController::class, 'loginPage'])->name('login');
Route::post('/login', [authController::class, 'authenticationLogin']);
Route::post('/changes-account', [authController::class, 'changesAccount'])->name('sso.changesAccount');
