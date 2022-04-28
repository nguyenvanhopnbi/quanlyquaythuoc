"use strict";

// Class definition
var KTDashboard = function() {
    var chartUsedCard;
    var objSearchChartPie = {
        condition: 'day',
        startDate: $('#time-from_pie').val(),
        endDate: $('#time-to_pie').val(),
    }
    // Daterangepicker Init
    var daterangepickerInit = function() {
        if ($('#kt_dashboard_daterangepicker').length == 0) {
            return;
        }

        var picker = $('#kt_dashboard_daterangepicker');
        var start = moment();
        var end = moment();

        function cb(start, end, label) {
            var title = '';
            var range = '';

            if ((end - start) < 100 || label == 'Today') {
                title = 'Today:';
                range = start.format('MMM D');
            } else if (label == 'Yesterday') {
                title = 'Yesterday:';
                range = start.format('MMM D');
            } else {
                range = start.format('MMM D') + ' - ' + end.format('MMM D');
            }

            $('#kt_dashboard_daterangepicker_date').html(range);
            $('#kt_dashboard_daterangepicker_title').html(title);
        }

        picker.daterangepicker({
            direction: KTUtil.isRTL(),
            startDate: start,
            endDate: end,
            opens: 'left',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end, '');
    }

    // Calendar Init
    var calendarInit = function() {
        if ($('#kt_calendar').length === 0) {
            return;
        }

        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        $('#kt_calendar').fullCalendar({
            isRTL: KTUtil.isRTL(),
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            navLinks: true,
            defaultDate: moment('2017-09-15'),
            events: [
                {
                    title: 'Meeting',
                    start: moment('2017-08-28'),
                    description: 'Lorem ipsum dolor sit incid idunt ut',
                    className: "fc-event-light fc-event-solid-warning"
                },
                {
                    title: 'Conference',
                    description: 'Lorem ipsum dolor incid idunt ut labore',
                    start: moment('2017-08-29T13:30:00'),
                    end: moment('2017-08-29T17:30:00'),
                    className: "fc-event-success"
                },
                {
                    title: 'Dinner',
                    start: moment('2017-08-30'),
                    description: 'Lorem ipsum dolor sit tempor incid',
                    className: "fc-event-light  fc-event-solid-danger"
                },
                {
                    title: 'All Day Event',
                    start: moment('2017-09-01'),
                    description: 'Lorem ipsum dolor sit incid idunt ut',
                    className: "fc-event-danger fc-event-solid-focus"
                },
                {
                    title: 'Reporting',
                    description: 'Lorem ipsum dolor incid idunt ut labore',
                    start: moment('2017-09-03T13:30:00'),
                    end: moment('2017-09-04T17:30:00'),
                    className: "fc-event-success"
                },
                {
                    title: 'Company Trip',
                    start: moment('2017-09-05'),
                    end: moment('2017-09-07'),
                    description: 'Lorem ipsum dolor sit tempor incid',
                    className: "fc-event-primary"
                },
                {
                    title: 'ICT Expo 2017 - Product Release',
                    start: moment('2017-09-09'),
                    description: 'Lorem ipsum dolor sit tempor inci',
                    className: "fc-event-light fc-event-solid-primary"
                },
                {
                    title: 'Dinner',
                    start: moment('2017-09-12'),
                    description: 'Lorem ipsum dolor sit amet, conse ctetur'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: moment('2017-09-15T16:00:00'),
                    description: 'Lorem ipsum dolor sit ncididunt ut labore',
                    className: "fc-event-danger"
                },
                {
                    id: 1000,
                    title: 'Repeating Event',
                    description: 'Lorem ipsum dolor sit amet, labore',
                    start: moment('2017-09-18T19:00:00'),
                },
                {
                    title: 'Conference',
                    start: moment('2017-09-20T13:00:00'),
                    end: moment('2017-09-21T19:00:00'),
                    description: 'Lorem ipsum dolor eius mod tempor labore',
                    className: "fc-event-success"
                },
                {
                    title: 'Meeting',
                    start: moment('2017-09-11'),
                    description: 'Lorem ipsum dolor eiu idunt ut labore'
                },
                {
                    title: 'Lunch',
                    start: moment('2017-09-18'),
                    className: "fc-event-info fc-event-solid-success",
                    description: 'Lorem ipsum dolor sit amet, ut labore'
                },
                {
                    title: 'Meeting',
                    start: moment('2017-09-24'),
                    className: "fc-event-warning",
                    description: 'Lorem ipsum conse ctetur adipi scing'
                },
                {
                    title: 'Happy Hour',
                    start: moment('2017-09-24'),
                    className: "fc-event-light fc-event-solid-focus",
                    description: 'Lorem ipsum dolor sit amet, conse ctetur'
                },
                {
                    title: 'Dinner',
                    start: moment('2017-09-24'),
                    className: "fc-event-solid-focus fc-event-light",
                    description: 'Lorem ipsum dolor sit ctetur adipi scing'
                },
                {
                    title: 'Birthday Party',
                    start: moment('2017-09-24'),
                    className: "fc-event-primary",
                    description: 'Lorem ipsum dolor sit amet, scing'
                },
                {
                    title: 'Company Event',
                    start: moment('2017-09-24'),
                    className: "fc-event-danger",
                    description: 'Lorem ipsum dolor sit amet, scing'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: moment('2017-09-26'),
                    className: "fc-event-solid-info fc-event-light",
                    description: 'Lorem ipsum dolor sit amet, labore'
                }
            ],

            eventRender: function(event, element) {
                if (element.hasClass('fc-day-grid-event')) {
                    element.data('content', event.description);
                    element.data('placement', 'top');
                    KTApp.initPopover(element);
                } else if (element.hasClass('fc-time-grid-event')) {
                    element.find('.fc-title').append('<div class="fc-description">' + event.description + '</div>');
                } else if (element.find('.fc-list-item-title').lenght !== 0) {
                    element.find('.fc-list-item-title').append('<div class="fc-description">' + event.description + '</div>');
                }
            }
        });
    }


    var latestUpdates = function(data) {
        clearOldDash()
        if ($('#kt_chart_latest_updates').length == 0) {
            return;
        }

        var ctx = document.getElementById("kt_chart_latest_updates").getContext("2d");

        var config = {
            type: 'line',
            data: {
                labels: data.head,
                datasets: [{
                    label: "Tổng tiền",
                    backgroundColor: KTApp.getStateColor('danger'), // Put the gradient here as a fill color
                    borderColor: KTApp.getStateColor('danger'),
                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('success'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),

                    //fill: 'start',
                    data: data.value,
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                hover: {
                    mode: 'index'
                },
                tooltips: {
                    custom: false,
                    mode: 'nearest',
                    intersect: false,
                    callbacks:{
                        label: function(tooltipItem, data){
                            var label = data.datasets[tooltipItem.datasetIndex].label || '';

                            if (label) {
                                label += ': ';
                            }
                            label += addCommas(tooltipItem.yLabel);
                            return label;
                        }
                    }
                },
                scales: {
                    xAxes: [{
                        stacked: !0,
                        gridLines: !1,
                        enabled: !1,
                        ticks: {
                            callback: function (tick, index, data) {
                              // Jump every 7 values on the X axis labels to avoid clutter.
                                if( data.length > 12 ){
                                    tick = index % 7 !== 0 ? '' : tick;
                                }
                                return tick;
                            }
                        }
                    }],
                    yAxes: [{
                        stacked: !0,
                        ticks: {
                            userCallback: function(o, a, e) {
                                return o > 999 ? (o / 1e3).toFixed(0) + "k" : o
                            }
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.0000001
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                }
            }
        };

        chartUsedCard = new Chart(ctx, config);
    }

    var controlFilterForm = function() {
        $('.kt-portlet__head-toolbar .fa-times').click(function(){
            $(this).parent().parent().parent().parent().find('.kt-portlet__body').hide();
            $('.kt-portlet__head-toolbar').find('.fa-plus').show();
            $(this).hide();
        })

        $('.kt-portlet__head-toolbar .fa-plus').click(function(){
            $(this).parent().parent().parent().parent().find('.kt-portlet__body').show();
            $('.kt-portlet__head-toolbar').find('.fa-times').show();
            $(this).hide();
        })
    }

    var getDataToInert = function($form){
        var data = $form.serializeArray();
        var dataInsert = {};
        $.each(data, function (key, objField) {
            dataInsert[objField.name] = objField.value;
        });
        return dataInsert;
    }

    var clearForm = function(){
        $('#kt_modal_add_partner, #kt_modal_add_admin, #kt_modal_add_partner_config').on('hidden.bs.modal', function () {
            $(this).find('form')[0].reset();
            resetValidateField();
        })
    }

    var resetValidateField = function () {
        $('.erros_text').text('');
        $('.erros_text').parent().find('input').css('border-color', '#e2e5ec');
    }

    function addCommas(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }


    function clearOldDashPie(){
        if (window.BlogOverviewUsers !== undefined) {
            $('.dash-board-pie').remove();
            $('.holder-chart-pie').html('<canvas height="215" class="dash-board-pie chartjs-render-monitor"  style="width: 100%;"></canvas>')
        }
    }

    function setSearchPieCondition(){
        $('.btn-search-day-pie').click(function(){
            objSearchChartPie.condition = 'day';
            objSearchChartPie.partner_code = $("#partner_code_pie").val();
            getChartPie();
        })
        $('.btn-search-month-pie').click(function(){
            objSearchChartPie.condition = 'month';
            objSearchChartPie.partner_code = $("#partner_code_pie").val();
            getChartPie();
        })
        $('#time-to_pie').change(function(){
            objSearchChartPie.condition = 'select';
            objSearchChartPie.endDate = $(this).val();
        })
        $('#time-from_pie').change(function(){
            objSearchChartPie.condition = 'select';
            objSearchChartPie.startDate = $(this).val();
        })
    }

    function getChartPie(){
        if($('.dash-board-pie').length === 0){
            return ;
        }
        $('.loader-pie').show();
        var dataSearch = {
            data: objSearchChartPie,
            _token: $('meta[name="csrf-token"]').attr('content'),
        }
        $.ajax({
            type: "POST",
            url: "/charging-card-transactions/get-chart-pie",
            data: dataSearch,
            success: function (response) {
                buildChartPie(response.data, response.data.totAmount[1], response.data.totCard[1], response.data.arrCountCard)
                $('#sum_transaction_pie').text(response.data.totAmount[0]);
                $('#count_transaction_pie').text(response.data.totCard[0]);
            },
            error: function(jqXHR){
                handleOutOfSession(jqXHR.status);
            }
        });
    }

    function handleOutOfSession(code = 500){
        switch(code) {
            case 419:
            //   alert('Bạn cần đăng nhập lại !');
            //   location.reload();
              break;
            case 500:
              // code block
            //   alert('Hệ thống đang có lỗi. Hãy thử lại sau !');
              $('.lds-roller').hide();
              break;
            default:
              // code block
          }
    }

    function getFlashReport(){
        $.ajax({
            type: "GET",
            url: "/ebill-dashboard/get-flash-report",
            data: {
                query : {
                    'partnerCode' :$("#partner_code_flash").val(),
                    'startTime': $('#time-from-flash').val(),
                    'endTime': $('#time-to-flash').val()
                }
            },
            success: function (response) {
                $('#table_flash_report_holder').html(response);
            }
        });
    }

    $('.btn-get-flash-chart').click(function(e){
        e.preventDefault();
        getFlashReport();
    })

    function buildChartPie(data, allAmount = 1, allCard = 1, cardByPrice = []){
        clearOldDashPie();
         var bouCtx = document.getElementsByClassName('dash-board-pie')[0];

        // Data
        var bouData = {
          // Generate the days labels on the X axis.
          allAmount:allAmount,
          allCard:allCard,
          labels: data.head,
          datasets: [{
            label: data.head,
            cardByPrice: cardByPrice,
            fill: 'start',
            data: data.value,
            backgroundColor: ['#9400D3','#4B0082', '#0000FF', '#00FF00', '#FFFF00', '#FF7F00', '#FF0000', '#a4f542', '#f57542', '#425df5'],
            borderColor: 'rgba(0,123,255,1)',
            pointBackgroundColor: '#ffffff',
            pointHoverBackgroundColor: 'rgb(0,123,255)',
            borderWidth: 1.5,
            pointRadius: 0,
            pointHoverRadius: 3
          }]
        };

        // Options
        var bouOptions = {
          responsive: true,
          legend: {
            position: 'top'
          },
          elements: {
            line: {
              // A higher value makes the line look skewed at this ratio.
              tension: 0.3
            },
            point: {
              radius: 0
            }
          },
          // Uncomment the next lines in order to disable the animations.
          // animation: {
          //   duration: 0
          // },
          hover: {
            mode: 'nearest',
            intersect: false
          },
          tooltips: {
            custom: false,
            mode: 'nearest',
            intersect: false,
            callbacks:{
                label: function(tooltipItem, data){
                    var text = 'Mệnh giá: ';
                    var label = data.datasets[tooltipItem.datasetIndex].label || '';
                    var countCard = data.datasets[tooltipItem.datasetIndex].cardByPrice || '';
                    var values = data.datasets[tooltipItem.datasetIndex].data || '';
                    // console.log(label)
                    if (label) {
                        text += label[tooltipItem.index];
                        text += countCard[tooltipItem.index] > 0 ? ' Số lượng: '+ addCommas(countCard[tooltipItem.index]) : '';
                        text += values[tooltipItem.index] > 0 ? ' Tổng tiền: '+ addCommas(values[tooltipItem.index]) : '';
                        text += allAmount > 0 ? ' Chiếm: '+ (values[tooltipItem.index] / allAmount).toFixed(2) * 100 + '%' : '';
                    }

                    // label += tooltipItem.yLabel.toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    return text;
                }
            }
          }
        };

        // Generate the Analytics Overview chart.
        window.BlogOverviewUsers = new Chart(bouCtx, {
          type: 'pie',
          data: bouData,
          options: bouOptions
        });
        $('.loader-pie').hide();
    }

    var dataSearchChart = {
        startDate: $('#time-from').val(),
        endDate: $('#time-to').val(),
        partner_code: $('#partner_code').val()
    };
    var buildChart = function() {
        if ($('#kt_chart_latest_updates').length == 0) {
            return;
        }

        $.ajax({
            type: "GET",
            url: "/ebill-dashboard/get-chart-transaction",
            data: {query: dataSearchChart},
            success: function (response) {
                latestUpdates(response.data);
                $('#count_transaction').text(response.data.count);
                $('#sum_transaction').text(response.data.sum);
            }
        });
    }

    // $(".btn-search-day").click(function(){
    //     dataSearchChart.condition = 'day';
    //     dataSearchChart.partner_code = $("#partner_code_chart").val();
    //     buildChart()
    // })

    // $(".btn-search-month").click(function(){
    //     dataSearchChart.condition = 'month';
    //     dataSearchChart.partner_code = $("#partner_code").val();
    //     buildChart()
    // })

    // $(".btn-get-chart").click(function(e){
    //     e.preventDefault();
    //     dataSearchChart.partner_code = $("#partner_code_chart").val();
    //     buildChart();
    // })

    $(".btn-get-chart").click(function(e){
        e.preventDefault();
        dataSearchChart.partner_code = $("#partner_code_chart").val();
        buildChart()
    })
    $("#time-from").change(function(){
        dataSearchChart.condition = 'select';
        dataSearchChart.startDate = $(this).val();
    })

    $("#time-to").change(function(){
        dataSearchChart.condition = 'select';
        dataSearchChart.endDate = $(this).val();
    })

    $(".btn-get-chart-pie").click(function(e){
        e.preventDefault();
        objSearchChartPie.partner_code = $("#partner_code_pie").val();
        getChartPie()
    })

    function clearOldDash(){
        if (chartUsedCard !== undefined) {
            $('.sales-overview-sales-report').remove();
            $('.holder-chart-used-card').html('<canvas height="215" id="kt_chart_latest_updates" class="sales-overview-sales-report chartjs-render-monitor"  style="width: 100%;"></canvas>')
        }
    }

    function buildPartnerCodeFlash()
    {
        $("#partner_code_flash").select2({
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

        $("#partner_code_chart").select2({
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

        $("#partner_code_pie").select2({
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

    }
    function buildDatePicker()
    {
        $("#time-from-flash").datepicker({
            rtl: KTUtil.isRTL(),
            clearBtn: !0,
            todayHighlight: !0,
            orientation: "bottom left",
        });
        $("#time-to-flash").datepicker({
            rtl: KTUtil.isRTL(),
            clearBtn: !0,
            todayHighlight: !0,
            orientation: "bottom left",
        });

        $("#time-from").datepicker({
            rtl: KTUtil.isRTL(),
            clearBtn: !0,
            todayHighlight: !0,
            orientation: "bottom left",
        });
        $("#time-to").datepicker({
            rtl: KTUtil.isRTL(),
            clearBtn: !0,
            todayHighlight: !0,
            orientation: "bottom left",
        });

        $("#time-from_pie").datepicker({
            rtl: KTUtil.isRTL(),
            clearBtn: !0,
            todayHighlight: !0,
            orientation: "bottom left",
        });

        $("#time-to_pie").datepicker({
            rtl: KTUtil.isRTL(),
            clearBtn: !0,
            todayHighlight: !0,
            orientation: "bottom left",
        });
        // $("#time-from").val($('#day-now').val())
        // $("#time-to").val($('#day-now').val())

        // $("#time-to-flash").val($('#day-now').val())
        // $("#time-from-flash").val($('#day-now').val())
    }


    return {
        // Init demos
        init: function() {

            buildPartnerCodeFlash();

            // init daterangepicker
            daterangepickerInit();
            // getTotalData();

            // calendar
            calendarInit();
            setSearchPieCondition();
            clearForm();
            // demo loading
            // //chart
            buildChart()
            // getChartPie()
            buildDatePicker()
            getFlashReport()
        }
    };
}();

// Class initialization on page load
jQuery(document).ready(function() {
    KTDashboard.init();
});
