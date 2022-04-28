!function (t) {
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
            a.d = function (t, e, n) {
                a.o(t, e) || Object.defineProperty(t, e, {
                    enumerable: !0,
                    get: n
                })
            },
            a.r = function (t) {
                "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
                    value: "Module"
                }),
                        Object.defineProperty(t, "__esModule", {
                            value: !0
                        })
            },
            a.t = function (t, e) {
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
                        a.d(n, o, function (e) {
                            return t[e]
                        }
                        .bind(null, o));
                return n
            },
            a.n = function (t) {
                var e = t && t.__esModule ? function () {
                    return t.default
                } :
                        function () {
                            return t
                        };
                return a.d(e, "a", e),
                        e
            },
            a.o = function (t, e) {
                return Object.prototype.hasOwnProperty.call(t, e)
            },
            a.p = "",
            a(a.s = 703)
}({
    703: function (t, e, a) {
        "use strict";
        var urlParams = new URLSearchParams(window.location.search);
        var n, o = (n = {
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/transfer-money-transactions/ajax/get-list",
                        method: 'GET',
                        params: {
                            query: {
                                transactionId: urlParams.get('transactionId'),
                                partnerRefId: urlParams.get('partnerRefId'),
                                partnerCode: urlParams.get('partnerCode'),
                                applicationId: urlParams.get('applicationId'),
                                customerPhoneNumber: urlParams.get('customerPhoneNumber'),
                                amount: urlParams.get('amount'),
                                accountNo: urlParams.get('accountNo'),
                                status: urlParams.get('status'),
                                transferStatus: urlParams.get('transferStatus'),
                                startTime: urlParams.get('startTime'),
                                endTime: urlParams.get('endTime')
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
                    field: "transactionId",
                    title: "Transaction id"
                }, {
                    field: "partnerRefId",
                    title: "Partner Ref  ID"
                }, {
                    field: "partnerCode",
                    title: "Partner Code"
                }, {
                    field: "customerPhoneNumber",
                    title: "Customer Phone Number"
                }, {
                    field: "amount",
                    title: "Amount"
                }, {
                    field: "transferAmount",
                    title: "Transfer Amount"
                }, {
                    field: "fee",
                    title: "Fee"
                }, {
                    field: "status",
                    title: "Status",
                    template: function (data, type, full, meta) {
                        var a = data.status;
                        var status = {
                            success: {'title': 'Success', 'class': ' kt-badge--success'},
                            error: {'title': 'Error', 'class': ' kt-badge--danger'},
                            pending: {'title': 'Pending', 'class': ' kt-badge--warning'},
                            processing: {'title': 'Processing', 'class': ' kt-badge--info'},
                            refund: {'title': 'Refund', 'class': ' kt-badge--primary'},
                            cancel: {'title': 'Cancel', 'class': ' kt-badge--dark'}
                        };
                        if (typeof status[a] === 'undefined') {
                            return data;
                        }
                        return '<span class="kt-badge ' + status[a].class + ' kt-badge--inline kt-badge--pill">' + status[a].title + '</span>';
                    }
                }, {
                    field: "transferStatus",
                    title: "Transfer Status",
                    template: function (data, type, full, meta) {
                        var a = data.transferStatus;
                        var status = {
                            success: {'title': 'Success', 'class': ' kt-badge--success'},
                            error: {'title': 'Error', 'class': ' kt-badge--danger'},
                            pending: {'title': 'Pending', 'class': ' kt-badge--warning'},
                            processing: {'title': 'Processing', 'class': ' kt-badge--info'}
                        };
                        if (typeof status[a] === 'undefined') {
                            return data;
                        }
                        return '<span class="kt-badge ' + status[a].class + ' kt-badge--inline kt-badge--pill">' + status[a].title + '</span>';
                    }
                }, {
                    field: "requestTime",
                    title: "Thời Gian"
                }, {
                    field: "Actions",
                    title: "Thao tác",
                    sortable: !1,
                    width: 110,
                    overflow: "visible",
                    textAlign: "left",
                    template: function (t) {
                        return `<a href="javascript:;" data-id="${t.transactionId}" class="btn btn-sm btn-clean btn-icon btn-icon-sm btn-view-detail" title="View details"><i class="flaticon2-list-1"></i></a>`;
                    }
                }]
        }, {
            init: function () {
                !function () {
                    n.search = {
                        input: $("#generalSearch")
                    };
                }(),
                        function () {
                            n.extensions = {
                                checkbox: {}
                            },
                                    n.search = {
                                        input: $("#generalSearch1")
                                    };
                        }()
            }
        });

        jQuery(document).ready((function () {
            o.init();
            //Export
            function exportTransaction()
            {
                $('#exportTransaction').click(function (e) {
                    e.preventDefault();
                    var that = $(this);
                    that.attr('disabled', true);
                    $.ajax({
                        type: "POST",
                        url: "/transfer-money-transactions/export",
                        data: {
                            query: {
                                transactionId: urlParams.get('transactionId'),
                                partnerRefId: urlParams.get('partnerRefId'),
                                partnerCode: urlParams.get('partnerCode'),
                                applicationId: urlParams.get('applicationId'),
                                customerPhoneNumber: urlParams.get('customerPhoneNumber'),
                                amount: urlParams.get('amount'),
                                status: urlParams.get('status'),
                                transferStatus: urlParams.get('transferStatus'),
                                startTime: urlParams.get('startTime'),
                                endTime: urlParams.get('endTime')
                            },
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            location.href = '/transfer-money-transactions/download?file=' + response.path;
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
        }));
    }
});
