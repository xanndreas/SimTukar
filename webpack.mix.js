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

mix.js('resources/js/app.js', 'public/js')
    .css('resources/css/landing/all.min.css', 'public/css/landing/')
    .css('resources/css/landing/bootstrap.min.css', 'public/css/landing/')
    .css('resources/css/landing/simple-line-icons.css', 'public/css/landing/')
    .css('resources/css/landing/slick.css', 'public/css/landing/')
    .sass('resources/css/landing/style.scss', 'public/css/landing/')
    .postCss('resources/css/app.css', 'public/css')
    .copy('resources/js/landing', 'public/js/landing')
    .copy('resources/fonts', 'public/fonts')
    .copy('resources/images', 'public/images');
