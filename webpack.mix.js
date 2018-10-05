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
], 'public/js/admin.js'); 

mix.styles('resources/themes/admin/css/material-dashboard.css',
'public/css/admin.css');

mix.scripts([
    'resources/js/main.js'
], 'resources/js/auth.js');

mix.styles([
    'resources/sass/material-design-iconic-font.css',
    'resources/sass/style.css'
], 'public/css/auth.css');