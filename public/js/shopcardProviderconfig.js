Livewire.on("updateShopCardProviderConfigScript", ()=>{
    var id = document.getElementById("IDproviderConfigUpdate").value;
    var secretKey = document.getElementById("update_secretKey").value;
    var rsaPublicKey = document.getElementById("update_rsaPublicKey").value;
    var rsaPrivateKey = document.getElementById("update_rsaPrivateKey").value;

    if(secretKey == ''){
        alert('Please enter your secret key: ');
        document.getElementById("update_secretKey").focus();
        return;
    }

    if(rsaPublicKey == ''){
        alert('Please enter your rsa public key: ');
        document.getElementById("update_rsaPublicKey").focus();
        return;
    }

    if(rsaPrivateKey == ''){
        alert('Please enter your rsa private key: ');
        document.getElementById("update_rsaPrivateKey").focus();
        return;
    }


    Livewire.emit('updateShopCardProviderConfig', id, secretKey, rsaPublicKey, rsaPrivateKey);
    setTimeout(function(){
        Livewire.emit("resetMessage");
    }, 6000);
})

Livewire.on('getDateTableShopCardProviderConfig', id=>{
    var providerCode = document.getElementById("providerCode-" + id).value;
    var secretKey = document.getElementById("secretKey-" + id).value;
    var rsaPrivateKey = document.getElementById("rsaPrivateKey-" + id).value;
    var rsaPublicKey = document.getElementById("rsaPublicKey-" + id).value;

    document.getElementById("update_rsaPublicKey").value = rsaPublicKey;
    document.getElementById("IDproviderConfigUpdate").value = id;
    document.getElementById("update_secretKey").value = secretKey;
    document.getElementById("update_rsaPrivateKey").value = rsaPrivateKey;

})

Livewire.on('deleteShopCardProviderConfigScript', id=>{
    var cFirm = confirm("Are you sure to delete this ID: " + id + "?");
    if(cFirm){
        Livewire.emit("deleteShopCardProviderConfig", id);
    }

    setTimeout(function(){
        Livewire.emit("resetMessage");
    }, 6000);
})


Livewire.on('addNewShopCardProviderConfigScript', ()=>{
    var providerCode = document.getElementById("addnew_provider_code").value;
    var secretKey = document.getElementById("addnew_secretKey").value;
    var rsaPublicKey = document.getElementById("addnew_rsaPublicKey").value;
    var rsaPrivateKey = document.getElementById("addnew_rsaPrivateKey").value;

    if(providerCode == ''){
        alert('Please enter your provider Code: ');
        document.getElementById("addnew_provider_code").focus();
        return;
    }

    if(secretKey == ''){
        alert('Please enter your secret key: ');
        document.getElementById("addnew_secretKey").focus();
        return;
    }

    if(rsaPublicKey == ''){
        alert('Please enter your rsa public key: ');
        document.getElementById("addnew_rsaPublicKey").focus();
        return;
    }

    if(rsaPrivateKey == ''){
        alert('Please enter your rsa private key: ');
        document.getElementById("addnew_rsaPrivateKey").focus();
        return;
    }

    Livewire.emit("addNewShopCardProviderConfig", providerCode, secretKey, rsaPublicKey, rsaPrivateKey);
    setTimeout(function(){


        document.getElementById("addnew_provider_code").value = '';
        document.getElementById("addnew_secretKey").value = '';
        document.getElementById("addnew_rsaPublicKey").value = '';
        document.getElementById("addnew_rsaPrivateKey").value = '';

        Livewire.emit("resetMessage");
    }, 6000);
})


Livewire.on('searchShopCardProviderConfigScript', ()=>{
    var providerCode = document.getElementById("search_providerCode").value;

    Livewire.emit('searchShopCardProviderConfig', providerCode);
})
