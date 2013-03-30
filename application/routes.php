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
Route::get('/', 'auth@login');

// authentication
Route::post('login', 'auth@login');
Route::get('login', 'auth@login');
Route::get('logout', 'auth@logout');

// locked areas
Route::group(array('before' => 'auth'), function() {
	Route::controller('dashboard');
	
	// tickets
	Route::get('ticket/(:num)', 'ticket@view');	
	Route::get('ticket/add', 'ticket@add');
	Route::post('ticket/add', 'ticket@add');
	Route::post('ticket/update/(:num)', 'ticket@update');
	Route::put('ticket/status/(:num)', 'ticket@status');

	// settings
	Route::get('settings', 'settings@index');
	Route::put('settings', 'settings@index');
});