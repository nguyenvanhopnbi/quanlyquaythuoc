Livewire.on('ExportPaygateConfigScript', ()=>{
    var partner_code = document.getElementById("partner_code").value;
    var contract_number = document.getElementById("contract_number").value;

    Livewire.emit("ExportPaygateConfig", partner_code, contract_number);
});
