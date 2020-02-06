<template>
    <div class="mdc-dialog date-dialog"
        role="alertdialog"
        aria-modal="true"
        aria-labelledby="info-dialog-title"
        aria-describedby="info-dialog-content">
        <div class="mdc-dialog__container">
            <div class="mdc-dialog__surface">
                <h2 class="mdc-dialog__title" v-if="locale == 'de'">{{day}}. {{ month }}</h2>
                <h2 class="mdc-dialog__title" v-else>{{ month }} {{ day }}</h2>
                <div class="mdc-dialog__content">
                    <router-link v-for="s in saints" :to="'/saint/'+s.id" :key="s.id">{{ s.name }}</router-link>
                </div>
                <footer class="mdc-dialog__actions">
                    <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="close">
                        <span class="mdc-button__label">Schließen</span>
                    </button>
                </footer>
            </div>
        </div>
        <div class="mdc-dialog__scrim"></div>
    </div>
</template>

<script>
    import {MDCDialog} from '@material/dialog'

    export default {
        data() {
            return {
                dialog: false,
                day: '',
                month: '',
                saints: [],
                locale: 'de'
            }
        },
        mounted() {
            let that = this
            Vue.nextTick(() => {
                that.locale = app.locale
                that.dialog = new MDCDialog($('.date-dialog')[0])
                app.$on('show-date', (day, month, saints) => {
                    that.day = day
                    that.month = month
                    that.saints = saints
                    that.dialog.open()
                })
            })
        }
    }
</script>

<style lang="scss">
    
    .date-dialog {
        .mdc-dialog__content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            a {
                margin-bottom: 8px;
            }
        }
    }

</style>
