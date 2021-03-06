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
        var n, o = (n = {
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "https://keenthemes.com/metronic/tools/preview/api/datatables/demos/default.php"
                    }
                },
                pageSize: 10,
                serverPaging: !0,
                serverFiltering: !0,
                serverSorting: !0
            },
            layout: {
                // scroll: !0,
                // height: 350,
                footer: !1
            },
            sortable: !0,
            pagination: !0,
            columns: [{
                field: "RecordID",
                title: "#",
                sortable: !1,
                width: 20,
                selector: {
                    class: "kt-checkbox--solid"
                },
                textAlign: "center"
            }, {
                field: "OrderID",
                title: "TH??NG TIN",
                width: 360,
                template: function(t) {
                    return "<a<strong>" + t.Notes + "</strong>"
                }
            }, {
                field: "Country",
                title: "T???O B???I",
                template: function(t) {
                    return "<a<strong>" + t.Notes + "</strong>"
                }
            }, {
                field: "ShipAddress",
                title: "CH???NH S???A B???I"
            }, {
                field: "Status",
                title: "T??NH TR???NG  ",
                width: 100,
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
                field: "Actions",
                title: "THAO T??C",
                sortable: !1,
                width: 110,
                overflow: "visible",
                textAlign: "left",
                autoHide: !1,
                template: function() {
                    return '                    <div class="dropdown">                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" data-toggle="dropdown">                            <i class="flaticon2-settings"></i>                        </a>                        <div class="dropdown-menu dropdown-menu-right">                            <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>                            <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>                            <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>                        </div>                    </div>                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">                        <i class="flaticon2-file"></i>                    </a>                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete">                        <i class="flaticon2-delete"></i>                    </a>                '
                }
            }]
        }, {
            init: function() {
                ! function() {
                    n.search = {
                        input: $("#generalSearch")
                    };
                    // var t = $("#local_record_selection").KTDatatable(n);
                    // $("#kt_form_status").on("change", (function() {
                    //     t.search($(this).val().toLowerCase(), "Status")
                    // }
                    // )),
                    // $("#kt_form_type").on("change", (function() {
                    //     t.search($(this).val().toLowerCase(), "Type")
                    // }
                    // )),
                    // $("#kt_form_status,#kt_form_type").selectpicker(),
                    // t.on("kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated", (function(e) {
                    //     var a = t.rows(".kt-datatable__row--active").nodes().length;
                    //     $("#kt_datatable_selected_number").html(a),
                    //     a > 0 ? $("#kt_datatable_group_action_form").collapse("show") : $("#kt_datatable_group_action_form").collapse("hide")
                    // }
                    // )),
                    // $("#kt_modal_fetch_id").on("show.bs.modal", (function(e) {
                    //     for (var a = t.rows(".kt-datatable__row--active").nodes().find('.kt-checkbox--single > [type="checkbox"]').map((function(t, e) {
                    //         return $(e).val()
                    //     }
                    //     )), n = document.createDocumentFragment(), o = 0; o < a.length; o++) {
                    //         var r = document.createElement("li");
                    //         r.setAttribute("data-id", a[o]),
                    //         r.innerHTML = "Selected record ID: " + a[o],
                    //         n.appendChild(r)
                    //     }
                    //     $(e.target).find(".kt-datatable_selected_ids").append(n)
                    // }
                    // )).on("hide.bs.modal", (function(t) {
                    //     $(t.target).find(".kt-datatable_selected_ids").empty()
                    // }
                    // ))
                }(),
                function() {
                    n.extensions = {
                            checkbox: {}
                        },
                        n.search = {
                            input: $("#generalSearch1")
                        };
                    var t = $("#server_record_selection").KTDatatable(n);
                    $("#kt_form_status1").on("change", (function() {
                            t.search($(this).val().toLowerCase(), "Status")
                        })),
                        $("#kt_form_type1").on("change", (function() {
                            t.search($(this).val().toLowerCase(), "Type")
                        })),
                        $("#kt_form_status1,#kt_form_type1").selectpicker(),
                        t.on("kt-datatable--on-click-checkbox kt-datatable--on-layout-updated", (function(e) {
                            var a = t.checkbox().getSelectedId().length;
                            $("#kt_datatable_selected_number1").html(a),
                                a > 0 ? $("#kt_datatable_group_action_form1").collapse("show") : $("#kt_datatable_group_action_form1").collapse("hide")
                        })),
                        $("#kt_modal_fetch_id_server").on("show.bs.modal", (function(e) {
                            for (var a = t.checkbox().getSelectedId(), n = document.createDocumentFragment(), o = 0; o < a.length; o++) {
                                var r = document.createElement("li");
                                r.setAttribute("data-id", a[o]),
                                    r.innerHTML = "Selected record ID: " + a[o],
                                    n.appendChild(r)
                            }
                            $(e.target).find(".kt-datatable_selected_ids").append(n)
                        })).on("hide.bs.modal", (function(t) {
                            $(t.target).find(".kt-datatable_selected_ids").empty()
                        }))
                }()
            }
        });
        jQuery(document).ready((function() {
            o.init()
        }))
    }
});