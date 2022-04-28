var bankcode = '';

function checkBankCodeCC(bankcode, value){
    if(bankcode.hasOwnProperty("CC")){
        for(var i = 0; i < bankcode.CC.length; i++){
            if(bankcode.CC[i] == value){
                return true;
            }
        }
    }else{
        bankcode.CC = [];
        for(var i = 0; i < bankcode.CC.length; i++){
            if(bankcode.CC[i] == value){
                return true;
            }
        }
    }

    return false;
}

// function checkBankCodeMM(bankcode, value){
//     for(var i = 0; i < bankcode.MM.length; i++){
//         if(bankcode.MM[i] == value){
//             return true;
//         }
//     }
//     return false;
// }

function checkBankCodeEwallet(bankcode, value){
    if(bankcode.hasOwnProperty("EWALLET")){
        for(var i = 0; i < bankcode.EWALLET.length; i++){
            if(bankcode.EWALLET[i] == value){
                return true;
            }
        }
    }else{
        bankcode.EWALLET = [];
        for(var i = 0; i < bankcode.EWALLET.length; i++){
            if(bankcode.EWALLET[i] == value){
                return true;
            }
        }
    }

    return false;
}

function checkBankCodeVA(bankcode, value){
    if(bankcode.hasOwnProperty("VA")){
        for(var i = 0; i < bankcode.VA.length; i++){
            if(bankcode.VA[i] == value){
                return true;
            }
        }
    }else{
        bankcode.VA = [];
        for(var i = 0; i < bankcode.VA.length; i++){
            if(bankcode.VA[i] == value){
                return true;
            }
        }
    }

    return false;
}

function checkBankCodeMM(bankcode, value){
    // console.log(bankcode.MM);
     if(bankcode.hasOwnProperty("MM")){
        for(var i = 0; i < bankcode.MM.length; i++){
            if(bankcode.MM[i] == value){
                return true;
            }
        }
    }else{
        bankcode.MM = [];
        for(var i = 0; i < bankcode.MM.length; i++){
            if(bankcode.MM[i] == value){
                return true;
            }
        }
    }


    return false;
}

Livewire.on('resultScript', (msg)=>{
    console.log(msg.warning);
    if(msg.warning){
        Swal.fire(
          'Thất bại!',
          msg.message,
          'error'
        )
    }else{
        Swal.fire(
          'Thành công!',
          msg.message,
          'success'
        )
    }

});


Livewire.on('updateremoveBankcodeMMListScript', ()=>{
    var MMupdate = document.getElementById('MMupdate').value;

    var result = checkBankCodeMM(bankcode, MMupdate);
    if(result){
        var delArray = [];
        delArray.push(MMupdate);
        var bankCodeMM = bankcode.MM.filter(item => !delArray.includes(item));
        bankcode.MM = bankCodeMM;
        // console.log(bankcode);

        var MMupdateList = document.getElementById("MMupdateList");
        MMupdateList.innerHTML = '';

        for(var i = 0; i < bankcode.MM.length; i++){
            var li_mm = document.createElement("li");
            li_mm.appendChild(document.createTextNode(bankcode.MM[i]));
            MMupdateList.appendChild(li_mm);
        }

    }
});

Livewire.on('updateremoveBankcodeVAListScript', ()=>{
    var VAupdate = document.getElementById('VAupdate').value;

    var result = checkBankCodeVA(bankcode, VAupdate);
    if(result){
        var delArray = [];
        delArray.push(VAupdate);
        var bankCodeVA = bankcode.VA.filter(item => !delArray.includes(item));
        bankcode.VA = bankCodeVA;
        // console.log(bankcode);

        var VAupdateList = document.getElementById("VAupdateList");
        VAupdateList.innerHTML = '';

        for(var i = 0; i < bankcode.VA.length; i++){
            var li_va = document.createElement("li");
            li_va.appendChild(document.createTextNode(bankcode.VA[i]));
            VAupdateList.appendChild(li_va);
        }

    }
});

