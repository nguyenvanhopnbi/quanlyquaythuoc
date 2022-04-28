<div>
    {{-- In work, do what you enjoy. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    History Manager Risk

                </h3>
            </div>

        </div>
        <div class="kt-portlet__body">
            {{-- begin search form  --}}

            <div class="kt-portlet__body">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div wire:ignore class="row align-items-center">

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Transaction ID:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            wire:keydown.enter="$emit('searchHistoryRiskScript')"
                                            value="{{request()->transaction_id}}"
                                            placeholder="enter your transaction id" type="text" class="form-control" name="search_transaction_id" id="search_transaction_id">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Card Number:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            wire:keydown.enter="$emit('searchHistoryRiskScript')"
                                            value="{{request()->card_number}}"
                                            placeholder="enter your card number" type="text" class="form-control" name="search_card_number" id="search_card_number">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Order ID:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            wire:keydown.enter="$emit('searchHistoryRiskScript')"
                                            value="{{request()->order_id}}"
                                            placeholder="enter your order ID" type="text" class="form-control" name="search_order_id" id="search_order_id">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Card Name:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            wire:keydown.enter="$emit('searchHistoryRiskScript')"
                                            value="{{request()->card_name}}"
                                            placeholder="enter your card name" type="text" class="form-control" name="search_card_name" id="search_card_name">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>IP:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            wire:keydown.enter="$emit('searchHistoryRiskScript')"
                                            value="{{request()->ip}}"
                                            placeholder="enter your IP" type="text" class="form-control" name="search_IP" id="search_IP">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Amount:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            wire:keydown.enter="$emit('searchHistoryRiskScript')"
                                            value="{{request()->amount}}"
                                            placeholder="enter your amount" type="text" class="form-control" name="search_amount" id="search_amount">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            wire:keydown.enter="$emit('searchHistoryRiskScript')"
                                            list = "partnerCodeList"
                                            value="{{request()->partnerCode}}"
                                            placeholder="enter your partner code" type="text" class="form-control" name="search_partnercode" id="search_partnercode">
                                            <datalist id="partnerCodeList">
                                                @if(isset($partnerCodeList))
                                                @foreach($partnerCodeList as $list)
                                                <option value="{{$list->partner_code}}"></option>

                                                @endforeach
                                                @endif
                                            </datalist>
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Vender code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            wire:keydown.enter="$emit('searchHistoryRiskScript')"
                                            value="{{request()->vendorCode}}"
                                            placeholder="enter your vendor code" type="text" class="form-control" name="search_vendorcode" id="search_vendorcode">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Bank code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            wire:keydown.enter="$emit('searchHistoryRiskScript')"
                                            value="{{request()->bankcode}}"
                                            placeholder="enter your bank code" type="text" class="form-control" name="search_bankcode" id="search_bankcode">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Status:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            wire:keydown.enter="$emit('searchHistoryRiskScript')"
                                            value="{{request()->status}}"
                                            placeholder="enter your status" type="text" class="form-control" name="search_status" id="search_status">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Rule Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            wire:keydown.enter="$emit('searchHistoryRiskScript')"
                                            value="{{request()->ruleCode}}"
                                            placeholder="enter your code" type="text" class="form-control" name="search_rule_code" id="search_rule_code">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Action:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            wire:keydown.enter="$emit('searchHistoryRiskScript')"
                                            value="{{request()->action}}"
                                            placeholder="warning, hold, success" type="text" class="form-control" name="search_Action" id="search_Action">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Start Time:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            autocomplete="off"
                                            wire:keydown.enter="$emit('searchHistoryRiskScript')"
                                            @if(isset($startTime) and request()->startTime != 0)
                                            value="{{date('Y-m-d H:i:s', request()->startTime)}}"
                                            @endif
                                            placeholder="Y-m-d H:i:s" class="form-control" type="text" id="startTimeSearch" name="startTimeSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>End Time:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            autocomplete="off"
                                            wire:keydown.enter="$emit('searchHistoryRiskScript')"
                                            @if(isset($endTime)  and request()->endTime != 0)
                                            value="{{date('Y-m-d H:i:s', request()->endTime)}}"
                                            @endif
                                            placeholder="Y-m-d H:i:s" class="form-control" type="text" id="endTimeSearch" name="endTimeSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <a
                                            wire:click.prevent="$emit('searchHistoryRiskScript')"
                                            class="btn btn-primary"
                                            style="color:#FFF">Search</a>
                                            <a
                                            wire:click.prevent="$emit('ExportHistoryRiskScript')"
                                            class="btn btn-primary"
                                            style="color:#FFF">Export</a>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end search form --}}

            {{-- inactive partner code --}}
            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="InactivePartnerCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inactive PartnerCode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                @if(isset($message))
                <div class="form-group @if($message) {{'alert alert-warning'}} @else {{ 'alert alert-info' }}  @endif">{{$message}}</div>
                @endif
                <div class="form-group">
                    <label for="exampleInputEmail1">Partner Code: </label>
                    <input readonly="true" type="text" class="form-control" id="partner_code" placeholder="enter partner code">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Payment Method: </label>
                    <input list="payment_method_list" type="text" class="form-control" id="payment_method" placeholder="enter payment method">
                    <datalist id="payment_method_list">
                        <option value="CC"></option>
                        <option value="EWALLET"></option>
                        <option value="ATM"></option>

                    </datalist>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('inactivePartnerCodeScript')" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

