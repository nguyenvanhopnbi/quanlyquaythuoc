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
                        url: "user/ajax/get-list",
                        method: 'GET'
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
                field: "id",
                title: "#",
                sortable: !1,
                width: 20,
                selector: {
                    class: "kt-checkbox--solid"
                },
                textAlign: "center"
            }, {
                field: "username",
                title: "User name"
            }, {
                field: "email",
                title: "Email"
            }, {
                field: "full_name",
                title: "Họ tên"
            }, {
                field: "status",
                title: "Status",
                template: function (t) {
                    var e = {
                        'inactive' : 'kt-badge--brand',
                        'deactive' : 'kt-badge--danger',
                        'blocked' : 'kt-badge--warning',
                        'active' : 'kt-badge--success',
                    };
                    return '<span class="kt-badge ' + e[t.status]  + ' kt-badge--inline kt-badge--pill">' + t.status + "</span>"
                }
            }, {
                field: "created_at",
                title: "Ngày tạo"
            }, {
                field: "Actions",
                title: "THAO TÁC",
                sortable: !1,
                width: 110,
                overflow: "visible",
                textAlign: "left",
                autoHide: !1,
                template: function(t) {
                    return `<a href="user/edit/${t.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details"><i class="flaticon2-settings"></i></a>
                            <a href="user/detail/${t.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details"><i class="flaticon2-file"></i></a>
                            <a href="user/delete/${t.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete" onclick="return confirm('Bạn có chắc muốn xóa User này đi không ???');"><i class="flaticon2-delete"></i></a>`;
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
                        $("#kt_form_status").on("change", (function() {
                            t.search($(this).val().toLowerCase(), "status")
                        })),
                        $("#kt_daterangepicker_1").on("change", (function() {
                            t.search($(this).val().toLowerCase(), "created_at")
                        })),
                        $("#kt_form_username").on("change", (function() {
                            t.search($(this).val().toLowerCase(), "username")
                        })),
                        $("#kt_form_email").on("change", (function() {
                            t.search($(this).val().toLowerCase(), "email")
                        })),
                        $("#kt_datatable_delete_all").on("click", (function() {
                            if (!confirm('Bạn có chắc muốn xóa User này đi không ???')) {
                                return false;
                            }
                            var list_checked_id = t.checkbox().getSelectedId();
                            var total_checked_id = list_checked_id.length;
                            if(total_checked_id === 0) return false;
                            $.ajax({
                                url: "user/delete",
                                method: 'GET',
                                data: {
                                    _token: $("input[name='_token']").val(),
                                    ids: list_checked_id,
                                    total: total_checked_id
                                },
                                success: function(){
                                    window.location.reload();
                                },
                                error: function(errors) {
                                    errors = errors.responseJSON;
                                    var message = !errors.error ? 'Có lỗi xảy ra, vui lòng thử lại sau' : errors.error.message;
                                    KTApp.unprogress(e), swal.fire({
                                        title: "",
                                        text: message,
                                        type: 'error',
                                        confirmButtonClass: "btn btn-secondary"
                                    });
                                }
                            });
                        })),
                        $(".kt_datatable_update_status_all").on("click", (function() {
                            var status = $(this).attr('attr');
                            var list_checked_id = t.checkbox().getSelectedId();
                            var total_checked_id = list_checked_id.length;
                            if(total_checked_id === 0) return false;
                            $.ajax({
                                url: "user/edit",
                                method: 'POST',
                                data: {
                                    _token: $("input[name='_token']").val(),
                                    ids: list_checked_id,
                                    total: total_checked_id,
                                    status: status
                                },
                                success: function(){
                                    window.location.reload();
                                },
                                error: function(errors) {
                                    errors = errors.responseJSON;
                                    var message = !errors.error ? 'Có lỗi xảy ra, vui lòng thử lại sau' : errors.error.message;
                                    KTApp.unprogress(e), swal.fire({
                                        title: "",
                                        text: message,
                                        type: 'error',
                                        confirmButtonClass: "btn btn-secondary"
                                    });
                                }
                            });
                        })),
                        $("#kt_form_status").selectpicker(),
                        t.on("kt-datatable--on-click-checkbox kt-datatable--on-layout-updated", (function(e) {
                            var list_checked_id = t.checkbox().getSelectedId();
                            var total_checked_id = list_checked_id.length;
                            $("#kt_datatable_selected_number1").html(total_checked_id),
                            total_checked_id > 0 ? $("#kt_datatable_group_action_form1").collapse("show") : $("#kt_datatable_group_action_form1").collapse("hide")
                        }))
                    }()
            }
        });
        jQuery(document).ready((function() {
            o.init()
        }))
    }
});