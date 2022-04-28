var t;
var statusColors = {
    pending: 'warning',
    success: 'success',
    error: 'danger',
};

var local = {
    load_input: function () {

    },
    form_js: function () {
        $('.select2_default').select2({});

        $("#partnerCode").select2({
            placeholder: "Nhập partner code",
            allowClear: true,
            data: (typeof accountFrom !== 'undefined' && accountFrom) ? [accountFrom] : [],
            ajax: {
                url: "/payment-link/partner-list-ajax",
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
            templateResult: formatPartner, // omitted for brevity, see the source of this page
            templateSelection: formatPartnerSelection // omitted for brevity, see the source of this page
        });

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
    table_js: function () {
        var urlParams = new URLSearchParams(window.location.search);
        var table = $("#ajax_data").KTDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/payment-link/transaction",
                        method: 'GET',
                        params: {
                            request_type: 'ajax',
                            partner_code: urlParams.get('partner_code'),
                            bank_code: urlParams.get('bank_code'),
                            payment_method: urlParams.get('payment_method'),
                            status: urlParams.get('status'),
                            transaction_id: urlParams.get('transaction_id'),
                            vendor_code: urlParams.get('vendor_code'),
                            fd: urlParams.get('startTime'),
                            td: urlParams.get('endTime'),
                        }
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
                field: "transactionId",
                title: 'Transaction ID',
                template: function (t) {
                    return t.transactionId || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "partnerCode",
                title: 'Partner code',
                template: function (t) {
                    return t.partnerCode || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "amount",
                title: 'Số tiền',
                template: function (t) {
                    return parseInt(t.amount).toLocaleString() + ' đ';
                }
            }, {
                field: "bankCode",
                title: 'Bank Code',
                textAlign: 'center',
                template: function (t) {
                    return t.transaction.bankCode || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "paymentMethod",
                title: 'Payment Method',
                textAlign: 'center',
                template: function (t) {
                    if (t.transaction.paymentMethod) {
                        return t.transaction.paymentMethod;
                    }
                    return '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "vendorCode",
                title: 'Vendor Code',
                template: function (t) {
                    return t.transaction.vendorCode || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "requestTime",
                title: 'Ngày giao dịch',
                template: function (t) {
                    return t.transaction.requestTime ? moment.unix(t.transaction.requestTime).format('DD/MM/YYYY') : '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "status",
                title: 'Status',
                template: function (t) {
                    var color = statusColors[t.transaction.status] ?? 'info';
                    return t.transaction.status ? `<label class="badge badge-${color}">` + t.transaction.status + '</label>' : '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "",
                title: 'Thao tác',
                template: function (t, index) {
                    btn = `<a class="btn-view-detail btn btn-sm btn-clean btn-icon btn-icon-sm mx-2" data-id="${index}" title="Chi tiết giao dịch"><i class="flaticon2-search-1"></i></a>`;
                    return btn;
                }
            },
            ]
        });

        table.on('kt-datatable--on-layout-updated', function () {
            $('.btn-view-detail').click(function () {
                var index = $(this).attr('data-id');
                getDetailLog(index);
            });

        });
        // t.on('kt-datatable--on-ajax-done', function(event, data, meta){
        //     $('.field-total-amount').text(meta.total_amount)
        // })

        function getDetailLog(index) {
            var rowData = table.row().data();
            if (!rowData.KTDatatable.dataSet) return;
            var data = rowData.KTDatatable.dataSet;
            var t = data[index];
            var color = statusColors[t.transaction.status] ?? 'info';
            console.log('t',t)
            var contents = {
                transactionId: t.transaction.transactionId || empty(),
                partnerCode: t.transaction.partnerCode || empty(),
                amount: t.transaction.amount || empty(),
                bankCode: t.transaction.bankCode || empty(),
                paymentMethod: t.transaction.paymentMethod || empty(),
                vendorCode: t.transaction.vendorCode || empty(),
                status: t.transaction.status ? `<label class="badge badge-${color}">` + t.transaction.status + '</label>' : empty(),
                orderId: t.transaction.orderId || empty(),
                errorCode: t.transaction.errorCode,
                message: t.transaction.message != undefined ? t.transaction.message : empty(),
                requestTime: t.transaction.requestTime ? moment.unix(t.transaction.requestTime).format('HH:mm DD/MM/YYYY') : empty(),
                customerName: t.customerName || empty(),
                customerPhone: t.customerPhone || empty(),
                customerEmail: t.customerEmail || empty(),
                customerAddress: t.customerAddress || empty(),
                orderInfo: t.orderInfo || empty(),
                cancelledAt: t.cancelledAt ? moment.unix(t.cancelledAt).format('HH:mm DD/MM/YYYY') : empty(),
                expiredAt: t.expiredAt ? moment.unix(t.expiredAt).format('HH:mm DD/MM/YYYY') : empty(),
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
                url: "/payment-link/transaction",
                data: {
                    request_type: 'export',
                    partner_code: urlParams.get('partner_code'),
                    bank_code: urlParams.get('bank_code'),
                    payment_method: urlParams.get('payment_method'),
                    status: urlParams.get('status'),
                    transaction_id: urlParams.get('transaction_id'),
                    vendor_code: urlParams.get('vendor_code'),
                    fd: urlParams.get('startTime'),
                    td: urlParams.get('endTime'),
                },
                success: function (response) {
                    if (response.code == 200) {
                        location.href = '/payment-link/transaction?request_type=download&file=' + response.path;
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
    }

};
$(document).ready(function () {
    // local.load_input();
    local.form_js();
    local.table_js();
    local.export();
});

