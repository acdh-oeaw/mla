<template>
    <div class="container">
        <div class="text-container">
            <h4 class="text-center mdc-typography--headline4">{{ $t('menu.texts') }}</h4>
            <div class="description mdc-typography--body2" v-html="$t('pages.texts')">
            </div>    
        </div>
    </div>
</template>

<script>
    export default {
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
