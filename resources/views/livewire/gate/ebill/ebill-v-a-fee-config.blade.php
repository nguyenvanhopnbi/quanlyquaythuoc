<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Partner VA Fee Config
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a
                        data-toggle="modal"
                        data-target="#themmoiTransferPartnerBank"
                        href="/partner-partners/add" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm Mới</a>

                    </div>
                </div>
            </div>
        </div>

        {{-- modal edit --}}
         <div wire:ignore.self class="modal fade" id="editTransferPartnerBank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Transfer Partner Bank Provider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @if(isset($message) and !$warning)
                <div class="row">
                    <div class="col"><span class="alert alert-primary">{{$message}}</span></div>
                </div>
                @elseif(isset($message) and $warning)
                <div class="row">
                    <div class="col"><span class="alert alert-danger">{{$message}}</span></div>
                </div>
                @endif
                <div class="row">
                    <div class="col">
                        <label for="">Partner Code: </label>
                        <input list="partnerCodeListEdit" type="text" class="form-control" id="partner_code_edit">
                        <datalist id="partnerCodeListEdit">
                            @if(isset($listPartnerCode->data))
                            @foreach($listPartnerCode->data as $list1)
                            @if($list1->partner_code != null)
                            <option value="{{$list1->partner_code}}">
                                {{($list1->partner_code == $list1->name)?"":$list1->name}}
                            </option>
                            @endif
                            @endforeach
                            @endif
                        </datalist>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="tranFee">Trans fee:</label>
                        <input
                        autocomplete="off"
                        type="number"
                        pattern="\d+"
                        onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"
                        class="form-control" id="transFeeEdit">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="is_use_auto_balance">Is use auto balance: </label>
                        <select type="text" class="form-control" id="is_use_auto_balance_edit">
                            <option value="">Choose auto balance</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('EditEbillFeeConfigVAScript')" type="button" class="btn btn-primary">Update</button>
                <input wire:ignore type="hidden" id="ID_Update">
              </div>
            </div>
          </div>
        </div>
        {{-- end modal edit --}}

        {{-- modal them moi --}}
        <div wire:ignore.self class="modal fade" id="themmoiTransferPartnerBank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @if(isset($message) and !$warning)
                <div class="row">
                    <div class="col"><span class="alert alert-primary">{{$message}}</span></div>
                </div>
                @elseif(isset($message) and $warning)
                <div class="row">
                    <div class="col"><span class="alert alert-danger">{{$message}}</span></div>
                </div>
                @endif
                <div class="row">
                    <div class="col">
                        <label for="">Partner Code: </label>
                        <input list="partnerCodeListAddnew" type="text" class="form-control" id="partner_code">
                        <datalist id="partnerCodeListAddnew">
                            @if(isset($listPartnerCode->data))
                            @foreach($listPartnerCode->data as $list2)
                            @if($list2->partner_code != null)
                            <option value="{{$list2->partner_code}}">
                                {{($list2->partner_code == $list2->name)?"":$list2->name}}
                            </option>
                            @endif
                            @endforeach
                            @endif
                        </datalist>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="tranFee">Trans fee: </label>
                        <input
                        autocomplete="off"
                        type="number"
                        pattern="\d+"
                        onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"
                        class="form-control" id="transFee">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="is_use_auto_balance">Is use auto balance: </label>
                        <select type="text" class="form-control" id="is_use_auto_balance">
                            <option value="">Choose auto balance</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('saveNewEbillFeeVAConfigScript')" type="button" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>
        {{-- end modal them moi --}}
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col">
                    <label for="">Partner Code:</label>
                    <input list="partnerCodeListSearch" type="text" class="form-control" id="searchPartnerCode">
                    <datalist id="partnerCodeListSearch">
                            @if(isset($listPartnerCode->data))
                            @foreach($listPartnerCode->data as $list3)
                            @if($list3->partner_code != null)
                            <option value="{{$list3->partner_code}}">
                                {{($list3->partner_code == $list3->name)?"":$list3->name}}
                            </option>
                            @endif
                            @endforeach
                            @endif
                        </datalist>
                </div>
                <div class="col">
                    <label for="">Start Time:</label>
                    <input type="text" class="form-control" id="startTimeSearch" placeholder="Ngày bắt đầu">
                </div>
                <div class="col">
                    <label for="">End Time:</label>
                    <input type="text" class="form-control" id="endTimeSearch" placeholder="Ngày kết thúc" >
                </div>
                <div class="col">
                    <button wire:click.prevent="$emit('searchEbillCrossCheckScript')" style="margin-top: 34px" class="btn btn-primary">Search</button>
                    <button wire:click.prevent="$emit('ExportConfigCSVScript')" style="margin-top: 34px" class="btn btn-primary">Export</button>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Partner Code</th>
                        <th>Fee Trans</th>
                        <th>Is use auto balance</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($listData))
                    @foreach($listData->data->data as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->partner_code}}
                            <input type="hidden" id="partner_code-{{$list->id}}" value="{{$list->partner_code}}">
                        </td>

                        <td>
                            {{$list->feeDisplay->feeTrans}}
                            <input type="hidden" id="feeDisplay-feeTrans-{{$list->id}}" value="{{$list->feeDisplay->feeTrans}}">
                        </td>

                        <td>{{$list->is_use_auto_balance}}
                            <input type="hidden" id="is_use_auto_balance-{{$list->id}}" value="{{$list->is_use_auto_balance}}">
                        </td>

                        <td>{{date('d-m-Y', $list->created_at)}}</td>
                        <td>{{date('d-m-Y', $list->updated_at)}}</td>
                        <td>
                            <a data-placement="top"
                            title="Update Ebill Config VA Fee" wire:click.prevent="$emit('getDateTableEbillConfigVAFeeScript', '{{$list->id}}')" data-toggle="modal" data-target="#editTransferPartnerBank">
                                <i class="flaticon2-pen"></i> |
                            </a>
                            <a data-placement="top" title="Delete Ebill Config VA Fee" wire:click.prevent="$emit('deleteEbillConfigVAFeeScript', '{{$list->id}}')">
                                <i class="flaticon2-delete"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if(isset($listData))
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li wire:click.prevent="gotoCurrentPage('{{$currentPage - 1}}')" class="page-item @if($currentPage <= 1) {{'disabled'}}  @endif">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @for($i = $start; $i <= $end; $i++)
                <li wire:click.prevent="gotoCurrentPage('{{$i}}')" class="page-item @if($currentPage == $i) {{'active'}} @endif"><a class="page-link" href="#">{{$i}}</a></li>
                @endfor
                <li wire:click.prevent="gotoCurrentPage('{{$currentPage + 1}}')" class="page-item @if($currentPage >= $totalPage) {{'disabled'}} @endif">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              </ul>
            </nav>
            @endif
        </div>

    </div>
