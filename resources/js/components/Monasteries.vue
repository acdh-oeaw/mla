<template>
    <div class="container">
        <h4 class="mdc-typography--headline4 text-center">{{ $t('terms.monasteries') }}</h4>
        <div class="grid">
            <div class="grid-sizer column-4"></div>
            <div class="grid-item grid-item--animating column-4" :style="{ 'animation-delay': ((destroying ? 0 : i)*100)+'ms' }" v-for="(m, i) in monasteries">
                <div class="mdc-card monastery">
                    <router-link tag="div" class="mdc-card__primary-action" :to="'/monastery/'+m.id">
                        <div class="mdc-card__media mdc-card__media--16-9" :style="{ 'background-image': 'url(/image/monastery/'+m.id+')' }">
                        </div>
                        <div class="card--primary">
                            <h2 class="card--title mdc-typography mdc-typography--headline6">{{ m.name }}</h2>
                            <h3 class="card--subtitle mdc-typography mdc-typography--subtitle2">{{ m.codex_count }} {{ m.codex_count == 1 ? $t('terms.codex') : $t('terms.codices') }}</h3>
                            <h3 class="card--subtitle mdc-typography mdc-typography--subtitle2">{{ m.legend_count }} {{ m.legend_count == 1 ? $t('terms.legend') : $t('terms.legends') }}</h3>
                        </div>
                    </router-link>
                </div> 
            </div>
        </div>
    </div>
</template>

<script>
    import {MDCRipple} from '@material/ripple'
    import Masonry from 'masonry-layout'
    import Helpers from '../mixins/Helpers.js'

    export default {
        mixins: [ Helpers ],
        data() {
            return {
                masonry: false,
                monasteries: [],
                destroying: false
            }
        },
        mounted() {
            let that = this
            this.load()
            Vue.nextTick(() => {
                that.initMasonry()
            })
        },
        methods: {
            load() {
                let that = this
                axios.get('/api/monasteries').then(res => {
                    that.monasteries = res.data
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

</style>
