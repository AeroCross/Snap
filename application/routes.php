<?php

// events
Event::listen('404', function() {
	return Response::error('404');
});

Event::listen('500', function() {
	return Response::error('500');
});

// controller
Route::controller('login');
Route::controller('dashboard');

// routes
Route::get('/', 'login@index');
Route::get('login', 'login@index');
Route::get('logout', 'login@logout');

Route::get('dashboard', array('before' => 'auth', 'do' => function() {
	return Redirect::to('login')
	->with('message', 'No ha iniciado sesión')
	->with('type', 'warning');
}));

// cross-site request forgery filter
Route::filter('csrf', function() {
	if (Request::forged()) {
		return Response::error('500');
	}
});

// authentication filter
Route::filter('auth', function() {
	if (Auth::guest())  {
		return Redirect::to('login');
	}
});