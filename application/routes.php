<?php

// events
Event::listen('404', function() {
	return Response::error('404');
});

Event::listen('500', function() {
	return Response::error('500');
});

// cross-site request forgery filter
Route::filter('csrf', function() {
	if (Request::forged()) {
		return Response::error('500');
	}
});

// authentication filter
Route::filter('auth', function() {
	if (Auth::guest())  {
		return Redirect::to('login')->with('notification', 'auth_missing');
	}
});

// landing page
Route::get('/', function() {
	if (Auth::check()) {
		return Redirect::to('dashboard');
	} else {
		return Redirect::to('login');
	}
});

// authentication
Route::post('login',	'auth@login');
Route::get('login',		'auth@login');
Route::get('logout',	'auth@logout');

// locked areas
Route::group(array('before' => 'auth'), function() {
	Route::controller('dashboard');
	
	// tickets
	Route::get('ticket/(:num)',			'ticket@view');	
	Route::get('ticket/add',			'ticket@add');
	Route::get('ticket/all',			'ticket@all');
	Route::get('tickets',				'ticket@all');
	Route::post('ticket/add',			'ticket@add');
	Route::post('ticket/update/(:num)',	'ticket@update');
	Route::put('ticket/search',			'ticket@search');
	Route::put('ticket/status/(:num)',	'ticket@status');

	// alias
	Route::get('ticket', function() {
		return Redirect::to('tickets');
	});

	// settings
	Route::get('settings', 'settings@index');
	Route::put('settings', 'settings@index');

	// files
	Route::get('file/download/(:any)', 'file@download');

	// admin
	Route::get('admin/users', 'admin.users@index');
	Route::post('admin/users/new', 'admin.users@new');
	
	Route::get('admin/companies', 'admin.companies@index');
	Route::post('admin/companies/new', 'admin.companies@new');

	Route::get('admin/roles', 'admin.roles@index');
	Route::put('admin/roles/update', 'admin.roles@update');

	Route::put('admin/companies/update/users', 'admin.companies@update');

	Route::get('admin/departments', 'admin.departments@index');
});
	
