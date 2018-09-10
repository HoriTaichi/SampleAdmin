<template lang="pug">
    span
        el-button(@click="showFilter") {{title}} : {{buttonLabel}}
        el-dialog(:title="title", :visible.sync="dialogVisible", @close="cancelFilter")
            el-form()
                template(v-for="(item) of labelList")
                    el-form-item(size="mini")
                        el-radio(v-model="tmpValue", :label="item") {{item.label}}
            span.dialog-footer(slot="footer")
                el-button(@click="cancelFilter") キャンセル
                el-button(@click="submitFilter") 適用
</template>
<script>
    export default {
        abstract: true, // 抽象クラス
        props:{
            value: String
        },
        data() {
            return {
                dialogVisible: false,
                tmpValue :'',
                title: '',
                labelList: []
            };
        },
        computed:{
            buttonLabel: function(){
                let label = ''
                for(let item of this.labelList){
                    if(item.value === this.value){
                        label = item.label
                    }
                }
                return label
            }
        },
        methods: {
            showFilter: function(){
                for(let item of this.labelList){
                    if(item.value === this,value){
                        this,tmpValue = item
                    }
                }
                this.dialogVisible = true
            },
            cancelFilter: function(){
                this.dialogVisible = false
                this.tmpValue = this.value
            },
            submitFilter: function(){
                this.dialogVisible = false
                this.$emit('input', this.tmpValue.value)
                this.$emit('changeValue')
            }
        }
    }
</script>
<style scoped>
</style>