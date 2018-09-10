<script>
    import ChoiceFilter from '@/components/filters/ChoiceFilter'
    export default {
        extends : ChoiceFilter,
        abstract : false,
        data(){
            return {
                title : 'ステータス',
                labelList:[
                    // 'ステータス：1: 稼働中、2: 停止中、3: 審査中、99:削除')
                    {value: '', label: 'すべて'},
                    {value: '1', label: '稼働中'},
                    {value: '2', label: '停止中'},
                    {value: '3', label: '審査中'},
                    {value: '99', label: '削除'},
                ]
            }
        }
    }
</script>
<style scoped>
</style>