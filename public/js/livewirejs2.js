
Livewire.on('getTelcoValueConfig4Script', ()=>{
    var telco = document.getElementById("telcoaddconfig4").value;
    // alert(telco);
    Livewire.emit('getTelcoValueConfig4', telco);
})
Livewire.on('searchConfig2Script', ()=>{
    var telco = document.getElementById('telcoSearchconfig2').value;
    var providerCode = document.getElementById("provider_code_searchconfig2").value;
    var partnerCode = document.getElementById("partnercode_code_searchconfig2").value;
    // alert(telco);
    Livewire.emit('searchConfig2',
        telco,
        providerCode,
        partnerCode
        );
})

Livewire.on('searchConfig4Script', ()=>{
    var telco = document.getElementById('telcoSearchconfig4').value;
    var providerCode = document.getElementById("provider_code_searchconfig4").value;
    // alert(partnerCode);
    Livewire.emit('searchConfig4',
        telco,
        providerCode
        );
})

Livewire.on('searchConfig3Script', ()=>{
    var telco = document.getElementById("telcoconfig3").value;
    var providerCode = document.getElementById("provider_codeConfig3").value;
    Livewire.emit('searchConfig3',
        telco,
        providerCode
    );
})

Livewire.on('searchConfig1Script', ()=>{
    var telco = document.getElementById("telcoconfig1").value;
    var partnerCode = document.getElementById("partnercode_code_searchconfig1").value;
    var providerCode = document.getElementById("provider_code_searchconfig1").value;
     // alert(partnerCode);

    Livewire.emit('getListConfig1Filter',
        telco,
        partnerCode,
        providerCode
        );
})


Livewire.on('deleteConfig1Script', providerID =>{
    var conFirm = confirm("Are you sure to delete Provider ID " + providerID + "?");
    if(conFirm == true){
        Livewire.emit('deleteConfig1', providerID);
    }

    setTimeout(function(){
        document.getElementById("row-messageUpudateDelete").style.display = "none";
        Livewire.emit('removeMessageUpdateDeleteConfig');
    }, 7000);

})

Livewire.on('SaveConfig4Script', ()=>{
    var telco = document.getElementById("telco4").value;
    var providerCode = document.getElementById("input4-providerCodeLivewire").value;
    var telcoServiceType = document.getElementById("telcoServiceType4").value;
    var value = document.getElementById("telcoValue4").value;


    Livewire.emit('SaveConfig4',
        telco,
        providerCode,
        telcoServiceType,
        value
    );
})

Livewire.on('SaveConfig3Script', ()=>{
    var telco = document.getElementById("telco-config3").value;
    var providerCode = document.getElementById("input-providerCodeLivewire-config3").value;
    var telcoServiceType = document.getElementById("telcoServiceTypeConfig3").value;

    Livewire.emit('SaveConfig3',
        telco,
        providerCode,
        telcoServiceType
        );
})

Livewire.on('SaveConfig2Script', ()=>{
    var telco = document.getElementById("telco-config2").value;
    var providerCode = document.getElementById("input-providerCodeLivewire-config2").value;
    var telcoServiceType = document.getElementById("telcoServiceTypeConfig2").value;
    var partnerCode = document.getElementById("parner_code_value_config2").value;
    if(partnerCode == ''){
        alert("Please enter your partner code first");
        document.getElementById("partnerCode").focus();
        return;
    }

    Livewire.emit('SaveConfig2',
        telco,
        providerCode,
        telcoServiceType,
        partnerCode
        );
})

Livewire.on('SaveConfig1Script', ()=>{
    // alert('vao day');
    var telco = document.getElementById("telco").value;
    var providerCode = document.getElementById("input-providerCodeLivewire").value;
    var value = document.getElementById("telcoValue").value;
    var telco_service_type = document.getElementById("telcoServiceType").value;
    var parner_code_value = document.getElementById("parner_code_value").value;
    if(parner_code_value == ''){
        alert("Please enter your partner code first");
        document.getElementById("parner_code_value").focus();
        return;
    }

    Livewire.emit('SaveConfig1',
        telco,
        providerCode,
        value,
        telco_service_type,
        parner_code_value
        );
})

Livewire.on('getTelcoValueScript', ()=>{

    var telcoValue = document.getElementById("telco").value;
    // $(telcoValue).find('option').get(0).remove();
    Livewire.emit('getTelcoValue');


})
Livewire.on('getTelcoValue4Script', ()=>{
    // alert('vao day');
    var telcoValue = document.getElementById("telco4").value;
    Livewire.emit('getTelcoValue4');


})

Livewire.on('getProviderCodeScript', ()=>{
    var providerCodeLivewire = document.getElementById("input-providerCodeLivewire").value;

    Livewire.emit('getProviderCode', providerCodeLivewire);
})


