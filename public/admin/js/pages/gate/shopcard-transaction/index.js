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
                        url: "/shopcard-card-transactions/ajax/get-list",
                        method: 'GET',
                        params:{
                            query: {
                                transaction_id: urlParams.get('transaction_id'),
                                partner_ref_id: urlParams.get('partner_ref_id'),
                                partner_code: urlParams.get('partner_code'),
                                application_id: urlParams.get('application_id'),
                                phone_number: urlParams.get('phone_number'),
                                telco: urlParams.get('telco'),
                                telco_service_type: urlParams.get('telco_service_type'),
                                amount: urlParams.get('amount'),
                                status: urlParams.get('status'),
                                topup_status: urlParams.get('topup_status'),
                                startTime: urlParams.get('startTime'),
                                endTime: urlParams.get('endTime'),
                                vendor: urlParams.get('vendor'),
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
            columns: [ {
                field: "transaction_id",
                title: "Transaction ID",
                autoHide: !1,
            }, {
                field: "partner_code",
                title: "Partner code",
                autoHide: !1,
            }, {
                field: "product_code",
                title: "Product code",
                autoHide: !1,
            },{
                field: "quantity",
                title: "Quantity",
                autoHide: !1,
            },{
                field: "amount",
                title: "Amount",
                autoHide: !1,
            },{
                field: "vendor",
                title: "Vendor",
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
                        pending: {'title': 'Pending', 'class': ' kt-badge--warning'},
                        processing: {'title': 'Processing', 'class': ' kt-badge--info'},
                        refund: {'title': 'Refund', 'class': ' kt-badge--primary'},
                        cancel: {'title': 'Cancel', 'class': ' kt-badge--dark'},
                    };
                    if (typeof status[a] === 'undefined') {
                        return data;
                    }
                    return '<span class="kt-badge ' + status[a].class + ' kt-badge--inline kt-badge--pill">' + status[a].title + '</span>';
                },
            },{
                field: "response_time",
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
                    return `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm btn-view-detail" data-transaction-id="${t.transaction_id}" title="Edit details"><i class=" flaticon2-search-1"></i></a>`;
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
                                var transactionId = $(this).data('transaction-id');
                                getDetailShopcardTransactionById(transactionId)
                            })
                        })
                        t.on('kt-datatable--on-ajax-done', function(event, data, meta){                            
                            $('.field-total-amount').text(meta.total_amount)
                        })

                        function getDetailShopcardTransactionById(id)
                        {
                            if ($('#shopcardTransactionId'+id).length === 0){
                                $.ajax({
                                    type: "get",
                                    url: "/shopcard-card-transactions/detail/"+ id,
                                    data: "html",
                                    success: function (response) {
                                        $('body').append(response);
                                        $('#shopcardTransactionId'+id).modal('show');
                                    }
                                });
                            } else {
                                $('#shopcardTransactionId'+id).modal('show');
                            }
                        }
                    }()
            }
        });
        jQuery(document).ready((function() {
            o.init()
            function exportTransaction()
            {
                $('#exportTransaction').click(function (e) {
                    e.preventDefault();
                    var that = $(this);
                    that.attr('disabled', true);
                    $.ajax({
                        type: "POST",
                        url: "/shopcard-card-transactions/export",
                        data: {
                            query: {
                                transaction_id: $("input[name='transaction_id']").val(),
                                partner_ref_id: $("input[name='partner_ref_id']").val(),
                                partner_code: $("input[name='partner_code']").val(),
                                application_id: $("input[name='application_id']").val(),
                                application_id: $("input[name='application_id']").val(),
                                amount: $("input[name='amount']").val(),
                                startTime: $("input[name='startTime']").val(),
                                endTime: $("input[name='endTime']").val(),
                                status: $("select[name='status']").val(),
                                vendor: $("select[name='vendor']").val(),
                            },
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            location.href = '/shopcard-card-transactions/download?file=' + response.path;
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
            exportTransaction();

        }))
    }
});
