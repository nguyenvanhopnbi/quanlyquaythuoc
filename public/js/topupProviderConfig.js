

Livewire.on('deleteConfig444Script', id=>{
    var conFirm = confirm("Are you sure to delete Provider ID " + id + "?");
    if(conFirm == true){
        Livewire.emit('deleteConfig444', id);
    }
    setTimeout(function(){
        document.getElementById("messageUpdateConfig3").style.display = "none";
        // Livewire.emit('removeMessageUpdateDeleteConfig');
    }, 5000);
})



Livewire.on('addnewConfig3Script', ()=>{
    var telco = document.getElementById("telcoaddconfig4").value;
    var providerCode = document.getElementById("addProviderCodeConfig4").value;
    var value = document.getElementById("addValueConfig4").value;
    var telcoServiceType = document.getElementById("telcoServiceTypeaddconfig4").value;
    Livewire.emit('addnewConfig333',
        telco,
        providerCode,
        value,
        telcoServiceType
        );
    setTimeout(function(){


        document.getElementById("telcoaddconfig4").value = '';
        document.getElementById("addProviderCodeConfig4").value = '';
        document.getElementById("addValueConfig4").value = '';
        document.getElementById("telcoServiceTypeaddconfig4").value = '';

        document.getElementById('messageResultc4').style.display = "none";
    }, 5000);
})


Livewire.on('addnewConfig444Script', ()=>{
    var telco = document.getElementById("telcoaddconfig3").value;
    var providerCode = document.getElementById("addProviderCodeConfig3").value;
    var telcoServiceType = document.getElementById("telcoServiceTypeaddconfig3").value;

    Livewire.emit('addnewConfig444',
        telco,
        providerCode,
        telcoServiceType
        );
    setTimeout(function(){

        document.getElementById("telcoaddconfig3").value = '';
        document.getElementById("addProviderCodeConfig3").value = '';
        document.getElementById("telcoServiceTypeaddconfig3").value = '';


        document.getElementById('messageResultc3').style.display = "none";
    }, 5000);
})


Livewire.on('editConfig444Script', ()=>{

    var id = document.getElementById("idEditConfig444").value;
    var providerCode = document.getElementById("editProviderCodeConfig4444").value;
    var telco = document.getElementById("telcoeditconfig444").value;
    var telco_service_type = document.getElementById("telcoServiceTypeconfig444Edit").value;

    Livewire.emit('updateConfig444',
        id,
        providerCode,
        telco,
        telco_service_type
        );
    setTimeout(function(){
        // Livewire.emit('removeMessageUpdateDeleteConfig');
    }, 5000);
})

Livewire.on('updateConfig444Script', id=>{

    var providerCode = document.getElementById("providerCode-" + id).value;
    var telco = document.getElementById("telco-" + id).value;
    var telcoServiceType = document.getElementById("telcoServiceType-" + id).value;

    document.getElementById("telcoeditconfig444").value = telco;
    document.getElementById("editProviderCodeConfig4444").value = providerCode;
    document.getElementById("telcoServiceTypeconfig444Edit").value = telcoServiceType;

    document.getElementById("idEditConfig444").value = id;

})


Livewire.on('deleteConfig2Script', id =>{
    var conFirm = confirm("Are you sure to delete Provider ID " + id + "?");
    if(conFirm == true){
        Livewire.emit('deleteConfig2', id);
    }
    setTimeout(function(){
        document.getElementById("messageUpdateConfig2").style.display = "none";
        // Livewire.emit('removeMessageUpdateDeleteConfig');
    }, 5000);
})

Livewire.on('addnewConfig2Script', ()=>{
    var telco = document.getElementById("telcoaddconfig2").value;
    var providerCode = document.getElementById("addProviderCodeConfig2").value;
    var telcoServiceType = document.getElementById("telcoServiceTypeaddconfig2").value;
    var partnerCode = document.getElementById("parner_code_value_addnewconfig2").value;

    Livewire.emit('addnewConfig2',
        telco,
        providerCode,
        telcoServiceType,
        partnerCode
        );
    setTimeout(function(){

        document.getElementById("telcoaddconfig2").value = '';
        document.getElementById("addProviderCodeConfig2").value = '';
        document.getElementById("telcoServiceTypeaddconfig2").value = '';
        document.getElementById("parner_code_value_addnewconfig2").value = '';
        document.getElementById('messageResultc2').style.display = "none";
    }, 5000);

})


Livewire.on('addnewConfig1Script', ()=>{
    var telco = document.getElementById("telcoaddconfig1").value;
    var providerCode = document.getElementById("addProviderCodeConfig1").value;
    var value = document.getElementById("addValueConfig1").value;
    var telcoServiceType = document.getElementById("telcoServiceTypeaddconfig1").value;
    var partnerCode = document.getElementById("parner_code_value_addnewconfig1").value;

    Livewire.emit('addnewConfig1',
        telco,
        providerCode,
        value,
        telcoServiceType,
        partnerCode
        );
    setTimeout(function(){
        var result = document.getElementById("resultTimeout").value;
        // alert(result);
        document.getElementById("telcoaddconfig1").value = '';
        document.getElementById("addProviderCodeConfig1").value ='';
        document.getElementById("addValueConfig1").value = '';
        document.getElementById("telcoServiceTypeaddconfig1").value = '';
        document.getElementById("parner_code_value_addnewconfig1").value = '';


        document.getElementById('messageResultc1').style.display = "none";
    }, 5000);
})


