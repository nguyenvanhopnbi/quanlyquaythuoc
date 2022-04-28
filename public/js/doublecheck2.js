
Livewire.on('ExportDoisoatPartnerScript', ()=>{
    var partner_code = document.getElementById("partner_code").value;
    var start_time = document.getElementById("start_time").value;
    var end_time = document.getElementById("end_time").value;
    var chukydoisoat = document.getElementById("chukydoisoat").value;

    Livewire.emit("ExportDoisoatPartner", partner_code, start_time, end_time, chukydoisoat);
});
Livewire.on("ExportConfirmScheduleScript", ()=>{
    var startTimeSearch = document.getElementById("startTimeSearch").value;
    var endTimeSearch = document.getElementById("endTimeSearch").value;
    var createdBy = document.getElementById("createdBy").value;

    var dateperform = document.getElementById("TimeDatePerformSearch").value;
    var isUsed = document.getElementById("isUsedSearch").value;
    var isConfirmSearch = document.getElementById("isConfirmSearch").value;
    var scheduleCode = document.getElementById("search_schedule_code").value;
    var yearPerform = document.getElementById("search_year_perform").value;


     var protocol = window.location.protocol;
                var host = window.location.host;
                var url = protocol + '//' + host + '/';

    window.open(url + 'cross-check-confirm-schedule-exportCSV?startTimeSearch='+ startTimeSearch
        +'&endTimeSearch='+endTimeSearch
        +'&createdBy='+createdBy
        +'&dateperform='+dateperform
        +'&isUsed='+isUsed
        +'&isConfirmSearch='+isConfirmSearch
        +'&scheduleCode='+scheduleCode
        +'&yearPerform='+yearPerform
        );

});

Livewire.on("ExportBienBanDoiSoatScript", id=>{
    Livewire.emit("ExportBienBanDoiSoat", id);
});

Livewire.on('ExportTransactionCrossCheckScript', id=>{

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url = protocol + '//' + host + '/';

    var idsVA =  '';

    // var ids = document.getElementById('ids-' + id ).value;
    // idsVA = document.getElementById('ids-va-' + id).value;



    Swal.fire({
      title: 'Download csv đối soát cổng thanh toán và VA',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'CSV Gate',
      denyButtonText: `CSV VA`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        window.open(url + 'ebill-partner-va-bank-transaction-reconciliation-data-export?ids='+ id);
      } else if (result.isDenied) {
        // if(idsVA == null || idsVA == ''){
        //     alert('Không có dữ liệu export..');
        //     return;
        // }

        window.open(url + 'ebill-partner-va-bank-transaction-reconciliation-data-exportVA?id='+ id);
      }
    })


});

Livewire.on('SearchDoiSoatProviderScript', ()=>{
    var dateTime = document.getElementById("startTimeSearch").value;
    Livewire.emit("SearchDoiSoatProvider", dateTime);

})

Livewire.on('ExportCSVDoiSoatProviderScript', ()=>{
    var dateTime = document.getElementById("startTimeSearch").value;
    var providerCode = document.getElementById('search_providerCode').value;
    if(dateTime == ''){
        alert('Hãy chọn ngày đối soát!');
        document.getElementById("startTimeSearch").focus();
        return;
    }

    Livewire.emit("ExportCSVDoiSoatProvider", dateTime, providerCode);
})

