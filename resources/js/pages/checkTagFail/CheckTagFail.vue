<template lang="pug">
    div(class="ip-transition-report")
        el-card(class="ip-card")
            div(slot="header" class="ip-header")
                h2(class="ip-header-title") 日次/月次 推移レポート
                div(class="ip-header-button-top")
                    //- 集計数値ダイアログ
                    aggregate-value-filter(class="ip-filter-btn" v-model="filter.aggregateValue")
                    //- IS担当者ダイアログ
                    list-filter(class="ip-filter-btn" v-model="filter.isStaffId" name="IS担当者" :list="filter.isStaffs" label="staff_name" list-key="is_staff_id" list-label="staff_name")
                    //- 日次/月次
                    date-unit-filter(class="ip-filter-btn" v-model="filter.dateUnit")
                    //- カレンダー(日次)
                    el-date-picker(class="ip-date-picker" v-model="filter.startDate" placeholder="開始日" v-if="filter.dateUnit === 'daily'")
                    //- カレンダー(月次)
                    el-date-picker(class="ip-date-picker" type="month" v-model="filter.startDate" placeholder="開始月" v-else)
                    //- 集計軸ダイアログ
                    <!--aggregate-axis-filter(v-model="filter.axis")-->
                div(class="ip-header-button-bottom")
                    div(class="ip-header-button-bottom-l")
                        //- 強調表示
                        highlight-filter(class="ip-filter-btn")
                    div(class="ip-header-button-bottom-r")
                        el-button(type="success" size="mini" v-on:click="downloadCSV")
                            i(class="el-icon-download")
                            | &nbsp;
                            | Download
            div(class="ip-main")
                el-table(:data="matchedReports" :cell-class-name="cell" v-loading="isLoading" height="500" size="mini" show-summary border)
                    el-table-column(label="ウィジェットID" prop="widget_id" width="100")
                    el-table-column(label="ウィジェット名" prop="widget_name"  min-width="100")
                    el-table-column(label="担当者" prop="is_staff_id" width="80")
                        template(slot-scope="scope")
                            span() {{scope.row.is_staff_name}}
                    el-table-column(label="ステータス" prop="status" width="80")
                        template(slot-scope="scope")
                            span() {{getWidgetStatus(scope.row.status)}}
                    el-table-column(label="widget imp")
                        template(v-for="(item, index) in reports.dateLists")
                            el-table-column(:label="item.date" prop="logs" width="80")
                                template(slot-scope="scope")
                                    span() {{scope.row.logs[index].value}}
</template>

