var mix = require('laravel-mix');

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
    'node_modules/trumbowyg/dist/langs/ua.min.js',
    'resources/assets/js/admin.js'
], 'public/js/app.js')
    .js('resources/assets/js/site.js', 'public/js')
    .stylus('resources/assets/stylus/app.styl', 'public/css')
    .stylus('resources/assets/stylus/site.styl', 'public/css')
    .copyDirectory('resources/assets/images', 'public/images');

mix.copy('node_modules/trumbowyg/dist/ui/icons.svg','public/images/vendor/trumbowyg/icons.svg');
mix.copy('resources/assets/ico/*','public/');
// mix.copyDirectory('resources/assets/markitup/templates', 'public/js/markitup/templates');

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
