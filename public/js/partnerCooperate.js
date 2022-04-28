Livewire.on('UpdatePartnerCooperateScript', ()=>{
    var partner_code = document.getElementById("partner_code_Update").value;
    var title = document.getElementById("partner_business_title_update").value;
    var detail = myClassicEditorUpdate.getData();
    var point = document.getElementById("partner_business_point").value;

    var id = document.getElementById("IDPartnerBusiness").value;
    Livewire.emit('UpdatePartnerCooperate', id, partner_code, title, detail, point);
})
Livewire.on('getDateTablePartnerCooperateScript', id=>{
    var partner_code = document.getElementById("PartnerCode-" + id).value;
    var title = document.getElementById("Title-" + id).value;
    var detail = document.getElementById("Detail-" + id).value;
    var point = document.getElementById("Point-" + id).value;

    document.getElementById("partner_code_Update").value = partner_code;
    document.getElementById("partner_business_title_update").value = title;
    myClassicEditorUpdate.setData(detail);
    document.getElementById("IDPartnerBusiness").value = id;
    document.getElementById("partner_business_point").value = point;

})
Livewire.on('deletePartnerCooperateScript', id=>{
    var cFirm = confirm("Are you sure to delete this ID: " + id);
    if(cFirm){
        Livewire.emit("deletePartnerCooperate", id);
    }
})

Livewire.on('savePartnerCooperateScript', ()=>{
    var partner_code = document.getElementById("partner_code").value;
    var title = document.getElementById("appota_service_title").value;
    var detail = myClassicEditorAddnew.getData();
    var point = document.getElementById("appota_service_point").value;

    Livewire.emit("savePartnerCooperate", partner_code, title, detail, point);

    setTimeout(function(){
        Livewire.emit('resetMessage');
    }, 6000);
})

Livewire.on('searchPartnerCooperateScript', ()=>{
    var partner_code = document.getElementById("search_partner_code").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit("searchPartnerCooperate", partner_code, startTime, endTime);
})
