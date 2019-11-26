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

mix.js('resources/js/app.js', 'public/js/app.min.js')
    .sass('resources/sass/app.scss', 'public/css/app.min.css')
    // .copyDirectory('resources/svg', 'public/svg')
    .copyDirectory('resources/fontello', 'public/fonts')
    .copyDirectory('resources/fontello', 'public/fonts')
    .copyDirectory('resources/svg', 'public/svg');
// .webpackConfig({
//     module: {
//         rules: [
//             {
//                 test: /\.css$/,
//                 loaders: [
//                     'vue-style-loader',
//                     {
//                         loader: 'css-loader',
//                         options: {
//                             modules: true,
//                             localIdentName: '[local]_[hash:base64:8]',
//                         },
//                     },
//                 ],
//             },
//         ],
//     },
// });
