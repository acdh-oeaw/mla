<template>
    <div class="mdc-card codex-card">
        <router-link tag="div" class="mdc-card__primary-action" :to="'/codex/'+codex.id">
            <div class="mdc-card__media codex-card--image" :style="{ 'background-image': 'url(/image/codex/'+codex.id+')' }">
            </div>
            <div class="card--primary">
                <h2 class="card--title mdc-typography mdc-typography--headline6">{{ $t('monasteries.'+codex.codex.split('-')[0]) }} {{ codex.codex.split('-')[1] }}</h2>
                <h3 class="card--subtitle mdc-typography mdc-typography--subtitle2">{{ codex.legend_count }} {{ codex.legend_count == 1 ? $t('terms.legend') : $t('terms.legends') }}</h3>
            </div>
        </router-link>
    </div>
</template>

<script>
    import {MDCRipple} from '@material/ripple';

    export default {
        props: {
            codex: {}
        },
        data() {
            return {
            }
        },
        mounted() {
        },
        methods: {
        }
    }
</script>

<style lang="scss">
    .codex-card {
        &--image {
            height: 0;
            padding-top: 135.8%;
        }
    }
</style>
