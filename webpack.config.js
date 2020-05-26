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
    ]
  },
  optimization:{
    minimize: true
  }
};