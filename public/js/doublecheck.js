

Livewire.on('ExportDoiSoatThuHoVoiPartnerScript', ()=>{
    var date = document.getElementById("TimeSearch").value;
    var providerCode = document.getElementById("providerCode").value;
    // Livewire.emit('ExportDoiSoatThuHoVoiPartner', date, providerCode);


    var protocol = window.location.protocol;
                var host = window.location.host;
                var url = protocol + '//' + host + '/';

                window.open(url + 'ebill-ipn-logs-doisoat-exportCSV?date='+date
                    +'&providerCode='+providerCode);


})

Livewire.on('SearchDoiSoatThuHoVoiPartnerScript', ()=>{
    var date = document.getElementById("TimeSearch").value;
    Livewire.emit('SearchDoiSoatThuHoVoiPartner', date);
});

Livewire.on('searchDoubleCheckScript', ()=>{
    var partnerCode = document.getElementById("search_partner_code").value;
    var status = document.getElementById("status").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit('searchDoubleCheck', partnerCode, status, startTime, endTime);
})

Livewire.on('confirmScript', id=>{
    Livewire.emit('confirmDoubleCheck', id);
})

Livewire.on('NoConfirmScript', ()=>{
    var id = document.getElementById("IDNotConfirm").value;
    var reason = document.getElementById("reasonTxt").value;

    Livewire.emit('NoconfirmDoubleCheck', id, reason);
})

Livewire.on('GetIDNoConfirmScript', id=>{
    document.getElementById("IDNotConfirm").value = id;
})

Livewire.on('GetDetailsScript', id=>{
    var logs = document.getElementById("logs-" + id).value;
    document.getElementById("mylogs").value = logs;
})

Livewire.on('changeConfirmScript', id=>{
    var cbx_status = document.getElementById("cbx_status-" + id).value;
    var Status = document.getElementById("Status-" + id).value;


    if(Status == 'pending' && cbx_status == 'processing' ){
         Livewire.emit('confirmDoubleCheck', id);
    }
    if(Status == 'pending' && cbx_status == 'non_processing' ){
        var reason = prompt("Lý do:");
        Livewire.emit('NoconfirmDoubleCheck', id, reason);
    }

})
