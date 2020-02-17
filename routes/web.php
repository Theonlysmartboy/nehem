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

Route::get('/', 'AdminController@showLoginForm')->name('admin.login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->group(function(){
  Route::post('/login', 'AdminController@login')->name('admin.login.submit');
  Route::get('/', 'DashboardController@index')->name('admin.dashboard');
  Route::get('/view/user', 'UsersController@index')->name('admin.view.user');
  Route::get('/add/user', 'UsersController@showAddUserForm')->name('admin.add.user');
  Route::post('/add/user', 'UsersController@create')->name('admin.add.user.submit');
  Route::get('/edit/user', 'UsersController@showEditUserForm')->name('admin.edit.user');
  Route::post('/edit/user', 'UsersController@update')->name('admin.edit.user.post');
});
Route::prefix('user')->group(function(){
  Route::post('/login', 'AdminController@login')->name('user.login.submit');
  Route::get('/', 'DashboardController@index')->name('user.dashboard');
  Route::get('/view/member', 'MembersController@index')->name('user.view.member');
  Route::get('/add/member', 'MembersController@showAddMemberForm')->name('admin.add.user');
  Route::post('/add/member', 'MembersController@create')->name('admin.add.user.submit');
  Route::get('/edit/user', 'MembersController@showEditMemberForm')->name('admin.edit.user');
  Route::post('/edit/user', 'MembersController@update')->name('admin.edit.user.post');
});
