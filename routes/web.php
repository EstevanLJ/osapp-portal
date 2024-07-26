<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::get('/forms/{id}/pdf', 'FormsController@pdf')->name('forms.pdf');
Route::get('/forms/foto/{id}', 'FormsController@foto')->name('forms.foto');
Route::resource('/forms', 'FormsController')->only(['index', 'show']);
Route::resource('/users', 'UsersController')->except(['show']);
Route::resource('/failedJobs', 'FailedJobsController')->only(['index', 'show']);