Livewire.on('editConfig2Script', ()=>{

    var id = document.getElementById("idEditConfig2").value;

    var telco = document.getElementById("telcoeditconfig2").value;
    var providerCode = document.getElementById("editProviderCodeConfig2").value;
    var telcoServiceType = document.getElementById("telcoServiceTypeconfig2Edit").value;
    var partnerCode = document.getElementById("parner_code_value_editconfig2").value;

    Livewire.emit('updateConfig2',
        id,
        providerCode,
        telco,
        telcoServiceType,
        partnerCode
    );

    setTimeout(function(){
        // document.getElementById("messageUpdateConfig2").style.display = "none";
        // Livewire.emit('removeMessageUpdateDeleteConfig');
    }, 5000);

})

Livewire.on('getDataTableConfig2Script', id=>{

    var telco = document.getElementById("telcoConfig2-" + id).value;
    var providerCode = document.getElementById("providerCodeConfig2-" + id).value;
    var telcoServiceType = document.getElementById("telcoServiceTypeConfig2-" + id).value;
    var partnerCode = document.getElementById("partnerCode-" + id).value;

    document.getElementById("telcoeditconfig2").value = telco;
    document.getElementById("editProviderCodeConfig2").value = providerCode;
    document.getElementById("telcoServiceTypeconfig2Edit").value = telcoServiceType;
    document.getElementById("parner_code_value_editconfig2").value = partnerCode;

    document.getElementById("idEditConfig2").value = id;

    Livewire.emit('setIDEditConfig2', id);

})

Livewire.on('getTelcoValueConfig1Script', ()=>{

    var telco = document.getElementById("telcoeditconfig111").value;
    var id = document.getElementById("idEditConfig1111").value;

    Livewire.emit('getTelcoValueConfig11111', telco, id);
})


Livewire.on('deleteConfig3Script', id =>{
    var conFirm = confirm("Are you sure to delete Provider ID " + id + "?");
    if(conFirm == true){
        Livewire.emit('deleteConfig333', id);
    }
    setTimeout(function(){
        document.getElementById("messageUpdateConfig4").style.display = "none";
        // Livewire.emit('removeMessageUpdateDeleteConfig');
    }, 5000);
})

Livewire.on('editConfig3Script333', ()=>{
    var id = document.getElementById("idEditConfig333").value;

    var providerCode = document.getElementById("editProviderCodeConfig333").value;
    // var value = document.getElementById("editValueConfig333").value;
    var telco = document.getElementById("telcoeditconfig3333").value;
    var telcoServiceType = document.getElementById("telcoServiceTypeEditConfig333").value;

    Livewire.emit('updateConfig333',
        id,
        providerCode,
        telco,
        telcoServiceType
        )

    setTimeout(function(){
        // Livewire.emit('removeMessageUpdateDeleteConfig');
    }, 5000);
})

Livewire.on('getDataTableConfig3Script', id=>{
    document.getElementById("idEditConfig333").value = id;

    var telco = document.getElementById("telcoConfig333-"+id).value;
    var telcoServiceType = document.getElementById("telcoServiceTypeConfig333-"+id).value;
    var providerCode = document.getElementById("providerCodeConfig333-" + id).value;
    // var value = document.getElementById("value333-"+ id).value;

    document.getElementById("telcoeditconfig3333").value = telco;
    document.getElementById("editProviderCodeConfig333").value = providerCode;
    // document.getElementById("editValueConfig333").value = value;
    document.getElementById("telcoServiceTypeEditConfig333").value = telcoServiceType;

})



Livewire.on('getTelcoValueConfig3333Script', ()=>{

    var telco = document.getElementById("telcoeditconfig3333").value;
    var id = document.getElementById("idEditConfig333").value;

    Livewire.emit('getTelcoValueConfig3333', telco, id);
})

Livewire.on('getTelcoValueConfig3Script', ()=>{

    var telco = document.getElementById("telcoeditconfig3").value;
    var id = document.getElementById("idEditConfig1111").value;
    Livewire.emit('getTelcoValueConfig11111', telco, id);
})


Livewire.on('editConfig1ModalScript', id=>{
    var partnerCodeConfig1 = document.getElementById("partnerCodeConfig1-" + id).value;
    var providerCodeConfig1 = document.getElementById("providerCodeConfig1-" + id).value;
    var value = document.getElementById("value-" + id).value;
    var telcoConfig1 = document.getElementById("telcoConfig1-" + id).value;
    var telcoServiceTypeConfig1 = document.getElementById("telcoServiceTypeConfig1-" + id).value;

    document.getElementById("telcoeditconfig111").value = telcoConfig1;

    document.getElementById("parner_code_value_editconfig1").value = partnerCodeConfig1;

    document.getElementById("editProviderCodeConfig1").value = providerCodeConfig1;

    document.getElementById("editValueConfig1").value = value;

    document.getElementById("telcoServiceTypeaddconfig1Edit").value = telcoServiceTypeConfig1;

    document.getElementById("idEditConfig1111").value = id;

})

Livewire.on('editConfig1Script2222', ()=>{

    var id = document.getElementById("idEditConfig1111").value;
    var partnerCodeID = document.getElementById("parner_code_value_editconfig1").value;
    var providerCodeID = document.getElementById("editProviderCodeConfig1").value;

    var valueID = document.getElementById("editValueConfig1").value;
    var telcoID = document.getElementById("telcoeditconfig111").value;
    var telco_service_typeID = document.getElementById("telcoServiceTypeaddconfig1Edit").value;

    Livewire.emit('updateConfig1',
            id,
            partnerCodeID,
            providerCodeID,
            valueID,
            telcoID,
            telco_service_typeID,
            );


    setTimeout(function(){
        document.getElementById("row-messageUpudateDelete").style.display = "none";
        // Livewire.emit('removeMessageUpdateDeleteConfig');
    }, 7000);


})
