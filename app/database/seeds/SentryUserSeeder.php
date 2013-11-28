<?php

class SentryUserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->truncate();

		Sentry::getUserProvider()->create(array(
	        'email'    => 'super@super.com',
	        'first_name'    => 'Super',
	        'password' => 'superpassword1',
	        'password_2' => 'superpassword2',
	        'activated' => 1,
	    ));
		
		Sentry::getUserProvider()->create(array(
	        'email'    => 'admin@admin.com',
	        'first_name'    => 'Admin',
	        'password' => 'adminpassword',
	        'activated' => 1,
	    ));

	    Sentry::getUserProvider()->create(array(
	        'email'    => 'user@user.com',
	        'first_name'    => 'User',
	        'password' => 'userpassword',
	        'activated' => 1,
	    ));
	}

}