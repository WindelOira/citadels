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

mix
.js('resources/assets/scripts/app.js', 'public/assets/scripts')
.js('resources/assets/scripts/uploader.js', 'public/assets/scripts')
.scripts([
	'resources/assets/scripts/shards-dashboards.1.2.0.min.js',
  'resources/assets/scripts/admin.js',
  'resources/assets/scripts/tables.js',
  // 'resources/assets/scripts/uploader.js',
], 'public/assets/scripts/admin.js')
.styles([
  'resources/assets/styles/main.css',
  'resources/assets/styles/admin.css'
], 'public/assets/styles/admin.css')
.sass('resources/assets/sass/app.scss', 'public/assets/styles')
.sass('resources/assets/sass/admin/shards-dashboards.scss', 'public/assets/styles/admin.css')
.sass('resources/assets/sass/admin/extras.scss', 'public/assets/styles/admin.css');