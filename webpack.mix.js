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

mix.js('resources/js/app.js', 'public/js/scripts.js')
   .sass('resources/sass/app.scss', 'public/css/styles.css');

mix.scripts([
    'resources/themes/app/js/core/jquery.min.js',
    'resources/themes/app/js/core/popper.min.js',
    'resources/themes/app/js/core/bootstrap-material-design.min.js',
    'resources/themes/app/js/plugins/perfect-scrollbar.jquery.min.js',
    'resources/themes/app/js/plugins/moment.min.js',
    'resources/themes/app/js/plugins/sweetalert2.js',
    'resources/themes/app/js/plugins/jquery.validate.min.js',
    'resources/themes/app/js/plugins/jquery.bootstrap-wizard.js',
    'resources/themes/app/js/plugins/boostrap-selectpicker.js',
    'resources/themes/app/js/plugins/boostrap-datetimepicker.min.js',
    'resources/themes/app/js/plugins/jquery.dataTables.min.js',
    'resources/themes/app/js/plugins/boostrap-tagsinput.js',
    'resources/themes/app/js/plugins/jasny-bootstrap.min.js',
    'resources/themes/app/js/plugins/fullcalendar.min.js',
    'resources/themes/app/js/plugins/jquery-jvectormap.js',
    'resources/themes/app/js/plugins/nouislider.min.js',
    'resources/themes/app/js/plugins/arrive.min.js',
    'resources/themes/app/js/plugins/chartist.min.js',
    'resources/themes/app/js/plugins/bootstrap-notify.js',
    'resources/themes/app/js/material-dashboard.min.js',
    'resources/themes/app/js/main.js',
], 'public/js/app.js');

mix.styles([
    'resources/themes/app/css/material-dashboard.css'
], 'public/css/app.css');

// mix.styles([
//     'resources/themes/login/css/style.css'
// ], 'public/css/auth/style.css');