{{-- inactive partner code --}}

{{-- begin modal detail his --}}

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Risk History Management</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <table class="table table-light hisDetailTable">
            <tr>
                <td>ID: <input id="HisIDDetails" readonly="true" class="form-control" type="text" value="207"></td>
                <td>Card Number: <input id="HisCardNumberDetails" readonly="true" class="form-control" type="text" value=""></td>
                <td>Card Name: <input id="HisCardNameDetails" readonly="true" class="form-control" type="text" value="nguyen van a"></td>
            </tr>
            <tr>
                <td>Transaction ID: <input id="HisTransactionIDDetails" readonly="true" class="form-control" type="text" value="AP211337935714"></td>
                <td>Partner Code: <input id="HisPartnerCodeDetails" readonly="true" class="form-control" type="text" value="TEST"></td>
                <td>Amount: <input id="HisAmountDetails" readonly="true" class="form-control" type="text" value="500000"></td>
            </tr>
            <tr>
                <td>IP: <input id="HisIPDetails" readonly="true" class="form-control" type="text" value="103.53.170.145"></td>
                <td>Time Request: <input id="HisTimeRequestDetails" readonly="true" class="form-control" type="text" value="2021-08-07 15:17:29"></td>
                <td>Time Response: <input id="HisTimeResponseDetails" readonly="true" class="form-control" type="text" value="2021-08-07 15:17:56"></td>
            </tr>
            <tr>
                <td>Bank Code: <input id="HisBankCodeDetails" readonly="true" class="form-control" type="text" value="VISA"></td>
                <td>Vendor Code: <input id="HisVendorCodeDetails" readonly="true" class="form-control" type="text" value="APPOTA_VISA_TEST"></td>
                <td>Rule Code: <input id="HisRuleCodeDetails" readonly="true" class="form-control" type="text" value="BlackListIp"></td>
            </tr>
            <tr>
                <td>Order Info: <input id="HisOrderInfoDetails" readonly="true" class="form-control" type="text" value="Thanh123123123 toán 0 1 2 3 4 5 6 7 8 9 đơn hàng @#$%^^test*())'?>"></td>
                <td>Order ID: <input id="HisOrderID" readonly="true" class="form-control" type="text" value="61289179f13d4"></td>
                <td>Transaction Status: <input id="HisOrderTransactionStatus" readonly="true" class="form-control" type="text" value="61289179f13d4"></td>

            </tr>
            <tr>
                <td>Action: <input type="text" id="HisRiskAction" readonly="true" class="form-control"></td>
                <td>Risk Code From Bank: <input id="HisRiskCodeFromBankDetails" readonly="true" class="form-control" type="text" value="No value"></td>

            </tr>
        </table>
    </div>
</div>
</div>
</div>

{{-- End modal detail his --}}
{{-- total card --}}
<span>Total Card: <strong style="color: red">{{$totalRecord}}</strong></span>

