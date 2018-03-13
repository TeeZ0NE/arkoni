let mix = require('laravel-mix');

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
mix.autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'],
    moment: 'moment'
});
mix.js([
    'resources/assets/js/app.js',
    'resources/assets/js/admin.js',
], 'public/js/app.js')
    .stylus('resources/assets/stylus/app.styl', 'public/css');

mix.webpackConfig({
    resolve: {
        modules: [
            'node_modules'
        ],
        alias: {
            'vue$': 'vue/dist/vue.js',
            jquery: 'jquery/src/jquery'
        }
    }
});
if (mix.inProduction()) {
    mix.version();
}
