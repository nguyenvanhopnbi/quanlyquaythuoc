! function (e) {
    var t = {};

    function r(n) {
        if (t[n]) return t[n].exports;
        var o = t[n] = {
            i: n,
            l: !1,
            exports: {}
        };
        return e[n].call(o.exports, o, o.exports, r), o.l = !0, o.exports
    }
    r.m = e, r.c = t, r.d = function (e, t, n) {
        r.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: n
        })
    }, r.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, r.t = function (e, t) {
        if (1 & t && (e = r(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var n = Object.create(null);
        if (r.r(n), Object.defineProperty(n, "default", {
            enumerable: !0,
            value: e
        }), 2 & t && "string" != typeof e)
            for (var o in e) r.d(n, o, function (t) {
                return e[t]
            }.bind(null, o));
        return n
    }, r.n = function (e) {
        var t = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return r.d(t, "a", t), t
    }, r.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, r.p = "", r(r.s = 727)
}({
    727: function (e, t, r) {
        "use strict";
        var n, o, i, u = {
            init: function () {
                var e;
                n = $("#kt_add_form"), (i = new KTWizard("kt_add", {
                    startStep: 1,
                    clickableSteps: !0
                })), o = n.validate({
                    ignore: ":hidden",
                    rules: {
                        providerName: {
                            required: !0
                        },
                        providerCode: {
                            required: !0
                        }
                    },
                    submitHandler: function (e) {}
                }), (e = n.find('#btn_add')).on("click", (function (t) {
                    t.preventDefault(),
                    hideMessageError();
                    o.form() && (KTApp.progress(e), n.ajaxSubmit({
                        url: "/shopcard-card-items/add",
                        method: 'POST',
                        success: function (data) {
                            KTApp.unprogress(e), swal.fire({
                                title: "",
                                text: data.message,
                                type: 'info',
                                confirmButtonClass: "btn btn-secondary"
                            });
                            $('form').trigger("reset");
                            // $('.progress-header').show();
                        },
                        error: function(response) {
                            var errors = response.responseJSON.error;
                            if (errors.code === 1){
                                showErrorMessage(errors.errors)
                            } else {
                                var message = !errors ? 'Có lỗi xảy ra, vui lòng thử lại sau' : errors.message;
                                KTApp.unprogress(e), swal.fire({
                                    title: "",
                                    text: message,
                                    type: 'error',
                                    confirmButtonClass: "btn btn-secondary"
                                });
                            }
                        }
                    }))
                }))
            }
        };
        function checkProgressCreateCardItem()
        {
            var timer;
            timer = setInterval(() => {
                getProgress(timer)
            }, 1000);
            
            setTimeout(() => {
                KTApp.unprogress(e), swal.fire({
                    title: "",
                    text: 'Thêm card item bị lỗi',
                    type: 'error',
                    confirmButtonClass: "btn btn-secondary"
                });
                clearInterval(timer);
            }, 300000);
        }

        function getProgress(timer)
        {
            $.ajax({
                type: "get",
                url: "/shopcard-card-items/progress",
                dataType: "json",
                success: function (response) {
                    var processPercent = parseInt(response.progressed) / parseInt(response.progress);
                    $('.progress-bar').attr('valuenow', processPercent * 100)
                    $('.progress-bar').css('width', (processPercent * 100) + '%');
                    if( parseInt(processPercent) >= 1){
                        KTApp.unprogress(e), swal.fire({
                            title: "",
                            text: 'Đã xử  lý xong thêm mới card item !',
                            type: 'success',
                            confirmButtonClass: "btn btn-secondary"
                        });
                        clearInterval(timer);
                        return;
                    }
                }
            })  
        }

        function importCardItem()
        {
            $('#btn_import').click(function(){
                $('#card_items').click();
            })

            $('#card_items').change(function(){
                // checkProgressCreateCardItem();
                var form_data = new FormData();
                var img = $('#card_items');
                form_data.append('file', img[0].files[0]);
                form_data.append('vendor', $("select[name='vendor']").val());
                form_data.append('provider_code', $("select[name='provider_code']").val());
                $.ajax({
                    url: "/shopcard-card-items/add/import",
                    data: form_data,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function (data) {
                        KTApp.unprogress(e), swal.fire({
                            title: "",
                            text: data.message,
                            type: 'info',
                            confirmButtonClass: "btn btn-secondary"
                        });
                        // $('form').trigger("reset");
                        // $('.progress-header').show();
                    },
                    error: function (xhr, status, error) {
                       
                    }
                });
            })
        }
        importCardItem();
        jQuery(document).ready((function () {
            u.init()
        }))
    }
});
