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
        }, s = function () {
            n.removeClass("kt-login--forgot"), n.removeClass("kt-login--signup"), n.addClass("kt-login--signin"), KTUtil.animateClass(n.find(".kt-login__signin")[0], "flipInX animated")
        }, a = function () {
            $("#kt_login_forgot").click((function (e) {
                e.preventDefault(), n.removeClass("kt-login--signin"), n.removeClass("kt-login--signup"), n.addClass("kt-login--forgot"), KTUtil.animateClass(n.find(".kt-login__forgot")[0], "flipInX animated")
            })), $("#kt_login_forgot_cancel").click((function (e) {
                e.preventDefault(), s()
            })), $("#kt_login_signup").click((function (e) {
                e.preventDefault(), n.removeClass("kt-login--forgot"), n.removeClass("kt-login--signin"), n.addClass("kt-login--signup"), KTUtil.animateClass(n.find(".kt-login__signup")[0], "flipInX animated")
            })), $("#kt_login_signup_cancel").click((function (e) {
                e.preventDefault(), s()
            }))
        }, {
            init: function () {
                a(), $("#kt_login_signin_submit").click((function (e) {
                    e.preventDefault();
                    var t = $(this),
                        i = $(this).closest("form");
                    i.validate({
                        rules: {
                            email: {
                                required: !0,
                                email: !0
                            },
                            password: {
                                required: !0
                            }
                        }
                    }), i.valid() && (t.addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !0), i.ajaxSubmit({
                        url: "/login",
                        method: 'POST',
                        success: function (data) {
                            if(data.status === true) {
                                window.location = data.url;
                            } else {
                                setTimeout((function () {
                                    t.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), r(i, "danger", data.msg)
                                }), 15)
                            }
                        }
                    }))
                })), $("#kt_login_signup_submit").click((function (e) {
                    e.preventDefault();
                    var t = $(this),
                        i = $(this).closest("form");
                    i.validate({
                        rules: {
                            fullname: {
                                required: !0
                            },
                            email: {
                                required: !0,
                                email: !0
                            },
                            password: {
                                required: !0
                            },
                            rpassword: {
                                required: !0
                            },
                            agree: {
                                required: !0
                            }
                        }
                    }), i.valid() && (t.addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !0), i.ajaxSubmit({
                        url: "",
                        success: function (e, a, l, o) {
                            setTimeout((function () {
                                t.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), i.clearForm(), i.validate().resetForm(), s();
                                var e = n.find(".kt-login__signin form");
                                e.clearForm(), e.validate().resetForm(), r(e, "success", "Thank you. To complete your registration please check your email.")
                            }), 2e3)
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
                        success: function (data) {
                            if(data.success) {
                                setTimeout((function () {
                                    t.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), i.clearForm(), i.validate().resetForm(), s();
                                    var e = n.find(".kt-login__signin form");
                                    e.clearForm(), e.validate().resetForm(), r(e, "success", data.message)
                                }), 1)
                            } else {
                                setTimeout((function () {
                                    t.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), i.clearForm(), i.validate().resetForm(), s();
                                    var e = n.find(".kt-login__signin form");
                                    e.clearForm(), e.validate().resetForm(), r(e, "danger", data.message)
                                }), 1)
                            }
                        },
                        error: function () {
                            setTimeout((function () {
                                t.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), i.clearForm(), i.validate().resetForm(), s();
                                var e = n.find(".kt-login__signin form");
                                e.clearForm(), e.validate().resetForm(), r(e, "danger", "C?? l???i x???y ra, vui l??ng th??? l???i sau.")
                            }), 1)
                        }
                    }))
                })), $("#kt_reset_password_submit").click((function (e) {
                    e.preventDefault();
                    var t = $(this),
                        i = $(this).closest("form");
                    i.validate({
                        rules: {
                            password: {
                                required: !0,
                                minlength: 5
                            },
                            rpassword: {
                                required: !0,
                                minlength: 5,
                                equalTo: "#password"
                            }
                        }
                    }), i.valid() && (t.addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !0), i.ajaxSubmit({
                        url: "/api/reset-password",
                        method: "PUT",
                        success: function (data) {
                            if(data.success) {
                                window.location = '/login';
                            } else {
                                setTimeout((function () {
                                    t.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), i.clearForm(), i.validate().resetForm(), s();
                                    var e = n.find(".kt-login__signin form");
                                    e.clearForm(), e.validate().resetForm(), r(e, "danger", data.message)
                                }), 1)
                            }
                        },
                        error: function () {
                            setTimeout((function () {
                                t.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), i.clearForm(), i.validate().resetForm(), s();
                                var e = n.find(".kt-login__signin form");
                                e.clearForm(), e.validate().resetForm(), r(e, "danger", 'C?? l???i x???y ra, vui l??ng th??? l???i sau')
                            }), 1)
                        }
                    }))
                })), $("#kt_redirect_login").click((function(e) {
                    window.location = '/login';
                }))
            }
        });
        jQuery(document).ready((function () {
            l.init()
        }))
    }
});