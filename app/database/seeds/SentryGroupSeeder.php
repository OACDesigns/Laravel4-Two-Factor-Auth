<?php

class SentryGroupSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('groups')->truncate();

		Sentry::getGroupProvider()->create(array(
	        'name'        => 'Supers',
	        'permissions' => array(
	            'system' => 1,
	        ),
	        'force_multifactor_login' => 1,
		));
			
		Sentry::getGroupProvider()->create(array(
	        'name'        => 'Admins',
	        'permissions' => array(
	            'system.user' => 1,
	            'system.group' => 1,
	        )));
			
			
		Sentry::getGroupProvider()->create(array(
	        'name'        => 'Users',
	        'permissions' => array(
	            'system.user.self.show' => 1,
	            'system.user.self.edit' => 1,
	            'system.user.self.update' => 1,
	            'system.user.self.destroy' => 0,
	        )));

	}//end run()

}