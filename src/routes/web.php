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

Route::get('/', 'WorkstationController@dashboard');

Route::get('/workstation/raport', 'RaportController@index');
Route::get('/workstation/invalid', 'WorkstationController@invalidHost');

Route::any('/workstation/post-json', 'WorkstationController@postJSON');

Route::resource('/template', 'TemplateController');
Route::resource('/workstation', 'WorkstationController');