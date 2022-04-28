Livewire.on('searchPartnerConfigProviderScript', ()=>{
    var providerCode = document.getElementById("search_provider_code").value;
    var partnerCode = document.getElementById("search_partner_code").value;

    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit('searchPartnerConfigProvider', providerCode, partnerCode, startTime, endTime);
})

Livewire.on('addnewPartnerCodeConfigScript', ()=>{
    var providerCode = document.getElementById("providerCodeAddnew").value;
    var partnerCode = document.getElementById("partnerCodeAddnew").value;

    if(providerCode == ''){
        alert('Cần nhập provider Code!');
        document.getElementById("providerCodeAddnew").focus();
        return;
    }
    if(partnerCode == ''){
        alert('Cần nhập partner Code!');
        document.getElementById("partnerCodeAddnew").focus();
        return;
    }

    Livewire.emit("addnewPartnerCodeConfig", providerCode, partnerCode);

    setTimeout(function(){
        document.getElementById("providerCodeAddnew").value = '';
        document.getElementById("partnerCodeAddnew").value = '';
        // Livewire.emit('resetMessage');
    }, 6000);
})

Livewire.on('deletePartnerProviderConfigScript', id=>{
    var cFirm = confirm("Bạn chắc chắn xoá ID: " + id + " ?");
    if(cFirm){
        Livewire.emit("deletePartnerProviderConfig", id);
    }

})
Livewire.on('getDateTablePartnerProviderConfigScript', id =>{
    document.getElementById("providerCodeUpdate").value = document.getElementById("providerCode-" + id).value;
    document.getElementById("partnerCodeUpdate").value = document.getElementById("partnerCode-" + id).value;
    document.getElementById("IDUPdate").value = document.getElementById("ID-" + id).value;
})
Livewire.on('UpdatePartnerCodeConfigScript', ()=>{
    var providerCode = document.getElementById("providerCodeUpdate").value;
    var partnerCode = document.getElementById("partnerCodeUpdate").value;
    var id = document.getElementById("IDUPdate").value;

    if(providerCode == ''){
        alert('Cần nhập Provider Code.');
        document.getElementById("providerCodeUpdate").focus();
        return;
    }
    if(partnerCode == ''){
        alert('Cần nhập Partner Code.');
        document.getElementById("partnerCodeUpdate").focus();
        return;
    }

    Livewire.emit("PartnerProviderConfigUpdate", id, providerCode, partnerCode);

    setTimeout(function(){
        // Livewire.emit('resetMessage');
    }, 6000);
})
