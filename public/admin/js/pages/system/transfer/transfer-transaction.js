var local = {
    table_js: function () {
        var urlParams = new URLSearchParams(window.location.search);
        $("#ajax_data").KTDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/system/transfer-transaction-ajax",
                        method: 'GET',
                        params: {
                            startTime: urlParams.get('startTime'),
                            endTime: urlParams.get('endTime'),
                            log_id: urlParams.get('log_id'),
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
                field: "id",
                title: "#",
                width: 30,
            }, {
                field: "appotapay_trans_id",
                title: "Mã giao dịch"
            }, {
                field: "amount_text",
                title: "Số tiền chuyển",
            }, {
                field: "transfer_amount_text",
                title: "Số tiền đã chuyển",
            }, {
                field: "message",
                title: "Trạng thái",
                template: function (t) {
                    return $('<div>', {
                        class: t.error_code == 0 ? 'text-success' : 'text-danger',
                        text: t.message
                    }).prop('outerHTML');
                }
            }, {
                field: "time",
                title: "Thời gian chuyển",
            }, {
                field: "created_at",
                title: "Thời gian tạo",
            },]

        });
    }
};
$(document).ready(function () {
    local.table_js();
});


function formatRepo(repo) {
    console.log(repo)
    if (repo.loading) {
        return repo.text;
    }
    var $container = $(
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'></div>" +
        "<div class='select2-result-repository__description'><i class='fa fa-credit-card mr-3'></i></div>" +
        "</div>" +
        "</div>" +
        "</div>"
    );

    $container.find(".select2-result-repository__title").text(repo.account_name);
    $container.find(".select2-result-repository__description").append(repo.bank_code + ' - ' + repo.account_no);
    return $container;
}

function formatRepoSelection(repo) {
    if (!repo.id) return repo.text;
    return repo.account_name + ' - ' + repo.bank_code + ' - ' + repo.account_no;
}