Livewire.on('showBaocaoDoisoatChitietScript', id=>{
    //id = id

    var reconciliation_schedule_detail_id = document.getElementById("reconciliation_schedule_detail_id-" + id).value;
    document.getElementById("reconciliation_schedule_detail_id").value = reconciliation_schedule_detail_id;
    var partner_code = document.getElementById("partner_code-" + id).value;
    var schedule_code = document.getElementById("schedule_code-" + id).value;
    if(schedule_code == 'every_day'){
        schedule_code = "Hằng ngày";
    }
    if(schedule_code == 'every_week'){
        schedule_code = "Hằng tuần";
    }
    if(schedule_code == 'every_month'){
        schedule_code = "Hằng tháng";
    }
    if(schedule_code == 'every_three_day'){
        schedule_code = "Ba ngày 1 lần";
    }
    var sum_revenue = document.getElementById("sum_revenue-" + id).value;
    var sum_refund = document.getElementById("sum_refund-" + id).value;
    var sum_hold = document.getElementById("sum_hold-" + id).value;
    var sum_unhold = document.getElementById("sum_unhold-" + id).value;
    var sum_receive = document.getElementById("sum_receive-" + id).value;
    var sum_cost = document.getElementById("sum_cost-" + id).value;
    var status = document.getElementById("txt-status-" + id).value;
    if(status == 'pending'){
        status = "chờ xử lý";
    }
    if(status == 'processing'){
        status = "Duyệt";
    }
    if(status == 'non_processing'){
        status = "Không duyệt";
    }
    if(status == 'wait_confirm'){
        status = "Chờ xác nhận";
    }
    if(status == 'confirm_success'){
        status = "Xác nhận";
    }
    if(status == 'confirm_fail'){
        status = "Từ chối";
    }

    var reason = document.getElementById("reason-" + id).value;
    var date_perform_reconciliation = document.getElementById("date_perform_reconciliation-" + id).value;
    var start_date = document.getElementById("start_date-" + id).value;
    var end_date = document.getElementById("end_date-" + id).value;
    var created_at = document.getElementById("created_at-" + id).value;
    var updated_at = document.getElementById("updated_at-" + id).value;
    var start_time = document.getElementById("start_time-" + id).value;
    var end_time = document.getElementById("end_time-" + id).value;
    var logs = document.getElementById("logs-" + id).value;

    var system_auto_change_cf_success = document.getElementById("system_auto_change_cf_success-" + id).value;
    document.getElementById("system_auto_change_cf_success").value = system_auto_change_cf_success;


    document.getElementById("chitiet-ID").value = id;
    document.getElementById("chitiet-partner_code").value = partner_code;
    document.getElementById("chitiet-schedule_code").value = schedule_code;
    document.getElementById("chitiet-sum_revenue").value = sum_revenue;
    document.getElementById("chitiet-sum_refund").value = sum_refund;
    document.getElementById("chitiet-sum_hold").value = sum_hold;
    document.getElementById("chitiet-sum_unhold").value = sum_unhold;

    document.getElementById("chitiet-sum_recieve").value = sum_receive;
    document.getElementById("chitiet-sum_cost").value = sum_cost;
    document.getElementById("chitiet-status").value = status;
    document.getElementById("chitiet-reason").value = reason;
    document.getElementById("text-chitiet-reason").innerHTML = reason;

    document.getElementById("chitiet-date_perform_reconciliation").value = date_perform_reconciliation;
    document.getElementById("chitiet-start_date").value = start_date;
    document.getElementById("chitiet-end_date").value = end_date;
    document.getElementById("chitiet-created_at").value = created_at;

    document.getElementById("chitiet-updated_at").value = updated_at;
    document.getElementById("chitiet-start_time").value = start_time;
    document.getElementById("chitiet-end_time").value = end_time;
    document.getElementById("chitiet-logs").value = logs;

})

Livewire.on('ConfirmLichDoiSoatScript', ()=>{
    // alert('11111111111');
    var scheduleCode = document.getElementById("ScheduleCodeConfirm").value;
    var yearPerform = document.getElementById("YearPerformConfirm").value;

    if(yearPerform == ''){
        alert("Hãy nhập năm : ");
        document.getElementById("YearPerformConfirm").focus();
        return;
    }

    Livewire.emit("ConfirmLichDoiSoat", scheduleCode, yearPerform);
})

Livewire.on("UpdateDoisoattheopartnerScript", ()=>{
    var id = document.getElementById("UpdateDoisoattheopartner").value;
    var partnerCode = document.getElementById("update-partnerCode").value;
    var scheduleCode = document.getElementById("sheduleCodeUpdate").value;

    if(partnerCode == ''){
        alert("Hãy nhập partner Code");
        document.getElementById("update-partnerCode").focus();
        return;
    }

    if(scheduleCode == ''){
        alert("Hãy nhập Schedule Code");
        document.getElementById("sheduleCodeUpdate").focus();
        return;
    }

    Livewire.emit("UpdateDoisoattheopartner", id, partnerCode, scheduleCode);
})

