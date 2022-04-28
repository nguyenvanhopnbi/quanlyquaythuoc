@extends('index')
@section('page-header', 'Danh sách lịch sử nạp tiền/ trừ tiền partner')
@section('page-sub-header', 'Danh sách lịch sử nạp tiền/ trừ tiền partner')
@section('style')

@endsection
@section('content')
<livewire:partner-balance />
@endsection
<script>
    var partnerCode = "{{ request()->input('partner_code')}}";
</script>
@section('script')
<!--begin::Page Vendors(used by this page) -->


<!--end::Page Vendors -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" defer></script>
<script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
<script src="admin/js/pages/gate/partner-balance/index.js" type="text/javascript" defer></script>
@endsection
