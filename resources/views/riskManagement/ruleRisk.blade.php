@extends('index')
@section('page-header', 'Rule Risk')
@section('page-sub-header', 'Rule Risk')
@section('style')
<link rel="stylesheet" href="{{asset('css/loading.css')}}">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">

<style>
.btn-param{
    border: none;
    margin-top: 10px;
}
.btn-param:hover{
    color: #EEEEEE;
}
#toolbar-container{
    width: 635px;
}
#toolbar-container-update{
    width: 635px;
}

#editor{
    border: 1px solid #e2e5ec;
}
#editor-update{
    border: 1px solid #e2e5ec;
}


</style>
@endsection
@section('content')
    @livewire('risk.rule-risk')
@endsection
@section('scriptlivewire')

    <script src="{{asset('js/risk.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>

    <script>
    $('#startTimeSearch').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        // value: '',
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
        // value: '',
        onShow: function(ct){
            this.setOptions({
                minDate: $('#startTimeSearch').val() ? $('#startTimeSearch').val() : false
            })
        }
    })

</script>
<script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/decoupled-document/ckeditor.js"></script>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script> --}}
<script>
    var myEditorAddnew;
        DecoupledEditor
            .create( document.querySelector( '#editor' ))
            .then( editor => {

                myClassicEditorAddnew = editor;
                const toolbarContainer = document.querySelector( '#toolbar-container' );

                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            } )
            .catch( error => {
                console.error( error );
            } );


    var myEditorUpdate;
        DecoupledEditor
            .create( document.querySelector( '#editor-update' ))
            .then( editor => {

                myEditorUpdate = editor;
                const toolbarContainer = document.querySelector( '#toolbar-container-update' );

                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            } )
            .catch( error => {
                console.error( error );
            } );

    // var myClassicEditorUpdate;
    //     ClassicEditor
    //         .create( document.querySelector( '#DetailsUpdateeditor' ) )
    //         .then(editor => {myClassicEditorUpdate = editor;})
    //         .catch( error => {
    //             console.error( error );
    //         } );



</script>

@endsection
