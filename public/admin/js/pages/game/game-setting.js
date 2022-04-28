var t;
var statusColors = {
    pending: 'info',
    approved: 'success',
    rejected: 'danger',
};

var statusText = {
    pending: 'Chưa duyệt',
    approved: 'Đã duyệt',
    rejected: 'Đã từ chối',
};

var local = {
    load_input: function () {

    },
    form_js: function () {
        var dataPartner, dataApp;
        $('.select2_default').select2({});

        $.ajax({
            url: '/game/partner-list-ajax',
            success: function (data) {
                dataPartner = data;
            },
            async: false
        });

        $.ajax({
            url: '/game/applications',
            success: function (data) {
                dataApp = data;
            },
            async: false
        });


        $("#partnerCode").select2({
            cacheDataSource: [],
            placeholder: "Nhập partner code",
            allowClear: true,
            data: dataPartner.results,
            // ajax: {
            //     url: "/game/partner-list-ajax",
            //     dataType: 'json',
            //     delay: 3000,
            //     data: function (params) {
            //         return {
            //             q: params.term, // search term
            //             page: params.page
            //         };
            //     },
            //     processResults: function (data, params) {
            //         // parse the results into the format expected by Select2
            //         // since we are using custom formatting functions we do not need to
            //         // alter the remote JSON data, except to indicate that infinite
            //         // scrolling can be used
            //         params.page = params.page || 1;
            //
            //         return {
            //             results: data.results,
            //             pagination: {
            //                 more: (params.page * 30) < data.total_count
            //             }
            //         };
            //     },
            //     cache: true
            // },
            matcher: matchCustomPartner,
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            // minimumInputLength: 0,
            templateResult: formatPartner, // omitted for brevity, see the source of this page
            templateSelection: formatPartnerSelection // omitted for brevity, see the source of this page
        });

        $("#applicationId").select2({
            placeholder: "Nhập kênh bán",
            allowClear: true,
            data: dataApp.results,
            matcher: matchCustomApplication,
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            // minimumInputLength: 0,
            templateResult: formatApp, // omitted for brevity, see the source of this page
            templateSelection: formatAppSelection // omitted for brevity, see the source of this page
        });

        function matchCustomPartner(params, data) {
            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (!data.partner_code || typeof data.partner_code === 'undefined') {
                return null;
            }

            // `params.term` should be the term that is used for searching
            // `data.text` is the text that is displayed for the data object
            if (data.partner_code.indexOf(params.term) > -1) {
                var modifiedData = $.extend({}, data, true);
                // modifiedData.text += ' (matched)';

                // You can return modified objects from here
                // This includes matching the `children` how you want in nested data sets
                return modifiedData;
            }

            // Return `null` if the term should not be displayed
            return null;
        }

        function matchCustomApplication(params, data) {
            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (!data.name || typeof data.name === 'undefined') {
                return null;
            }

            // `params.term` should be the term that is used for searching
            // `data.text` is the text that is displayed for the data object
            if (data.name.indexOf(params.term) > -1) {
                var modifiedData = $.extend({}, data, true);
                // modifiedData.text += ' (matched)';

                // You can return modified objects from here
                // This includes matching the `children` how you want in nested data sets
                return modifiedData;
            }

            // Return `null` if the term should not be displayed
            return null;
        }

        function formatPartner(repo) {
            if (repo.loading) return repo.text;

            var $container = $(
                "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title font-weight-bold'></div>" +
                "</div>" +
                "</div>" +
                "</div>"
            );

            $container.find(".select2-result-repository__title").text(repo.partner_code + "(" + repo.name + ")");
            return $container;
        }

        function formatPartnerSelection(repo) {
            if (typeof repo.partner_code !== 'undefined') {
                return repo.partner_code + "(" + repo.name + ")";
            }
            return repo.text;
        }

        function formatApp(repo) {
            if (repo.loading) return repo.text;

            var $container = $(
                "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title font-weight-bold'></div>" +
                "</div>" +
                "</div>" +
                "</div>"
            );

            $container.find(".select2-result-repository__title").text(repo.name);
            return $container;
        }

        function formatAppSelection(repo) {
            if (typeof repo.name !== 'undefined') {
                return repo.name;
            }
            return repo.text;
        }
    },
    get_filter: function () {
        var urlParams = new URLSearchParams(window.location.search);

        return {
            request_type: 'ajax',
            partner_code: urlParams.get('partner_code'),
            game_id: urlParams.get('game_id'),
            active: urlParams.get('active'),
            status: urlParams.get('status'),
            game_name: urlParams.get('game_name'),
            application_id: urlParams.get('application_id'),
            fd: urlParams.get('startTime'),
            td: urlParams.get('endTime'),
        }
    },
    table_js: function () {
        var urlParams = new URLSearchParams(window.location.search);
        var table = $("#ajax_data").KTDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/game/settings",
                        method: 'GET',
                        params: local.get_filter()
                    }
                },
                pageSize: 20,
                serverPaging: !0,
                serverFiltering: false,
                serverSorting: !0,
                saveState: false
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
                title: 'Game ID',
                width: 50,
                template: function (t) {
                    return t.id || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "game_image",
                title: 'Hình ảnh',
                width: 80,
                template: function (t) {
                    var path = t.icon_url + t.icon_path;
                    return `<div class="gameImageWrap"><img src="${path}" class="gameImage"/></div>`;
                }
            }, {
                field: "game_name",
                title: 'Tên game',
                template: function (t) {
                    return '<b>' + t.game_name + '</b>' || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "application_id",
                title: 'Kênh bán',
                template: function (t) {
                    return t.application_name || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "partner_code",
                title: 'Partner code',
                template: function (t) {
                    return t.partner_code || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "active",
                title: 'Hoạt động',
                template: function (t) {
                    return t.active ? '<label class="badge badge-success">Hoạt động</label>' : '<label class="badge badge-warning">Chưa hoạt động</label>';
                }
            }, {
                field: "status",
                title: 'Trạng thái duyệt',
                template: function (t) {
                    var color = statusColors[t.status] ?? 'default';
                    var status = statusText[t.status] ?? t.status;
                    return t.status ? `<label class="badge badge-${color}">` + status + '</label>' : '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "created_at",
                title: 'Ngày tạo',
                template: function (t) {
                    return t.created_at ? t.created_at : '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "",
                title: 'Thao tác',
                template: function (t, index) {
                    btn = `<a class="btn-view-detail btn btn-sm btn-clean btn-icon btn-icon-sm mx-2" data-id="${index}" title="Chi tiết"><i class="flaticon2-search-1"></i></a>`;
                    btn += `<a class="btn-edit btn btn-sm btn-clean btn-icon btn-icon-sm mx-2" data-id="${index}" title="Cập nhật"><i class="flaticon2-edit"></i></a>`;
                    return btn;
                }
            },
            ]
        });

        table.on('kt-datatable--on-layout-updated', function () {
            $('.btn-view-detail').click(function () {
                var index = $(this).attr('data-id');
                getDetailLog(index);
            });
            $('.btn-edit').click(function () {
                var index = $(this).attr('data-id');
                updateItem(index);
            });

        });
        function updateItem(index) {
            var rowData = table.row().data();
            if (!rowData.KTDatatable.dataSet) return;
            var data = rowData.KTDatatable.dataSet;
            var t = data[index];
            var $modal = $('#modal-update');

            var contents = {
                id: t.id || empty(),
                game_name: t.game_name,
                server_url: t.server_url,
                role_url: t.role_url,
                package_url: t.package_url,
                notify_url: t.notify_url,
            };
            $.each(contents, (col, val) => {
                replaceInput(col, val)
            });
            $modal.find(`[name="status"] option[value="${t.status}"]`).prop('selected', true)
            $modal.find(`[name="active"] option[value="${t.active}"]`).prop('selected', true)
            g.resetOutput($modal)
            $('#btnUpdateSubmit').off().click(function () {
                $.ajax({
                    type: "post",
                    url: "/game/setting/" + t.id + "/update",
                    data: $modal.find('form').serialize(),
                    success: function (response) {
                        g.alert(response.message)
                        $modal.modal('hide');
                        table.reload();
                    },
                    error: function (err) {
                        var res = err.responseJSON;
                        g.alert(res.message || 'Lỗi xảy ra', 'danger')
                        var outputData = {};
                        $.each(res.data, function (input_name, message) {
                            var key = '[name="' + input_name + '"]';
                            outputData[key] = message;
                        });
                        g.output($modal, outputData);
                    }
                });
            })

            $modal.modal('show');
        }

        function getDetailLog(index) {
            var rowData = table.row().data();
            if (!rowData.KTDatatable.dataSet) return;
            var data = rowData.KTDatatable.dataSet;
            var t = data[index];
            var $modal = $('#modal-detail');

            var contents = {
                id: t.id || empty(),
                game_name: t.game_name || empty(),
                partner_code: t.partner_code || empty(),
                active_text: `<label class="badge badge-${t.active ? 'success' : 'warning'}">` + t.active_text + '</label>',
                status_text: `<label class="badge badge-${t.status_color}">` + t.status_text + '</label>',
                created_at: t.created_at || empty(),
                server_url: t.server_url,
                role_url: t.role_url,
                package_url: t.package_url,
                notify_url: t.notify_url,
                application_name: t.application_name,
                id: t.id || empty(),
            };
            $.each(contents, (col, val) => {
                replaceContent(col, val)
            });
            if (t.status === 'pending') {
                $('#groupApprove').show();
                // event click send approve request
                $('#groupApprove [data-value]').off().click(function () {
                    var status = $(this).attr('data-value');
                    g.confirm('Xác nhận', $(this).text(), function () {
                        $.ajax({
                            type: "post",
                            url: "/game/setting/" + t.id + "/approve",
                            data: {
                                status: status
                            },
                            success: function (response) {
                                g.alert(response.message)
                                $modal.modal('hide');
                                table.reload();
                            },
                            error: function (err) {
                                g.alert('Lỗi xảy ra', 'error')
                            }
                        });
                    });
                });


            } else {
                $('#groupApprove').hide();
            }
            if (t.status === 'approved') {
                $('#groupActive').show();
                $('#groupActive [data-value!="' + t.active + '"]').show();
                $('#groupActive [data-value="' + t.active + '"]').hide();
                g.loading()
                // event click send active request
                $('#groupActive [data-value]').off().click(function () {
                    var active = $(this).attr('data-value');
                    g.confirm('Xác nhận', $(this).text(), function () {
                        $.ajax({
                            type: "post",
                            url: "/game/setting/" + t.id + "/active",
                            data: {
                                active: active
                            },
                            success: function (response) {
                                g.alert(response.message)
                                $modal.modal('hide');
                                table.reload();
                                g.loading(false)
                            },
                            error: function (err) {
                                g.alert('Lỗi xảy ra', 'error')
                            }
                        });
                    })
                });
            } else {
                $('#groupActive').hide();
            }

            $modal.modal('show');
        }

        function replaceContent(col, value) {
            $('#modal-detail').find(`[col="${col}"]`).html(value);
        }

        function replaceInput(col, value) {
            $('#modal-update').find(`input[name="${col}"]`).val(value);
        }

        function empty() {
            return '<div class="text-secondary">[trống]</div>'
        }
    },
    export: () => {
        var urlParams = new URLSearchParams(window.location.search);
        $('.btn-export-flash-chart').click(function (e) {
            e.preventDefault();
            g.alert('Đang yêu cầu tải xuống...', 'info')
            var that = $(this);
            that.attr('disabled', true)
            $.ajax({
                type: "GET",
                url: "/game/settings",
                data: {
                    request_type: 'export',
                    partner_code: urlParams.get('partner_code'),
                    order_id: urlParams.get('order_id'),
                    payment_method: urlParams.get('payment_method'),
                    status: urlParams.get('status'),
                    transaction_id: urlParams.get('transaction_id'),
                    application_id: urlParams.get('application_id'),
                    fd: urlParams.get('startTime'),
                    td: urlParams.get('endTime'),
                },
                success: function (response) {
                    if (response.code == 200) {
                        location.href = '/game/settings?request_type=download&file=' + response.path;
                        that.attr('disabled', false)
                    } else {
                        that.attr('disabled', false)
                        window.emitEvent('notify', {type: 'danger', message: 'Lỗi hệ thống'});
                    }
                },
                error: function (response) {
                    if (response.status === 403) {
                        window.emitEvent('notify', {type: 'danger', message: 'Không được phép'});
                    }
                }
            });
        });
    }

};
$(document).ready(function () {
    // local.load_input();
    local.form_js();
    local.table_js();
    local.export();
});

