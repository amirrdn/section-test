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
Route::get('/alert-user', function () {
    return view('alert');
})->name('alert');
Route::post('/attempt', 'User\LoginController@attempt')->name('signin.attempt');
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/customers', 'CustomerController@index')->name('indexcust');
Route::get('/add-customer', 'CustomerController@create')->name('addcust');
Route::post('/save-customer', 'CustomerController@store')->name('savecust');
Route::get('/edit-customer/{id}', 'CustomerController@edit')->name('editcust');
Route::post('/update-customer/{id}', 'CustomerController@update')->name('updatecust');
Route::get('/delete-customer/{id}', 'CustomerController@delete')->name('deletecust');
Route::get('/print-customer', 'CustomerController@Prints')->name('printcust');
 
/* USER LINK */

Route::get('/user-list', 'User\UserController@index')->name('user_list');
Route::get('/user-add', 'User\UserController@create')->name('user_create');
Route::post('/user-save', 'User\UserController@store')->name('user_save');
Route::get('/edit-user/{id}', 'User\UserController@edit')->name('edit_user');
Route::post('/update-user/{id}', 'User\UserController@updete')->name('update_user');
Route::get('/delete-user/{id}', 'User\UserController@delete')->name('delete_user');
Route::post('/delete-users', 'User\UserController@delete2')->name('delete_users');
Route::get('/get-data-user', ['as'=>'get.datauser','uses'=>'User\UserController@getData']);
Route::post('/search-data-user', ['as'=>'get.searchdatauser','uses'=>'User\UserController@getCustomFilterData']);
Route::get('/pdf-user','User\UserController@downloadPDF')->name('pdfuser');
Route::get('/print-user','User\UserController@print')->name('userpirnt');

/* Role */
Route::get('/index-role','User\RoleController@index')->name('roles');
Route::get('/get-role','User\RoleController@show')->name('rolesdata');
Route::get('/create-role','User\RoleController@create')->name('rolescreate');
Route::post('/save-role','User\RoleController@store')->name('rolessave');
Route::get('/edit-role/{id}','User\RoleController@edit')->name('rolesedit');
Route::post('/update-role/{id}','User\RoleController@update')->name('rolesupdate');
Route::get('/delete-role/{id}','User\RoleController@delete')->name('rolesdelete');
Route::post('/delete-roles','User\RoleController@delete2')->name('rolesdelete2');
