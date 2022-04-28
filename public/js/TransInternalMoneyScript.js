Livewire.on('SearchTransInternalMoneyScript', ()=>{
    var transaction_id = document.getElementById("transaction_id").value;
    var ref_transaction_id = document.getElementById("ref_transaction_id").value;
    var from_account_no = document.getElementById("from_account_no").value;
    var from_account_name = document.getElementById("from_account_name").value;
    var from_bank_code = document.getElementById("from_bank_code").value;
    var to_account_no = document.getElementById("to_account_no").value;
    var to_account_name = document.getElementById("to_account_name").value;
    var to_bank_code = document.getElementById("to_bank_code").value;
    var amount = document.getElementById("amount").value;
    var status = document.getElementById("status").value;
    var startTimeSearch = document.getElementById("startTimeSearch").value;
    var endTimeSearch = document.getElementById("endTimeSearch").value;

    Livewire.emit('SearchTransInternalMoney',
        transaction_id,
        ref_transaction_id,
        from_account_no,
        from_account_name,
        from_bank_code,
        to_account_no,
        to_account_name,
        to_bank_code,
        amount,
        status,
        startTimeSearch,
        endTimeSearch
        );
});
