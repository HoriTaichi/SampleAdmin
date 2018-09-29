import Vue from 'vue'

import DocCustomize from './DocCustomize.tvue'
import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import locale from 'element-ui/lib/locale/lang/ja'
import VueRouter from 'vue-router'
import routes from './routes/doc_index.js'

/**
 * Tip非表示
 * @type {boolean}
 */
Vue.config.productionTip = false

/**
 * プラグイン使用
 */
Vue.use(Element, {locale})
Vue.use(VueRouter)

/**
 *
 */
Vue.component('docCustomize', DocCustomize)


const router = new VueRouter({
    mode:'hash',
    routes: routes
})

const doc = new Vue({
    el: '#app-doc',
    router
});