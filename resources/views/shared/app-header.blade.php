<app-header inline-template>
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button"
            v-on:click.prevent="toggle('md', true)">
            <span class="navbar-toggler-icon"></span>
        </button>

        @include('shared.navbar-brand')

        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button"
            v-on:click.prevent="toggle('lg')">
            <span class="navbar-toggler-icon"></span>
        </button>

        @include('shared.navbar')
    </header>
</app-header>

@push('javascripts')
<script>
const sidebarCssClasses = [
  'sidebar-show',
  'sidebar-sm-show',
  'sidebar-md-show',
  'sidebar-lg-show',
  'sidebar-xl-show'
];

window.inlines['app-header'] = {
    data() {
        return {

        }
    },
    methods: {
        toggle(breakpoint, mobile) {
            let classToToggle   = sidebarCssClasses[0];

            if (!mobile) {
                classToToggle   = `sidebar-${breakpoint}-show`;
            }

            let classIndex      = sidebarCssClasses.indexOf(classToToggle);

            let removeClassList = sidebarCssClasses.slice(0, classIndex)

            removeClassList.map((className) => document.body.classList.remove(className));

            document.body.classList.toggle(classToToggle)
        }
    }
}
</script>
@endpush