Livewire.on('updateremoveBankcodeEWALLETListScript', ()=>{
    var EWALLETupdate = document.getElementById('EWALLETupdate').value;

    var result = checkBankCodeEwallet(bankcode, EWALLETupdate);
    if(result){
        var delArray = [];
        delArray.push(EWALLETupdate);
        var bankCodeEwallet = bankcode.EWALLET.filter(item => !delArray.includes(item));
        bankcode.EWALLET = bankCodeEwallet;
        console.log(bankcode);

        var EWALLETupdateList = document.getElementById("EWALLETupdateList");
        EWALLETupdateList.innerHTML = '';

        for(var i = 0; i < bankcode.EWALLET.length; i++){
            var li_ewallet = document.createElement("li");
            li_ewallet.appendChild(document.createTextNode(bankcode.EWALLET[i]));
            EWALLETupdateList.appendChild(li_ewallet);
        }

    }
});


Livewire.on('updateremoveBankcodeCCListScript', ()=>{
    var CCupdate = document.getElementById('CCupdate').value;

    var result = checkBankCodeCC(bankcode, CCupdate);
    if(result){
        var delArray = [];
        delArray.push(CCupdate);
        var bankCodeCC = bankcode.CC.filter(item => !delArray.includes(item));
        bankcode.CC = bankCodeCC;
        // console.log(bankcode);

        var ccUpdateList = document.getElementById("ccUpdateList");
        ccUpdateList.innerHTML = '';

        for(var i = 0; i < bankcode.CC.length; i++){
            var li_cc = document.createElement("li");
            li_cc.appendChild(document.createTextNode(bankcode.CC[i]));
            ccUpdateList.appendChild(li_cc);
        }

    }



});

Livewire.on('updateAddBankcodeVAListScript', ()=>{
    var VAupdate = document.getElementById('VAupdate').value;
    if(VAupdate == ''){
        alert("Bạn cần chọn VA BankCode: ");
        document.getElementById('VAupdate').focus();
        return;
    }

    var result = checkBankCodeVA(bankcode, VAupdate);
    if(result == false){
        var bankCodeVAUpdate = document.getElementById("VAupdateList");
        var li_va = document.createElement("li");
        li_va.appendChild(document.createTextNode(VAupdate));
        bankCodeVAUpdate.appendChild(li_va);
        bankcode.VA.push(VAupdate);
    }else{
        alert("VA BankCode đã tồn tại trong danh sách rồi! ");
        document.getElementById('VAupdate').focus();
        return;
    }
});


Livewire.on('updateAddBankcodeMMListScript', ()=>{
    var MMupdate = document.getElementById('MMupdate').value;
    if(MMupdate == ''){
        alert("Bạn cần chọn MM BankCode: ");
        document.getElementById('MMupdate').focus();
        return;
    }

    var result = checkBankCodeMM(bankcode, MMupdate);
    // console.log('12121212' + result);
    if(result == false){
        var bankCodeMMUpdate = document.getElementById("MMupdateList");
        var li_mm = document.createElement("li");
        li_mm.appendChild(document.createTextNode(MMupdate));
        bankCodeMMUpdate.appendChild(li_mm);

        // console.log(bankcode.MM);
        bankcode.MM.push(MMupdate);
    }else{
        alert("MM BankCode đã tồn tại trong danh sách rồi! ");
        document.getElementById('MMupdate').focus();
        return;
    }
});

Livewire.on('removeaddBankcodeCCListScript', bank=>{
    Livewire.emit('removeaddBankcodeCCList', bank);
});

Livewire.on('removeaddBankcodeEWALLETListScript', bank=>{
    Livewire.emit('removeaddBankcodeEWALLETList', bank);
});

Livewire.on('removeaddBankcodeVAListScript', bank=>{
    Livewire.emit('removeaddBankcodeVAList', bank);
});

Livewire.on('removeaddBankcodeMMListScript', bank=>{
    Livewire.emit('removeaddBankcodeMMList', bank);
});

