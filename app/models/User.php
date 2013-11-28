<?php

use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

class User extends SentryUserModel {

	public static $rules = array(
		'email'    => 'required|email', // make sure the email is an actual email
		'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
	);
	
	/* override the Sentry User Model's attributes (customised for multifactor auth) */
	protected $hidden = array(
		'password',
		'password_2',
		'reset_password_code',
		'activation_code',
		'persist_code',
	);
	
	protected $hashableAttributes = array(
		'password',
		'password_2',
		'persist_code',
	);
	
	
	/**
	 * Returns the user's second password (hashed).
	 *
	 * @return string
	 */
	public function getPassword2()
	{
		return $this->password_2;
	}
	
	
	/**
	 * Checks the password passed matches the user's second password.
	 *
	 * @param  string  $password
	 * @return bool
	 */
	public function checkPassword2($password)
	{
		return $this->checkHash($password, $this->getPassword2());
	}
	
	
	/**
	 * Checks if the user has multifactor login enabled
	 *
	 * @param  string  $password
	 * @return bool
	 */
	public function hasMultifactorLogin()
	{
		//first check if the user has multifactor login enabled
		if($this->multifactor_login)
			return true;
		//else check if any groups the user belongs to enforce multifactor login
		else{
			$groups = $this->getGroups();
			foreach($groups as $group){
				if($group->force_multifactor_login)
					return true;
			}
		}
		//not enabled
		return false;
	}
	
	
	/**
	 * Attempts to reset a user's password/s by matching
	 * the reset code generated with the user's.
	 *
	 * @param  string  $resetCode
	 * @param  string  $newPassword
	 * @param  string  $newPassword2
	 * @return bool
	 */
	public function attemptResetPassword($resetCode, $newPassword, $newPassword2=null)
	{
		if ($this->checkResetPasswordCode($resetCode))
		{
			$this->password = $newPassword;
			$this->password_2 = $newPassword2;
			$this->reset_password_code = null;
			return $this->save();
		}
	}
}