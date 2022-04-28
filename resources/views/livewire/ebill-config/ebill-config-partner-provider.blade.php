<div>
    {{-- In work, do what you enjoy. --}}
    {{-- The Master doesn't talk, he acts. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Ebill Config Partner Provider
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <button
                    data-toggle="modal"
                    data-target="#addnewEbillConfigProvider"
                    {{-- wire:click.prevent="$emit('addnewEbillConfigProviderScript')" --}}
                    class="btn btn-primary">Add new</button>
                </div>
            </div>
        </div>

        {{-- modal add new --}}

        <div wire:ignore.self class="modal fade" id="addnewEbillConfigProvider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @if(isset($message) and !$warning)
                <div class="row">
                    <div class="col">
                        <span class="alert alert-primary">{{$message}}</span>
                    </div>
                </div>
                @endif
                @if($warning)
                <div class="row">
                    <div class="col">
                        <span class="alert alert-warning">{{$message}}</span>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col">
                        <label for="partnerCode">Partner Code: </label>
                        <input list="partnerCodeListAddnew" type="text" id="addnewPartnerCode" class="form-control">
                        <datalist id="partnerCodeListAddnew">
                            @if(isset($partnerCodeList))
                            @foreach($partnerCodeList as $list3)
                            <option value="{{$list3->partner_code}}">{{($list3->partner_code == $list3->name)?'':$list3->name}}</option>
                            @endforeach
                            @endif
                        </datalist>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="AddnewproviderCode">Provider Code: </label>
                        <input type="text" class="form-control" id="AddnewproviderCode">
                    </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button
                wire:click.prevent="$emit('addnewEbillConfigProviderScript')"
                type="button" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>
        {{-- end modal add new --}}

        {{-- update modal update --}}

        <div wire:ignore.self class="modal fade" id="UpdatePartnerProviderConfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Config</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @if(isset($message) and !$warning)
                <div class="row">
                    <div class="col">
                        <span class="alert alert-primary">{{$message}}</span>
                    </div>
                </div>
                @endif
                @if(isset($message) and $warning)
                <div class="row">
                    <div class="col">
                        <span class="alert alert-warning">{{$message}}</span>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col">
                        <label for="UpdatePartnerCode">Partner Code: </label>
                        <input list="partnerCodeListUpdate" type="text" class="form-control" id="UpdatePartnerCode">
                        <datalist id="partnerCodeListUpdate">
                            @if(isset($partnerCodeList))
                            @foreach($partnerCodeList as $list2)
                            <option value="{{$list2->partner_code}}">{{($list2->partner_code == $list2->name)?'':$list2->name}}</option>
                            @endforeach
                            @endif
                        </datalist>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="UpdateProviderCode">Provider Code: </label>
                            <input type="text" class="form-control" id="UpdateProviderCode">
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('updateConfigPartnerProviderScript')" type="button" class="btn btn-primary">Save</button>
                <input wire:ignore type="hidden" id="IDUPdate">
              </div>
            </div>
          </div>
        </div>

        {{-- End update modal  --}}


        <div class="kt-portlet__body">
            <div class="row">
                <div class="col">
                    <label for="partner_code">Partner Code: </label>
                    <input list="partnerCodeListSearch" autocomplete="off" type="text" class="form-control"  id="partnerCode">
                    <datalist id="partnerCodeListSearch">
                        @if(isset($partnerCodeList))
                        @foreach($partnerCodeList as $list1)
                        <option value="{{$list1->partner_code}}">{{($list1->partner_code == $list1->name)?'':$list1->name}}</option>
                        @endforeach
                        @endif
                    </datalist>
                </div>
                <div class="col">
                    <label for="provider_code">Provider Code: </label>
                    <input autocomplete="off" type="text" class="form-control" id="providerCode">
                </div>
                <div class="col">
                    <label for="partner_code">Start time: </label>
                    <input
                    placeholder="Ngày bắt đầu"
                    autocomplete="off" type="text" class="form-control"  id="startTimeSearch">
                </div>
                <div class="col">
                    <label for="provider_code">End time: </label>
                    <input
                    placeholder="Ngày kết thúc"
                    autocomplete="off" type="text" class="form-control" id="endTimeSearch">
                </div>
                <div class="col">
                    <button wire:click.prevent="$emit('searchEbillConfigProviderScript')" style="margin-top: 34px;" class="btn btn-primary">Search</button>
                </div>

            </div>
        </div>

        <div class="kt-portlet__body">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PartnerCode</th>
                        <th>ProviderCode</th>
                        <th>Created At</th>
                        <th>Update At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($dataList))
                    @foreach($dataList as $list)
                    <tr>
                        <td>{{$list->id}}
                            <input type="hidden" id="ID-{{$list->id}}" value="{{$list->id}}">
                        </td>
                        <td>{{$list->partner_code}}
                            <input id="partnerCode-{{$list->id}}" type="hidden" value="{{$list->partner_code}}">
                        </td>
                        <td>{{$list->provider_code}}
                            <input id="providerCode-{{$list->id}}" type="hidden" value="{{$list->provider_code}}">
                        </td>
                        <td>{{date('d-m-Y H:i:s', $list->created_at)}}</td>
                        <td>{{date('d-m-Y H:i:s', $list->updated_at)}}</td>
                        <td style="width: 100px;">
                            <a
                            wire:click.prevent="$emit('getDataUpdateScript', '{{$list->id}}')"
                            data-placement="top"
                            title="Update Config Partner Provider"
                            data-toggle="modal"
                            data-target="#UpdatePartnerProviderConfig">
                            <i class="flaticon2-pen"></i> |
                            </a>
                        <a data-placement="top" title="Delete Config Partner Provider Thu Ho" wire:click.prevent="$emit('deleteConfigPartnerProviderScript', '{{$list->id}}')">
                            <i class="flaticon2-delete"></i>
                        </a></td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li wire:click.prevent="gotoCurrentPage({{$currentPage - 1}})" class="page-item @if($currentPage <= 1){{'disabled'}}  @endif">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @for($i = $start; $i <= $end; $i++)
                <li wire:click.prevent="gotoCurrentPage({{$i}})" class="page-item @if($i == $currentPage) {{'active'}} @endif"><a class="page-link" href="#">{{$i}}</a></li>
                @endfor
                <li wire:click.prevent="gotoCurrentPage({{$currentPage + 1}})" class="page-item @if($currentPage >= $totalPage) {{'disabled'}}  @endif">
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
