import axios  from 'axios';
import Errors from './Errors';

class Form {
    constructor(data, optional = {}) {
        this.__original = {};
        this.__fields   = Object.keys(data);
        this.__optional = Object.keys(optional);

        this.__fields.forEach(field => {
            this.setDefault(field, data[field]);
        });

        this.__optional.forEach(field => {
            this.setDefault(field, optional[field]);
        });

        this.is_loading = false;
        this.errors     = new Errors();
    }

    setDefault(field, value) {
        this.__original[field] = value;

        this[field] = value;
    }

    getFormData() {
        let data = {};

        this.__fields.forEach(field => {
            data[field] = this[field];
        });

        return data;
    }

    assign(data) {
        this.__fields.forEach(field => {
            if (data.hasOwnProperty(field) && (data[field] != null || data[field] != undefined)) {
                this[field] = JSON.parse(JSON.stringify(data[field]));
            }
        });

        this.__optional.forEach(field => {
            if (data.hasOwnProperty(field)) {
                this[field] = JSON.parse(JSON.stringify(data[field]));
            }
        });

        return this;
    }

    reset() {
        this.__fields.forEach(field => {
            this[field] = this.__original[field];
        });

        this.__optional.forEach(field => {
            this[field] = this.__original[field];
        });

        this.errors.clear();
    }

    submit(method, url) {

        this.is_loading = true;

        return new Promise((resolve, reject) => {
            axios[method.toLowerCase()](url, this.getFormData())
                .then(response => {
                    resolve(response);

                    this.onSuccess(response)
                })
                .catch(error => {
                    reject(error);

                    this.onFail(error.response)
                });
        });
    }

    post(url) {
        return this.submit('post', url);
    }

    put(url) {
        return this.submit('put', url);
    }

    feedback(field) {
        return {
            invalidFeedback: this.errors.get(field),
            state          : this.errors.has(field) ? false : null
        }
    }

    onSuccess(resolver, response) {
        this.is_loading = false;

        this.reset();
    }

    onFail(response) {
        this.is_loading = false;

        if (response.status == 422) {
            this.errors.record(response.data.errors);
        }
    }
}


export default Form;