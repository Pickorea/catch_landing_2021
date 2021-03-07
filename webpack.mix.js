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

mix    // Datatables for BS 4
    .copy('node_modules/datatables.net-bs4/css', 'public/css')
    .copy('node_modules/datatables.net-bs4/js', 'public/js')
    .copy('node_modules/datatables.net/js', 'public/js')
    .copy('node_modules/@fortawesome/fontawesome-free/css/all.min.css', 'public/css/fontawesome.min.css')
    .copy('node_modules/@fortawesome/fontawesome-free/js/all.min.js', 'public/js/fontawesome.min.js')
    .copy('node_modules/@fortawesome/fontawesome-free/webfonts/*', 'public/webfonts');

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');
