class Errors {
    constructor() {
        this.errors = {};
    }

    any() {
        return Object.keys(this.errors).length > 0;
    }

    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    get(field) {
        return this.has(field) ? this.errors[field][0] : '';
    }

    feedback(field) {
        return {
            invalidFeedback: this.get(field),
            state          : this.has(field) ? false : null
        }
    }

    record(errors) {
        this.errors = errors;
    }

    clear(field) {
        if (field) {
            delete this.errors[field];

            return;
        }


        this.errors = {};
    }
}

export default Errors;