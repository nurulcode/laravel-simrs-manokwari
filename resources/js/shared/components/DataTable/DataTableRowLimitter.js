export default {
    functional: true,
    render: function (createELement, context) {
        let onInput  = context.listeners['input']  || (() => {});
        let onChange = context.listeners['change'] || (() => {});

        return createELement('div', {class: context.props.wrapperClass}, [
            createELement('label', context.props.label),
            createELement('select', {
                    class: 'form-control custom-select',
                    domProps: {
                        value: Number.parseInt(context.props.value)
                    },
                    on: {
                        input: (event) => {
                            onInput(Number.parseInt(event.target.value));
                            onChange(Number.parseInt(event.target.value));
                        }
                    }
                },
                context.props.options.map(item => {
                    return createELement('option', item)
                })
            )
        ]);
    },
    props:{
        wrapperClass: {
            type   : String,
            default: 'DataTable__limit'
        },
        label: {
            type   : String,
            default: 'Tampilkan:'
        },
        options: {
            type   : Array,
            default: () => [5,10,15,20]
        },
        value: {
            type : [Number, String],
            default: 5
        }
    }
}