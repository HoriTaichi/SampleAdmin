<template lang="pug">
    el-container()
        el-aside(width="200px")
            side-menu()
        el-container()
            el-header() Header
            el-main() Main
</template>

<script>
    import SideMenu from '@/components/common/SideMenu'
    export default {
        components:{
            SideMenu
        },
        data(){
            return {

            }
        }
    }
</script>

<style scoped>

</style>