<script>
    import axios from 'axios'
    import moment from 'moment'
    import CommonPageMixIn from '@/utils/CommonPageMixIn'
    import ReportMixIn from '@/utils/ReportMixIn'
    import AggregateValueFilter from '@/components/filters/AggregateValueFilter'
    import AggregateAxisFilter from '@/components/filters/AggregateAxisFilter'
    import DateUnitFilter from '@/components/filters/DateUnitFilter'
    import ListFilter from '@/components/filters/ListFilter'
    import HighlightFilter from '@/components/filters/HighlightFilter'
    import Constants from '@/utils/Constants'
    export default {
        title: '日次/月次 推移レポート',
        components:{
            AggregateValueFilter,
            AggregateAxisFilter,
            DateUnitFilter,
            ListFilter,
            HighlightFilter,
        },
        mixins: [
            CommonPageMixIn,
            ReportMixIn
        ],
        props: {
            query: Object
        },
        watch:{
            'filter.aggregateValue': function(){
                this.changeQuery()
            },
            'filter.status': function(){
                this.changeQuery()
            },
            'filter.startDate': function(){
                this.changeQuery()
            },
            'filter.isStaffId': function(){
                this.changeQuery()
            },
            'filter.dateUnit': function(){
                this.changeQuery()
            },
        },
        computed:{
            aggregateValueName: function(){
                return Constants.AGGREGATE_VALUE.NAMES[this.filter.aggregateValue]
            },
            adjustReports: function(){
                let details = this.orinalReport.details
                for(let detail of details){
                    for(let key in detail.logs){
                        switch(this.filter.aggregateValue){
                            case 'widgetImp':
                                detail.logs[key].value = detail.logs[key].imp
                                break
                            case 'click':
                                detail.logs[key].value = detail.logs[key].click
                                break
                            case 'ctr':
                                detail.logs[key].value = (detail.logs[key].imp === 0 || detail.logs[key].click === 0) ? 0 : (detail.logs[key].click / detail.logs[key].imp) * 100
                                break
                            case 'inviewRate':
                                detail.logs[key].value = (detail.logs[key].inview === 0) ? 0 : (detail.logs[key].inview / detail.logs[key].imp) * 100
                                break
                        }
                    }
                }
                return details
            },
            matchedReports: function(){
                let app = this
                return this.adjustReports.filter(function(el){
                    let hideData = false
                    if(app.filter.isStaffId !== '' && el.is_staff_id != app.filter.isStaffId){
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
                    dateUnit: 'monthly',
                    startDate: moment().format('YYYY-MM-DD'),
                    aggregateValue: 'widgetImp',
                    status: '',
                    isStaffId: '',
                    isStaffs: [],
                },
                accounts: [],
                loading: false,
                currentModalId: '',
                currentModalComponent: '',
                reports: {
                    dateLists: [],
                    details: [],
                },
                orinalReport: {
                    dateLists: [],
                    details: [],
                }
            }
        },
        created: function () {
            //let query = this.query
            this.getIsStaffs()
            this.changeQuery()
        },
        methods: {
            changeQuery(){
                this.getReports()
            },
            getReports(){
                let app = this
                app.isLoading = true
                axios.get('/api/media-watch-tag-fall', {
                    params:{
                        date: moment(app.filter.startDate).format('YYYY-MM-DD'),
                        dateUnit: app.filter.dateUnit
                    }
                }).then(function(res){
                    app.orinalReport = res.data
                    app.reports.dateLists = res.data.dateLists
                    app.reports.details = res.data.details
                    app.isLoading = false
                }).catch(function(error){
                    app.isLoading = false
                })
            },
            getIsStaffs(){
                let app = this
                axios.get('/api/is-staff/')
                    .then((res) => {
                        app.filter.isStaffs = res.data
                    })
                    .catch((error) => {
                        this.checkAxiosError(error)
                        this.$message.error('IS担当者情報取得失敗しました')
                    })
            },
            getWidgetStatus(status){
                return Constants.WIDGET_STATUS.NAMES[status]
            },
            getMatchReports(){
                // adjustReports
                for(let detail of this.reports.details){
                    for(let key in detail.logs){
                        switch(this.filter.aggregateValue){
                            case 'widgetImp':
                                detail.logs[key].value = detail.logs[key].imp
                                break
                            case 'click':
                                detail.logs[key].value = detail.logs[key].click
                                break
                            case 'ctr':
                                detail.logs[key].value = (detail.logs[key].imp === 0 || detail.logs[key].click === 0) ? 0 : (detail.logs[key].click / detail.logs[key].imp) * 100
                                break
                            case 'inviewRate':
                                detail.logs[key].value = (detail.logs[key].inview === 0) ? 0 : (detail.logs[key].inview / detail.logs[key].imp) * 100
                                break
                        }
                    }
                }
                let app = this
                this.reports.details = this.reports.details.filter(function(el){
                    let hideData = false
                    if(app.filter.isStaffId !== '' && el.is_staff_id != app.filter.isStaffId){
                        hideData = true
                    }
                    if(hideData === false){
                        return true
                    }
                })
            },
            getSummaries(param) {
                const { columns, data } = param;
                const sums = [];
                columns.forEach((column, index) => {
                    if (index === 0) {
                        sums[index] = 'Total Cost';
                        return;
                    }
                    const values = data.map(item => Number(item[column.property]));
                    if (!values.every(value => isNaN(value))) {
                        sums[index] = '$ ' + values.reduce((prev, curr) => {
                            const value = Number(curr);
                            if (!isNaN(value)) {
                                return prev + curr;
                            } else {
                                return prev;
                            }
                        }, 0);
                    } else {
                        sums[index] = 'N/A';
                    }
                });
                return sums;
            },
            downloadCSV () {
                var csv = '\ufeff' + 'ウィジェットID,ウィジェット名,担当者,ステータス'
                var reportheader = ''
                for(let key in this.reports.dateLists){
                    reportheader +=  ',' + this.reports.dateLists[key].date
                }
                csv += reportheader + '\n'
                this.matchedReports.forEach(el => {
                    var line = el['widget_id'] + ',"' + el['widget_name'] + '",' + el['is_staff_id'] + ',' + el['status']
                    var report = ''
                    for(let key in el['logs']){
                        report +=  ',' + el['logs'][key].imp
                    }
                    csv += line + report + '\n'
                })
                let blob = new Blob([csv], { type: 'text/csv' })
                let link = document.createElement('a')
                link.href = window.URL.createObjectURL(blob)
                link.download = 'transition-report.csv'
                link.click()
            },
            cell({row, column, rowIndex, columnIndex}) {
                if(column.property == 'status'){
                    if(row[column.property] == 1){
                        return 'ip-bg-success'
                    }else if(row[column.property] == 2){
                        return 'ip-bg-info'
                    }else if(row[column.property] == 3){
                        return 'ip-bg-warning'
                    }
                }
                if(column.property == 'logs'){
                    if(row[column.property][columnIndex - 4].value < 1000){
                        return 'ip-bg-danger'
                    }
                }
                return ''
            }
        }
    }
</script>

<style lang="scss">
    .no-break .cell {
        word-break: keep-all !important;
        text-overflow: clip !important;
    }
    .fatal {
        color:#f00;
    }
    .warning {
        color:#f90;
    }
    .ip-card{
        paddin: 0 !important;
    }
    .ip-header {
        .ip-header-title {
            margin-top: 0!important;
        }
        .ip-header-button-top {
            margin-bottom: 5px;
        }
        .ip-header-button-bottom {
            .ip-header-button-bottom-l {
                float: left;
            }
            .ip-header-button-bottom-r {
                text-align: right;
            }
        }
    }
    .ip-main {
        padding-left: 0;
        padding-right: 0;
    }
    .ip-filter-btn {
        margin-right: 10px !important;
    }
    .ip-date-picker {
        margin-right: 10px !important;
    }
    .ip-bg-info {
        color: #909399 !important;
        background: #f4f4f5 !important;
    }
    .ip-bg-success {
        color: #67c23a !important;
        background: #f0f9eb !important;
    }
    .ip-bg-warning {
        color: #e6a23c !important;
        background: #fdf6ec !important;
    }
    .ip-bg-danger {
        color: #f56c6c !important;
        background: #fef0f0 !important;
    }
    .el-table {
        font-size: 30% !important;
    }
    td {
        padding: 0 !important;
    }
</style>