<script>
    import ChoiceFilter from '@/components/filters/ChoiceFilter'
    export default {
        extends: ChoiceFilter,
        abstract: false,
        data () {
            return {
                title: '日次/月次',
                labelList: [
                    {value: 'daily', label: '日次'},
                    {value: 'monthly', label: '月次'},
                ],
            }
        },
    }
</script>