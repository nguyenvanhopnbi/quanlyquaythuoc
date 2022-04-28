@extends('index')
@section('page-header', 'Quản lý số dư')
@section('page-sub-header', 'Quản lý số dư')
@section('style')


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">
<style>

</style>
@endsection
@section('content')
<livewire:manage-balance />
@endsection

@section('script')
    <!--begin::Page Vendors(used by this page) -->


@endsection
@section('scriptlivewire')
<script src="{{asset('js/transfermoneytransaction.js')}}"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>

    <script>
    $('#Tm_startTime').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                maxDate: $('#Tm_endTime').val() ? $('#Tm_endTime').val() : false
            })
        }
    })

    $('#Tm_endTime').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                minDate: $('#Tm_startTime').val() ? $('#Tm_startTime').val() : false
            })
        }
    })
</script>

@endsection
