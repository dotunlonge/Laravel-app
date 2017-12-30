<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'Home\HomeController@index')->name('home');
Route::get ( '/dashboard', 'Home\HomeController@dashboard' )->name('dashboard');
Route::get ( '/history', 'Home\HomeController@history' )->name('history');
Route::post('/sms','Home\HomeController@sendSMS')->name('send');

Route::get ( '/redirect/{service}', 'Auth\SocialAuthController@redirect' );
Route::get ( '/auth/{service}/callback', 'Auth\SocialAuthController@callback' );

Route::get('/verify/{token}', 'Auth\RegisterController@verify');

