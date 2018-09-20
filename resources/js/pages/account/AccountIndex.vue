<template lang="pug">
    div
        modal-component(:component="currentModalComponent" :id="currentModalId" @on-close="closeModal")
        div(class="search-field")
            //- ロール種別
            role-filter(v-model="filter.role")
            //- ステータス
            account-status-filter(v-model="filter.status")
        div(class="heading") アカウント管理
        el-button(type='default', size='mini', @click='showCreate')
            i(class="el-icon-edit") 新規作成
        el-table(:data='accounts', v-loading='loading', size='mini', border='', stripe='')
            el-table-column(fixed='', prop='account_id', sortable='', label='アカウントID', width='150')
                template(slot-scope='scope')
                    a(href='#' @click.prevent='showDetail(scope.row.account_id)') {{scope.row.account_id}}
            el-table-column(prop='account_name', sortable='', label='アカウント名')
            el-table-column(prop='login_id', sortable='', label='ログインID')
            el-table-column(prop='role', sortable='', label='ロール', width='150')
                template(slot-scope='scope')
                    | {{getRoleName(scope.row.role)}}
            el-table-column(prop='status', sortable='', label='ステータス', width='150')
                template(slot-scope='scope')
                    | {{getAccountStatusName(scope.row.status)}}
            el-table-column(prop='created_at', sortable='', label='作成日', width='150')
</template>

<script>
    import axios from 'axios'
    import RoleFilter from '@/components/filters/RoleFilter'
    import AccountStatusFilter from '@/components/filters/AccountStatusFilter'
    import Constants from '@/utils/Constants'
    import ModalComponent from '@/components/common/ModalComponent'
    import AccountCreate from '@/components/modals/account/AccountCreate'
    export default {
        components:{
            ModalComponent,
            RoleFilter,
            AccountStatusFilter
        },
        props:{
            query: Object,
        },
        watch:{
            'filter.role': function(){
                this.changeQuery()
            },
            'filter.status': function(){
                this.changeQuery()
            },
        },
        data() {
          return {
              filter :{
                  role : '',
                  status: ''
              },
              accounts: [],
              loading: false,
              currentModalId: '',
              currentModalComponent: '',
          }
        },
        created: function () {
            let query = this.query

            this.changeQuery()
        },
        methods: {
            changeQuery(){

                let query = {
                    role : this.filter.role,
                    status: this.filter.status
                }
                this.$router.replace({path: '/account', query: query})
                this.getAccounts()
            },
            getAccounts(){
                let app = this
                app.loading = true
                axios.get('/api/accounts', {
                    params:{
                        role: this.filter.role,
                        status: this.filter.status
                    }
                }).then(function(res){
                    app.accounts = res.data
                    app.loading = false
                }).catch(function(error){
                    app.loading = false
                })
            },
            showCreate(){
                this.currentModalId = '',
                this.currentModalComponent = AccountCreate
            },
            closeModal: function(hasChanged){
                this.currentModalId = ''
                this.currentModalComponent = ''
                if(hasChanged === true){
                    this.changeQuery()
                }
            },
            getRoleName(role){
                return Constants.ROLE.NAMES[role]
            },
            getAccountStatusName(status){
                return Constants.ACCOUNT_STATUS.NAMES[status]
            }
        }
    }
</script>

<style scoped>

</style>