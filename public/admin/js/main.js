localStorage.clear()

function showErrorMessage(errors) {
    $.each(errors, function (field, messages) {
        $('#' + field).addClass('is-invalid');
        $('#' + field).parent().append("<span class='invalid-feedback'>" + messages[0] + "</span>");
    });
}

function hideMessageError() {
    $('.invalid-feedback').remove();
    // $('.is-invalid').hide();
}

var g = {
    alert: (message, type = 'success') => {
        window.emitEvent('notify', {type: type, message: message});
    },
    loading: function (status) {
        const $loading = $('#loading-x');
        if (status || typeof status === 'undefined') {
            $loading.removeClass('hidden')
        } else {
            $loading.addClass('hidden')
        }
    },
    first: function (value) {
        var type = typeof value;
        if (type === 'string') return value;
        if (Array.isArray(value)) return g.first(value[0]);
        if (type === 'object') return g.first(Object.values(value));
        throw 'Value is invalid!';
    },
    confirm: function (title, message, callback) {
        swal.fire({
            title: title,
            html: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            // confirmButtonText: '{{trans('PaymentLink.confirm.cancel')}}',
            // cancelButtonText: '{{trans('PaymentLink.confirm.close')}}',
        }).then((result) => {
            if (result.value) {
                callback()
            }
        })
    },
    swal_alert: function (title, message, callback) {
        swal.fire({
            title: title,
            html: message,
            icon: 'warning',
        }).then((result) => {
            if (result.value) {
                callback()
            }
        })
    },
    confirm_with_input: function (title, message, placeholder, callback) {
        swal.fire({
            title: title,
            html: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            input: 'textarea',
            inputLabel: 'Message',
            inputPlaceholder: placeholder || 'Nhập nội dung...',
            inputAttributes: {
                'aria-label': placeholder || 'Nhập nội dung'
            },
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'Nội dung không được bỏ trống'
                }
            }
        }).then((result) => {
            callback(result.value)
        })
    },

    output: function (parent, output, isReset) {
        var $parent = typeof parent === 'object' ? parent : $(parent);
        if (isReset) g.resetOutput(parent);
        if ($parent.find('.validator-error').length) {
            $parent.find('.validator-error').remove();
        }
        if (output === false) return;
        $.each(output, function (i, message) {
            $parent.find(i).after('<div class="validator-error text-danger font-weight-normal mt-2">' + g.first(message) + '</div>');
        });
    },
    resetOutput: function (parent, output) {
        var $parent = typeof parent === 'object' ? parent : $(parent);
        $parent.find('div.validator-error').remove()
    }
}

// global setup
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
