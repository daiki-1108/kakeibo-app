const path = require('path');

module.exports = {
    entry: {
        kakeibo: '.asset/js/fuelphp/public/asset/js/kakeibo.jsx',
        kakeibo_category: '.asset/js/fuelphp/public/asset/js/kakeibo_category.jsx',
      },
    devtool: 'source-map',
    mode: 'production',
    performance: {
        hints: false,
        maxEntrypointSize: 512000,
        maxAssetSize: 512000
    },
    output: {
        path: path.resolve(__dirname, 'public/js'),
        filename: '[name].bundle.js',
        publicPath: '/public/js/',
        library: 'ol',
        libraryTarget: 'umd',
        libraryExport: 'default',
    },
    module: {
        rules: [
          {
            test: /\.(js|jsx)$/,
            exclude: /node_modules/,
            use: {
              loader: 'babel-loader',
              options: {
                presets: ['@babel/preset-env', '@babel/preset-react'],
              },
            },
          },
        ],
      },
      resolve: {
        extensions: ['.js', '.jsx'],
      },
};
