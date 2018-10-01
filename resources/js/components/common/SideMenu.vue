<template lang="pug">
    el-menu.el-menu-vertical-demo(:default-openeds="['3']", :collapse='isCollapse')
        el-menu-item(index='2', v-show='!isCollapse', v-on:click='clickArrowLift')
            i.el-icon-d-arrow-left
        el-menu-item(index='2', v-show='isCollapse', v-on:click='clickArrowRight')
            i.el-icon-d-arrow-right
        el-submenu(index='1')
            template(slot='title')
                i.el-icon-menu
                span(slot='title') メニュー
            el-menu-item(index='1-1', @click="$router.push({name: 'campaignIndex'})") キャンペーン
            el-menu-item(index='1-2', @click="$router.push({name: 'testPatternIndex'})") テストパターン
            el-menu-item(index='1-3', @click="$router.push({name: 'lpPatternIndex'})") LPパターン
            el-menu-item(index='1-4', @click="$router.push({name: 'daily'})") 日次レポート
        el-submenu(index='3')
            template(slot='title')
                i.el-icon-menu
                span(slot='title') 管理者用メニュー
            el-menu-item(index='3-1', @click="$router.push({name: 'accountIndex'})") アカウント管理
            el-menu-item(index='3-2', @click="$router.push({name: 'checkTagFail'})") タグ落ち確認
</template>
<script>
    export default {
        data() {
            return {
                isCollapse: false,
                auto: 'auto'
            };
        },
        methods: {

            clickSideMenu: function(path){
                location.href = path
            },

            clickArrowLift: function(){
                this.isCollapse = true;
                this.auto = 'auto';
            },
            clickArrowRight: function(){
                this.isCollapse = false;
                this.auto = '200px';
            }
        }
    }
</script>
<style scoped>
    .isCollapse{
        overflow:visible
    }
    .el-menu-vertical-demo:not(.el-menu--collapse) {
        width: 200px;
        min-height: 400px;
    }
</style>