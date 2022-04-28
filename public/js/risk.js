
setTimeout(function(){
        Livewire.emit('LoadingDelay');
    }, 1);

Livewire.on('DetailScript', ()=>{
    var code = document.getElementById("rulePartnerSpecialCode").value;
    Livewire.emit('Detail', code);
})

Livewire.on('DetailUpdateScript', ()=>{
    var code = document.getElementById("rulePartnerSpecialCodeUpdate").value;
    Livewire.emit('DetailUpdate', code);
})

Livewire.on('ViewDetailHis', id=>{
    var id = document.getElementById('hisDetailID-'+id).value;
    var card_number = document.getElementById("HisCardNumber-"+id).value;
    var card_name = document.getElementById("HisCardName-" + id).value;
    var transaction_id = document.getElementById("hisDetailTransactionID-" + id).value;
    var partner_code = document.getElementById("HisPartnerCode-" + id).value;
    var amount = document.getElementById("Amount-" + id).value;
    var ip = document.getElementById("HisIp-" + id).value;
    var timerequest = document.getElementById("TimeRequest-" + id).value;
    var timeResponse = document.getElementById("TimeResponse-" + id).value;
    var bankCode = document.getElementById("BankCode-" + id).value;
    var vendorCode = document.getElementById("VendorCode-" + id).value;
    var ruleCode = document.getElementById("RuleCode-" + id).value;
    var action = document.getElementById("Action-" + id).value;
    var orderInfo = document.getElementById("OrderInfo-" + id).value;
    var riskCodeFromBank = document.getElementById("riskCodeFromBank-"+id).value;

    var orderID = document.getElementById("OrderID-" + id).value;
    var TransactionStatus = document.getElementById("Transaction_status-" + id).value;

    document.getElementById("HisOrderID").value = orderID;
    document.getElementById("HisOrderTransactionStatus").value = TransactionStatus;

    document.getElementById("HisIDDetails").value = id;
    document.getElementById("HisCardNumberDetails").value = card_number;
    document.getElementById("HisCardNameDetails").value = card_name;

    document.getElementById("HisTransactionIDDetails").value = transaction_id;
    document.getElementById("HisPartnerCodeDetails").value = partner_code;
    document.getElementById("HisAmountDetails").value = amount;
    document.getElementById("HisIPDetails").value = ip;
    document.getElementById("HisTimeRequestDetails").value = timerequest;
    document.getElementById("HisTimeResponseDetails").value = timeResponse;
    document.getElementById("HisBankCodeDetails").value = bankCode;
    document.getElementById("HisVendorCodeDetails").value = vendorCode;

    document.getElementById("HisRuleCodeDetails").value = ruleCode;

    document.getElementById("HisOrderInfoDetails").value = orderInfo;
    document.getElementById("HisRiskCodeFromBankDetails").value = riskCodeFromBank;
    document.getElementById("HisRiskAction").value = action;


});

Livewire.on('inactivePartnerCodeScript', ()=>{
    var partner_code = document.getElementById("partner_code").value;
    var payment_method = document.getElementById("payment_method").value;

    Livewire.emit('inactivePartnerCode', partner_code, payment_method);
    setTimeout(function(){
        Livewire.emit("resetMessageHis");
    }, 6000);
})

Livewire.on('getDataFromTableHisScript', id=>{
    var partnerCode = document.getElementById("HisPartnerCode-" + id).value;
    document.getElementById("partner_code").value = partnerCode;
})

Livewire.on('AddIPtoBlacklistScript', id=>{
    var ip = document.getElementById("HisIp-"+id).value;
    var cFirm = confirm("Are you sure to add IP "+ ip + " to blacklist?");
    if(cFirm){
        Livewire.emit('AddIPtoBlacklist', ip);
    }
    setTimeout(function(){
        Livewire.emit("resetMessageHis");
    }, 6000);
})

