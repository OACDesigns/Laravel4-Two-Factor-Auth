<?php

class SentryUserGroupSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users_groups')->truncate();

		$superUser = Sentry::getUserProvider()->findByLogin('super@super.com');
		$adminUser = Sentry::getUserProvider()->findByLogin('admin@admin.com');
		$userUser = Sentry::getUserProvider()->findByLogin('user@user.com');

		$superGroup = Sentry::getGroupProvider()->findByName('Supers');
		$adminGroup = Sentry::getGroupProvider()->findByName('Admins');
		$userGroup = Sentry::getGroupProvider()->findByName('Users');

	    // Assign the groups to the users		
	    $superUser->addGroup($superGroup);
	    $superUser->addGroup($userGroup);
		
	    $adminUser->addGroup($adminGroup);
	    $adminUser->addGroup($userGroup);
		
	    $userUser->addGroup($userGroup);
	}

}