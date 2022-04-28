Livewire.on('ShowCodeScript', id=>{
    document.getElementById("codecard-" + id).style.display = "block";
    if(id == ''){
        alert('Chúng tôi không tìm thấy ID card mà bạn muốn xem mã code.');
        return;
    }
    Livewire.emit('ShowCode', id);
})

Livewire.on('getDataTableScript', (card_item, id)=>{
    // document.getElementById("data-card").style.color="red";
    Livewire.emit('getDataTable', card_item);
})

Livewire.on('searchExportItemScript', ()=>{
    var nhamang = document.getElementById("nhamangSearch").value;
    var menhgia = document.getElementById("valueSearch").value;
    var soluong = document.getElementById("quantitySearch").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;
    var email = document.getElementById("emailAdminSearch").value;
    Livewire.emit("searchExportItem", nhamang, menhgia, soluong, startTime, endTime, email);
})

Livewire.on('exportcardItemScript', ()=>{
    var NhaMang = document.getElementById("nhamang").value;
    var value = document.getElementById("value").value;
    var soluong = document.getElementById("quantity").value;

    Livewire.emit("exportcardItem", NhaMang, value, soluong);
})

Livewire.on('getValueScript', ()=>{

    var valueNhaMang = document.getElementById("nhamang").value;
    Livewire.emit("getValue", valueNhaMang);
})
