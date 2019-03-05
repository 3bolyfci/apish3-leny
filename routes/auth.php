<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Auth routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Auth" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Route;

Route::post('/register', 'RegisterController@register');
Route::post('/login', 'LoginController@login');
Route::post('/verify', 'VerificationController@verify');
Route::post('/reset', 'ResetPasswordController@resetPassword');

