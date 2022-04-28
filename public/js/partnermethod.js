Livewire.on('searchPartnerMethodScript', ()=>{
    var partner_code = document.getElementById("search_partnerCode").value;
    var payment_method = document.getElementById("search_payment_method").value;

    Livewire.emit('searchPartnerMethod', partner_code, payment_method);
})
Livewire.on('savePartnerCodeMethodScript', ()=>{
    var partner_code = document.getElementById("partner_code").value;
    var payment_method = document.getElementById("payment_method").value;

    Livewire.emit('savePartnerCodeMethod', partner_code, payment_method);

    setTimeout(function(){
        Livewire.emit('resetMessage');
    }, 7000);
})

Livewire.on('getDataUpdateScript', id=>{
    var partner_code = document.getElementById("partnerCode-" + id).value;
    var payment_method = document.getElementById("payment-method-" + id).value;

    document.getElementById("idPartnerMethod").value = id;
    document.getElementById("partner_code_update").value = partner_code;
    document.getElementById("payment_method_update").value = payment_method;



})

Livewire.on('DataUpdateScript', ()=>{
    // document.getElementById("partnermethodUpdateloadling").style.display = "";

    var id = document.getElementById("idPartnerMethod").value;
    var partner_code = document.getElementById("partner_code_update").value;
    var payment_method = document.getElementById("payment_method_update").value;

    Livewire.emit('DataUpdate', id, partner_code, payment_method);
})

Livewire.on('deletePartnerMethodScript', id=>{
    var cFirm = confirm('Are you sure to delete this ID ' + id + "?");
    if(cFirm){
        Livewire.emit('deletePartnerMethod', id);
    }
})

Livewire.on('detailPartnerMethod', id=>{
    var partner_code = document.getElementById("partnerCode-" + id).value;
    var payment_method = document.getElementById("payment-method-" + id).value;
    var updateAt = document.getElementById("updateAt-" + id).value;
    var createAt = document.getElementById("createAt-" + id).value;

    document.getElementById("id_details").value = id;
    document.getElementById("partner_code_details").value = partner_code;
    document.getElementById("payment_method_details").value = payment_method;
    document.getElementById("create_At_details").value = createAt;
    document.getElementById("update_At_details").value = updateAt;
})
