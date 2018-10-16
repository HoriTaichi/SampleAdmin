<script>
    import ChoiceFilter from '@/components/filters/ChoiceFilter'
    export default {
        extends: ChoiceFilter,
        abstract: false,
        data () {
            return {
                title: '集計軸',
                labelList: [
                    {value: 'widget', label: 'ウィジェット'},
                    {value: 'campaign', label: 'キャンペーン'},
                ],
            }
        },
    }
</script>