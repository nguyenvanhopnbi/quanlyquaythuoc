$(document).ready(function(){


// all bank code update
    var allCCUpdate = document.getElementById('allBankCodeUpdate-CC');
    var allEWAlLETUpdate = document.getElementById('allBankCodeUpdate-EWALLET');
    var allVAUpdate = document.getElementById('allBankCodeUpdate-VA');
    var allMMUpdate = document.getElementById('allBankCodeUpdate-MM');


    document.getElementById('itemBankcodeUpdate-CC').style.display = 'none';
    document.getElementById('itemBankcodeUpdate-EWALLET').style.display = 'none';
    document.getElementById('itemBankcodeUpdate-VA').style.display = 'none';
    document.getElementById('itemBankcodeUpdate-MM').style.display = 'none';

    document.addEventListener('change', allBankCodeUpdate);

    function allBankCodeUpdate(e){
        if(allCCUpdate.value != 'all'){
            document.getElementById('itemBankcodeUpdate-CC').style.display = 'block';
            document.getElementById('allItemBankcodeUpdate-CC').style.display = 'none';
        }else{
            document.getElementById('itemBankcodeUpdate-CC').style.display = 'none';
            document.getElementById('allItemBankcodeUpdate-CC').style.display = 'block';
        }

        if(allEWAlLETUpdate.value != 'all'){
            document.getElementById('itemBankcodeUpdate-EWALLET').style.display = 'block';
            document.getElementById('allItemBankcodeUpdate-EWALLET').style.display = 'none';
        }else{
            document.getElementById('itemBankcodeUpdate-EWALLET').style.display = 'none';
            document.getElementById('allItemBankcodeUpdate-EWALLET').style.display = 'block';
        }


        if(allVAUpdate.value != 'all'){
            document.getElementById('itemBankcodeUpdate-VA').style.display = 'block';
            document.getElementById('allItemBankcodeUpdate-VA').style.display = 'none';
        }else{
            document.getElementById('itemBankcodeUpdate-VA').style.display = 'none';
            document.getElementById('allItemBankcodeUpdate-VA').style.display = 'block';
        }


        if(allMMUpdate.value != 'all'){
            document.getElementById('itemBankcodeUpdate-MM').style.display = 'block';
            document.getElementById('allItemBankcodeUpdate-MM').style.display = 'none';
        }else{
            document.getElementById('itemBankcodeUpdate-MM').style.display = 'none';
            document.getElementById('allItemBankcodeUpdate-MM').style.display = 'block';
        }
    }


// end bank code update



// all bank code add new
    var allCC = document.getElementById('allBankCode-CC');
    var allEWAlLET = document.getElementById('allBankCode-EWALLET');
    var allVA = document.getElementById('allBankCode-VA');
    var allMM = document.getElementById('allBankCode-MM');


    document.getElementById('itemBankcode-CC').style.display = 'none';
    document.getElementById('itemBankcode-EWALLET').style.display = 'none';
    document.getElementById('itemBankcode-VA').style.display = 'none';
    document.getElementById('itemBankcode-MM').style.display = 'none';

    document.addEventListener('change', allBankCodeAddnew);

    function allBankCodeAddnew(e){
        if(allCC.value != 'all'){
            document.getElementById('itemBankcode-CC').style.display = 'block';
            document.getElementById('allItemBankcode-CC').style.display = 'none';
        }else{
            document.getElementById('itemBankcode-CC').style.display = 'none';
            document.getElementById('allItemBankcode-CC').style.display = 'block';
        }

        if(allEWAlLET.value != 'all'){
            document.getElementById('itemBankcode-EWALLET').style.display = 'block';
            document.getElementById('allItemBankcode-EWALLET').style.display = 'none';
        }else{
            document.getElementById('itemBankcode-EWALLET').style.display = 'none';
            document.getElementById('allItemBankcode-EWALLET').style.display = 'block';
        }


        if(allVA.value != 'all'){
            document.getElementById('itemBankcode-VA').style.display = 'block';
            document.getElementById('allItemBankcode-VA').style.display = 'none';
        }else{
            document.getElementById('itemBankcode-VA').style.display = 'none';
            document.getElementById('allItemBankcode-VA').style.display = 'block';
        }


        if(allMM.value != 'all'){
            document.getElementById('itemBankcode-MM').style.display = 'block';
            document.getElementById('allItemBankcode-MM').style.display = 'none';
        }else{
            document.getElementById('itemBankcode-MM').style.display = 'none';
            document.getElementById('allItemBankcode-MM').style.display = 'block';
        }
    }

// end bank code add new

    $("#AddnewPartnerPaygateFeeConfig").submit(function(e){
        e.preventDefault();

         $.ajaxSetup({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
          type: "POST",
          url: "/partner-paygate-fee-config-addnew-post",
          data: $('form').serialize(),
          dataType: "json",
          encode: true,
        }).done(function (data) {

            if(data.success == false){
                Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Thất bại, kiểm tra lại partnerCode trùng!',
                  showConfirmButton: false,
                  timer: 3000
                })
            }else{
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: data['success'],
                  showConfirmButton: false,
                  timer: 3000
                });

                setTimeout(function(){
                    $("#addnewModal").modal('hide');
                    window.location.reload(true);
                }, 3000);
            }

            $("#messageConfig").append('<span  class="alert alert-primary">'+ data['success'] +'</span>');

            Livewire.emit('resetList');


        });

    });



    // validate

    Livewire.on('changeBankcode-CC', ()=>{

        if(document.getElementById('allBankCodeUpdate-CC').value == 'all'){
            document.getElementById('itemBankcodeUpdate-CC').innerHTML = "";
            document.getElementById('allItemBankcodeUpdate-CC').innerHTML = sessionStorage.getItem("domAllCC");

            document.getElementById("transFeeCC").required = true;
            document.getElementById("transPercentFeeCC").required = true;

        }else{
            document.getElementById('itemBankcodeUpdate-CC').innerHTML = sessionStorage.getItem("domBankCodeCC");
            document.getElementById('allItemBankcodeUpdate-CC').innerHTML = "";

            document.getElementById("transFeeVISA").required = true;
            document.getElementById("transPercentFeeVISA").required = true;
            document.getElementById("transFeeMASTERCARD").required = true;
            document.getElementById("transPercentFeeMASTERCARD").required = true;

        }

        Livewire.emit('changeBankcodeCC');

    });

    Livewire.on('changeBankcode-EWALLET', ()=>{

        if(document.getElementById('allBankCodeUpdate-EWALLET').value == 'all'){
            document.getElementById('itemBankcodeUpdate-EWALLET').innerHTML = "";
            document.getElementById('allItemBankcodeUpdate-EWALLET').innerHTML = sessionStorage.getItem("domAllEWALLET");

            document.getElementById("transFeeEWALLET").required = true;
            document.getElementById("transPercentFeeEWALLET").required = true;

        }else{
            document.getElementById('itemBankcodeUpdate-EWALLET').innerHTML = sessionStorage.getItem("domBankCodeEWALLET");
            document.getElementById('allItemBankcodeUpdate-EWALLET').innerHTML = "";

            document.getElementById("transFeeAPPOTA").required = true;
            document.getElementById("transPercentFeeAPPOTA").required = true;
            document.getElementById("transFeeMOCA").required = true;
            document.getElementById("transPercentFeeMOCA").required = true;
            document.getElementById("transFeeVNPTWALLET").required = true;
            document.getElementById("transPercentFeeVNPTWALLET").required = true;
            document.getElementById("transFeeSHOPEEPAY").required = true;
            document.getElementById("transPercentFeeSHOPEEPAY").required = true;
            document.getElementById("transFeeMOMO").required = true;
            document.getElementById("transPercentFeeMOMO").required = true;

        }

        Livewire.emit('changeBankcodeEWALLET');
    });


    Livewire.on('changeBankcode-VA', ()=>{

        if(document.getElementById('allBankCodeUpdate-VA').value == 'all'){
            document.getElementById('itemBankcodeUpdate-VA').innerHTML = "";
            document.getElementById('allItemBankcodeUpdate-VA').innerHTML = sessionStorage.getItem("domAllVA");

            document.getElementById("transFeeVA").required = true;
            document.getElementById("transPercentFeeVA").required = true;

        }else{
            document.getElementById('itemBankcodeUpdate-VA').innerHTML = sessionStorage.getItem("domBankCodeVA");
            document.getElementById('allItemBankcodeUpdate-VA').innerHTML = "";


            document.getElementById("transFeeWOORIBANK").required = true;
            document.getElementById("transPercentFeeWOORIBANK").required = true;
            document.getElementById("transFeeVIETCAPITALBANK").required = true;
            document.getElementById("transPercentFeeVIETCAPITALBANK").required = true;

        }

        Livewire.emit('changeBankcodeVA');
    });

    Livewire.on('changeBankcode-MM', ()=>{

        if(document.getElementById('allBankCodeUpdate-MM').value == 'all'){
            document.getElementById('itemBankcodeUpdate-MM').innerHTML = "";
            document.getElementById('allItemBankcodeUpdate-MM').innerHTML = sessionStorage.getItem("domAllMM");

            document.getElementById("transFeeMM").required = true;
            document.getElementById("transPercentFeeMM").required = true;

        }else{
            document.getElementById('itemBankcodeUpdate-MM').innerHTML = sessionStorage.getItem("domBankCodeMM");
            document.getElementById('allItemBankcodeUpdate-MM').innerHTML = "";

            document.getElementById("transFeeVINAPHONE").required = true;
            document.getElementById("transPercentFeeVINAPHONE").required = true;

        }

        Livewire.emit('changeBankcodeMM');
    });



    $("#updatePartnerConfigPaygateForm").submit(function(e){
        e.preventDefault();






        var dataArr = $('form#updatePartnerConfigPaygateForm').serializeArray();
        var data = $('form#updatePartnerConfigPaygateForm').serializeArray();
         $.ajaxSetup({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
          type: "POST",
          url: "/partner-paygate-fee-config-update-post",
          data: data,
          dataType: "json",
          encode: true,
        }).done(function (data) {


            if(data.success == false){
                Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Thất bại, kiểm tra lại partnerCode trùng',
                  showConfirmButton: false,
                  timer: 3000
                })
            }else{
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: data['success'],
                  showConfirmButton: false,
                  timer: 3000
                });

                setTimeout(function(){
                    $("#updateModal").modal('hide');
                    window.location.reload(true);
                }, 3000);
            }




            $("#messageConfigUpdate").append('<span  class="alert alert-primary">'+ data['success'] +'</span>');
            Livewire.emit('resetList');
        });

    });


});

    // validate add new config


