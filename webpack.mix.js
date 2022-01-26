const mix = require('laravel-mix');

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

mix.combine('resources/assets/app/js/', 'public/js/app.js').combine('resources/assets/app/css/', 'public/css/app.css');
mix.combine('resources/assets/login/js/', 'public/js/login.js').combine('resources/assets/login/css/', 'public/css/login.css');

mix.browserSync({
        port: 6969,
        proxy: 'localhost:8000'
});