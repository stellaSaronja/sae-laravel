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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/vue', function () {
    return view('vue');
});


// Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/signup', 'AuthController@signup')->name('signup');
Route::post('/signup', 'AuthController@postSignup')->name('postSignup');
Route::get('/activate/{token}', 'AuthController@activate')->name('activate');

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@postLogin')->name('postLogin');
Route::get('/logout', 'AuthController@logout')->name('logout');


// == https://laravel.com/docs/8.x/controllers#restful-partial-resource-routes

// Route::resource('postings', 'PostingController');

Route::get('/postings', 'PostingController@index')->name('postings.index');

Route::middleware('auth')->group(function() {

    Route::get('/postings/create', 'PostingController@create')->name('postings.create');
    Route::post('/postings', 'PostingController@store')->name('postings.store');
});

Route::get('/postings/{id}', 'PostingController@show')->name('postings.show');
Route::get('/postings/{id}/edit', 'PostingController@edit')->name('postings.edit')->middleware('auth');
Route::put('/postings/{id}', 'PostingController@update')->name('postings.update')->middleware('auth');
Route::delete('/postings/{id}', 'PostingController@destroy')->name('postings.destroy')->middleware('auth');

Route::post('/postings/{id}/like', 'PostingController@like')->name('postings.like');
Route::post('/postings/{id}/dislike', 'PostingController@dislike')->name('postings.dislike');
