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
   .sass('resources/sass/app.scss', 'public/css');

mix.scripts([
    'resources/themes/admin/js/core/jquery.min.js',
    'resources/themes/admin/js/popper.min.js',
    'resources/themes/admin/js/bootstrap-material-design.min.js',
    'resources/themes/admin/js/perfect-scrollbar.jquery.min.js',
    'resources/themes/admin/js/assets/js/plugins/chartist.min.js',
    'resources/themes/admin/js/assets/js/plugins/bootstrap-notify.js',
    'resources/themes/admin/js/material-dashboard.min.js',
    'resources/themes/admin/js/main.js'
], 'public/js/admin.js'); 

mix.styles([
    'resources/themes/admin/css/material-dashboard.css',
    'resources/themes/admin/css/main.css'
], 'public/css/admin.css');

mix.styles([
    'resources/themes/login/css/style.css'
], 'public/css/auth/style.css');
