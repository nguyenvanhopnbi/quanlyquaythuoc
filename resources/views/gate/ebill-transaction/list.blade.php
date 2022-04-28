@extends('index')
@section('page-header', 'Danh sách giao dịch ebill')
@section('page-sub-header', 'Danh sách giao dịch ebill')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">

<style>
.show{
    color: #000 !important;
   /* font-weight: 400 !important;*/
}
.show .badge{
    color: #000 !important;
}

.show .span-value-popup{
    font-weight: 400 !important;

}
.show span{
    margin: auto;
    text-align: justify;
    word-break: break-word;
    white-space: pre-line;
    overflow-wrap: break-word;
}



</style>

@endsection
@section('content')
@livewire('ebill-transaction', [
    'partnerCodeList' => $partnerCodeList,
    'providerCodeList' => $providerCodeList
    ])
@endsection
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/ebill-transaction/index.js?v=1.1" type="text/javascript" defer></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
    <script src="{{asset('js/ebillTransaction.js')}}"></script>

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
