Livewire.on('EditEbillPartnerProviderScript', ()=>{
    var partner_code = document.getElementById("partner_code_edit").value;
    var bank_code = document.getElementById("Bank_code_edit").value;
    var provider_code = document.getElementById("provider_code_edit").value;
    var id = document.getElementById("ID_Update").value;

    Livewire.emit("EditEbillPartnerProvider", partner_code, bank_code, provider_code, id);
});

Livewire.on('getDateTableEbillBankPartnerProviderScript', id=>{
    var partner_code = document.getElementById("partner_code-" + id).value;
    var bank_code = document.getElementById("bank_code-" + id).value;
    var provider_code = document.getElementById("provider_code-" + id).value;

    document.getElementById("partner_code_edit").value = partner_code;
    document.getElementById("Bank_code_edit").value = bank_code;
    document.getElementById("provider_code_edit").value = provider_code;
    document.getElementById("ID_Update").value = id;
});

Livewire.on('SearchEbillBankPartnerProviderScript', ()=>{
    var partnerCode = document.getElementById("searchPartnerCode").value;
    var searchBankCode = document.getElementById("searchBankCode").value;
    var searchProviderCode = document.getElementById("searchProviderCode").value;
    var startTimeSearch = document.getElementById("startTimeSearch").value;
    var endTimeSearch = document.getElementById("endTimeSearch").value;

    Livewire.emit("SearchEbillBankPartnerProvider",
        partnerCode,
        searchBankCode,
        searchProviderCode,
        startTimeSearch,
        endTimeSearch
    );
})

Livewire.on('deleteEbillBLankPartnerProviderScript', id=>{
    var cFirm = confirm("Bạn có chắc chắn muốn xóa?");
    if(cFirm){
        Livewire.emit("deleteEbillBLankPartnerProvider", id);
    }
})


Livewire.on('saveNewEbillPartnerProviderScript', ()=>{
    var partner_code = document.getElementById("partner_code").value;
    var Bank_code = document.getElementById("Bank_code").value;
    var provider_code = document.getElementById("provider_code").value;

    Livewire.emit("saveNewEbillPartnerProvider", partner_code, Bank_code, provider_code);
});



Livewire.on('searchEbillBankScript', ()=>{
    var bank_code = document.getElementById("bank_code_search").value;
    var bank_name = document.getElementById("bank_name_search").value;
    var active = document.getElementById("active_search").value;
    var transer_provider_code_search = document.getElementById("transer_provider_code_search").value;
    var ebill_provider_code_search = document.getElementById("ebill_provider_code_search").value;
    var startTimeSearch = document.getElementById("startTimeSearch").value;
    var endTimeSearch = document.getElementById("endTimeSearch").value;

    Livewire.emit("searchEbillBank",
        bank_code,
        bank_name,
        active,
        transer_provider_code_search,
        ebill_provider_code_search,
        startTimeSearch,
        endTimeSearch
        );
})

Livewire.on('updateEbillBankScript', ()=>{
    var ebill_bank_code = document.getElementById("ebill_bank_code_update").value;
    var ebill_bank_name = document.getElementById("ebill_bank_name_update").value;
    var ebill_active = document.getElementById("ebill_active_update").value;
    var ebill_transfer_provider_code = document.getElementById("ebill_transfer_provider_code_update").value;
    var ebill_provider_code = document.getElementById("ebill_provider_code_update").value;
    var id = document.getElementById("ID_UPdate").value;

    Livewire.emit('updateEbillBank',
        id,
        ebill_bank_code,
        ebill_bank_name,
        ebill_active,
        ebill_transfer_provider_code,
        ebill_provider_code
        );
})

Livewire.on('getDateTableEbillBankScript', id=>{

    var ebill_bank_code = document.getElementById("bank_code-" + id).value;

    // var ebill_bank_name = document.getElementById("bank_name-" + id).value;

    var ebill_active = document.getElementById("active-" + id).value;

    var ebill_transfer_provider_code = document.getElementById("transfer_provider_code-" + id).value;

    // var ebill_provider_code = document.getElementById("ebill_provider_code-" + id).value;

    document.getElementById("ID_UPdate").value = id;
    document.getElementById("ebill_bank_code_update").value = ebill_bank_code;
    document.getElementById("ebill_bank_name_update").value = 'no value';
    document.getElementById("ebill_active_update").value = ebill_active;
    document.getElementById("ebill_transfer_provider_code_update").value = ebill_transfer_provider_code;
    document.getElementById("ebill_provider_code_update").value = 'no value';


})

Livewire.on('deleteEbillBLankScript', id=>{
    var cFirm = confirm("Bạn có chắc chắn muốn xóa ?");
    if(cFirm){
        Livewire.emit("deleteEbillBLank", id);
    }
})

Livewire.on('saveNewEbillBankScript', ()=>{
    var ebill_bank_code = document.getElementById("ebill_bank_code").value;
    var ebill_bank_name = document.getElementById("ebill_bank_name").value;
    var ebill_active = document.getElementById("ebill_active").value;
    var ebill_transfer_provider_code = document.getElementById("ebill_transfer_provider_code").value;
    var ebill_provider_code = document.getElementById("ebill_provider_code").value;

    Livewire.emit('saveNewEbillBank',
        ebill_bank_code,
        ebill_bank_name,
        ebill_active,
        ebill_transfer_provider_code,
        ebill_provider_code
        );
})
