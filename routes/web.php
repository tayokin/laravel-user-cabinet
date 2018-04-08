<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('/privacy', 'AccountKitController@privacy')->name('privacy');
Route::get('/facebook-account-kit/endpoint', 'AccountKitController@endpoint')->name('endpoint');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');
