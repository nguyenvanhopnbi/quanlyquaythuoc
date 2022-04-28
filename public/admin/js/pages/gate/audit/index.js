var urlParams = new URLSearchParams(window.location.search);

var datatable = $('#ajax_data').KTDatatable({
    data: {
        type: "remote",
        source: {
            read: {
                url: "/transfer-money-audit/ajax/get-list",
                method: 'GET',
                params: {
                    query: {
                        partner_code: urlParams.get('partner_code'),
                        startTime: urlParams.get('startTime'),
                        endTime: urlParams.get('endTime'),
                        bank_code: urlParams.get('bank_code'),
                        payment_method: urlParams.get('payment_method'),
                    }
                }
            }
        },
        serverSide : true,
        pageSize: 20,
        serverPaging: !0,
        serverFiltering: false,
    },
    toolbar: {
        items: {
            info: false,
        }
    },
    layout: {
        footer: !1
    },
    sortable: !0,
    pagination: !0,
    columns: [{
        field: "partner_code",
        title: "Partner code"
    },{
        field: "total_amount",
        title: "Total amount",
    },{
        field: "Actions",
        title: "THAO TÁC",
        sortable: !1,
        width: 110,
        overflow: "visible",
        textAlign: "left",
        autoHide: !1,
        template: function(t) {
            return `<button class="btn btn-sm btn-clean btn-icon btn-icon-sm btn-preview-download" data-partner="${t.partner_code}" title="Xem trước file"><i class="fas fa-eye"></i></button>
                    <button class="btn btn-sm btn-clean btn-icon btn-icon-sm btn-download"  data-partner="${t.partner_code}" title="Download file";"><i class="fas fa-file-download"></i></button>`;
        }
    }]
});


datatable.on('kt-datatable--on-layout-updated', function(){
    $('.btn-preview-download').click(function(e){
        var partner_code = $(this).data('partner');
        $.ajax({
            type: "GET",
            url: "/transfer-money-audit/preview",
            data: {
                query:{
                    partner_code: partner_code,
                    startTime: $("input[name='startTime']").val(),
                    endTime: $("input[name='endTime']").val(),
                    bank_code: $("#bank_code").val(),
                    payment_method: $("select[name='payment_method']").val(),
                }
            },
            success: function (response) {
                if (response.error) {
                    KTApp.unprogress(e), swal.fire({
                        title: "",
                        text: response.error.message,
                        type: 'error',
                        confirmButtonClass: "btn btn-secondary"
                    });
                } else {
                    $('body').append(response);
                    $('#preview-download-audit-partner-'+partner_code).modal('show');
                }
            }
        });
    })

    $('.btn-download').click(function(e){
        var partner_code = $(this).data('partner');
        var that = $(this);
        $(this).attr('disabled', true);
        // let startTime = $("input[name='startTime']").val();
        // let endTime = $("input[name='endTime']").val();
        // let bank_code = $("#bank_code").val();
        // let payment_method = $("select[name='payment_method']").val();
        // location.href = "/transfer-money-audit/export?partner_code="+partner_code+"&endTime="+endTime+"&startTime="+startTime +"&bank_code="+bank_code + "&payment_method="+payment_method
        $.ajax({
            type: "GET",
            url: "/transfer-money-audit/export",
            data: {
                query:{
                    partner_code: partner_code,
                    startTime: $("input[name='startTime']").val(),
                    endTime: $("input[name='endTime']").val(),
                    bank_code: $("#bank_code").val(),
                    payment_method: $("select[name='payment_method']").val(),
                }
            },
            success: function (response) {
                location.href = '/transfer-money-audit/download?file='+response.path;
                that.attr('disabled', false)
            },
            error: function (response){
                if (response.status === 403) {
                    window.emitEvent('notify', {type: 'danger', message: 'Không được phép'});
                    return;
                }
                KTApp.unprogress(e), swal.fire({
                    title: "",
                    text: 'Download file không thành công',
                    type: 'error',
                    confirmButtonClass: "btn btn-secondary"
                });
            }
        });
    })
})

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

function setDefaultData(dataSource)
{
    $.each(dataSource, function (key, partner) {
        if (partner.partner_code === partnerCode) {
            partner.selected = true;
        }
    });
    return dataSource;
}

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

buildPartnerSelect();

function buildSelectBankCode(datasource)
{
    var option = {
        placeholder: "Nhập bank code",
        allowClear: true,
        data: setDefaultDataBankCode(datasource.items),
    };
    $("#bank_code").select2(option);
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

buildBankCodeSelect();
