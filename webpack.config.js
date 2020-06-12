const path = require('path');

publicPath = "public_html"

module.exports = {
  entry: './App/JavaScript/main.js',
  mode: 'development',
  output: {
    filename: 'main.js',
    path: path.resolve(__dirname, publicPath),
  },
  module: {
    rules: [
      {
        test: /\.s[ac]ss$/,
        use: [
          'style-loader',
          'css-loader',
          'sass-loader'
        ] 
      },
      {
        test: /\.css$/,
        use: [
          'style-loader',
          'css-loader'
        ] 
      },
      {
        test: /\.(woff|woff2|ttf|otf)$/,
        loader: 'file-loader',
        include: [/fonts/],

        options: {
          name: '[name].[ext]',
          outputPath: 'fonts/',
          publicPath: url => '/fonts/' + url
        }
      },
    ]
  },
  optimization:{
    minimize: true
  }
};