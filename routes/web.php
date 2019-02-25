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

Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/register-user', function () {
    return view('register');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/customers', 'CustomerController@index')->name('indexcust');
Route::get('/add-customer', 'CustomerController@create')->name('addcust');
Route::post('/save-customer', 'CustomerController@store')->name('savecust');
Route::get('/edit-customer/{id}', 'CustomerController@edit')->name('editcust');
Route::post('/update-customer/{id}', 'CustomerController@update')->name('updatecust');
Route::get('/delete-customer/{id}', 'CustomerController@delete')->name('deletecust');
Route::get('/print-customer', 'CustomerController@Prints')->name('printcust');


