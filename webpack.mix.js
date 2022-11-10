const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/front.js', 'public/js')
    .js('resources/js/validation.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