Livewire.on('hisAddCardtoBlacklistScript', id=>{
    var card_number = document.getElementById("HisCardNumber-" + id).value;
    var card_name = document.getElementById("HisCardName-" + id).value;

    if(card_name == null || card_name == ''){
        card_name = prompt("Please enter your card name: ");
        if(card_name != null){
            Livewire.emit("hisAddCardtoBlacklist", card_number, card_name);
        }else{
             var x = confirm("Are you sure to put this card to blacklist with no card name?");
             if(x){
                Livewire.emit("hisAddCardtoBlacklist", card_number, card_name);
             }

        }
        return;
    }

    var cFirm = confirm("Are you sure to add Card Number " + card_number + " and Card Name " + card_name + " to blacklist?");
    if(cFirm){
        Livewire.emit("hisAddCardtoBlacklist", card_number, card_name);
    }

    setTimeout(function(){
        Livewire.emit("resetMessageHis");
    }, 6000);

})

Livewire.on('UpdateCCPartnerBinCardAllowScript', ()=>{
    var id = document.getElementById("UpdateIDPartnerBinCard").value;
    var bin_card = document.getElementById("UpdateBinCard").value;
    var partner_code = document.getElementById("Updatepartnercode").value;

    if(bin_card == ''){
        alert('Please enter your bin card!');
        document.getElementById("UpdateBinCard").focus();
        return;
    }

    if(partner_code == ''){
        alert('Please enter your partner code!');
        document.getElementById("UpdateIDPartnerBinCard").focus();
        return;
    }

    Livewire.emit("UpdateCCPartnerBinCardAllow", id, bin_card, partner_code);
})

Livewire.on('getDateTableccPartnerCodeBinCard', id=>{
    var bin_card = document.getElementById("BinCard-"+id).value;
    var partnerCode = document.getElementById("partnerCode-" + id).value;

    document.getElementById("UpdateBinCard").value = bin_card;
    document.getElementById("Updatepartnercode").value = partnerCode;
    document.getElementById("UpdateIDPartnerBinCard").value = id;

})

Livewire.on('deleteCCPartnerBinCardAllowScript', id=>{
    var cFirm = confirm("Are you sure to delete ID: " + id + "?");
    if(cFirm){
        Livewire.emit("deleteCCPartnerBinCardAllow", id);
    }

})

Livewire.on('addNewCCPartnerBinCardAllowScript', ()=>{



    var bin_card = document.getElementById("BinCardAddnew").value;
    var partner_code = document.getElementById("partnercodeAddnew").value;

    if(bin_card == ''){
        alert('Please enter your bin card!');
        document.getElementById("BinCardAddnew").focus();
        return;
    }

    if(partner_code == ''){
        alert('Please enter your partner code!');
        document.getElementById("partnercodeAddnew").focus();
        return;
    }

    Livewire.emit("addNewCCPartnerBinCardAllow", bin_card, partner_code);
    setTimeout(function(){
        Livewire.emit("resetMessage");
    }, 7000);
})

Livewire.on('searchCCBinCardAllowScript', ()=>{
    var bin_card = document.getElementById("searchBinCard").value;
    var partner_code = document.getElementById("searchPartnerCode").value;

    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit('searchCCBinCardAllow', partner_code, bin_card, startTime, endTime);
})

Livewire.on('UpdateBlacklistIPScript', ()=>{
    document.getElementById("statusBlacklistIPUpdate").style.display = '';
    var ip = document.getElementById("UpdateBlacklistIP").value;
    var id = document.getElementById("IDblacklistIP").value;

    Livewire.emit('UpdateBlacklistIP', id , ip);

    setTimeout(function(){
        Livewire.emit('resetMessage');
    }, 6000);
})

Livewire.on('getDateTableBlacklistIP', id=>{
    var ip = document.getElementById("IPblacklist-" + id).value;

    document.getElementById("IDblacklistIP").value = id;
    document.getElementById("UpdateBlacklistIP").value = ip;

})

Livewire.on('deleteBlacklistIPScript', id=>{
    var Cfirm = confirm('Are you sure to delete ID: ' + id);
    if(Cfirm){
        Livewire.emit('deleteBlacklistIP', id);
    }
})

Livewire.on('addNewBlacklistIPScript', ()=>{

    document.getElementById("statusBlacklistIP").style.display = '';
    var ip = document.getElementById("BlacklistIP").value;
    Livewire.emit('addNewBlacklistIP', ip);

    setTimeout(function(){
        Livewire.emit('resetMessage');
    }, 6000);
})

