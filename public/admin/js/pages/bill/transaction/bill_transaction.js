var urlParams = new URLSearchParams(window.location.search);
var datatable = $('#ajax_data').KTDatatable({
    data: {
        type: "remote",
        source: {
            read: {
                url: "/bill-transaction/ajax/get-list",
                method: 'GET',
                params: {
                    query: {
                        transaction_id: urlParams.get('query[transaction_id]'),
                        partner_ref_id: urlParams.get('query[partner_ref_id]'),
                        status: urlParams.get('query[status]'),
                        startTime: urlParams.get('query[startTime]'),
                        endTime: urlParams.get('query[endTime]'),
                        partner_code: urlParams.get('query[partner_code]'),
                        service_name: urlParams.get('query[service_name]'),
                    }
                }
            }
        },
        serverSide: true,
        pageSize: 20,
        serverPaging: !0,
        serverFiltering: false,
    },
    layout: {
        scroll: !0,
        footer: !1
    },
    rows: {
        autoHide: !1
    },
    sortable: !0,
    pagination: !0,
    columns: [{
            field: "transaction_id",
            title: "Mã Giao Dịch",
            textAlign: "center",
        }, {
            field: "partner_code",
            title: "Mã Đối Tác",
            textAlign: "center",
        }, {
            field: "bill_code",
            title: "Mã Bill",
            textAlign: "center",
        }, {
            field: "service_name",
            title: "Service Name",
            textAlign: "center",
        },

        {
            field: "bill_amount",
            title: "Mệnh Giá Bill",
            textAlign: "center",
        }, {
            field: "status",
            title: "Trạng Thái",
            autoHide: !1,
            textAlign: "center",
            template: function (t) {
                if (t.status === 'success') {
                    return '<button type="button" class="btn btn-success btn-elevate btn-pill btn-elevate-air btn-sm">Success</button>'
                } else if (t.status === 'refund') {
                    return '<button type="button" class="btn btn-info btn-elevate btn-pill btn-elevate-air btn-sm">Refund</button>';
                } else if (t.status === 'error') {
                    return '<button type="button" class="btn btn-danger btn-elevate btn-pill btn-elevate-air btn-sm">Error</button>';
                } else if (t.status === 'pending') {
                    return '<button type="button" class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">Pending</button>';
                } else {
                    return '<button type="button" class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">' + t.status + '</button>';
                }
            }
        },{
            field: "bill_status",
            title: "Trạng Thái Hóa Đơn",
            autoHide: !1,
            textAlign: "center",
            template: function (t) {
                if (t.bill_status === 'success') {
                    return '<button type="button" class="btn btn-success btn-elevate btn-pill btn-elevate-air btn-sm">Success</button>'
                } else if (t.bill_status === 'refund') {
                    return '<button type="button" class="btn btn-info btn-elevate btn-pill btn-elevate-air btn-sm">Refund</button>';
                } else if (t.bill_status === 'error') {
                    return '<button type="button" class="btn btn-danger btn-elevate btn-pill btn-elevate-air btn-sm">Error</button>';
                } else if (t.bill_status === 'pending') {
                    return '<button type="button" class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">Pending</button>';
                } else {
                    return '<button type="button" class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">' + t.bill_status + '</button>';
                }
            }
        }, {
            field: "request_time",
            title: "Thời Gian Yêu Cầu",
            textAlign: "center",
            autoHide: !1,
        }, {
            field: "Actions",
            title: "THAO TÁC",
            sortable: !1,
            width: 110,
            overflow: "visible",
            textAlign: "center",
            autoHide: !1,
            template: function (t) {
                return `<a href="javascript:;" data-id="${t.transaction_id}" class="btn-view-detail btn btn-sm btn-clean btn-icon btn-icon-sm" title="details"><i class="flaticon2-search-1"></i></a>`;
            }
        }]
});

datatable.on('kt-datatable--on-layout-updated', function(){
    $('.btn-view-detail').click(function(){
        var transactionId = $(this).data('id');
        getDetailPartnerById(transactionId)
    })
})

datatable.on('kt-datatable--on-ajax-done', function(event, data, meta){                            
    $('.field-total-amount').text(meta.total_amount)
})

function getDetailPartnerById(id)
{
    if ($('#billTransactionId'+id).length === 0){
        $.ajax({
            type: "get",
            url: "/bill-transaction/detail/"+ id,
            success: function (response) {
                $('body').append(response);
                $('#billTransactionId'+id).modal('show');
            }
        });
    } else {
        $('#billTransactionId'+id).modal('show');
    }
}

function buildPartnerSelect(){
    $.ajax({
        type: "get",
        url: "/partner-partners/ajax/get-list-source",
        dataType: "json",
        success: function (response) {
            buildSelectPartnerCode(response)
        }
    });
}

function buildSelectPartnerCode(datasource)
{
    var option = {
        placeholder: "Nhập partner code",
        allowClear: true,
        data: setDefaultData(datasource.items),
    };
    $("#partner_code").select2(option);
}

function setDefaultData(dataSource)
{
    $.each(dataSource, function (key, partner) {
        if (partner.partner_code === partnerCode) {
            partner.selected = true;
        }
    });
    return dataSource;
}
buildPartnerSelect();
