Livewire.on('ExportVirtualAccountScript', ()=>{
    var billId = document.getElementById("billId").value;
    var providerCode = document.getElementById("providerCode").value;
    var account_id = document.getElementById("account_id").value;
    var account_no = document.getElementById("account_no").value;
    var account_name = document.getElementById("account_name").value;
    var paid_amount = document.getElementById("paid_amount").value;
    var startTime = document.getElementById("kt_datepicker_1").value;
    var endTime = document.getElementById("kt_datepicker_2").value;
    var partnerCode = document.getElementById("partnerCode").value;


    Livewire.emit("ExportVirtualAccount",
        billId,
        providerCode,
        account_id,
        account_no,
        account_name,
        paid_amount,
        startTime,
        endTime,
        partnerCode
        );

});