<table class="table table-light">
    <thead>

        <tr>
            <div id="filter-colum" style="display:none !important;">
                <th style="display:{{$ID}}">


                    {{-- begin filter collum --}}
                    <div class="container" style="margin-left: 2px" x-data = "{ isOpen: false}">
                        {{-- <h1 x-show = "isOpen">Hello world</h1> --}}
                        <p style="z-index: 1; position: relative;">

                            <button
                            x-on:click="isOpen = !isOpen"
                            @keydown.escape = "isOpen = false"

                            style="border:none; color: #0d6efd;" >
                                <i class="flaticon2-indent-dots"></i>
                            </button>
                        </p>


                          <div class="row" style="z-index: 99999; position: absolute;"
                          x-show="isOpen"
                          @click.away = "isOpen = false"
                          >
                           @if(isset($dataHis) and $filterLoading == 1)
                              <div class="col">
                                <div class="" id="allColCheck">
                                  <div class="card card-body checkColum " style="width: 300px">
                                <div class="form-check">
                                      <input wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="ID" checked>
                                      <label class="form-check-label" for="ID">
                                        ID
                                    </label>
                                </div>
                                <div class="form-check">
                                  <input wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="CardNumber" checked>
                                  <label class="form-check-label" for="CardNumber">
                                    Card Number
                                </label>
                            </div>
                            <div class="form-check">
                              <input wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="CardName" checked>
                              <label class="form-check-label" for="CardName">
                                Card Name
                            </label>
                        </div>

                        <div class="form-check">
                          <input  wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="TransactionID" checked>
                          <label class="form-check-label" for="TransactionID">
                            Transaction ID
                        </label>
                    </div>

                    <div class="form-check">
                      <input  wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="PartnerCode" checked>
                      <label class="form-check-label" for="PartnerCode">
                        Partner Code
                    </label>
                </div>

                <div class="form-check">
                  <input  wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="Amount" checked>
                  <label class="form-check-label" for="Amount">
                    Amount
                </label>
            </div>
            <div class="form-check">
              <input  wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="IP" checked>
              <label class="form-check-label" for="IP">
                IP
            </label>
        </div>
        <div class="form-check">
          <input wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="TimeRequest" checked>
          <label class="form-check-label" for="TimeRequest" >
            Time Request
        </label>
        </div>
        <div class="form-check">
          <input wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="TimeResponse">
          <label class="form-check-label" for="TimeResponse">
            Time Response
        </label>
        </div>
        <div class="form-check">
          <input wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="BankCode">
          <label class="form-check-label" for="BankCode">
            Bank Code
        </label>
        </div>
        <div class="form-check">
          <input wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="VendorCode">
          <label class="form-check-label" for="VendorCode">
            Vendor Code
        </label>
        </div>
        <div class="form-check">
          <input wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="RuleCode">
          <label class="form-check-label" for="RuleCode">
            Rule Code
        </label>
        </div>
        <div class="form-check">
          <input wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="Action">
          <label class="form-check-label" for="Action">
            Action
        </label>
        </div>

        <div class="form-check">
          <input wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="OrderInfo">
          <label class="form-check-label" for="OrderInfo">
            Order Info
        </label>
        </div>

        <div class="form-check">
          <input wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="OrderID">
          <label class="form-check-label" for="OrderID">
            Order ID
        </label>
        </div>

        <div class="form-check">
          <input wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="Transaction_status">
          <label class="form-check-label" for="Transaction_status">
            Transaction status
        </label>
        </div>

        <div class="form-check">
          <input wire:change.prevent="$emit('showHideColumScript')" class="form-check-input" type="checkbox" value="" id="riskCodeFromBank">
          <label class="form-check-label" for="riskCodeFromBank">
            Risk Code From Bank
        </label>
        </div>

        </div>
        </div>
        </div>
        @endif
        </div>
    </div>
    </div>
{{-- end filter collum --}}



ID</th>
<th style="display:{{$CardNumber}}">Card Number</th>
<th style="display:{{$CardName}}">Card Name</th>
<th style="display:{{$TransactionID}}">Transaction ID</th>
<th style="display:{{$PartnerCode}}">Partner Code</th>
<th style="display:{{$Amount}}">Amount</th>
<th style="display:{{$IP}}">IP</th>


<th style="display: {{$TimeRequest}}">Time Request</th>
<th style="display: {{$TimeResponse}}">Time Response</th>
<th style="display: {{$BankCode}}">Bank Code</th>
<th style="display: {{$VendorCode}}">Vendor Code</th>

