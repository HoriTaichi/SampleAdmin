<script>
    import ChoiceFilter from '@/components/filters/ChoiceFilter'
    export default {
        extends : ChoiceFilter,
        abstract : false,
        data(){
            return {
                title : '集計数値',
                labelList:[
                    {value: 'widgetImp', label: 'Widget Imp'},
                    {value: 'click', label: 'Click'},
                    {value: 'cv', label: 'CV'},
                    {value: 'inviewRate', label: 'Inview率'},
                ]
            }
        }
    }
</script>
<style scoped>
</style>