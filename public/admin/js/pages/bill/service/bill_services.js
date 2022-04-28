var urlParams = new URLSearchParams(window.location.search);
var datatable = $('#ajax_data').KTDatatable({
    data: {
        type: "remote",
        source: {
            read: {
                url: "/bill-services/ajax/get-list",
                method: 'GET',
                params: {
                    query: {
                        serviceCode: urlParams.get('query[serviceCode]'),
                        serviceName: urlParams.get('query[serviceName]'),
                        categoryCode: urlParams.get('query[categoryCode]'),
                        public: urlParams.get('query[public]'),
                        startTime: urlParams.get('query[startTime]'),
                        endTime: urlParams.get('query[endTime]')
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
        // scroll: !0,
        // height: 350,
        footer: !1
    },
    sortable: !0,
    pagination: !0,
    columns: [{
            field: "id",
            title: "ID",
            width: 50,
            overflow: "visible",
            textAlign: "center"
        }, {
            field: "icon",
            title: "Ảnh Logo",
            textAlign: "center",
            template: function (t) {
                return `<img src="${t.icon}" width="100" height="100">`;
            }
        }, {
            field: "serviceCode",
            title: "Mã Dịch Vụ",
            textAlign: "center"
        }, {
            field: "serviceName",
            title: "Tên Dịch Vụ",
            textAlign: "center"
        }, {
            field: "description",
            title: "Mô Tả",
            textAlign: "center"
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
            field: "createdAt",
            title: "Thời Gian Tạo",
            textAlign: "center"
        }, {
            field: "updatedAt",
            title: "Thời Gian Cập Nhật",
            textAlign: "center"
        }, {
            field: "Actions",
            title: "THAO TÁC",
            sortable: !1,
            width: 110,
            overflow: "visible",
            textAlign: "center",
            autoHide: !1,
            template: function (t) {
                return `<a href="bill-services/edit/${t.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details"><i class=" flaticon2-pen"></i></a>
                            <a href="bill-services/delete/${t.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete" onclick="return confirm('Bạn có chắc muốn xóa Bill Service này đi không ???');"><i class="flaticon2-delete"></i></a>`;
            }
        }]
});
