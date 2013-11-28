Laravel 4: Two-Factor Auth
=======================
Two-factor authentication (TFA) is quickly becoming the new standard for web apps. Here is a barebones implementation of two-factor authentication using [Laravel 4](http://laravel.com/) with the [Sentry 2](https://github.com/cartalyst/sentry) bundle.


----------

#Setup
###1. Update Laravel + Sentry
Run `composer update` to fully install Laravel 4 and it's dependency, Sentry 2.

###2. Configure Laravel
Firstly run `php artisan key:generate` to generate a new key. Then go into the `app\config\` folder and update the database, app, and any other settings as required.

###3. Setup the Database
Run `php artisan migrate --seed` to carry out the database migrations and to seed it with some initial data. 3 user groups will be created along with 3 users. 

###4. Get Coding
Have a look through the routes, filters and controllers to see how the authentication is implemented. Check out the Migration and Seed files to see what data is added. Finally look at the Views modify as you need.

##

#Quick Overview

This barebones is a starting point for new Laravel-based systems that require two-factor authentication (i.e. the ability to use 2 passwords to login).  
You can specify on a user account if it uses TFA, or at the group level, forcing all users in that group to require a second password to login.

After setting up the database and seeding it you will have 3 groups with example permissions assigned to them:

- Supers (with force TFA enabled)
- Admins
- Users

You will also have 3 user accounts added:

 - Super Account  
   usr: `super@super.com`  
   pwd: `superpassword1` and `superpassword2`

 - Admin Account  
   usr: `admin@admin.com`  
   pwd: `adminpassword`

 - User Account  
   usr: `user@user.com`  
   pwd: `userpassword`


##
