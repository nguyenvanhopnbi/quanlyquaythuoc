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
                        url: "/ebill-virtual-account-ebill/ajax/get-list",
                        method: 'GET',
                        params: {
                            query : {
                                billId: urlParams.get('bill_id'),
                                billCode: urlParams.get('bill_code'),
                                amount: urlParams.get('amount'),
                                status: urlParams.get('status'),
                                partnerCode: urlParams.get('partner_code'),
                                startTime: urlParams.get('startTime'),
                                endTime: urlParams.get('endTime'),
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
                field: "bill_id",
                title: "Bill id",
                autoHide: !1,
            }, {
                field: "bill_code",
                title: "Bill code",
                autoHide: !1,
            }, {
                field: "partner_code",
                title: "Partner code",
                autoHide: !1,
            },{
                field: "service_code",
                title: "Service code",
                autoHide: !1,
            },{
                field: "amount",
                title: "Amount",
                autoHide: !1,
            },{
                field: "paid_amount",
                title: "Paid Amount",
                autoHide: !1,
            },{
                field: "status",
                title: "Status",
                autoHide: !1,
                template: function(data, type, full, meta) {
                    var a = data.status;
                    var status = {
                        new: {'title': 'New', 'class': ' kt-badge--warning'},
                        purchased: {'title': 'Purchased', 'class': ' kt-badge--success'},
                        error: {'title': 'Error', 'class': ' kt-badge--danger'},
                        processing: {'title': 'Processing', 'class': ' kt-badge--primary'},
                        cancelled: {'title': 'Refund', 'class': ' kt-badge--dark'},
                    };
                    if (typeof status[a] === 'undefined') {
                        return data;
                    }
                    return '<span class="kt-badge ' + status[a].class + ' kt-badge--inline kt-badge--pill">' + status[a].title + '</span>';
                }
            },{
                field: "createdAt",
                autoHide: !1,
                title: "Time",
            },{
                field: "Actions",
                title: "Thao tác",
                sortable: !1,
                width: 110,
                overflow: "visible",
                textAlign: "left",
                autoHide: !1,
                template: function(t) {
                    return `<a href="javascript:;" data-id="${t.bill_id}" class="btn-view-detail btn btn-sm btn-clean btn-icon btn-icon-sm" title="View details"><i class="
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

                        function getDetailPartnerById(id)
                        {
                            if ($('#ebillId'+id).length === 0){
                                $.ajax({
                                    type: "get",
                                    url: "/ebill-virtual-account-ebill/detail/"+ id,
                                    success: function (response) {
                                        $('body').append(response);
                                        $('#ebillId'+id).modal('show');
                                    }
                                });
                            } else {
                                $('#ebillId'+id).modal('show');
                            }
                        }
                    }()
            }
        });
        jQuery(document).ready((function() {
            o.init()
        }))
    }
});
