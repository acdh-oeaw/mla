<template>
    <div class="wrapper mdc-typography">
        <header class="mdc-top-app-bar app-bar mdc-top-app-bar--fixed" id="app-bar">
            <div class="mdc-top-app-bar__row">
                <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start" :style="{ 'flex-grow': smallScreen ? 0 : 1 }">
                    <a href="#" class="material-icons mdc-top-app-bar__navigation-icon">menu</a>
                    <router-link tag="span" to="/" class="mdc-top-app-bar__title" v-show="!searchBarOpen" v-html="$t(smallScreen ? 'menu.mla_short' : 'menu.mla_long')"></router-link>
                </section>
                <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end p-r-0 mdc-menu-surface--anchor" role="toolbar">
                    <div class="mdc-text-field mdc-text-field--no-label mdc-text-field--with-trailing-icon" id="search-bar">
                        <input type="text" class="mdc-text-field__input" placeholder="Suchen" v-model="query" @keyup.esc="resetSearch()" @keyup.enter="search()">
                        <i class="material-icons mdc-text-field__icon" tabindex="0" role="button" @click="toggleSearch()">close</i>
                    </div>
                    <div class="mdc-menu mdc-menu-surface" id="search-menu">
                        <ul class="mdc-list" role="menu" aria-orientation="vertical" tabindex="-1">
                            <router-link tag="li" :to="'/saint/'+result.id" class="mdc-list-item" role="menuitem" v-for="result in results" :key="result.id">
                                <span class="mdc-list-item__text">{{ result.Heiliger }}</span>
                            </router-link>
                            <li class="mdc-list-item" role="menuitem" v-if="results.length == 0">
                                <span class="mdc-list-item__text">{{ $t('menu.no_results') }}</span>
                            </li>
                        </ul>
                    </div>
                    <a href="#" class="material-icons mdc-top-app-bar__action-item" id="search-button" aria-label="Suchen" @click.prevent="toggleSearch()">search</a>
                </section>
                <section class="mdc-top-app-bar__section mdc-top-app-bar__section-small mdc-top-app-bar__section--align-end mdc-menu-surface--anchor" role="toolbar">
                    <a href="#" class="mdc-top-app-bar__action-item" aria-label="Language" @click.prevent="localeMenu.open = true">{{ locale.toUpperCase() }}</a>
                    <div class="mdc-menu mdc-menu-surface" id="locale-menu">
                        <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical" tabindex="-1">
                            <li class="mdc-list-item" role="menuitem" @click="setLocale('de')">
                                <span class="mdc-list-item__text">DE</span>
                            </li>
                            <li class="mdc-list-item" role="menuitem" @click="setLocale('en')">
                                <span class="mdc-list-item__text">EN</span>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
        </header>
        <aside class="mdc-drawer mdc-drawer--dismissible mdc-top-app-bar--fixed-adjust mdc-drawer--open">
            <div class="mdc-drawer__content">
                <div class="drawer-image"></div>
                <div class="mdc-list">
                    <router-link to="/monasteries" class="mdc-list-item">
                        <i class="material-icons mdc-list-item__graphic" aria-hidden="true">local_library</i>
                        <span class="mdc-list-item__text">{{ $t("menu.monasteries") }}</span>
                    </router-link>
                    <router-link to="/codices" class="mdc-list-item">
                        <i class="material-icons mdc-list-item__graphic" aria-hidden="true">library_books</i>
                        <span class="mdc-list-item__text">{{ $t("menu.manuscripts") }}</span>
                    </router-link>
                    <router-link to="/saints" class="mdc-list-item">
                        <i class="material-icons mdc-list-item__graphic" aria-hidden="true">account_circle</i>
                        <span class="mdc-list-item__text">{{ $t("menu.saints") }}</span>
                    </router-link>
                    <router-link to="/calendar" class="mdc-list-item">
                        <i class="material-icons mdc-list-item__graphic" aria-hidden="true">event</i>
                        <span class="mdc-list-item__text">{{ $t("menu.calendar") }}</span>
                    </router-link>
                    <router-link to="/decorations" class="mdc-list-item">
                        <i class="material-icons mdc-list-item__graphic" aria-hidden="true">brush</i>
                        <span class="mdc-list-item__text">{{ $t("menu.decorations") }}</span>
                    </router-link>
                    <router-link to="/texts" class="mdc-list-item">
                        <i class="material-icons mdc-list-item__graphic" aria-hidden="true">notes</i>
                        <span class="mdc-list-item__text">{{ $t("menu.texts") }}</span>
                    </router-link>
                    <router-link to="/about" class="mdc-list-item">
                        <i class="material-icons mdc-list-item__graphic" aria-hidden="true">info</i>
                        <span class="mdc-list-item__text">{{ $t("menu.about") }}</span>
                    </router-link>
                </div>
            </div>
        </aside>
        <div class="mdc-drawer-app-content mdc-top-app-bar--fixed-adjust">
            <main class="main-content" id="main-content" :style="{ width: smallScreen ? '100vw' : 'auto' }">
                <router-view></router-view>
            </main>
        </div>
        <InfoDialog></InfoDialog>
    </div>
