const mix = require('laravel-mix');

mix.webpackConfig({
  watchOptions: {
    aggregateTimeout: 100,
  }
});

mix.version();

mix.ts('resources/js/app.ts', 'public/js').vue();

mix.sass('resources/sass/app.scss', 'public/css');
