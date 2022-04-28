Livewire.on('UpdatePartnerDocumentTimeResponseScript', ()=>{
    var id = document.getElementById("partnerDocumentID").value;
    var partner_code = document.getElementById("partner_code_Update").value;
    var title = document.getElementById("partner_business_title_update").value;
    var point = document.getElementById("partner_business_point").value;
    var detail = myClassicEditorUpdate.getData();

    Livewire.emit("UpdatePartnerDocumentTimeResponse", id, partner_code, title, point, detail);
})

Livewire.on('getDateTablePartnerDocumentTimeResponseScript', id=>{
    var partner_code = document.getElementById("partner_code-" + id).value;
    var title = document.getElementById("title-" + id).value;
    var detail = document.getElementById("detail-" + id).value;
    var point = document.getElementById("point-" + id).value;

    document.getElementById("partner_code_Update").value = partner_code;
    document.getElementById("partner_business_title_update").value = title;
    myClassicEditorUpdate.setData(detail);
    document.getElementById("partner_business_point").value = point;
    document.getElementById("partnerDocumentID").value = id;
})

Livewire.on('deletePartnerDocumentTimeResponseScript', id=>{
    var cFirm = confirm("Are you sure to delete this ID: " + id + "?");
    if(cFirm){
        Livewire.emit('deletePartnerDocumentTimeResponse', id);
    }
})

Livewire.on('savePartnerDocumentReportScript', ()=>{
    var partner_code = document.getElementById("partner_code").value;
    var title = document.getElementById("appota_partnerDocumentReport_title").value;
    var detail = myClassicEditorAddnew.getData();
    var point = document.getElementById("appota_service_point").value;

    Livewire.emit("savePartnerDocumentReport", partner_code, title, detail, point);
})

Livewire.on('searchPartnerDocumentTimeResponseScript', ()=>{
    var partner_code = document.getElementById("search_partner_code").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit("searchPartnerDocumentTimeResponse", partner_code, startTime, endTime);
})
