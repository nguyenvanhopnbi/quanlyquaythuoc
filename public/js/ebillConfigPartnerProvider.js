Livewire.on("UpdateEbillConfigBankPartnerProviderScript", ()=>{
    var partner_code = document.getElementById("PartnerCodeUpdate").value;
    var bank_code = document.getElementById("BankCodeUpdate").value;
    var provider_code = document.getElementById("ProviderCodeUpdate").value;
    var id = document.getElementById("UpdateConfigBank").value;

    if(partner_code == ''){
        alert("Bạn cần nhập Partner Code: ");
        document.getElementById("PartnerCodeUpdate").focus();
        return;
    }
    if(bank_code == ''){
        alert("Bạn cần nhập Bank Code: ");
        document.getElementById("BankCodeUpdate").focus();
        return;
    }

    if(provider_code == ''){
        alert("Bạn cân nhập Provider: ");
        document.getElementById("ProviderCodeUpdate").focus();
        return;
    }


    Livewire.emit("UpdateEbillConfigBankPartnerProvider", id, partner_code, bank_code, provider_code);
    setTimeout(function(){
        Livewire.emit("resetMessage");
    }, 6000);
});

Livewire.on("getDataUpdateConfigPartnerBankProviderScript", id=>{
    var partner_code = document.getElementById("partner_code-" + id).value;
    var bank_code = document.getElementById("bank_code-" + id).value;
    var provider_code = document.getElementById("provider_code-" + id).value;

    document.getElementById("PartnerCodeUpdate").value = partner_code;
    document.getElementById("BankCodeUpdate").value = bank_code;
    document.getElementById("ProviderCodeUpdate").value = provider_code;
    document.getElementById("UpdateConfigBank").value = id;
});

Livewire.on('deleteConfigPartnerBankProviderScript', id=>{
    var cFirm = confirm("Bạn chắc chắn xóa ID: " + id + "?");
    if(cFirm){
        Livewire.emit("deleteConfigPartnerBankProvider", id);
    }

});

Livewire.on('SearchEbillConfigBankPartnerProviderScript', ()=>{
    var PartnerCodeSearch = document.getElementById("PartnerCodeSearch").value;
    var ProviderCodeSearch = document.getElementById("ProviderCodeSearch").value;
    var BankCodeSearch = document.getElementById("BankCodeSearch").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit('SearchEbillConfigBankPartnerProvider',
        PartnerCodeSearch, ProviderCodeSearch, BankCodeSearch, startTime, endTime);
});

Livewire.on("AddnewConfigBankPartnerProviderScript", ()=>{
    var partnerCode = document.getElementById("AddnewPartnerCode").value;
    var bankCode = document.getElementById("AddnewBankCode").value;
    var providerCode = document.getElementById("AddnewProviderCode").value;

    if(partnerCode == ''){
        alert("Bạn cần nhập partner Code: ");
        document.getElementById("AddnewPartnerCode").focus();
        return;
    }

    if(bankCode == ''){
        alert("Bạn cần nhập Bank Code: ");
        document.getElementById("AddnewBankCode").focus();
        return;
    }

    if(providerCode == ''){
        alert("Bạn cần nhập provider Code: ");
        document.getElementById("AddnewProviderCode").focus();
        return;
    }

    Livewire.emit("AddnewConfigBankPartnerProvider", partnerCode, bankCode, providerCode);

    setTimeout(function(){
        Livewire.emit("resetMessage");
    }, 6000);
});


Livewire.on('updateConfigPartnerProviderScript', ()=>{
    var id = document.getElementById("IDUPdate").value;
    var partnerCode = document.getElementById("UpdatePartnerCode").value;
    var providerCode = document.getElementById("UpdateProviderCode").value;

    Livewire.emit("updateConfigPartnerProvider", id, partnerCode, providerCode);

    setTimeout(function(){
        Livewire.emit("resetMessage");
    }, 5000);

});
Livewire.on('getDataUpdateScript', id=>{
    var partnerCode = document.getElementById("partnerCode-" + id).value;
    var providerCode = document.getElementById("providerCode-" + id).value;

    document.getElementById("UpdatePartnerCode").value = partnerCode;
    document.getElementById("UpdateProviderCode").value = providerCode;
    document.getElementById("IDUPdate").value = id;

});

Livewire.on('deleteConfigPartnerProviderScript', id=>{
    var cFirm = confirm("Bạn chắc chắn muốn xóa ID: " + id + "?");
    if(cFirm){
        Livewire.emit('deleteConfigPartnerProvider', id);
    }

});

Livewire.on('addnewEbillConfigProviderScript', ()=>{
    var partnerCode = document.getElementById("addnewPartnerCode").value;
    var providerCode = document.getElementById("AddnewproviderCode").value;

    if(partnerCode == ''){
        alert('Bạn cần nhập partner code: ');
        document.getElementById("addnewPartnerCode").focus();
        return;
    }

    if(providerCode == ''){
        alert("Bạn cần nhập provider Code: ");
        document.getElementById("AddnewproviderCode").focus();
        return;
    }

    Livewire.emit("addnewEbillConfigProvider", partnerCode, providerCode);
    setTimeout(function(){
        Livewire.emit("resetMessage");
    }, 5000);
});

Livewire.on('searchEbillConfigProviderScript', ()=>{
    var partnerCode = document.getElementById("partnerCode").value;
    var providerCode = document.getElementById("providerCode").value;
    var startTime  = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit("searchEbillConfigProvider", partnerCode, providerCode, startTime, endTime);
});

