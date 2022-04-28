Livewire.on('UpdatePartnerDocumentReportScript', ()=>{
    var id = document.getElementById("partnerDocumentID").value;
    var partnerCode = document.getElementById("partner_code_Update").value;
    var title = document.getElementById("partner_business_title_update").value;
    var detail = myClassicEditorUpdate.getData();
    var point = document.getElementById("partner_business_point").value;
    var day = document.getElementById("updateDay").value;
    var sumDocument = document.getElementById("UpdatesumDocument").value;
    var sumDocumentMiss = document.getElementById("UpdatesumDocumentMiss").value;

    Livewire.emit("UpdatePartnerDocumentReport",
        id,
        partnerCode,
        title,
        detail,
        point,
        day,
        sumDocument,
        sumDocumentMiss
        );
})

Livewire.on('getDateTablePartnerDocumentReportScript', id=>{
    var partnerCode = document.getElementById("partnerCode-"+ id).value;
    var title = document.getElementById("title-" + id).value;
    var detail = document.getElementById("detail-" + id).value;
    var point = document.getElementById("point-" + id).value;
    var day = document.getElementById("day-" + id).value;
    var sumDocument = document.getElementById("sum_document-"+ id).value;
    var sumDocumentMiss = document.getElementById("sum_document_miss-" + id).value;


    document.getElementById("partner_code_Update").value = partnerCode;
    document.getElementById("partner_business_title_update").value = title;

    myClassicEditorUpdate.setData(detail);

    document.getElementById("partner_business_point").value = point;
    document.getElementById("updateDay").value = day;
    document.getElementById("UpdatesumDocument").value = sumDocument;
    document.getElementById("UpdatesumDocumentMiss").value = sumDocumentMiss;
    document.getElementById("partnerDocumentID").value = id;


})
Livewire.on('deletePartnerDocumentReportScript', id=>{
    var cFirm = confirm("Are you sure to delete this ID: " + id);
    if(cFirm){
        Livewire.emit("deletePartnerDocumentReport", id);
    }
})
Livewire.on('savePartnerDocumentReportScript', ()=>{
    var partnerCode = document.getElementById("partner_code").value;
    var title = document.getElementById("appota_partnerDocumentReport_title").value;
    var detail = myClassicEditorAddnew.getData();
    var point = document.getElementById("appota_service_point").value;
    var sumDocument = document.getElementById("sumDocument").value;
    var sumDocumentMiss = document.getElementById("sumDocumentMiss").value;
    var day = document.getElementById("addnewDay").value;

    Livewire.emit("savePartnerDocumentReport", partnerCode, title, detail, point, sumDocument, sumDocumentMiss, day);

    setTimeout(function(){
        Livewire.emit("resetMessage");
    }, 6000);
})

Livewire.on('searchPartnerDocumentReportScript', ()=>{
    var partnerCode = document.getElementById("search_partner_code").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit("searchPartnerDocumentReport", partnerCode, startTime, endTime);
})
