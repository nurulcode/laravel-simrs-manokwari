import toastr from 'toastr';

window.flash = function (message, type, duration = 5000) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": duration,
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    let title = type.charAt(0).toUpperCase() + type.slice(1);

    toastr[type](message, title);
}

window.stickAlert = function (message, type) {
    window.events.$emit('bs-alert', message, type || 'danger');
}