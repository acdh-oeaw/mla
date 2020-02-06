<template>
    <div class="container">
        <div class="calendar">
            <div class="calendar--header">
                <button class="mdc-icon-button material-icons" @click="month == 1 ? month = 12 : month--">chevron_left</button>
                <div class="calendar--month">
                    <h5 class="mdc-typography--headline5">{{ months[month-1] }}</h5>
                </div>
                <button class="mdc-icon-button material-icons" @click="month == 12 ? month = 1 : month++">chevron_right</button>
            </div>
            <div class="calendar--body">
                <div class="calendar--day" v-for="i in dayCount">
                    <span class="mdc-typography--overline calendar--day--number">{{ i }}</span>
                    <router-link tag="div" :to="'/saint/'+saint.id" class="mdc-chip" v-for="saint in getSaintsForDay(i).slice(0,3)" :key="saint.id">
                        <div class="mdc-chip__text">{{ saint.name }}</div>
                    </router-link>
                    <a class="mdc-typography--body2" href="#" @click.prevent="showDate(i)" v-if="getSaintsForDay(i).length > 3">{{ getSaintsForDay(i).length - 3 }} {{ $t('terms.more') }}</a>
                </div>
            </div>
        </div>
        <DateDialog></DateDialog>
    </div>
</template>

<script>
    import moment from 'moment'
    import DateDialog from './DateDialog'

    export default {
        components: { DateDialog },
        data() {
            return {
                month: 1,
                saints: []
            }
        },
        mounted() {
            this.load()
            let that = this
        },
        methods: {
            load() {
                let that = this
                axios.get('/api/saints?month='+this.month).then(res => {
                    that.saints = res.data
                })
            },
            getSaintsForDay(day) {
                let date = day < 10 ? '0'+day+'.' : day+'.'
                date += this.month < 10 ? '0'+this.month+'.' : this.month+'.'
                return this.saints.filter(s => { return s.date.trim() == date })
            },
            showDate(day) {
                app.$emit('show-date', day, this.months[this.month-1], this.getSaintsForDay(day))
            }
        },
        computed: {
            months() {
                moment.locale(i18n.locale ? (i18n.locale == 'de' ? 'de-AT' : i18n.locale) : 'de-AT')
                return moment.months()
            },
            dayCount() {
                return moment(this.months[this.month-1]+' 2020', 'MMMM YYYY').daysInMonth()
            }
        },
        watch: {
            month() {
                this.load()
            }
        }
    }
</script>

<style lang="scss">

    .calendar {
        margin-left: auto;
        margin-right: auto;
        width: 1000px;
        max-width: 100%;
        &--header {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 16px;
        }
        &--month {
            flex-grow: 1;
            text-align: center;
            h5 {
                margin: 0;
            }
        }
        &--body {
           display: flex;
           flex-direction: row;
           align-items: flex-start;
           flex-wrap: wrap;
        }
        &--day {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: calc(100% / 7 + 1px);
            height: 120px;
            margin-left: -1px;
            margin-top: -1px;
            border: 1px solid #E0E0E0;
            padding: 4px;
            box-sizing: border-box;
            background: #fff;
            &--number {
                margin-top: 0;
                line-height: 1.5rem;
            }
            @media screen and (max-width: 1000px) {
                width: calc(100% / 4 + 1px);
            }
            @media screen and (max-width: 800px) {
                width: calc(100% / 2 + 1px);
            }
            a {
                align-self: start;
            }
        }
    }

</style>
