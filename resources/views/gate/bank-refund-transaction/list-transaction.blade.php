@extends('index')
@section('page-header', 'Banks transaction refund')
@section('page-sub-header', 'Danh sách giao dịch bank refund')
@section('style')

@endsection
@section('content')
<livewire:bank-transaction-refund />
@endsection
<script>
    var partnerCode = "{{ request()->input('partner_code') }}";
    var bankCode = "{{ request()->input('bank_code') }}";
    var applicationId = "{{ request()->input('application_id') }}";
</script>
@section('script')
<!--begin::Page Vendors(used by this page) -->


<!--end::Page Vendors -->
<script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
<script src="admin/js/pages/gate/bank-refund-transaction/index.js?t=1638775072" type="text/javascript" defer></script>

@endsection

@section('scriptlivewire')
    <script>
        function refundStatus(refundID){
            document.getElementById("changeStatusrefundID").value = refundID;
            // alert(refundID);
        }
        Livewire.on('changeStatusrefundIDScript', ()=>{
            var refundID = document.getElementById("changeStatusrefundID").value;
            var VendorRefID = document.getElementById("refund_vendor_ref_id_change_status").value;
            var StatusChange = document.getElementById("StatusChange").value;

            var reject_reason = document.getElementById("reject_reason").value;

            var cFirm = confirm("Bạn có chắc chắn cập nhập trạng thái không? Refund ID: " + refundID);
            if(cFirm){
                Livewire.emit('changeStatusrefundID', refundID, VendorRefID, StatusChange, reject_reason);
            }

            setTimeout(function(){
                Livewire.emit('resetMessage');
                document.getElementById("refund_vendor_ref_id_change_status").value = '';

                // window.location.reload(true);
            }, 6000);

        });

        Livewire.on('statusScript', ()=>{
            var status = document.getElementById("StatusChange").value;
            if(status == 'error'){
                document.getElementById('block_reject_reason').style.display = "block";
            }else{
                document.getElementById('block_reject_reason').style.display = "none";
                document.getElementById('reject_reason').value = '';
            }
        });
    </script>
@endsection
