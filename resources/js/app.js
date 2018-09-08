/**
 * 各プラグイン　インポート
 */
import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import locale from 'element-ui/lib/locale/lang/ja'
import App from '@/App.vue'


require('./bootstrap');

/**
 * プラグイン使用
 */
Vue.use(VueRouter)
Vue.use(Vuex)
Vue.use(Element, {locale})

/**
 *
 * @type {CombinedVueInstance<V extends Vue, Object, Object, Object, Record<never, any>>}
 */
Vue.component('app', App)

const app = new Vue({
    el: '#app'
});

