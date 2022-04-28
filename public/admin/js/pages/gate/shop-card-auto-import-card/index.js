$('.btn-submit-save-config-auto-import-card').click(function (e) {
    e.preventDefault();
    var that = $(this);
    that.attr('disabled', true);
    var data = $('form').serializeArray();
    var config = {};
    $.each(data, function (key, objField) {
        config[objField.name] = objField.value;
    });
    $.ajax({
        type: "POST",
        url: "/shopcard-card-auto-import-card/ajax-save-config",
        data: {
            config: config,
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            that.attr('disabled', false);
            if (response.message == 'Thành công') {
                window.emitEvent('notify', {type: 'success', message: 'Cập nhật config thành công'});
            } else {
                window.emitEvent('notify', {type: 'danger', message: 'Lỗi hệ thống'});
            }
        },
        error: function (response) {
            if (response.status === 403) {
                window.emitEvent('notify', {type: 'danger', message: 'Không được phép'});
            }
        }
    });
});
$('.btn-show').hide();

$('.btn-show').click(function () {
    var show = $(this).attr('vendor');
    $('.btn-hidden[vendor='+ show +']').show();
    $('.' + show).show();
    $(this).hide();
});
$('.btn-hidden').click(function () {
    var hide = $(this).attr('vendor');
    $('.btn-show[vendor='+ hide +']').show();
    $('.' + hide).hide();
    $(this).hide();
});

$('.export').click(function(e){
    e.preventDefault();
    var that = $(this);
    that.attr('disabled', true)
    $.ajax({
        type: "POST",
        url: "/shopcard-card-auto-import-card/ajax-export",
        data: {
            _token:  $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            location.href = '/shopcard-card-auto-import-card/download?file='+response.path;
            that.attr('disabled', false);
        },
        error: function (response) {
            if (response.status === 403) {
                window.emitEvent('notify', {type: 'danger', message: 'Không được phép'});
            }
        }
    });
})
