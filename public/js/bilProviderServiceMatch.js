Livewire.on('checkPartnerCodeScript', ()=>{
    var partner_code = document.getElementById("partner_code1").value;
    Livewire.emit('checkPartnerCode', partner_code);
})