Livewire.on('getDateTableUpdatePartnerScript', id=>{
    var partnerCode = document.getElementById("partner_code-" + id).value;
    var scheduleCode = document.getElementById("ScheduleCode-" + id).value;

    if(scheduleCode == 'Hằng ngày'){
        scheduleCode = 'every_day';
    }

    if(scheduleCode == 'Hằng tuần'){
        scheduleCode = 'every_week';
    }

    if(scheduleCode == 'Hằng tháng'){
        scheduleCode = 'every_month';
    }
    if(scheduleCode == 'Ba ngày 1 lần'){
        scheduleCode = 'every_three_day';
    }

    document.getElementById('UpdateDoisoattheopartner').value = id;

    document.getElementById("update-partnerCode").value = partnerCode;
    document.getElementById(scheduleCode).selected = true;
})

Livewire.on('AddnewDoiSoatTheoPartnerScript', ()=>{
    var partnerCode  = document.getElementById("addnew-partnerCode").value;
    var scheduleCode = document.getElementById("addnew-scheduleCode").value;

    if(partnerCode == ''){
        alert("Hãy nhập partner code!");
        document.getElementById("addnew-partnerCode").focus();
        return;
    }
    if(scheduleCode == ''){
        alert("Hãy chọn schedule code");
        document.getElementById("addnew-scheduleCode").focus();
        return;
    }

    Livewire.emit("AddnewDoiSoatTheoPartner", partnerCode, scheduleCode);
})

Livewire.on('deleteCheckPartnerScript', id=>{
    var cFirm = confirm("Bạn có chắc chắn muốn xóa đối soát theo partner này không?");
    if(cFirm){
        Livewire.emit("deleteCheckPartner", id);
    }
})

Livewire.on('SearchDoisoattheoPartnerScript', ()=>{
    var partner_code = document.getElementById("partner_code").value;
    var start_time = document.getElementById("start_time").value;
    var end_time = document.getElementById("end_time").value;
    var chukydoisoat = document.getElementById("chukydoisoat").value;

    Livewire.emit("SearchDoisoattheoPartner", partner_code, start_time, end_time, chukydoisoat);
})


Livewire.on('ShowChitietdoisoatScript', id=>{
    var start_date = document.getElementById("startDate-" + id).value;
    var end_date = document.getElementById("endDate-" + id).value;
    var start_time = document.getElementById("startTime-" + id).value;
    var end_time = document.getElementById("endTime-" + id).value;
    var date_perform = document.getElementById("datePerform-" + id).value;
    var created_by = document.getElementById("created_by-" + id).value;
    var year_perform = document.getElementById("yearPerform-" + id).value;
    var logs = document.getElementById("log-" + id).value;
    var updated_by = document.getElementById("updated_by-" + id).value;
    var reconciliation_schedule_code = document.getElementById("reconciliation_schedule_code-" + id).value;
    var is_confirm = document.getElementById("isConfirm-" + id).value;
    if(is_confirm == 1){
        is_confirm = "Confirmed";
    }else{
        is_confirm = "No confirmed";
    }
    var is_used = document.getElementById("is_used-" + id).value;
    if(is_used == 1){
        is_used = "Yes";
    }else{
        is_used = "No";
    }
    var created_at = document.getElementById("created_at-" + id).value;
    var updated_at = document.getElementById("updated_at-" + id).value;

    document.getElementById("chitiet-ID").value = id;
    document.getElementById("chitiet-startDate").value = start_date;
    document.getElementById("chitiet-endDate").value= end_date;
    document.getElementById("chitiet-startTime").value = start_time;
    document.getElementById("chitiet-endTime").value = end_time;
    document.getElementById("chitiet-DatePerform").value = date_perform;
    document.getElementById("chitiet-createdBy").value = created_by;
    document.getElementById("chitiet-YearPerform").value = year_perform;
    document.getElementById("chitiet-updateBy").value = updated_by;
    document.getElementById("chitiet-cheduleCode").value = reconciliation_schedule_code;
    document.getElementById("chitiet-isConfirm").value = is_confirm;
    document.getElementById("chitiet-isUsed").value = is_used;
    document.getElementById("chitiet-createdAt").value = created_at;
    document.getElementById("chitiet-updateAt").value = updated_at;
    document.getElementById("chitiet-log").value = logs;
})