Livewire.on('searchBlacklistiPScript', ()=>{
    var ip = document.getElementById("search_IP").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit('searchBlacklistiP', ip, startTime, endTime);
})

Livewire.on('ExportHistoryRiskScript', ()=>{
    var rule_code = document.getElementById("search_rule_code").value;
    var action = document.getElementById("search_Action").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;


    var transaction_id = document.getElementById("search_transaction_id").value;
    var card_number = document.getElementById("search_card_number").value;
    var order_id = document.getElementById("search_order_id").value;
    var card_name = document.getElementById("search_card_name").value;
    var ip = document.getElementById("search_IP").value;
    var amount = document.getElementById("search_amount").value;
    var partnerCode = document.getElementById("search_partnercode").value;
    var vendorCode = document.getElementById("search_vendorcode").value;
    var bankcode = document.getElementById("search_bankcode").value;
    var status = document.getElementById("search_status").value;

    var actionArray = [];
    var actionStr = '';

    for(i = 0; i < action.length ; i++){
        if(action.charAt(i) != ','){
            actionStr = actionStr + action.charAt(i);
        }
        if(action.charAt(i) == ',' || i == (action.length - 1)){
            actionArray.push(actionStr);
            actionStr = '';
        }
    }

    Livewire.emit('ExportHistoryRisk',
        rule_code,
        actionArray,
        startTime,
        endTime,

        transaction_id,
        card_number,
        order_id,
        card_name,
        ip,
        amount,
        partnerCode,
        vendorCode,
        bankcode,
        status

        );

    setTimeout(function(){
        window.location.reload(true);
        // alert(rule_code);
    }, 10000);
})


Livewire.on('searchHistoryRiskScript', ()=>{
    var rule_code = document.getElementById("search_rule_code").value;
    var action = document.getElementById("search_Action").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    var transaction_id = document.getElementById("search_transaction_id").value;
    var card_number = document.getElementById("search_card_number").value;
    var order_id = document.getElementById("search_order_id").value;
    var card_name = document.getElementById("search_card_name").value;
    var ip = document.getElementById("search_IP").value;
    var amount = document.getElementById("search_amount").value;
    var partnerCode = document.getElementById("search_partnercode").value;
    var vendorCode = document.getElementById("search_vendorcode").value;
    var bankcode = document.getElementById("search_bankcode").value;
    var status = document.getElementById("search_status").value;



    var actionArray = [];
    var actionStr = '';

    for(i = 0; i < action.length ; i++){
        if(action.charAt(i) != ','){
            actionStr = actionStr + action.charAt(i);
        }
        if(action.charAt(i) == ',' || i == (action.length - 1)){
            actionArray.push(actionStr);
            actionStr = '';
        }
    }


    Livewire.emit('searchHistoryRisk',
        rule_code,
        actionArray,
        startTime,
        endTime,
        transaction_id,
        card_number,
        order_id,
        card_name,
        ip,
        amount,
        partnerCode,
        vendorCode,
        bankcode,
        status

        );
})

Livewire.on('showHideColumScript', ()=>{
    var riskCodeFromBank = document.getElementById("riskCodeFromBank");
    var OrderInfo = document.getElementById("OrderInfo");

    var OrderID = document.getElementById("OrderID");
    var Transaction_status = document.getElementById("Transaction_status");

    var Action = document.getElementById("Action");
    var RuleCode = document.getElementById("RuleCode");
    var VendorCode = document.getElementById("VendorCode");
    var BankCode = document.getElementById("BankCode");
    var TimeResponse = document.getElementById("TimeResponse");
    var TimeRequest = document.getElementById("TimeRequest");
    var IP = document.getElementById("IP");
    var Amount = document.getElementById("Amount");
    var PartnerCode = document.getElementById("PartnerCode");
    var TransactionID = document.getElementById("TransactionID");
    var CardName = document.getElementById("CardName");
    var CardNumber = document.getElementById("CardNumber");
    var ID = document.getElementById("ID");

    Livewire.emit('showHideColum',
        riskCodeFromBank.checked,
        OrderInfo.checked,
        Action.checked,
        RuleCode.checked,
        VendorCode.checked,
        BankCode.checked,
        TimeResponse.checked,
        TimeRequest.checked,
        IP.checked,
        Amount.checked,
        PartnerCode.checked,
        TransactionID.checked,
        CardName.checked,
        CardNumber.checked,
        ID.checked,
        OrderID.checked,
        Transaction_status.checked,

        );
})

