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

    },
    form_js: function () {
        $('.select2_default').select2();

        $("#partnerCode").select2({
            placeholder: "Nhập partner code",
            allowClear: true,
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
            templateResult: formatPartner, // omitted for brevity, see the source of this page
            templateSelection: formatPartnerSelection // omitted for brevity, see the source of this page
        });

        function formatPartner(repo) {
            if (repo.loading) return repo.text;
            var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.partner_code + "(" + repo.name + ")" + "</div>";
            return markup;
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
        t = $("#ajax_data").KTDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/payment-link/overviewAjax",
                        method: 'GET',
                        params: {
                            partner_code: urlParams.get('partner_code'),
                            fd: urlParams.get('fd') || $('#form [name="fd"]').val(),
                            td: urlParams.get('td') || $('#form [name="td"]').val(),
                        },
                        map: function (raw) {
                            if (raw.chart) {
                                $('#totalMoney').text((raw.chart.total_revenue || '0').toLocaleString() + ' đ')
                                $('#totalTransaction').text((raw.chart.total_transaction || '0').toLocaleString())
                                local.chart(raw.chart)
                            }
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
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
                field: "partner_code",
                title: '<div class="text-center" style="font-size: 16px">Partner code</div>',
                template: function (t) {
                    return '<div class="text-center" style="font-size: 16px">' + t.partner_code + '</div>';
                }
            }, {
                field: "total_transaction",
                title: '<div class="text-center" style="font-size: 16px">Tổng số giao dịch</div>',
                template: function (t) {
                    return '<div class="text-center" style="font-size: 16px">' + parseInt(t.total_transaction).toLocaleString() + '</div>';
                }
            }, {
                field: "total_amount",
                title: '<div class="text-center" style="font-size: 16px">Tống số tiền</div>',
                template: function (t) {
                    return '<div class="text-center" style="font-size: 16px">' + parseInt(t.total_amount).toLocaleString() + ' đ</div>';
                }
            }
            ]
        });

        t.on('kt-datatable--on-layout-updated', function (t) {
            $('.btn-view-detail,.btn-view-list,.btn-view-schedule').tooltip();
        });
        t.on('kt-datatable--on-ajax-done', function (event, data, meta) {
        })

    },
    chart: function (data) {
        var urlParams = new URLSearchParams(window.location.search);
        var fd = urlParams.get('fd') || $('#form [name="fd"]').val();
        var td = urlParams.get('td') || $('#form [name="td"]').val();
        var categories = data.list_date || [];
        var series = [{
            name: 'Tổng tiền',
            type: 'column',
            yAxis: 1,
            data: data.data_revenue,
            tooltip: {
                valueSuffix: ' đ'
            }

        }, {
            name: 'Tổng giao dịch',
            type: 'spline',
            data: data.data_transaction,
        }];
        if (!categories.length) {
            return;
        }
        Highcharts.chart('overviewChart', {
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'Biểu đồ thống kê tổng giao dịch & tổng doanh thu từ ' + fd + ' - ' + td
            },
            xAxis: [{
                categories: categories,
                crosshair: true
            }],
            yAxis: [{ // Primary yAxis
                labels: {
                    format: '{value}',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: 'Tổng giao dịch',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                }
            }, { // Secondary yAxis
                title: {
                    text: 'Tổng tiền',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value} đ',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },
            series: series
        });
    }
};
$(document).ready(function () {
    // local.load_input();
    local.form_js();
    local.table_js();
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
