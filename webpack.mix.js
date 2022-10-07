const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

const CKEditorWebpackPlugin = require( '@ckeditor/ckeditor5-dev-webpack-plugin' );
const CKEStyles = require('@ckeditor/ckeditor5-dev-utils').styles;
const CKERegex = {
    svg: /ckeditor5-[^/\\]+[/\\]theme[/\\]icons[/\\][^/\\]+\.svg$/,
    css: /ckeditor5-[^/\\]+[/\\]theme[/\\].+\.css/,
};


Mix.listen('configReady', webpackConfig => {
const rules = webpackConfig.module.rules;
const targetSVG = /(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/;
const targetFont = /(\.(woff2?|ttf|eot|otf)$|font.*\.svg$)/;
const targetCSS = /\.css$/;

// exclude CKE regex from mix's default rules
for (let rule of rules) {
    if (rule.test.toString() === targetSVG.toString()) {
        rule.exclude = CKERegex.svg;
    }
    else if (rule.test.toString() === targetFont.toString()) {
        rule.exclude = CKERegex.svg;
    }
    else if (rule.test.toString() === targetCSS.toString()) {
        rule.exclude = CKERegex.css;
    }
}
});
mix.js('resources/js/app.js', 'public/js')
.postCss('resources/css/app.css', 'public/css', [
    //
])
.webpackConfig({
    plugins: [
      new CKEditorWebpackPlugin({
        language: 'it'
      })
   ],
   module: {
    rules: [
        {
            test: /ckeditor5-[^\/\\]+[\/\\].+\.js$/,
            use: [
                {
                    loader: 'babel-loader',
                    options: Config.babel()
                }
            ]
        },
        {
            test: CKERegex.svg,
            use: [ 'raw-loader' ]
        },
        {
            test: CKERegex.css,
            use: [
                {
                    loader: 'sass-loader',
                    options: {
                        singleton: true
                        // injectType: 'singletonStyleTag'
                    }
                },
                {
                    loader: 'postcss-loader',
                    options: CKEStyles.getPostCssConfig({
                        themeImporter: {
                            themePath: require.resolve('@ckeditor/ckeditor5-theme-lark')
                        },
                        minify: true
                    })
                },
            ]
        }
    ]
}
});


// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);
    

