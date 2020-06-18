<?php

use Ethereal\Support\Facade\Route;

Route::get('/', 'HomeController@index');

Route::get('/login', 'HomeController@login');
Route::post('/login', 'AuthController@login');

Route::get('/register', 'HomeController@register');
Route::post('/register', 'UserController@register');

Route::get('/dashboard', 'HomeController@dashboard');