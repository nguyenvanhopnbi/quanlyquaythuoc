var timeCountSMS = 300;
    function countDownSMS(){
        timeCountSMS--;
        if(timeCountSMS != 0){
            document.getElementById("countDownSMS").innerHTML = timeCountSMS;
            setTimeout("countDownSMS()", 1000);
        }else{
            document.getElementById("countDownSMS").innerHTML = '';
            timeCountSMS = 300;
            return true;
        }
    }


Livewire.on('sendOtpSMSScript', ()=>{
    var sms = 'sms';
    var email = 'no';

    Livewire.emit('sendOtpTool', sms, email);
    var expire = countDownSMS();

    setTimeout(function(){
        Livewire.emit('resetButtonSMS');
    }, 60000);

});


var timeCountEmail = 300;
    function countDownEmail(){
        timeCountEmail--;
        if(timeCountEmail != 0){
            document.getElementById("countDownEmail").innerHTML = timeCountEmail;
            setTimeout("countDownEmail()", 1000);
        }else{
            document.getElementById("countDownEmail").innerHTML = '';
            timeCountEmail = 300;
            return true;
        }
    }


Livewire.on('sendOtpEmailScript', ()=>{
    var sms = 'no';
    var email = 'email';

    Livewire.emit('sendOtpTool', sms, email);

    var expire = countDownEmail();
    setTimeout(function(){
        Livewire.emit('resetButtonEmail');
    }, 60000);

});



Livewire.on('ResendTransactionScript', ()=>{

    var account_no = document.getElementById("account_no").value;
    var amount = document.getElementById("amount").value;
    var provider_ref_id = document.getElementById("provider_ref_id").value;
    var transaction_time = document.getElementById("transaction_time").value;
    var memo = document.getElementById("memo").value;
    var provider = document.getElementById("provider").value;
    var emailCode = document.getElementById("maEmail").value;
    var phoneCode = document.getElementById("maSmS").value;

    if(account_no == ''){
        alert('Bạn phải nhập Account No: ');
        document.getElementById("account_no").focus();
        return;
    }

    if(amount == ''){
        alert('Bạn phải nhập amount: ');
        document.getElementById("amount").focus();
        return;
    }

    if(provider_ref_id == ''){
        alert('Bạn phải nhập Provider Ref ID: ');
        document.getElementById("provider_ref_id").focus();
        return;
    }

    if(transaction_time == ''){
        alert('Bạn phải nhập Transaction Time: ');
        document.getElementById("transaction_time").focus();
        return;
    }

    var cFirm = confirm("Bạn có chắc chắn muốn resend? Account No: " + account_no);
    if(!cFirm){
        return;
    }



    Livewire.emit('ResendTransaction',
        account_no, amount, provider_ref_id, transaction_time, provider, memo, emailCode, phoneCode
        );
});


Livewire.on('ImportVAProviderTESTScript', ()=>{
    Livewire.emit('ImportVAProviderTEST');
});
Livewire.on('RequestMoneyBackScript', ()=>{
    var account_no = document.getElementById("account_no").value;
    var transaction_number = document.getElementById("XXXtransaction_number").value;

    if(account_no == ''){
        alert("Bạn cần nhập Account No: ");
        document.getElementById("account_no").focus();
        return;
    }

    if(transaction_number == ''){
        alert("Bạn cần nhập Transaction Number: ");
        document.getElementById("XXXtransaction_number").focus();
        return;
    }

    Livewire.emit("RequestMoneyBack", account_no, transaction_number);
});


Livewire.on('ImportVAProviderScript', ()=>{

    var input = document.getElementById('fileXLSXinput');
    var number = [];
    var provider_code = document.getElementById("provider_code").value;
    var data = document.getElementById("XXXData").value;
    var dataArray = [];
    var value = '';


    if(input.value == ''){

        for(var i = 0; i < data.length ; i++){
            if(data[i] != '\n'){
                value = value + data[i];
            }

            if(data[i] == '\n' || i == (data.length - 1)){
                dataArray.push(value);
                value = '';
            }

        }

        Livewire.emit('ImportVAProvider', provider_code, dataArray);

        return;
    }



    readXlsxFile(input.files[0]).then(function(dataxls){

        for(var j = 0; j < dataxls.length; j++){
            if(dataxls[j][2] != 'CARD_NUMBER'){
                 number.push(dataxls[j][2]);
            }

        }

        for(var i = 0; i < data.length ; i++){
            if(data[i] != '\n'){
                value = value + data[i];
            }

            if(data[i] == '\n' || i == (data.length - 1)){
                dataArray.push(value);
                value = '';
            }

        }

        var dataArrayFull = dataArray.concat(number);

        Livewire.emit('ImportVAProvider', provider_code, dataArrayFull);


    });

});