<th style="display: {{$RuleCode}}">Rule Code</th>
<th style="display: {{$Action}}">Action</th>
<th style="display: {{$OrderInfo}}">Order Info</th>
<th style="display: {{$OrderID}}">Order ID</th>
<th style="display: {{$Transaction_status}}">Transaction Status</th>
<th style="display: {{$riskCodeFromBankDisplay}};">Risk Code From Bank</th>
<th>UD</th>
</tr>
</thead>
<tbody>
    @if(isset($message))
    <tr>
        <td colspan="15">
            <span class="alert alert-info">{{$message}}</span>
        </td>
    </tr>
    @endif
    {{-- @dump($dataHis) --}}
    @if(isset($dataHis))
    @foreach($dataHis as $data)
    <tr>
        <td style="display:{{$ID}}"><input id="hisDetailID-{{$data->id}}" type="hidden" value="{{$data->id}}">{{$data->id}}</td>
        <td style="display:{{$CardNumber}}"><input id="HisCardNumber-{{$data->id}}" type="hidden" value="{{$data->card_number}}">{{$data->card_number}}</td>

        <td style="display:{{$CardName}}"><input id="HisCardName-{{$data->id}}" type="hidden" value="{{$data->card_name}}">{{$data->card_name}}</td>


        <td style="display:{{$TransactionID}}"> <input id="hisDetailTransactionID-{{$data->id}}" type="hidden" value="{{$data->transaction_id}}">{{$data->transaction_id}}</td>

        <td style="display:{{$PartnerCode}}"><input id="HisPartnerCode-{{$data->id}}" type="hidden" value="{{$data->partner_code}}">{{$data->partner_code}}</td>

        <td style="display:{{$Amount}}"><input id="Amount-{{$data->id}}" type="hidden" value="{{$data->amount}}">{{$data->amount}}</td>


        <td style="display:{{$IP}}"><input id="HisIp-{{$data->id}}" type="hidden" value="{{$data->ip}}">{{$data->ip}}</td>


        <td style="display: {{$TimeRequest}}"><input id="TimeRequest-{{$data->id}}" type="hidden" value="{{date('Y-m-d H:i:s', $data->time_request)}}">{{date('Y-m-d H:i:s', $data->time_request)}}</td>

        <td style="display: {{$TimeResponse}}"><input id="TimeResponse-{{$data->id}}" type="hidden" value="{{date('Y-m-d H:i:s', $data->time_response)}}">{{date('Y-m-d H:i:s', $data->time_response)}}</td>

        <td style="display: {{$BankCode}};"><input id="BankCode-{{$data->id}}" type="hidden" value="{{$data->bank_code}}">{{$data->bank_code}}</td>

        <td style="display: {{$VendorCode}};"><input id="VendorCode-{{$data->id}}" type="hidden" value="{{$data->vendor_code}}">{{$data->vendor_code}}</td>

        <td style="display: {{$RuleCode}};"><input id="RuleCode-{{$data->id}}" type="hidden" value="{{$data->rule_code}}">{{$data->rule_code}}</td>

        <td style="display: {{$Action}};"><input id="Action-{{$data->id}}" type="hidden" value="{{$data->action}}">{{$data->action}}</td>

        <td style="display: {{$OrderInfo}};"><input id="OrderInfo-{{$data->id}}" type="hidden" value="{{$data->order_info}}">{{$data->order_info}}</td>

        <td style="display: {{$OrderID}}"><input id="OrderID-{{$data->id}}" type="hidden" value="{{$data->order_id}}">{{$data->order_id}}</td>

        <td style="display: {{$Transaction_status}}"> <input id="Transaction_status-{{$data->id}}" type="hidden" value="{{$data->transaction_status}}"> {{$data->transaction_status}}</td>

        <td style="display: {{$riskCodeFromBankDisplay}};">
            <input id="riskCodeFromBank-{{$data->id}}" type="hidden" value="{{($data->risk_code_from_bank)?$data->risk_code_from_bank:'No value'}}">
            {{($data->risk_code_from_bank)?$data->risk_code_from_bank:'No value'}}</td>
            <td>

                <a data-placement="top" title="Add card to blacklist" wire:click.prevent="$emit('hisAddCardtoBlacklistScript', '{{$data->id}}')" data-toggle="modal" data-target="#addnewCardBlackList">
                    <i class="flaticon-paper-plane-1"></i> |
                </a>
                <a data-placement="top" title="Add IP to blacklist" wire:click.prevent="$emit('AddIPtoBlacklistScript', '{{$data->id}}')">
                    <i class="flaticon-users-1"></i>
                </a>
                <a data-target="#InactivePartnerCode" data-toggle="modal" data-placement="top" title="Inactive partner" wire:click.prevent="$emit('getDataFromTableHisScript', '{{$data->id}}')">
                    <i class="flaticon2-group"></i>
                </a>
                <a data-toggle="modal" data-target=".bd-example-modal-xl" data-placement="top" title="View Detail" wire:click.prevent="$emit('ViewDetailHis', '{{$data->id}}')">
                    <i class="flaticon-search-magnifier-interface-symbol"></i>
                </a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li wire:click.prevent="getCurrentPage({{1}})" class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;&laquo;</span>
                    <span class="sr-only">first</span>
                </a>
            </li>
            <li wire:click.prevent="getCurrentPage({{$currentPage - 1}})" class="page-item @if($currentPage <= 1) {{'disabled'}}  @endif">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
            </li>
            @if(isset($totalPage))
            @for($i = $start; $i <= $end; $i++)
            <li style="cursor: pointer;" wire:click.prevent="getCurrentPage({{$i}})" class="page-item @if($currentPage == $i) {{'active'}} @endif"><a class="page-link">{{$i}}</a></li>
            @endfor
            @endif
            <li wire:click.prevent="getCurrentPage({{$currentPage + 1}})" class="page-item @if($currentPage >= $totalPage) {{'disabled'}}  @endif">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
            </li>

            <li wire:click.prevent="getCurrentPage({{$totalPage}})" class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;&raquo;</span>
                <span class="sr-only">Last</span>
            </a>
            </li>
        </ul>
        </nav>


</div>

</div>
</div>
