const mix = require('laravel-mix');
require('laravel-mix-polyfill');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/sass/app.scss', 'public/css', {
        sassOptions: {
            includePaths: ['node_modules']
        }
    }).polyfill({
      enabled: true,
      useBuiltIns: "usage",
      targets: "cover 99.5%",
      corejs: 3
   });
