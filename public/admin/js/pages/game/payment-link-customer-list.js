var t;
var statusColors = {
    active: 'success',
    block: 'warning',
    inactive: 'danger',
};

var local = {
    load_input: function () {

    },
    form_js: function () {
        $('.select2_default').select2({});

        $("#partnerCode").select2({
            placeholder: "Nhập partner code",
            allowClear: true,
            data: [],
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
                        url: "/payment-link/customer",
                        method: 'GET',
                        params: {
                            request_type: 'ajax',
                            customer_name: urlParams.get('customer_name'),
                            customer_phone: urlParams.get('customer_phone'),
                            customer_email: urlParams.get('customer_email'),
                            partner_code: urlParams.get('partner_code'),
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
                field: "id",
                title: 'ID',
                template: function (t) {
                    return t.id || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "customer_name",
                title: 'Tên khách hàng',
                template: function (t) {
                    return t.customer_name || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "customer_email",
                title: 'Email',
                template: function (t) {
                    return t.customer_email || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "customer_phone",
                title: 'Số điện thoại',
                textAlign: 'center',
                template: function (t) {
                    return t.customer_phone || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "partner_code",
                title: 'Tài khoản thuộc về Partner',
                textAlign: 'center',
                template: function (t) {
                    return t.partner_code || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "created_at",
                title: 'Ngày tạo',
                template: function (t) {
                    return t.created_at ? moment.unix(t.created_at).format('DD/MM/YYYY') : '<div class="text-secondary">[Trống]</div>';
                }
            },
            ]
        });

        table.on('kt-datatable--on-layout-updated', function () {

        });
        // t.on('kt-datatable--on-ajax-done', function(event, data, meta){
        //     $('.field-total-amount').text(meta.total_amount)
        // })
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
                url: "/payment-link/customer",
                data: {
                        request_type: 'export',
                        customer_name: urlParams.get('customer_name'),
                        customer_phone: urlParams.get('customer_phone'),
                        customer_email: urlParams.get('customer_email'),
                        partner_code: urlParams.get('partner_code'),
                        fd: urlParams.get('startTime'),
                        td: urlParams.get('endTime'),
                },
                success: function (response) {
                    if (response.code == 200) {
                        location.href = '/payment-link/customer?request_type=download&file=' + response.path;
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

