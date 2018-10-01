<script>
    import ChoiceFilter from '@/components/filters/ChoiceFilter'
    export default {
        extends : ChoiceFilter,
        abstract : false,
        data(){
            return {
                title : '合計欄',
                labelList:[
                    {value: 'tagFallSum', label: '落下imp数'},
                    {value: 'tagFallCount', label: '停止数'},
                ]
            }
        }
    }
</script>
<style scoped>
</style>