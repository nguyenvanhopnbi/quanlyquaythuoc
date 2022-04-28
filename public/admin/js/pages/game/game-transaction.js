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
        var dataPartner, dataApp;
        $('.select2_default').select2({});

        $.ajax({
            url: '/game/partner-list-ajax',
            success: function (data) {
                dataPartner = data;
            },
            async: false
        });

        $.ajax({
            url: '/game/applications',
            success: function (data) {
                dataApp = data;
            },
            async: false
        });


        $("#partnerCode").select2({
            cacheDataSource: [],
            placeholder: "Nhập partner code",
            allowClear: true,
            data: dataPartner.results,
            // ajax: {
            //     url: "/game/partner-list-ajax",
            //     dataType: 'json',
            //     delay: 3000,
            //     data: function (params) {
            //         return {
            //             q: params.term, // search term
            //             page: params.page
            //         };
            //     },
            //     processResults: function (data, params) {
            //         // parse the results into the format expected by Select2
            //         // since we are using custom formatting functions we do not need to
            //         // alter the remote JSON data, except to indicate that infinite
            //         // scrolling can be used
            //         params.page = params.page || 1;
            //
            //         return {
            //             results: data.results,
            //             pagination: {
            //                 more: (params.page * 30) < data.total_count
            //             }
            //         };
            //     },
            //     cache: true
            // },
            matcher: matchCustomPartner,
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            // minimumInputLength: 0,
            templateResult: formatPartner, // omitted for brevity, see the source of this page
            templateSelection: formatPartnerSelection // omitted for brevity, see the source of this page
        });

        $("#applicationId").select2({
            placeholder: "Nhập kênh bán",
            allowClear: true,
            data: dataApp.results,
            matcher: matchCustomApplication,
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            // minimumInputLength: 0,
            templateResult: formatApp, // omitted for brevity, see the source of this page
            templateSelection: formatAppSelection // omitted for brevity, see the source of this page
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
            if (data.partner_code.indexOf(params.term) > -1) {
                var modifiedData = $.extend({}, data, true);
                // modifiedData.text += ' (matched)';

                // You can return modified objects from here
                // This includes matching the `children` how you want in nested data sets
                return modifiedData;
            }

            // Return `null` if the term should not be displayed
            return null;
        }

        function matchCustomApplication(params, data) {
            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (!data.name || typeof data.name === 'undefined') {
                return null;
            }

            // `params.term` should be the term that is used for searching
            // `data.text` is the text that is displayed for the data object
            if (data.name.indexOf(params.term) > -1) {
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

        function formatApp(repo) {
            if (repo.loading) return repo.text;

            var $container = $(
                "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title font-weight-bold'></div>" +
                "</div>" +
                "</div>" +
                "</div>"
            );

            $container.find(".select2-result-repository__title").text(repo.name);
            return $container;
        }

        function formatAppSelection(repo) {
            if (typeof repo.name !== 'undefined') {
                return repo.name;
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
                        url: "/game/transactions",
                        method: 'GET',
                        params: {
                            request_type: 'ajax',
                            partner_code: urlParams.get('partner_code'),
                            order_id: urlParams.get('order_id'),
                            payment_method: urlParams.get('payment_method'),
                            status: urlParams.get('status'),
                            transaction_id: urlParams.get('transaction_id'),
                            application_id: urlParams.get('application_id'),
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
                field: "transaction_id",
                title: 'Transaction ID',
                template: function (t) {
                    return t.transaction_id || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "partner_code",
                title: 'Partner code',
                template: function (t) {
                    return t.partner_code || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "amount",
                title: 'Số tiền',
                template: function (t) {
                    return parseInt(t.amount).toLocaleString() + ' đ';
                }
            }, {
                field: "game_name",
                title: 'Tên game',
                textAlign: 'center',
                template: function (t) {
                    return t.game_name || '<div class="text-secondary">[Trống]</div>';
                }
            },{
                field: "created_at",
                title: 'Ngày giao dịch',
                template: function (t) {
                    return t.created_at ? t.created_at : '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "status",
                title: 'Status',
                template: function (t) {
                    var color = statusColors[t.status] ?? 'info';
                    return t.status ? `<label class="badge badge-${color}">` + t.status + '</label>' : '<div class="text-secondary">[Trống]</div>';
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
                url: "/game/transactions",
                data: {
                    request_type: 'export',
                    partner_code: urlParams.get('partner_code'),
                    order_id: urlParams.get('order_id'),
                    payment_method: urlParams.get('payment_method'),
                    status: urlParams.get('status'),
                    transaction_id: urlParams.get('transaction_id'),
                    application_id: urlParams.get('application_id'),
                    fd: urlParams.get('startTime'),
                    td: urlParams.get('endTime'),
                },
                success: function (response) {
                    if (response.code == 200) {
                        location.href = '/game/transactions?request_type=download&file=' + response.path;
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