Livewire.on("SearchConfirmlichdoisoatScript", ()=>{
    var startTimeSearch = document.getElementById("startTimeSearch").value;
    var createdBy = document.getElementById("createdBy").value;
    var endTimeSearch = document.getElementById("endTimeSearch").value;
    var dateperform = document.getElementById("TimeDatePerformSearch").value;

    var isUsed = document.getElementById("isUsedSearch").value;
    var isConfirmSearch = document.getElementById("isConfirmSearch").value;

    var scheduleCode = document.getElementById("search_schedule_code").value;
    var yearPerform = document.getElementById("search_year_perform").value;

    Livewire.emit("SearchConfirmlichdoisoat",
        startTimeSearch,
        endTimeSearch,
        createdBy,
        dateperform,
        isUsed,
        isConfirmSearch,
        scheduleCode,
        yearPerform

        );
})
Livewire.on('updateConfirmScheduleScript', ()=>{
    var startTime = document.getElementById("startTimeupdate").value;
    var endTime = document.getElementById("endTimeUpdate").value;
    var datePerform = document.getElementById("TimeDatePerformUpdate").value;
    var yearPerform = document.getElementById("namdoisoatupdate").value;
    var kieudoisoatupdate = document.getElementById("kieudoisoatupdate").value;
    var isConfirmedUpdate = document.getElementById("isConfirmedUpdate");
    var id = document.getElementById("IDUpdateScheduleConfirm").value;
    if(isConfirmedUpdate.checked){
        isConfirmedUpdate = 1;
    }else{
        isConfirmedUpdate = 0;
    }
    var log = document.getElementById("LogUpdate").value;

    if(startTime == ''){
        alert('Hãy nhập thời gian bắt đầu.');
        document.getElementById("startTimeupdate").focus();
        return;
    }

    if(endTime == ''){
        alert('Hãy nhập thời gian kết thúc.');
        document.getElementById("endTimeUpdate").focus();
        return;
    }
    if(datePerform == ''){
        alert('Hãy nhập thời gian đối soát.');
        document.getElementById("TimeDatePerformUpdate").focus();
        return;
    }

    if(yearPerform == '' || isNaN(yearPerform)){
        alert('Hãy nhập năm đối soát, phải là số nguyên');
        document.getElementById("namdoisoatupdate").focus();
        return;
    }

    Livewire.emit('updateConfirmSchedule',
        id,
        startTime,
        endTime,
        datePerform,
        yearPerform,
        kieudoisoatupdate,
        isConfirmedUpdate,
        log
        );
})

Livewire.on('getDateTableUpdateScript', id=>{
    var log = document.getElementById("log-" + id).value;
    var startTime = document.getElementById("startTime-" + id).value;
    var endTime = document.getElementById("endTime-" + id).value;
    var datePerform = document.getElementById("datePerform-" + id).value;
    var yearPerform = document.getElementById("yearPerform-" + id).value;
    var reconciliation_schedule_code = document.getElementById("reconciliation_schedule_code-" + id).value;
    var isConfirm = document.getElementById("isConfirm-" + id).value;

    document.getElementById("LogUpdate").value = log;
    document.getElementById("IDUpdateScheduleConfirm").value = id;
    document.getElementById("startTimeupdate").value = startTime;
    document.getElementById("endTimeUpdate").value = endTime;
    document.getElementById("TimeDatePerformUpdate").value = datePerform;
    document.getElementById("namdoisoatupdate").value = yearPerform;
    // document.getElementById("kieudoisoatupdate").value = reconciliation_schedule_code;
    if(reconciliation_schedule_code == 'Hằng ngày'){
        document.getElementById("every_day").selected = true;
    }
    if(reconciliation_schedule_code == 'Hằng tuần'){
        document.getElementById("every_week").selected = true;
    }
    if(reconciliation_schedule_code == 'Hằng tháng'){
        document.getElementById("every_month").selected = true;
    }
    if(reconciliation_schedule_code == 'Ba ngày 1 lần'){
        document.getElementById("every_three_day").selected = true;
    }

    if(isConfirm == 1){
        document.getElementById("isConfirmedUpdate").checked = true;
    }else{
        document.getElementById("isConfirmedUpdate").checked = false;
    }
})

Livewire.on('deleteScheduleConfirmScript', id=>{
    var cFirm = confirm("Bạn có chắc chắn muốn xóa lịch đối soát này? ID = " + id);
    if(cFirm){
        Livewire.emit("deleteScheduleConfirm", id);
    }
})

