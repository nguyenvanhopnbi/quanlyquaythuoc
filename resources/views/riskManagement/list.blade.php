@extends('index')
@section('page-header', 'Risk Management')
@section('page-sub-header', 'Risk Management')
@section('style')
<link rel="stylesheet" href="{{asset('css/loading.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">
<style>
.cardRist{
    border: none;
}
.table-ccAccountWhitelist input{
    border: none;
    background: transparent;
}
.card_blacklist_number{
    display: inline-block;
    border: 1px solid #ced4da;
    background-clip: padding-box;
    background-color:  #FFF;
    padding: .375rem .75rem;
    font-weight: 400;
    border-radius: .25rem;
    font-size: 1rem;
    line-height: 1.5;
    padding-left: 0.8rem;
    color: #212529;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
  border: 1px solid #dddddd;
  border-right-width:0px;
  border-left-width:0px;
  color: #48465b;
  font-size: 1rem;
}
#witelistTable input{
    /*width: 100% !important;*/
    background-color: #f8f9fa;
}
#blacklistTable input{
    background-color: #f8f9fa;
}
.addnewWhiteListCardForm input, textarea{
    padding-left: 0.8rem !important;
}
/*.kt-input-icon.kt-input-icon--left .form-control {
    padding-left: 0.8rem !important;
}*/
</style>
@endsection
@section('content')
    @livewire('risk.riskmanagement')
@endsection
@section('scriptlivewire')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="{{asset('js/risk.js')}}"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>

    <script>
    $('#startTimeSearch_whitelist').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        // value: '',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                maxDate: $('#endTimeSearch_whitelist').val() ? $('#endTimeSearch_whitelist').val() : false
            })
        }
    })

    $('#endTimeSearch_whitelist').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        // value: '',
        onShow: function(ct){
            this.setOptions({
                minDate: $('#startTimeSearch_whitelist').val() ? $('#startTimeSearch_whitelist').val() : false
            })
        }
    })


    $('#startTimeSearch_blacklist').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        // value: '',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                maxDate: $('#endTimeSearch_blacklist').val() ? $('#endTimeSearch_blacklist').val() : false
            })
        }
    })

    $('#endTimeSearch_blacklist').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        // value: '',
        onShow: function(ct){
            this.setOptions({
                minDate: $('#startTimeSearch_blacklist').val() ? $('#startTimeSearch_blacklist').val() : false
            })
        }
    })

</script>

@endsection
