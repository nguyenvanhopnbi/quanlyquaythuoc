
Livewire.on('searchScript', ()=>{
    var transaction_id = document.getElementById("Tm_transaction_id").value;
    var partner_ref_id = document.getElementById("Tm_partner_ref_id").value;
    var partner_code = document.getElementById("Tm_partner_code").value;
    var application_id = document.getElementById("Tm_application_id").value;
    var customer_phone_number = document.getElementById("Tm_Customer_Phone_Number").value;
    var status = document.getElementById("Tm_status").value;
    var transfer_status = document.getElementById("Tm_transfer_status").value;
    var amount = document.getElementById("Tm_amount").value;
    var account_number = document.getElementById("Tm_Account_number").value;
    var startTime = document.getElementById("Tm_startTime").value;
    var endTime = document.getElementById("Tm_endTime").value;
    var Tm_providerRefId = document.getElementById("Tm_providerRefId").value;

    var TimeType = document.getElementById("Tm_TimeType").value;
    var bankCode = document.getElementById("Tm_BankCode").value;


    if(status != ''){
        if(startTime == ''){
            alert('Bạn hãy chọn startTime và endTime');
            document.getElementById("Tm_startTime").focus();
            return;
        }

        if(endTime == ''){
            alert('Bạn hãy chọn startTime và endTime');
            document.getElementById("Tm_endTime").focus();
            return;
        }

    }
    if(transfer_status != ''){

        if(startTime == ''){
            alert('Bạn hãy chọn startTime và endTime');
            document.getElementById("Tm_startTime").focus();
            return;
        }

        if(endTime == ''){
            alert('Bạn hãy chọn startTime và endTime');
            document.getElementById("Tm_endTime").focus();
            return;
        }

    }



    Livewire.emit("search",
        transaction_id,
        partner_ref_id,
        partner_code,
        application_id,
        customer_phone_number,
        status,
        transfer_status,
        amount,
        account_number,
        startTime,
        endTime,
        Tm_providerRefId,
        TimeType,
        bankCode,
        );
})


Livewire.on('ExportTransferMoneyTransactionScript', ()=>{

    // alert('vao day');
    var transaction_id = document.getElementById("Tm_transaction_id").value;
    var partner_ref_id = document.getElementById("Tm_partner_ref_id").value;
    var partner_code = document.getElementById("Tm_partner_code").value;
    var application_id = document.getElementById("Tm_application_id").value;
    var customer_phone_number = document.getElementById("Tm_Customer_Phone_Number").value;
    var status = document.getElementById("Tm_status").value;
    var transfer_status = document.getElementById("Tm_transfer_status").value;
    var amount = document.getElementById("Tm_amount").value;
    var account_number = document.getElementById("Tm_Account_number").value;
    var startTime = document.getElementById("Tm_startTime").value;
    var endTime = document.getElementById("Tm_endTime").value;

    var providerCode = document.getElementById("Tm_providerCode").value;
    var TimeType = document.getElementById("Tm_TimeType").value;
    var bankCode = document.getElementById("Tm_BankCode").value;


    if(status != ''){
        if(startTime == ''){
            alert('Bạn hãy chọn thời gian bắt đầu và thời gian kết thúc');
            document.getElementById("Tm_startTime").focus();
            return;
        }

        if(endTime == ''){
           alert('Bạn hãy chọn thời gian bắt đầu và thời gian kết thúc');
            document.getElementById("Tm_endTime").focus();
            return;
        }

    }
    if(transfer_status != ''){

        if(startTime == ''){
            alert('Bạn hãy chọn thời gian bắt đầu và thời gian kết thúc');
            document.getElementById("Tm_startTime").focus();
            return;
        }

        if(endTime == ''){
            alert('Bạn hãy chọn thời gian bắt đầu và thời gian kết thúc');
            document.getElementById("Tm_endTime").focus();
            return;
        }

    }

    // alert(TimeType);
    Livewire.emit('ExportTransferMoneyTransaction',
        transaction_id,
        partner_ref_id,
        partner_code,
        application_id,
        customer_phone_number,
        status,
        transfer_status,
        amount,
        account_number,
        startTime,
        endTime,
        providerCode,
        TimeType,
        bankCode,
    );
    setTimeout(function(){

        window.location.reload(true);

    }, 10000);


})
