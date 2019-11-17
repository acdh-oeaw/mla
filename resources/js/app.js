/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

import Vue from 'vue'
import VueRouter from 'vue-router'
import VueI18n from 'vue-i18n'
import Root from './components/Root'
import * as messages from './i18n.json'
import Masonry from 'masonry-layout'
import Cookie from 'js-cookie'

let locale = Cookie.get('locale')
if(!locale) locale = 'de'

window.Vue = Vue
window.i18n = new VueI18n({ locale, messages: messages.default })
window.Masonry = Masonry

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

/*const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
*/
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueRouter)
Vue.use(VueI18n)

const app = new Vue({
    i18n,
    template: '<Root></Root>',
    el: '#app',
    components: { Root },
    data() {
        return {
            locale
        }
    }
})

window.app = app
