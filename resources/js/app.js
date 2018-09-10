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
import modules from '@/store/index'
import createPersistedState from 'vuex-persistedstate'


require('./bootstrap');

/**
 * プラグイン使用
 */
Vue.use(VueRouter)
Vue.use(Vuex)
Vue.use(Element, {locale})

/**
 *
 */
Vue.component('app', App)


const store = new Vuex.Store({
    modules: modules,
    plugins: [createPersistedState]
})

const app = new Vue({
    el: '#app',
    store: store
});

