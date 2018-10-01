<template lang="pug">
    div
        div(class="search-field")
            //- 集計数値
            aggregate-value-filter(v-model="filter.aggregateValue")
            //- ステータス
            account-status-filter(v-model="filter.status")
        div(class="heading") アカウント管理
        el-table(:data="matchedReport" v-loading="loading" size="mini" border stripe)
            el-table-column(label="ウィジェットID" prop="widget_id")
            el-table-column(label="ウィジェット名" prop="widget_name")
            el-table-column(label="担当者" prop="staff_id")
            el-table-column(label="ステータス" prop="status")
                template(slot-scope="scope")
                    span() {{getWidgetStatus(scope.row.status)}}
            template(v-for="current in reports.dateLists")
                el-table-column(:label="current.date")
                    el-table-column(:label="aggregateValueName")
                        template(slot-scope="scope")
                            span() {{scope.row.logs[current.date].value}}
</template>

<script>
    import axios from 'axios'
    import AggregateValueFilter from '@/components/filters/AggregateValueFilter'
    import AccountStatusFilter from '@/components/filters/AccountStatusFilter'
    import Constants from '@/utils/Constants'
    export default {
        components:{
            AggregateValueFilter,
            AccountStatusFilter
        },
        props:{
            query: Object,
        },
        watch:{
            'filter.aggregateValue': function(){
                this.changeQuery()
            },
            'filter.status': function(){
                this.changeQuery()
            },
        },
        computed:{

            aggregateValueName: function(){
                return Constants.AGGREGATE_VALUE.NAMES[this.filter.aggregateValue]
            },


            adjustReports: function(){
                let details = this.reports.details
                for(let detail of details){
                    for(let key in detail.logs){
                        switch(this.filter.aggregateValue){

                            case 'widgetImp':
                                detail.logs[key].value = detail.logs[key].imp
                                break
                            case 'click':
                                detail.logs[key].value = detail.logs[key].click
                                break
                            case 'cv':
                                detail.logs[key].value = detail.logs[key].cv
                                break
                            case 'inviewRate':
                                detail.logs[key].value = (detail.logs[key].inview === 0) ? 0 : (detail.logs[key].inview / detail.logs[key].imp) * 100
                                break
                        }

                    }
                }
                return details
            },


            matchedReport: function(){
                let app = this
                return this.adjustReports.filter(function(el){

                    let hideData = false

                    if(app.filter.status !== '' && el.status != app.filter.status){
                        hideData = true
                    }

                    if(hideData === false){
                        return true
                    }

                })
            }
        },
        data() {
            return {
                filter: {
                    aggregateValue: 'widgetImp',
                    status: ''
                },
                accounts: [],
                loading: false,
                currentModalId: '',
                currentModalComponent: '',

                reports: {
                    dateLists: [],
                    details: [],
                },
            }

        },
        created: function () {
            let query = this.query

            this.changeQuery()
        },
        methods: {
            changeQuery(){

                let query = {
                    aggregateValue : this.filter.aggregateValue,
                    status: this.filter.status
                }
                this.$router.replace({path: '/check-tag-fail', query: query})
                //this.getAccounts()
                this.getReports()
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

            getReports(){
                let app = this
                app.loading = true
                axios.get('/api/report-media-for-tag-fail', {
                    params:{
                        date: '2018-01-01',
                    }
                }).then(function(res){
                    app.reports.dateLists = res.data.dateLists
                    app.reports.details = res.data.details
                    app.loading = false
                }).catch(function(error){
                    app.loading = false
                })

            },
            getRoleName(role){
                return Constants.ROLE.NAMES[role]
            },
            getWidgetStatus(status){
                return Constants.WIDGET_STATUS.NAMES[status]
            }
        }
    }
</script>

<style scoped>

</style>