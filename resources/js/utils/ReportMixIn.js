export default {
    data: function () {
        return {
            reportMixInFormatter: new Intl.NumberFormat('ja-JP'),
            reportMixInFormatter2: new Intl.NumberFormat('ja-JP', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }),
            reportMixInFormatter3: new Intl.NumberFormat('ja-JP', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }),
            reportMixInFormatterJPY: new Intl.NumberFormat('ja-JP', {
                style: 'currency',
                currency: 'JPY'
            }),
            reportMixInFormatterJPY2: new Intl.NumberFormat('ja-JP', {
                style: 'currency',
                currency: 'JPY',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }),
            reportMixInFormatterJPY3: new Intl.NumberFormat('ja-JP', {
                style: 'currency',
                currency: 'JPY',
                minimumFractionDigits: 3,
                maximumFractionDigits: 3
            })
        }
    },
    methods: {
        formatNumber: function (value) {
            return this.reportMixInFormatter.format(value)
        },
        formatDecimal2: function(value) {
            if (value === null) {
                return ''
            }
            return this.reportMixInFormatter2.format(value)
        },
        formatDecimal3: function(value) {
            if (value === null) {
                return ''
            }
            return this.reportMixInFormatter3.format(value)
        },
        formatPercent2: function(value) {
            if (value === null) {
                return ''
            }
            return this.reportMixInFormatter.format(value) + '%'
        },
        formatYen: function(value) {
            if (value === null) {
                return ''
            }
            return this.reportMixInFormatterJPY.format(value)
        },
        formatYen2: function(value) {
            if (value === null) {
                return ''
            }
            return this.reportMixInFormatterJPY2.format(value)
        },
        formatYen3: function(value) {
            if (value === null) {
                return ''
            }
            return this.reportMixInFormatterJPY3.format(value)
        },
        elFormatNumber: function (row, column, cellValue, index) {
            return this.formatNumber(cellValue)
        },
        elFormatDecimal2: function (row, column, cellValue, index) {
            return this.formatDecimal2(cellValue)
        },
        elFormatDecimal3: function (row, column, cellValue, index) {
            return this.formatDecimal3(cellValue)
        },
        elFormatPercent2: function (row, column, cellValue, index) {
            return this.formatPercent2(cellValue)
        },
        elFormatYen: function (row, column, cellValue, index) {
            return this.formatYen(cellValue)
        },
        elFormatYen2: function (row, column, cellValue, index) {
            return this.formatYen2(cellValue)
        },
        elFormatYen3: function (row, column, cellValue, index) {
            return this.formatYen3(cellValue)
        }
    }
}