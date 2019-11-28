<template>
    <div class="container">
        <div class="text-container">
            <h4 class="text-center mdc-typography--headline4">{{ $t('about.project_team') }}</h4>
            <table class="team">
                <tr>
                    <td class="mdc-typography--caption">{{ $t('about.project_leader') }}</td>
                    <td>o.Univ.-Prof. Dr. Christina Lutter</td>
                </tr>
                <tr>
                    <td class="mdc-typography--caption">{{ $t('about.concept') }}</td>
                    <td>Dr. Martin Haltrich</td>
                </tr>
                <tr>
                    <td class="mdc-typography--caption">{{ $t('about.development') }}</td>
                    <td>Max Theisen</td>
                </tr>
                <tr>
                    <td class="mdc-typography--caption">{{ $t('about.content') }}</td>
                    <td>Dr. Peter Gretzel, Dr. Diarmuid Ó Riain, Dr. Susanne Rischpler</td>
                </tr>
                <tr>
                    <td class="mdc-typography--caption">{{ $t('about.digitization') }}</td>
                    <td>Dr. Martin Haltrich, Michael Fleischmann</td>
                </tr>
            </table>
            <h4 class="text-center mdc-typography--headline6">{{ $t('about.partners') }}</h4>
            <div class="partners">
                <div class="partner">
                    <a href="https://www.stiftadmont.at/" target="_blank"><img src="/img/admont.png"></a>
                </div>
                <div class="partner">
                    <a href="https://www.stift-heiligenkreuz.org/" target="_blank"><img src="/img/heiligenkreuz.jpg"></a>
                </div>
                <div class="partner">
                    <a href="https://www.cisto.at/stift/" target="_blank">Stift Lilienfeld</a>
                </div>
                <div class="partner">
                    <a href="https://www.stift-klosterneuburg.at/" target="_blank"><img src="/img/klosterneuburg.png"></a>
                </div>
                <div class="partner">
                    <a href="http://www.stiftmelk.at/" target="_blank"><img src="/img/melk.jpg"></a>
                </div>
                <div class="partner">
                    <a href="http://www.stift-zwettl.at/" target="_blank"><img src="/img/zwettl.jpg"></a>
                </div>
                <div class="partner">
                    <a href="https://www.oeaw.ac.at/" target="_blank"><img src="/img/oeaw.png"></a>
                </div>
                <div class="partner">
                    <a href="https://www.univie.ac.at/" target="_blank"><img src="/img/uniwien.png"></a>
                </div>
                <div class="partner">
                    <a href="https://www.fwf.ac.at/" target="_blank"><img src="/img/fwf.png"></a>
                </div>
            </div>
            <h4 class="text-center mdc-typography--headline6">{{ $t('about.funding') }}</h4>
            <div class="text-center"><a href="https://viscom.ac.at" target="_blank"><img src="/img/viscom.jpg"></a></div>
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

<style lang="scss">
    .team {
        td {
            padding: 8px;
            &:first-child {
                text-align: right;
            }
        }
    }
    .partners {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        .partner {
            width: 100px;
            height: 100px;
            margin: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            img {
                max-width: 100px;
                max-height: 100px;
            }
        }
    }
</style>
