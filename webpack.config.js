module.exports = {


    // モジュール要求を解決するためのオプション
    // (ローダーへの解決には適用されない)
    resolve: {
        // // モジュールを探すディレクトリ
        // modules: [
        //     // "node_modules",
        //     // path.resolve(__dirname, "app")
        // ],
        // 使用される拡張子
        extensions: ['.js', '.vue', '.json', '.ts', '.tvue'],
        /* 代替エイリアス構文 */
        alias: {
            // // a list of module name aliases
            'vue$': 'vue/dist/vue.esm.js',
            '@': __dirname + '/resources/js',
        },
    },
    module: {
        rules:[
            {
                test: /\.tvue$/,
                exclude: [
                    /node_modules/,
                    /vendor/,
                    /public/,
                ],
                loader: 'vue-loader',
                options: {
                    loaders: {
                        'scss': 'vue-style-loader!css-loader!sass-loader',
                        'sass': 'vue-style-loader!css-loader!sass-loader?indentedSyntax',
                    }
                },
            },
        ]
    }
};