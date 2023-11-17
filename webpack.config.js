const path = require('path');

module.exports = {
    entry: {
        kakeibo: './public/assets/js/my-app/src/kakeibo1.jsx',
        kakeibo_category: './public/assets/js/my-app/src/kakeibo_category.jsx',
      },
    devtool: 'source-map',
    mode: 'production',
    performance: {
        hints: false,
        maxEntrypointSize: 512000,
        maxAssetSize: 512000
    },
    output: {
        path: path.resolve(__dirname, 'public', 'assets', 'js'),
        filename: '[name].bundle.js',
        publicPath: '/public/assets/js/',
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
