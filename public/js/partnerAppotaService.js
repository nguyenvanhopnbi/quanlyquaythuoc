Livewire.on('pushDetailUpdateScript', ()=>{
    var detail = document.getElementById("appota_service_detail_update").value;
    Livewire.emit('pushDetailUpdate', detail);
    document.getElementById("appota_service_detail_update").value = '';
})

Livewire.on('UpdatePartnerAppotaServiceScript', ()=>{
    var id = document.getElementById("ID_UpdatePartnerAppotaService").value;
    var partner_code = document.getElementById("partner_code_update").value;
    var appota_service_code = document.getElementById("appota_service_code_update").value;
    var title = document.getElementById("appota_service_title_update").value;
    var point = document.getElementById("appota_service_point_update").value;
    var isActive = document.getElementById("isActive_update");
    var isActiveValue;
    if(isActive.checked){
        isActiveValue = 1;
    }else{
        isActiveValue = 0;
    }

    var detail = myClassicEditorUpdate.getData();

    Livewire.emit('UpdatePartnerAppotaService',
        id,
        partner_code,
        appota_service_code,
        title,
        point,
        isActiveValue,
        detail
        );
    setTimeout(function(){
        Livewire.emit('resetMessage');
    }, 6000);
});

Livewire.on('getDateTablePartnerAppotaServiceScript', id=>{
    var partner_code = document.getElementById("PartnerCode-" + id).value;
    var appota_service_code = document.getElementById("AppotaServiceCode-" + id).value;
    var title = document.getElementById("title-" + id).value;
    var detail = document.getElementById("details-" + id).value;
    var point = document.getElementById("point-" + id).value;
    var isactive = document.getElementById("isActive-" + id).value;

    myClassicEditorUpdate.setData(detail);

    document.getElementById('partner_code_update').value = partner_code;
    document.getElementById('appota_service_code_update').value = appota_service_code;
    document.getElementById('appota_service_title_update').value = title;
    // document.getElementById('appota_service_detail_update').value = detail;
    document.getElementById('appota_service_point_update').value = point;

    if(isactive == 1){
        document.getElementById('isActive_update').checked = true;
    }else{
        document.getElementById('isActive_update').checked = false;
    }
    document.getElementById("ID_UpdatePartnerAppotaService").value = id;
    Livewire.emit('pushDataDetailUpdate', detail, id);

})

Livewire.on('deletePartnerAppotaServiceScript', id=>{
    var cFirm = confirm("Are you sure to delete ID: " + id);
    if(cFirm){
        Livewire.emit('deletePartnerAppotaService', id);
    }
})


Livewire.on('savePartnerAppotaServiceScript', ()=>{
    var partner_code = document.getElementById("partner_code").value;
    var appota_service_code = document.getElementById("appota_service_code").value;
    var title = document.getElementById("appota_service_title").value;
    // var detail = document.getElementById("appota_service_details_add").value;
    var point = document.getElementById("appota_service_point").value;
    var isActive = document.getElementById("isActive");

    var detail = myClassicEditorAddnew.getData();

    Livewire.emit('savePartnerAppotaService',
        partner_code,
        appota_service_code,
        title,
        detail,
        point,
        isActive.checked
        );

    setTimeout(function(){
        Livewire.emit('resetMessage');
    }, 6000);
})


Livewire.on('pushDetailScript', ()=>{
    var details = document.getElementById("appota_service_detail").value;
    Livewire.emit('pushDetail', details);
    document.getElementById("appota_service_detail").value = '';
})

Livewire.on('searchPartnerAppotaServiceScript', ()=>{
    var partner_code = document.getElementById("search_partner_code").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit('searchPartnerAppotaService', partner_code, startTime, endTime);
})
