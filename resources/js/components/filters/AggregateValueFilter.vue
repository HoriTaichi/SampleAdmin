<script>
    import ChoiceFilter from '@/components/filters/ChoiceFilter'
    export default {
        extends : ChoiceFilter,
        abstract : false,
        data(){
            return {
                title : 'ロール',
                labelList:[
                    {value: '', label: 'すべて'},
                    {value: '50', label: 'Admin'},
                    {value: '40', label: '媒体社'},
                    {value: '30', label: '代理店'},
                    {value: '20', label: '広告主'},
                    {value: '10', label: '確認用'},
                ]
            }
        }
    }
</script>
<style scoped>
</style>