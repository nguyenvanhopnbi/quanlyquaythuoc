! function (e) {
    var t = {};

    function i(n) {
        if (t[n]) return t[n].exports;
        var r = t[n] = {
            i: n,
            l: !1,
            exports: {}
        };
        return e[n].call(r.exports, r, r.exports, i), r.l = !0, r.exports
    }
    i.m = e, i.c = t, i.d = function (e, t, n) {
        i.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: n
        })
    }, i.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, i.t = function (e, t) {
        if (1 & t && (e = i(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var n = Object.create(null);
        if (i.r(n), Object.defineProperty(n, "default", {
            enumerable: !0,
            value: e
        }), 2 & t && "string" != typeof e)
            for (var r in e) i.d(n, r, function (t) {
                return e[t]
            }.bind(null, r));
        return n
    }, i.n = function (e) {
        var t = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return i.d(t, "a", t), t
    }, i.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, i.p = "", i(i.s = 723)
}({
    723: function (e, t, i) {
        "use strict";
        var n, r, s, a, l = (n = $("#kt_login"), r = function (e, t, i) {
            var n = $('<div class="alert alert-' + t + ' alert-dismissible" role="alert">\t\t\t<div class="alert-text">' + i + '</div>\t\t\t<div class="alert-close">                <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>            </div>\t\t</div>');
            e.find(".alert").remove(), n.prependTo(e), KTUtil.animateClass(n[0], "fadeIn animated"), n.find("span").html(i)
        }, {
            init: function () {
                $("#btn_update_profile").click((function (e) {
                    e.preventDefault();
                    var t = $(this),
                        i = $(this).closest("form");
                    i.validate({
                        rules: {
                            avatar: {
                            },
                            full_name: {
                                required: !0
                            }
                        }
                    }), i.valid() && (t.addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !0), i.ajaxSubmit({
                        url: "my-profile",
                        method: 'POST',
                        success: function (data) {
                            if(data.success === true) {
                                setTimeout((function () {
                                    t.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), r(i, "success", data.message)
                                }), 15)
                            } else {
                                setTimeout((function () {
                                    t.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), r(i, "danger", data.error.message)
                                }), 15)
                            }
                        },
                        error: function () {
                            setTimeout((function () {
                                t.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), r(i, "danger", 'Có lỗi xảy ra, vui lòng thử lại sau')
                            }), 15)
                        }
                    }))
                })), $("#btn_change_password").click((function (e) {
                    e.preventDefault();
                    var t = $(this),
                        i = $(this).closest("form");
                    i.validate({
                        rules: {
                            password: {
                                required: !0,
                                minlength: 5
                            },
                            new_password: {
                                required: !0,
                                minlength: 5
                            },
                            confirm_new_password: {
                                required: !0,
                                minlength: 5,
                                equalTo: "#new_password"
                            }
                        }
                    }), i.valid() && (t.addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !0), i.ajaxSubmit({
                        url: "/change-password",
                        method: 'PUT',
                        success: function (data) {
                            if(data.success === true) {
                                setTimeout((function () {
                                    t.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), r(i, "success", data.message)
                                }), 15)
                                $('form').trigger("reset");
                            } else {
                                setTimeout((function () {
                                    t.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), r(i, "danger", data.error.message)
                                }), 15)
                            }
                        },
                        error: function () {
                            setTimeout((function () {
                                t.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), r(i, "danger", 'Có lỗi xảy ra, vui lòng thử lại sau')
                            }), 15)
                        }
                    }))
                })), $("#kt_login_forgot_submit").click((function (e) {
                    e.preventDefault();
                    var t = $(this),
                        i = $(this).closest("form");
                    i.validate({
                        rules: {
                            email: {
                                required: !0,
                                email: !0
                            }
                        }
                    }), i.valid() && (t.addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !0), i.ajaxSubmit({
                        url: "/api/reset-password",
                        method: 'POST',
                        success: function (e, a, l, o) {
                            alert('Đường dẫn khôi phục mật khẩu đã được gửi đến email của bạn.');
                            window.location.reload();
                        },
                        error: function () {
                            alert('Có lỗi xảy ra, vui lòng thử lại sau.');
                            window.location.reload();
                        }
                    }))
                })), new KTAvatar("kt_user_avatar")
            }
        });
        jQuery(document).ready((function () {
            l.init()
        }))
    }
});