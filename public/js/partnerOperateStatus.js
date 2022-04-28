

Livewire.on('UpdatePartnerOperateStatusScript', ()=>{
    var PartnerCode = document.getElementById("partner_code_Update").value;
    var Title = document.getElementById("partner_business_title_update").value;
    var detail = myClassicEditorUpdate.getData();
    var point = document.getElementById("partner_business_point").value;
    var id = document.getElementById("IDPartnerCo").value;

    Livewire.emit("UpdatePartnerOperateStatus", id, PartnerCode, Title, detail, point );
})

Livewire.on('getDateTablePartnerCooperateScript', id=>{
    var id = document.getElementById("IDPartner-" + id).value;

    var PartnerCode = document.getElementById("PartnerCode-" + id).value;
    var Title = document.getElementById("Title-" + id).value;
    var Details = document.getElementById("Details-" + id).value;
    var Point = document.getElementById("Point-" + id).value;

    document.getElementById("partner_code_Update").value = PartnerCode;
    document.getElementById("partner_business_title_update").value = Title;

    myClassicEditorUpdate.setData(Details);

    document.getElementById("partner_business_point").value = Point;
    document.getElementById("IDPartnerCo").value = id;

})

Livewire.on('deletePartnerOperateStatusScript', id=>{
    var cFirm = confirm("Are you sure to delete ID: " + id + "?");
    if(cFirm){
        Livewire.emit("deletePartnerOperateStatus", id);
    }
})

Livewire.on('savePartnerOperateStatusScript', ()=>{
    var partner_code = document.getElementById("partner_code").value;

    var title = document.getElementById("partner_title").value;
    var detail = myClassicEditorAddnew.getData();

    var point = document.getElementById("partner_point").value;
    // alert(detail);
    Livewire.emit("savePartnerOperateStatus", partner_code, title, detail, point);
})

Livewire.on('searchPartnerOperateScript', ()=>{
    var partner_code = document.getElementById("search_partner_code").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit("searchPartnerOperate", partner_code, startTime, endTime);
})