Livewire.on('changeBankcodeAddnew-CC', ()=>{

    if(document.getElementById('allBankCode-CC').value == 'all'){
        document.getElementById('itemBankcode-CC').innerHTML = "";
        document.getElementById('allItemBankcode-CC').innerHTML = sessionStorage.getItem("domAllCC_Addnew");
    }else{
        document.getElementById('itemBankcode-CC').innerHTML = sessionStorage.getItem("domBankCodeCC_Addnew");
        document.getElementById('allItemBankcode-CC').innerHTML = "";
    }

});

Livewire.on('changeBankcodeAddnew-EWALLET', ()=>{
    if(document.getElementById('allBankCode-EWALLET').value == 'all'){
        document.getElementById('itemBankcode-EWALLET').innerHTML = "";
        document.getElementById('allItemBankcode-EWALLET').innerHTML = sessionStorage.getItem("domAllEWALLET_Addnew");
    }else{
        document.getElementById('itemBankcode-EWALLET').innerHTML = sessionStorage.getItem("domBankCodeEWALLET_Addnew");
        document.getElementById('allItemBankcode-EWALLET').innerHTML = "";
    }
});

Livewire.on('changeBankcodeAddnew-VA', ()=>{
    if(document.getElementById('allBankCode-VA').value == 'all'){
        document.getElementById('itemBankcode-VA').innerHTML = "";
        document.getElementById('allItemBankcode-VA').innerHTML = sessionStorage.getItem("domAllVA_Addnew");
    }else{
        document.getElementById('itemBankcode-VA').innerHTML = sessionStorage.getItem("domBankCodeVA_Addnew");
        document.getElementById('allItemBankcode-VA').innerHTML = "";
    }
});

