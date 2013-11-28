<?php

class LoginController extends BaseController {

	public function showLogin()
	{
        return View::make('auth.login');
	}

	public function login()
	{
		if( Input::get('rememberMe')==='rememberMe' )
			$remember = true;
		else
			$remember = false;
		
		//Attempt to authenticate the user using Sentry
		try
		{
			/*----------Multifactor Login----------*/
			//First find the user and check if multifactor login is enabled
			$user = Sentry::findUserByLogin( Input::get('email') );
		   
			if( $user->hasMultifactorLogin() ){
				//first validate the input on a basic level		
				$rules = array(
					'email'    => 'required|email', // make sure the email is an actual email
					'password' => 'required|alphaNum|min:3', // password can only be alphanumeric and has to be greater than 3 characters
					'password2' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
				);
				$validator = Validator::make(Input::all(), $rules);
				if ($validator->fails()) {
					return Redirect::to('login')
						->withErrors($validator) // send back all errors to the login form
						->withInput(Input::except('password', 'password2')); // send back the input (not the password) so that we can repopulate the form
				}
		
				//try to authenticate the user with the two passwords
				$credentials = array(
					'email' 	=> Input::get('email'),
					'password' 	=> Input::get('password'),
					'password_2' 	=> Input::get('password2')
				);
				
				//NB:Sentry::authenticate will throw an error is no user found or an exception occures, otherwise it returns the User if successfuly authenticated
				if (Sentry::authenticate($credentials, $remember)) 	
					// validation successful!
					return Redirect::intended('home');
			}
				
			/*----------Normal Login---------*/
				
			//first validate the input on a basic level		
			$rules = array(
				'email'    => 'required|email', // make sure the email is an actual email
				'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
			);
			$validator = Validator::make(Input::all(), $rules);
			if ($validator->fails()) {
				return Redirect::to('login')
					->withErrors($validator) // send back all errors to the login form
					->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
			}
	
			//try to authenticate the user with the credentials
			$credentials = array(
				'email' 	=> Input::get('email'),
				'password' 	=> Input::get('password')
			);			
			
			if (Sentry::authenticate($credentials, $remember))
				// validation successful!
				return Redirect::intended('home');
		}
		catch (exception $e)
		{
			//catch any exceptions raised and redirect with an error for the view to display			
			//create a message bag for the error message
			$errors = new \Illuminate\Support\MessageBag;
			switch( get_class($e) ){
				case "Cartalyst\Sentry\Users\LoginRequiredException":
					$errors->add('email', 'Login field is required.');
					break;
				case "Cartalyst\Sentry\Users\PasswordRequiredException":
					$errors->add('password', 'Password field is required.');
					break;
				case "Cartalyst\Sentry\Users\WrongPasswordException":
					$errors->add('general', 'wrong email/password combination');
					break;
				case "Cartalyst\Sentry\Users\UserNotFoundException":
					$errors->add('general', 'wrong email/password combination');
					break;
				case "Cartalyst\Sentry\Users\UserNotActivatedException":
					$errors->add('general', 'Account is not activated.');
					break;
				// The following is only required if throttle is enabled	
				case "Cartalyst\Sentry\Throttling\UserSuspendedException":
					$errors->add('general', 'Account has been suspended.');
					break;	
				case "Cartalyst\Sentry\Throttling\UserBannedException":
					$errors->add('general', 'Account has been banned.');
					break;			
				default:
					$errors->add('general', 'unknown login error.');
			}			
			
			return Redirect::to('login')
				->withErrors($errors) // send back all errors to the login form
				->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		}
	}//end login()

	public function logout()
	{
		Sentry::logout();
		return Redirect::to('home');
	}

}