Livewire.on('UpdatePartnerRuleSpecialScript', ()=>{
    var id = document.getElementById("idUpdatePartnerSpecial").value;
    var partnerCode = document.getElementById("PartnerCodeUpdate").value;
    var ruleCode = document.getElementById("rulePartnerSpecialCodeUpdate").value;
    var count = document.getElementById("idUpdatePartnerSpecial").getAttribute("count");

    var param =[];
    var key = [];

    var obj = {};

    if(count >= 1){
        for(i = 1; i <= count; i++){
            var paramValue = document.getElementById("rulePartnerSpecialParamUpdate" + i).value;
            var keyValue = document.getElementById("rulePartnerSpecialParamUpdate" + i).getAttribute("key");

            key.push(keyValue);
            param.push(paramValue);

        }
    }
    for(i = 0; i <= key.length; i++){
        obj[key[i]] = param[i];
    }

    if(partnerCode == ''){
        alert("Please enter your partner code!");
        document.getElementById("PartnerCodeUpdate").focus();
        return;
    }
    if(ruleCode == ''){
        alert("Please enter your Rule code of special!");
        document.getElementById("rulePartnerSpecialCodeUpdate").focus();
        return;
    }
    for(i = 1; i < param.length; i++){
        if(param[i] == ''){
            alert("Please enter your full param!");
            document.getElementById("rulePartnerSpecialParamUpdate" + (i+1)).focus();
            return;
        }
    }

    Livewire.emit('UpdatePartnerRuleSpecial', id, partnerCode, ruleCode, obj);

})

Livewire.on('getParamSpecialUpdateScript', ()=>{
    var ruleCode = document.getElementById("rulePartnerSpecialCodeUpdate").value;
    var id = 0;
    var partnerCode = document.getElementById("PartnerCodeUpdate").value;
    Livewire.emit('getParamSpecialUpdate', ruleCode, id, partnerCode);
})

Livewire.on('getDateTablePartnerRuleSpecialScript', id=>{

    var partner_code = document.getElementById("PartnerCode-" + id).value;
    var ruleCode = document.getElementById("RuleCode-" + id).value;

    Livewire.emit('getParamSpecialUpdate', ruleCode, id, partner_code);
    document.getElementById("PartnerCodeUpdate").value = partner_code;
    document.getElementById("rulePartnerSpecialCodeUpdate").value = ruleCode;
    document.getElementById("idUpdatePartnerSpecial").value = id;

    Livewire.emit('getIDUpdatePartCodeSpecial', id);

})

Livewire.on('deletePartnerRuleSpecialScript', id=>{
    var cFirm = confirm("Are you sure to delete ID " + id);
    if(cFirm){
        Livewire.emit('deletePartnerRuleSpecial', id);
    }


})

Livewire.on('getParamSpecialScript', ()=>{
    var code = document.getElementById("rulePartnerSpecialCode").value;

    Livewire.emit('getParamSpecial', code);
})

Livewire.on('addNewPartnerRuleSpecialScript', ()=>{
    var code = document.getElementById("rulePartnerSpecialCode").value;
    var partner_code = document.getElementById("PartnerCode").value;
    var count = document.getElementById("countPartnerSpecialSSS").value;
    var param =[];
    var key = [];

    var obj = {};

    if(count >= 1){
        for(i = 1; i <= count; i++){
            var paramValue = document.getElementById("rulePartnerSpecialParam" + i).value;
            var keyValue = document.getElementById("rulePartnerSpecialParam" + i).getAttribute("key");

            key.push(keyValue);
            param.push(paramValue);

        }
    }
    for(i = 0; i <= key.length; i++){
        obj[key[i]] = param[i];
    }

    if(partner_code == ''){
        alert("Please enter your partner code of partner special rule!");
        document.getElementById("rulePartnerSpecialCode").focus();
        return;
    }

    if(code == ''){
        alert("Please enter your code of partner special rule!");
        document.getElementById("rulePartnerSpecialCode").focus();
        return;
    }
    for(i = 0; i < param.length; i++){
        if(param[i] == ''){
            alert("Please choose code and put your param!");
            document.getElementById("rulePartnerSpecialParam" + (i + 1)).focus();
            return;
        }
    }



    Livewire.emit('addNewPartnerRuleSpecial', partner_code, code, obj);

    setTimeout(function(){
        Livewire.emit('resetMessage');
    }, 6000);

})

