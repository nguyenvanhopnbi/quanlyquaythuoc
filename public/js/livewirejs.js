Livewire.on('exportLogImportCardScript', ()=>{
    var value = document.getElementById("LogsValues").value;
    var providerName = document.getElementById("LogsProviderName").value;
    var method = document.getElementById("LogsMethod").value;
    var status = document.getElementById("LogsStatus").value;
    var startTime = document.getElementById("LogsStartTime").value;
    var endTime = document.getElementById("LogsendTime").value;
    var vendor = document .getElementById("LogsVender").value;

    Livewire.emit('exportLogImportCard',
        value,
        providerName,
        method,
        status,
        startTime,
        endTime,
        vendor

        );
    setTimeout(function(){
        window.location.reload(true);
    }, 10000);

})

Livewire.on('ExportTransferMoneyCheckAccountTransactionScript', ()=>{
    var transaction_id = document.getElementById("tmc_transaction_id").value;
    var partner_ref_id = document.getElementById("tmc_partner_ref_id").value;
    var account_number = document.getElementById("tmc_account_no").value;
    var partner_code = document.getElementById("tmc_partner_code").value;
    var status = document.getElementById("tmc_status").value;
    var check_status = document.getElementById("tmc_checkstatus").value;
    var bank_code = document.getElementById("tmc_bank_code").value;
    var startTime = document.getElementById("tmc_startTime").value;
    var endTime = document.getElementById("tmc_endTime").value;


    Livewire.emit('ExportTransferMoneyCheckAccountTransaction',
        transaction_id,
        partner_ref_id,
        account_number,
        partner_code,
        status,
        check_status,
        bank_code,
        startTime,
        endTime
        );

    setTimeout(function(){

        window.location.reload(true);

    }, 10000);
})

Livewire.on('ExportEbillTransactionScript', ()=>{
    var ebill_id = document.getElementById("ebill_id").value;
    var transaction_id = document.getElementById("ebill_transaction_id").value;
    var amount = document.getElementById("ebill_amount").value;
    var partner_code = document.getElementById("partner_code").value;
    var billCode = document.getElementById("ebill_bill_code").value;
    var type = document.getElementById("ebill_type").value;
    var status = document.getElementById("ebill_status").value;
    var provider_ref_id = document.getElementById("ebill_provider_ref_id").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;
    var providerCode = document.getElementById("ebill_providerCode").value;
    var account_no = document.getElementById("account_no").value;


    Livewire.emit('ExportEbillTransaction',
        ebill_id,
        transaction_id,
        amount,
        partner_code,
        billCode,
        type,
        status,
        provider_ref_id,
        startTime,
        endTime,
        providerCode,
        account_no
    );

    // setTimeout(function(){

    //     window.location.reload(true);

    // }, 10000);
})


Livewire.on('ExportShopCardPartnerCardDataScript', ()=>{
    var ref_transaction_id = document.getElementById("sc_partner_card_ref_transaction_id").value;
    var partner_ref_id = document.getElementById("sc_partner_card_ref_partner_ref_id").value;
    var vendor = document.getElementById("sc_card_partner_data_vendor").value;
    var value = document.getElementById("sc_card_partner_card_data_value").value;
    var serial = document.getElementById("sc_partner_card_data_serial").value;
    var startTime = document.getElementById("kt_datepicker_1").value;
    var endTime = document.getElementById("kt_datepicker_2").value;

    Livewire.emit('ExportShopCardPartnerCardData',
        ref_transaction_id,
        partner_ref_id,
        vendor,
        value,
        serial,
        startTime,
        endTime,

    );

    setTimeout(function(){

        window.location.reload(true);

    }, 10000);

})
Livewire.on('ExportShopCardTransactionScript', ()=>{
    var transaction_id = document.getElementById("scTransaction_transaction_id").value;
    var partner_ref_id = document.getElementById("sc_partner_ref_id").value;
    var partner_code = document.getElementById("sc_transaction_partner_code").value;
    var application_id = document.getElementById("sc_transaction_application_id").value;
    var amount = document.getElementById("sc_transaction_amount").value;
    var status = document.getElementById("sc_transaction_status").value;
    var vendor = document.getElementById("sc_transaction_vendor").value;
    var startTime = document.getElementById("kt_datepicker_1").value;
    var endTime = document.getElementById("kt_datepicker_2").value;

    Livewire.emit('ExportShopCardTransaction',
        transaction_id,
        partner_ref_id,
        partner_code,
        application_id,
        amount,
        status,
        vendor,
        startTime,
        endTime
    );

    setTimeout(function(){

        window.location.reload(true);

    }, 10000);

})

