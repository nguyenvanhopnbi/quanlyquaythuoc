@extends('index')
@section('page-header', 'Lottery')
@section('page-sub-header', 'Lottery')
@section('style')
<link rel="stylesheet" href="{{asset('css/loading.css')}}">
<link rel="stylesheet" href="{{asset('css/lottery.css')}}">

{{-- <link href="assets/lib/bootstrap/bootstrap.min.css" rel="stylesheet" />
<link href="assets/lib/datepicker.css" rel="stylesheet" />
<link href="assets/lib/datatables/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" /> --}}

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('Lottery/assets/css/style.css')}}">


<style>

</style>
@endsection
@section('content')
@livewire('gate.lottery.provider')
@endsection
@section('scriptlivewire')



{{-- <script src="assets/lib/jquery-3.6.0.min.js"></script> --}}
<!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
{{-- <script src="{{asset('Lottery/assets/lib/bootstrap-datepicker.js')}}"></script> --}}
{{-- <script src="{{asset('Lottery/assets/lib/datatables/jquery.dataTables.min.js')}}"></script> --}}
{{-- <script src="{{asset('Lottery/assets/lib/datatables/dataTables.bootstrap5.min.js')}}"></script> --}}
<script src="{{asset('Lottery/assets/js/main.js')}}"></script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>

{{-- <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script> --}}
{{-- <script>

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
</script> --}}


<script src="{{asset('js/lottery.js')}}"></script>

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
