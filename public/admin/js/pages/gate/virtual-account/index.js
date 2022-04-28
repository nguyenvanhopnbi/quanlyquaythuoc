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
                        url: "/ebill-virtual-account-virtual-account/ajax/get-list",
                        method: 'GET',
                        params: {
                            query : {
                                accountId: urlParams.get('account_id'),
                                accountNo: urlParams.get('account_no'),
                                accountName: urlParams.get('account_name'),
                                paidAmount: urlParams.get('paid_amount'),
                                startTime: urlParams.get('startTime'),
                                endTime: urlParams.get('endTime'),
                                partnerCode: urlParams.get('partnerCode'),
                                billId: urlParams.get('billId'),
                                providerCode: urlParams.get('providerCode'),
                            }
                        }
                    }
                },
                serverSide: true,
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                saveState: true,
                serverFiltering: true

            },
            layout: {
                theme: 'default',
                scroll: !0,
                footer: !1,
                icons:{
                    pagination: {
                      next: 'la la-angle-right',
                      prev: 'la la-angle-left',
                      first: 'la la-angle-double-left',
                      last: 'la la-angle-double-right',
                      more: 'la la-ellipsis-h'
                    },
                    rowDetail: {
                      expand: 'fa fa-caret-down',
                      collapse: 'fa fa-caret-right'
                    }
                }

            },
            rows: {
                autoHide: !1,
                callback: function(row, data, index){
                    var dataView = data;
                    // console.log(dataView);
                    // if(!data){
                    //     console.log("vao day");
                    // }

                }
            },
            sortable: !0,
            pagination: true,
            columns: [ {
                field: "id",
                title: "Account id",
                autoHide: !1,
            },{
                field: "provider_code",
                title: "Provider code",
                autoHide: !1,
            },{
                field: "account_name",
                title: "Account name",
                autoHide: !1,
            },{
                field: "account_no",
                title: "Account no",
                autoHide: !1,
            },{
                field: "bill_id",
                title: "Bill id",
                autoHide: !1,
            },{
                field: "paid_amount",
                title: "Paid amount",
                autoHide: !1,
            },{
                field: "partner_code",
                title: "Partner code",
                autoHide: !1,
            },{
                field: "created_at",
                title: "Ngày tạo"
            },{
                field: "payment_expiry_time",
                title: "Payment expiry time",
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
                    return `<a href="javascript:;" data-id="${t.id}" class="btn-view-detail btn btn-sm btn-clean btn-icon btn-icon-sm" title="View details"><i class="
                    flaticon2-search-1"></i></a>`;
                }
            }]
        },
        {
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
                                var id = $(this).data('id');
                                getDetailPartnerById(id);
                            })
                        })

                        function getDetailPartnerById(id)
                        {
                            if ($('#virtualAccount'+id).length === 0){
                                $.ajax({
                                    type: "get",
                                    url: "/ebill-virtual-account-virtual-account/detail/"+ id,
                                    success: function (response) {
                                        $('body').append(response);
                                        $('#virtualAccount'+id).modal('show');
                                    }
                                });
                            } else {
                                $('#virtualAccount'+id).modal('show');
                            }
                        }
                    }()
            }
        });
        jQuery(document).ready((function() {
            o.init()
            // console.log();
        }))
    }
});
