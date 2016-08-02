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
                    presets: ['react', 'es2015'],
                    plugins: [["antd"]]
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
            },
            {test: /\.css$/, loader: 'style!css'},
            {
                test: /\.(ttf|eot|svg|woff(2)?)(\?[a-z0-9=&.]+)?$/,
                loader: 'file-loader'
            },
            {test:/\.json$/,loader:'json'}

        ]
    },
    resolve: {
        extensions: ['', '.js', '.jsx']
    }
};