Livewire.on('addMoreParamsPartnerSpecialHTML', ()=>{
    Livewire.emit('addMoreParamsPartnerSpecial');
})

Livewire.on('searchPartnerSpecialCodeScript', ()=>{
    var rule_code = document.getElementById("search_partner_special_rule").value;

    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    var partnerCode = document.getElementById("search_partner_code").value;

    Livewire.emit('searchPartnerSpecialCode', rule_code, startTime, endTime, partnerCode);
})

Livewire.on('updateRuleSpecialScript', ()=>{
    var id = document.getElementById("idSpecialRuleInput").value;
    var code = document.getElementById("ruleSpecialCodeUpdate").value;
    var name = document.getElementById("ruleSpecialNameUpdate").value;
    var count = document.getElementById("inum").value;

    var detail = myEditorUpdate.getData();

    // var paramValue2 = document.getElementById("ruleSpecialParamUpdate1").value;
    // alert(paramValue2);


    var param = [];
    var paramValue = '';
    if(count >= 1){
        for(i = 1; i <= count; i++){
            paramValue = document.getElementById("ruleSpecialParamUpdate" + i).value;
            // alert(paramValue);
            param.push(paramValue);
        }

    }

    Livewire.emit('updateRuleSpecial', id, code, name, param, detail);

    setTimeout(function(){
        Livewire.emit('removeMessage');
    }, 60000);

})

Livewire.on('addMoreParamsHTMLUpdateScript', ()=>{
    Livewire.emit('addMoreParamsHTMLUpdate');
})

Livewire.on('getDateTableRuleSpecialDataScript', id=>{
    var detail = document.getElementById("detail-" + id).value;

    myEditorUpdate.setData(detail);

    Livewire.emit('getDateTableRuleSpecialData', id);
})

Livewire.on('addNewRuleSpecialScript', ()=>{

    var count = document.getElementById("ruleSpecialParam").value;
    var code = document.getElementById("ruleSpecialCode").value;
    var name = document.getElementById("ruleSpecialName").value;

    var detail = myEditorAddnew.getData();

    var param = [];
    if(count >= 1){
        for(i = 1; i <= count; i++){
            var paramValue = document.getElementById("ruleSpecialParam" + i).value;
            param.push(paramValue);
        }

    }


    if(code == ''){
        alert("Please enter your code special rule!");
        document.getElementById("ruleSpecialCode").focus();
        return;
    }
    if(name == ''){
        alert("Please enter your name special rule!");
        document.getElementById("ruleSpecialName").focus();
        return;
    }
    if(param == '' || param == null){
        alert("Please enter aleast one param of special this rule!");
        document.getElementById("ruleSpecialParam1").focus();
        return;
    }

    Livewire.emit('addNewRuleSpecial', code, name, param, detail);
    setTimeout(function(){
        Livewire.emit('removeMessage');
    }, 60000);
})

Livewire.on("addMoreParamsHTML", ()=>{
    Livewire.emit('addMoreParams');
})

Livewire.on('deleteRuleSpecialScript', id=>{
    var specialCode = document.getElementById("codeSpecial-" + id).value;
    var cFirm = confirm("Are you sure to delete ID "+ id + " and all partner special rule Code: "+ specialCode +" ?");

    if(cFirm){
        Livewire.emit('deleteRuleSpecial', id, specialCode);
    }
})

Livewire.on('searchRuleSpecialCodeScript', ()=>{
    var code = document.getElementById("search_cc_special_rule").value;

    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;
    Livewire.emit("searchRuleSpecialCode", code, startTime, endTime);
})

