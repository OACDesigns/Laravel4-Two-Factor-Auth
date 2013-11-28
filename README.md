Laravel 4: Two-Factor Auth
=======================
TFA is becoming pretty standard for web apps it seems. Here is a barebones implementation of two-factor authentication using Laravel 4 with the Sentry 2 bundle.


##

#Setup
###1. Update Laravel + Sentry
Run `composer update` to fully install Laravel 4 and it's dependency, Sentry 2.

###2. Configure Laravel
Firstly run `php artisan key:generate` to generate a new key. Then go into the `app\config\` folder and update the database, app, and any other settings as required.

###3. Setup the Database
Run `php artisan migrate --seed` to carry out the database migrations and to seed it with some initial data.

###4. Get Coding


##
