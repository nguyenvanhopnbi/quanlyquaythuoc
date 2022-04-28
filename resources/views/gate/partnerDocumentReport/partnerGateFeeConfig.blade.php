@extends('index')
@section('page-header', 'Partner Paygate Fee Config')
@section('page-sub-header', 'Partner Paygate Fee Config')
@section('style')
<link rel="stylesheet" href="{{asset('css/loading.css')}}">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">


<style>

</style>
@endsection
@section('content')
@livewire('gate.partner-document-report.partner-paygate-fee-config')
@endsection
@section('scriptlivewire')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>



<script src="{{asset('js/partnerPaygateFeeConfig.js?v=5')}}"></script>

<script>
    $('#startTimeSearch').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                maxDate: $('#endTimeSearch').val() ? $('#endTimeSearch').val() : false
            })
        }
    })

    $('#endTimeSearch').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                minDate: $('#startTimeSearch').val() ? $('#startTimeSearch').val() : false
            })
        }
    })



    $('#startTimeAddnew').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                maxDate: $('#endTimeAddnew').val() ? $('#endTimeAddnew').val() : false
            })
        }
    })

    $('#endTimeAddnew').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                minDate: $('#startTimeAddnew').val() ? $('#startTimeAddnew').val() : false
            })
        }
    })


    $('#StartTimeUpdate').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                maxDate: $('#EndTimeUpdate').val() ? $('#EndTimeUpdate').val() : false
            })
        }
    })

    $('#EndTimeUpdate').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                minDate: $('#StartTimeUpdate').val() ? $('#StartTimeUpdate').val() : false
            })
        }
    })



</script>

@endsection

