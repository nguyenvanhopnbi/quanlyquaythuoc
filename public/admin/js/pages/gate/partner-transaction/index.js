! function(t) {
    var e = {};

    function a(n) {
        if (e[n])
            return e[n].exports;
        var o = e[n] = {
            i: n,
            l: !1,
            exports: {}
        };
        return t[n].call(o.exports, o, o.exports, a),
            o.l = !0,
            o.exports
    }
    a.m = t,
        a.c = e,
        a.d = function(t, e, n) {
            a.o(t, e) || Object.defineProperty(t, e, {
                enumerable: !0,
                get: n
            })
        },
        a.r = function(t) {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
                value: "Module"
            }),
                Object.defineProperty(t, "__esModule", {
                    value: !0
                })
        },
        a.t = function(t, e) {
            if (1 & e && (t = a(t)),
            8 & e)
                return t;
            if (4 & e && "object" == typeof t && t && t.__esModule)
                return t;
            var n = Object.create(null);
            if (a.r(n),
                Object.defineProperty(n, "default", {
                    enumerable: !0,
                    value: t
                }),
            2 & e && "string" != typeof t)
                for (var o in t)
                    a.d(n, o, function(e) {
                        return t[e]
                    }
                        .bind(null, o));
            return n
        },
        a.n = function(t) {
            var e = t && t.__esModule ? function() {
                    return t.default
                } :
                function() {
                    return t
                };
            return a.d(e, "a", e),
                e
        },
        a.o = function(t, e) {
            return Object.prototype.hasOwnProperty.call(t, e)
        },
        a.p = "",
        a(a.s = 703)
}({
    703: function(t, e, a) {
        "use strict";
        var urlParams = new URLSearchParams(window.location.search);
        var n, o = (n = {
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/partner-transactions/ajax/get-list",
                        method: 'GET',
                        params: {
                            query: {
                                transaction_id: urlParams.get('transaction_id'),
                                amount: urlParams.get('amount'),
                                partner_code: urlParams.get('partner_code'),
                                reason: urlParams.get('reason'),
                                balance: urlParams.get('balance'),
                                type: urlParams.get('type'),
                                startTime: urlParams.get('startTime'),
                                endTime: urlParams.get('endTime'),
                            }
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
                field: "transaction_id",
                title: "Transaction id",
            }, {
                field: "partner_code",
                title: "Partner code",
            }, {
                field: "amount",
                title: "Amount",
            },{
                field: "balance",
                title: "Balance",
            },{
                field: "type",
                title: "Type",
            },{
                field: "timestamp",
                title: "Ngày giao dịch",
            },{
                field: "Actions",
                title: "Thao tác",
                sortable: !1,
                width: 110,
                overflow: "visible",
                textAlign: "left",
                template: function(t) {
                    return `<a href="javascript:;" data-id="${t.transaction_id}" class="btn-view-detail btn btn-sm btn-clean btn-icon btn-icon-sm" title="View details"><i class="flaticon2-search-1"></i></a>`;
                }
            }]
        }, {
            init: function() {
                ! function() {
                    n.search = {
                        input: $("#generalSearch")
                    };
                }(),
                    function() {
                        n.extensions = {
                            checkbox: {}
                        },
                            n.search = {
                                input: $("#generalSearch1")
                            };


                        var t = $("#ajax_data").KTDatatable(n);
                        t.on('kt-datatable--on-layout-updated', function(){
                            $('.btn-view-detail').click(function(){
                                var transactionId = $(this).data('id');
                                getDetailPartnerById(transactionId)
                            })
                        })

                        function getDetailPartnerById(id)
                        {
                            if ($('#partnerTransactionId'+id).length === 0){
                                $.ajax({
                                    type: "get",
                                    url: "/partner-transactions/view/"+ id,
                                    success: function (response) {
                                        $('body').append(response);
                                        $('#partnerTransactionId'+id).modal('show');
                                    }
                                });
                            } else {
                                $('#partnerTransactionId'+id).modal('show');
                            }
                        }
                    }()
            }
        });
        jQuery(document).ready((function() {
            o.init()
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

            function exportTransaction()
            {
                $('#exportTransaction').click(function(e){
                    e.preventDefault();
                    var that = $(this);
                    that.attr('disabled', true)
                    $.ajax({
                        type: "POST",
                        url: "/partner-transactions/export",
                        data: {
                            query : {
                                transaction_id: $("input[name='transaction_id']").val(),
                                amount: $("input[name='amount']").val(),
                                partner_code: $("#partner_code").val(),
                                reason: $("input[name='reason']").val(),
                                type: $("select[name='type']").val(),
                                startTime: $("input[name='startTime']").val(),
                                endTime: $("input[name='endTime']").val(),
                            },
                            _token:  $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            location.href = '/partner-transactions/download?file='+response.path;
                            that.attr('disabled', false)
                        },
                        error: function (response) {
                            if (response.status === 403) {
                                window.emitEvent('notify', {type: 'danger', message: 'Không được phép'});
                            }
                        }
                    });



                })
            }
            exportTransaction();
        }))
    }
});