Livewire.on('AddnewScheduleConfirmScript', ()=>{

    var startTimeSearchAddnew = document.getElementById("startTimeSearchAddnew").value;
    var endTimeSearchAddnew = document.getElementById("endTimeSearchAddnew").value;
    var TimeDatePerform = document.getElementById("TimeDatePerform").value;
    var namdoisoat = document.getElementById("namdoisoat").value;
    var kieudoisoat = document.getElementById("kieudoisoat").value;
    var isConfirmed = document.getElementById("isConfirmed");

    if(isConfirmed.checked){
        isConfirmed = '1';
    }else{
        isConfirmed = '0';
    }

    if(startTimeSearchAddnew == ''){
        alert("Hãy nhập thời gian bắt đầu: ");
        document.getElementById("startTimeSearchAddnew").focus();
        return;
    }

    if(endTimeSearchAddnew == ''){
        alert("Hãy nhập thời gian kết thúc!");
        document.getElementById("endTimeSearchAddnew").focus();
        return;
    }
    if(TimeDatePerform == ''){
        alert("Hãy nhập thời gian đối soát!");
        document.getElementById("TimeDatePerform").focus();
        return;
    }

    if(namdoisoat == '' || isNaN(namdoisoat)){
        alert('Hãy nhập năm đối soát, phải là số nguyên');
        document.getElementById("namdoisoatupdate").focus();
        return;
    }

    Livewire.emit("AddnewScheduleConfirm",
        startTimeSearchAddnew,
        endTimeSearchAddnew,
        TimeDatePerform,
        namdoisoat,
        kieudoisoat,
        isConfirmed
        );
})

Livewire.on('ExportTransactionScript', transactionID=>{
    if(transactionID == '' || transactionID == null){
        alert('Không tìm thấy bất cứ transactionID nào, hãy kiểm tra lại!');
        return;
    }
    Livewire.emit('ExportTransaction', transactionID);
})

Livewire.on('BienBanDoiSoatScript', id=>{
    var partnerCode = document.getElementById("partner_code-" + id).value;
    Livewire.emit('BienBanDoiSoat', id, partnerCode);
})


Livewire.on('TatcastatusScript', ()=>{

    $("#loadingWrap").removeAttr("style");

    Livewire.emit('Tatcastatus');
})

Livewire.on('XacnhanthanhcongScript', ()=>{

    $("#loadingWrap").removeAttr("style");

    Livewire.emit('Xacnhanthanhcong');
})

Livewire.on('ChoxacnhanScript', ()=>{

    $("#loadingWrap").removeAttr("style");

    Livewire.emit('Choxacnhan');
})

Livewire.on('DaduyetScript', ()=>{

    $("#loadingWrap").removeAttr("style");

    Livewire.emit('Daduyet');
})

Livewire.on('KhongduyetScript', ()=>{

    $("#loadingWrap").removeAttr("style");

    Livewire.emit('Khongduyet');
})

Livewire.on('TuchoiScript', ()=>{

    $("#loadingWrap").removeAttr("style");

    Livewire.emit('Tuchoi');
})

Livewire.on('Chodoisoatduyet', ()=>{

    $("#loadingWrap").removeAttr("style");

    Livewire.emit('SearchChodoisoatduyet');
})

Livewire.on('filterRadioScript', ()=>{
    var madoisoat = document.getElementById("madoisoat").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;

})



Livewire.on('ExportCSVCrosscheckScript', ()=>{
    var madoisoat = document.getElementById("madoisoat").value;
    var partner_code_search = document.getElementById("partner_code_search").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;
    var status = document.getElementsByName("ds_status");
    var statusChecked = '';

    for (var i = 0; i < status.length; i++){
        if (status[i].checked == true){
            statusChecked = status[i].value;
        }
    }

    var TimeSearchPerform = document.getElementById("TimeSearchPerform").value;
    var schedule_code_search = document.getElementById("search_schedule_code").value;

    var protocol = window.location.protocol;
                var host = window.location.host;
                var url = protocol + '//' + host + '/';

    window.open(url + 'cross-check-export-csv?madoisoat='+ madoisoat
        +'&partner_code_search='+partner_code_search
        +'&startTime='+startTime
        +'&endTime='+endTime
        +'&statusChecked='+statusChecked
        +'&TimeSearchPerform='+TimeSearchPerform
        +'&schedule_code_search='+schedule_code_search
        );

});



