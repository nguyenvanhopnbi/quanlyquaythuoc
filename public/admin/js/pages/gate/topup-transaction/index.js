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
                        url: "/topup-transactions/ajax/get-list",
                        method: 'GET',
                        params:{
                            query: {
                                transaction_id: urlParams.get('transaction_id'),
                                partner_ref_id: urlParams.get('partner_ref_id'),
                                partner_code: urlParams.get('partner_code'),
                                application_id: urlParams.get('application_id'),
                                phone_number: urlParams.get('phone_number'),
                                telco: urlParams.get('telco'),
                                telco_service_type: urlParams.get('telco_service_type'),
                                amount: urlParams.get('amount'),
                                status: urlParams.get('status'),
                                topup_status: urlParams.get('topup_status'),
                                startTime: urlParams.get('startTime'),
                                endTime: urlParams.get('endTime'),
                                provider_code: urlParams.get('provider_code'),
                                provider_ref_id: urlParams.get('provider_ref_id'),
                            }
                        }
                    }
                },
                pageSize: 20,
                serverPaging: !0,
                serverFiltering: false,
                serverSorting: !0,
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
                field: "transaction_id",
                title: "Transaction id",
                width: 250,
            }, {
                field: "partner_code",
                title: "Partner code",
            },{
                field: "phone_number",
                title: "Phone number",
            },{
                field: "amount",
                title: "Amount",
            },{
                field: "topup_value",
                title: "Topup value",
            },{
                field: "status",
                title: "Status",
                template: function(data, type, full, meta) {
                    var a = data.status;
                    var status = {
                        success: {'title': 'Success', 'class': ' kt-badge--success'},
                        error: {'title': 'Error', 'class': ' kt-badge--danger'},
                        pending: {'title': 'Pending', 'class': ' kt-badge--warning'},
                        processing: {'title': 'Processing', 'class': ' kt-badge--info'},
                        refund: {'title': 'Refund', 'class': ' kt-badge--primary'},
                        cancel: {'title': 'Cancel', 'class': ' kt-badge--dark'},
                    };
                    if (typeof status[a] === 'undefined') {
                        return data;
                    }
                    return '<span class="transaction_status_'+ data.transaction_id +' kt-badge ' + status[a].class + ' kt-badge--inline kt-badge--pill">' + status[a].title + '</span>';
                },
            },{
                field: "topup_status",
                title: "Topup Status",
                template: function(data, type, full, meta) {
                    var a = data.topup_status;
                    var status = {
                        success: {'title': 'Success', 'class': ' kt-badge--success'},
                        error: {'title': 'Error', 'class': ' kt-badge--danger'},
                        pending: {'title': 'Pending', 'class': ' kt-badge--warning'},
                        processing: {'title': 'Processing', 'class': ' kt-badge--info'},
                        refund: {'title': 'Refund', 'class': ' kt-badge--primary'},
                        cancel: {'title': 'Cancel', 'class': ' kt-badge--dark'},
                    };
                    if (typeof status[a] === 'undefined') {
                        return data;
                    }
                    return '<span class="kt-badge ' + status[a].class + ' kt-badge--inline kt-badge--pill">' + status[a].title + '</span>';
                },
            },{
                field: "telco",
                title: "Telco",
            },{
                field: "provider_code",
                title: "Provider code",
            },{
                field: "topup_time",
                title: "Ngày giao dịch",
            },{
                field: "Actions",
                title: "Thao tác",
                sortable: !1,
                width: 110,
                overflow: "visible",
                textAlign: "left",
                template: function(t) {
                    return `<a href="javascript:;" data-id="${t.transaction_id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm btn-view-detail" title="View details"><i class=" flaticon2-search-1"></i></a>`;
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
                                getDetailTopupTransactionById(transactionId)
                            })
                        })
                        t.on('kt-datatable--on-ajax-done', function(event, data, meta){
                            $('.field-total-amount').text(meta.total_amount)
                        })

                        function getDetailTopupTransactionById(id)
                        {
                            if ($('#topupTransactionId'+id).length === 0){
                                $.ajax({
                                    type: "get",
                                    url: "/topup-transactions/detail/"+ id,
                                    success: function (response) {
                                        $('body').append(response);
                                        $('#topupTransactionId'+id).modal('show');
                                        refundTransaction();
                                    }
                                });
                            } else {
                                $('#topupTransactionId'+id).modal('show');
                                refundTransaction();
                            }
                        }

                        function refundTransaction()
                        {
                            $('.btn-refund').off("click");
                            $('.btn-refund').click(function(){
                                var that = $(this);
                                var transactionId = $(this).data('transaction-id');
                                var message = 'Bạn muốn refund giao dịch '+ transactionId;
                                if(confirm(message)){
                                    resendIpnAction(transactionId, that);
                                    that.attr('disabled', true)
                                }
                            })
                        }

                        function resendIpnAction(transactionId = '', element)
                        {
                            $.ajax({
                                type: "POST",
                                url: "/topup-transactions/refund",
                                data: {
                                    transaction_id: transactionId,
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                },
                                success: function (response) {
                                    element.attr('disabled', false)
                                    if (response.success) {
                                        KTApp.unprogress(e), swal.fire({
                                            title: "",
                                            text: response.message,
                                            type: 'success',
                                            confirmButtonClass: "btn btn-secondary"
                                        });
                                        rebuildStatusBadge(transactionId);
                                    }else{
                                        KTApp.unprogress(e), swal.fire({
                                            title: "",
                                            text: response.message,
                                            type: 'error',
                                            confirmButtonClass: "btn btn-secondary"
                                        });
                                    }
                                }
                            });
                        }

                        function rebuildStatusBadge(transactionId)
                        {
                            $('.transaction_status_'+transactionId).parent().html("<span class='kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill'>Refund</span>");
                        }
                    }()
            }
        });
        jQuery(document).ready((function() {
            o.init()
            $("#ajax_data table").css('overflow-x', 'auto');

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
                    escapeMarkup: function(markup) {
                        return markup;
                    }, // let our custom formatter work
                    templateResult: formatPartner, // omitted for brevity, see the source of this page
                    templateSelection: formatPartnerSelection // omitted for brevity, see the source of this page
                };
                $("#partner_code").select2(option);
            }
            function buildSelectApplicationId(datasource)
            {
                var first_option = {
                    id: '',
                    name: 'Chọn sản phẩm'
                };
                datasource.items.unshift(first_option);
                var option = {
                    placeholder: "Nhập tên sản phẩm",
                    allowClear: true,
                    data: setDefaultDataApplicationId(datasource.items),
                    escapeMarkup: function(markup) {
                        return markup;
                    }, // let our custom formatter work
                    templateResult: formatApplication, // omitted for brevity, see the source of this page
                    templateSelection: formatApplicationSelection // omitted for brevity, see the source of this page
                };
                $("#application_id").select2(option);
            }

            function reBuildSelectApplicationId(datasource)
            {
                var option = {
                    placeholder: "Nhập tên sản phẩm",
                    allowClear: true,
                    data: datasource.items,
                    escapeMarkup: function(markup) {
                        return markup;
                    }, // let our custom formatter work
                    templateResult: formatApplication, // omitted for brevity, see the source of this page
                    templateSelection: formatApplicationSelection // omitted for brevity, see the source of this page
                };
                console.log('in function reBuildAId', option);
                $("#application_id").select2(option);
                console.log('end rebuild');
            }
            function buildApplicationIdSelect(partnerCodeSource = '')
            {
                $.ajax({
                    type: "get",
                    url: "/gate-application/ajax/get-list-source?partnerCode="+partnerCodeSource,
                    dataType: "json",
                    success: function (response) {
                        buildSelectApplicationId(response)
                    }
                });
            }


            function formatApplication(repo) {
                if (repo.loading) return repo.text;
                var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'>" + repo.name +"(Application: "+ repo.id +")" + "</div>";
                return markup;
            }

            function formatApplicationSelection(repo) {
                if(typeof repo.name !== 'undefined'){
                    return repo.name +"(Application: "+ repo.id +")";
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
                }
            }

            function rebuildApplicationId()
            {
                $('#partner_code').change(function (e) {
                    var partnerCode = $(this).val();
                    applicationId = '';
                    $('#application_id').empty().trigger("change");
                    $.ajax({
                        type: "get",
                        url: "/gate-application/ajax/get-list-source?partnerCode="+partnerCode,
                        dataType: "json",
                        success: function (res) {
                            buildSelectApplicationId(res)
                        }
                    });
                    // buildApplicationId(partnerCode);
                });
            }
            rebuildApplicationId();
            buildApplicationId();
            buildPartnerSelect();

            function exportTransaction()
            {
                $('#exportTransaction').click(function(e){
                    e.preventDefault();
                    var that = $(this);
                    that.attr('disabled', true)
                    $.ajax({
                        type: "POST",
                        url: "/topup-transactions/export",
                        data: {
                            query : {
                                transaction_id: $("input[name='transaction_id']").val(),
                                partner_ref_id: $("input[name='partner_ref_id']").val(),
                                partner_code: $("#partner_code").val(),
                                application_id: $("#application_id").val(),
                                phone_number: $("input[name='phone_number']").val(),
                                telco: $("select[name='telco']").val(),
                                telco_service_type: $("select[name='telco_service_type']").val(),
                                status: $("select[name='status']").val(),
                                topup_status: $("select[name='topup_status']").val(),
                                amount: $("input[name='amount']").val(),
                                startTime: $("input[name='startTime']").val(),
                                endTime: $("input[name='endTime']").val(),
                                provider_code: $("select[name='provider_code']").val(),
                            },
                            _token:  $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            location.href = '/topup-transactions/download?file='+response.path;
                            that.attr('disabled', false)
                        },
                        error: function (response) {
                            if (response.status === 403) {
                                window.emitEvent('notify', {type: 'danger', message: 'Không được phép'});
                            }
                        }
                    });



                })
            }
            exportTransaction();
        }))
    }
});
