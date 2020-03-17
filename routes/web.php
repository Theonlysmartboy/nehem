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
  Route::get('/edit/{id}', 'UsersController@showEditUserForm')->name('edit.user');
  Route::post('/edit/{id}', 'UsersController@update')->name('edit.user.submit');
  Route::get('/delete/{id}', 'UsersController@delete')->name('delete.user');
});
//member routes
Route::prefix('member')->group(function(){
  Route::get('/view', 'MemberController@index')->name('view.member');
  Route::get('/add', 'MemberController@showAddMemberForm')->name('add.member');
  Route::post('/add', 'MemberController@create')->name('add.member.submit');
  Route::get('/edit/{id}', 'MemberController@showEditMemberForm')->name('edit.member');
  Route::post('/edit/{id}', 'MemberController@update')->name('edit.member.submit');
  Route::get('/delete/{id}', 'MemberController@delete')->name('delete.member');
});
//ministry routes
Route::prefix('ministry')->group(function(){
  Route::get('/view', 'MinistryController@index')->name('view.ministry');
  Route::get('/add', 'MinistryController@showAddMinistryForm')->name('add.ministry');
  Route::post('/add', 'MinistryController@create')->name('add.ministry.submit');
  Route::get('/edit/{id}', 'MinistryController@showEditMinistryForm')->name('edit.ministry');
  Route::post('/edit/{id}', 'MinistryController@update')->name('edit.ministry.submit');
  Route::get('/delete/{id}', 'MinistryController@delete')->name('delete.ministry');
});
//department routes
Route::prefix('department')->group(function(){
  Route::get('/view', 'DepartmentController@index')->name('view.department');
  Route::get('/add', 'DepartmentController@showAddDepartmentForm')->name('add.department');
  Route::post('/add', 'DepartmentController@create')->name('add.department.submit');
  Route::get('/edit/{id}', 'DepartmentController@showEditMemberForm')->name('edit.department');
  Route::post('/edit/{id}', 'DepartmentController@update')->name('edit.department.submit');
  Route::get('/delete/{id}', 'DepartmentController@delete')->name('delete.department');
});

Route::get('/logout','AdminController@logout')->name('logout');