Livewire.on('searchRuleRiskCodeScript', ()=>{
    var code = document.getElementById('search_cc_account_rule_risk').value;

    var nameCode = document.getElementById("search_rule_name").value;

    var startTime = document.getElementById("startTimeSearch").value;

    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit('searchRuleRiskCode', code, nameCode, startTime, endTime);
})
Livewire.on('UpdateRuleRiskScript', ()=>{
    var id = document.getElementById("IDupdateruleRisk").value;
    var code = document.getElementById("UpdateruleriskCode").value;
    var name = document.getElementById("UpdateruleriskName").value;

    var detail = myEditorUpdate.getData();


    if(code == ''){
        alert('Please enter your code rule risk!');
        document.getElementById("UpdateruleriskCode").focus();
        return;
    }
    if(name == ''){
        alert('Please enter your name of rule risk!');
        document.getElementById("UpdateruleriskName").focus();
        return;
    }

    Livewire.emit("UpdateRuleRisk", id, code, name, detail);
    setTimeout(function(){
        Livewire.emit("resetRuleRiskMessage");
    }, 7000);
})

Livewire.on('getDateTableRuleRisk', id=>{
    var code = document.getElementById("ruleriskcode-" + id).value;
    var name = document.getElementById("ruleriskName-" + id).value;
    var detail = document.getElementById("Detail-" + id).value;

    myEditorUpdate.setData(detail);

    document.getElementById("IDupdateruleRisk").value = id;
    document.getElementById("UpdateruleriskCode").value = code;
    document.getElementById("UpdateruleriskName").value = name;
})

Livewire.on('deleteRuleRiskScript', id=>{
    var cFirm = confirm("Are you sure to delete ID " + id + " ?");
    if(cFirm){
        Livewire.emit('deleteRuleRisk', id);
    }
})

Livewire.on('addNewRuleRiskScript', ()=>{
    var code = document.getElementById("ruleriskCode").value;
    var name = document.getElementById("ruleriskName").value;
    var detail = myClassicEditorAddnew.getData();
    // var detail = myClassicEditorAddnew.getData();
    // alert(detail);

    if(code == ''){
        alert('Please enter your code');
        document.getElementById("ruleriskCode").focus();
        return;
    }
    if(name == ''){
        alert('Please enter your name');
        document.getElementById("ruleriskName").focus();
        return;
    }

    Livewire.emit('addNewRuleRisk', code, name, detail);

    setTimeout(function(){
        Livewire.emit('resetRuleRiskMessage');
    }, 6000);
})
Livewire.on('addDirectCCAccountBypassScript', id=>{
    document.getElementById('direct_cc_account_whitelistID').value = id;
})

Livewire.on('searchCCAccountBypassScript', ()=>{
    var ruleCode = document.getElementById('search_cc_account_rule_code').value;
    var card_number = document.getElementById("search_card_number").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit('searchCCAccountBypass', ruleCode, card_number, startTime, endTime);

    setTimeout(function(){
        Livewire.emit('resetMessageBypass');
    }, 6000);
})
Livewire.on('deleteCCAccountBypassScript', id=>{
    var cFirm = confirm('Are you sure to delete ID '+ id + '?');
    if(cFirm){
        Livewire.emit('deleteCCAccountBypass', id);
    }

})

Livewire.on('UpdateAccountBypassScript', ()=>{

    var id = document.getElementById('update_cc_account_ID').value;
    var cardwhiteList = document.getElementById('update_cc_account_whitelistCard').value;
    var ruleCode = document.getElementById('update_cc_account_Rule_Code').value;

    Livewire.emit('UpdateAccountBypass', id, cardwhiteList, ruleCode);
    setTimeout(function(){
        Livewire.emit('resetMessageBypass');
    }, 6000);
})

Livewire.on('getDateTableccAccountList', id=>{
    var idwhiteList = document.getElementById('cc_accounts_whitelist_id-' + id).value;
    Livewire.emit('getCardNumberByID', idwhiteList, id);
    var ruleCode = document.getElementById('rule_code-' + id).value;
    document.getElementById('update_cc_account_Rule_Code').value = ruleCode;

})

