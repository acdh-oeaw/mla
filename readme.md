# MAGNUM LEGENDARIUM AUSTRIACUM - V2
Why a new repo? Because the whole thing was re-written from scratch. MLA is now based on Laravel 5.8, with Vue 2.6 and Material Components at its front(end). The system requirements for Laravel 5.8 can be found [here](https://laravel.com/docs/5.8#server-requirements).
This repo contains all the files and data needed to get the site up and running, provided your server meets the system requirements. Also, there's no database dump to manually import anymore - the data is inserted using a Seeder. More about that later.
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
Now that we're done with the annoying part, let's run some fun commands to install all the dependencies. At this point I assume that you have composer and npm installed.
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
Wait, that's it? Yes and no. If you haven't configured your webserver yet, now would be the time to do it.
Other than that, you're done. If you run into problems, please follow the [Laravel Installation guide](https://laravel.com/docs/5.8/installation) or ask Google for help.
Thank you and good night.
-mxth
