var $tbl;
var t;

var local = {
    load_input: function () {
        $("#accFromInput").select2({
            placeholder: "Tìm kiếm tài khoản",
            allowClear: true,
            data: (typeof selectedAccountFrom !== 'undefined' && selectedAccountFrom) ? [selectedAccountFrom] : [],
            ajax: {
                url: "/system/transfer-log/list-account",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                        account_no_type: 'from'
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
            minimumInputLength: 0,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });

        $("#accToInput").select2({
            placeholder: "Tìm kiếm tài khoản",
            allowClear: true,
            data: (typeof selectedAccountTo !== 'undefined' && selectedAccountTo) ? [selectedAccountTo] : [],
            ajax: {
                url: "/system/transfer-log/list-account",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                        account_no_type: 'to'
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
            minimumInputLength: 0,
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

    },
    form_js: function () {
        $('.select2_default').select2({});

        var $btnSetState = $('#btnSetState');
        var $modalConfirm = $('#modal-reschedule-once');
        $btnSetState.click(function (e) {
            e.preventDefault();
            var $this = $(this);
            var status = $(this).attr('data-status');
            var scheduleType = $(this).attr('schedule-type');
            if (scheduleType === 'once' && statuses.schedule === status) {
                $modalConfirm.modal('show');
                $('#onceConfirm').off().click(function () {
                    submitSchedule();
                })
            } else {
                submitSchedule();
            }

            function submitSchedule() {
                var logId = $this.attr('data-id');
                var title = '';
                if (statuses.schedule === status) {
                    title = 'Xác nhận thực hiện chuyển sang trạng thái "Hẹn lịch"';
                } else {
                    title = 'Xác nhận thực hiện chuyển sang trạng thái "Tạm dừng"';
                }
                swal.fire({
                    title: title,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Đóng',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '/system/transfer/log/' + logId + '/set-state',
                            method: 'post',
                            headers: {'X-CSRF-TOKEN': csrf},
                            data: {
                                status: status,
                                schedule_at: $modalConfirm.find('[name="schedule_at"]').val(),
                                scheduled_date: $modalConfirm.find('[name="scheduled_date"]').val(),
                            },
                            success: function (res) {
                                var currentStatus = res.current_status;
                                if (!res.success) {
                                } else {
                                    $btnSetState.text(currentStatus === statuses.schedule ? 'Tạm dừng lệnh' : 'Bật hẹn lịch');
                                    $('#btnSetState').attr('data-status', currentStatus === statuses.schedule ? statuses.paused : statuses.schedule);
                                    t.reload();
                                    $modalConfirm.modal('hide')
                                }
                                swal.fire(res.message);
                            }
                        });
                    }
                });
            }

        });

    },
    get_filter: function (merge) {
        var urlParams = new URLSearchParams(window.location.search);
        return Object.assign({
            account_no_from: urlParams.get('account_no_from'),
            account_no_to: urlParams.get('account_no_to'),
            startTime: urlParams.get('startTime'),
            endTime: urlParams.get('endTime'),
            status: urlParams.get('status') != '0' ? urlParams.get('status') : null,
            schedule_type: urlParams.get('schedule_type') != 0 ? urlParams.get('schedule_type') : null,
        }, merge)
    },
    table_js: function () {
        t = $("#ajax_data").KTDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/system/transfer-list",
                        method: 'GET',
                        params: local.get_filter()
                    }
                },
                pageSize: 20,
                serverPaging: !0,
                serverFiltering: false,
                serverSorting: !0,
                saveState: false
            },
            layout: {
                scroll: !0,
                footer: !1
            },
            rows: {
                autoHide: !1
            },
            sortable: !0,
            columns: [{
                field: "id",
                title: "#",
                width: 30
            }, {
                field: "account_no_from",
                title: "Tài khoản chuyển",
                template: function (t) {
                    return `<div>${t.account_name_from}</div><div>${t.account_no_from}<div>${t.bank_code_from}</div>`;
                }
            }, {
                field: "account_no_to",
                title: "Tài khoản nhận",
                template: function (t) {
                    return `<div>${t.account_name_to}</div><div>${t.account_no_to}</div><div>${t.bank_code_to}</div>`;
                }
            }, {
                field: "total_amount_text",
                title: "Tổng tiền",
            }, {
                field: "amount_per_trans_text",
                title: "Số tiền chuyển tối đa / 1 lần"
            }, {
                field: "success_times",
                title: "Số lần chuyển"
            }, {
                field: "amount_transferred",
                title: "Số tiền đã chuyển"
            }, {
                field: "schedule_type_text",
                title: "Tần suất chuyển",
                template: function (t) {
                    var colors = {
                        once: 'secondary',
                        daily: 'info',
                    };
                    var color = colors[t.schedule_type] || 'success';
                    return `<label class="badge badge-${color}">${t.schedule_type_text}</label>`;
                }
            }, {
                field: "status_text",
                title: "Trạng thái",
                template: function (t) {
                    var colors = {
                        done: 'success',
                        paused: 'warning',
                        schedule: 'info',
                    };
                    var color = colors[t.status] || 'default';
                    return `<label class="badge badge-${color}">${t.status_text}</label>`;
                }
            }, {
                field: "schedule_at",
                title: "Hẹn lịch lúc"
            }, {
                field: "created_at",
                title: "Ngày tạo"
            }, {
                field: "Actions",
                title: "Thao tác",
                width: 100,
                template: function (t) {
                    var btn = '';
                    btn += '<div class="d-flex">';
                    btn += `<a class="btn-view-detail btn btn-sm btn-clean btn-icon btn-icon-sm mx-2" data-id="${t.id}" title="Chi tiết lệnh"><i class="flaticon2-search-1"></i></a>`;
                    if (canViewTransaction) {
                        btn += `<a class="btn-view-list btn btn-sm btn-clean btn-icon btn-icon-sm mx-2" data-id="${t.id}" title="Chi tiết GD đã chuyển"><i class="flaticon2-list-1"></i></a>`;
                    }
                    if (t.schedule_type) {
                        btn += `<a class="btn-view-schedule btn btn-sm btn-clean btn-icon btn-icon-sm mx-2" data-id="${t.id}" data-status="${t.status}" schedule-type="${t.schedule_type}" title="Lịch hẹn đã chạy"><i class="flaticon2-time"></i></a>`;
                    }
                    btn += '</div>';
                    return btn;
                }
            },
            ]
        });

        t.on('kt-datatable--on-layout-updated', function (t) {
            $('.btn-view-detail,.btn-view-list,.btn-view-schedule').tooltip();
            $('.btn-view-list').click(function () {
                getListTransaction($(this).attr('data-id'));
            });
            $('.btn-view-detail').click(function () {
                getDetailLog($(this).attr('data-id'));
            });

            $('.btn-view-schedule').click(function () {
                var currentStatus = $(this).attr('data-status');
                var scheduleType = $(this).attr('schedule-type');
                var nextStatus = currentStatus === statuses.paused ? statuses.schedule : statuses.paused;
                tblScheduleLog($(this).attr('data-id'), nextStatus, scheduleType);
            });

        });
        // t.on('kt-datatable--on-ajax-done', function(event, data, meta){
        //     $('.field-total-amount').text(meta.total_amount)
        // })

        function getListTransaction(id) {
            $.ajax({
                type: "get",
                url: "/system/transfer-transaction-ajax?detail=get&log_id=" + id,
                success: function (response) {
                    $('#md-content-list').html(response);
                    $('#modal-list').modal('show');
                }
            });
        }

        function getDetailLog(id) {
            $.ajax({
                type: "get",
                url: "/system/transfer-list?detail=get&id=" + id,
                success: function (response) {
                    $('#md-content').html(response);
                    $('#modal-log').modal('show');
                }
            });
        }

        function tblScheduleLog(id, status, scheduleType) {
            $('#md-schedule-list').empty();
            var idTbl = Math.random();
            var $tb = $('<div>', {id: idTbl});
            $('#md-schedule-list').html($tb);

            var url = "/system/transfer/schedule/list-ajax?log_id=" + id;
            $('#modal-schedule').modal('show').on('shown.bs.modal', function () {
                $tbl = $tb.KTDatatable({
                    data: {
                        type: "remote",
                        source: {
                            read: {
                                url: url,
                                method: 'GET',
                                params: {
                                    is_html: 0,
                                }
                            }
                        },
                        pageSize: 20,
                        serverPaging: !0,
                        serverFiltering: false,
                        serverSorting: !0
                    },
                    layout: {
                        scroll: !0,
                        footer: !1
                    },
                    rows: {
                        autoHide: !1
                    },
                    sortable: !0,
                    columns: [{
                        field: "id",
                        title: "ID",
                        width: 30
                    }, {
                        field: "times_success",
                        title: "Số lần chuyển",
                    }, {
                        field: "message",
                        title: "Message",
                    }, {
                        field: "created_at",
                        title: "Thời gian tạo",
                    }]
                });
                $('#btnSetState').attr('data-status', status);
                $('#btnSetState').attr('schedule-type', scheduleType);
                $('#btnSetState').attr('data-id', id);
                $('#btnSetState').text(status === statuses.schedule ? 'Bật hẹn lịch' : 'Tạm dừng lệnh');
            }).on('hide.bs.modal', function () {
                $tbl.destroy();
                $('#btnSetState').text('');
                $('#btnSetState').attr('data-status', null);
                $('#btnSetState').attr('schedule-type', null);
                $('#btnSetState').attr('data-id', null);
            });
        }
    },
    export: () => {
        $('#export').click(function (e) {
            e.preventDefault();
            g.alert('Đang yêu cầu tải xuống...', 'info')
            var params = local.get_filter({request_type: 'export'})
            var qs = Object.keys(params).map(function (key) {
                return key + '=' + (params[key] ? params[key] : '')
            }).join('&');
            window.open('/system/transfer-logs?' + qs)
        });
    },
};
$(document).ready(function () {
    local.load_input();
    local.form_js();
    local.table_js();
    local.export();
});


function formatRepo(repo) {
    if (repo.loading) {
        return repo.text;
    }
    var $container = $(
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'></div>" +
        "<div class='select2-result-repository__description'><i class='fa fa-credit-card mr-3'></i></div>" +
        "</div>" +
        "</div>" +
        "</div>"
    );

    $container.find(".select2-result-repository__title").text(repo.account_name);
    $container.find(".select2-result-repository__description").append(repo.bank_code + ' - ' + repo.account_no);
    return $container;
}

function formatRepoSelection(repo) {
    if (!repo.id) return repo.text;
    return repo.account_name + ' - ' + repo.bank_code + ' - ' + repo.account_no;
}
