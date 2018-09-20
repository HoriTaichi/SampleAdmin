export default {

    /**
     * API実行した結果、エラーだった場合はこの処理が呼ばれる
     */
    methods:{
        bindAxiosError: function(error, errors){
            if(error.response){
                // ステータスコードチェック
                if(error.response.status === 401){
                    // 権限エラー
                    this.$message.error('権限エラー')
                }else if(error.response.status === 500){
                    // システムエラー
                    this.$message.error('システムエラー')
                }else{
                    if(error.response.data.invalidParams){
                        for(let invalidParam of error.response.data.invalidParams){
                            let name = invalidParam.name
                            let reasons = invalidParam.reasons

                            // １項目に複数のエラーメッセージがあった場合、最後のエラーメッセージを表示するようにする
                            for(let reason of reasons){
                                errors[name] = reason
                            }
                        }
                    }
                    this.$message.error(error.response.data.title)
                }
            }else{
                this.$message.error('Connection　Error!')
            }

        }
    }
}