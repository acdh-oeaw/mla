<template>
    <div class="mdc-card entry-card">
        <component :is="entry.manuscripta_link ? 'a' : 'div'" :href="entry.manuscripta_link ? entry.manuscripta_link : '#'" target="_blank" class="mdc-card__primary-action">
            <div class="mdc-card__media mdc-card__media--16-9" :style="{ 'background-image': 'url('+imageURL+')' }">
            </div>
            <div class="card--primary">
                <h2 class="card--title mdc-typography mdc-typography--headline6"><component :is="entry.manuscripta_link ? 'a' : 'span'" :href="entry.manuscripta_link" target="_blank">{{ entry.pages }}</component></h2>
            </div>
        </component>
        <div class="mdc-card__actions">
            <router-link tag="button" :to="'/saint/'+saint.id" class="mdc-button mdc-card__action mdc-card__action--button" v-if="linkTo == 'saint'">
                <span class="mdc-button__label" :class="{ 'text-small': saint.name.length > 40 }">{{ saint.name }}</span>
            </router-link>
            <router-link tag="button" :to="'/codex/'+codex.id" class="mdc-button mdc-card__action mdc-card__action--button" v-else>
                <span class="mdc-button__label">{{ $t('monasteries.'+codex.codex.split('-')[0]) }} {{ codex.number }}</span>
            </router-link>
        </div>
    </div>
</template>

<script>
    import {MDCRipple} from '@material/ripple';

    export default {
        props: {
            linkTo: {
                type: String,
                default: 'saint'
            },
            codex: {},
            saint: {},
            entry: {}
        },
        data() {
            return {
            }
        },
        mounted() {
        },
        methods: {
        },
        computed: {
            firstPage() {
                let page = this.entry.pages.split('-')[0];
                let num = page.replace(/[^\d.]/g, '');
                return parseInt(num);
            },
            manuscriptaLink() {
                let pageIndex = parseInt(this.codex.first_page)+this.firstPage*2-1
                let firstPage = this.entry.pages.split('-')[0]
                if(firstPage.includes('r')) pageIndex--
                if(this.codex.codex == 'AT3500-12' && pageIndex > 39) pageIndex--
                else if(this.codex.codex == 'AT9800-24' && pageIndex > 200) pageIndex -= 2
                else if(this.codex.codex == 'AT6000-546' && pageIndex > 36) pageIndex += 4
                if(this.codex.codex == 'AT1000-25' && ['NSr','NSv','NSr-NSv'].includes(this.entry.pages)) {
                    if(this.entry.pages.includes('NSr')) pageIndex = 553
                    else pageIndex = 554
                }
                return 'http://manuscripta.at/diglit/'+this.codex.codex+'/'+pageIndex
            },
            imageURL() {
                let page = this.entry.pages.split('-')[0]
                let pageNumber = this.firstPage
                let side = page.replace(pageNumber, '').trim()
                if(!side) side = 'v'
                if(parseInt(pageNumber) < 10) pageNumber = "00"+pageNumber
                else if(parseInt(pageNumber) < 100) pageNumber = "0"+pageNumber

                return '/image/codex/'+this.codex.id+'/'+page.replace('/\d+/g', '')
            }
        }
    }
</script>

<style lang="scss">

    .entry-card {
        button {
            min-height: 36px;
            height: auto;
            .text-small {
                font-size: 10px;
            }
        }
    }
    
</style>