Livewire.on('addNewAccountBypassScript', ()=>{

    document.getElementById("statusCCAccountBypass").style.display = "block";

    var card_number = document.getElementById("cc_account_whitelistFullCard").value;
    var ruleCode = document.getElementById("cc_account_Rule_Code").value;

    Livewire.emit('addNewAccountBypass', card_number, ruleCode);
    setTimeout(function(){
        Livewire.emit('resetMessageBypass');
    }, 8000);
})
Livewire.on('addNewAccountBypassDirectScript', ()=>{
    var idwhiteList = document.getElementById("direct_cc_account_whitelistID").value;
    var ruleCode = document.getElementById("direct_cc_account_Rule_Code").value;

    Livewire.emit('addNewAccountBypassDirect', idwhiteList, ruleCode);
    setTimeout(function(){
        Livewire.emit('resetMessageBypass');
    }, 6000);
})

Livewire.on('detailBlackListScript', id=>{
    var message = "blacklist";
    Livewire.emit('detailBlackList', id, message);
})

Livewire.on('deleteBlackListScript', id=>{
    var cFirm = confirm("Are you sure to delete card ID: " + id);
    if(cFirm){
        var message = 'blacklist';
        Livewire.emit('deleteBlackList', id, message);

        setTimeout(function(){
            Livewire.emit('resetMessageBlacklist');
        }, 6000);
    }
})

Livewire.on('updateBlackListScript', ()=>{
    var message = 'blacklist';
    var id = document.getElementById("idBlackUpdate").value;
    var sixFirstNumber = document.getElementById("updateBlackListSixFirstNumber").value;
    var fourlastNumber = document.getElementById("updateBlackListFourLastNumber").value;
    var card_name = document.getElementById("updateBlackListCardName").value;

    var reason = document.getElementById("updateBlackListReason").value;

    Livewire.emit('updateBlackList', id, sixFirstNumber, fourlastNumber, card_name, message, reason);

    setTimeout(function(){
        Livewire.emit('resetMessageBlacklist');
    }, 6000);

})

Livewire.on('getDataTableBlackList', id=>{
    var blackid = document.getElementById("BlackList-" + id).value;
    var card_number = document.getElementById("BlackListcardNumber-" + id).value;
    var sixFirstNumber = card_number.substring(0, 6);
    var fourLastNumber = card_number.slice(-4);
    var card_name = document.getElementById("BlackListcardName-" + id).value;

    var reason = document.getElementById("BlackListReason-" + id).value;
    document.getElementById("updateBlackListReason").value = reason;

    document.getElementById("idBlackUpdate").value = blackid;
    document.getElementById("updateBlackListSixFirstNumber").value = sixFirstNumber;
    document.getElementById("updateBlackListFourLastNumber").value = fourLastNumber;
    document.getElementById("updateBlackListCardName").value = card_name;


})


Livewire.on('addDirectBlackListScript', id =>{
    var cFirm = confirm("Are you sure to add this card "+ id +" to blacklist?");
    if(cFirm){
        var card_number = document.getElementById("WhiteListcardNumber-" + id).value;
        var sixFirstNumber = card_number.substring(0, 6);
        var fourLastNumber = card_number.slice(-4);
        var card_name = document.getElementById("WhiteListcardName-" +id).value;
        var message = 'whitelist';


        Livewire.emit('addnewBlackList', sixFirstNumber, fourLastNumber, card_name, message, id);

        setTimeout(function(){
            Livewire.emit('resetMessageBlacklist');
        }, 6000);
    }

})
Livewire.on('addnewBlackListScript', ()=>{
    document.getElementById("loading-addnewblacklist").style.display = "block";
    var sixFirstNumber = document.getElementById("addBlackListSixFirstNumber").value;
    var fourLastNumber = document.getElementById("addnewBlackListFourLastNumber").value;
    var card_name = document.getElementById("addnewBlackListCardName").value;

    var reason = document.getElementById("addnewBlackListReason").value;

    var message = 'blacklist';
    var id = 0;

    Livewire.emit('addnewBlackList', sixFirstNumber, fourLastNumber, card_name, message, id, reason);
    setTimeout(function(){
        Livewire.emit('resetMessageBlacklist');
    }, 6000);

})
Livewire.on('searchBlackListScript', ()=>{
    var card_number = document.getElementById("card_number_blacklist").value;
    if(card_number.length >= 10){
        var sixFirstNumber = card_number.substring(0, 6);
        var fourLastNumber = card_number.slice(-4);
        card_number = sixFirstNumber + '_' + fourLastNumber;
    }
    var card_name = document.getElementById("card_name_blacklist").value;

    var startTime = document.getElementById("startTimeSearch_blacklist").value;
    var endTime = document.getElementById("endTimeSearch_blacklist").value;

    Livewire.emit('searchBlackList', card_number, card_name, startTime, endTime);
})

