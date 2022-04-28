Livewire.on('downloadCSVLotteryWinScript', ()=>{
    var startTimeSearch = document.getElementById("startTimeSearch").value;
    var endTimeSearch = document.getElementById("endTimeSearch").value;
    var phoneNumber = document.getElementById("phoneNumber").value;
    var fullName = document.getElementById("fullName").value;
    var status = document.getElementsByName("ds_status");
    for(var i = 0; i < status.length; i++){
        if(status[i].checked){
            var statusValue = status[i].value;
        }
    }

    var partnerCode = document.getElementById("partnerCode").value;
    var maBill = document.getElementById("maBill").value;
    var loaive = document.getElementById("loaive").value;

    Livewire.emit("downloadCSVLotteryWin",
        startTimeSearch,
        endTimeSearch,
        phoneNumber,
        fullName,
        statusValue,
        partnerCode,
        maBill,
        loaive
    );
});


Livewire.on('showDetailsLotteryWinPrizeScript', id=>{

    document.getElementById("detail-magiaodich").innerHTML = id;

    var createdAtDay = document.getElementById("createdAtDay-" + id).value;
    var createdAtTime = document.getElementById("createdAtTime-" + id).value;
    document.getElementById("thoigian-h-i-s").innerHTML = createdAtTime;
    document.getElementById("thoigian-d-m-y").innerHTML = createdAtDay;

    var billCode = document.getElementById("billCode-" + id).value;
    var drawIndex = document.getElementById("drawIndex-" + id).value;
    document.getElementById("chitietMabill").innerHTML = billCode;
    document.getElementById("chitietKiQuay").innerHTML = drawIndex;

    var IDDetails = document.getElementById("ID-Details-" + id).value;

    Livewire.emit("showDetailsLotteryWinPrize", IDDetails);
    document.getElementById("modal-detail-lottery").style.display = "block";


})

Livewire.on('CloseDetailsLotteryPrizeScript', ()=>{
    document.getElementById("modal-detail-lottery").style.display = "none";
});

Livewire.on('SearchLotteryWinPrizeScript', ()=>{
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;
    var phoneNumber = document.getElementById("phoneNumber").value;
    var fullName = document.getElementById("fullName").value;
    var filterStatusButton = document.getElementById("filterStatusButton");

    var status = document.getElementsByName("ds_status");
    var statusValue = '';
    for(var i = 0; i < status.length; i++){
        if(status[i].checked){
            filterStatusButton.innerHTML = status[i].value;
            statusValue = status[i].value;
            // alert(status[i].value);
        }
    }
    var partnerCode = document.getElementById("partnerCode").value;
    var maBill = document.getElementById("maBill").value;
    var maVe = document.getElementById("maVe").value;
    var loaive = document.getElementById("loaive").value;

    Livewire.emit("SearchLotteryWinPrize",
        startTime,
        endTime,
        phoneNumber,
        fullName,
        statusValue,
        partnerCode,
        maBill,
        maVe,
        loaive
        );

});


Livewire.on('getDetailsScript', id=>{

    // $(document).ready(function(){
    //     $(".modal-detail").slideToggle();
    // });


    var lotteryTransactionId = document.getElementById("lotteryTransactionId-"+id).value;
    document.getElementById("lotteryTransactionId").innerHTML = lotteryTransactionId;

    var billcode  = document.getElementById("bill-code-" + id).value;
    document.getElementById("bill-code").innerHTML = billcode;

    var created_at = document.getElementById("created_at-" + id).value;
    document.getElementById("created_at").innerHTML = created_at;

    var created_at_time = document.getElementById("created_at_time-"+id).value;
    document.getElementById("created_at_time").innerHTML = created_at_time;

    var amountTickets = document.getElementById("amountTickets-" + id).value;
    document.getElementById("amountTickets").innerHTML = amountTickets;

    var price = document.getElementById("price-" + id).value;
    document.getElementById("price").innerHTML = price;

    var status = document.getElementById("status-" + id).value;
    document.getElementById("status").innerHTML = status;

    var providercode = document.getElementById("provider-code-" + id).value;
    document.getElementById("provider-code").innerHTML = providercode;

    var partnercode = document.getElementById("partner-code-" + id).value;
    document.getElementById("partner-code").innerHTML = partnercode;

    var saleChannel = document.getElementById("saleChannel-" + id).value;
    document.getElementById("saleChannel").innerHTML = saleChannel;

    var isWinTicket = document.getElementById("isWinTicket-" + id).value;
    document.getElementById("isWinTicket").innerHTML = isWinTicket;

    var lotteryName = document.getElementById("lotteryName-" + id).value;
    document.getElementById("lotteryName").innerHTML = lotteryName;

    var drawTime = document.getElementById("drawTime-" + id).value;
    document.getElementById("drawTime").innerHTML = drawTime;

    var partnerprice = document.getElementById("partner-price-" + id).value;
    document.getElementById("partner-price").innerHTML = partnerprice;

    var providerprice = document.getElementById("provider-price-" + id).value;
    document.getElementById("provider-price").innerHTML = providerprice;



   document.getElementsByClassName("modal-detail")[0].style.display="block";

   Livewire.emit("getDetails", id);

})

Livewire.on('CLoseDetailsScript', ()=>{
    document.getElementsByClassName("modal-detail")[0].style.display="none";
})


Livewire.on('downloadCSVScript', ()=>{
    var startTimeSearch = document.getElementById("startTimeSearch").value;
    var endTimeSearch = document.getElementById("endTimeSearch").value;
    var magiaodich = document.getElementById("magiaodich").value;
    var mabill = document.getElementById("mabill").value;
    var status = document.getElementById("status").value;
    var partnerCode = document.getElementById("partnerCode").value;
    var providerCode = document.getElementById("providerCode").value;
    var Ketqua = document.getElementById("Ketqua").value;
    var Loaive = document.getElementById("Loaive").value;


    Livewire.emit('downloadCSV1',
        startTimeSearch,
        endTimeSearch,
        magiaodich,
        mabill,
        status,
        partnerCode,
        providerCode,
        Ketqua,
        Loaive
        );
})

Livewire.on('SearchLotteryScript', ()=>{
    var startTimeSearch = document.getElementById("startTimeSearch").value;
    var endTimeSearch = document.getElementById("endTimeSearch").value;
    var magiaodich = document.getElementById("magiaodich").value;
    var mabill = document.getElementById("mabill").value;
    var status = document.getElementById("status").value;
    var partnerCode = document.getElementById("partnerCode").value;
    var providerCode = document.getElementById("providerCode").value;
    var Ketqua = document.getElementById("Ketqua").value;
    var Loaive = document.getElementById("Loaive").value;

    Livewire.emit('SearchLottery',
        startTimeSearch,
        endTimeSearch,
        magiaodich,
        mabill,
        status,
        partnerCode,
        providerCode,
        Ketqua,
        Loaive
        );

})

Livewire.on('PageSizeScript', ()=>{
    var pageSize = document.getElementById("select-page-size").value;
    Livewire.emit('PageSize', pageSize);
})


