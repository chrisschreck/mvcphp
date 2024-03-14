const path = require('path');
const CssPlugin = require('mini-css-extract-plugin');


module.exports = {
    watch: true,
    devtool: "source-map",
    mode: 'development',
    entry: {
        functions: ['@babel/polyfill', './src/js/app.js', './src/css/bootstrapper.scss']
    },
    output: {
        path: path.resolve(__dirname, 'htdocs'),
        filename: './layout/js/app.js',
        publicPath: "/htdocs/",
    },
    module: {
        rules: [{
                test: /\.js$/,
                exclude: /node_modules/,
                include: /src/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        plugins: ['lodash']
                    }
                }
            },
            {
                test: /\.scss$/,
                use: [
                {
                    loader: "style-loader"
                },
                {
                    loader: CssPlugin.loader
                },
                {
                    loader: "css-loader"
                }, 
                { 
                    loader: 'sass-loader'
                }]
            },
            {
                test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$x/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: '[name].[ext]',
                        outputPath: './layout/fonts/'
                    }
                }]
            },
            {
                test: /\.(png|svg|jpg|gif)$/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: '[name].[ext]',
                        outputPath: './media/images'
                    }
                }]
            }
        ]
    },
    plugins: [
        new CssPlugin({
            filename: "./layout/css/app.css",
            chunkFilename: "[id].css"
        })
    ]
}