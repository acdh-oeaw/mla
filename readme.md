# MAGNUM LEGENDARIUM AUSTRIACUM - V2
Why a new repo? Because the whole thing was re-written from scratch. MLA is now based on Laravel 8.0, with Vue 2.6 and Material Components at its front(end).
This repo contains all the files and data needed to get the site up and running, provided your server meets the system requirements. Also, there's no database dump to manually import anymore - the data is inserted using a Seeder. More about that later.
## System requirements
* [Laravel 8.0 system requirements](https://laravel.com/docs/8.x/deployment#server-requirements)
* [Intervention Image requirements](http://image.intervention.io/)
* [TNTSearch requirements](https://github.com/teamtnt/tntsearch)

Also, I assume that you have composer and npm installed globally.
## Installation
Simply clone this repo into the directory of your choice, change into the cloned directory and run the following commands. 
Make sure your webserver user has permission to write to at least the following directories (as well as their subdirectories):
```
storage/
bootstrap/
```
Just keep in mind that the user you're logged into right now must also be able to write to these directories. Otherwise you'll run into problems later on.
Next, we have to create an .env file. The Laravel folks kindly provide the example file `.env.example`, which we can copy and modify.
```
cp .env.example .env
```
In your newly created `.env` file, using the text editor of your choice adjust the environment settings (feel free to change these to whatever, just remember to use double quotes when using spaces), leaving the `APP_KEY` variable blank. We'll take care of that one in a minute.
```
APP_NAME=MLA
APP_ENV=local
APP_KEY=
APP_DEBUG=false
APP_URL=http://mla.oeaw.ac.at
```
Also, update these lines to match your database configuration:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
Now that we're done with the annoying part, let's run some fun commands to install all the dependencies.
```
composer install
npm install
```
We should also generate an application key:
```
php artisan key:generate
```
Cool. The next commands will create the database tables and insert all the data.
```
php artisan migrate
php artisan db:seed
```
If you set up the database connection correctly, this will have worked without a hitch!
Lastly, let's generate the JavaScript and CSS files.
```
npm run production
```
Wait, that's it? Yes and no. If you haven't configured your webserver yet, now would be the time to do it. Also, you might want to test your installation (see below).
Other than that, you're done. If you run into problems, please follow the [Laravel Installation guide](https://laravel.com/docs/8.x/installation) or ask Google for help.
## Testing
This repo includes a couple of simple unit tests, which check whether the API works the way it should. To test your installation, simply run the included `phpunit` script. To run the tests successfully, your user needs to be able to write to the `storage` directory.
```
php vendor/bin/phpunit
```
If everything works the way it is supposed to, you are greeted by this friendly message: `OK (17 tests, 34 assertions)`.
## Troubleshooting
In 9 out of 10 cases, errors are related to missing write permissions. This is an issue even I run into all the time.
And that's pretty much all the advice I can give you.
It's just you and you alone out there.
