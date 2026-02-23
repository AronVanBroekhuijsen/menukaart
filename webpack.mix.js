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

mix.js('resources/js/app.js', 'public/js')
    .postCss('./node_modules/jodit/es5/jodit.min.css', 'public/build')
    .sass('resources/css/app.scss', 'public/css')
    .sass('resources/css/admin.scss', 'public/css')
    .sourceMaps();
