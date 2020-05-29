<template>
    <b-alert
        dismissible
        @dismissed="show = !show"
        :show='show'
        :variant='variant'
        >
        {{ body }}
    </b-alert>
</template>

<script>
export default {
    data() {
        return {
            body   : this.message,
            show   : false,
            variant: this.type
        }
    },
    mounted() {
        if (this.message) {
            this.alert(this.message, this.type);
        }

        window.events.$on('bs-alert', (message, type) => {
            this.alert(message, type || 'danger');
        });
    },
    methods: {
        alert(message, type) {
            this.body    = message;
            this.variant = type;
            this.show    = true;
        }
    },
    props: {
        type: {
            type   : String,
            default: 'danger'
        },
        message: {
            type    : String,
            required: false
        }
    }
}
</script>