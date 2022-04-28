@extends('index')
@section('page-header', 'Danh sách Ipn logs')
@section('page-sub-header', 'Danh sách Ipn logs')
@section('style')

<style>
/*    #table-trans-internal-transfer th{
        text-align: center;
        white-space: nowrap;
        width: 1%;
    }
*/

    #tableLogs #params-logs{
        word-wrap: break-word;
        max-width: 500px;
        overflow: hidden;
/*        border: 1px solid #d7d8e0;*/
        padding: 5px;
    }

     #tableLogs #params-logs:hover{
        overflow: visible !important;
        max-width: 500px;
        background-color: #000000;
        color: #FFFFFF;
        z-index: 10;
        transition: 1s;
     }

     #tableLogs #TransID{
        max-width: 10px;
        overflow: hidden;
        text-overflow: ellipsis;
     }

     #tableLogs #TransID:hover{
        overflow: visible !important;
        max-width: 500px;
        z-index: 10;
        transition: 1s;
     }

     #tableLogs #TransID:hover #TransID-text{
        background-color: #000000;
        color: #FFFFFF;
        z-index: 10;
        transition: 1s;
     }

     #tableLogs #Url-logs{
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
     }

     #tableLogs #Url-logs:hover{
        overflow: visible !important;
        max-width: 500px;
        z-index: 10;
        transition: 1s;
     }

     #tableLogs #Url-logs:hover #Url-text{
        background-color: #000000;
        color: #FFFFFF;
        z-index: 10;
        transition: 1s;
     }





</style>

<link rel="stylesheet" href="{{asset('css/loading.css')}}">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">

@endsection
@section('content')
    @livewire('gate.transfer-internal-money.firm-banking-ipn-logs')

@endsection

@section('scriptlivewire')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>


{{-- <script src="{{asset('js/TransInternalMoneyScript.js')}}"></script> --}}

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
</script>

@endsection