</div>

@push('scriptsChart')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('ExportConfigCSVScript', ()=>{
                var partnerCode = document.getElementById('searchPartnerCode').value;
                var startTime = document.getElementById('startTimeSearch').value;
                var endTime = document.getElementById('endTimeSearch').value;


                var protocol = window.location.protocol;
                var host = window.location.host;
                var url = protocol + '//' + host + '/';

                window.open(url + 'ebill-partner-va-fee-export-csv?partnerCode='+ partnerCode
                    +'&startTime='+startTime
                    +'&endTime='+endTime
                    );


            });


            Livewire.on('searchEbillCrossCheckScript', ()=>{
                var partnerCode = document.getElementById('searchPartnerCode').value;
                var startTime = document.getElementById('startTimeSearch').value;
                var endTime = document.getElementById('endTimeSearch').value;

                Livewire.emit('searchEbillConfigFeeVA', partnerCode, startTime, endTime);
            });

            Livewire.on('saveNewEbillFeeVAConfigScript', ()=>{
                var partnerCode = document.getElementById('partner_code').value;
                var transFee = document.getElementById('transFee').value;
                var is_use_auto_balance = document.getElementById('is_use_auto_balance').value;

                if(partnerCode == ''){
                    alert('Bạn cần nhập PartnerCode');
                    document.getElementById('partner_code').focus();
                    return;
                }
                if(transFee == ''){
                    alert('Bạn cần nhập transFee');
                    document.getElementById('transFee').focus();
                    return;
                }

                if(isNaN(transFee)){
                    alert('Bạn cần nhập transFee là 1 số');
                    document.getElementById('transFee').focus();
                    return;
                }
                if(is_use_auto_balance == ''){
                    alert('Bạn cần nhập is use auto balance: ');
                    document.getElementById('is_use_auto_balance').focus();
                    return;
                }

                Livewire.emit('saveNewEbillConfigVAFee', partnerCode, transFee, is_use_auto_balance);

                setTimeout(function(){
                    Livewire.emit('resetMessage');
                }, 7000);
            });

            Livewire.on('getDateTableEbillConfigVAFeeScript', id=>{
                document.getElementById('partner_code_edit').value = document.getElementById('partner_code-' + id).value;

                document.getElementById('transFeeEdit').value = document.getElementById('feeDisplay-feeTrans-' + id).value;

                document.getElementById('is_use_auto_balance_edit').value = document.getElementById('is_use_auto_balance-' + id).value;

                document.getElementById('ID_Update').value = id;
            });

            Livewire.on('EditEbillFeeConfigVAScript', ()=>{
                var partnerCode = document.getElementById('partner_code_edit').value;
                var id = document.getElementById('ID_Update').value;
                var transFeeEdit = document.getElementById('transFeeEdit').value;
                var is_use_auto_balance_edit = document.getElementById('is_use_auto_balance_edit').value;

                if(transFeeEdit == ''){
                    alert('Bạn cần nhập trans fee.');
                    document.getElementById('transFeeEdit').focus();
                    return;
                }
                if(isNaN(transFeeEdit)){
                    alert('Bạn cần nhập trans fee là 1 số.');
                    document.getElementById('transFeeEdit').focus();
                    return;
                }

                if(partnerCode == ''){
                    alert('Bạn cần chọn partnerCode.');
                    document.getElementById('partner_code_edit').focus();
                    return;
                }

                if(is_use_auto_balance_edit == ''){
                    alert('Bạn cần chọn is use auto balance.');
                    document.getElementById('is_use_auto_balance_edit').focus();
                    return;
                }

                Livewire.emit('EditEbillVAConfigFee', id, transFeeEdit, partnerCode, is_use_auto_balance_edit);
                setTimeout(function(){
                    Livewire.emit('resetMessage');
                }, 7000);
            });


            Livewire.on('deleteEbillConfigVAFeeScript', id=>{
                var cFirm = confirm('Bạn có chắc chắn xóa ID: ' + id +'?');
                if(cFirm){
                    Livewire.emit('deleteEbillConfigFeeVA', id);
                }
            });

        })

    </script>
@endpush
