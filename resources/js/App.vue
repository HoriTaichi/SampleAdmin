<template lang="pug">
    el-container()
        el-aside(width="auto")
            side-menu()
        el-container()
            el-header()
                header-bar()
            el-main() Main
</template>

<script>
    import SideMenu from '@/components/common/SideMenu'
    import HeaderBar from '@/components/common/HeaderBar'
    export default {
        components:{
            SideMenu,
            HeaderBar
        },
        props: {
            accountId: String,
            accountName: String,
            role: String,
        },
        computed:{
            user : function(){
                return {
                    accountId: this.accountId,
                    accountName: this.accountName,
                    role: this.role
                }
            }
        },
        data(){
            return {
            }
        },
        created(){
            this.$store.commit('updateUser', this.user)
        }
    }
</script>

<style scoped>

</style>