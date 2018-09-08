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
        extensions: [".js", ".vue", ".json"],
        /* 代替エイリアス構文 */
        alias: {
            // // a list of module name aliases
            '@': __dirname + '/resources/js',
        },
    },
};