Livewire.on('ExportShopCardItemScript', ()=>{
    var serial = document.getElementById("shopcarditem_serial").value;
    var value = document.getElementById("shopcarditem_value").value;
    var vendor = document.getElementById("shopcarditem_vendor").value;
    var provider_code = document.getElementById("provider_code").value;
    var public = document.getElementById("shopcarditem_public").value;
    var sold = document.getElementById("shopcarditem_sold").value;
    var startTime = document.getElementById("kt_datepicker_1").value;
    var endTime = document.getElementById("kt_datepicker_2").value;
    var createStartTime = document.getElementById("kt_datepicker_3").value;
    // var createEndTime = document.getElementById("kt_datepicker_5").value;
    var createEndTime = document.getElementsByName("createEndTime")[0].value;

    Livewire.emit('ExportShopCardItem',
        serial,
        value,
        vendor,
        provider_code,
        public,
        sold,
        startTime,
        endTime,
        createStartTime,
        createEndTime
    );


    setTimeout(function(){

        window.location.reload(true);

    }, 10000);

})


Livewire.on('ExportCSV2', () => {
        let startTime = document.getElementById('kt_datepicker_1').value;
        let endTime = document.getElementById('kt_datepicker_2').value;
        let transaction_id = document.getElementById('input_bank_transaction_id').value;
        let partner_code = document.getElementById('partner_code').value;
        let bank_code = document.getElementById('bank_code').value;
        let application_id = document.getElementById('application_id').value;
        let payment_method = document.getElementById('payment_method').value;
        let client_ip = document.getElementById('client_ip').value;
        let order_info = document.getElementById('order_info').value;
        let order_id = document.getElementById('order_id').value;
        let vendor_code = document.getElementById('vendor_code').value;
        let status = document.getElementById('select-status').value;
        let Amount = document.getElementById('input-Amount').value;
        var vendor_ref_id = document.getElementById('input_bank_vendor_ref_id').value;

        // alert(transaction_id);

        var ck_transaction_id = document.getElementsByName('ck_transaction_id');
        var result = [];
        for (var i = 0; i < ck_transaction_id.length; i++) {
            if(ck_transaction_id[i].checked === true){
                result.push(ck_transaction_id[i].value);
            }
        }

        var input_bank_holding_status = document.getElementById("input_bank_holding_status").value;
        var hasRefund = document.getElementById("hasRefund").value;
        Livewire.emit('ExportCSV',
            order_id,
            transaction_id,
            Amount,
            status,
            result,
            vendor_code,
            order_info,
            client_ip,
            payment_method,
            partner_code,
            bank_code,
            application_id,
            startTime,
            endTime,
            vendor_ref_id,
            input_bank_holding_status,
            hasRefund
            );


        // setTimeout(function(){

        // window.location.reload(true);

        // }, 10000);
})


Livewire.on('ExportPartnerTransactionScript', () => {

    var transaction_id = document.getElementById("partner_transaction_id").value;
    var startTime = document.getElementById("kt_datepicker_1").value;
    var endTime = document.getElementById("kt_datepicker_2").value;
    var partner_code = document.getElementById("partner_code").value;
    var amount = document.getElementById("partner_amount").value;
    var reason = document.getElementById("partner_reason").value;
    var type = document.getElementById("partner_type").value;

    Livewire.emit('ExportPartnerTransaction',
        transaction_id,
        startTime,
        endTime,
        partner_code,
        amount,
        reason,
        type
        );

    setTimeout(function(){

        window.location.reload(true);

    }, 10000);
})

