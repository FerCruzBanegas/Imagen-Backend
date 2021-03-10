const mix = require('laravel-mix');
require('laravel-mix-alias');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
// const isDevelopment = process.env.NODE_ENV === 'development'

mix.alias({
    '@': '/resources/js'
});

mix.webpackConfig({
    // plugins: [
   //      new MiniCssExtractPlugin({
   //        filename: isDevelopment ? '[name].css' : '[name].[hash].css',
   //        chunkFilename: isDevelopment ? '[id].css' : '[id].[hash].css'
   //      })
   //    ],
      module: {
      rules: [
        {
          test: /\.s?css$/,
          use: [
            {
              loader: 'css-loader',
              options: {
                  sourceMap: true
              }
            },
            {
              loader: 'sass-loader',
              options: {
                  sourceMap: true
              }
            }
          ]
        }
      ]
    }
  })
    .js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css');