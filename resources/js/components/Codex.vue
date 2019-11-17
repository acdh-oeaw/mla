<template>
    <div class="container">
        <div class="mdc-card codex" v-if="codex">
            <div class="card--primary">
                <h2 class="card--title codex--name mdc-typography--headline4"><router-link :to="'/monastery/'+codex.monastery_id">{{ $t('monasteries.'+codex.codex.split('-')[0]) }}</router-link> {{ codex.number }}</h2>
                <div class="mdc-chip-set">
                    <a :href="'http://manuscripta.at/hs_detail.php?ID='+codex.manuscripta_id" target="_blank">
                        <div class="mdc-chip" tabindex="0">
                            <div class="mdc-chip__text">Manuscripta</div>
                            <i class="material-icons mdc-chip__icon mdc-chip__icon--trailing">open_in_new</i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="mdc-card__media codex--image" :style="{ 'background-image': 'url(/image/monastery/'+codex.monastery_id+')' }">
            </div>
        </div>
        <template v-if="entries">
            <h2 class="mdc-typography--headline4 text-center">{{ codex.legend_count }} {{ codex.legend_count == 1 ? $t('terms.legend') : $t('terms.legends') }}</h2>
            <div class="mdc-chip-set mdc-chip-set--choice page-chips">
                <div class="mdc-chip" tabindex="0" v-for="(i, j) in Math.ceil(pageCount/100)" :class="{ 'mdc-chip--selected': j == currentPageIndex }" @click="setCurrentPageIndex(j)">
                    <div class="mdc-chip__text">{{ j == 0 ? 'Seite ' : '' }}{{ i*100-(j == 0 ? 99 : 100) }} - {{ i*100 }}</div>
                </div>
            </div>
        </template>
        <div class="grid">
            <div class="grid-sizer column-4"></div>
            <div class="grid-item column-4 grid-item--animating" :style="{ 'animation-delay': ((destroying ? 0 : i)*100)+'ms' }" v-for="(entry, i) in filteredEntries">
                <EntryCard :entry="entry" :codex="codex" :saint="entry.saint"></EntryCard>
            </div>
        </div>
    </div>
</template>

<script>
    import {MDCRipple} from '@material/ripple'
    import {MDCChipSet} from '@material/chips'
    import Helpers from '../mixins/Helpers.js'
    import EntryCard from './EntryCard'

    export default {
        props: {
            id: {}
        },
        mixins: [ Helpers ],
        components: {
            EntryCard
        },
        data() {
            return {
                codex: false,
                masonry: false,
                destroying: false,
                entries: [],
                filteredEntries: [],
                currentPageIndex: 0
            }
        },
        mounted() {
            let that = this
            this.initMasonry()
            this.load()
        },
        methods: {
            load() {
                let that = this
                axios.get('/api/codices/'+this.id).then(res => {
                    that.codex = res.data
                    Vue.nextTick(() => {
                        that.initMasonry()
                        const selector = '.mdc-button, .mdc-icon-button, .mdc-card__primary-action'
                        const ripples = [].map.call(document.querySelectorAll(selector), function(el) {
                            return new MDCRipple(el)
                        })
                    })
                })
                axios.get('/api/entries', { params: { codexId: this.id } }).then(res => {
                    that.entries = res.data
                    that.setCurrentPageIndex(0)
                    Vue.nextTick(() => {
                        that.initMasonry()
                        const selector = '.mdc-button, .mdc-icon-button, .mdc-card__primary-action'
                        const ripples = [].map.call(document.querySelectorAll(selector), function(el) {
                            return new MDCRipple(el)
                        })
                        const chipSetEl = document.querySelector('.mdc-chip-set');
                        const chipSet = new MDCChipSet(chipSetEl);
                    })
                })
            },
            setCurrentPageIndex(i) {
                let that = this
                this.removeItems(() => {
                    that.filteredEntries = []
                    Vue.nextTick(() => {
                        that.currentPageIndex = i
                        that.filteredEntries = that.getFilteredEntries()
                        Vue.nextTick(() => {
                            that.initMasonry()
                        })
                    })
                })
            },
            getFilteredEntries() {
                let minPage = this.currentPageIndex*100
                let maxPage = (this.currentPageIndex+1)*100
                let filtered = this.entries.filter(e => {
                    let liesBetween = false
                    let matches = e.pages.match(/\d+/g)
                    if(matches) {
                        matches.forEach(m => {
                            if(minPage <= parseInt(m) && parseInt(m) <= maxPage) liesBetween = true
                        })
                    }
                    return liesBetween
                })
                filtered.sort((a, b) => {
                    let pageA = 0
                    let pageB = 0
                    if(/\d+/.test(a.pages)) {
                        let match = a.pages.match(/\d+[rv]*/g)[0]
                        pageA = parseInt(match)
                        if(match.includes('v')) pageA += .5
                    }
                    if(/\d+/.test(b.pages)) {
                        let match = a.pages.match(/\d+[rv]*/g)[0]
                        pageB = parseInt(match)
                        if(match.includes('v')) pageB += .5
                    }
                    return pageA - pageB
                })
                return filtered
            } 
        },
        computed: {
            pageCount() {
                let lastPage = 0
                this.entries.forEach(e => {
                    let matches = e.pages.match(/\d+/g)
                    if(matches) {
                        matches.forEach(m => {
                            if(parseInt(m) > lastPage) lastPage = parseInt(m)
                        })
                    }
                })
                return lastPage
            }
        },
        beforeRouteLeave(to, from, next) {
            this.removeItems(() => {
                next()
            })
        }
    }
</script>

<style lang="scss">
    .codex {
        &--image {
            height: 200px;
            padding-top: 0;
        }
        &--name {
            margin-top: 8px !important;
            margin-bottom: 8px !important;
        }
        .mdc-chip-set {
            padding-left: 0;
            .mdc-chip:first-child {
                margin-left: 0;
            }
            a {
                text-decoration: none !important;
            }
        }
    }
    .page-chips {
        justify-content: center;
        margin-bottom: 20px;
    }
</style>
