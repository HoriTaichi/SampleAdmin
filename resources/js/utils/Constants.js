export default {
    ROLE:{
        // 権限：10:確認用、20:広告主、30:代理店、40:媒体社、50:管理者
        ADMIN: '50',
        MEDIA: '40',
        AGENCY: '30',
        ADVERTISER: '20',
        VIEWONLY: '10',
        NAMES:{
            '50': '管理者',
            '40': '媒体社',
            '30': '代理店',
            '20': '広告主',
            '10': '確認用'
        }

    },
    ACCOUNT_STATUS:{
        NAMES:{
            '1': '稼働中',
            '2': '停止中',
            '3': '審査中',
            '99': '削除',
        }
    },
    WIDGET_STATUS:{
        NAMES:{
            '1': '稼働中',
            '2': '停止中',
            '3': '審査中',
            '99': '削除',
        }
    },
    AGGREGATE_VALUE:{
        NAMES:{
            'widgetImp': 'Widget Imp',
            'click': 'Click',
            'cv': 'CV',
            'inviewRate': 'Inview率',
        }
    }
}