</template>

<script>   
    import {MDCTopAppBar} from "@material/top-app-bar"
    import {MDCDrawer} from "@material/drawer"
    import {MDCList} from "@material/list"
    import {MDCTextField} from '@material/textfield'
    import {MDCMenu} from '@material/menu'
    import {Corner} from '@material/menu-surface/constants'
    import VueRouter from 'vue-router'
    import Home from './Home'
    import Decorations from './Decorations'
    import Texts from './Texts'
    import Monasteries from './Monasteries'
    import Monastery from './Monastery'
    import Codices from './Codices'
    import Codex from './Codex'
    import Saints from './Saints'
    import Saint from './Saint'
    import Calendar from './Calendar'
    import Viewer from './Viewer'
    import About from './About'
    import InfoDialog from './InfoDialog'
    import Helpers from '../mixins/Helpers.js'
    import _ from 'lodash'

    export default {
        i18n: window.i18n,
        router: new VueRouter({
            routes: [
                { path: '/', component: Home },
                { path: '/decorations', component: Decorations },
                { path: '/texts', component: Texts },
                { path: '/monasteries', component: Monasteries },
                { path: '/monastery/:id', component: Monastery, props: true },
                { path: '/codices', component: Codices },
                { path: '/codex/:id', component: Codex, props: true },
                { path: '/saints', component: Saints },
                { path: '/saint/:id', component: Saint, props: true },
                { path: '/calendar', component: Calendar },
                { path: '/view/:id', component: Viewer, props: true },
                { path: '/view/:id/:page', component: Viewer, props: true },
                { path: '/about', component: About }
            ]
        }),
        components: { InfoDialog },
        mixins: [ Helpers ],
        data() {
            return {
                query: '',
                drawer: false,
                searchMenu: false,
                searchBarOpen: false,
                localeMenu: false,
                locale: i18n.locale,
                smallScreen: false,
                results: [],
                loading: false
            }
        },
        mounted() {
            let that = this
            Vue.nextTick(() => {
                let topAppBar = MDCTopAppBar.attachTo(document.getElementById('app-bar'))
                let list = MDCList.attachTo(document.querySelector('.mdc-list'))
                let textField = new MDCTextField(document.querySelector('.mdc-text-field'))
                that.drawer = MDCDrawer.attachTo(document.querySelector('.mdc-drawer'))
                if($(window).width() < 840) that.smallScreen = true
                that.menu = new MDCMenu(document.querySelector('#search-menu'))
                that.menu.setAnchorCorner(Corner.BOTTOM_LEFT)
                that.menu.listen('MDCMenuSurface:opened', () => {
                    $('#search-bar').addClass('menu-open')
                })
                that.menu.listen('MDCMenuSurface:closed', () => {
                    $('#search-bar').removeClass('menu-open')
                })
                that.localeMenu = new MDCMenu(document.querySelector('#locale-menu'))
                //that.localeMenu.setAnchorCorner(Corner.TOP_RIGHT)
                topAppBar.setScrollTarget(document.getElementById('main-content'))
                topAppBar.listen('MDCTopAppBar:nav', () => {
                    that.drawer.open = !that.drawer.open
                })
                list.wrapFocus = true
                that.initMasonry()
            })
            $(window).on('resize', () => {
                Vue.nextTick(() => {
                    that.initMasonry()
                    if($(window).width() < 840) that.smallScreen = true
                    else that.smallScreen = false
                })
            })
            this.$router.beforeEach((to, from, next) => {
                if(that.smallScreen) that.drawer.open = false
                next()
            })
        },
        methods: {
            toggleSearch() {
                $('#search-bar').toggleClass('show')
                $('#search-button').toggleClass('hide')
                if($('#search-bar').hasClass('show')) {
                    $('#search-bar input').focus()
                    this.searchBarOpen = true
                } else {
                    this.menu.open = false
                    this.query = ''
                    this.searchBarOpen = false
                }
            },
            resetSearch() {
                if(!this.query) this.toggleSearch()
                this.menu.open = false
                this.query = ''
                this.results = []
            },
            search() {
                if(!this.loading) {
                    let that = this
                    if(this.query) {
                        that.loading = true
                        axios.get('/api/search', { params: { query: this.query } }).then(res => {
                            that.results = res.data
                            that.menu.open = true
                            that.loading = false
                        })
                    } else {
                        that.results = []
                        that.menu.open = false
                    }
                }
            },
            setLocale(l) {
                i18n.locale = l
                this.locale = l
            }
        },
        watch: {
            query: _.debounce(function() {
                this.search()                
            }, 500),
            smallScreen() {
                let that = this
                if(this.smallScreen) this.drawer.open = false
                else this.drawer.open = true
                Vue.nextTick(() => {
                    that.initMasonry()
                })
            }
        }
    }
