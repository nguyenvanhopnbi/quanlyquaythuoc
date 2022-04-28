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
                        url: "/partner-paygate-config/ajax/get-list",
                        method: 'GET',
                        params: {
                            query : {
                                name: urlParams.get('name'),
                                partner_code: urlParams.get('partner_code'),
                                contract_number: urlParams.get('contract_number'),
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
            }, {
                field: "contract_number",
                title: "Số hợp đồng",
                width: 200,
            }, {
                field: "cc_transaction_fee",
                title: "Phí xử lý GD Quốc Tế(VNĐ)",
            },{
                field: "cc_payment_fee",
                title: "Phí thanh toán Quốc Tế(%)",
            },{
                field: "atm_transaction_fee",
                title: "Phí xử lý GD Nội Địa(VNĐ)",
            },{
                field: "atm_payment_fee",
                title: "Phí thanh toán Nội Địa(%)",
            },{
                field: "ewallet_transaction_fee",
                title: "Phí xử lý GD EWallet(VNĐ)",
            },{
                field: "ewallet_payment_fee",
                title: "Phí thanh toán EWallet(%)",
            },
            {
                field: "ewallet_transaction_appota_fee",
                title: "Phí xử lý GD Ví Appota (VNĐ)",
            },

            {
                field: "ewallet_appota_fee",
                title: "Phí thanh toán Ví Appota (%)",
            },

            {
                field: "cc_transaction_jcb_fee",
                title: "Phí xử lý GD JCB (VNĐ)",
            },

            {
                field: "cc_payment_jcb_fee",
                title: "Phí thanh toán JCB (%)",
            },



            {
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
                    return `<a href="partner-paygate-config/edit/${t.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details"><i class="flaticon2-pen"></i></a>
                            <a href="partner-paygate-config/delete/${t.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete" onclick="return confirm('Bạn có chắc muốn xóa partner paygate config này đi không ???');"><i class="flaticon2-delete"></i></a>`;
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
