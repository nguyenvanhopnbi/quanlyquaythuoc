Livewire.on('deletePartnerBusinessScript', id=>{
    var cFirm = confirm("Are you sure to delete ID: " + id + "?");
    if(cFirm){
        Livewire.emit('deletePartnerBusiness', id);
    }

})
Livewire.on('UpdatePartnerBusinessScript', ()=>{
    var id = document.getElementById("IDPartnerBusiness").value;
    var partner_code = document.getElementById("partner_code_Update").value;
    var title = document.getElementById("partner_business_title_update").value;
    var detail = myClassicEditorUpdate.getData();
    var point = document.getElementById("partner_business_point").value;

    Livewire.emit('UpdatePartnerBusiness',
        id,
        partner_code,
        title,
        detail,
        point
        );

    setTimeout(function(){
        Livewire.emit('resetMessage');
    }, 6000);
})

Livewire.on('getDateTablePartnerBusinessScript', id=>{
    var partner_code = document.getElementById("PartnerCode-" + id).value;
    var title = document.getElementById("Title-" + id).value;
    var detail = document.getElementById("Detail-" + id).value;
    var point = document.getElementById("Point-" + id).value;
    var updateAt = document.getElementById("UpdateAt-" + id).value;

    document.getElementById("partner_code_Update").value = partner_code;
    document.getElementById("partner_business_title_update").value = title;

    myClassicEditorUpdate.setData(detail);

    document.getElementById("partner_business_point").value = point;
    document.getElementById("IDPartnerBusiness").value = id;
    Livewire.emit('setID', id);
})

Livewire.on('savePartnerBusinessScript', ()=>{
    var partner_code = document.getElementById("partner_code").value;
    var title = document.getElementById("appota_service_title").value;
    var details = myClassicEditorAddnew.getData();
    var point = document.getElementById("appota_service_point").value;

    Livewire.emit('savePartnerBusiness',
        partner_code,
        title,
        details,
        point
        );
    setTimeout(function(){
        Livewire.emit('resetMessage');
    }, 6000);
})

Livewire.on('searchPartnerBusinessScript', ()=>{
    var partner_code = document.getElementById("search_partner_code").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit("searchPartnerBusiness", partner_code, startTime, endTime);
})
