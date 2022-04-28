@extends('index')
@section('page-header', 'Partner Appota Service')
@section('page-sub-header', 'Partner Appota Service')
@section('style')
<link rel="stylesheet" href="{{asset('css/loading.css')}}">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">


<style>

</style>
@endsection
@section('content')
@livewire('gate.partner-appota-service.partner-appota-service')
@endsection
@section('scriptlivewire')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
<script>

    var myClassicEditorAddnew;
        ClassicEditor
            .create( document.querySelector( '#DetailsAddneweditor' ) )
            .then(editor => {myClassicEditorAddnew = editor;})
            .catch( error => {
                console.error( error );
            } );

    var myClassicEditorUpdate;
        ClassicEditor
            .create( document.querySelector( '#DetailsUpdateeditor' ) )
            .then(editor => {myClassicEditorUpdate = editor;})
            .catch( error => {
                console.error( error );
            } );
</script>


<script src="{{asset('js/partnerAppotaService.js')}}"></script>

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
