<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Partner Paygate Fee Config
                </h3>
                <button
                id="addnewModalConfig"
                wire:click.prevent="$emit('getDomPartnerPaygateFeeConfigScript')"
                {{-- data-toggle="modal"
                data-target="#addnewModal"  --}}
                class="btn btn-primary" style="position: absolute; right: 50px;">Add new</button>
                <a wire:click.prevent="$emit('exportScript')" href="#" style="position: absolute; right: 135px;" class="btn btn-primary">Export</a>
            </div>

        </div>
        <div class="kt-portlet__body" style="overflow: scroll;">


            {{-- update modal --}}
            <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col" id="messageConfigUpdate">

                        </div>
                    </div>
                    {{-- action="{{route('gate.partner-paygate-fee-config-update')}}" --}}
                    {{-- action="{{route('gate.partner-paygate-fee-config-update-post')}}" --}}
                    <form id="updatePartnerConfigPaygateForm" action="{{route('gate.partner-paygate-fee-config-update-post')}}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="partnerCode">Partner Code: </label>

                            <input type="text" class="form-control" disabled id="partnerCodeUpdateLable">

                            <input
                            wire:ignore
                            wire:change.prevent = "checkPartnerCodeChangeUpdate"
                            {{-- wire:model.defer="partnerCodeModelUpdate" --}}
                            list="dataListPartnerUpdate"
                            required type="text" class="form-control"
                            id="partnerCodeUpdate" name="partner_code" style="display: none;">
                            <datalist wire:ignore id="dataListPartnerUpdate">
                                @if(isset($dataListPartner))
                                @foreach($dataListPartner as $list1)
                                <option wire:ignore value="{{$list1->partner_code}}">{{($list1->partner_code == $list1->name)?"":$list1->name}}</option>
                                @endforeach
                                @endif
                            </datalist>
                            @if(isset($messageCheckPartnerCodeModelUpdate))
                            <label style="color: red;" for="checkpartnerCodeUpdate">{{$messageCheckPartnerCodeModelUpdate}}</label>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="partnerCode">Contract Number:</label>
                            <input required type="text" class="form-control" id="contractNumberUpdate"
                            name="contract_number">
                        </div>
                    </div>
                    @if(isset($listBankcode))
                    @foreach($listBankcode as $bankCodeUpdate => $listBankcodeUpdate)
                    @if($listBankcodeUpdate == 'ALL')

                    <div class="row">
                        <div class="col">
                            <label for="{{$bankCodeUpdate}}">{{$bankCodeUpdate}}:</label>
                            <ul>
                                <li>
                                    <input placeholder="Nhập trans fee cho {{$bankCodeUpdate}} "
                                    type="number" step="any" pattern="[-+]?[0-9]*[.,]?[0-9]+"
                                    class="form-control"
                                    id="transFee{{$bankCodeUpdate}}"
                                    name="fee[{{$bankCodeUpdate}}][ALL][transFee]">
                                </li>

                                <li>
                                    <input
                                    type="number"
                                    min="0" max="100"
                                    step="any" pattern="[-+]?[0-9]*[.,]?[0-9]+"
                                    placeholder="Nhập trans percent fee cho {{$bankCodeUpdate}}"
                                    class="form-control" id="transPercentFee{{$bankCodeUpdate}}"
                                    name="fee[{{$bankCodeUpdate}}][ALL][transPercentFee]"
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>

                    @else

                    <div class="row">
                        <div class="col">
                            <label for="{{$bankCodeUpdate}}">{{$bankCodeUpdate}}:</label>
                            <ul>

                                <li>
                                    <select
                                    wire:change.prevent="$emit('changeBankcode-{{$bankCodeUpdate}}')"
                                    class="form-control" id="allBankCodeUpdate-{{$bankCodeUpdate}}">
                                        <option value="all">All</option>
                                        <option value="bankcode">Bank code</option>
                                    </select>
                                    {{-- <input type="hidden" id="hidden-bankcode-{{$bankCodeUpdate}}" value="XXXXXX"> --}}
                                </li>

                                <span wire:ignore id="allItemBankcodeUpdate-{{$bankCodeUpdate}}">
                                    <li>
                                        <input
                                        required
                                        type="number"
                                        step="any" pattern="[-+]?[0-9]*[.,]?[0-9]+"
                                        placeholder="Nhập trans fee cho all {{$bankCodeUpdate}} "
                                        class="form-control"
                                        id="transFee{{$bankCodeUpdate}}"
                                        name="fee[{{$bankCodeUpdate}}][ALL][transFee]">
                                    </li>

                                    <li>
                                        <input
                                        required
                                        type="number"
                                        min="0" max="100"
                                        step="any" pattern="[-+]?[0-9]*[.,]?[0-9]+"
                                        placeholder="Nhập trans percent fee cho all {{$bankCodeUpdate}}"
                                        class="form-control"
                                        id="transPercentFee{{$bankCodeUpdate}}"
                                        name="fee[{{$bankCodeUpdate}}][ALL][transPercentFee]"
                                        >
                                    </li>
                                </span>

                                <span wire:ignore id="itemBankcodeUpdate-{{$bankCodeUpdate}}">
                                    @foreach($listBankcodeUpdate as $keyCode => $code)
                                    <li>
                                        <label for="{{$code->code}}">{{$code->code}}</label>
                                        <input
                                        required
                                        placeholder="Nhập Trans fee cho {{$code->code}}"
                                        autocomplete="off"
                                        step="any" pattern="[-+]?[0-9]*[.,]?[0-9]+"
                                        type="number"
                                        class="form-control"
                                        name="fee[{{$bankCodeUpdate}}][{{$code->code}}][transFee]"
                                        id="transFee{{$code->code}}">

                                        <input
                                        required
                                        min="0" max="100"
                                        type="number"
                                        step="any" pattern="[-+]?[0-9]*[.,]?[0-9]+"
                                        placeholder="Nhập trans fee percent cho {{$code->code}}"
                                        class="form-control"
                                        name="fee[{{$bankCodeUpdate}}][{{$code->code}}][transPercentFee]"
                                        id="transPercentFee{{$code->code}}">
                                    </li>

                                    @endforeach
                                </span>
                            </ul>
                        </div>
                    </div>

                    @endif

                    @endforeach
                    @endif


                    <input wire:ignore type="hidden" id="IDPARTNERPAYGATEFEECONFIG" name="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>

                  </div>
                  <div class="modal-footer">


                  </div>
                  </form>
                </div>
              </div>
            </div>
            {{-- end update modal --}}


            {{-- add new modal --}}

            <div wire:ignore.self class="modal fade" id="addnewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col" id="messageConfig"></div>
                    </div>
                    <form id="AddnewPartnerPaygateFeeConfig" action="{{route('gate.partner-paygate-fee-config-add')}}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="partnerCode">Partner Code:</label>
                            <input
                            wire:change.prevent = "checkPartnerCodeChange"
                            wire:model.defer="partnerCodeModel"
                            list="dataListPartnerAddnew" required type="text" class="form-control" id="partnerCodeAddnew" name="partner_code">
                            <datalist id="dataListPartnerAddnew">
                                @if(isset($dataListPartner))
                                @foreach($dataListPartner as $list2)
                                <option value="{{$list2->partner_code}}">{{($list2->partner_code == $list2->name)?"":$list2->name}}</option>
                                @endforeach
                                @endif
                            </datalist>
                            @if(isset($messageCheckPartnerCodeModel))
                            <label style="color: red;" for="checkpartnerCode">{{$messageCheckPartnerCodeModel}}</label>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="partnerCode">Contract Number:</label>
                            <input required type="text" class="form-control" id="contractNumberAddnew"
                            name="contract_number">
                        </div>
                    </div>

                    @if($listBankcode)
                    @foreach($listBankcode as $bankCode => $listBankcodeAddnew)
                    @if($listBankcodeAddnew == 'ALL')
                    <div class="row">
                        <div class="col">
                            <label for="{{$bankCode}}">{{$bankCode}}:</label>
                            <ul>
                                <li>
                                    {{-- <label for="Transfee">Trans fee: </label> --}}
                                    <input
                                    required
                                    step="any" pattern="[-+]?[0-9]*[.,]?[0-9]+"
                                    placeholder="Nhập trans fee cho {{$bankCode}} "
                                    type="number"
                                    class="form-control" id="fee[{{$bankCode}}][ALL][transFee]"
                                    name="fee[{{$bankCode}}][ALL][transFee]">
                                </li>

                                <li>
                                    {{-- <label for="transPercentFee">Trans percent fee: </label> --}}
                                    <input
                                    required
                                    step="any" pattern="[-+]?[0-9]*[.,]?[0-9]+"
                                    placeholder="Nhập trans percent fee cho {{$bankCode}}"
                                    type="number"
                                    min="0" max="100"
                                    class="form-control"
                                    id="transPercentFee{{$bankCode}}"
                                    name="fee[{{$bankCode}}][ALL][transPercentFee]"
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>

                    @else

                    <div class="row">
                        <div class="col">
                            <label for="{{$bankCode}}">{{$bankCode}}:</label>
                            <ul>
                                <li>
                                    <select wire:change.prevent="$emit('changeBankcodeAddnew-{{$bankCode}}')"
                                    class="form-control" id="allBankCode-{{$bankCode}}">
                                        <option value="all">All</option>
                                        <option value="bankcode">Bank code</option>
                                    </select>
                                </li>

                                <span wire:ignore id="allItemBankcode-{{$bankCode}}">
                                    <li>
                                        {{-- <label for="Transfee">Trans fee: </label> --}}
                                        <input
                                        required
                                        step="any" pattern="[-+]?[0-9]*[.,]?[0-9]+"
                                        placeholder="Nhập trans fee cho all {{$bankCode}} "
                                        type="number"
                                        class="form-control" id="fee[{{$bankCode}}][ALL][transFee]"
                                        name="fee[{{$bankCode}}][ALL][transFee]">
                                    </li>

                                    <li>
                                        <input
                                        required
                                        step="any" pattern="[-+]?[0-9]*[.,]?[0-9]+"
                                        placeholder="Nhập trans percent fee cho all {{$bankCode}}"
                                        type="number"
                                        min="0" max="100"
                                        class="form-control"
                                        id="transPercentFee{{$bankCode}}"
                                        name="fee[{{$bankCode}}][ALL][transPercentFee]"
                                        >
                                    </li>
                                </span>


                                <span wire:ignore id="itemBankcode-{{$bankCode}}">
                                    @foreach($listBankcodeAddnew as $keyCode => $code)
                                    <li>
                                        <label for="{{$code->code}}">{{$code->code}}</label>
                                        <input
                                        required
                                        step="any" pattern="[-+]?[0-9]*[.,]?[0-9]+"
                                        placeholder="Nhập Trans fee cho {{$code->code}}"
                                        autocomplete="off"
                                        type="number" class="form-control"
                                        name="fee[{{$bankCode}}][{{$code->code}}][transFee]"
                                        id="transFee{{$code->code}}">

                                        <input
                                        required
                                        step="any" pattern="[-+]?[0-9]*[.,]?[0-9]+"
                                        placeholder="Nhập trans fee percent cho {{$code->code}}"
                                        type="number"
                                        min="0" max="100"
                                        class="form-control"
                                        name="fee[{{$bankCode}}][{{$code->code}}][transPercentFee]"
                                        id="transPercentFee{{$code->code}}">
                                    </li>

                                    @endforeach
                                </span>




                            </ul>
                        </div>
                    </div>

                    @endif
                    @endforeach
                    @endif

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="addnewPartnerConfigFee" type="submit" class="btn btn-primary">Add new</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

            {{-- end add new modal --}}

            {{-- message status  --}}
          {{--   @if(request()->session()->has('status'))
            <div class="row">
                <div class="col">
                    <span class="alert alert-primary" >{!! session('status') !!}</span>
                </div>
            </div>
            @endif --}}
            {{-- end message status --}}

            <div class="row">
                <div class="col-3">
                    <label for="partnerCode">Partner Code:</label>
                    <input
                    list="dataListPartnerSearch"
                    type="text" class="form-control" id="partnerCodeSearch" placeholder="Nhập partnerCode" autocomplete="off">
                    <datalist id="dataListPartnerSearch">
                                @if(isset($dataListPartner))
                                @foreach($dataListPartner as $list3)
                                <option value="{{$list3->partner_code}}">{{($list3->partner_code == $list3->name)?"":$list3->name}}</option>
                                @endforeach
                                @endif
                            </datalist>

                </div>
                <div class="col-3">
                    <label for="startTimeSearch">Start time:</label>
                    <input type="text" class="form-control" id="startTimeSearch" placeholder="Nhập ngày bắt đầu" autocomplete="off">
                </div>
                <div class="col-3">
                    <label for="startTimeSearch">End time:</label>
                    <input type="text" class="form-control" id="endTimeSearch" placeholder="Nhập ngày kết thúc" autocomplete="off">
                </div>
                <div class="col-3">
                    <button wire:click.prevent="$emit('searchPartnerPaygateFeeScript')" class="btn btn-primary" style="margin-top: 34px;">Search</button>
                </div>
            </div>
            <div class="row">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>ID</th>
                            <th>Partner Code</th>
                            <th>Contract Number</th>
                            <th>Fee</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dump($listPartnerPaygateConfig) --}}
                        @if(isset($listPartnerPaygateConfig))
                        @foreach($listPartnerPaygateConfig as $listview)
                        <tr>
                            <td style="width:100px; white-space: nowrap;">

                                <a
                                data-placement="top"
                                title="Update Partner Paygate Fee Config"
                                wire:click.prevent="$emit('getDateTablePartnerPaygateFeeConfigScript', '{{$listview->id}}')"
                              {{--   data-toggle="modal"
                                data-target="#updateModal"> --}}
                                    <i class="flaticon2-pen"></i> |
                                </a>
                                <a data-placement="top" title="Delete Partner Paygate Fee Config" wire:click.prevent="$emit('deletePartnerPaygateFeeConfigScript', '{{$listview->id}}')">
                                    <i class="flaticon2-delete"></i>
                                </a>
                            </td>
                            <td>
                                {{$listview->id}}
                            </td>
                            <td>
                                {{$listview->partner_code}}
                                <input type="hidden" id="partner_code-{{$listview->id}}" value="{{$listview->partner_code}}">
                            </td>
                            <td>
                                {{$listview->contract_number}}
                                <input type="hidden" id="contract_number-{{$listview->id}}" value="{{$listview->contract_number}}">
                            </td>
                            <td>
                                <input type="hidden" id="fee-{{$listview->id}}" value="{{$listview->fee}}">

                                <ul style="display: flex;">
                                    @foreach($listview->feeDisplay as $key => $fee)
                                    <li style="border-right: 1px solid #EEEEEE; border-bottom: 1px solid #EEEEEE; margin: 0 15px;">
                                        {{$key}}
                                        <ul>
                                            @foreach($fee as $key => $value)
                                            <li>
                                                {{$key}}
                                                <ul>
                                                    @foreach($value as $trans => $value)
                                                    @if($trans == 'transFee')
                                                    <li style="white-space: nowrap;">
                                                        {{$trans}} - <strong>{{$value}}</strong> VND</li>
                                                    @else
                                                    <li style="white-space: nowrap;">
                                                        {{$trans}} - <strong>{{$value}}</strong> %
                                                    </li>
                                                    @endif

                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach

                                </ul>

                            </td>
                            <td style="width:100px; white-space: nowrap;">

                                <a
                                id="updateModalConfig"
                                data-placement="top"
                                title="Update Partner Paygate Fee Config"
                                wire:click.prevent="$emit('getDateTablePartnerPaygateFeeConfigScript', '{{$listview->id}}')"
                                {{-- data-toggle="modal"
                                data-target="#updateModal" --}}
                                >
                                <i class="flaticon2-pen"></i> |
                                </a>
                                <a data-placement="top" title="Delete Partner Paygate Fee Config" wire:click.prevent="$emit('deletePartnerPaygateFeeConfigScript', '{{$listview->id}}')">
                                    <i class="flaticon2-delete"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li wire:click.prevent="gotoCurrentPage('{{$currentPage - 1}}')" class="page-item @if($currentPage <= 1) {{'disabled'}} @endif">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    @if(isset($listPartnerPaygateConfig) and isset($start) and isset($end))
                    @for($i = $start; $i <= $end; $i++)
                    <li wire:click.prevent="gotoCurrentPage('{{$i}}')" class="page-item @if($i == $currentPage) {{'active'}}  @endif"><a class="page-link" href="#">{{$i}}</a></li>
                    @endfor
                    @endif
                    <li wire:click.prevent="gotoCurrentPage('{{$currentPage + 1}}')" class="page-item @if($currentPage >= $totalPage) {{'disabled'}} @endif">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </nav>

            </div>
        </div>
    </div>
</div>
@push('scriptsChart')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('exportScript', ()=>{
            var partnerCodeSearch = document.getElementById('partnerCodeSearch').value;
            var startTimeSearch = document.getElementById('startTimeSearch').value;
            var endTimeSearch = document.getElementById('endTimeSearch').value;


            var protocol = window.location.protocol;
            var host = window.location.host;
            var url = protocol + '//' + host + '/';

                window.open(url + 'partner-paygate-fee-config-export?partner_code='+ partnerCodeSearch +'&startTime='+startTimeSearch+'&endTime='+endTimeSearch);


        });
    </script>
@endpush
