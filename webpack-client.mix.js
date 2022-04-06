const mix = require('laravel-mix');
let productionSourceMaps = true;
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */
// Enable BrowseSync for run hot only
if (process.argv.includes('--hot')) {
  mix.browserSync({
    proxy: 'localhost:8080',
    open: false,
  });
}

// If Laravel Mix is inside folder /webpack/, reconfigure public path
if (path.resolve(__dirname, '..').indexOf('webpack-client') >= 0) {
  mix.setPublicPath('../');
}
mix.webpackConfig({
  output: {
    chunkFilename: 'assets/js/[name].min.js',
    publicPath: '/',
  },
});
mix
  .js('resources/src/js/index.js', 'public/assets/js/bundle.min.js')
  .sass('resources/src/sass/views/home.scss', 'public/assets/css/views/home.min.css')
  .sass('resources/src/sass/views/auth.scss', 'public/assets/css/views/auth.min.css')
  .sass('resources/src/sass/views/profile.scss', 'public/assets/css/views/profile.min.css')
  .sass('resources/src/sass/views/settings-profile.scss', 'public/assets/css/views/settings-profile.min.css')
  .sass('resources/src/sass/index.scss', 'public/assets/css/index.min.css')
  .sourceMaps(productionSourceMaps, 'source-map');