Livewire.on('changeBankcodeAddnew-MM', ()=>{
    if(document.getElementById('allBankCode-MM').value == 'all'){
        document.getElementById('itemBankcode-MM').innerHTML = "";
        document.getElementById('allItemBankcode-MM').innerHTML = sessionStorage.getItem("domAllMM_Addnew");
    }else{
        document.getElementById('itemBankcode-MM').innerHTML = sessionStorage.getItem("domBankCodeMM_Addnew");
        document.getElementById('allItemBankcode-MM').innerHTML = "";
    }
});

    // end validate add new config

Livewire.on('getDomPartnerPaygateFeeConfigScript', ()=>{

    $(document).ready(function(){
        $("#addnewModal").modal('show');
    });

    if(typeof sessionStorage.getItem("domAllCC_Addnew") == 'string'){
        var domAllCC_Addnew = document.getElementById('allItemBankcode-CC').innerHTML;
        if(domAllCC_Addnew == '' && document.getElementById("changeBankcodeAddnew-CC").value == 'all'){
            document.getElementById('allItemBankcode-CC').innerHTML = sessionStorage.getItem("domAllCC_Addnew");
        }
    }

    if(typeof sessionStorage.getItem("domBankCodeCC_Addnew") == 'string'){
        var domBankCodeCC_Addnew = document.getElementById('itemBankcode-CC').innerHTML;
        if(domBankCodeCC_Addnew == '' && document.getElementById("changeBankcodeAddnew-CC").value == 'bankcode'){
            document.getElementById('itemBankcode-CC').innerHTML = sessionStorage.getItem("domBankCodeCC_Addnew");
        }
    }


    if(typeof sessionStorage.getItem("domAllEWALLET_Addnew") == 'string'){
        var domAllEWALLET_Addnew = document.getElementById('allItemBankcode-EWALLET').innerHTML;
        if(domAllEWALLET_Addnew == ''){
            document.getElementById('allItemBankcode-EWALLET').innerHTML = sessionStorage.getItem("domAllEWALLET_Addnew");
        }
    }

    if(typeof sessionStorage.getItem("domBankCodeEWALLET_Addnew") == 'string'){
        var domBankCodeEWALLET_Addnew = document.getElementById('itemBankcode-EWALLET').innerHTML;
        if(domBankCodeEWALLET_Addnew == ''){
            document.getElementById('itemBankcode-EWALLET').innerHTML = sessionStorage.getItem("domBankCodeEWALLET_Addnew");
        }
    }

    if(typeof sessionStorage.getItem("domAllVA_Addnew") == 'string'){
        var domAllVA_Addnew = document.getElementById('allItemBankcode-VA').innerHTML;
        if(domAllVA_Addnew == ''){
            document.getElementById('allItemBankcode-VA').innerHTML = sessionStorage.getItem("domAllVA_Addnew");
        }
    }

    if(typeof sessionStorage.getItem("domBankCodeVA_Addnew") == 'string'){
        var domBankCodeVA_Addnew = document.getElementById('itemBankcode-VA').innerHTML;
        if(domBankCodeVA_Addnew == ''){
            document.getElementById('itemBankcode-VA').innerHTML = sessionStorage.getItem("domBankCodeVA_Addnew");
        }
    }

    if(typeof sessionStorage.getItem("domAllMM_Addnew") == 'string'){
        var domAllMM_Addnew = document.getElementById('allItemBankcode-MM').innerHTML;
        if(domAllMM_Addnew == ''){
            document.getElementById('allItemBankcode-MM').innerHTML = sessionStorage.getItem("domAllMM_Addnew");
        }
    }

    if(typeof sessionStorage.getItem("domBankCodeMM_Addnew") == 'string'){
        var domBankCodeMM_Addnew = document.getElementById('itemBankcode-MM').innerHTML;
        if(domBankCodeMM_Addnew == ''){
            document.getElementById('itemBankcode-MM').innerHTML = sessionStorage.getItem("domBankCodeMM_Addnew");
        }
    }





    var domAllCC_Addnew = document.getElementById('allItemBankcode-CC');
    var domBankCodeCC_Addnew = document.getElementById('itemBankcode-CC');

    sessionStorage.setItem("domAllCC_Addnew", domAllCC_Addnew.innerHTML);
    sessionStorage.setItem("domBankCodeCC_Addnew", domBankCodeCC_Addnew.innerHTML);

    var domAllEWALLET_Addnew = document.getElementById('allItemBankcode-EWALLET');
    var domBankCodeEWALLET_Addnew = document.getElementById('itemBankcode-EWALLET');

    sessionStorage.setItem("domAllEWALLET_Addnew", domAllEWALLET_Addnew.innerHTML);
    sessionStorage.setItem("domBankCodeEWALLET_Addnew", domBankCodeEWALLET_Addnew.innerHTML);

    var domAllVA_Addnew = document.getElementById('allItemBankcode-VA');
    var domBankCodeVA_Addnew = document.getElementById('itemBankcode-VA');

    sessionStorage.setItem("domAllVA_Addnew", domAllVA_Addnew.innerHTML);
    sessionStorage.setItem("domBankCodeVA_Addnew", domBankCodeVA_Addnew.innerHTML);

    var domAllMM_Addnew = document.getElementById('allItemBankcode-MM');
    var domBankCodeMM_Addnew = document.getElementById('itemBankcode-MM');

    sessionStorage.setItem("domAllMM_Addnew", domAllMM_Addnew.innerHTML);
    sessionStorage.setItem("domBankCodeMM_Addnew", domBankCodeMM_Addnew.innerHTML);

    if(document.getElementById("allBankCode-CC").value == 'all'){
        document.getElementById("itemBankcode-CC").innerHTML = '';
    }

    if(document.getElementById("allBankCode-EWALLET").value == 'all'){
        document.getElementById("itemBankcode-EWALLET").innerHTML = '';
    }

    if(document.getElementById("allBankCode-VA").value == 'all'){
        document.getElementById("itemBankcode-VA").innerHTML = '';
    }

    if(document.getElementById("allBankCode-MM").value == 'all'){
        document.getElementById("itemBankcode-MM").innerHTML = '';
    }

});

