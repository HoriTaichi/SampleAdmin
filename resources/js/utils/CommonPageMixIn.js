import axios from 'axios'

export default {
    data: function () {
        return {
            hasLogoutAction: false,
            innerHeight: window.innerHeight
        }
    },
    mounted () {
        // Update title
        let {title} = this.$options
        if (title) {
            title = typeof title === 'function' ? title.call(this) : title
            document.title = `intra-portal - ${title}`
        }

        // Update innerHeight
        this.$nextTick(() => {
            window.addEventListener('resize', () => {
                this.innerHeight = window.innerHeight
            })
        })

        // Update session

        axios.get('/api/session/')
            .catch((error) => {
                this.checkAxiosError(error)
            })
    },
    methods: {
        checkAxiosError: function (error) {
            if (error.response && error.response.status === 401) {
                this.$message.error('Session error')
                this.logout()
            }
        },
        logout: function () {
            if (this.hasLogoutAction === false) {
                this.hasLogoutAction = true
                // document.getElementById('logout-form').submit()
                window.location.reload()
            }
        }
    },
    computed: {
        mainCardHeight: function () {
            return this.innerHeight
                - 30 // el-header height
                - 20 // e-main padding
                - 20 // el-card padding
        }
    }