Livewire.on('holdingScript', ()=>{
    var transaction_id = document.getElementById("transactionIDModel").value;
    var reason = document.getElementById("reason").value;

    Livewire.emit('holding', transaction_id, reason);
})


Livewire.on('unholdingScript', ()=>{
    var transaction_id = document.getElementById("transactionIDUnhold").value;
    var reason = document.getElementById("reason_unhold").value;

    Livewire.emit('unholding', transaction_id, reason);
})
