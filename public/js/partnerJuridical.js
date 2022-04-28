



Livewire.on('UpdatePartnerJuridicalScript', ()=>{
    var partner_code = document.getElementById("partner_code_Update").value;
    var title = document.getElementById("partner_business_title_update").value;
    var details = myClassicEditorUpdate.getData();
    var point = document.getElementById("partner_business_point").value;

    if(isNaN(point)){
        alert("Point must be numberic!");
        document.getElementById("partner_business_point").focus();
        return;
    }

    var id = document.getElementById("IDPartnerCo").value;

    Livewire.emit("UpdatePartnerJuridical", id, partner_code, title, details, point);
})

Livewire.on('getDateTablePartnerCooperateScript', id=>{
    var partner_code = document.getElementById("PartnerCode-" + id).value;
    var Title = document.getElementById("Title-" + id).value;
    var Details = document.getElementById("Details-" + id).value;
    var Point = document.getElementById("Point-" + id).value;

    document.getElementById("IDPartnerCo").value = id;
    document.getElementById("partner_code_Update").value = partner_code;
    document.getElementById("partner_business_title_update").value = Title;

    myClassicEditorUpdate.setData(Details);
    // document.getElementById("partner_code_Update").value = Details;

    document.getElementById("partner_business_point").value = Point;
})

Livewire.on('deletePartnerCooperateScript', id=>{
    var cFirm = confirm("Are you sure to delete ID: " + id + "?");
    if(cFirm){
        Livewire.emit("deletePartnerCooperate", id);
    }
})

Livewire.on('savePartnerJuridicalScript', ()=>{
    var partner_code = document.getElementById("partner_code").value;
    var title = document.getElementById("partner_title").value;
    var detail = myClassicEditorAddnew.getData();
    var point = document.getElementById("partner_point").value;

    if(isNaN(point)){
        alert("Point must be numberic!");
        document.getElementById("partner_point").focus();
        return;
    }

    Livewire.emit("savePartnerJuridical", partner_code, title, detail, point);
    setTimeout(function(){
        Livewire.emit("resetMessage");
    }, 6000);
})

Livewire.on('searchPartnerJuridicalScript', ()=>{
    var partner_code = document.getElementById("search_partner_code").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit("searchPartnerJuridical", partner_code, startTime, endTime);
})