Livewire.on('updateAddBankcodeCCListScript', ()=>{
    // console.log('1111111111');
    // console.log(bankcode);
    var CCupdate = document.getElementById('CCupdate').value;
    if(CCupdate == ''){
        alert("Bạn cần chọn CC BankCode: ");
        document.getElementById('CCupdate').focus();
        return;
    }

    var result = checkBankCodeCC(bankcode, CCupdate);
    if(result == false){
        var bankCodeCCUpdate = document.getElementById("ccUpdateList");
        var li_cc = document.createElement("li");
        li_cc.appendChild(document.createTextNode(CCupdate));
        bankCodeCCUpdate.appendChild(li_cc);
        bankcode.CC.push(CCupdate);
    }else{
        alert("CC BankCode đã tồn tại trong danh sách rồi! ");
        document.getElementById('CCupdate').focus();
        return;
    }

});

Livewire.on('updateAddBankcodeEWALLETListScript', ()=>{
    var EWALLETupdate = document.getElementById('EWALLETupdate').value;
    if(EWALLETupdate == ''){
        alert("Bạn cần chọn EWALLET BankCode: ");
        document.getElementById('EWALLETupdate').focus();
        return;
    }

    var result = checkBankCodeEwallet(bankcode, EWALLETupdate);
    if(result == false){
        var bankCodeEWALLETUpdate = document.getElementById("EWALLETupdateList");
        var li_ewallet = document.createElement("li");
        li_ewallet.appendChild(document.createTextNode(EWALLETupdate));
        bankCodeEWALLETUpdate.appendChild(li_ewallet);
        bankcode.EWALLET.push(EWALLETupdate);
    }else{
        alert("EWALLET BankCode đã tồn tại trong danh sách rồi! ");
        document.getElementById('EWALLETupdate').focus();
        return;
    }
});

Livewire.on('updatePaymentMethodConfigScript', ()=>{
    var id = document.getElementById("IDUPDATE").value;
    var PartnerCodeUpdate = document.getElementById("PartnerCodeUpdate").value;
    var ATMupdate = document.getElementById("ATMupdate").value;

    // if(ATMupdate == ''){
    //     alert('Bạn cần chọn ATM.');
    //     document.getElementById("ATMupdate").focus();
    //     document.getElementById("ATMupdate").style.border = "1px solid red";
    //     return;
    // }

    if(PartnerCodeUpdate == ''){
        alert('Bạn cần chọn Partner Code.');
        document.getElementById("PartnerCodeUpdate").focus();
        document.getElementById("PartnerCodeUpdate").style.border = "1px solid red";
        return;
    }

    if(!bankcode.hasOwnProperty("MM")){
        bankcode.MM = [];
        var MMupdate = document.getElementById("MMupdate").value;
        if(MMupdate != ''){
            bankcode.MM.push(MMupdate);
        }

    }
    Livewire.emit("updatePaymentMethodConfig", PartnerCodeUpdate, ATMupdate, bankcode, id);

    setTimeout(function(){
        Livewire.emit("resetMessage");
    }, 5000);
});

