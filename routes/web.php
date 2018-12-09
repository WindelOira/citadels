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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::name('admin.')->middleware(['auth'])->group(function() {
	Route::get('/admin', function() {
		return view('admin.index');
	});

  Route::resource('/admin/users/roles', 'AdminUserRolesController');
	Route::resource('/admin/users', 'AdminUsersController');
	Route::resource('/admin/medias', 'AdminMediasController');
	Route::resource('/admin/orders', 'AdminOrdersController');
  Route::name('products')->resource('/admin/products/categories', 'AdminProductCategoriesController');
	Route::resource('/admin/products', 'AdminProductsController');

  Route::get('/admin/datatables/medias', 'DataTablesController@getDataTablesMediasData')->name('datatables.medias');
  Route::get('/admin/datatables/roles', 'DataTablesController@getDataTablesRolesData')->name('datatables.roles');
  Route::get('/admin/datatables/users', 'DataTablesController@getDataTablesUsersData')->name('datatables.users');
  Route::get('/admin/datatables/products', 'DataTablesController@getDataTablesProductsData')->name('datatables.products');
  Route::get('/admin/datatables/products/categories', 'DataTablesController@getDataTablesProductCategoriesData')->name('datatables.products.categories');
});