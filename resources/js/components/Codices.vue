<template>
    <div class="container">
        <div class="text-container">
            <h4 class="mdc-typography--headline4 text-center">{{ $t('terms.codices') }}</h4>
            <div class="description mdc-typography--body2" v-html="$t('pages.codices')"></div>
        </div>
        <div class="grid">
            <div class="grid-sizer column-4 column-2--small"></div>
            <div class="grid-item grid-item--animating column-4 column-2--small" :style="{ 'animation-delay': ((destroying ? 0 : i)*100)+'ms' }" v-for="(c, i) in codices">
                <CodexCard :codex="c"></CodexCard>
            </div>
        </div>
    </div>
</template>

<script>
    import {MDCRipple} from '@material/ripple'
    import Masonry from 'masonry-layout'
    import Helpers from '../mixins/Helpers.js'
    import CodexCard from './CodexCard'

    export default {
        components: { CodexCard },
        mixins: [ Helpers ],
        data() {
            return {
                masonry: false,
                codices: [],
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
                axios.get('/api/codices').then(res => {
                    res.data.sort((a, b) => {
                        if(a.codex > b.codex) return 1
                        else if(a.codex < b.codex) return -1
                        return 0
                    })
                    that.codices = res.data
                    Vue.nextTick(() => {
                        that.initMasonry()
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
