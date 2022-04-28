@extends('index')
@section('page-header', 'Đối soát')
@section('page-sub-header', 'Danh sách đối soát')
@section('style')


    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">
    <link href="{{asset('doisoat/assets/lib/datepicker.css')}}" rel="stylesheet" />
    <link href="{{asset('doisoat/assets/lib/datatables/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />


    <link href="{{asset('doisoat/assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('doisoat/assets/css/custom.css')}}" rel="stylesheet" />
    <style>
        #listTrans th::before{
            display: none;
        }
        #listTrans th::after{
            display: none;
        }

        .swal2-icon.swal2-success{
            margin: 10px auto !important;
        }

    </style>
@endsection
@section('content')
@livewire('gate.ebill.ebill-v-a-reconciliation-data')
@endsection

@section('script')

@endsection

@section('scriptlivewire')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="{{asset('doisoat/assets/js/main.js')}}"></script>


    <script>
    $('#startTimeSearch').datetimepicker({
        timepicker: true,

        allowTimes:[
          '00:00:00', '01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00', '13:00','14:00', '15:00', '16:00',
          '17:00', '18:00', '19:00', '20:00', '21:00', '22:00','23:00', '23:59'
         ],
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
        allowTimes:[
          '00:00:00', '01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00', '13:00','14:00', '15:00', '16:00',
          '17:00', '18:00', '19:00', '20:00', '21:00', '22:00','23:00', '23:59'
         ],
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                minDate: $('#startTimeSearch').val() ? $('#startTimeSearch').val() : false
            })
        }
    })

     $('#TimeSearchPerform').datetimepicker({
        timepicker: false,
        datepicker: true,
        format: 'Y-m-d',
        weeks: true,


    })
</script>

@endsection
