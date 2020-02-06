<template>
    <div class="container">
        <div class="text-container">
            <h4 class="mdc-typography--headline4 text-center">{{ $t('terms.saints') }}</h4>
            <div class="mdc-chip-set mdc-chip-set--choice char-chips">
                <div class="mdc-chip" tabindex="0" v-for="i in 26" :class="{ 'mdc-chip--selected': currentChar == String.fromCharCode(64+i) }" @click="currentChar = String.fromCharCode(64+i)">
                    <div class="mdc-chip__text">{{ String.fromCharCode(64+i) }}</div>
                </div>
            </div>
        </div>
        <div class="grid">
            <div class="grid-sizer column-4"></div>
            <div class="grid-item grid-item--animating column-1" :style="{ 'animation-delay': ((destroying ? 0 : i)*50)+'ms' }" v-for="(s, i) in saints">
                <div class="mdc-card">
                    <router-link tag="div" :to="'/saint/'+s.id" class="mdc-card__primary-action card--primary">               
                        <h2 class="card--title mdc-typography--headline6">{{ s.name }}</h2>
                        <h3 class="card--subtitle mdc-typography--subtitle2"></h3>
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
                saints: [],
                currentChar: 'A',
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
                this.removeItems(() => {
                    that.saints = []
                    axios.get('/api/saints', { params: { char: that.currentChar } }).then(res => {
                        that.saints = res.data
                        Vue.nextTick(() => {
                            that.initMasonry()
                        })
                    })
                })
            }
        },
        watch: {
            currentChar() {
                this.load()
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

    .char-chips {
        margin-bottom: 20px;
    }

</style>