Livewire.on('SearchScript', ()=>{

    var madoisoat = document.getElementById("madoisoat").value;
    var partner_code_search = document.getElementById("partner_code_search").value;
    var startTime = document.getElementById("startTimeSearch").value;
    var endTime = document.getElementById("endTimeSearch").value;
    var status = document.getElementsByName("ds_status");
    var sum_recieved = document.getElementById("search_sum_recieve").value;
    var statusChecked = '';

    for (var i = 0; i < status.length; i++){
        if (status[i].checked == true){
            statusChecked = status[i].value;
        }
    }

    var TimeSearchPerform = document.getElementById("TimeSearchPerform").value;

    var schedule_code_search = document.getElementById("search_schedule_code").value;


    Livewire.emit('Search', madoisoat, partner_code_search, startTime, endTime, statusChecked, TimeSearchPerform, schedule_code_search, sum_recieved);

})

Livewire.on('selectTotalRecordScript', ()=>{

    $("#loadingWrap").removeAttr("style");

    var limit = document.getElementById("select-box-total-record").value;
    Livewire.emit('selectTotalRecord', limit);
})

Livewire.on('messageScript', message=>{

    Swal.fire({
            title: "Lý do!",
            text: message.message,
            input: "textarea",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Write something"
        }).then(function(reason){
            if(reason.isDismissed){
                document.getElementById("cbx-status-" + message.id).value = "pending";
            }
            if(reason.isConfirmed){
                // Livewire.emit('NoconfirmDoubleCheck', message.id, reason.value);
                var checkConfirmAll = document.getElementsByName('crosscheck-all');
                    var checkTrue = 0;
                    for(var a = 0; a < checkConfirmAll.length; a++){
                        if(checkConfirmAll[a].checked){
                            checkTrue++;
                        }
                    }

                    if(checkTrue <= 0){

                        $("#loadingWrap").removeAttr("style");

                        Livewire.emit('NoconfirmDoubleCheck', message.id, reason.value);
                        return;
                    }else{

                        var idArr = [];
                        for(var i = 0; i < checkConfirmAll.length; i++){

                            if(checkConfirmAll[i].checked){
                                idArr.push(checkConfirmAll[i].value);
                            }
                        }


                        $("#loadingWrap").removeAttr("style");

                        Livewire.emit('changeStatusRefuse', message.id, reason.value);

                    }
            }
        });

});


Livewire.on('messageConfirmScript', message=>{

    if(message.warning){
        Swal.fire({
              position: 'center',
              icon: 'error',
              title: message.message,
              showConfirmButton: false,
              timer: 3000
        })
    }else{
        Swal.fire({
              position: 'center',
              icon: 'success',
              title: message.message,
              showConfirmButton: false,
              timer: 3000
        })
    }


});


Livewire.on('messageConfirmAllScript', message =>{

    var success = message.success;
    var idSuccess = '';

    var error = message.error;
    var idError = '';

    if(success.length > 1){
        for(var i = 0; i < success.length; i++){
            idSuccess += success[i].id + ',';
        }

        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Đã duyệt thành công '+ message.countSuccess +' đối soát!',
          text: idSuccess,
          showConfirmButton: false,
          timer: 3000
        })
    }

    if(error.length > 1){
        for(var i = 0; i < error.length; i++){
            idError += error[i].id + ',';
        }

        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Đã duyệt thất bại '+ message.countError +' đối soát!',
          text: idError,
          showConfirmButton: false,
          timer: 3000
        })
    }


    document.getElementById("confirm_reject_multi").value = "action";

    document.getElementById("crosscheck-all-items").checked = false;

});



Livewire.on('messageRefuseAllScript', message =>{

    var success = message.success;
    var idSuccess = '';

    var error = message.error;
    var idError = '';

    if(success.length > 1){
        for(var i = 0; i < success.length; i++){
            idSuccess += success[i].id + ',';
        }

        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Đã từ chối thành công'+ message.countSuccess +' đối soát!',
          text: idSuccess,
          showConfirmButton: false,
          timer: 3000
        })
    }

    if(error.length > 1){
        for(var i = 0; i < error.length; i++){
            idError += error[i].id + ',';
        }

        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Đã từ chối thất bại '+ message.countError +' đối soát!',
          text: idError,
          showConfirmButton: false,
          timer: 3000
        })
    }

    document.getElementById("confirm_reject_multi").value = "action";

    document.getElementById("crosscheck-all-items").checked = false;


});


