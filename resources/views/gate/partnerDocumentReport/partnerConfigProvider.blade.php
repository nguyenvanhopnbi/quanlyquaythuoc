@extends('index')
@section('page-header', 'Cấu hình provider theo partner')
@section('page-sub-header', 'Cấu hình provider theo partner')
@section('style')
<link rel="stylesheet" href="{{asset('css/loading.css')}}">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">


<style>

</style>
@endsection
@section('content')
{{-- @dd($currentPage) --}}
@livewire('gate.partner-document-report.partner-config-provider')
@endsection
@section('scriptlivewire')

<script src="{{asset('js/partnerConfigProvider.js?v=2')}}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>




{{-- <script src="{{asset('js/partnerCodeDocumentReport.js')}}"></script> --}}

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
    $('#addnewDay').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d',
        weeks: true,
    })

    $('#updateDay').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d',
        weeks: true,
    })
</script>

@endsection

