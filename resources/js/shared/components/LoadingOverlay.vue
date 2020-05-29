<script>
export default {
    functional: true,

    render: (createElement, context) => {
        let emptydiv = Array.apply(null, { length: 4 }).map(function () {
            return createElement('div');
        });

        let elmdata  = { ...context.data, class: 'loading-overlay' };

        let ellipsis = createElement('div', { class:'lds-ellipsis'}, emptydiv);

        return createElement('div', elmdata, [ellipsis]);
    }
}
</script>
