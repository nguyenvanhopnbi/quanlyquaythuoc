Livewire.on('ExportTransactionHoldScript', ()=>{
    var PartnerCode = document.getElementById("partnerCodeSearch").value;
    var startTimeSearch = document.getElementById("startTimeSearch").value;
    var endTimeSearch = document.getElementById("endTimeSearch").value;
    var transactionID = document.getElementById("TransactionID").value;

    Livewire.emit("exportTransactionHold", PartnerCode, startTimeSearch, endTimeSearch, transactionID);
});

Livewire.on('exportTransactionUnholdScript', ()=>{
    var PartnerCode = document.getElementById("PartnerCode").value;
    var startTimeSearch = document.getElementById("startTimeSearch").value;
    var endTimeSearch = document.getElementById("endTimeSearch").value;
    var transactionID = document.getElementById("TransactionID").value;

    Livewire.emit("exportTransactionUnhold", PartnerCode, startTimeSearch, endTimeSearch, transactionID);
})

Livewire.on('searchTransactionUnholdScript', ()=>{
    var PartnerCode = document.getElementById("PartnerCode").value;
    var startTimeSearch = document.getElementById("startTimeSearch").value;
    var endTimeSearch = document.getElementById("endTimeSearch").value;
    var transactionID = document.getElementById("TransactionID").value;

    Livewire.emit("searchTransactionUnhold", PartnerCode, startTimeSearch, endTimeSearch, transactionID);
})


Livewire.on('HoldTransactionScript', transactionID=>{
    var reason = prompt("Bắt buộc nhập lý do hold giao dịch này!");
    if(reason == ''){
        do{
            reason = prompt("Bắt buộc nhập lý do hold giao dịch này!");
        }while(reason == '');
    }else{
        Livewire.emit("HoldTransaction", transactionID, reason);
    }


})

Livewire.on('SearchTransactionHoldScript', ()=>{
    var partnerCodeSearch = document.getElementById("partnerCodeSearch").value;
    var startTimeSearch = document.getElementById("startTimeSearch").value;
    var endTimeSearch = document.getElementById("endTimeSearch").value;
    var transactionID = document.getElementById("TransactionID").value;

    Livewire.emit("SearchTransactionHold", partnerCodeSearch, startTimeSearch, endTimeSearch, transactionID);
})
