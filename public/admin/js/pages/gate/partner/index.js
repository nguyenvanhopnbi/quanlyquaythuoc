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
                        url: "/partner-partners/ajax/get-list",
                        method: 'GET',
                        params: {
                            query : {
                                name: urlParams.get('name'),
                                partner_code: urlParams.get('partner_code'),
                                email: urlParams.get('email'),
                                status: urlParams.get('status'),
                                account_type: urlParams.get('account_type'),
                                phone_number: urlParams.get('phone_number'),
                                email_reconciliation: urlParams.get('emailReconciliation'),
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
                field: "partner_code",
                title: "Partner code"
            },
            {
                field: "email",
                title: "Email",
                width: 200,
            },

            {
                field: "email_reconciliation",
                title: "Email Reconciliation",
                width: 200,
            }
            , {
                field: "phone_number",
                title: "Phone number",
            },{
                field: "balance",
                title: "Balance",
            },{
                field: "status",
                title: "Status",
                template: function(data, type, full, meta) {
                    var a = data.status;
                    var status = {
                        active: {'title': 'Active', 'class': ' kt-badge--success'},
                        blocked: {'title': 'Blocked', 'class': ' kt-badge--danger'},
                        inactive: {'title': 'Inactive', 'class': ' kt-badge--warning'},
                    };
                    if (typeof status[a] === 'undefined') {
                        return data;
                    }
                    return '<span class="kt-badge ' + status[a].class + ' kt-badge--inline kt-badge--pill">' + status[a].title + '</span>';
                },
                autoHide: !1,
            }, {
                field: "account_type",
                title: "Account type",
            },{
                field: "created_at",
                title: "Ngày tạo"
            },{
                field: "Actions",
                title: "Thao tác",
                sortable: !1,
                width: 110,
                overflow: "visible",
                textAlign: "left",
                autoHide: !1,
                template: function(t) {
                    return `<a href="javascript:;" data-id="${t.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm btn-view-detail" title="View details"><i class="flaticon2-search-1"></i></a><a href="partner-partners/edit/${t.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details"><i class="flaticon2-pen"></i></a>
                            <a href="partner-partners/delete/${t.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete" onclick="return confirm('Bạn có chắc muốn xóa partner này đi không ???');"><i class="flaticon2-delete"></i></a>`;
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
                            if ($('#partnerId'+id).length === 0){
                                $.ajax({
                                    type: "get",
                                    url: "/partner-partners/detail/"+ id,
                                    success: function (response) {
                                        $('body').append(response);
                                        $('#partnerId'+id).modal('show');
                                    }
                                });
                            } else {
                                $('#partnerId'+id).modal('show');
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
        }))
    }
});
