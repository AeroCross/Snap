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
		return Redirect::to('login')->with('notification', 'login');
	}
});

// landing page
Route::get('/', 'auth@login');

// authentication
Route::post('login', 'auth@login');
Route::get('login', 'auth@login');
Route::get('logout', 'auth@logout');

// tickets
Route::post('ticket/add', 'ticket@add');

// locked areas
Route::group(array('before' => 'auth'), function() {
	Route::controller('dashboard');
	Route::controller('ticket');
});