</script>

<style>

    /* https://material.io/develop/web/components/drawers/ */
    body, .wrapper {
        display: flex;
        height: 100vh;
        width: 100vw;
    }

    .mdc-drawer-app-content {
        flex: auto;
        overflow: auto;
        position: relative;
        background-color: #fafafa;
    }

    .main-content {
        overflow: auto;
        height: 100%;
    }

    .app-bar {
        position: absolute;
    }

    #search-button {
        width: 36px;
    }

    .mdc-top-app-bar {
        z-index: 7;
    }

    .mdc-drawer {
        @include mdc-drawer-border-color(rgba(0,0,0,0));
        border-right: 0;
        @include mdc-drawer-width(280px);
        .mdc-list {
            @include mdc-list-item-shape-radius(24px, false);
            @include mdc-list-item-primary-text-ink-color(rgb(32, 33, 36));
            @include mdc-list-item-secondary-text-ink-color(rgb(32, 33, 36));
            @include mdc-list-item-graphic-ink-color(rgb(95, 99, 104));
            .mdc-list-item {
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;
                margin: 0;
                height: 48px;
                padding-left: 24px;
            }
            .mdc-list-item--activated {
                @include mdc-list-item-primary-text-ink-color(#000);
                @include mdc-list-item-secondary-text-ink-color(#000);
                @include mdc-list-item-graphic-ink-color(#000);
            }
        }
    }

    .drawer-image {
        height: 0;
        width: 100%;
        padding-top: 56.25%;
        background-image: url(/img/aside.jpg);
        background-size: cover;
        background-repeat: no-repeat;
    }

    .mdc-top-app-bar__section-small {
        flex-grow: 0;
        padding-right: 16px;
    }

    .mdc-top-app-bar__title {
        cursor: pointer;
    }

    .p-r-0 {
        padding-right: 0;
    }

</style>
