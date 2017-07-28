const { mix } = require('laravel-mix');

mix
    .js('resources/assets/js/dashboard.js', 'public/js')
    .sass('resources/assets/css/dashboard.css', 'public/css')

	// Use versioning on the app if you build dashboard assets there
    // .version()

    .options({
        processCssUrls: false,
    })

    .webpackConfig({
        module: {
            rules: [
                // With the `import-glob-loader` we can use globs in our import
                // statements in css.
                {
                    test: /\.css/,
                    loader: 'import-glob-loader',
                    enforce: 'pre',
                },
            ],
        },
    });
