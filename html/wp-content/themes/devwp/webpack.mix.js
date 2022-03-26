let mix = require('laravel-mix');
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
const tailwindcss = require('tailwindcss');

mix.setPublicPath('./');
mix.browserSync({
   proxy: 'localhost:3010',
});

var plugins = [
   'build/js/plugins/animate.js',
   'build/js/plugins/codebox.js',
   'build/js/plugins/counter.js',
   'build/js/plugins/goscroll.js',
   'build/js/plugins/menu.js',
   'build/js/plugins/navscroll.js',
   'build/js/plugins/removeonclick.js',
   'build/js/plugins/showbyhash.js',
   'build/js/plugins/test.js',
   'build/js/plugins/slideToggle.js',
];

mix.js('assets/js/app.js', 'build/js/')
   .js('assets/js/main.js', 'build/js/')
   .copy('assets/js/plugins/', 'build/js/plugins/')
   .minify(plugins)
   .sass('assets/sass/app.scss', 'build/css/')
   .sass('assets/sass/admin.scss', 'build/css/')
   .options({
      processCssUrls: false,
      postCss: [tailwindcss('tailwind.config.js')],
      hmrOptions: {
         host: "localhost",
         port: 3000,
      },
   });

// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.ts(src, output); <-- Requires tsconfig.json to exist in the same folder as webpack.mix.js
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.standaloneSass('src', output); <-- Faster, but isolated from Webpack.
// mix.fastSass('src', output); <-- Alias for mix.standaloneSass().
// mix.less(src, output);
// mix.stylus(src, output);
// mix.postCss(src, output, [require('postcss-some-plugin')()]);
// mix.browserSync('my-site.dev');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.babelConfig({}); <-- Merge extra Babel configuration (plugins, etc.) with Mix's default.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   globalVueStyles: file, // Variables file to be imported in every component.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   uglify: {}, // Uglify-specific options. https://webpack.github.io/docs/list-of-plugins.html#uglifyjsplugin
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });
