<template lang="pug">
    el-row.row-bg(type='flex')
        div(style='text-overflow:ellipsis;white-space:nowrap;width:100%;overflow:hidden;text-align:right')
            | {{$store.getters.getRoleName}} | {{user.accountName}} &nbsp;&nbsp;
        div
            el-dropdown
                i.el-icon-setting(style='margin-right: 15px')
                el-dropdown-menu(slot='dropdown')
                    el-dropdown-item
                        a(href='/logout') ログアウト
</template>
<script>
    export default {
        data() {
            return {
                user: this.$store.state.userStore

            };
        },
        methods: {
        }
    }
</script>
<style scoped>
</style>