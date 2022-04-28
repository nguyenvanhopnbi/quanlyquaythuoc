Livewire.on('refundMocaScript', ()=>{
    var transaction_id = document.getElementById("transaction_id_value").value;
    var amount = document.getElementById("amount").value;
    var reason = document.getElementById("reason").value;

    if(amount == '' || amount == null){
        alert("Bạn cần nhập số tiền refund.");
        document.getElementById("amount").focus();
        return;
    }
    if(reason == ''){
        alert("Bạn cần nhập lý do refund.");
        document.getElementById("amount").focus();
        return;
    }
    Livewire.emit("refundMoca", transaction_id, amount, reason);

    // buildAmoutInput();
});

Livewire.on('refreshNumberFormat', () => {
    buildAmoutInput();
})





