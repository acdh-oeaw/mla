<template>
    <div class="container">
        <div class="grid">
            <div class="grid-sizer column-4"></div>
            <div class="grid-item column-1 grid-item--animating">
                <div class="mdc-card saint" v-if="saint">
                    <div class="card--primary">
                        <h2 class="card--title saint--name mdc-typography--headline4">{{ saint.name }}</h2>
                        <p class="mdc-typography--body2">{{ $t('terms.calendar_day') }}: {{ saint.date }}</p>
                    </div>
                    <div class="card--primary">
                        <h3 class="card--title saint--name mdc-typography--headline6">{{ saint.heading }}</h3>
                        <a href="#" @click.prevent="showInfo('incexpl')" class="mdc-typography--overline">{{ $t('terms.incipit') }} <i class="material-icons">info_outline</i></a>
                        <p class="mdc-typography--body1 saint--incipit" v-html="decode(saint.incipit)"></p>
                        <a href="#" @click.prevent="showInfo('incexpl')" class="mdc-typography--overline">{{ $t('terms.explicit') }} <i class="material-icons">info_outline</i></a>
                        <p class="mdc-typography--body1 saint--explicit" v-html="decode(saint.explicit)"></p>
                    </div>
                    <div class="card--primary" v-if="saint.comments && saint.comments.trim().length > 0">
                        <h3 class="card--title mdc-typography--headline6">{{ $t('terms.comments') }} <a href="#" @click.prevent="showInfo('comments')"><i class="material-icons">info_outline</i></a></h3>
                        <p v-html="decode(saint.comments)"></p>
                    </div>
                    <div class="card--primary" v-if="saint.bhl || saint.printed_editions">
                        <h3 class="card--title mdc-typography--headline6">{{ $t('terms.references') }}</h3>
                        <div class="saint--references">
                            <div class="saint--reference" v-if="saint.bhl">
                                <a href="#" @click.prevent="showInfo('bhl')" class="mdc-typography--overline">{{ $t('terms.bhl') }} <i class="material-icons">info_outline</i></a>
                                <p class="mdc-typography--body1 saint--explicit" v-html="decode(saint.bhl)"></p>
                            </div>
                            <div class="saint--reference" v-if="saint.printed_editions">
                                <a href="#" @click.prevent="showInfo('printed_editions')" class="mdc-typography--overline">{{ $t('terms.printed_editions') }} <i class="material-icons">info_outline</i></a>
                                <p class="mdc-typography--body1 saint--explicit" v-html="decode(saint.printed_editions)"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-item grid-item--animating column-1" :style="{ 'animation-delay': destroying ? 0 : '100ms' }" v-if="textualWitnesses.length > 0">
                <h2 class="mdc-typography--headline4 text-center">{{ textualWitnesses.length > 1 ? $t('terms.textual_witnesses') : $t('terms.textual_witness') }}</h2>
            </div>
            <div class="grid-item grid-item--animating column-4" v-for="(entry, i) in textualWitnesses" :style="{ 'animation-delay': destroying ? 0 : ((i+2)*100)+'ms' }" v-if="textualWitnesses.length > 0">
                <EntryCard :entry="entry" :codex="entry.codex" :saint="saint" linkTo="codex"></EntryCard>
            </div>
        </div>
    </div>
</template>

<script>
    import {MDCRipple} from '@material/ripple'
    import EntryCard from './EntryCard'
    import Helpers from '../mixins/Helpers.js'

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
                saint: false,
                masonry: false,
                destroying: false,
                textualWitnesses: []
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
                axios.get('/api/saints/'+this.id).then(res => {
                    that.saint = res.data
                    Vue.nextTick(() => {
                        that.initMasonry()
                        const selector = '.mdc-button, .mdc-icon-button, .mdc-card__primary-action'
                        const ripples = [].map.call(document.querySelectorAll(selector), function(el) {
                            return new MDCRipple(el)
                        })
                    })
                })
                axios.get('/api/entries', { params: { saintId: this.id } }).then(res => {
                    that.textualWitnesses = res.data
                    Vue.nextTick(() => {
                        that.initMasonry()
                        const selector = '.mdc-button, .mdc-icon-button, .mdc-card__primary-action'
                        const ripples = [].map.call(document.querySelectorAll(selector), function(el) {
                            return new MDCRipple(el)
                        })
                    })
                })
            },
            showInfo(term) {
                app.$emit('define', term)
            },
            decode(str) {
                return unescape(str)
            }
        },
        watch: {
            id() {
                this.load()
                window.scrollTo(0, 0)
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
    .saint {
        &--image {
            height: 200px;
        }
        &--name {
            margin-top: 8px !important;
            margin-bottom: 16px !important;
        }
        .mdc-typography--overline, .mdc-typography--headline6 {
            display: flex;
            flex-direction: row;
            align-items: center;
            a {
                font-size: 1.5rem;
                margin-left: 5px;
            }
            i {
                font-size: 1rem;
            }
        }
        &--incipit, &--explicit {
            margin-top: 0;
        }
        &--references {
            display: flex;
            flex-direction: row;
        }
        &--reference {
            &:not(:first-child) {
                margin-left: 20px;
            }
        }
        .card--primary {
            &:not(:first-child) {
                border-top: 1px solid #eeeeee;
            }
        }
    }
</style>
