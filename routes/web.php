<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'AdminController@showLoginForm')->name('admin.login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Admin routes
Route::prefix('admin')->group(function(){
  Route::post('/login', 'AdminController@login')->name('admin.login.submit');
  Route::get('/', 'DashboardController@index')->name('admin.dashboard');
});
//user routes
Route::prefix('user')->group(function(){
  Route::get('/', 'DashboardController@index')->name('user.dashboard');
  Route::get('/view', 'UsersController@index')->name('view.user');
  Route::get('/add', 'UsersController@showAddUserForm')->name('add.user');
  Route::post('/add', 'UsersController@create')->name('add.user.submit');
  Route::get('/edit', 'UsersController@showEditUserForm')->name('edit.user');
  Route::post('/edit', 'UsersController@update')->name('edit.user.submit');
});
//member routes
Route::prefix('member')->group(function(){
  Route::get('/view', 'MemberController@index')->name('view.member');
  Route::get('/add', 'MemberController@showAddMemberForm')->name('add.member');
  Route::post('/add', 'MemberController@create')->name('add.member.submit');
  Route::get('/edit', 'MemberController@showEditMemberForm')->name('edit.member');
  Route::post('/edit', 'MemberController@update')->name('edit.member.submit');
});
//ministry routes
Route::prefix('ministry')->group(function(){
  Route::get('/view', 'MinistryController@index')->name('view.ministry');
  Route::get('/add', 'MinistryController@showAddMemberForm')->name('add.ministry');
  Route::post('/add', 'MinistryController@create')->name('add.ministry.submit');
  Route::get('/edit', 'MinistryController@showEditMemberForm')->name('edit.ministry');
  Route::post('/edit', 'MinistryController@update')->name('edit.ministry.submit');
});
//department routes
Route::prefix('department')->group(function(){
  Route::get('/view', 'DepartmentController@index')->name('view.department');
  Route::get('/add', 'DepartmentController@showAddMemberForm')->name('add.department');
  Route::post('/add', 'DepartmentController@create')->name('add.department.submit');
  Route::get('/edit', 'DepartmentController@showEditMemberForm')->name('edit.department');
  Route::post('/edit', 'DepartmentController@update')->name('edit.department.submit');
});

Route::get('/logout','AdminController@logout')->name('logout');
