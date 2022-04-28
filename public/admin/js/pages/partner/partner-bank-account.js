var t;
var statusColors = {
    pending: 'warning',
    success: 'success',
    error: 'danger',
};
var table;

var local = {
    load_input: function () {

    },
    form_js: function () {
        var dataPartner;
        $('.select2_default').select2({});

        $.ajax({
            url: '/partner/bank-account/partners',
            success: function (data) {
                dataPartner = data;
            },
            async: false
        });

        $("#partnerCode").select2({
            cacheDataSource: [],
            placeholder: "Nhập partner code",
            allowClear: true,
            data: dataPartner.results,
            matcher: matchCustomPartner,
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            // minimumInputLength: 0,
            templateResult: formatPartner, // omitted for brevity, see the source of this page
            templateSelection: formatPartnerSelection // omitted for brevity, see the source of this page
        });

        $("#modalPartnerCode").select2({
            cacheDataSource: [],
            placeholder: "Nhập partner code",
            allowClear: true,
            data: dataPartner.results,
            matcher: matchCustomPartner,
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            // minimumInputLength: 0,
            templateResult: formatPartner, // omitted for brevity, see the source of this page
            templateSelection: formatPartnerSelection // omitted for brevity, see the source of this page
        });

        function matchCustomPartner(params, data) {
            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (!data.partner_code || typeof data.partner_code === 'undefined') {
                return null;
            }

            // `params.term` should be the term that is used for searching
            // `data.text` is the text that is displayed for the data object
            if (data.partner_code.toLowerCase().indexOf(params.term.toLowerCase()) > -1 || data.name.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                var modifiedData = $.extend({}, data, true);
                // modifiedData.text += ' (matched)';

                // You can return modified objects from here
                // This includes matching the `children` how you want in nested data sets
                return modifiedData;
            }

            // Return `null` if the term should not be displayed
            return null;
        }

        function formatPartner(repo) {
            if (repo.loading) return repo.text;

            var $container = $(
                "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title font-weight-bold'></div>" +
                "</div>" +
                "</div>" +
                "</div>"
            );

            $container.find(".select2-result-repository__title").text(repo.partner_code + "(" + repo.name + ")");
            return $container;
        }

        function formatPartnerSelection(repo) {
            if (typeof repo.partner_code !== 'undefined') {
                return repo.partner_code + "(" + repo.name + ")";
            }
            return repo.text;
        }

    },
    get_filter: function (merge) {
        var urlParams = new URLSearchParams(window.location.search);
        return Object.assign({
            partner_code: urlParams.get('partner_code'),
            bank_code: urlParams.get('bank_code'),
            bank_account_no: urlParams.get('bank_account_no'),
            bank_account_type: urlParams.get('bank_account_type'),
            fd: urlParams.get('fd'),
            td: urlParams.get('td'),
        }, merge)
    },
    table_js: function () {
        var urlParams = new URLSearchParams(window.location.search);
        table = $("#ajax_data").KTDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/partner/bank-account",
                        method: 'GET',
                        params: local.get_filter({request_type: 'ajax'})
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
                title: 'ID',
                width: 50,
                template: function (t) {
                    return t.id || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "partner_code",
                title: 'Partner code',
                template: function (t) {
                    return t.partner_code || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "bank_code",
                title: 'Bank Code',
                template: function (t) {
                    return t.bank_code || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "bank_account_no",
                title: 'Số tài khoản/Số thẻ',
                width: 200,
                textAlign: 'center',
                template: function (t) {
                    return t.bank_account_no || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "bank_account_name",
                title: 'Tên tài khoản',
                textAlign: 'center',
                template: function (t) {
                    return t.bank_account_name || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "bank_account_type_text",
                title: 'Loại tài khoản',
                textAlign: 'center',
                template: function (t) {
                    return t.bank_account_type_text || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "bank_branch",
                title: 'Chi nhánh',
                textAlign: 'center',
                template: function (t) {
                    return t.bank_branch || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "created_at",
                title: 'Ngày tạo',
                template: function (t) {
                    return t.created_at ? t.created_at : '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "",
                title: 'Thao tác',
                template: function (t, index) {
                    btn = `<a class="btn-delete btn btn-sm btn-clean btn-icon btn-icon-sm mx-2" data-id="${index}" title="Xoá tài khoản"><i class="flaticon2-trash text-danger"></i></a>`;
                    return btn;
                }
            },
            ]
        });

        table.on('kt-datatable--on-layout-updated', function () {
            $('.btn-delete').click(function () {
                var index = $(this).attr('data-id');
                var rowData = table.row().data();
                if (!rowData.KTDatatable.dataSet) return;
                var data = rowData.KTDatatable.dataSet;
                var t = data[index];
                deleteAccount(t)
            });

        });
        // t.on('kt-datatable--on-ajax-done', function(event, data, meta){
        //     $('.field-total-amount').text(meta.total_amount)
        // })
        $modal = $('#modal-detail');

        function deleteAccount(t) {
            g.confirm('Xoá tài khoản', 'Sau khi xoá không thể khôi phục', function () {
                $modal.modal('hide');
                $.ajax({
                    type: "post",
                    url: "/partner/bank-account/" + t.id + "/delete",
                    success: function (response) {
                        g.alert(response.message)
                        table.reload();
                        $modal.modal('hide')
                    },
                    error: function (err) {
                        var res = err.responseJSON;
                        g.alert(res.message || 'Lỗi xảy ra', 'danger')
                    }
                });
            });
        }

        function getDetailLog(t) {
            var color = statusColors[t.status] ?? 'info';
            var contents = {
                transactionId: t.transaction_id || empty(),
                partnerCode: t.partner_code || empty(),
                amount: t.amount || empty(),
                paymentMethod: t.payment_method || empty(),
                status: t.status ? `<label class="badge badge-${color}">` + t.status + '</label>' : empty(),
                orderId: t.order_id || empty(),
                errorCode: t.error_code || empty(),
                message: t.error_message != undefined ? t.error_message : empty(),
                role_name: t.role_name || empty(),
                package_name: t.package_name || empty(),
                server_name: t.server_name || empty(),
                description: t.description || empty(),
                created_at: t.created_at || empty(),
                is_notify: t.is_notify ? 'Yes' : 'No',
                notify_times: t.notify_times,
                user_id: t.user_id,
                application_name: t.application_name,
                id: t.id || empty(),
            };
            $.each(contents, (col, val) => {
                replaceContent(col, val)
            });
            $('#modal-detail').modal('show');
        }

        function replaceContent(col, value) {
            $('#modal-detail').find(`[col="${col}"]`).html(value);
        }

        function empty() {
            return '<div class="text-secondary">[trống]</div>'
        }
    },
    export: () => {
        var urlParams = new URLSearchParams(window.location.search);
        $('.btn-export-flash-chart').click(function (e) {
            e.preventDefault();
            g.alert('Đang yêu cầu tải xuống...', 'info')
            var that = $(this);
            that.attr('disabled', true)
            $.ajax({
                type: "GET",
                url: "/partner/bank-account",
                data: local.get_filter({request_type: 'export'}),
                success: function (response) {
                    if (response.code == 200) {
                        location.href = '/partner/bank-account?request_type=download&file=' + response.path;
                        that.attr('disabled', false)
                    } else {
                        that.attr('disabled', false)
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
    },
    create: () => {
        var $modal = $('#modal-create');
        $modal.on('show.bs.modal', function () {
            g.resetOutput($modal)
        })
        $('#btnCreateSubmit').click(function () {
            $.ajax({
                type: "post",
                url: "/partner/bank-account/create",
                data: $modal.find('form').serialize(),
                success: function (response) {
                    g.alert(response.message)
                    table.reload();
                    $modal.find('form').trigger("reset");
                    $modal.find('form select').val('').trigger('change');
                    $modal.modal('hide')
                },
                error: function (err) {
                    var res = err.responseJSON;
                    g.alert(res.message || 'Lỗi xảy ra', 'danger')
                    var outputData = {};
                    $.each(res.data, function (input_name, message) {
                        var key = '[name="' + input_name + '"]';
                        outputData[key] = message;
                    });
                    g.output($modal, outputData);
                }
            });
        })
    }
};
$(document).ready(function () {
    // local.load_input();
    local.form_js();
    local.table_js();
    local.export();
    local.create();
});

