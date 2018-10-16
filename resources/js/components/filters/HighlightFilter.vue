<template lang="pug">
    div
        el-button(class="highlight-filter-button" type="primary" plain @click="showFilter") {{title}} &nbsp;&nbsp;&nbsp; WidgetImps減少率&nbsp;:&nbsp;{{inputForm.reductionRate}}% &nbsp;&nbsp;&nbsp; 対象Widget月間Imps&nbsp;:&nbsp;{{inputForm.montlyImp}}
        el-dialog(:title="title", :visible.sync="dialogVisible", @close="cancelFilter")
            el-form(:model="inputForm" :rules="inputRules" ref="inputForm" label-width="200px")
                el-form-item(label="WidgetImps減少率（％）" prop="reductionRate")
                    el-input(v-model="inputForm.reductionRate" placeholder="Please input")
                el-form-item(label="対象Widget月間Imps" prop="montlyImp")
                    el-input(v-model="inputForm.montlyImp" placeholder="Please input")
            span.dialog-footer(slot="footer")
                el-button(@click="cancelFilter") キャンセル
                el-button(type="primary" @click="submitFilter") 適用
</template>

<script>
    export default {
        data () {
            return {
                title: '強調表示設定',
                dialogVisible: false,
                inputForm: {
                    reductionRate: 10,
                    montlyImp: 5000,
                },
                inputRules: {
                    reductionRate: [
                        { required: true, message: '必須項目です', trigger: 'change' }
                    ],
                    montlyImp: [
                        { required: true, message: '必須項目です', trigger: 'change' }
                    ]
                }
            }
        },
        methods: {
            showFilter: function () {
                this.dialogVisible = true
            },
            cancelFilter: function () {
                this.dialogVisible = false
            },
            submitFilter: function () {
                this.dialogVisible = false
            },
        },
    }
</script>

<style>
    .highlight-filter-button {
        padding-left: 0.8em !important;
    }
</style>