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

mix.js('resources/js/' + process.env.APP_TEMPLATE + '.js', 'public/js/app.min.js')
    .sass('resources/sass/' + process.env.APP_TEMPLATE + '.scss', 'public/css/app.min.css')
    .copyDirectory('resources/images', 'public/images')
    .copyDirectory('resources/svg', 'public/svg')
    .copyDirectory('resources/fontello', 'public/fonts')
    .copyDirectory('resources/fontello', 'public/fonts')
    .copyDirectory('resources/svg', 'public/svg');

if (process.env.APP_SOUNDCLOUD) {
    mix.js('resources/js/soundcloud.js', 'public/js/splayer.min.js');
}
