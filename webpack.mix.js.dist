let mix = require('laravel-mix').mix;

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 | Full API
 | mix.js(src, output);
 | mix.extract(vendorLibs);
 | mix.sass(src, output);
 | mix.less(src, output);
 | mix.combine(files, destination);
 | mix.copy(from, to);
 | mix.minify(file);
 | mix.sourceMaps(); // Enable sourcemaps
 | mix.version(); // Enable versioning.
 | mix.disableNotifications();
 | mix.setPublicPath('path/to/public'); <-- Useful for Node apps.
 | mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
 | mix.autoload(libs);
 | mix.standaloneSass(src, output, pluginOptions = {});
 | mix.options(options);
 | mix.copyDirectory(from, to);
 */


mix
    .setPublicPath('web') // assuming that your public path is the symfony web directory
    .js('app/Resources/assets/js/app.js', 'js')
    .sass('app/Resources/assets/sass/app.scss', 'css');

/*
 | If your app requires jQuery, you can manually add it.
 |
 | mix.autoload({
 |     jquery: ['$', 'window.jQuery', 'jQuery']
 | });
*/