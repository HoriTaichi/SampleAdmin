<template lang="pug">
    span
        el-button(class="list-filter-button" type="primary" @click="showFilter") {{name}}：{{listSelectedLabel}}
        el-dialog(:title="name", :visible.sync="dialogVisible", @close="cancelFilter")
            el-form()
                el-select(v-model='tmpValue', clearable='', filterable='', :placeholder='placeHolder' :value-key="listKey")
                    el-option(v-for='item in list', :key='item[listKey]', :label='item[listLabel]', :value='item')
            span.dialog-footer(slot="footer")
                el-button(@click="cancelFilter") キャンセル
                el-button(@click="submitFilter") 適用
</template>

<script>
    export default {
        props: [
            'value',
            'name',
            'label',
            'list',
            'listKey',
            'listLabel',
        ],
        data () {
            return {
                dialogVisible: false,
                tmpValue: '',
                placeHolder: this.name + '選択',
            }
        },
        computed: {
            listSelectedLabel: function() {
                for (const item of this.list) {
                    if (item[this.listKey] == this.value) {
                        return item[this.label]
                    }
                }
                return ''
            }
        },
        watch: {
            list: function(newVal, oldVal) {
                if (newVal === oldVal) {
                    return;
                }
                if (oldVal.length === 0) {
                    return;
                }
                for (const item of this.list) {
                    if (item[this.listKey] == this.value) {
                        return;
                    }
                }
                this.tmpValue = null;
                this.$emit('input', '')
                this.$emit('changeValue')
            }
        },
        methods: {
            showFilter: function () {
                for (const item of this.list) {
                    if (item[this.listKey] == this.value) {
                        this.tmpValue = item
                    }
                }
                this.dialogVisible = true
            },
            cancelFilter: function () {
                this.dialogVisible = false
                this.tmpValue = this.value
            },
            submitFilter: function () {
                this.dialogVisible = false
                this.$emit('input', this.tmpValue[this.listKey])
                this.$emit('changeValue')
            },
        },
    }
</script>

<style scoped>
    .el-select {
        width:100%;
    }
    .list-filter-button {
        padding: 0.8em !important;
        font-size: 85% !important;
        width: 12% !important;
    }
</style>