<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;

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

Route::controller(UserController::class)->group(function () {
    Route::get('/', 'show')->name('home')->middleware('auth');
    Route::get('/export', 'export')->name('export');
    Route::post('/import', 'import')->name('import');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'show')->name('login')->middleware('guest');
    Route::get('/login/github', 'githubRedirect');
    Route::get('/login/github/callback', 'githubLogin');
    Route::post('/login', 'store');
    Route::post('/logout', 'logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'show')->name('register')->middleware('guest');
    Route::post('/register', 'store');
});

Route::get('/auth/saml2/redirect', function () {
    return Socialite::driver('saml2')->redirect();
});

Route::get('/auth/saml2/callback', function () {
    $user = Socialite::driver('saml2')->user();
    dd($user);
});

Route::get('/auth/saml2/metadata', function () {
    return Socialite::driver('saml2')->getServiceProviderMetadata();
});

Route::get('/auth/saml2/entityid', function () {
    return Socialite::driver('saml2')->getServiceProviderEntityId();
});
