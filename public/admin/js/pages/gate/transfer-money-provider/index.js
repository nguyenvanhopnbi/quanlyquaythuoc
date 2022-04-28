!function (t) {
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
            a.d = function (t, e, n) {
                a.o(t, e) || Object.defineProperty(t, e, {
                    enumerable: !0,
                    get: n
                })
            },
            a.r = function (t) {
                "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
                    value: "Module"
                }),
                        Object.defineProperty(t, "__esModule", {
                            value: !0
                        })
            },
            a.t = function (t, e) {
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
                        a.d(n, o, function (e) {
                            return t[e]
                        }
                        .bind(null, o));
                return n
            },
            a.n = function (t) {
                var e = t && t.__esModule ? function () {
                    return t.default
                } :
                        function () {
                            return t
                        };
                return a.d(e, "a", e),
                        e
            },
            a.o = function (t, e) {
                return Object.prototype.hasOwnProperty.call(t, e)
            },
            a.p = "",
            a(a.s = 703)
}({
    703: function (t, e, a) {
        "use strict";
        var urlParams = new URLSearchParams(window.location.search);
        var n, o = (n = {
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/transfer-money-provider/ajax/get-list",
                        method: 'GET',
                        params: {
                            query: {
                                id: urlParams.get('id'),
                                providerCode: urlParams.get('providerCode'),
                                providerName: urlParams.get('providerName'),
                                startTime: urlParams.get('startTime'),
                                endTime: urlParams.get('endTime')
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
            columns: [{
                    field: "providerId",
                    title: "ID"
                }, {
                    field: "providerCode",
                    title: "Provider Code"
                }, {
                    field: "providerName",
                    title: "Provider Name"
                }, {
                    field: "createdAt",
                    title: "Thời Gian"
                }, {
                    field: "Actions",
                    title: "Thao tác",
                    sortable: !1,
                    width: 110,
                    overflow: "visible",
                    textAlign: "left",
                    template: function (t) {
                        return `<a href="javascript:;" data-id="${t.providerId}" class="btn-view-detail btn btn-sm btn-clean btn-icon btn-icon-sm" title="details"><i class="flaticon2-list-1"></i></a>
                            <a href="/transfer-money-provider/edit/${t.providerId}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details"><i class="flaticon2-pen"></i></a>
                            <a href="/transfer-money-provider/delete/${t.providerId}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete" onclick="return confirm('Bạn có chắc muốn xóa Provider này đi không ???');"><i class="flaticon2-delete"></i></a>`;
                    }
                }]
        }, {
            init: function () {
                !function () {
                    n.search = {
                        input: $("#generalSearch")
                    };
                }(),
                        function () {
                            n.extensions = {
                                checkbox: {}
                            },
                                    n.search = {
                                        input: $("#generalSearch1")
                                    };

                            var t = $("#ajax_data").KTDatatable(n);
                            t.on('kt-datatable--on-layout-updated', function () {
                                $('.btn-view-detail').click(function () {
                                    var transactionId = $(this).data('id');
                                    getDetailTransferMoneyProviderById(transactionId)
                                });
                            });

                            function getDetailTransferMoneyProviderById(id)
                            {
                                if ($('#tranferMoneyProviderId' + id).length === 0) {
                                    $.ajax({
                                        type: "get",
                                        url: "/transfer-money-provider/detail/" + id,
                                        success: function (response) {
                                            $('body').append(response);
                                            $('#tranferMoneyProviderId' + id).modal('show');
                                        }
                                    });
                                } else {
                                    $('#tranferMoneyProviderId' + id).modal('show');
                                }
                            }
                        }()
            }
        });

        jQuery(document).ready((function () {
            o.init();
            $("#ajax_data table").css('overflow-x', 'auto');

            function buildPartnerSelect() {
                if (partnerCode !== '') {
                    $.ajax({
                        type: "get",
                        url: "/partner-partners/ajax/get-list-source",
                        dataType: "json",
                        success: function (response) {
                            buildSelectPartnerCode(response);
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
                            data: function (params) {
                                return {
                                    q: params.term, // search term
                                    page: params.page
                                };
                            },
                            processResults: function (data, params) {
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
                        escapeMarkup: function (markup) {
                            return markup;
                        }, // let our custom formatter work
                        minimumInputLength: 1,
                        templateResult: formatPartner, // omitted for brevity, see the source of this page
                        templateSelection: formatPartnerSelection // omitted for brevity, see the source of this page
                    });
                }
            }

            function formatPartner(repo) {
                if (repo.loading)
                    return repo.text;
                var markup = "<div class='select2-result-repository clearfix'>" +
                        "<div class='select2-result-repository__meta'>" +
                        "<div class='select2-result-repository__title'>" + repo.partner_code + "(" + repo.name + ")" + "</div>";
                return markup;
            }

            function formatPartnerSelection(repo) {
                if (typeof repo.partner_code !== 'undefined') {
                    return repo.partner_code + "(" + repo.name + ")";
                }
                return repo.text;
            }

            function setDefaultDataApplicationId(dataSource)
            {
                $.each(dataSource, function (key, application) {
                    if (application.id == applicationId) {
                        application.selected = true;
                    }
                });
                return dataSource;
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
            function buildSelectPartnerCode(datasource)
            {
                var option = {
                    placeholder: "Nhập partner code",
                    allowClear: true,
                    data: setDefaultData(datasource.items),
                    escapeMarkup: function (markup) {
                        return markup;
                    }, // let our custom formatter work
                    templateResult: formatPartner, // omitted for brevity, see the source of this page
                    templateSelection: formatPartnerSelection // omitted for brevity, see the source of this page
                };
                $("#partnerCode").select2(option);
            }
            function buildSelectApplicationId(datasource)
            {
                var option = {
                    placeholder: "Nhập tên sản phẩm",
                    allowClear: true,
                    data: setDefaultDataApplicationId(datasource.items),
                    escapeMarkup: function (markup) {
                        return markup;
                    }, // let our custom formatter work
                    templateResult: formatApplication, // omitted for brevity, see the source of this page
                    templateSelection: formatApplicationSelection // omitted for brevity, see the source of this page
                };
                $("#applicationId").select2(option);
            }
            function buildApplicationIdSelect(partnerCodeSource = '')
            {
                $.ajax({
                    type: "get",
                    url: "/gate-application/ajax/get-list-source?partnerCode=" + partnerCodeSource,
                    dataType: "json",
                    success: function (response) {
                        buildSelectApplicationId(response);
                    }
                });
            }


            function formatApplication(repo) {
                if (repo.loading)
                    return repo.text;
                var markup = "<div class='select2-result-repository clearfix'>" +
                        "<div class='select2-result-repository__meta'>" +
                        "<div class='select2-result-repository__title'>" + repo.name + "(Application: " + repo.id + ")" + "</div>";
                return markup;
            }

            function formatApplicationSelection(repo) {
                if (typeof repo.name !== 'undefined') {
                    return repo.name + "(Application: " + repo.id + ")";
                }
                return repo.text;
            }

            function buildApplicationId(partnerCodeselected)
            {
                if (applicationId !== '') {
                    buildApplicationIdSelect();
                } else {
                    if (typeof partnerCodeselected !== 'undefined') {
                        partnerCode = partnerCodeselected;
                    }
                    $("#applicationId").select2({
                        placeholder: "Nhập tên sản phẩm",
                        allowClear: true,
                        ajax: {
                            url: "/gate-application/ajax/get-list-source?partnerCode=" + partnerCode,
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    q: params.term, // search term
                                    page: params.page
                                };
                            },
                            processResults: function (data, params) {
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
                        escapeMarkup: function (markup) {
                            return markup;
                        }, // let our custom formatter work
                        minimumInputLength: 1,
                        templateResult: formatApplication, // omitted for brevity, see the source of this page
                        templateSelection: formatApplicationSelection // omitted for brevity, see the source of this page
                    });
                }
            }

            function rebuildApplicationId()
            {
                $('#partner_code').change(function (e) {
                    var partnerCode = $(this).val();
                    applicationId = '';
                    $('#applicationId').empty().trigger("change");
                    $.ajax({
                        type: "get",
                        url: "/gate-application/ajax/get-list-source?partnerCode=" + partnerCode,
                        dataType: "json",
                        success: function (response) {
                            buildSelectApplicationId(response)
                        }
                    });
                    // buildApplicationId(partnerCode);           
                });
            }
            rebuildApplicationId();
            buildApplicationId();
            buildPartnerSelect();
        }));
    }
});