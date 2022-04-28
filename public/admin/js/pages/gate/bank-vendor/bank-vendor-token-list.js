var t;
$.fn.modal.Constructor.prototype._enforceFocus = function () {
};
var statusColors = {
    active: 'success',
    inactive: 'danger',
};
var table;

var local = {
    load_input: function () {

    },
    form_js: function () {
        var dataPartner;
        $('.select2_default').select2({});

        $.ajax({
            url: '/partner/bank-account/partners',
            success: function (data) {
                dataPartner = data;
            },
            async: false
        });

        $("#partnerCode").select2({
            cacheDataSource: [],
            placeholder: "Nhập partner code",
            allowClear: true,
            data: dataPartner.results,
            matcher: matchCustomPartner,
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            // minimumInputLength: 0,
            templateResult: formatPartner, // omitted for brevity, see the source of this page
            templateSelection: formatPartnerSelection // omitted for brevity, see the source of this page
        });

        $("#modalPartnerCode").select2({
            cacheDataSource: [],
            placeholder: "Nhập partner code",
            allowClear: true,
            data: dataPartner.results,
            matcher: matchCustomPartner,
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            // minimumInputLength: 0,
            templateResult: formatPartner, // omitted for brevity, see the source of this page
            templateSelection: formatPartnerSelection // omitted for brevity, see the source of this page
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
            if (data.partner_code.toLowerCase().indexOf(params.term.toLowerCase()) > -1 || data.name.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
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

    },
    get_filter: function (merge) {
        var urlParams = new URLSearchParams(window.location.search);
        return Object.assign({
            bbds_id: urlParams.get('bbds_id'),
            id: urlParams.get('id'),
            partner_code: urlParams.get('partner_code'),
            bank_code: urlParams.get('bank_code'),
            vendor_code: urlParams.get('vendor_code'),
            status: urlParams.get('status'),
            status_3ds: urlParams.get('status_3ds'),
            card_number: urlParams.get('card_number'),
            card_name: urlParams.get('card_name'),
            card_type: urlParams.get('card_type'),
            fd: urlParams.get('fd'),
            td: urlParams.get('td'),
        }, merge)
    },
    table_js: function () {
        table = $("#ajax_data").KTDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/gate-vendor-token-list",
                        method: 'GET',
                        params: local.get_filter({request_type: 'ajax'})
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
                title: 'ID',
                width: 50,
                template: function (t) {
                    return t.id || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "partner_code",
                title: 'Partner code',
                template: function (t) {
                    return t.partner_code || '<div class="text-secondary">[Trống]</div>';
                }
            },{
                field: "vendor_code",
                title: 'Vendor code',
                template: function (t) {
                    return t.vendor_code || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "bank_code",
                title: 'Bank code',
                template: function (t) {
                    return t.bank_code || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "vendor_token",
                title: 'Vendor Token',
                template: function (t) {
                    return t.vendor_token || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "card_name",
                title: 'Card Name',
                template: function (t) {
                    return t.card_name || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "card_number",
                title: 'Card number',
                textAlign: 'center',
                template: function (t) {
                    return t.card_number || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "status",
                title: 'Trạng thái',
                textAlign: 'center',
                template: function (t) {
                    return `<label class="badge badge-${statusColors[t.status] || 'default'}">${t.status}</label>` || '<div class="text-secondary">[Trống]</div>';
                }
            }, {
                field: "",
                title: 'Thao tác',
                template: function (t, index) {
                    btn = `<a class="btn-view-detail btn btn-sm btn-clean btn-icon btn-icon-sm mx-2" data-id="${index}"><i class="flaticon2-search-1"></i></a>`;
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
        });
        // t.on('kt-datatable--on-ajax-done', function(event, data, meta){
        //     $('.field-total-amount').text(meta.total_amount)
        // })
        var $modal = $('#modal-detail');

        function getDetailLog(index) {
            var rowData = table.row().data();
            if (!rowData.KTDatatable.dataSet) return;
            var data = rowData.KTDatatable.dataSet;
            var t = data[index];

            var contents = {
                id: t.id || empty(),
                order_partner_id: t.order_partner_id || empty(),
                vendor_code: t.vendor_code || empty(),
                partner_code: t.partner_code || empty(),
                bank_code: t.bank_code || empty(),
                vendor_token: t.vendor_token || empty(),
                token: t.token || empty(),
                card_name: t.card_name || empty(),
                card_issuer: t.card_issuer || empty(),
                card_number: t.card_number || empty(),
                card_scheme: t.card_scheme || empty(),
                card_type: t.card_type || empty(),
                card_date: t.card_date || empty(),
                status_3ds: t.status_3ds || empty(),
                status: `<label class="badge badge-${statusColors[t.status] || 'default'}">${t.status}</label>`,
                created_at: t.created_at || empty(),
            };
            $.each(contents, (col, val) => {
                replaceContent(col, val)
            });

            $modal.modal('show');
        }

        var oldBtnContent = `Xác nhận thanh toán`
        var setSubmitStateButton = function (loading, element, txtBtn) {
            var $this = $(element || '#formApprove');
            if (loading) {
                g.loading()
                g.resetOutput($modal)
                $this.html('<span class="spinner-border spinner-border-sm"></span><span class="pl-3">Đang yêu cầu</span>');
                $this.attr('disabled', true);
            } else {
                g.loading(false)
                $this.html(txtBtn || oldBtnContent);
                $this.attr('disabled', false);
            }
        }

        function replaceContent(col, value) {
            $('#modal-detail').find(`[col="${col}"]`).html(value);
        }

        function empty() {
            return '<div class="text-secondary">[trống]</div>'
        }
    },
    export: () => {
        $('.btn-export-flash-chart').click(function (e) {
            e.preventDefault();
            g.alert('Đang yêu cầu tải xuống...', 'info')
            var that = $(this);
            that.attr('disabled', true)
            $.ajax({
                type: "GET",
                url: "/gate-vendor-token-list",
                data: local.get_filter({request_type: 'export'}),
                success: function (response) {
                    if (response.code == 200) {
                        location.href = '/gate-vendor-token-list?request_type=download&file=' + response.path;
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
    },
    create: () => {
        var $modal = $('#modal-create');
        $('#btnCreateSubmit').click(function () {
            $.ajax({
                type: "post",
                url: "/partner/bank-account/create",
                data: $modal.find('form').serialize(),
                success: function (response) {
                    g.alert(response.message)
                    table.reload();
                    $modal.find('form').trigger("reset");
                    $modal.find('form select').select2().val('');
                    $modal.modal('hide')
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
    }
};
$(document).ready(function () {
    // local.load_input();
    local.form_js();
    local.table_js();
    local.export();
    local.create();
});

