<template>
    <div class="mdc-dialog info-dialog"
        role="alertdialog"
        aria-modal="true"
        aria-labelledby="info-dialog-title"
        aria-describedby="info-dialog-content">
        <div class="mdc-dialog__container">
            <div class="mdc-dialog__surface">
                <h2 class="mdc-dialog__title" id="my-dialog-title" v-if="term" v-html="$t('terms.'+term)"></h2>
                <div class="mdc-dialog__content" id="my-dialog-content" v-if="term" v-html="$t('definitions.'+term)"></div>
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
                term: ''
            }
        },
        mounted() {
            let that = this
            Vue.nextTick(() => {
                that.dialog = new MDCDialog($('.info-dialog')[0])
                app.$on('define', term => {
                    that.term = term
                    that.dialog.open()
                })
            })
        }
    }
</script>