Livewire.on('ExportPartnerBalanceScript', () =>{
    var partner_code = document.getElementById("partner_code").value;
    var type = document.getElementById("Partner_Balance_Type").value;
    var startTime = document.getElementById("kt_datepicker_1").value;
    var endTime = document.getElementById("kt_datepicker_2").value;
    var amount = document.getElementById("partner_balance_amount").value;
    var adminEmail = document.getElementById("partner_balance_admin_email").value;



    Livewire.emit('ExportPartnerBalance',
        partner_code, type, startTime, endTime, amount, adminEmail
    );
    setTimeout(function(){

        window.location.reload(true);

    }, 10000);
})


Livewire.on('downloadCSV', () =>{

    var partner_code = document.getElementById("partner_code").value;
    var type = document.getElementById("Partner_Balance_Type").value;
    var startTime = document.getElementById("kt_datepicker_1").value;
    var endTime = document.getElementById("kt_datepicker_2").value;
    var amount = document.getElementById("partner_balance_amount").value;
    var adminEmail = document.getElementById("partner_balance_admin_email").value;



    Livewire.emit('download',
        partner_code, type, startTime, endTime, amount, adminEmail
     );

    setTimeout(function(){
        window.location.reload(true);

    }, 10000);
    // alert('Thanh Cong');

})

Livewire.on('ExportBankTranSactionScript', ()=>{
    var transaction_id = document.getElementById("refund_transaction_id").value;
    var order_id = document.getElementById("refund_order_id").value;
    var parner_code = document.getElementById("partner_code").value;
    var refund_type = document.getElementById("refund_transaction_type").value;
    // var amount = document.getElementById("refund_amount").value;
    var bank_code = document.getElementById("bank_code").value;
    var startTime = document.getElementById("kt_datepicker_1").value;
    var endTime = document.getElementById("kt_datepicker_2").value;
    var application_id = document.getElementById("application_id").value;
    var payment_method = document.getElementById("payment_method").value;
    var vendor_ref_id = document.getElementById("refund_vendor_ref_id").value;
    var status = document.getElementById("refund_transaction_status").value;


    Livewire.emit('ExportBankTranSactionRefund',
        transaction_id,
        order_id,
        parner_code,
        refund_type,
        // amount,
        bank_code,
        startTime,
        endTime,
        application_id,
        payment_method,
        vendor_ref_id,
        status
        );


    setTimeout(function(){
        window.location.reload(true);
    }, 10000);
})
Livewire.on('ExportTopUpTransactionScript', ()=>{
    var transaction_id = document.getElementById("topup_transaction_id").value;
    var partner_ref_id = document.getElementById("partner_ref_id").value;
    var partner_code = document.getElementById("partner_code").value;
    var application_id = document.getElementById("application_id").value;
    var phone_number = document.getElementById("topup_phone_number").value;
    var telco = document.getElementById("topup_Telco").value;
    var telco_service_type = document.getElementById("topup_telco_service_type").value;
    var status = document.getElementById("t_status").value;
    var topup_status = document.getElementById("topup_status").value;
    var topup_amount = document.getElementById("topup_amount").value;
    var startTime = document.getElementById("kt_datepicker_1").value;
    var endTime = document.getElementById("kt_datepicker_2").value;
    var provider = document.getElementById("topup_provider").value;
    var provider_ref_id = document.getElementById("topup_provider_ref_id").value;

    // alert(provider_ref_id);
    Livewire.emit('ExportTopUpTransaction',
        transaction_id,
        partner_ref_id,
        partner_code,
        application_id,
        phone_number,
        telco,
        telco_service_type,
        status,
        topup_status,
        topup_amount,
        startTime,
        endTime,
        provider,
        provider_ref_id

        );
    setTimeout(function(){
        window.location.reload(true);
    }, 10000);
})
Livewire.on('exportShopCardScript', ()=>{
    var name = document.getElementById("shopcard_name").value;
    var product_code = document.getElementById("shopcard_productcode").value;
    var price = document.getElementById("shopcard_price").value;
    var public = document.getElementById("shopcard_public").value;
    var value = document.getElementById("shopcard_value").value;
    var vendor = document.getElementById("shopcard_vendor").value;

    Livewire.emit('exportShopCard',
        name,
        product_code,
        price,
        public,
        value,
        vendor

        );
    setTimeout(function(){
        window.location.reload(true);
    }, 10000);
    // alert(vendor);
})

