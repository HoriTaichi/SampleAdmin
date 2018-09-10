import AccountIndex from '@/pages/account/AccountIndex'

export default [

    // アカウント
    {
        path: '/account',
        name: 'accountIndex',
        component: AccountIndex,
        props: (route) => {{query: route.query}}

    }
]

