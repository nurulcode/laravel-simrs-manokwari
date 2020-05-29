export default {
    actionField: {
        type: Object,
        default: () => {
            return {
                class  : 'text-center',
                label  : 'Aksi',
                key    : 'dt-action',
            }
        }
    },
    addButtonText: {
        type    : String,
        required: false,
        default : 'Tambah Data'
    },
    dataMap: {
        type    : Function,
        required: false,
        default: function (item) {
            return item;
        }
    },
    fields: {
        type    : [Array, Object],
        required: false
    },
    filter: {
        type    : String,
        required: false,
    },
    form: {
        type    : Form,
        default : () => new Form({}),
        required: false
    },
    indexField: {
        type: Object,
        default: () => {
            return {
                class  : 'text-right',
                key    : 'dt-index',
                label  : 'No',
                thStyle: 'width:24px'
            }
        }
    },
    modalSize: {
        type    : String,
        required: false,
        default : 'md'
    },
    noAction: {
        type    : Boolean,
        default : false
    },
    noAddButtonText: {
        type    : Boolean,
        default : false,
        required: false,
    },
    noDelete: {
        type    : Boolean,
        default : false
    },
    noEdit: {
        type    : Boolean,
        default : false
    },
    noIndex: {
        type    : Boolean,
        default : false
    },
    onDoubleClicked: {
        type    : Function,
        required: false,
        default: function (item) {
            return item;
        }
    },
    params: {
        type    : Object,
        default : () => ({}),
        required: false
    },
    perPage: {
        type   : Number,
        default: 5
    },
    postUrl: {
        type    : String,
        required: false
    },
    sortBy: {
        type    : String,
        default : 'id',
        required: false
    },
    sortDesc: {
        type    : Boolean,
        default : false,
        required: false
    },
    title: {
        type    : String,
        required: false
    },
    url: {
        type    : String,
        required: true
    },
}