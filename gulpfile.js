var elixir = require('laravel-elixir');
const niv = require('npm-install-version');

niv.install('bootstrap@3.3.7', { destination: 'bootstrap-3' });

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
  mix
  .copy(
    'node_modules/font-awesome/fonts',
    'public/fonts'
  )
  .copy(
    'node_modules/bootstrap/fonts/',
    'public/fonts/'
  )
  // Compile styles and scripts
  .styles([
    '../../../node_modules/font-awesome/css/font-awesome.css',
    '../../../node_modules/bootstrap/dist/css/bootstrap.css',
    'style.css',
  ], 'public/css/')
  // Compile styles and scripts
  .styles([
    '../../../node_modules/bootstrap-3/dist/css/bootstrap.css',
    '../../../node_modules/font-awesome/css/font-awesome.css',
    '../../../node_modules/admin-lte/dist/css/AdminLTE.css',
    '../../../node_modules/admin-lte/dist/css/skins/skin-blue.css',
  ], 'public/css/admin.css')
  .scripts([
    '../../../node_modules/jquery/dist/jquery.js',
    '../../../node_modules/bootstrap-3/dist/js/bootstrap.js',
    '../../../node_modules/admin-lte/dist/js/app.js',
    'script.js',
  ], 'public/js/admin.js')
  .webpack('vue.js');
});