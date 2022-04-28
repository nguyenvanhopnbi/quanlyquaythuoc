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
            url: '/partner/partners',
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
            partner_code: urlParams.get('partner_code'),
            fd: urlParams.get('fd'),
            td: urlParams.get('td'),
        }, merge)
    },
    export: () => {
        $('.btn-export-flash-chart').click(function (e) {
            e.preventDefault();
            g.alert('Đang yêu cầu tải xuống...', 'info')
            var that = $(this);
            that.attr('disabled', true)
            setTimeout(() => {
                that.attr('disabled', false)
            }, 3000)
            const url = new URL(window.location);
            url.searchParams.set('partner_code', $('#partnerCode').val());
            url.searchParams.set('fd', $('#kt_datepicker_1').val());
            url.searchParams.set('td', $('#kt_datepicker_2').val());
            window.history.pushState({}, '', url);

            // download
            window.open(local.get_url())
        });
    },
    get_url: () => {
        var queryString = new URLSearchParams(local.get_filter({request_type: 'download'})).toString();
        return '/export/export-mix?' + queryString;
    }
};
$(document).ready(function () {
    // local.load_input();
    local.form_js();
    local.export();
});

