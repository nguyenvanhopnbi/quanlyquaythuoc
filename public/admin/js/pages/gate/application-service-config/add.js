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
                        url: "/gate-application-service-config/add",
                        method: 'POST',
                        success: function (data) {
                            KTApp.unprogress(e), swal.fire({
                                title: "",
                                text: data.message,
                                type: 'success',
                                confirmButtonClass: "btn btn-secondary"
                            });
                            $('form').trigger("reset");
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
        jQuery(document).ready((function () {
            u.init()
            
            function formatApplication(repo) {
                if (repo.loading) return repo.text;
                var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'>" + repo.name +"(Partner: "+ repo.partner_code +")" + "</div>";
                return markup;
            }
    
            function formatApplicationSelection(repo) {
                if(typeof repo.name !== 'undefined'){
                    return repo.name +"(Partner: "+ repo.partner_code +")";
                }
                return repo.text;
            }

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

            function getPartnerCode()
            {
                $('#partner_code').change(function (e) { 
                    var partnerCode = $(this).val()
                    if(partnerCode !== null){
                        $("#application_id").select2({
                            placeholder: "Nhập tên sản phẩm",
                            allowClear: true,
                            ajax: {
                                url: "/gate-application/ajax/get-list-source?partnerCode="+partnerCode,
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
                            templateResult: formatApplication, // omitted for brevity, see the source of this page
                            templateSelection: formatApplicationSelection // omitted for brevity, see the source of this page
                        });
                    }else {
                        $("#application_id").select2('destroy');
                    }
                });
            }
            getPartnerCode();
        }))
    }
});
