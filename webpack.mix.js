const { autoload } = require('laravel-mix');
const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/customadmin.js', 'public/js/admin.js')
    .autoload(
        {
            jquery:['$','jQuery','windows.jquery'],
            'popper.js':["popper"]
        }

    )
        .extract()
        .sass('resources/sass/admin.scss','public/css/') ;
