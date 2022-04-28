var local = {
    load_input: function () {
        $("#accFrom").select2({
            placeholder: "Chọn tài khoản chuyển tiền",
            allowClear: true,
            data: (typeof accountFrom !== 'undefined' && accountFrom) ? [accountFrom] : [],
            ajax: {
                url: "/system/transfer-account/list",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.results,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            // minimumInputLength: 0,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });

        $("#accTo").select2({
            placeholder: "Chọn tài khoản nhận tiền",
            allowClear: true,
            data: (typeof accountTo !== 'undefined' && accountTo) ? [accountTo] : [],
            ajax: {
                url: "/system/transfer-account/list",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.results,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            // minimumInputLength: 0,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });

        $('#datetime_schedule').timepicker({
            minuteStep: 1,
            showSeconds: false,
            showMeridian: false,
            snapToStep: true
        });

        $('#date_schedule').datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            language: 'vi',
            autoclose: true,
            startDate: moment().format('DD/MM/YYYY'),
        });

        $('#cbSchedule').on('change', function () {
            $('#cbScheduleWrap').toggleClass('sr-only');
        })
    },
    form_js: function() {
        $('[name="schedule_type"]').on('change', function () {
            $('#scheduleDateWrap').toggleClass('sr-only')
        })
    },
    set_button_loading: function (element, isLoading) {
        $(element).prop('disabled', isLoading);
        if (isLoading) {
            $(element).find('span:first-child').removeClass('sr-only');
        } else {
            $(element).find('span:first-child').addClass('sr-only');
        }
    },
    send_otp: function () {
        $('#sendOtpSms').click(function () {
            local.set_button_loading('#sendOtpSms', true);
            $.ajax({
                url: '/system/transfer-send-otp',
                method: 'post',
                data: {
                    _token: $('#formSubmit [name="_token"]').val(),
                    otp_method: 'sms'
                },
                success: function (res) {
                    local.set_button_loading('#sendOtpSms', false);
                    if (res.success) {
                        $('#msgSms').text('Mã OTP đã được gửi đến tin nhắn của bạn');
                        if (res.expiredAt) {
                            local.count_down_timer(res.expiredAt, '#timer-count-down1', '#msgSms');
                        }
                    } else {
                        alert(res.message || 'Lỗi gửi OTP, vui lòng thử lại');
                    }
                },
                error: function (err) {
                    local.set_button_loading('#sendOtpSms', false);
                    var msg = first(err.responseJSON.errors);
                    alert(msg || first(err.responseJSON.message) || 'Lỗi gửi OTP, vui lòng thử lại');
                }
            });
        });

        $('#sendOtpEmail').click(function () {
            local.set_button_loading('#sendOtpEmail', true);
            $.ajax({
                url: '/system/transfer-send-otp',
                method: 'post',
                data: {
                    _token: $('#formSubmit [name="_token"]').val(),
                    otp_method: 'email'
                },
                success: function (res) {
                    local.set_button_loading('#sendOtpEmail', false);
                    if (res.success) {
                        $('#msgEmail').text('Mã OTP đã được gửi đến email của bạn');
                        if (res.expiredAt) {
                            local.count_down_timer(res.expiredAt, '#timer-count-down2', '#msgEmail');
                        }
                    } else {
                        alert(res.message || 'Lỗi gửi OTP, vui lòng thử lại');
                    }
                },
                error: function (err) {
                    local.set_button_loading('#sendOtpEmail', false);
                    var msg = first(err.responseJSON.errors);
                    alert(msg || first(err.responseJSON.message) || 'Lỗi gửi OTP, vui lòng thử lại');
                },
            });
        });
    },
    count_down_timer: function (time, element, elementMessage) {
        // Set the date we're counting down to
        if (time) {
            expiredAt = time;
        } else if (!expiredAt) return;

        var countDownDate = parseInt(expiredAt) * 1000;
        var $btn = $(element).parent();
        var $btnText = $btn.find('span:nth-child(2)');
        var btnTextVal = $btnText.text();

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result
            var strTime = '';
            strTime += days ? days + 'ngày' + ' ' : '';
            strTime += hours ? hours + " giờ " : '';
            strTime += minutes ? minutes + " phút " : '';
            strTime += seconds + ' giây';

            // If the count down is over
            if (distance <= 0) {
                clearInterval(x);
                $(elementMessage).empty();
                $(element).empty();
                $btn.attr('disabled', false);
                $btnText.text(btnTextVal);
                return;
            }
            $btnText.empty();
            $btn.attr('disabled', true);
            $(element).html('Gửi lại sau ' + strTime);
        }, 1000);
    },
    onSubmit: function () {
        $('#btn_add').off().click(function (e) {
            e.preventDefault();
            swal.fire({
                title: 'Xác nhận gửi yêu cầu',
                text: 'Bạn đang thực hiện yêu cầu chuyển tiền',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Đóng',
            }).then((result) => {
                if (result.value) {
                    $(this).html('<span class="spinner-border spinner-border-sm"></span><span class="pl-3">Đang yêu cầu</span>');
                    $(this).attr('disabled', true);
                    $('#formSubmit').off().submit();
                }
            });
        });
    }
};
$(document).ready(function () {
    local.onSubmit();
    local.load_input();
    local.form_js();
    local.send_otp();
    local.count_down_timer(expiredAtSms || null, '#timer-count-down1', '#msgSms');
    local.count_down_timer(expiredAtEmail || null, '#timer-count-down2', '#msgEmail');
});

function first(value) {
    var type = typeof value;
    if (type === 'string') return value;
    if (Array.isArray(value)) return first(value[0]);
    if (type === 'object') return first(Object.values(value));
    throw 'Value is invalid!';
}

function formatRepo(repo) {
    if (repo.loading) {
        return repo.text;
    }
    var $container = $(
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title font-weight-bold'></div>" +
        "<div class='select2-result-repository__description'><i class='fa fa-credit-card mr-3'></i></div>" +
        "</div>" +
        "</div>" +
        "</div>"
    );

    $container.find(".select2-result-repository__title").text(repo.account_desc);
    $container.find(".select2-result-repository__description").append(repo.account_name + ' - ' + repo.bank_code + ' - ' + repo.account_no);
    return $container;
}

function formatRepoSelection(repo) {
    if (!repo.id) return repo.text;
    if (repo.text && repo.id) return repo.text;
    return repo.account_desc + ' - ' + repo.bank_code + ' - ' + repo.account_no;
}
