<template>
<div class="card bg-light" v-if="show">
    <div class="card-header">
        <slot name="header">{{ header }}</slot>
        <div class="card-header-actions">
            <a v-on:click.prevent="close"
                class="card-header-action btn-close btn"
                title="close"
                style="cursor: pointer;"
                >
                <i class="icon-close"></i>
            </a>
        </div>
    </div>
    <div class="card-body">
        <h4 class="card-title" v-if="title">{{ title }}</h4>
        <slot></slot>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            //
        }
    },
    methods: {
        close() {
            this.$emit('close');
        }
    },
    props: {
        title : String,
        header: String,
        show  : {
            type   : Boolean,
            default: true
        }
    },
}
</script>