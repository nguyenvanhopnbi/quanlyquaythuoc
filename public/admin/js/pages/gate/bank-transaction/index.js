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
                        url: "/gate-bank-transaction/ajax/get-list",
                        method: 'GET',
                        params: {
                            query : {
                                transaction_id: urlParams.get('transaction_id'),
                                application_id: urlParams.get('application_id'),
                                order_id: urlParams.get('order_id'),
                                partner_code: urlParams.get('partner_code'),
                                bank_code: urlParams.get('bank_code'),
                                payment_method: urlParams.get('payment_method'),
                                status: urlParams.get('status'),
                                amount: urlParams.get('amount'),
                                endTime: urlParams.get('endTime'),
                                client_ip: urlParams.get('client_ip'),
                                order_info: urlParams.get('order_info'),
                                startTime: urlParams.get('startTime'),
                                vendor_code: urlParams.get('vendor_code'),
                                vendor_ref_id: urlParams.get('vendor_ref_id'),
                                holding_status: urlParams.get('holding_status'),
                                hasRefund: urlParams.get('hasRefund'),
                            }
                        }
                    }
                },
                serverSide: true,
                pageSize: 20,
                serverPaging: !0,
                serverFiltering: false,
            },
            layout: {
                scroll: !0,
                footer: !1
            },
            rows: {
                autoHide: !1
            },
            sortable: !0,
            pagination: !0,
            columns: [ {
                field: "transaction_id",
                title: "Transaction id",
                autoHide: !1,
                width: 170,
            },

            {
                field: "partner_code",
                title: "Partner code",
                autoHide: !1,
            },{
                field: "amount",
                title: "Amount",
                autoHide: !1,
            },{
                field: "bank_code",
                title: "Bank code",
                autoHide: !1,
            },{
                field: "status",
                title: "Status",
                autoHide: !1,
                template: function(data, type, full, meta) {
                    var a = data.status;
                    var status = {
                        pending: {'title': 'Pending', 'class': ' kt-badge--warning'},
                        success: {'title': 'Success', 'class': ' kt-badge--success'},
                        error: {'title': 'Error', 'class': ' kt-badge--danger'},
                        processing: {'title': 'Processing', 'class': ' kt-badge--primary'},
                        refund: {'title': 'Refund', 'class': ' kt-badge--dark'},
                        cancelled: {'title': 'Cancelled', 'class': ' kt-badge--brown'},
                    };
                    if (typeof status[a] === 'undefined') {
                        return data;
                    }
                    return '<span class="kt-badge ' + status[a].class + ' kt-badge--inline kt-badge--pill">' + status[a].title + '</span>';
                }
            },{
                field: "payment_method",
                title: "Method",
                autoHide: !1,
            },{
                field: "vendor_code",
                title: "Vendor code",
                autoHide: !1,
            },{
                field: "response_time",
                title: "Ngày giao dịch",
                autoHide: !1,
            },

            {
                field: "holding_status",
                title: "Holding Status",
                autoHide: !1,
            },

            {
                field: "has_refund",
                title: "Has Refund",
                autoHide: !1,
            },
            {
                field: "Actions",
                title: "Thao tác",
                sortable: !1,
                width: 110,
                overflow: "visible",
                textAlign: "left",
                autoHide: !1,
                template: function(t) {
                    return `<a href="javascript:;" data-id="${t.transaction_id}" class="btn-view-detail btn btn-sm btn-clean btn-icon btn-icon-sm" title="View details"><i class="
                    flaticon2-search-1"></i></a>`;
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
                                getDetailPartnerById(transactionId)
                            })

                        })
                        t.on('kt-datatable--on-ajax-done', function(event, data, meta){
                            $('.field-total-amount').text(meta.total_amount)
                        })

                        function getDetailPartnerById(id)
                        {
                            if ($('#bankTransactionId'+id).length === 0){
                                $.ajax({
                                    type: "get",
                                    url: "/gate-transaction/detail/"+ id,
                                    success: function (response) {
                                        $('body').append(response);
                                        $('#bankTransactionId'+id).modal('show');
                                        resendIpn();
                                        // openPopupRefund();
                                    }
                                });
                            } else {
                                $('#bankTransactionId'+id).modal('show');
                                resendIpn();
                                // openPopupRefund();
                            }
                        }
                        function resendIpn()
                        {
                            $('.btn-resend-ipn').off("click");
                            $('.btn-resend-ipn').click(function(){
                                var that = $(this);
                                var transactionId = $(this).data('transaction-id');
                                var message = 'Bạn muốn resend ipn giao dịch '+ transactionId;
                                if(confirm(message)){
                                    resendIpnAction(transactionId, that);
                                    that.attr('disabled', true)
                                }
                            })
                        }

                        // function openPopupRefund()
                        // {
                        //     $('.btn-open-refund').off("click");
                        //     $('.btn-open-refund').click(function(){
                        //         let that = $(this);
                        //         let transactionId = $(this).data('transaction-id');
                        //         let maxAmount = $(this).data('amount');
                        //         showPopupRefund(transactionId, that, maxAmount);
                        //     })
                        // }

                        // function showPopupRefund(transactionId, that, maxAmount)
                        // {
                        //     location.href = "/gate-bank-transaction/refund/popup";
                        //     $.ajax({
                        //         type: "get",
                        //         url: "/gate-bank-transaction/refund/popup",
                        //         data: {
                        //             transaction_id: transactionId,
                        //             max_amount: maxAmount
                        //         },
                        //         success: function (response) {
                        //             // $('body').append(response);
                        //             // buildAmoutInput();
                        //             // $('#popup_refund_'+transactionId).modal('show');
                        //             // actionRefund(transactionId);
                        //         }
                        //     });
                        // }

                        function actionRefund(transactionId)
                        {
                            $('.btn-action-refund').off("click");
                            $('.btn-action-refund').click(function(){
                                if(confirm('Bạn muốn refund giao dịch '+ transactionId)){
                                    refundTranactionAction(transactionId)
                                }
                            })
                        }

                        function refundTranactionAction(transactionId)
                        {
                            $.ajax({
                                type: "POST",
                                url: "/gate-bank-transaction/refund",
                                data: {
                                    refund_amount: $('#refund_amount').val(),
                                    refund_reason: $('#refund_reason').val(),
                                    transaction_id: transactionId,
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                },
                                success: function (response) {

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
                            });
                        }
                        function buildAmoutInput()
                        {
                            $("#refund_amount").select2({
                                placeholder: "Nhập số tiền",
                                allowClear: true,
                                width: '100%',
                                ajax: {
                                    url: "source/ajax/get-list-source-amount",
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
                                templateResult: formatAmount, // omitted for brevity, see the source of this page
                                templateSelection: formatAmountSelection // omitted for brevity, see the source of this page
                            });

                            function formatAmount(repo) {
                                if (repo.loading) return repo.text;
                                var markup = "<div class='select2-result-repository clearfix'>" +
                                    "<div class='select2-result-repository__meta'>" +
                                    "<div class='select2-result-repository__title'>" + repo.text  + "</div>";
                                return markup;
                            }

                            function formatAmountSelection(repo) {
                                if(typeof repo.text !== 'undefined'){
                                    return repo.text;
                                }
                                return repo.text;
                            }

                        }

                        function resendIpnAction(transactionId = '', element)
                        {
                            $.ajax({
                                type: "POST",
                                url: "/gate-bank-transaction/resendIpn",
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
                        url: "/partner-partners/ajax/get-list-source?b=true",
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
                                    page: params.page,
                                    b: true
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

            function buildBankCodeSelect(){
                $.ajax({
                    type: "get",
                    url: "/gate-bank/ajax/get-list-source",
                    dataType: "json",
                    success: function (response) {
                        buildSelectBankCode(response)
                    }
                });
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

            function buildApplicationIdSelect()
            {
                $.ajax({
                    type: "get",
                    url: "/gate-application/ajax/get-list-source",
                    dataType: "json",
                    success: function (response) {
                        buildSelectApplicationId(response)
                    }
                });
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

            function setDefaultDataBankCode(dataSource)
            {
                $.each(dataSource, function (key, bank) {
                    if (bank.bank_code === bankCode) {
                        bank.selected = true;
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


            function setDefaultDataApplicationId(dataSource)
            {
                $.each(dataSource, function (key, application) {
                    if (application.id == applicationId) {
                        application.selected = true;
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

            function buildSelectBankCode(datasource)
            {
                var option = {
                    placeholder: "Nhập bank code",
                    allowClear: true,
                    data: setDefaultDataBankCode(datasource.items),
                };
                $("#bank_code").select2(option);
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

            function buildSelectApplicationId(datasource)
            {
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

            function exportTransaction()
            {
                $('#exportTransaction').click(function(e){
                    e.preventDefault();
                    var that = $(this);
                    let columns = [];
                    $(".select-column-checkbox:checked").each((key, item) => columns.push(item.value));
                    if (columns < 1) {
                        that.attr('disabled', false);
                        return;
                    }
                    $.ajax({
                        type: "POST",
                        url: "/gate-bank-transaction/export",
                        data: {
                            query : {
                                transaction_id: $("input[name='transaction_id']").val(),
                                order_id: $("input[name='order_id']").val(),
                                partner_code: $("select[name='partner_code']").val(),
                                bank_code: $("#bank_code").val(),
                                status: $("select[name='status']").val(),
                                amount: $("input[name='amount']").val(),
                                endTime: $("input[name='endTime']").val(),
                                payment_method: $("input[name='payment_method']").val(),
                                startTime: $("input[name='startTime']").val(),
                                client_ip: $("input[name='client_ip']").val(),
                                order_info: $("input[name='order_info']").val(),
                                vendor_code: $("select[name='vendor_code']").val(),
                            },
                            _token:  $('meta[name="csrf-token"]').attr('content'),
                            columns: columns,
                        },
                        success: function (response) {
                            console.log('reponse=', response);
                            if(response.message !== 'success' ) {
                                handleErrorExport();
                                return false;
                            }

                            if(response.key === undefined ) {
                                handleErrorExport();
                                return false;
                            }

                            if(response.cluster === undefined ) {
                                handleErrorExport();
                                return false;
                            }

                            if(response.channelName === undefined ) {
                                handleErrorExport();
                                return false;
                            }

                            if(response.channelEven === undefined ) {
                                handleErrorExport();
                                return false;
                            }

                            var pusher = new Pusher(response.key, {
                                cluster: response.cluster
                            });

                            var channel = pusher.subscribe(response.channelName);
                            channel.bind(response.channelEven, function(data) {
                                console.log('data pusher receive', data);
                                if(data.exportPath === undefined) {
                                    handleErrorExport();
                                    return false;
                                }

                                window.emitEvent('export-ready');
                                location.href = data.exportPath;
                            });
                        },
                        error: function (response) {
                            handleErrorExport();
                            return false;
                        }
                    });



                })
            }

            function formatApplication(repo) {
                if (repo.loading) return repo.text;
                var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'>" + repo.name +"(Application: "+ repo.id +")" + "</div>";
                return markup;
            }

            function handleErrorExport() {
                window.emitEvent('export-ready');
                $('#select-column-modal').modal('toggle');
                window.emitEvent('notify', {type: 'danger', message: 'Đã có lỗi xảy ra, vui lòng thử lại sau'});
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
                }else{
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
                    buildApplicationId(partnerCode);
                });
            }

            rebuildApplicationId();
            buildApplicationId();
            buildPartnerSelect();
            buildBankCodeSelect();
            exportTransaction();

            buildVendorCodeSelect();
        }))
    }
});
