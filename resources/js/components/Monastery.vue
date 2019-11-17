<template>
    <div class="container" v-if="monastery">
        <div class="grid">
            <div class="grid-sizer column-4"></div>
            <div class="grid-item grid-item--animating column-1">
                <div class="mdc-card monastery">
                    <div class="card--primary">
                        <h2 class="card--title monastery--name mdc-typography--headline4">{{ monastery.name }}</h2>
                        <p class="mdc-typography--body2" v-html="$t('description.'+monastery.id)"></p>
                        <h3 class="card--title mdc-typography--headline6">{{ $t('terms.basic_reading') }}</h3>
                        <p class="mdc-typography--body2" v-html="$t('description.'+monastery.id+'_basisliteratur')"></p>
                        <h3 class="card--title mdc-typography--headline6">{{ $t('terms.links') }}</h3>
                        <p class="mdc-typography--body2" v-html="$t('description.'+monastery.id+'_links')"></p>
                    </div>
                    <div class="mdc-card__media monastery--image" :style="{ 'background-image': 'url(/image/monastery/'+monastery.id+')' }">
                    </div>
                </div>
            </div>
            <div class="grid-item grid-item--animating column-1" :style="{ 'animation-delay': destroying ? 0 : '100ms' }" v-if="monastery.codices.length > 0">
                <h2 class="mdc-typography--headline4 text-center">{{ monastery.codices.length > 1 ? $t('terms.codices') : $t('terms.codex') }}</h2>
            </div>
            <div class="grid-item grid-item--animating column-4" v-for="(codex, i) in monastery.codices" :style="{ 'animation-delay': destroying ? 0 : ((i+2)*100)+'ms' }" v-if="monastery.codices.length > 0">
                <CodexCard :codex="codex"></CodexCard>
            </div>
        </div>
    </div>
</template>

<script>
    import {MDCRipple} from '@material/ripple'
    import CodexCard from './CodexCard'
    import Masonry from 'masonry-layout'
    import Helpers from '../mixins/Helpers.js'

    export default {
        props: {
            id: {}
        },
        mixins: [ Helpers ],
        components: {
            CodexCard
        },
        data() {
            return {
                monastery: false,
                masonry: false,
                destroying: false
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
                axios.get('/api/monasteries/'+this.id).then(res => {
                    that.monastery = res.data
                    Vue.nextTick(() => {
                        that.initMasonry()
                        const selector = '.mdc-button, .mdc-icon-button, .mdc-card__primary-action'
                        const ripples = [].map.call(document.querySelectorAll(selector), function(el) {
                            return new MDCRipple(el)
                        })
                    })
                })
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
    .monastery {
        &--image {
            height: 200px;
        }
        &--name {
            margin-top: 8px !important;
            margin-bottom: 32px !important;
        }
    }
</style>
