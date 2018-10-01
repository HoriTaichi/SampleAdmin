import AccountIndex from '@/pages/account/AccountIndex'
import CheckTagFail from '@/pages/checkTagFail/CheckTagFail'

export default [

    // アカウント
    {
        path: '/account',
        name: 'accountIndex',
        component: AccountIndex,
        props: (route) => {{query: route.query}}

    },
    // タグ落ち確認
    {
        path: '/check-tag-fail',
        name: 'checkTagFail',
        component: CheckTagFail,
        props: (route) => {{query: route.query}}

    }
]

