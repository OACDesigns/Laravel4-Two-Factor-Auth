<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array( 'before' => 'auth', 'as' => 'home', function()
{
	return View::make('home');
}));


//login and logout
Route::get('login', array('as' => 'login', 'uses' => 'LoginController@showLogin') );
Route::post('login', 'LoginController@login');
Route::get('logout', array('as' => 'logout', 'uses' => 'LoginController@logout') );
