<template lang="pug">
    div
        el-form(label-width="120px")
            el-form-item(label="アカウント名" :rules="[{required: true}]" :error="errors.accountName")
                el-input(v-model="form.accountName")
            el-form-item(label="ログインID" :rules="[{required: true}]"  :error="errors.loginId")
                el-input(v-model="form.loginId")
            el-form-item(label="パスワード" :rules="[{required: true}]"  :error="errors.password")
                el-input(v-model="form.password" type="password")
            el-form-item(label="ロール" :rules="[{required: true}]" :error="errors.role")
                el-radio-group(v-model="form.role")
                    el-radio(label="50") Admin
                    el-radio(label="40") 媒体社
                    el-radio(label="30") 代理店
                    el-radio(label="20") 広告主
                    el-radio(label="10") 確認用
            el-form-item(label="ステータス" :rules="[{required: true}]" :error="errors.status")
                el-radio-group(v-model="form.status")
                    el-radio(label="1") 稼働中
                    el-radio(label="2") 停止中
                    el-radio(label="3") 審査中
</template>
<script>
    import AxiosMixIn from '@/mixins/AxiosMixIn'
    export default {
        mixins: [
            AxiosMixIn
        ],
        data() {
            return {
                visible: false,
                loading: false,
                submitButtonName: '保存する',
                cancelButtonName: 'キャンセル',
                form:{
                    accountName: '',
                    loginId: '',
                    password:'',
                    role: '',
                    status:'',
                },
                errors:{
                    accountName: '',
                    loginId: '',
                    password:'',
                    role: '',
                    status:'',
                }

            };
        },
        props:[
            'id',
            'component',
            'data'
        ],
        watch:{

        },
        created() {
            this.$emit('set-modal-title', 'アカウント新規作成')
        },
        methods: {
            resetErrors: function(){
                for(let error in this.errors){
                    this.errors[error] = ''
                }
            },
            onSubmit: function(){
                let app = this
                app.resetErrors()
                app.loading = true
                axios.post('/api/accounts', {
                    accountName: this.form.accountName,
                    loginId: this.form.loginId,
                    password: this.form.password,
                    role: this.form.role,
                    status: this.form.status
                }).then(function(){
                    app.$message.success('保存しました。')
                    app.loading = false
                    app.$emit('on-success')
                }).catch(function(error){
                    app.bindAxiosError(error, app.errors)
                    app.loading = false
                })
            },
            onCancel: function(){
                this.$emit('on-cancel')
            }

        }
    }
</script>
<style scoped>
</style>