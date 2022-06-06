const path = require('path');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');

const SpriteLoaderPlugin = require('svg-sprite-loader/plugin');
const bs = require('browser-sync');
const isDev = process.env.NODE_ENV === 'development';
const isProd = !isDev;
// require('./font.config.js');

module.exports = {
  context: path.resolve(__dirname, 'src'),
  mode: 'development',
  entry: {
    main: ['@babel/polyfill', '/js/app.js'],

  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'js/[name].js',
  },
  watchOptions: {
    aggregateTimeout: 800,
    ignored: '**/node_modules',
    poll: 1000,
  },
  plugins: [
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({
      filename: 'css/[name].css',
    }),
    new BrowserSyncPlugin(
      {
        host: 'localhost',
        proxy: 'taxi.test',
        files: [
          '**/*.php',
          '**/*.css',
          {
            match: '**/*.js',
            options: {
              ignored: 'dist/**/*.js',
            },
          },
        ],
        hot: true,

        open: true,
        watch: true,
      },
      {
        reload: false,
      }
    ),
    new CopyWebpackPlugin({
      patterns: [{ from: 'images', to: 'images' }],
    }),
    new SpriteLoaderPlugin({
      plainSprite: true,
      spriteAttrs: {
        fill: '#fff',
        class: 'svg-icon',
      },
    }),
  ],
  module: {
    rules: [
      {
        test: /\.css$/i,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [require('autoprefixer')],
              },
            },
          },
        ],
      },
      {
        test: /svg\/.*\.svg$/,
        use: [
          {
            loader: 'svg-sprite-loader',
            options: {
              extract: true,
            },
          },
        ],
      },
      {
        test: /\.s[ac]ss$/i,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [require('autoprefixer')],
              },
            },
          },
          'sass-loader',
        ],
      },
      {
        test: /\.(png|jpe?g|gif|svg)$/i,
        type: 'asset/resource',
        generator: {
          filename: './images/[name][ext]',
        },
      },
      {
        test: /\.(ttf|woff|woff2)$/,
        type: 'asset/resource',
        generator: {
          filename: './fonts/[name][ext]',
        },
      },
      {
        test: /\.m?js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
    ],
  },
};
