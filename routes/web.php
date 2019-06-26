<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| PHP version 7.2.11-4+ubuntu18.04.1+deb.sury.org+1 (cli)
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::any('/auth', 'usersController@auth');

Route::any('/', 'PagesController@home');

Route::any('/trial', 'PagesController@trial');

Route::any('/user', 'PagesController@user');

Route::any('/alluserdata', 'PagesController@alluserdata');

Route::any('/userspercountry', 'PagesController@userspercountry');

Route::any('/inbound', 'PagesController@inbound');

Route::any('/users', 'PagesController@users');

Route::any('/outbound', 'PagesController@outbound');

Route::any('/layout', 'PagesController@layout');

Route::any('/laratest', 'PagesController@laratest');
