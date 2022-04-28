<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Cập nhật giao dịch
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-3">
                    <label class="text-dark">Danh sách mã giao dịch:</label>
                </div>
            </div>
            @if(isset($message))
            <div class="row">
                <div class="col-md-8">
                    <span class="alert @if($warning == false) {{'alert-primary'}} @else {{'alert-warning'}} @endif ">{{$message}}</span>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <textarea
                    placeholder="{!! $placeholder !!}"
                    name="transaction_id_array" id="transaction_id_array" cols="60" rows="10"></textarea>
                </div>
                <div class="col-md-6">

                    <span class="text-primary">Chú ý mỗi transactionID nằm trên một hàng</span>

                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <button wire:click.prevent="$emit('updateTransactionScript')" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
            @if(isset($TransactionIDerror))
            <div class="row" style="margin-top: 10px">
                <div class="col-md-3">
                    <lable class="text-primary" style="font-weight: bold; margin-top: 15px"> Danh sách mã giao dịch cập nhật thất bại: </lable>
                </div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-md-6">
                        <span>Số lượng: {{count($TransactionIDerror)}}</span><br>
                        @foreach($TransactionIDerror as $iderror)
                            <a target="_blank" href='/transfer-money-transactions?filter%5B0%5D=partnerCode&filter%5B1%5D=applicationId&filter%5BapplicationId%5D=&filter%5BtransactionId%5D={{$iderror}}'>{{$iderror}}</a><br>
                        @endforeach

                </div>
            </div>
            @endif
            @if(isset($TransactionIDsuccess))
            <div class="row" style="margin-top: 10px">
                <div class="col-md-3">
                    <lable class="text-primary" style="font-weight: bold; margin-top: 15px"> Danh sách mã giao dịch cập nhật thành công: </lable>
                </div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-md-6">
                        <span>Số lượng: {{count($TransactionIDsuccess)}}</span><br>
                        @foreach($TransactionIDsuccess as $id)
                            <a target="_blank" href='/transfer-money-transactions?filter%5B0%5D=partnerCode&filter%5B1%5D=applicationId&filter%5BapplicationId%5D=&filter%5BtransactionId%5D={{$id}}'>{{$id}}</a><br>
                        @endforeach

                </div>
            </div>
             @endif
        </div>

    </div>
</div>

<script>
    document.addEventListener('livewire:load', function(){
        Livewire.on('updateTransactionScript', ()=>{

            var cFirm = confirm("Bạn chắc chắn cập nhật trạng thái giao dịch không?");
            if(!cFirm){
                return;
            }

            var transaction_id_list = document.getElementById("transaction_id_array").value;
            if(transaction_id_list == ''){
                alert('Hãy nhập mã giao dịch, hoặc danh sách mã giao dịch');
                document.getElementById("transaction_id_array").focus();
                return;
            }
            var transactionID_array = [];
            var transactionID = '';
            for(i = 0; i < transaction_id_list.length; i++){
                if(transaction_id_list.charAt(i) != ','){
                    transactionID = transactionID + transaction_id_list.charAt(i);
                }
                if(transaction_id_list.charAt(i) == ',' || i == (transaction_id_list.length - 1)){
                    transactionID_array.push(transactionID);
                    transactionID = '';
                }
            }
            // alert(transactionID_array);

            Livewire.emit('updateTransaction', transactionID_array);
        });

        // setTimeout(function(){
        //     Livewire.emit('resetMessage');
        // }, 6000);
    });
</script>
