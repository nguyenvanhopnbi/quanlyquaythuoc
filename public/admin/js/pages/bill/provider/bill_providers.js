var urlParams = new URLSearchParams(window.location.search);
var datatable = $('#ajax_data').KTDatatable({
    data: {
        type: "remote",
        source: {
            read: {
                url: "/bill-providers/ajax/get-list",
                method: 'GET',
                params: {
                    query: {
                        providerName: urlParams.get('query[providerName]'),
                        startTime: urlParams.get('query[startTime]'),
                        endTime: urlParams.get('query[startEnd]'),
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
        field: "id",
        title: "#",
        sortable: !1,
        width: 20,
        selector: {
            class: "kt-checkbox--solid"
        },
        textAlign: "center"
    }, {
        field: "providerId",
        title: "Provider Id"
    }, {
        field: "providerCode",
        title: "Provider Code",
    }, {
        field: "providerName",
        title: "Provider Name",
    }, {
        field: "created_at",
        title: "Ngày tạo"
    }, {
        field: "Actions",
        title: "THAO TÁC",
        sortable: !1,
        width: 110,
        overflow: "visible",
        textAlign: "left",
        autoHide: !1,
        template: function(t) {
            return `<a href="bill-providers/edit/${t.providerId}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details"><i class=" flaticon2-pen"></i></a>
                    <a href="bill-providers/delete/${t.providerId}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete" onclick="return confirm('Bạn có chắc muốn xóa bill provider này đi không ???');"><i class="flaticon2-delete"></i></a>`;
        }
    }]
});
