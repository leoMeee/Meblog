var webpack = require('webpack');

module.exports = {
    entry: './src/app.jsx',
    output: {
        path: './dist',
        filename: 'app.bundle.js'
    },
    module: {
        loaders: [
            {
                test: /[\.jsx]$/,
                exclude: "./node_modules/",
                loader: 'babel',
                query: {
                    cacheDirectory: true,
                    presets: ['react','es2015']
                }
            },
            {
                test: /[\.js]$/,
                exclude: "./node_modules/",
                loader: 'babel',
                query: {
                    cacheDirectory: true,
                    presets: ['es2015']
                }
            }
        ]
    },
    resolve: {
        extensions: ['', '.js', '.jsx']
    }
};