Livewire.on('getDateTablePartnerMethodConfigScript', id=>{

    document.getElementById("IDUPDATE").value = id;

    var partnerCode = document.getElementById("partner_code-" + id).value;
    document.getElementById("PartnerCodeUpdate").value = partnerCode;

    var payment_method_config = document.getElementById("payment_method_config-" + id).value;
    bankcode = JSON.parse(payment_method_config);

    if(bankcode.hasOwnProperty("ATM")){
        if(bankcode.ATM == "ALL"){
            document.getElementById("ATMupdate").value = "ALL";
        }
        else{
            document.getElementById("ATMupdate").value = "null";
        }
    }


    var bankCodeCCUpdate = document.getElementById("ccUpdateList");
        bankCodeCCUpdate.innerHTML = '';
        var li_cc = '';

    if(bankcode.hasOwnProperty("CC")){
        for(var i = 0; i < bankcode.CC.length; i++){
            li_cc = document.createElement("li");
            li_cc.appendChild(document.createTextNode(bankcode.CC[i]));
            bankCodeCCUpdate.appendChild(li_cc);
        }
    }

    var EWALLETupdateList = document.getElementById("EWALLETupdateList");
        EWALLETupdateList.innerHTML = '';
        var li_ewallet = '';

    if(bankcode.hasOwnProperty("EWALLET")){
        for(var i = 0; i < bankcode.EWALLET.length; i++){
            li_ewallet = document.createElement("li");
            li_ewallet.appendChild(document.createTextNode(bankcode.EWALLET[i]));
            EWALLETupdateList.appendChild(li_ewallet);

        }
    }

    var VAupdateList = document.getElementById("VAupdateList");
        VAupdateList.innerHTML = '';
        var li_va = '';

    if(bankcode.hasOwnProperty("VA")){
        for(var i = 0; i < bankcode.VA.length; i++){
            li_va = document.createElement("li");
            li_va.appendChild(document.createTextNode(bankcode.VA[i]));
            VAupdateList.appendChild(li_va);

        }
    }


    var MMupdateList = document.getElementById("MMupdateList");
    MMupdateList.innerHTML = '';
    var li_mm = '';
    if(bankcode.hasOwnProperty("MM")){
        for(var i = 0; i < bankcode.MM.length; i++){
            // console.log(bankcode.MM[i]);
            li_mm = document.createElement("li");
            li_mm.appendChild(document.createTextNode(bankcode.MM[i]));
             MMupdateList.appendChild(li_mm);

        }
    }



});

Livewire.on('deletePartnerMethodConfigScript', id=>{
    var cFirm = confirm("Bạn có chắc chắn xóa ID: " + id);
    if(cFirm){
        Livewire.emit("deletePartnerMethodConfig", id);
    }
});

Livewire.on('addnewPartnerMethodConfigScript', ()=>{
    var partnerCodeAddnew = document.getElementById("partnerCodeAddnew").value;
    var startTimeAddnew = document.getElementById("startTimeAddnew").value;
    var endTimeAddnew = document.getElementById("endTimeAddnew").value;
    var atm = document.getElementById("ATM").value;

    if(partnerCodeAddnew == ''){
        alert('Bạn cần nhập Partner Code.');
        document.getElementById("partnerCodeAddnew").focus();
        document.getElementById("partnerCodeAddnew").style.border = '1px solid red';
        return;
    }


    // if(atm == ""){
    //     alert("Hãy chọn bankCode ATM");
    //     document.getElementById("ATM").focus();
    //     return;
    // }

    var cc = document.getElementById("CC").value;
    var ewallet = document.getElementById("EWALLET").value;
    var va = document.getElementById("VA").value;
    var mm = document.getElementById("MM").value;

    Livewire.emit("addnewPartnerMethodConfig",
        partnerCodeAddnew, startTimeAddnew, endTimeAddnew, atm, cc, ewallet, va, mm);
    setTimeout(function(){
        Livewire.emit("resetMessage");
    }, 5000);
});

Livewire.on('addBankcodeVAListScript', ()=>{
    var bankCodeVA = document.getElementById("VA").value;
    Livewire.emit("addBankcodeVAList", bankCodeVA);
});

Livewire.on('addBankcodeEWALLETListScript', ()=>{
    var bankcodeEWALLET = document.getElementById("EWALLET").value;
    Livewire.emit("addBankcodeEWALLETList", bankcodeEWALLET);
});

Livewire.on('addBankcodeCCListScript', ()=>{
    var bankcodeCC = document.getElementById("CC").value;
    Livewire.emit("addBankcodeCCList", bankcodeCC);
});

Livewire.on('addBankcodeMMListScript', ()=>{
    var bankcodeMM = document.getElementById("MM").value;
    Livewire.emit("addBankcodeMMList", bankcodeMM);
});

Livewire.on('searchPartnerConfigMethodScript', ()=>{
    var partnerCode = document.getElementById("partnerCode").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit("searchPartnerConfigMethod", partnerCode, startTime, endTime);
});