Livewire.on('changeStatusConfirmScript', ()=>{
    var chkConfirm = document.getElementsByName('crosscheck-all');
    var idArr = [];

        // Lặp qua từng chkConfirm để lấy giá trị
    for (var i = 0; i < chkConfirm.length; i++){
        if (chkConfirm[i].checked === true && chkConfirm[i].disabled === false && chkConfirm[i].value != 'check-all'){
            idArr.push(chkConfirm[i].value);
        }
    }

    if (idArr === undefined || idArr.length == 0) {
        alert('Cần tích chọn đối soát hợp lệ để duyệt hoặc từ chối');

        document.getElementById("confirm_reject_multi").value = "action";

        return;
    }

    var statusConfirm = document.getElementById('confirm_reject_multi').value;

    if(statusConfirm == 'confirm'){

        Swal.fire({
            title: "Xác nhận!",
            text: "Bạn có chắc chắn xác nhận những giao dịch đối soát đã chọn?",
            showCancelButton: true,
        }).then(function(reason){

            if(reason.isDismissed){
                document.getElementById("confirm_reject_multi").value = "action";
            }
            if(reason.isConfirmed){

                $("#loadingWrap").removeAttr("style");
                document.getElementById("crosscheck-all-items").checked = false;
                Livewire.emit('changeStatusConfirm', idArr);

            }
        });
    }


    if(statusConfirm == 'refuse'){

        Swal.fire({
            title: "Lý do!",
            text: "Hãy nhập lý do KHÔNG xác nhận:",
            input: "textarea",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Viết lý do từ chối"
        }).then(function(reason){

            if(reason.isDismissed){
                document.getElementById("confirm_reject_multi").value = "action";
            }
            if(reason.isConfirmed){

                $("#loadingWrap").removeAttr("style");

                document.getElementById("crosscheck-all-items").checked = false;

                Livewire.emit('changeStatusRefuse', idArr, reason.value);
            }
        });
    }

});


Livewire.on('changeConfirmScript', id=>{
    var txtStatus = document.getElementById("txt-status-" + id).value;
    var cbxStatus = document.getElementById("cbx-status-" + id).value;


    if(txtStatus == 'pending' && cbxStatus == 'confirm' ){
        Swal.fire({
            title: "Bạn chắc chắn xác nhận?",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Write something"
        }).then(function(reason){
            if(reason.isDismissed){
                document.getElementById("cbx-status-" + id).value = "pending";
            }
            if(reason.isConfirmed){


                var checkConfirmAll = document.getElementsByName('crosscheck-all');
                    var checkTrue = 0;
                    for(var a = 0; a < checkConfirmAll.length; a++){
                        if(checkConfirmAll[a].checked){
                            checkTrue++;
                        }
                    }

                    if(checkTrue <= 0){

                        $("#loadingWrap").removeAttr("style");

                        Livewire.emit('confirmDoubleCheck', id);
                        return;
                    }else{

                        var idArr = [];
                        for(var i = 0; i < checkConfirmAll.length; i++){

                            if(checkConfirmAll[i].checked){
                                idArr.push(checkConfirmAll[i].value);
                            }
                        }

                        $("#loadingWrap").removeAttr("style");
                        Livewire.emit('changeStatusConfirm', idArr);


                    }

                    document.getElementById("cbx-status-" + id).value = "pending";

            }
        });


    }
    if(txtStatus == 'pending' && cbxStatus == 'refuse' ){

        Swal.fire({
            title: "Lý do!",
            text: "Hãy nhập lý do KHÔNG xác nhận:",
            input: "textarea",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Write something"
        }).then(function(reason){
            if(reason.isDismissed){
                document.getElementById("cbx-status-" + id).value = "pending";
            }
            if(reason.isConfirmed){



                var checkConfirmAll = document.getElementsByName('crosscheck-all');
                    var checkTrue = 0;
                    for(var a = 0; a < checkConfirmAll.length; a++){
                        if(checkConfirmAll[a].checked){
                            checkTrue++;
                        }
                    }

                    if(checkTrue <= 0){

                        $("#loadingWrap").removeAttr("style");

                        Livewire.emit('NoconfirmDoubleCheck', id, reason.value);
                        return;
                    }else{

                        var idArr = [];
                        for(var i = 0; i < checkConfirmAll.length; i++){

                            if(checkConfirmAll[i].checked){
                                idArr.push(checkConfirmAll[i].value);
                            }
                        }


                        $("#loadingWrap").removeAttr("style");

                        Livewire.emit('changeStatusRefuse', idArr, reason.value);

                    }




                document.getElementById("cbx-status-" + id).value = "pending";

            }
        });

    }
})
