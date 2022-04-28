@extends('index')
@section('page-header', 'Schedule details VA')
@section('page-sub-header', 'Schedule details VA')
@section('style')
<link rel="stylesheet" href="{{asset('css/loading.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/lottery.css')}}"> --}}

<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">
{{-- <link rel="stylesheet" href="{{asset('Lottery/assets/css/style.css')}}"> --}}


<style>

#showDetailsModal .row {
    margin-bottom: 20px;
}

#showDetailsModal .row .col .bold{
    font-weight: bold;
}

</style>
@endsection
@section('content')
@livewire('gate.ebill.schedule-details')
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

<script src="{{asset('js/ebillBank.js')}}"></script>

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

    $('#addnew_date_perform').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d',
        weeks: true
    })


    $('#addnew_startTime').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                maxDate: $('#addnew_endTime').val() ? $('#addnew_endTime').val() : false
            })
        }
    })

    $('#addnew_endTime').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                minDate: $('#addnew_startTime').val() ? $('#addnew_startTime').val() : false
            })
        }
    })


    $('#DateTimeSearch').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d',
        weeks: true
    })

    $('#update_date_perform').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d',
        weeks: true
    })


    $('#update_startTime').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                maxDate: $('#update_endTime').val() ? $('#update_endTime').val() : false
            })
        }
    })

    $('#update_endTime').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                minDate: $('#update_startTime').val() ? $('#update_startTime').val() : false
            })
        }
    })
</script>

@endsection
