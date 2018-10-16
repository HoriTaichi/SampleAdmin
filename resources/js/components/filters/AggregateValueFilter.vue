<script>
    import ChoiceFilter from '@/components/filters/ChoiceFilter'
    export default {
        extends: ChoiceFilter,
        abstract: false,
        data () {
            return {
                title: '集計数値',
                labelList: [
                    {value: 'widgetImp', label: 'widget_imp'},
                    {value: 'ctr', label: 'CTR'},
                    {value: 'inviewRate', label: 'inview率'},
                    {value: 'click', label: 'クリック数'},
                ],
            }
        },
    }
</script>