var urlParams = new URLSearchParams(window.location.search);
var datatable = $('#ajax_data').KTDatatable({
    data: {
        type: "remote",
        source: {
            read: {
                url: "/bill-service-category/ajax/get-list",
                method: 'GET',
                params: {
                    query: {
                        categoryCode: urlParams.get('query[categoryCode]'),
                        partnerCode: urlParams.get('query[partnerCode]'),
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
        title: "ID",
        textAlign: "center",
    },

    // {
    //     field: "partnerCode",
    //     title: "Partner Code",
    //     textAlign: "center",
    // },

    // {
    //     field: "providerCode",
    //     title: "Provider Code",
    //     textAlign: "center",
    // },

    {
        field: "categoryCode",
        title: "Mã Danh Mục",
        textAlign: "center",
    }, {
        field: "categoryName",
        title: "Tên Danh Mục",
        textAlign: "center",
    }, {
        field: "description",
        title: "Mô Tả",
        textAlign: "center",
    }, {
        field: "public",
        title: "Public",
        textAlign: "center",
            template: function (t) {
                if (t.public === 'yes') {
                    return '<button type="button" class="btn btn-success btn-elevate btn-pill btn-elevate-air btn-sm">Yes</button>'
                } else {
                    return '<button type="button" class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">No</button>';
                }
            }
    }, {
        field: "Actions",
        title: "THAO TÁC",
        sortable: !1,
        width: 110,
        overflow: "visible",
        textAlign: "left",
        autoHide: !1,
        template: function(t) {
            return `<a href="bill-service-category/edit/${t.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details"><i class=" flaticon2-pen"></i></a>
                    <a href="bill-service-category/delete/${t.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete" onclick="return confirm('Bạn có chắc muốn xóa bill service category này đi không ???');"><i class="flaticon2-delete"></i></a>`;
        }
    }]
});
