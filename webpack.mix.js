const Clean   = require('clean-webpack-plugin');
const mix     = require('laravel-mix');
const webpack = require('webpack');
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
mix.browserSync({
    open : false,
    proxy: 'laravel.test'
});

mix.setResourceRoot('../');

if (process.env.NODE_ENV == 'development') {
    mix.webpackConfig({devtool: 'source-map'});
}

mix.webpackConfig({
    plugins: [
        new Clean(['public/css', 'public/fonts', 'public/images', 'public/js', ], {
            verbose: false
        }),
        new webpack.ProvidePlugin({
            $: 'jquery', jQuery: 'jquery', 'window.jQuery': 'jquery'
        })
    ],
})

mix.js('resources/js/app.js', 'public/js')
    .copyDirectory('resources/images', 'public/images')
    .sass('resources/sass/icon-fonts/coreui-icons.scss', 'public/css')
    .sass('resources/sass/icon-fonts/font-awesome.scss', 'public/css')
    .sass('resources/sass/icon-fonts/simple-line-icons.scss', 'public/css')
    .sass('resources/sass/preloader.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css');

if (process.env.NODE_ENV != 'testing') {
    mix.extract([
        'bootstrap', 'jquery', 'toastr', 'vue', 'popper.js',
        'lodash.escaperegexp', 'lodash.filter', 'lodash.debounce',
        'perfect-scrollbar'
    ]);

    mix.version();
}