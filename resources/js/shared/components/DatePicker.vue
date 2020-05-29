<template>
    <div class="input-group">
        <slot name="prepend"></slot>
        <input ref="input" type="text" class='form-control' :placeholder="placeholder" />
        <slot name="append">
            <div class="input-group-append">
                <button type="button" class="btn btn-secondary" v-on:click.prevent="fp.open()">
                    <i :class="icon"></i>
                </button>
            </div>
        </slot>
    </div>
</template>
<script>
import flatpickr from 'flatpickr';

export default {
    computed: {
        valueIsDate() {
            return this.value instanceof Date
                && Object.prototype.toString.call(this.value) === '[object Date]';
        }
    },
    data() {
        return {
            fp: null,
        }
    },
    methods: {
        reFormat(date, format) {
            return flatpickr.formatDate(date, format || this.dateFormat)
        }
    },
    mounted() {
        let options = this.options;
        let value   = flatpickr.parseDate(this.value, this.dateFormat);

        this.fp = flatpickr(this.$refs.input, {
            ...this.$props,
            defaultDate  : this.defaultDate || value,
            time_24hr    : true,
            static       : true,
            onChange: (selectedDates, dateStr, instance) => {
                this.$emit('input', dateStr);
            },
            ...options,
        });

        if (this.valueIsDate) {
            this.$emit('input', this.reFormat(this.value));
        }
    },
    watch: {
        value(value) {
            this.fp.setDate(value);
        },
    },
    props: {
        altFormat: {
            type   : String,
            default: 'd F Y'
        },
        altInput: {
            type   : Boolean,
            default: true
        },
        dateFormat: {
            type   : String,
            default: "Y-m-d H:i:S"
        },
        defaultHour: {
            type   : Number,
            default: 16
        },
        defaultDate: {
            type   : [String, Date],
        },
        enableTime: {
            type   : Boolean,
            default: false
        },
        icon: {
            type   : String,
            default: 'icon-calendar'
        },
        maxDate: {
            type   : [String, Date],
        },
        minDate: {
            type   : [String, Date],
        },
        minuteIncrement: {
            type   : Number,
            default: 1
        },
        mode: {
            type   : String,
            default: 'single'
        },
        options: {
            type   : Object,
            default: () => ({})
        },
        placeholder: {
            type   : String,
            default: 'DD MM YYYY'
        },
        value: {
            type   : [String, Date],
        },
    }
}
</script>