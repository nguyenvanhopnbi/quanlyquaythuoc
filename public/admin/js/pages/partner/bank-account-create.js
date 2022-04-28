var local = {
    load_input: function () {
        $("#accTo").select2({
            placeholder: "Chọn tài khoản nhận tiền",
            allowClear: true,
            data: [],
            ajax: {
                url: "/partner/bank-account/make/list-account",
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
    form_js: function () {
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
        var $form = $('#formSubmit');
        $('#sendOtpSms').click(function () {
            local.set_button_loading('#sendOtpSms', true);
            g.resetOutput($(this).parent().parent())
            $.ajax({
                url: '/partner/bank-account/send-otp',
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
        var $form = $('#formSubmit')
        $('#btn_add').click(function (e) {
            e.preventDefault();
            setSubmitStateButton(true)
            var $form = $('#formSubmit');
            var formData = new FormData();
            formData.append('file_attach', $('[name="file_attach"]')[0].files[0] || '');
            formData.append('account_id', $form.find('[name="account_id"]').val() || '');
            formData.append('amount', $form.find('[name="amount"]').val());
            formData.append('bbds_id', $form.find('[name="bbds_id"]').val());
            formData.append('content', $form.find('[name="content"]').val());
            formData.append('otp_sms_code', $form.find('[name="otp_sms_code"]').val());
            $.ajax({
                type: "post",
                url: "/partner/bank-account/make",
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    setSubmitStateButton(false);
                    if(res.success) {
                        g.swal_alert('Tạo yêu cầu thành công', 'Yêu cầu đã được gửi đến cho bộ phận Kế Toán. Chờ xác nhận OTP để chi tiền thanh toán', function () {
                            if (isAllowViewListTransaction) {
                                window.location.href = '/partner/bank-account/make/list';
                            } else {
                                window.location.reload()
                            }
                        });
                    }
                },
                error: function (err) {
                    setSubmitStateButton(false)
                    var res = err.responseJSON;
                    var outputData = {};
                    if(err.status === 413) {
                        outputData['[name="file_attach"]'] = 'File tải lên quá lớn, tối đa 25MB'
                        g.output($form, outputData, true);
                        return;
                    }
                    $.each(res.errors, function (input_name, message) {
                        if (['otp_sms_code', 'otp_email_code', 'account_id'].indexOf(input_name) !== -1) {
                            var key = '[data-name="' + input_name + '"]';
                        } else {
                            var key = '[name="' + input_name + '"]';
                        }
                        outputData[key] = message;
                    });
                    g.output($form, outputData, true);
                }
            });
        });

        var oldBtnContent = `<i class="la la-save"></i> Tạo giao dịch`
        var setSubmitStateButton = function (loading) {
            var $this = $('#btn_add');
            if (loading) {
                $this.html('<span class="spinner-border spinner-border-sm"></span><span class="pl-3">Đang yêu cầu</span>');
                $this.attr('disabled', true);
            } else {
                $this.html(oldBtnContent);
                $this.attr('disabled', false);
            }
        }
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

    $container.find(".select2-result-repository__title").text('Partner Code: ' + repo.partner_code);
    $container.find(".select2-result-repository__description").append(repo.bank_account_name + ' - ' + repo.bank_code + ' - ' + repo.bank_account_no);
    $container.find(".select2-result-repository__description").append(`<div>Chi nhánh: ${repo.bank_branch}</div>`);
    return $container;
}

function formatRepoSelection(repo) {
    if (!repo.id) return repo.text;
    if (repo.text && repo.id) return repo.text;
    return `<b>[${repo.partner_code}]</b> ` + repo.bank_account_name + ' - ' + repo.bank_code + ' - ' + repo.bank_account_no;
}