// Begin whitelist

Livewire.on('searchWhiteListScript', ()=>{
    var card_number = document.getElementById("card_number").value;
    if(card_number.length >= 10){
        var sixFirstNumber = card_number.substring(0, 6);
        var fourLastNumber = card_number.slice(-4);
        card_number = sixFirstNumber + '_' + fourLastNumber;
    }


    var card_name = document.getElementById("card_name").value;

    var startTime = document.getElementById("startTimeSearch_whitelist").value;
    var endTime = document.getElementById("endTimeSearch_whitelist").value;

    Livewire.emit('searchWhiteList', card_number, card_name, startTime, endTime );
})

Livewire.on('addnewWhiteListScript', ()=>{

    var card_number = document.getElementById("addnewWhitelistCardNumber").value;
    var card_name = document.getElementById("addnewWhitelistCardName").value;

    var country_card = document.getElementById("addnewWhitelistCountryCard").value;
    var bank_card = document.getElementById("addnewWhitelistBankCard").value;

    if(card_number.length < 10){
        alert("Please enter your full card number atleast 10 number");
        document.getElementById("addnewWhitelistCardNumber").focus();
        return;
    }

    Livewire.emit('addnewWhiteList', card_number, card_name, country_card, bank_card);
    setTimeout(function(){
        Livewire.emit('removeMessage');
    }, 6000);
})

Livewire.on('getDateTableWhiteList', id =>{
    document.getElementById("updateWhitelistID").value = id;

    var card_number = document.getElementById("WhiteListcardNumber-" + id).value;
    var sixFirstNumber = card_number.substring(0, 6);
    var fourLastNumber = card_number.slice(-4);
    document.getElementById("updateWhitelistCardNumber").value = sixFirstNumber + "***" + fourLastNumber;

    var card_name = document.getElementById("WhiteListcardName-" + id).value;
    document.getElementById("updateWhitelistCardName").value = card_name;

    var country_card = document.getElementById("WhiteListCountryCard-" + id).value;
    var bank_card = document.getElementById("WhiteListBankCard-" + id).value;

    document.getElementById("updateWhitelistCountryCard").value = country_card;
    document.getElementById("updateWhitelistBankCard").value = bank_card;

})

Livewire.on('updateWhiteListScript', ()=>{
    var id = document.getElementById("updateWhitelistID").value;
    var card_number = document.getElementById("updateWhitelistCardNumber").value;
    var card_name = document.getElementById("updateWhitelistCardName").value;

    var country_card = document.getElementById("updateWhitelistCountryCard").value;
    var bank_card = document.getElementById("updateWhitelistBankCard").value;

    Livewire.emit('updateWhiteList', id, card_number, card_name, country_card, bank_card);

    setTimeout(function(){
        Livewire.emit('removeMessage');
    }, 6000);
})

Livewire.on('deleteWhiteListScript', id =>{
    var cFirm = confirm("Are you sure to delete ID " + id + "?");
    if(cFirm){
        Livewire.emit('deleteWhiteList', id);
    }

    setTimeout(function(){
        Livewire.emit('removeMessage');
    }, 6000);
})

Livewire.on('goCurrentPagesScript', page =>{
    Livewire.emit('goCurrentPages', page);
})

Livewire.on('detailWhiteListScript', id =>{

    Livewire.emit('detailWhiteList', id);
})

