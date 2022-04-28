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
                        url: "/ebill-virtual-account-ebill-transaction/ajax/get-list",
                        method: 'GET',
                        params: {
                            query : {
                                billId: urlParams.get('bill_id'),
                                transactionId: urlParams.get('transaction_id'),
                                type: urlParams.get('type'),
                                amount: urlParams.get('amount'),
                                partnerCode: urlParams.get('partner_code'),
                                collectPartnerRefId: urlParams.get('provider_ref_id'),
                                status: urlParams.get('status'),
                                startTime: urlParams.get('startTime'),
                                billCode: urlParams.get('billCode'),
                                endTime: urlParams.get('endTime'),
                                providerCode: urlParams.get('ebill_providerCode'),
                                accountNo: urlParams.get('account_no'),
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
            columns: [ {
                field: "transaction_id",
                title: "Transaction id",
                autoHide: !1,
            },{
                field: "bill_id",
                title: "Bill id",
                autoHide: !1,
            },{

                field: "account_no",
                title: "Account No",
                autoHide: !1,

            },{
                field: "provider_code",
                title: "Provider Code",
                autoHide: !1,
            }
            ,{
                field: "partner_code",
                title: "Partner Code",
                autoHide: !1,
            },{
                field: "amount",
                title: "Amount",
                autoHide: !1,
            },{
                field: "bill_code",
                title: "Bill code",
                autoHide: !1,
            },{
                field: "status",
                title: "Status",
                autoHide: !1,
                template: function(data, type, full, meta) {
                    var a = data.status;
                    var status = {
                        success: {'title': 'Success', 'class': ' kt-badge--success'},
                        error: {'title': 'Error', 'class': ' kt-badge--danger'},
                        pending: {'title': 'Pending', 'class': ' kt-badge--primary'},
                        refund: {'title': 'Refund', 'class': ' kt-badge--dark'},
                    };
                    if (typeof status[a] === 'undefined') {
                        return data;
                    }
                    return '<span class="kt-badge ' + status[a].class + ' kt-badge--inline kt-badge--pill">' + status[a].title + '</span>';
                }
            },{
                field: "type",
                title: "Type",
                autoHide: !1,
            },{
                field: "createdAt",
                title: "Ngày giao dịch",
                autoHide: !1,
            },{
                field: "Actions",
                title: "Thao tác",
                sortable: !1,
                width: 110,
                overflow: "visible",
                textAlign: "left",
                autoHide: !1,
                template: function(t) {
                    return `<a href="javascript:;" data-id="${t.transaction_id}" class="btn-view-detail btn btn-sm btn-clean btn-icon btn-icon-sm" title="View details"><i class="
                    flaticon2-search-1"></i></a>`;
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
                        t.on('kt-datatable--on-ajax-done', function(event, data, meta){                            
                            $('.field-total-amount').text(meta.total_amount)
                        })

                        function getDetailPartnerById(id)
                        {
                            if ($('#ebillTransactionId'+id).length === 0){
                                $.ajax({
                                    type: "get",
                                    url: "/ebill-virtual-account-ebill-transaction/detail/"+ id,
                                    success: function (response) {
                                        $('body').append(response);
                                        $('#ebillTransactionId'+id).modal('show');
                                    }
                                });
                            } else {
                                $('#ebillTransactionId'+id).modal('show');
                            }
                        }
                    }()
            }
        });
        jQuery(document).ready((function() {
            o.init()


            function exportEbillTransaction()
            {
                $('#exportTransaction').click(function (e) {
                    var urlParamsExport = new URLSearchParams(window.location.search);
                    e.preventDefault();
                    var that = $(this);
                    that.attr('disabled', true);
                    $.ajax({
                        type: "POST",
                        url: "/ebill-virtual-account-ebill-transaction/export",
                        data: {
                            query : {
                                billId: urlParams.get('bill_id'),
                                transactionId: urlParams.get('transaction_id'),
                                type: urlParams.get('type'),
                                amount: urlParams.get('amount'),
                                partnerCode: urlParams.get('partner_code'),
                                collectPartnerRefId: urlParams.get('provider_ref_id'),
                                status: urlParams.get('status'),
                                billCode: urlParams.get('billCode'),
                                startTime: urlParams.get('startTime'),
                                endTime: urlParams.get('endTime'),
                            },
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            location.href = '/shopcard-cards/download?file=' + response.path;
                            that.attr('disabled', false);
                        },
                        error: function (response) {
                            if (response.status === 403) {
                                window.emitEvent('notify', {type: 'danger', message: 'Không được phép'});
                            }
                        }
                    });
                });
            }

            exportEbillTransaction();
        }))
    }
});
