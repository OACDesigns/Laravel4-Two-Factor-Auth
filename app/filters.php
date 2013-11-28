<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if( !Sentry::check() ) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('auth.permission', function($route, $request, $value)
{
	//check if the user has permission to carry out the requested action
	if (!Sentry::check()) return Redirect::guest('login');
	
	//check the user's permissions against the request
	try
	{
		// Find the user logged in
		$user = Sentry::getUser();
	
		// Check if the user has the requested permissions. 
		//NB: multiple permissions may be used by passing an array
		if ($user->hasAccess($value))
		{
			// User has access to the given permission
			return $user->first_name." has access: ".$value;
		}
		else
		{
			// User does not have access to the given permission
			return $user->first_name." does not have access: ".$value;
		}
	}
	catch (Cartalyst\Sentry\UserNotFoundException $e)
	{
		Session::flash('error', trans('User was not found.'));
		return Redirect::route('login');
	}

	// we need to determine if a non admin user 
	// is trying to access their own account.
	$userId = $route->getParameter('users');
	
	
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::route('home');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});