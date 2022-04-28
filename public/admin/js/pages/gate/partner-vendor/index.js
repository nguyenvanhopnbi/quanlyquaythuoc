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
                        url: "/gate-partner-vendor/ajax/get-list",
                        method: 'GET',
                        params: {
                            query : {
                                partner_code: urlParams.get('partner_code'),
                                bank_code: urlParams.get('bank_code'),
                                vendor_code: urlParams.get('vendor_code'),
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
                field: "vendor_code",
                title: "Vendor code",
            },{
                field: "created_at",
                title: "Ngày tạo"
            },{
                field: "updated_at",
                title: "Ngày cập nhật"
            },{
                field: "Actions",
                title: "Thao tác",
                sortable: !1,
                width: 110,
                overflow: "visible",
                textAlign: "left",
                autoHide: !1,
                template: function(t) {
                    return `<a href="gate-partner-vendor/edit/${t.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details"><i class="flaticon2-pen"></i></a>
                            <a href="gate-partner-vendor/delete/${t.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete" onclick="return confirm('Bạn có chắc muốn xóa partner vendor này đi không ???');"><i class="flaticon2-delete"></i></a>`;
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
                    }()
            }
        });
        jQuery(document).ready((function() {
            o.init()
            function buildPartnerSelect(){
                if (partnerCode !== '') {
                    $.ajax({
                        type: "get",
                        url: "/partner-partners/ajax/get-list-source",
                        dataType: "json",
                        success: function (response) {
                            buildSelectPartnerCode(response)
                        }
                    });
                } else {
                    $("#partner_code").select2({
                        placeholder: "Nhập partner name",
                        allowClear: true,
                        ajax: {
                            url: "/partner-partners/ajax/get-list-source",
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {
                                return {
                                    q: params.term, // search term
                                    page: params.page
                                };
                            },
                            processResults: function(data, params) {
                                // parse the results into the format expected by Select2
                                // since we are using custom formatting functions we do not need to
                                // alter the remote JSON data, except to indicate that infinite
                                // scrolling can be used
                                params.page = params.page || 1;
            
                                return {
                                    results: data.items,
                                    pagination: {
                                        more: (params.page * 30) < data.total_count
                                    }
                                };
                            },
                            cache: true
                        },
                        escapeMarkup: function(markup) {
                            return markup;
                        }, // let our custom formatter work
                        minimumInputLength: 1,
                        templateResult: formatPartner, // omitted for brevity, see the source of this page
                        templateSelection: formatPartnerSelection // omitted for brevity, see the source of this page
                    });
                }
            }

            function formatPartner(repo) {
                if (repo.loading) return repo.text;
                var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'>" + repo.partner_code + "(" + repo.name +")"  + "</div>";
                return markup;
            }
    
            function formatPartnerSelection(repo) {
                if(typeof repo.partner_code !== 'undefined'){
                    return repo.partner_code + "(" + repo.name +")";
                }
                return repo.text;
            }

            function buildSelectPartnerCode(datasource)
            {
                var option = {
                    placeholder: "Nhập partner code",
                    allowClear: true,
                    data: setDefaultData(datasource.items),
                    escapeMarkup: function(markup) {
                        return markup;
                    }, // let our custom formatter work
                    templateResult: formatPartner, // omitted for brevity, see the source of this page
                    templateSelection: formatPartnerSelection // omitted for brevity, see the source of this page
                };
                $("#partner_code").select2(option);
            }

            function buildVendorCodeSelect(){
                $.ajax({
                    type: "get",
                    url: "/gate-vendor/ajax/get-list-source",
                    dataType: "json",
                    success: function (response) {
                        buildSelectVendorCode(response)
                    }
                });
            }

            function buildSelectVendorCode(datasource)
            {
                var option = {
                    placeholder: "Nhập vendor code",
                    allowClear: true,
                    data: setDefaultDataVendorCode(datasource.items),
                };
                $("#vendor_code").select2(option);
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

            function setDefaultDataVendorCode(dataSource)
            {
                $.each(dataSource, function (key, bank) {
                    if (bank.vendor_code === vendorCode) {
                        bank.selected = true;
                    }
                });
                return dataSource;
            }

            buildVendorCodeSelect();
            buildPartnerSelect();
        }))
    }
});
