@extends('index')
@section('page-header', 'Partner VA reconciliation schedule')
@section('page-sub-header', 'Partner VA reconciliation schedule')
@section('style')
<link rel="stylesheet" href="{{asset('css/loading.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/lottery.css')}}"> --}}

<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">
{{-- <link rel="stylesheet" href="{{asset('Lottery/assets/css/style.css')}}"> --}}


<style>

</style>
@endsection
@section('content')
@livewire('gate.ebill.ebillcrosscheck')
@endsection
@section('scriptlivewire')

<!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>

<!-- {{-- <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script> --}}
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
 -->

<script src="{{asset('js/ebillBank.js?v=1')}}"></script>

<script>
    $('#startTimeSearch').datetimepicker({
        timepicker: false,
        datepicker: true,
        format: 'Y-m-d',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                maxDate: $('#endTimeSearch').val() ? $('#endTimeSearch').val() : false
            })
        }
    })

    $('#endTimeSearch').datetimepicker({
        timepicker: false,
        datepicker: true,
        format: 'Y-m-d',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                minDate: $('#startTimeSearch').val() ? $('#startTimeSearch').val() : false
            })
        }
    })
</script>

@endsection