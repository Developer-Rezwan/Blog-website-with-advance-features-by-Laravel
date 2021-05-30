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

mix.js('resources/backend/js/app.js', 'public/backend/js/app.js')
        .js('resources/frontend/js/app.js', 'public/frontend/js/app.js')
    .postCss('resources/backend/css/app.css', 'public/backend/css/app.css', [
        //
    ])
    .postCss('resources/frontend/css/app.css', 'public/frontend/css/app.css', [
        //
    ]).version();
