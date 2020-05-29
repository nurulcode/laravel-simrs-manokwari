export default {
    functional: true,
    render: function (createELement, context) {
        let emit = (value) => {
            let onInput  = context.listeners['input']  || (() => {});
            let onChange = context.listeners['change'] || (() => {});

            onInput(value);
            onChange(value);
        }

        let empty   = !context.props.value;

        return createELement('div', {class: 'b-form-group form-group'}, [
            createELement('div', {class: 'input-group'}, [
                createELement('input', {
                    class: 'form-control',
                    attrs: {
                        placeholder: 'Search...',
                        type: 'text',
                        name: 'search'
                    },
                    domProps: {
                        value: context.props.value
                    },
                    on: {
                        input: (event) => emit(event.target.value)
                    }
                }),
                createELement('div', {class: 'input-group-append'}, [
                    createELement('button', {
                        class: 'btn btn-secondary',
                        attrs: {
                            title: empty ? 'Cari...' : 'Clear',
                            type : 'button'
                        },
                        on: {
                            click: (event) => emit(event.target.value)
                        }
                    }, [
                        createELement('i', {
                            class: empty ? 'fa fa-search': 'fa fa-times'
                        })
                    ])
                ])
            ])
        ])
    },
    props: ['value']
}
