var urlParams = new URLSearchParams(window.location.search);
var datatable = $('#ajax_data').KTDatatable({
    data: {
        type: "remote",
        source: {
            read: {
                url: "/bill-provider-config/ajax/get-list",
                method: 'GET',
                params: {
                    query: {
                        providerCode: urlParams.get('query[providerCode]')
                    }
                }
            }
        },
        serverSide : true,
        pageSize: 20,
        serverPaging: !0,
        serverFiltering: false,
    },
    layout: {
        footer: !1
    },
    sortable: !0,
    pagination: !0,
    columns: [{
        field: "providerId",
        title: "Provider Id",
        textAlign: "center",
    }, {
        field: "providerCode",
        title: "Provider Code",
        textAlign: "center",
    }, {
        field: "created_at",
        title: "Thời Gian Tạo",
        textAlign: "center",
    }, {
        field: "updated_at",
        title: "Thời Gian Cập Nhật",
        textAlign: "center",
    }, {
        field: "Actions",
        title: "THAO TÁC",
        sortable: !1,
        width: 110,
        overflow: "visible",
        textAlign: "left",
        autoHide: !1,
        template: function(t) {
            return `<a href="bill-provider-config/edit/${t.providerId}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details"><i class=" flaticon2-pen"></i></a>
                    <a href="bill-provider-config/delete/${t.providerId}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete" onclick="return confirm('Bạn có chắc muốn xóa bill provider config này đi không ???');"><i class="flaticon2-delete"></i></a>`;
        }
    }]
});
