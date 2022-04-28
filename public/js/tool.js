Livewire.on('UpdateToolScript', ()=>{
    var transaction_id = document.getElementById("tool_transactionid").value;
    var bankrefID = document.getElementById("tool_bank_ref_id").value;
    var toolVendor = document.getElementById("tool_vendor").value;
    var today = document.getElementById("tool_time_today");

    if(transaction_id == ''){
        alert('Please enter transaction ID');
        document.getElementById("tool_transactionid").focus();
        return;
    }
    if(bankrefID == ''){
        alert('Please enter bank ref ID');
        document.getElementById("tool_bank_ref_id").focus();
        return;
    }
    if(toolVendor == ''){
        alert('Please enter vendor');
        document.getElementById("tool_vendor").focus();
        return;
    }

    if(today.checked){
        today = 1;
    }else{
        today = 0;
    }
    Livewire.emit('UpdateTool',
        transaction_id,
        bankrefID,
        toolVendor,
        today
        );

    setTimeout(function(){
        Livewire.emit('resetMessage');
    }, 8000);
})
