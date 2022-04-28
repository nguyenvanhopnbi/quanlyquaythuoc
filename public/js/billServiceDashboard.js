

Livewire.on('searchBillDashboardScript1', ()=>{
    var partner_code = document.getElementById("billservice_partnerCode").value;
    var startTime = document.getElementById("time-from-flash").value;
    var endTime = document.getElementById("time-to-flash").value;

    Livewire.emit('getBillChart1',
        partner_code,
        startTime,
        endTime

        );

})