Livewire.on('getDateTablePartnerPaygateFeeConfigScript', id=>{


    $(document).ready(function(){
        $("#updateModal").modal('show');
    });


    if(typeof sessionStorage.getItem("domAllCC") == 'string'){
        var domAllCC = document.getElementById('allItemBankcodeUpdate-CC').innerHTML;
        if(domAllCC == ''){
            document.getElementById('allItemBankcodeUpdate-CC').innerHTML = sessionStorage.getItem("domAllCC");
        }
    }

    if(typeof sessionStorage.getItem("domBankCodeCC") == 'string'){
        var domBankCodeCC = document.getElementById('itemBankcodeUpdate-CC').innerHTML;
        if(domBankCodeCC == ''){
            document.getElementById('itemBankcodeUpdate-CC').innerHTML = sessionStorage.getItem("domBankCodeCC");
        }
    }


    if(typeof sessionStorage.getItem("domAllEWALLET") == 'string'){
        var domAllEWALLET = document.getElementById('allItemBankcodeUpdate-EWALLET').innerHTML;
        if(domAllEWALLET == ''){
            document.getElementById('allItemBankcodeUpdate-EWALLET').innerHTML = sessionStorage.getItem("domAllEWALLET");
        }
    }

    if(typeof sessionStorage.getItem("domBankCodeEWALLET") == 'string'){
        var domBankCodeEWALLET = document.getElementById('itemBankcodeUpdate-EWALLET').innerHTML;
        if(domBankCodeEWALLET == ''){
            document.getElementById('itemBankcodeUpdate-EWALLET').innerHTML = sessionStorage.getItem("domBankCodeEWALLET");
        }
    }

    if(typeof sessionStorage.getItem("domAllVA") == 'string'){
        var domAllVA = document.getElementById('allItemBankcodeUpdate-VA').innerHTML;
        if(domAllVA == ''){
            document.getElementById('allItemBankcodeUpdate-VA').innerHTML = sessionStorage.getItem("domAllVA");
        }
    }

    if(typeof sessionStorage.getItem("domBankCodeVA") == 'string'){
        var domBankCodeVA = document.getElementById('itemBankcodeUpdate-VA').innerHTML;
        if(domBankCodeVA == ''){
            document.getElementById('itemBankcodeUpdate-VA').innerHTML = sessionStorage.getItem("domBankCodeVA");
        }
    }

    if(typeof sessionStorage.getItem("domAllMM") == 'string'){
        var domAllMM = document.getElementById('allItemBankcodeUpdate-MM').innerHTML;
        if(domAllMM == ''){
            document.getElementById('allItemBankcodeUpdate-MM').innerHTML = sessionStorage.getItem("domAllMM");
        }
    }

    if(typeof sessionStorage.getItem("domBankCodeMM") == 'string'){
        var domBankCodeMM = document.getElementById('itemBankcodeUpdate-MM').innerHTML;
        if(domBankCodeMM == ''){
            document.getElementById('itemBankcodeUpdate-MM').innerHTML = sessionStorage.getItem("domBankCodeMM");
        }
    }


    document.getElementById("IDPARTNERPAYGATEFEECONFIG").value = id;
    var partnerCode = document.getElementById("partner_code-" + id).value;
    var contract_number = document.getElementById("contract_number-" + id).value;

    document.getElementById("partnerCodeUpdate").value = partnerCode;
    document.getElementById("partnerCodeUpdateLable").value = partnerCode;

    document.getElementById("contractNumberUpdate").value = contract_number;

    var fee = document.getElementById("fee-" + id).value;
    fee = JSON.parse(fee);
    if(fee.hasOwnProperty('CC')){
        if(fee.CC.hasOwnProperty('ALL')){
            document.getElementById('allBankCodeUpdate-CC').value = 'all';
            document.getElementById('allItemBankcodeUpdate-CC').style.display = "block";
            document.getElementById('itemBankcodeUpdate-CC').style.display = 'none';


            document.getElementById("transFeeVISA").required = false;
            document.getElementById("transPercentFeeVISA").required = false;
            document.getElementById("transFeeMASTERCARD").required = false;
            document.getElementById("transPercentFeeMASTERCARD").required = false;


        }else{
            document.getElementById('allBankCodeUpdate-CC').value = 'bankcode';
            document.getElementById('allItemBankcodeUpdate-CC').style.display = "none";
            document.getElementById('itemBankcodeUpdate-CC').style.display = 'block';

            document.getElementById("transFeeCC").required = false;
            document.getElementById("transPercentFeeCC").required = false;

            console.log('222222222');
            console.log(document.getElementById("transFeeVISA"));
            console.log('2222222222222222222222');
        }
    }

    if(fee.hasOwnProperty('EWALLET')){
        if(fee.EWALLET.hasOwnProperty('ALL')){
            document.getElementById('allBankCodeUpdate-EWALLET').value = 'all';
            document.getElementById('allItemBankcodeUpdate-EWALLET').style.display = "block";
            document.getElementById('itemBankcodeUpdate-EWALLET').style.display = 'none';

            document.getElementById("transFeeAPPOTA").required = false;
            document.getElementById("transPercentFeeAPPOTA").required = false;
            document.getElementById("transFeeMOCA").required = false;
            document.getElementById("transPercentFeeMOCA").required = false;
            document.getElementById("transFeeVNPTWALLET").required = false;
            document.getElementById("transPercentFeeVNPTWALLET").required = false;
            document.getElementById("transFeeSHOPEEPAY").required = false;
            document.getElementById("transPercentFeeSHOPEEPAY").required = false;
            document.getElementById("transFeeMOMO").required = false;
            document.getElementById("transPercentFeeMOMO").required = false;
        }else{
            document.getElementById('allBankCodeUpdate-EWALLET').value = 'bankcode';
            document.getElementById('allItemBankcodeUpdate-EWALLET').style.display = "none";
            document.getElementById('itemBankcodeUpdate-EWALLET').style.display = 'block';

            document.getElementById("transFeeEWALLET").required = false;
            document.getElementById("transPercentFeeEWALLET").required = false;
        }
    }

    if(fee.hasOwnProperty('VA')){
        if(fee.VA.hasOwnProperty('ALL')){
            document.getElementById('allBankCodeUpdate-VA').value = 'all';
            document.getElementById('allItemBankcodeUpdate-VA').style.display = "block";
            document.getElementById('itemBankcodeUpdate-VA').style.display = 'none';

            document.getElementById("transFeeWOORIBANK").required = false;
            document.getElementById("transPercentFeeWOORIBANK").required = false;
            document.getElementById("transFeeVIETCAPITALBANK").required = false;
            document.getElementById("transPercentFeeVIETCAPITALBANK").required = false;
        }else{
            document.getElementById('allBankCodeUpdate-VA').value = 'bankcode';
            document.getElementById('allItemBankcodeUpdate-VA').style.display = "none";
            document.getElementById('itemBankcodeUpdate-VA').style.display = 'block';

            document.getElementById("transFeeVA").required = false;
            document.getElementById("transPercentFeeVA").required = false;
        }
    }


    if(fee.hasOwnProperty('MM')){
        if(fee.MM.hasOwnProperty('ALL')){
            document.getElementById('allBankCodeUpdate-MM').value = 'all';
            document.getElementById('allItemBankcodeUpdate-MM').style.display = "block";
            document.getElementById('itemBankcodeUpdate-MM').style.display = 'none';

            document.getElementById("transFeeVINAPHONE").required = false;
            document.getElementById("transPercentFeeVINAPHONE").required = false;
        }else{
            document.getElementById('allBankCodeUpdate-MM').value = 'bankcode';
            document.getElementById('allItemBankcodeUpdate-MM').style.display = "none";
            document.getElementById('itemBankcodeUpdate-MM').style.display = 'block';

            document.getElementById("transFeeMM").required = false;
            document.getElementById("transPercentFeeMM").required = false;
        }
    }




    var feeArray = Object.entries(fee);
    // console.log(feeArray);
    var transFee = "";
    var transFeeAPPOTA = "";
    var transPercentFee = "";
    var countCCVISA = 1;
    var countCCMASTERCARD = 1;

    var countMMVINAPHONE = 1;

    var countEWALLETMOMO = 1;
    var countEWALLETAPPOTA = 1;
    var countEWALLETMOCA = 1;
    var countEWALLETVNPTWALLET = 1;
    var countEWALLETSHOPEEPAY = 1;
    var countVAWOORIBANK = 1;
    var countVAVIETCAPITALBANK = 1;


    for(var i = 0; i < feeArray.length; i++){

        for(var ii in feeArray[i]){

            if(typeof feeArray[i][ii] === 'string' || feeArray[i][ii] instanceof String){
                // console.log(feeArray[i][ii]);
                if(feeArray[i][ii] != null && feeArray[i][ii] == "ATM"){
                    transFee = document.getElementById("transFee" + feeArray[i][ii]);
                    transPercentFee = document.getElementById("transPercentFee" + feeArray[i][ii]);
                    if(fee.hasOwnProperty('ATM')){
                        if(fee.ATM.hasOwnProperty('ALL')){
                            transFee.value = fee.ATM.ALL.transFee;
                            transPercentFee.value = fee.ATM.ALL.transPercentFee;
                        }
                    }

                }

                if(feeArray[i][ii] != null && feeArray[i][ii] == "CC"){
                    transFee = document.getElementById("transFee" + feeArray[i][ii]);
                    transPercentFee = document.getElementById("transPercentFee" + feeArray[i][ii]);
                    if(fee.hasOwnProperty('CC')){
                        if(fee.CC.hasOwnProperty('ALL')){
                            transFee.value = fee.CC.ALL.transFee;
                            transPercentFee.value = fee.CC.ALL.transPercentFee;
                        }
                    }

                }

                if(feeArray[i][ii] != null && feeArray[i][ii] == "EWALLET"){
                    transFee = document.getElementById("transFee" + feeArray[i][ii]);
                    transPercentFee = document.getElementById("transPercentFee" + feeArray[i][ii]);
                    if(fee.hasOwnProperty('EWALLET')){
                        if(fee.EWALLET.hasOwnProperty('ALL')){
                            transFee.value = fee.EWALLET.ALL.transFee;
                            transPercentFee.value = fee.EWALLET.ALL.transPercentFee;
                        }
                    }

                }

                if(feeArray[i][ii] != null && feeArray[i][ii] == "VA"){
                    transFee = document.getElementById("transFee" + feeArray[i][ii]);
                    transPercentFee = document.getElementById("transPercentFee" + feeArray[i][ii]);
                    if(fee.hasOwnProperty('VA')){
                        if(fee.VA.hasOwnProperty('ALL')){
                            transFee.value = fee.VA.ALL.transFee;
                            transPercentFee.value = fee.VA.ALL.transPercentFee;
                        }
                    }

                }

                if(feeArray[i][ii] != null && feeArray[i][ii] == "MM"){
                    transFee = document.getElementById("transFee" + feeArray[i][ii]);
                    transPercentFee = document.getElementById("transPercentFee" + feeArray[i][ii]);

                    if(fee.hasOwnProperty('MM')){
                        if(fee.MM.hasOwnProperty('ALL')){
                            transFee.value = fee.MM.ALL.transFee;
                            transPercentFee.value = fee.MM.ALL.transPercentFee;
                        }
                    }

                }




                if(feeArray[i][ii] != null && feeArray[i][ii] == "EWALLET"){
                    if(countEWALLETAPPOTA == 1){
                        transFee = document.getElementById("transFee" + "APPOTA");
                        transPercentFee = document.getElementById("transPercentFee" + "APPOTA");
                        if(fee.hasOwnProperty('EWALLET')){
                            if(fee.EWALLET.hasOwnProperty('APPOTA')){
                                transFee.value = fee.EWALLET.APPOTA.transFee;
                                transPercentFee.value = fee.EWALLET.APPOTA.transPercentFee;
                            }
                        }

                        countEWALLETAPPOTA++;
                    }

                    if(countEWALLETMOCA == 1){
                        transFee = document.getElementById("transFee" + "MOCA");
                        transPercentFee = document.getElementById("transPercentFee" + "MOCA");

                        if(fee.hasOwnProperty('EWALLET')){
                            if(fee.EWALLET.hasOwnProperty('MOCA')){
                                transFee.value = fee.EWALLET.MOCA.transFee;
                                transPercentFee.value = fee.EWALLET.MOCA.transPercentFee;
                            }
                        }


                        countEWALLETMOCA++;
                    }
                    if(countEWALLETVNPTWALLET == 1){
                        transFee = document.getElementById("transFee" + "VNPTWALLET");
                        transPercentFee = document.getElementById("transPercentFee" + "VNPTWALLET");
                        if(fee.hasOwnProperty('EWALLET')){
                            if(fee.EWALLET.hasOwnProperty('VNPTWALLET')){
                                transFee.value = fee.EWALLET.VNPTWALLET.transFee;
                                transPercentFee.value = fee.EWALLET.VNPTWALLET.transPercentFee;
                            }
                        }

                        countEWALLETVNPTWALLET++;
                    }

                    if(countEWALLETSHOPEEPAY == 1){
                        transFee = document.getElementById("transFee" + "SHOPEEPAY");
                        transPercentFee = document.getElementById("transPercentFee" + "SHOPEEPAY");
                        if(fee.hasOwnProperty('EWALLET')){
                            if(fee.EWALLET.hasOwnProperty('SHOPEEPAY')){
                                transFee.value = fee.EWALLET.SHOPEEPAY.transFee;
                                transPercentFee.value = fee.EWALLET.SHOPEEPAY.transPercentFee;
                            }
                        }

                        countEWALLETSHOPEEPAY++;
                    }

                    if(countEWALLETMOMO == 1){
                        transFee = document.getElementById("transFee" + "MOMO");
                        transPercentFee = document.getElementById("transPercentFee" + "MOMO");
                        if(fee.hasOwnProperty('EWALLET')){
                            if(fee.EWALLET.hasOwnProperty('MOMO')){
                                transFee.value = fee.EWALLET.MOMO.transFee;
                                transPercentFee.value = fee.EWALLET.MOMO.transPercentFee;
                            }
                        }

                        countEWALLETMOMO++;
                    }

                }

                if(feeArray[i][ii] != null && feeArray[i][ii] == "VA"){
                    if(countVAWOORIBANK == 1){
                        transFee = document.getElementById("transFee" + "WOORIBANK");
                        transPercentFee = document.getElementById("transPercentFee" + "WOORIBANK");
                        if(fee.hasOwnProperty('VA')){
                            if(fee.VA.hasOwnProperty('WOORIBANK')){
                                transFee.value = fee.VA.WOORIBANK.transFee;
                                transPercentFee.value = fee.VA.WOORIBANK.transPercentFee;
                            }
                        }

                        countVAWOORIBANK++;
                    }
                    if(countVAVIETCAPITALBANK == 1){
                        transFee = document.getElementById("transFee" + "VIETCAPITALBANK");
                        transPercentFee = document.getElementById("transPercentFee" + "VIETCAPITALBANK");
                        if(fee.hasOwnProperty('VA')){
                            if(fee.VA.hasOwnProperty('VIETCAPITALBANK')){
                                transFee.value = fee.VA.VIETCAPITALBANK.transFee;
                                transPercentFee.value = fee.VA.VIETCAPITALBANK.transPercentFee;
                            }
                        }
                        // transFee.value = fee.VA.VIETCAPITALBANK.transFee;
                        // transPercentFee.value = fee.VA.VIETCAPITALBANK.transPercentFee;
                        countVAVIETCAPITALBANK++;
                    }
                }

                if(feeArray[i][ii] != null && feeArray[i][ii] == "CC"){
                    if(countCCVISA == 1){
                        transFee = document.getElementById("transFee" + "VISA");
                        transPercentFee = document.getElementById("transPercentFee" + "VISA");
                        if(fee.hasOwnProperty('CC')){
                            if(fee.CC.hasOwnProperty('VISA')){
                                transFee.value = fee.CC.VISA.transFee;
                                transPercentFee.value = fee.CC.VISA.transPercentFee;
                            }
                        }

                        countCCVISA++;
                    }
                    if(countCCMASTERCARD == 1){
                        transFee = document.getElementById("transFee" + "MASTERCARD");
                        transPercentFee = document.getElementById("transPercentFee" + "MASTERCARD");
                        if(fee.hasOwnProperty('CC')){
                            if(fee.CC.hasOwnProperty('MASTERCARD')){
                                transFee.value = fee.CC.MASTERCARD.transFee;
                                transPercentFee.value = fee.CC.MASTERCARD.transPercentFee;
                            }
                        }

                        countCCMASTERCARD++;
                    }
                }

                if(feeArray[i][ii] != null && feeArray[i][ii] == "MM"){
                    // console.log(feeArray[i][ii]);
                    if(countMMVINAPHONE == 1){
                        transFee = document.getElementById("transFee" + "VINAPHONE");
                        transPercentFee = document.getElementById("transPercentFee" + "VINAPHONE");
                        if(fee.hasOwnProperty('MM')){
                            if(fee.MM.hasOwnProperty('VINAPHONE')){
                                transFee.value = fee.MM.VINAPHONE.transFee;
                                transPercentFee.value = fee.MM.VINAPHONE.transPercentFee;
                            }
                        }

                        countMMVINAPHONE++;
                    }
                }


            }


        }

        var domAllCC = document.getElementById('allItemBankcodeUpdate-CC');
        var domBankCodeCC = document.getElementById('itemBankcodeUpdate-CC');

        sessionStorage.setItem("domAllCC", domAllCC.innerHTML);
        sessionStorage.setItem("domBankCodeCC", domBankCodeCC.innerHTML);

        var domAllEWALLET = document.getElementById('allItemBankcodeUpdate-EWALLET');
        var domBankCodeEWALLET = document.getElementById('itemBankcodeUpdate-EWALLET');

        sessionStorage.setItem("domAllEWALLET", domAllEWALLET.innerHTML);
        sessionStorage.setItem("domBankCodeEWALLET", domBankCodeEWALLET.innerHTML);

        var domAllVA = document.getElementById('allItemBankcodeUpdate-VA');
        var domBankCodeVA = document.getElementById('itemBankcodeUpdate-VA');

        sessionStorage.setItem("domAllVA", domAllVA.innerHTML);
        sessionStorage.setItem("domBankCodeVA", domBankCodeVA.innerHTML);

        var domAllMM = document.getElementById('allItemBankcodeUpdate-MM');
        var domBankCodeMM = document.getElementById('itemBankcodeUpdate-MM');

        sessionStorage.setItem("domAllMM", domAllMM.innerHTML);
        sessionStorage.setItem("domBankCodeMM", domBankCodeMM.innerHTML);



        // if(document.getElementById("allBankCodeUpdate-CC").value == 'all'){
        //     document.getElementById("itemBankcodeUpdate-CC").innerHTML = '';
        // }else{
        //     document.getElementById("allItemBankcodeUpdate-CC").innerHTML = '';
        // }

        // if(document.getElementById("allBankCodeUpdate-EWALLET").value == 'all'){
        //     document.getElementById("itemBankcodeUpdate-EWALLET").innerHTML = '';
        // }else{
        //     document.getElementById("allItemBankcodeUpdate-EWALLET").innerHTML = '';
        // }

        // if(document.getElementById("allBankCodeUpdate-VA").value == 'all'){
        //     document.getElementById("itemBankcodeUpdate-VA").innerHTML = '';
        // }else{
        //     document.getElementById("allItemBankcodeUpdate-VA").innerHTML = '';
        // }

        // if(document.getElementById("allBankCodeUpdate-MM").value == 'all'){
        //     document.getElementById("itemBankcodeUpdate-MM").innerHTML = '';
        // }else{
        //     document.getElementById("allItemBankcodeUpdate-MM").innerHTML = '';
        // }



    }







    // console.log(fee.ATM.ALL.transFee);
    // var feeArray = Object.entries(fee);
    // for(var key in feeArray){
    //     var valueBankCode = feeArray[key];
    //     for(var key2 in valueBankCode){
    //         if(valueBankCode[key2] == "ATM"){

    //         }
    //     }

    // }

    // console.log(feeArray);
});

Livewire.on('deletePartnerPaygateFeeConfigScript', id=>{
    var cFirm = confirm("Bạn có chắc chắn muốn xóa cấu hình này ID: " + id + "?");
    if(cFirm){
        Livewire.emit("deletePartnerPaygateFeeConfig", id);
    }
});
Livewire.on('searchPartnerPaygateFeeScript', ()=>{
    var partnerCode = document.getElementById("partnerCodeSearch").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

    Livewire.emit("searchPartnerPaygateFee", partnerCode, startTime, endTime);
});
