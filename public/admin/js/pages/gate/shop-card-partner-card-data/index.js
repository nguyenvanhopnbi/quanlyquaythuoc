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
                        url: "/shopcard-card-partner-card-data/ajax/get-list",
                        method: 'GET',
                        params: {
                            query: {
                                ref_transaction_id: urlParams.get('ref_transaction_id'),
                                partner_ref_id: urlParams.get('partner_ref_id'),
                                vendor: urlParams.get('vendor'),
                                value: urlParams.get('value'),
                                serial: urlParams.get('serial'),
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
            columns: [ {
                field: "ref_transaction_id",
                title: "Ref transaction id"
            }, {
                field: "partner_ref_id",
                title: "Partner ref id",
            },{
                field: "serial",
                title: "Serial",
            },{
                field: "value",
                title: "Value",
            },{
                field: "vendor",
                title: "Vendor",
            },{
                field: "expiry",
                title: "Ng??y h???t h???n"
            },{
                field: "timestamp",
                title: "Ng??y t???o"
            },{
                field: "Actions",
                title: "Thao t??c",
                sortable: !1,
                width: 110,
                overflow: "visible",
                textAlign: "left",
                autoHide: !1,
                template: function(t) {
                    return `<a href="javascript:;" data-id="${t.id}" class="btn-view-detail btn btn-sm btn-clean btn-icon btn-icon-sm" title="View details"><i class="flaticon2-search-1"></i></a>`;
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
                                getDetailTransactionById(transactionId)
                            })
                        })

                        function getDetailTransactionById(id)
                        {
                            if ($('#partnerCardData'+id).length === 0){
                                $.ajax({
                                    type: "get",
                                    url: "/shopcard-card-partner-card-data/detail/"+ id,
                                    data: "html",
                                    success: function (response) {
                                        $('body').append(response);
                                        $('#partnerCardData'+id).modal('show');
                                    }
                                });
                            } else {
                                $('#partnerCardData'+id).modal('show');
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
                        url: "/shopcard-card-partner-card-data/export",
                        data: {
                            query: {
                                ref_transaction_id: $("input[name='ref_transaction_id']").val(),
                                partner_ref_id: $("input[name='partner_ref_id']").val(),
                                vendor: $("input[name='vendor']").val(),
                                value: $("input[name='value']").val(),
                                serial: $("input[name='serial']").val(),
                                startTime: $("input[name='startTime']").val(),
                                endTime: $("input[name='endTime']").val(),
                            },
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            location.href = '/shopcard-card-partner-card-data/download?file=' + response.path;
                            that.attr('disabled', false);
                        },
                        error: function (response) {
                            if (response.status === 403) {
                                window.emitEvent('notify', {type: 'danger', message: 'Kh??ng ???????c ph??p'});
                            }
                        }
                    });
                });
            }
            exportTransaction();
        }))
    }
});
