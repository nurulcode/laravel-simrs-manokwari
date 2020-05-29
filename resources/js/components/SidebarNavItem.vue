<template>
    <li :class="itemClass" v-on:click="hideMobile">
        <a :class="linkClass" :href="menu.link" v-on:click="onClick">
            <i :class="iconClass"></i> <div class="flex-grow-1" v-html="formatedText"></div>
        </a>
        <ul v-if="isDropdown" class="nav-dropdown-items">
            <template v-for="(item, index) in childs">
                <sidebar-nav-item
                    :menu="item"
                    :key="index"
                    :highlight="highlight"
                    v-on:active="is_open = true"
                    >

                </sidebar-nav-item>
            </template>
        </ul>
    </li>
</template>

<script>
export default {
    name: 'sidebar-nav-item',
    computed: {
        isDropdown() {
            return !!this.menu.childs;
        },
        childs() {
            return this.menu.childs
        },
        itemClass() {
            return [
                {'nav-item'     : true},
                {'open'         : this.is_open},
                {'nav-dropdown' : this.isDropdown}
            ]
        },
        linkClass() {
            return [
                'nav-link', this.menu.class,
                {
                    'active': this.menu.is_current || this.is_open
                }
            ];
        },
        iconClass() {
            return ['nav-icon', this.menu.icon ];
        },
        formatedText() {
            let text = this.menu.title;

            if (this.highlight && this.filterPosition != -1) {
                return [
                    text.slice(0, this.filterPosition),
                    "<span class='text-warning'>",
                    text.slice(this.filterPosition, this.filterPosition + this.highlight.length),
                    "</span>",
                    text.slice(this.filterPosition + this.highlight.length),
                ].join('');
            }

            return text;
        },
        filterPosition() {
            return this.menu.title.search(new RegExp(this.highlight, 'i'));
        },
    },
    data() {
        return {
            is_open : false,
        }
    },
    props: {
        menu: {
            type    : Object,
            required: true,
        },
        highlight: {
            type    : String,
            required: false,
        },
    },
    mounted() {
        if (this.highlight) {
            this.is_open = true;
        }

        if (this.menu.is_current) {
            this.$emit('active', true);
        }
    },
    methods: {
        hideMobile () {
            if (document.body.classList.contains('sidebar-show')) {
                document.body.classList.toggle('sidebar-show')
            }
        },
        onClick(e) {
            if (this.isDropdown) {
                this.is_open = !this.is_open;

                e.preventDefault();
            }
        }
    },
    watch: {
        highlight(value) {
            if (!!value) {
                this.is_open = true;
            }
        }
    }
}
</script>
