Livewire.on('exportPartnerCSVScript', ()=>{
    var name = document.getElementById("partner_Name").value;
    var partner_code = document.getElementById("partner_code").value;
    var email = document.getElementById("partner_Email").value;
    var phone_number = document.getElementById("partner_phoneNumber").value;
    var status = document.getElementById("partner_status").value;
    var accountType = document.getElementById("partner_accountType").value;

    Livewire.emit('exportPartnerCSV',
        name,
        partner_code,
        email,
        phone_number,
        status,
        accountType
        );

    setTimeout(function(){
        window.location.reload(true);
    }, 10000);
})
