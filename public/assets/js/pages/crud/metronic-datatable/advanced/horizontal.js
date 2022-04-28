! function(t) {
    var e = {};

    function a(i) {
        if (e[i]) return e[i].exports;
        var n = e[i] = {
            i: i,
            l: !1,
            exports: {}
        };
        return t[i].call(n.exports, n, n.exports, a), n.l = !0, n.exports
    }
    a.m = t, a.c = e, a.d = function(t, e, i) {
        a.o(t, e) || Object.defineProperty(t, e, {
            enumerable: !0,
            get: i
        })
    }, a.r = function(t) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(t, "__esModule", {
            value: !0
        })
    }, a.t = function(t, e) {
        if (1 & e && (t = a(t)), 8 & e) return t;
        if (4 & e && "object" == typeof t && t && t.__esModule) return t;
        var i = Object.create(null);
        if (a.r(i), Object.defineProperty(i, "default", {
            enumerable: !0,
            value: t
        }), 2 & e && "string" != typeof t)
            for (var n in t) a.d(i, n, function(e) {
                return t[e]
            }.bind(null, n));
        return i
    }, a.n = function(t) {
        var e = t && t.__esModule ? function() {
            return t.default
        } : function() {
            return t
        };
        return a.d(e, "a", e), e
    }, a.o = function(t, e) {
        return Object.prototype.hasOwnProperty.call(t, e)
    }, a.p = "", a(a.s = 701)
}({
    701: function(t, e, a) {
        "use strict";
        var i = {
            init: function() {
                var t;
                t = $(".kt-datatable").KTDatatable({
                    data: {
                        type: "remote",
                        source: {
                            read: {
                                url: "https://keenthemes.com/metronic/tools/preview/api/datatables/demos/default.php"
                            }
                        },
                        pageSize: 20,
                        serverPaging: !0,
                        serverFiltering: !0,
                        serverSorting: !0
                    },
                    layout: {
                        scroll: !0,
                        height: 550,
                        footer: !1
                    },
                    sortable: !0,
                    filterable: !1,
                    pagination: !0,
                    search: {
                        input: $("#generalSearch")
                    },
                    rows: {
                        autoHide: !1
                    },
                    columns: [{
                        field: "RecordID",
                        title: "#",
                        sortable: !1,
                        width: 20,
                        type: "number",
                        selector: !1,
                        textAlign: "center"
                    }, {
                        field: "OrderID",
                        title: "Order ID"
                    }, {
                        field: "Country",
                        title: "Country",
                        template: function(t) {
                            return t.Country + " " + t.ShipCountry
                        }
                    }, {
                        field: "CompanyEmail",
                        title: "Email",
                        width: 150
                    }, {
                        field: "ShipAddress",
                        title: "Ship Address",
                        width: 200
                    }, {
                        field: "ShipDate",
                        title: "Ship Date",
                        type: "date",
                        format: "MM/DD/YYYY"
                    }, {
                        field: "CompanyName",
                        title: "Company Name",
                        width: 200
                    }, {
                        field: "Status",
                        title: "Status",
                        template: function(t) {
                            var e = {
                                1: {
                                    title: "Pending",
                                    class: "kt-badge--brand"
                                },
                                2: {
                                    title: "Delivered",
                                    class: " kt-badge--danger"
                                },
                                3: {
                                    title: "Canceled",
                                    class: " kt-badge--primary"
                                },
                                4: {
                                    title: "Success",
                                    class: " kt-badge--success"
                                },
                                5: {
                                    title: "Info",
                                    class: " kt-badge--info"
                                },
                                6: {
                                    title: "Danger",
                                    class: " kt-badge--danger"
                                },
                                7: {
                                    title: "Warning",
                                    class: " kt-badge--warning"
                                }
                            };
                            return '<span class="kt-badge ' + e[t.Status].class + ' kt-badge--inline kt-badge--pill">' + e[t.Status].title + "</span>"
                        }
                    }, {
                        field: "Type",
                        title: "Type",
                        autoHide: !1,
                        template: function(t) {
                            var e = {
                                1: {
                                    title: "Online",
                                    state: "danger"
                                },
                                2: {
                                    title: "Retail",
                                    state: "primary"
                                },
                                3: {
                                    title: "Direct",
                                    state: "success"
                                }
                            };
                            return '<span class="kt-badge kt-badge--' + e[t.Type].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + e[t.Type].state + '">' + e[t.Type].title + "</span>"
                        }
                    }, {
                        field: "Actions",
                        title: "Actions",
                        sortable: !1,
                        width: 110,
                        overflow: "visible",
                        autoHide: !1,
                        template: function() {
                            return '\t\t\t\t\t\t\t<div class="dropdown">\t\t\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\t                                <i class="la la-ellipsis-h"></i>\t                            </a>\t\t\t\t\t\t\t    <div class="dropdown-menu dropdown-menu-right">\t\t\t\t\t\t\t        <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\t\t\t\t\t\t\t        <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\t\t\t\t\t\t\t        <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\t\t\t\t\t\t\t    </div>\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\t\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t\t</a>\t\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\t\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t\t</a>\t\t\t\t\t\t'
                        }
                    }]
                }), $("#kt_form_status").on("change", (function() {
                    t.search($(this).val().toLowerCase(), "Status")
                })), $("#kt_form_type").on("change", (function() {
                    t.search($(this).val().toLowerCase(), "Type")
                })), $("#kt_form_status,#kt_form_type").selectpicker()
            }
        };
        jQuery(document).ready((function() {
            i.init()
        }))
    }
});
