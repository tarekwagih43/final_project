const mix = require('laravel-mix');

mix
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery']
    })
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/adminlte.js', 'public/js')
    .js('resources/js/fontawesome.js', 'public/js')
    .extract()
    .sass('resources/sass/app.scss', 'public/css')
    .browserSync('http://127.0.0.1:8000/')
    .disableNotifications();