Livewire.on('findByTimeScript', () => {
        let startTime = document.getElementById('kt_datepicker_1').value;
        let endTime = document.getElementById('kt_datepicker_2').value;
        var func = 1;
        if(startTime == ''){
            // alert('Please enter your start time first');
            document.getElementById('kt_datepicker_1').focus();
            func = 0;
            return;
        }
        if(endTime == ''){
            // alert('Please enter your end time first');
            document.getElementById('kt_datepicker_2').focus();
            func = 0;
            return;
        }
        if(func == 1){
            Livewire.emit('findByTime', startTime, endTime);
        }


})

Livewire.on('linkPageScript', (page) => {
    // alert(page);
    Livewire.emit('linkPage', page);
})

Livewire.on('PreviousScript', (page) => {
    // alert(page);
    Livewire.emit('Previous', page);
})
Livewire.on('NextScript', (page) => {
    // alert(page);
    Livewire.emit('Next', page);
})

Livewire.on('ExportCSVScript', () => {
        let transaction_id = document.getElementById('input_bank_transaction_id').value;

        let startTime = document.getElementById('kt_datepicker_1').value;

        let endTime = document.getElementById('kt_datepicker_2').value;

        let partner_code = document.getElementById('partner_code_export').value;

        let bank_code = document.getElementById('bank_code_export').value;

        let application_id = document.getElementById('application_id_export').value;

        let payment_method = document.getElementById('payment_method_export').value;

        let client_ip = document.getElementById('client_ip_export').value;

        let order_info = document.getElementById('order_info_export').value;

        let order_id = document.getElementById('order_id_export').value;

        let vendor_code = document.getElementById('vendor_code_export').value;

        let status = document.getElementById('select-status').value;

        let Amount = document.getElementById('Amount_export').value;



        var ck_transaction_id = document.getElementsByName('ck_transaction_id');
        var result = [];
        for (var i = 0; i < ck_transaction_id.length; i++) {
            if(ck_transaction_id[i].checked === true){
                result.push(ck_transaction_id[i].value);
            }
        }
        Livewire.emit('ExportCSV',transaction_id, Amount, status, result, vendor_code, order_info, client_ip, payment_method, partner_code, bank_code, application_id, startTime, endTime);
})

Livewire.on('getIpnDetailsScript', transaction_id => {
    alert(transaction_id)
    // Livewire.emit('getIpnDetails', transaction_id);
})



Livewire.on('getIpnScript', (
    order_id,
    transaction_id,
    partner_code,
    amount,
    bank_code,
    application_id,
    application_name,
    status,
    payment_method,
    vendor_ref_id,
    payment_type,
    request_time,
    response_time,
    client_ip,
    vendor_code,
    error_message,
    order_info,
    error_code,
    vendor_callback_data,
    extra_data,
    extra_info
    ) => {

    var transaction_id_hidden = document.getElementById("hidden_transaction_id").value;

    if(transaction_id_hidden){
        document.getElementById("resendIpn_transaction_id").innerHTML = transaction_id_hidden;
    }
    if(order_id){
        document.getElementById("resendIpn_order_id").innerHTML = order_id;
    }


    document.getElementById("resendIpn_parner_code").innerHTML = partner_code;
    document.getElementById("resendIpn_amount").innerHTML = amount;
    document.getElementById("resendIpn_bank_code").innerHTML = bank_code;
    document.getElementById("resendIpn_id_name_application").innerHTML = application_id + '-' + application_name;
    document.getElementById("resendIpn_status").innerHTML = status;
    document.getElementById("resendIpn_payment_method").innerHTML = payment_method;
    document.getElementById("resendIpn_vendor_ref_id").innerHTML = vendor_ref_id;
    document.getElementById("resendIpn_payment_type").innerHTML = payment_type;
    document.getElementById("resendIpn_startTime").innerHTML = request_time;
    document.getElementById("resendIpn_endTime").innerHTML = response_time;

    document.getElementById("resendIpn_clientID").innerHTML = client_ip;
    document.getElementById("resendIpn_vendor_code").innerHTML = vendor_code;
    document.getElementById("resendIpn_error_message").innerHTML = error_message;
    document.getElementById("resendIpn_order_infor").innerHTML = order_info;
    document.getElementById("resendIpn_error_code").innerHTML = error_code;

    document.getElementById("resendIpn_Vendor_callback_data").innerHTML = vendor_callback_data;
    document.getElementById("resendIpn_extra_data").innerHTML = extra_data;
    document.getElementById("resendIpn_extra_info").innerHTML = extra_info;

    // Livewire.emit('getIpnDetails', page);

})





