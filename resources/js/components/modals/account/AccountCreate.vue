<template lang="pug">
    div
        el-dialog(
            :title="title"
            :visible.sync="visible"
            :before-close="onClose"
        )
            component(
                v-loading="loading"
                v-bind:is="component"
                ref="modalComponent"
                :id="id"
                :data="data"
                @on-success="onSuccess"
                @on-cancel="onCancel"
                @loading="changeLoading"
                @set-modal-title="setModalTitle"
                @set-submit-button-name="setSubmitButtonName"
                @set-cancel-button-name="setCancelButtonName"
            )
            span(class="dialog-footer" slot='footer')
                el-button(@click="cancelChild" :disabled="loading") {{cancelButtonName}}
                el-button(type="primary" @click="submitChild" :disabled="loading") {{submitButtonName}}
</template>
<script>
    export default {
        data() {
            return {
                visible: false,
                loading: false,
                title: '',
                submitButtonName: '保存する',
                cancelButtonName: 'キャンセル',
            };
        },
        props:[
            'id',
            'component',
            'data'
        ],
        watch:{

        },
        methods: {
            setModalTitle: function (title) {
                this.title = title
            },
            setSubmitButtonName: function (name) {
                this.submitButtonName = name
            },
            setCancelButtonName: function (name) {
                this.cancelButtonName = name
            },
            onSuccess: function () {
                this.close(true)
            },
            onCancel: function(){
                this.close(false)
            },
            onClose: function(){
                this.close(false)
            },
            changeLoading: function(loading){
                this.loading = loading
            },
            cancelChild: function(){
                this.$refs.modalComponent.onCancel()
            },
            submitChild: function(){
                this.$refs.modalComponent.onSubmit()
            },
            close: function(hasChanged){
                this.$emit('on-close', hasChanged)
            }
        }
    }
</script>
<style scoped>
</style>