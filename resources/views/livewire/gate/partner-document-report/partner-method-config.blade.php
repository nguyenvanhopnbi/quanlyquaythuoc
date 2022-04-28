<div>
    {{-- @dd($bankCodeList->CC) --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Partner Payment Method Config
                </h3>
                <button data-toggle="modal" data-target="#addnewPartnerConfig" class="btn btn-primary" style="position: absolute; right: 50px;">Add new</button>
            </div>

        </div>
        <div class="kt-portlet__body">

            {{-- modal update --}}
            <div wire:ignore.self class="modal fade" id="updatePartnerConfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="col">
                            <label for="PartnerCodeUpdate">PartnerCode: </label>
                            <input list="dataListPartnerUpdate" autocomplete="off" placeholder="Nhập partnerCode" type="text" class="form-control" id="PartnerCodeUpdate">
                            <datalist id="dataListPartnerUpdate">
                                @if(isset($dataListPartner))
                                @foreach($dataListPartner as $list1)
                                <option value="{{$list1->partner_code}}">{{($list1->partner_code == $list1->name)?'':$list1->name}}</option>
                                @endforeach
                                @endif
                            </datalist>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="ATMupdate">ATM: (option)</label>
                            <select name="ATMupdate" id="ATMupdate" class="form-control">
                                <option value="null">Chọn bank code</option>
                                <option value="ALL">ALL</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="CCupdate">CC: (option)</label>
                            <div style="display: flex;">
                                <select name="CCupdate" id="CCupdate" class="form-control">
                                    <option value="">Chọn bank code</option>
                                    @if(isset($bankCodeList->CC))
                                    @foreach($bankCodeList->CC as $CCupdate)
                                        <option value="{{$CCupdate->code}}">{{$CCupdate->name}}</option>
                                    @endforeach
                                    @endif

                                </select>
                                <button wire:click.prevent="$emit('updateAddBankcodeCCListScript')" class="badge badge-primary" style="border: none;">add</button>

                                <button wire:click.prevent="$emit('updateremoveBankcodeCCListScript')" class="badge badge-danger" style="border: none;">remove</button>
                            </div>
                            <ul wire:ignore id="ccUpdateList"></ul>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <label for="EWALLETupdate">EWALLET: (option)</label>
                            <div style="display: flex;">
                                <select name="EWALLETupdate" id="EWALLETupdate" class="form-control">
                                    <option value="">Chọn bank code</option>
                                    @if(isset($bankCodeList->EWALLET))
                                    @foreach($bankCodeList->EWALLET as $EWALLETupdate)
                                        <option value="{{$EWALLETupdate->code}}">{{$EWALLETupdate->name}}</option>
                                    @endforeach
                                    @endif

                                </select>
                                <button wire:click.prevent="$emit('updateAddBankcodeEWALLETListScript')" class="badge badge-primary" style="border: none;">add</button>

                                <button wire:click.prevent="$emit('updateremoveBankcodeEWALLETListScript')" class="badge badge-danger" style="border: none;">remove</button>

                            </div>
                            <ul wire:ignore id="EWALLETupdateList"></ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="VAupdate">VA: (option)</label>
                            <div style="display: flex;">
                                <select name="VAupdate" id="VAupdate" class="form-control">
                                    <option value="">Chọn bank code</option>
                                    @if(isset($bankCodeList->VA))
                                    @foreach($bankCodeList->VA as $VAupdate)
                                        <option value="{{$VAupdate->code}}">{{$VAupdate->name}}</option>
                                    @endforeach
                                    @endif

                                </select>
                                <button wire:click.prevent="$emit('updateAddBankcodeVAListScript')" class="badge badge-primary" style="border: none;">add</button>
                                <button wire:click.prevent="$emit('updateremoveBankcodeVAListScript')" class="badge badge-danger" style="border: none;">remove</button>
                            </div>
                            <ul wire:ignore id="VAupdateList"></ul>
                        </div>
                    </div>


                     <div class="row">
                        <div class="col">
                            <label for="MMupdate">Mobile Money: (option)</label>
                            <div style="display: flex;">
                                <select name="MMupdate" id="MMupdate" class="form-control">
                                    <option value="">Chọn bank code</option>
                                    @if(isset($bankCodeList->MM))
                                    @foreach($bankCodeList->MM as $MMupdate)
                                        <option value="{{$MMupdate->code}}">{{$MMupdate->name}}</option>
                                    @endforeach
                                    @endif

                                </select>
                                <button wire:click.prevent="$emit('updateAddBankcodeMMListScript')" class="badge badge-primary" style="border: none;">add</button>
                                <button wire:click.prevent="$emit('updateremoveBankcodeMMListScript')" class="badge badge-danger" style="border: none;">remove</button>
                            </div>
                            <ul wire:ignore id="MMupdateList"></ul>
                        </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('updatePaymentMethodConfigScript')" type="button" class="btn btn-primary">Update</button>
                    <input wire:ignore type="hidden" name="IDUPDATE" id="IDUPDATE">
                  </div>
                  @if(isset($message) and !$warning)
                  <div class="modal-footer">
                        <span class="alert alert-primary">{{$message}}</span>
                  </div>
                  @endif

                  @if(isset($message) and $warning)
                  <div class="modal-footer">
                        <span class="alert alert-danger">{{$message}}</span>
                  </div>
                  @endif
                </div>
              </div>
            </div>

            {{-- end modal update --}}



            {{-- modal add new --}}
            <div wire:ignore.self class="modal fade" id="addnewPartnerConfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="col">
                            <label for="partnerCode">Partner Code: </label>
                            <input list="dataListPartnerAddnew" placeholder="Nhập partner Code" type="text" id="partnerCodeAddnew" class="form-control">
                            <datalist id="dataListPartnerAddnew">
                                @if(isset($dataListPartner))
                                @foreach($dataListPartner as $list2)
                                <option value="{{$list2->partner_code}}">{{($list2->partner_code == $list2->name)?'':$list2->name}}</option>
                                @endforeach
                                @endif
                            </datalist>
                        </div>
                    </div>

                    <div class="row" style="display: none;">
                        <div class="col">
                            <label for="StartTime">StartTime: </label>
                            <input placeholder="Nhập ngày bắt đầu" type="text" id="startTimeAddnew" class="form-control">
                        </div>
                    </div>

                    <div class="row" style="display: none;">
                        <div class="col">
                            <label for="EndTime">EndTime: </label>
                            <input placeholder="Nhập ngày kết thúc" type="text" id="endTimeAddnew" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="ATM">ATM: (option)</label>
                            <select name="ATM" id="ATM" class="form-control">
                                <option value="">Chọn bank code</option>
                                <option value="ALL">ALL</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="CC">CC: (option)</label>
                            <div style="display: flex;">
                                <select name="CC" id="CC" class="form-control">
                                    <option value="">Chọn bank code</option>

                                    @if(isset($bankCodeList->CC))
                                    @foreach($bankCodeList->CC as $listCC)
                                        <option value="{{$listCC->code}}">{{$listCC->name}}</option>
                                    @endforeach
                                    @endif

                                </select>
                                <button wire:click.prevent="$emit('addBankcodeCCListScript')" class="badge badge-primary" style="border: none;">add</button>
                            </div>
                            <ul>
                                @if(!empty($bankcodeCC))
                                @foreach($bankcodeCC as $bankcodeCC)
                                    <li style="display: flex;">
                                        <span style="margin-right: 50px">{{$bankcodeCC}}</span>
                                        <span style="font-weight: bold; cursor: pointer;">
                                            <a wire:click.prevent="$emit('removeaddBankcodeCCListScript', '{{$bankcodeCC}}')" style="color: red;" href="#">x</a></span>
                                    </li>
                                @endforeach
                            @endif
                            </ul>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="EWALLET">EWALLET: (option)</label>
                            <div style="display: flex;">
                                <select name="EWALLET" id="EWALLET" class="form-control">
                                    <option value="APPOTA">appota</option>

                                    @if(isset($bankCodeList->EWALLET))
                                    @foreach($bankCodeList->EWALLET as $listEWALLET)
                                        <option value="{{$listEWALLET->code}}">{{$listEWALLET->name}}</option>
                                    @endforeach
                                    @endif

                                </select>
                                <button wire:click.prevent="$emit('addBankcodeEWALLETListScript')" class="badge badge-primary" style="border: none;">add</button>
                            </div>
                            <ul>
                                @if(!empty($bankcodeEWALLET))
                                @foreach($bankcodeEWALLET as $bankcodeEWALLET)
                                    {{-- <li>{{$bankcodeEWALLET}}</li> --}}
                                    <li style="display: flex;">
                                        <span style="margin-right: 50px">{{$bankcodeEWALLET}}</span>
                                        <span style="font-weight: bold; cursor: pointer;">
                                            <a wire:click.prevent="$emit('removeaddBankcodeEWALLETListScript', '{{$bankcodeEWALLET}}')" style="color: red;" href="#">x</a></span>
                                    </li>
                                @endforeach
                            @endif
                            </ul>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="ATM">VA: (option)</label>
                            <div style="display: flex;">
                                <select name="VA" id="VA" class="form-control">
                                    <option value="">Chọn bankcode VA</option>

                                    @if(isset($bankCodeList->VA))
                                    @foreach($bankCodeList->VA as $listVA)
                                        <option value="{{$listVA->code}}">{{$listVA->name}}</option>
                                    @endforeach
                                    @endif

                                </select>
                                <button wire:click.prevent="$emit('addBankcodeVAListScript')" class="badge badge-primary" style="border: none;">add</button>
                            </div>

                            <ul>
                                @if(!empty($bankcodeVA))
                                    @foreach($bankcodeVA as $bankcodeVA)
                                        {{-- <li>{{$bankcodeVA}}</li> --}}
                                        <li style="display: flex;">
                                        <span style="margin-right: 50px">{{$bankcodeVA}}</span>
                                        <span style="font-weight: bold; cursor: pointer;">
                                            <a wire:click.prevent="$emit('removeaddBankcodeVAListScript', '{{$bankcodeVA}}')" style="color: red;" href="#">x</a></span>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>

                        </div>
                    </div>

                     <div class="row">
                        <div class="col">
                            <label for="MM">Mobile Money: (option)</label>
                            <div style="display: flex;">
                                <select name="MM" id="MM" class="form-control">
                                    <option value="">Chọn bankcode MM</option>

                                    @if(isset($bankCodeList->MM))
                                    @foreach($bankCodeList->MM as $listMM)
                                        <option value="{{$listMM->code}}">{{$listMM->name}}</option>
                                    @endforeach
                                    @endif

                                </select>
                                <button wire:click.prevent="$emit('addBankcodeMMListScript')" class="badge badge-primary" style="border: none;">add</button>
                            </div>

                            <ul>
                                @if(!empty($bankcodeMM))
                                    @foreach($bankcodeMM as $bankcodeMM)
                                        {{-- <li>{{$bankcodeVA}}</li> --}}
                                        <li style="display: flex;">
                                        <span style="margin-right: 50px">{{$bankcodeMM}}</span>
                                        <span style="font-weight: bold; cursor: pointer;">
                                            <a wire:click.prevent="$emit('removeaddBankcodeMMListScript', '{{$bankcodeMM}}')" style="color: red;" href="#">x</a></span>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>

                        </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('addnewPartnerMethodConfigScript')" type="button" class="btn btn-primary">Save</button>
                  </div>
                  @if(isset($message) and !$warning)
                  <div class="modal-footer">
                    <span class="alert alert-primary">{{$message}}</span>
                  </div>

                  @endif
                  @if(isset($message) and $warning)
                  <div class="modal-footer">
                    <span class="alert alert-warning">{{$message}}</span>
                  </div>

                  @endif
                </div>
              </div>
            </div>
            {{-- end modal add new --}}


            <div class="row">
                <div class="col-3">
                    <label for="partnerCode">Partner Code: </label>
                    <input list="dataListPartnerSearch" autocomplete="off" placeholder="Tìm kiếm theo Partner Code" type="text" class="form-control" id="partnerCode">

                    <datalist id="dataListPartnerSearch">
                                @if(isset($dataListPartner))
                                @foreach($dataListPartner as $list3)
                                <option value="{{$list3->partner_code}}">{{($list3->partner_code == $list3->name)?'':$list3->name}}</option>
                                @endforeach
                                @endif
                            </datalist>

                </div>
                <div class="col-3">
                    <label for="startTime">startTime: </label>
                    <input autocomplete="off" placeholder="Nhập ngày bắt đầu" type="text" class="form-control" id="startTimeSearch">
                </div>
                <div class="col-3">
                    <label for="endTime">End Time: </label>
                    <input autocomplete="off" placeholder="Nhập ngày kết thúc" type="text" class="form-control" id="endTimeSearch">
                </div>
                <div class="col-3">
                    <label for="Search">&nbsp</label>
                    <button wire:click.prevent="$emit('searchPartnerConfigMethodScript')" style="margin-top: 34px;" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Partner Code</th>
                            <th>Payment Method Config</th>
                            <th>Create At</th>
                            <th>Update At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dump($listPartnerMethodConfig) --}}
                        @if(isset($listPartnerMethodConfig))
                        {{-- @dump($listPartnerMethodConfig) --}}
                        @foreach($listPartnerMethodConfig->data as $listConfig)
                        <tr>
                            <td>{{$listConfig->id}}</td>
                            <td>{{$listConfig->partner_code}}
                                <input type="hidden" id="partner_code-{{$listConfig->id}}" value="{{$listConfig->partner_code}}">
                            </td>
                            <td>
                                <input type="hidden" id="payment_method_config-{{$listConfig->id}}" value="{{$listConfig->payment_method_config_json}}">

                                @if(isset($listConfig->payment_method_config->ATM) and !empty($listConfig->payment_method_config->ATM))
                                <div style="display: flex; border-bottom: 1px solid #EEEEEE;">
                                    <span style="min-width: 80px;">ATM</span>
                                    <ul style="margin-left: 20px;">
                                        <li>{{(isset($listConfig->payment_method_config->ATM))?$listConfig->payment_method_config->ATM:''}}</li>
                                    </ul>
                                </div>

                                @endif
                                @if(isset($listConfig->payment_method_config->CC) and !empty($listConfig->payment_method_config->CC))
                                <div style="display: flex; border-bottom: 1px solid #EEEEEE;">
                                    <span style="min-width: 80px;">CC</span>
                                    <ul style="margin-left: 20px;">
                                        @if(isset($listConfig->payment_method_config->CC))
                                        @foreach($listConfig->payment_method_config->CC as $cc)
                                        <li>{{$cc}}</li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                @endif
                                @if(isset($listConfig->payment_method_config->EWALLET) and !empty($listConfig->payment_method_config->EWALLET))
                                <div style="display: flex; border-bottom: 1px solid #EEEEEE;">
                                    <span style="min-width: 80px;">EWALLET</span>

                                        <ul style="margin-left: 20px;">
                                            @if(isset($listConfig->payment_method_config->EWALLET))
                                            @foreach($listConfig->payment_method_config->EWALLET as $EWALLET)
                                            <li>{{$EWALLET}}</li>
                                            @endforeach
                                            @endif
                                        </ul>

                                </div>

                                @endif
                                @if(isset($listConfig->payment_method_config->VA) and !empty($listConfig->payment_method_config->VA))
                                <div style="display: flex; border-bottom: 1px solid #EEEEEE;">
                                    <span style="min-width: 80px;">VA</span>
                                    <ul style="margin-left: 20px;">
                                            @if(isset($listConfig->payment_method_config->VA))
                                            @foreach($listConfig->payment_method_config->VA as $VA)
                                            <li>{{$VA}}</li>
                                            @endforeach
                                            @endif
                                        </ul>
                                </div>
                                @endif

                                @if(isset($listConfig->payment_method_config->MM) and !empty($listConfig->payment_method_config->MM))

                                <div style="display: flex; border-bottom: 1px solid #EEEEEE;">
                                    <span style="min-width: 80px;">Mobile Money</span>
                                    <ul style="margin-left: 20px;">
                                            @if(isset($listConfig->payment_method_config->MM))
                                            @foreach($listConfig->payment_method_config->MM as $MM)
                                            <li>{{$MM}}</li>
                                            @endforeach

                                            @else

                                            <li>None</li>

                                            @endif
                                    </ul>
                                </div>

                                @endif

                            </td>
                            <td>{{date('Y-m-d H:i:s', $listConfig->created_at)}}</td>
                            <td>{{date('Y-m-d H:i:s', $listConfig->updated_at)}}</td>
                            <td style="width:100px">

                            <a data-placement="top" title="Update Partner Method Config" wire:click.prevent="$emit('getDateTablePartnerMethodConfigScript', '{{$listConfig->id}}')" data-toggle="modal" data-target="#updatePartnerConfig">
                                <i class="flaticon2-pen"></i> |
                            </a>
                            <a data-placement="top" title="Delete Partner Method Config" wire:click.prevent="$emit('deletePartnerMethodConfigScript', '{{$listConfig->id}}')">
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
                    <li wire:click.prevent="gotoCurrentPage('{{$currentPage - 1}}')" class="page-item @if($currentPage <= 1) {{'disabled'}}  @endif">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    @if(isset($listPartnerMethodConfig))
                    @for($i = $start; $i <= $end; $i++)
                    <li wire:click.prevent="gotoCurrentPage('{{$i}}')" class="page-item @if($i == $currentPage) {{'active'}}  @endif"><a class="page-link" href="#">{{$i}}</a></li>
                    @endfor
                    @endif
                    <li wire:click.prevent="gotoCurrentPage('{{$currentPage + 1}}')" class="page-item @if($currentPage >= $totalPage) {{'disabled'}}  @endif">
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
